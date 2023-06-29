<?php

namespace App\Http\Controllers;

use App\Mail\CampaignMail;
use App\Mail\SendMail;
use App\Models\BouncedEmail;
use App\Models\Campaign;
use App\Models\Domain;
use App\Models\EmailTracker;
use App\Models\Group;
use App\Models\GroupSubscriber;
use App\Models\Subscriber;
use App\Models\Template;
use App\Models\UserSentRecord;
use Illuminate\Http\Request;
use Mail;
use Str;

use function PHPUnit\Framework\returnValueMap;

class CampaignController extends Controller
{
    function campaigns(){
        $campaigns = Campaign::all();
        return view('admin.campaigns.index', compact('campaigns'));
    }
    function campaigns_report(){
        $campaigns = Campaign::all();
        return view('admin.campaigns.reports', compact('campaigns'));
    }
    // Campaigns
    function create_campaign(){
        $domains = Domain::whereStatus(1)->get();
        return view('admin.campaigns.create', compact('domains'));
    }
    function edit_campaign($code){
        $campaign = Campaign::whereCode($code)->first();
        $domains = Domain::whereStatus(1)->get();
        return view('admin.campaigns.edit', compact('campaign','domains'));
    }
    function update_campaign(Request $request, $id){
        // validate request
        $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'domain_id' => 'required|integer|min:1',
            'from_name' => 'required|string|max:255',
            'email' => 'required|email',
            'reply_to' => 'required|email',
        ]);
        $campaign = Campaign::find($id);
        Campaign::find($id)->update([
            'name' => $request->name,
            'subject' => $request->subject,
            'domain_id' => $request->domain_id,
            'from_name' => $request->from_name,
            'email' => $request->email,
            'reply_to' => $request->reply_to,
        ]);
        return redirect()->route('admin.campaigns.template', $campaign->code);
        return $campaign;
    }

    function store_campaign(Request $request){
        // validate request
        $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'domain_id' => 'required|integer|min:1',
            'from_name' => 'required|string|max:255',
            'email' => 'required|email',
            'reply_to' => 'required|email',
        ]);
        $code = getTrxcode(8);
        $campaign = Campaign::create([
            'user_id' => 1,
            'name' => $request->name,
            'subject' => $request->subject,
            'domain_id' => $request->domain_id,
            'from_name' => $request->from_name,
            'email' => $request->email,
            'reply_to' => $request->reply_to,
            'code' => $code
        ]);

        return redirect()->route('admin.campaigns.template', $code);
        return $campaign;
    }

    function create_campaign_template($code){
        $campaign = Campaign::whereCode($code)->first();
        if($campaign == null) {
            return redirect()->route('admin.campaigns')->withError("Campaign Not Found");
        }
        $templates = Template::all();
        return view('admin.campaigns.step2', compact('campaign','templates'));
    }
    function store_campaign_template(Request $request, $code){
        $request->validate([
            'template_id' => 'required|integer|min:1',
        ]);
        $template = Template::findOrFail($request->template_id);
        $campaign = Campaign::whereCode($code)->first();
        if($campaign == null) {
            return redirect()->route('admin.campaigns')->withError("Campaign Not Found");
        }
        $campaign->template_id = $request->template_id;
        $campaign->body = $template->html;
        $campaign->save();
        return redirect()->route('admin.campaigns.design', $code);
    }

    function campaign_design($code){
        $campaign = Campaign::whereCode($code)->first();
        $template = $campaign->template;
        return view('admin.campaigns.step3', compact('campaign','template'));
    }
    function store_campaign_design(Request $request, $code){
        $campaign = Campaign::whereCode($code)->first();
        $campaign->body = $request->body;
        $campaign->subject = $request->subject;
        $campaign->save();

        return redirect()->route('admin.campaigns.audience', $code);
    }
    function campaign_audience($code){
        $campaign = Campaign::whereCode($code)->first();
        $audience = Group::whereStatus(1)->get();
        return view('admin.campaigns.step4', compact('campaign','audience'));
    }
    function store_campaign_audience(Request $request, $code){
        // validate
        $request->validate([
            'group_id' => 'required|integer|min:1',
        ]);
        $campaign = Campaign::whereCode($code)->first();
        $campaign->group_id = $request->group_id;
        $campaign->save();
        return redirect()->route('admin.campaigns.confirm', $code);
    }
    function campaign_confirm($code){
        $campaign = Campaign::whereCode($code)->first();
        return view('admin.campaigns.final', compact('campaign'));

    }

    function delete_campaign($id){
        Campaign::findOrFail($id)->delete();
        return back()->withSuccess('Campaign Deleted Successfullly');
    }



    // Templates
    function templates(){
        $templates = Template::paginate(20);
        return view('admin.template.index', compact('templates'));
    }

    function create_template(){
        return view('admin.template.add');
    }

    function store_template(Request $request){
        $template = new Template();
        $template->title = $request->title;
        $template->html = $request->html;
        $template->slug = Str::slug($request->title);
        $template->user_id = 1;
        if($request->hasFile('preview')){
            $image = $request->file('preview');
            $imageName = Str::random(17).'.jpg';
            $image->move(public_path('uploads/templates'),$imageName);

            $template->preview = 'templates/'.$imageName;
        }
        $template->save();
        return redirect()->route('admin.templates.index')->withSuccess('Template Created Successfully');
    }

    function edit_template($slug){
        $template = Template::whereSlug($slug)->first();
        return view('admin.template.edit', compact('template'));
    }
    function update_template(Request $request, $slug)
    {
        $template = Template::whereSlug($slug)->first();
        $template->title = $request->title;
        $template->html = $request->html;
        if($request->hasFile('preview')){
            $image = $request->file('preview');
            $imageName = Str::random(17).'.jpg';
            $image->move(public_path('uploads/templates'),$imageName);

            $template->preview = 'templates/'.$imageName;
        }
        $template->save();
        return redirect()->route('admin.templates.index')->withSuccess('Template Updated Successfully');
    }

    function delete_template($slug){
        $template = Template::whereSlug($slug)->first();
        $template->delete();
        return redirect()->route('admin.templates.index')->withSuccess('Template Deleted Successfully');
    }

    function preview_template($slug){
        $template = Template::findOrFail($slug);
        return view('admin.template.preview', compact('template'));
    }

    function campaign_send(Request $request, $code){
        $campaign = Campaign::whereCode($code)->first();
        // return $request;
        $subscribers = $campaign->group->subscribers;
        if ($subscribers->count() < 0) {
            return back()->withError('Whoops! No Email Found');
        }
        foreach ($subscribers as $key => $subscriber) {
            // Email Tracker
            $tracker = new EmailTracker();
            $tracker->tracker = Str::uuid();
            $tracker->subscriber_id = $subscriber->id;
            $tracker->campaign_id = $campaign->id;
            $tracker->total_clicks = 0;
            $tracker->status = 0;
            $tracker->record = 'NOT OPEN';
            $tracker->save();

            $data['tracker'] = $tracker;
            $data['unsubscribe_link'] = route('campaign.unsubscribe', [$campaign->id, $subscriber->id]);
            send_campaign_emails($subscriber->email, $campaign->code, $data);

            $tracker_uuid = $tracker->tracker;
            // $this->emailBounce($subscribers, $campaign->id, $tracker_uuid, $api_response = null);
        }

        $tracker_uuid = $tracker->tracker;

        $campaign->status = 1;
        $campaign->send_date = now();
        $campaign->save();

        $this->emailBounce($subscribers, $campaign->id, $tracker_uuid, $api_response = null);

        return back()->with('success',__('Test Email Sent Successfully'));
    }

    /**
     * EMAIL BOUNCER
     */
    public function emailBounce($subscribers, $campaign_id, $tracker_uuid, $api_response = null){
       try{
            $campaign = Campaign::find($campaign_id);
            foreach ($subscribers as $campaignEmail) {
                if ($campaignEmail->email != null) {
                    /**
                     * Check bounce
                     */
                    // $bounced = app(EmailChecker::class)
                    //             ->checkEmail($campaignEmail->email,'boolean'); // old version

                    $bounced = emailAddressVerify($campaignEmail->email);
                    $bounce = new BouncedEmail();
                    // $bounce->bounce = $bounced['success']; // old version
                    $bounce->bounce = $bounced;
                    $bounce->user_id = 1;
                    $bounce->email = $campaignEmail->email;
                    $bounce->camapaign_id = $campaign_id;
                    $bounce->save();


                    $tracker = EmailTracker::where('tracker', $tracker_uuid)->update([
                        'status' => $bounced,
                        // 'status' => $bounced['success']
                    ]);
                }
            }
            return true;
            // return back()->with('success',__('Test Email Sent Successfully'));

       }catch (\Throwable $th) {
            dd($th);
            return back()->withErrors($th->getMessage());
        }
    }

    function campaign_sendtest(Request $request, $code){
        $campaign = Campaign::whereCode($code)->first();
        $email = $request->test_email;
        // return $request;
        $data['campaign_id'] = $campaign->id;
        $data['content'] = $campaign->body;
        $data['subject'] = $campaign->subject;
        $data['email'] = $campaign->email;
        try {
            Mail::to($email)->queue(new SendMail($data));
        } catch (\Exception $e) {
            dd($e);
            return back()->with('error',__('Check SMTP Settings'));
        }
        return back()->with('success',__('Test Email Sent Successfully'));
    }

    function contactsUnsubscribe($campaign_id, $email_id)
    {
        $subscriber = Subscriber::where('id', $email_id)->first();
        $campaign = Campaign::find($campaign_id);
        $check_email_id = GroupSubscriber::whereGroupId($campaign->group_id)->whereSubscriberId($subscriber->id)->first();
        if ($check_email_id) {
            // $check_email_id->delete();

            $text = 'Email unsubscribed Successfully';

            return view('unsubscribed', compact('text'));

            return 'Email unsubscribed';
        } else {
            $text = 'Email already unsubscribed';
            return view('unsubscribed', compact('text'));
        }
    }
}

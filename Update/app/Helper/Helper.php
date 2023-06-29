<?php

use App\Libs\EmailVerify;
use App\Mail\CampaignMail;
use App\Models\Campaign;
use App\Models\CampaignLog;
use App\Models\EmailTracker;
use App\Models\Setting;
use App\Models\Subscriber;
use App\Models\SystemSetting;

if (!function_exists('static_asset')) {
    function static_asset($path, $secure = null)
    {
        return app('url')->asset('public/assets/' . $path, $secure);
    }
}
//return file uploaded via uploader
if (!function_exists('my_asset')) {
    function my_asset($path, $secure = null)
    {
        return app('url')->asset('public/uploads/' . $path, $secure);
    }
}

function text_trim($string, $length = null)
{
    if (empty($length)) $length = 100;
    return Str::limit($string, $length, "...");
}

function show_datetime($date, $format = 'd M, Y h:ia')
{
    return \Carbon\Carbon::parse($date)->format($format);
}

function show_date($date, $format = 'd M, Y')
{

    return \Carbon\Carbon::parse($date)->format($format);
}

function show_time($date, $format = 'h:ia')
{

    return \Carbon\Carbon::parse($date)->format($format);
}

function slug($string)
{
    return Illuminate\Support\Str::slug($string);
}
// Create slug
function uniqueSlug($name ,$model)
{
    $slug = Str::slug($name);
    $allSlugs = checkRelatedSlugs($slug , $model);
    if (! $allSlugs->contains('slug', $slug)){
        return $slug;
    }

    $i = 1;
    $is_contain = true;
    do {
        $newSlug = $slug . '-' . $i;
        if (!$allSlugs->contains('slug', $newSlug)) {
            $is_contain = false;
            return $newSlug;
        }
        $i++;
    } while ($is_contain);
}
function checkRelatedSlugs($slug , $model)
{
    return DB::table($model)->where('slug', 'LIKE', $slug . '%')->get();
}

if (!function_exists('get_setting')) {
    function get_setting($key)
    {
        $settings = Setting::first();
        $setting = $settings->$key;
        return $setting;
    }
}
if (!function_exists('sys_setting')) {
    function sys_setting($key, $default = null)
    {
        $settings = SystemSetting::all();
        $setting = $settings->where('name', $key)->first();

        return $setting == null ? $default : $setting->value;
    }
}
function getTrxcode($length)
{
    $characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ1234567890';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// commonAvatar
function commonAvatar($name)
{
    return Avatar::create(Str::upper($name))->toBase64();
}

function notFound($image)
{
    return static_asset('not_found/' . $image);
}

function emailAddressVerify($email)
{
    $verify = new EmailVerify;

    if ($verify->verify_domain($email)) {
        return 1; // Domain has been verified
    } else {
        return 0; // Domain has NOT been verified
    }
}
function campaignLog($campaign_id, $campaign_name, $message)
{
    $campaignLog = new CampaignLog();
    $campaignLog->user_id = 1;
    $campaignLog->campaign_id = $campaign_id;
    $campaignLog->campaign_name = $campaign_name;
    $campaignLog->message = $message ?? null;
    $campaignLog->save();
}


function shortCodeReplacer($shortCode, $replace_with, $template_string)
{
    return str_replace($shortCode, $replace_with, $template_string);
}
/**
 * CLICKS
 */
function campaignEmailTotalClicks($campaign_id)
{
    return EmailTracker::where('campaign_id', $campaign_id)->sum('total_clicks');
}

function campaignEmailUniqueClicks($campaign_id)
{
    return EmailTracker::where('campaign_id', $campaign_id)->where('total_clicks', '!=', 0)->count();
}

/**
 * OPEN RATE
 */
function campaignEmailNotClicked($campaign_id)
{
    return EmailTracker::where('campaign_id', $campaign_id)->where('record', 'NOT OPEN')->count();
}

function campaignEmailClicked($campaign_id)
{
    return EmailTracker::where('campaign_id', $campaign_id)->where('record', 'OPENED')->count();
}

function campaignEmailClickedAndNotClicked($campaign_id)
{
    return EmailTracker::where('campaign_id', $campaign_id)->count();
}

function campaignOpenRate($campaign_id)
{
    $rate = (campaignEmailClicked($campaign_id) / campaignEmailClickedAndNotClicked($campaign_id)) * 100;

    return round($rate);
}

/**
 * DELIVERY RATE
 */
function campaignEmailNotDelivered($campaign_id)
{
    return EmailTracker::where('campaign_id', $campaign_id)->where('status', 1)->count();
}

function campaignEmailDelivered($campaign_id)
{
    return EmailTracker::where('campaign_id', $campaign_id)->where('status', 0)->count();
}

function campaignEmailNotOpenedAndNotOpen($campaign_id)
{
    return EmailTracker::where('campaign_id', $campaign_id)->count();
}

function campaignDeliveryRate($campaign_id)
{
    $rate = (campaignEmailDelivered($campaign_id) / campaignEmailNotOpenedAndNotOpen($campaign_id)) * 100;

    return round($rate);
}

// Send general emails
function send_campaign_emails($email, $code, $others)
{
    $campaign = Campaign::whereCode($code)->first();
    $subscriber = Subscriber::whereEmail($email)->first();
    $unsub_link = route('campaign.unsubscribe', [$campaign->id, $subscriber->id]);
    $shortCodes = [
        'email' => $subscriber['email'],
        'phone_number' => $subscriber['phone'],
        'first_name' => $subscriber['first_name'],
        'last_name' => $subscriber['last_name'],
        'site_name' => get_setting('title'),
        'site_link' => route('index'),
        'date' => date('Y-m-d H:m:s'),
        'unsubscribe_link' => ""
    ];
    if($campaign == null){
        return;
    }
    $message = $campaign->body;
    foreach ($shortCodes as $code => $value) {
        $message = shortCodeReplacer('{'.$code.'}', $value, $message);
    }
    // subject
    $subject = $campaign->subject;
    foreach ($shortCodes as $code => $value) {
        $subject = shortCodeReplacer('{'.$code.'}', $value, $subject);
    }

    // dd($subject, $message);
    // send email
    $data = $others;
    $data['campaign_id'] = $campaign->id;
    $data['subject'] = $subject;
    $data['content'] = $message;

    try {
        Mail::to($email)->later(now()->addMinutes(2), new CampaignMail($data));
    } catch (\Exception $e) {
        // dd($e);
    }

}

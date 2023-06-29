<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupSubscriber;
use App\Models\Subscriber;
use Rap2hpoutre\FastExcel\FastExcel;

use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    //
    function subscribers(){
        $subscribers = Subscriber::all();
        return view('admin.subscribers.index', compact('subscribers'));
    }
    // Subscribers
    function edit_subscriber($id, Request $request){
        $subscriber = Subscriber::find($id);
        $subscriber->update($request->all());
        return back()->withSuccess('Subscriber Updated Successfuly');
    }
    function create_subscriber(Request $request){
        $request['user_id'] = 1;
        $subscriber = Subscriber::create($request->all());
        return back()->withSuccess('Subscriber Created Successfuly');
    }

    function subscriber_groups () {
        $groups = Group::all();
        return view('admin.groups.index', compact('groups'));
    }

    function create_group(Request $request){
        $group = new Group();
        $group->user_id = 1;
        $group->name = $request->name;
        $group->code = getTrxcode(7);
        $group->save();

        return back()->withSuccess('Group Created Successfully');
    }
    function edit_group(Request $request, $id){
        $group = Group::find($id);
        $group->name = $request->name;
        $group->save();

        return back()->withSuccess('Group Updated Successfully');
    }
    function delete_group($id){
        $group = Group::find($id);
        $group->delete();

        return back()->withSuccess('Group Deleted Successfully');
    }
    function view_group($code){
        $group = Group::whereCode($code)->first();
        return view('admin.groups.view', compact('group'));
    }
    function del_group_subscriber($code, $id){
        $group = Group::whereCode($code)->first();
        $sub = Subscriber::find($id);
        $sub_group = GroupSubscriber::whereGroupId($group->id)->whereSubscriberId($sub->id)->first();
        $sub_group->delete();
        return back()->withSuccess('Subscriber Deleted Successfully from group');
    }
    function add_group_subscriber($code){
        $group = Group::whereCode($code)->first();
        return view('admin.groups.add', compact('group'));
    }

    function group_store_subscriber(Request $request, $code){
        $group = Group::whereCode($code)->first();
        if($request->add_type == "file_upload"){
            $request->validate([
                'file' => 'required|mimes:csv,txt,xlsx|max:10240'
            ]);
            $filez = $request->file('file');
            $fileName = getTrxcode(5).$filez->getClientOriginalName();
            // save file;
            $filez->move(public_path('uploads/subscribers'),$fileName);
            $file = public_path('uploads/subscribers/'.$fileName);
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            // dd($file->getPathName());
            // validate
            if ($extension === 'csv' || $extension === 'txt' || $extension === 'xlsx') {
                $rows = (new FastExcel)->import($file);

                foreach ($rows as $row) {
                    $email = $row['Email'];
                    $firstName = $row['First Name'];
                    $lastName = $row['Last Name'];
                    $phone = $row['Phone'];
                    $subscriber = Subscriber::firstOrCreate(
                        ['email' => $email],
                        [
                            'first_name' => $firstName,
                            'last_name' => $lastName,
                            'phone' => $phone,
                            'user_id' => 1, // Assuming user ID is in the fifth column
                        ]
                    );

                    // Check if the subscriber is not already in the group
                    if (!$group->subscribers->contains($subscriber->id)) {
                        $group->subscribers()->attach($subscriber->id);
                    }
                }
            }
            return redirect()->route('admin.subscriber.groups.view', $code)->with('success', 'Subscribers imported successfully.');
        }elseif($request->add_type == "manual_upload"){
            $request->validate([
                'subscribers' => 'required|string'
            ]);
            $text = $request->subscribers;
            $array = [];
            foreach (explode("\n", $text) as $line) {
                $parts = explode(",", $line);

                $array[] = [
                  "first_name" => $parts[1],
                  "last_name" => $parts[2],
                  "email" => $parts[0],
                  "phone" => $parts[3],
                  "user_id" => 1
                ];
            }
            foreach ($array as $row) {
                $email = $row['email'];
                $firstName = $row['first_name'];
                $lastName = $row['last_name'];
                $phone = $row['phone'];
                $subscriber = Subscriber::firstOrCreate(
                    ['email' => $email],
                    [
                        'first_name' => $firstName,
                        'last_name' => $lastName,
                        'phone' => $phone,
                        'user_id' => 1, // Assuming user ID is in the fifth column
                    ]
                );

                // Check if the subscriber is not already in the group
                if (!$group->subscribers->contains($subscriber->id)) {
                    $group->subscribers()->attach($subscriber->id);
                }
            }
            return redirect()->route('admin.subscriber.groups.view', $code)->with('success', 'Subscribers imported successfully.');
        }
        return $request;
    }
}

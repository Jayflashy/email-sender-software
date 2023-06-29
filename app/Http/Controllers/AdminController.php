<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Domain;
use App\Models\Setting;
use App\Models\SystemSetting;
use Artisan;
use Auth;
use Hash;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    function dashboard(){
        $campaigns = Campaign::all();
        return view('admin.index', compact('campaigns'));
    }
    function login(){
        // check if admin loggedin and show login page
        return view('admin.login');
    }
    // Profile
    function profile(){
        return view('admin.profile');
    }
    function update_profile (Request $request){

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;

        if($request->password != null){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return back()->withSuccess(__('Profile Updated Successfully.'));
    }
    // Domains
    function domains(){
        $domains = Domain::all();
        return view('admin.domains.index', compact('domains'));
    }
    function create_domain(){
        return view('admin.domains.create');
    }
    function store_domain(Request $request){
        $input = $request->all();
        $input['user_id'] = 1;
        $input['status'] = 1;
        $domain = new Domain();
        $domain->create($input);
        return redirect()->route('admin.domains')->withSuccess('Domain Added Successfully');
    }
    function edit_domain($id){
        $domain = Domain::findOrFail($id);
        return view('admin.domains.edit', compact('domain'));
    }
    function update_domain(Request $request, $id){
        $input = $request->all();
        $domain = Domain::find($id);
        $domain->update($input);
        return redirect()->route('admin.domains')->withSuccess('Domain Updated Successfully');
    }
    function delete_domain($id){
        $domain = Domain::findOrFail($id)->delete();
        return redirect()->route('admin.domains')->withSuccess('Domain Deleted Successfully');
    }

    // settings
    public function settings()
    {
        return view('admin.setup.index');
    }
    public function email_settings()
    {
        return view('admin.setup.email');
    }
    public function envkeyUpdate(Request $request)
    {
        foreach ($request->types as $key => $type) {
            $this->overWriteEnvFile($type, $request[$type]);
        }
        return back()->withSuccess("Settings updated successfully");

    }
    function update_settings(Request $request){
        $input = $request->all();

        if($request->hasFile('favicon')){
            $image = $request->file('favicon');
            $imageName = 'favicon.png';
            $image->move(public_path('uploads'),$imageName);
            $input['favicon'] =$imageName;
        }
        if($request->hasFile('logo')){
            $image = $request->file('logo');
            $imageName = 'logo.png';
            $image->move(public_path('uploads'),$imageName);
            $input['logo'] =$imageName;
        }
        if($request->hasFile('touch_icon')){
            $image = $request->file('touch_icon');
            $imageName = 'touch.png';
            $image->move(public_path('uploads'),$imageName);
            $input['touch_icon'] =$imageName;
        }

        $setting = Setting::first();
        $setting->update($input);

        return redirect()->back()->with('success',__('Settings Updated Successfully.'));
    }

    function systemUpdate(Request $request)
    {
        $setting = SystemSetting::where('name', $request->name)->first();
        if($setting !=null){
            $setting->value = $request->value;
            $setting->save();
        }
        else{
            $setting = new SystemSetting;
            $setting->name = $request->name;
            $setting->value = $request->value;
            $setting->save();
        }

        return '1';
    }
    public function store_settings(Request $request)
    {
        // return $request;
        foreach ($request->types as $key => $type) {
            if($type == 'site_name'){
                $this->overWriteEnvFile('APP_NAME', $request[$type]);
            }
            else {
                $sys_settings = SystemSetting::where('name', $type)->first();

                if($sys_settings!=null){
                    if(gettype($request[$type]) == 'array'){
                        $sys_settings->value = json_encode($request[$type]);
                    }
                    else {
                        $sys_settings->value = $request[$type];
                    }
                    $sys_settings->save();
                }
                else{
                    $sys_settings = new SystemSetting;
                    $sys_settings->name = $type;
                    if(gettype($request[$type]) == 'array'){
                        $sys_settings->value = json_encode($request[$type]);
                    }
                    else {
                        $sys_settings->value = $request[$type];
                    }
                    $sys_settings->save();
                }
            }
        }

        Artisan::call('cache:clear');

        return redirect()->back()->withSuccess(__('Settings Updated Successfully.'));
    }
    public function overWriteEnvFile($type, $val)
    {
        $path = base_path('.env');
        if (file_exists($path)) {
            $val = '"'.trim($val).'"';
            if(is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0){
                file_put_contents($path, str_replace(
                    $type.'="'.env($type).'"', $type.'='.$val, file_get_contents($path)
                ));
            }
            else{
                file_put_contents($path, file_get_contents($path)."\r\n".$type.'='.$val);
            }
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use Mail;

class EmailController extends Controller
{
    //
    public function test_email(Request $request)
    {
        # code...
        $data['view'] = 'email.others';
        $data['subject'] = "SMTP Test on ".\get_setting('title');
        $data['email'] = env('MAIL_FROM_ADDRESS');
        $data['content'] = "SMTP Testing </br>  Designed By Jayflash <a href='https://jadsedev.com.ng'>JadesDev </a>";

        try {
            Mail::to($request->email)->queue(new SendMail($data));
        } catch (\Exception $e) {
            dd($e);
            return back()->with('error',__('Check SMTP Settings'));
        }
        return back()->with('success',__('Email sent Successfully.'));
    }
}

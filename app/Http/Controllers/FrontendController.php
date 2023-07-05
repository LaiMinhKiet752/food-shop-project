<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\ReceivedMail;
use App\Models\User;
use App\Notifications\NewContactMessageNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class FrontendController extends Controller
{
    public function PrivacyPolicy()
    {
        return view('frontend.page_privacy_policy');
    } //End Method

    public function About()
    {
        return view('frontend.page_about');
    } //End Method

    public function Contact()
    {
        return view('frontend.page_contact');
    } //End Method

    public function ContactSubmit(Request $request)
    {
        $admin = User::where('role', 'admin')->where('status', 'active')->first();
        Mail::to($admin->email)->send(new ContactMail($request->subject, $request->message, $request->email));

        $all_admin_user = User::where('role', 'admin')->where('status', 'active')->get();
        //Notification To Admin
        Notification::send($all_admin_user, new NewContactMessageNotification($request));

        ReceivedMail::insert([
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Email Sent Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } //End Method
}

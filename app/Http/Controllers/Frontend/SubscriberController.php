<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\WebsiteMail;
use App\Models\Subscriber;
use App\Models\User;
use App\Notifications\NewSubscriberNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class SubscriberController extends Controller
{
    public function SendMail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'The email must be a valid email address.',
        ]);
        $exists = Subscriber::where('email', $request->email)->first();
        if ($exists) {
            $notification = array(
                'message' => 'This Email Is Already Registered!',
                'alert-type' => 'warning',
            );
            return redirect()->back()->with($notification);
        }
        $token = hash('sha256', time());
        $subscriber = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->token = $token;
        $subscriber->status = 'Pending';
        $subscriber->save();

        //Send email
        $subject = 'Subscriber Email Verify';
        $verification_link = url('subscriber/verify/' . $token . '/' . $request->email);
        $message = 'Please click on the following link in order to verify as subscriber <br>';
        $message .= '<a href="' . $verification_link . '">';
        $message .= $verification_link;
        $message .= '</a>';
        Mail::to($request->email)->send(new WebsiteMail($subject, $message));
        $notification = array(
            'message' => 'Please Check Your Email Address To Verify As Subscriber!',
            'alert-type' => 'success',
        );
        return redirect()->to('/')->with($notification);
    } //End Method

    public function Verify($token, $email)
    {
        $subscriber_data = Subscriber::where('token', $token)->where('email', $email)->first();
        if ($subscriber_data) {
            $subscriber_data->token = '';
            $subscriber_data->status = 'Active';
            $subscriber_data->update();
            $all_admin_user = User::where('role', 'admin')->where('status', 'active')->get();
            //Notification To Admin
            Notification::send($all_admin_user, new NewSubscriberNotification($subscriber_data->email));
            $notification = array(
                'message' => 'You are Successfully Verified As A Subscriber To This Website!',
                'alert-type' => 'success',
            );
            return redirect()->to('/')->with($notification);
        } else {
            $notification = array(
                'message' => 'An Error Occurred, Please Try Again Later!',
                'alert-type' => 'error',
            );
            return redirect()->to('/')->with($notification);
        }
    } //End Method
}

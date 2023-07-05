<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\WebsiteMail;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminSubscriberController extends Controller
{
    public function ShowAll()
    {
        $subscribers = Subscriber::where('status', 'Active')->latest()->get();
        return view('backend.subscriber.all_subscribers', compact('subscribers'));
    } //End Method

    public function DeleteSubscriber($id)
    {
        Subscriber::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Subscriber Deleted Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } //End Method

    public function SendEmail()
    {
        return view('backend.subscriber.send_email');
    } //End Method

    public function SendEmailSubmit(Request $request)
    {
        $subject = $request->subject;
        $message = $request->message;
        $subscribers = Subscriber::where('status', 'Active')->get();
        foreach ($subscribers as $row) {
            Mail::to($row->email)->send(new WebsiteMail($subject, $message));
        }
        $notification = array(
            'message' => 'Email Is Sent Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } //End Method

    public function UpdateStatusNewSubscriber($id)
    {
        DB::table('notifications')->where('id', $id)->update(['status' => 1]);
        return response()->json([
            'success' => 'OK!'
        ]);
    } // End Method
}

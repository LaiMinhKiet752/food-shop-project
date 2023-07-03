<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\ReceivedMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactMessageController extends Controller
{
    public function Index()
    {
        ReceivedMail::query()->update(['seen' => 1]);
        $message = ReceivedMail::latest()->get();
        return view('backend.contact.index', compact('message'));
    } //End Method

    public function ContactMessageDetails($id)
    {
        $messages = ReceivedMail::findOrFail($id);
        return view('backend.contact.contact_message_details', compact('messages'));
    } //End Method

    public function ContactMessageReply(Request $request)
    {
        $reply_id = $request->id;
        $admin_id = Auth::user()->id;
        $admin = User::where('role', 'admin')->where('status', 'active')->where('id', $admin_id)->first();
        Mail::to($request->email)->send(new ContactMail($request->subject, $request->message, $admin->email));
        ReceivedMail::findOrfail($reply_id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Email Sent Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('admin.contact.message')->with($notification);
    } //End Method

    public function ContactMessageDelete($id)
    {
        ReceivedMail::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Deleted Email Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } //End Method
}

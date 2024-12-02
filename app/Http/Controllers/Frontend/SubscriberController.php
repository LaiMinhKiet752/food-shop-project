<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\SubscriberVerify;
use App\Models\Subscriber;
use App\Models\User;
use App\Notifications\NewSubscriberNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class SubscriberController extends Controller
{
    public function SendMail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Địa chỉ email phải là địa chỉ email hợp lệ.',
        ]);
        $request_email = $request->email;
        $exists = Subscriber::where('email', $request->email)->first();
        if ($exists) {
            $notification = array(
                'message' => 'Email này đã được đăng ký nhận tin!',
                'alert-type' => 'warning',
            );
            return redirect()->back()->with($notification);
        } else if (Auth::user() && !$exists) {
            $current_email = Auth::user()->email;
            if ($current_email == $request_email) {
                $subscriber = new Subscriber();
                $subscriber->email = $request->email;
                $subscriber->status = 'active';
                $subscriber->token = '';
                $subscriber->created_at = Carbon::now();
                $subscriber->status = 'active';
                $subscriber->save();
                $notification = array(
                    'message' => 'Trở thành người đăng ký thành công!',
                    'alert-type' => 'success',
                );
                return redirect()->to('/')->with($notification);
            } else if ($current_email != $request_email) {
                $token = hash('sha256', time());
                $subscriber = new Subscriber();
                $subscriber->email = $request->email;
                $subscriber->token = $token;
                $subscriber->status = 'Pending';
                $subscriber->save();

                //Send email
                $subject = 'Xác minh Email';
                $verification_link = url('subscriber/verify/' . $token . '/' . $request->email);
                $message = 'Vui lòng nhấp vào liên kết sau để xác minh là người đăng ký. <br>';
                Mail::to($request->email)->send(new SubscriberVerify($subject, $message, $verification_link));

                $notification = array(
                    'message' => 'Vui lòng kiểm tra email của bạn để xác minh bạn là người đăng ký!',
                    'alert-type' => 'success',
                );
                return redirect()->to('/')->with($notification);
            }
        } else if (!Auth::user() && !$exists) {
            $token = hash('sha256', time());
            $subscriber = new Subscriber();
            $subscriber->email = $request->email;
            $subscriber->token = $token;
            $subscriber->status = 'Pending';
            $subscriber->save();

            //Send email
            $subject = 'Xác minh Email';
            $verification_link = url('subscriber/verify/' . $token . '/' . $request->email);
            $message = 'Vui lòng nhấp vào liên kết sau để xác minh là người đăng ký. <br>';
            Mail::to($request->email)->send(new SubscriberVerify($subject, $message, $verification_link));

            $notification = array(
                'message' => 'Vui lòng kiểm tra email của bạn để xác minh bạn là người đăng ký!',
                'alert-type' => 'success',
            );
            return redirect()->to('/')->with($notification);
        }
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
                'message' => 'Bạn đã được xác minh thành công là người đăng ký của trang web này!',
                'alert-type' => 'success',
            );
            return redirect()->to('/')->with($notification);
        } else {
            $notification = array(
                'message' => 'Đã xảy ra lỗi, vui lòng thử lại sau!',
                'alert-type' => 'error',
            );
            return redirect()->to('/')->with($notification);
        }
    } //End Method
}

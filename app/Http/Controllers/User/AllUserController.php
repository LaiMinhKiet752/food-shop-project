<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\User;
use App\Notifications\CancelOrderNotification;
use App\Notifications\ReturnOrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;

class AllUserController extends Controller
{
    public function UserAccount()
    {
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('frontend.userdashboard.account_details', compact('userData'));
    } //End Method

    public function UserChangePassword()
    {
        return view('frontend.userdashboard.user_change_password');
    } //End Method

    public function UserOrderPage()
    {
        $id = Auth::user()->id;
        $orders = Order::where('user_id', $id)->orderBy('id', 'DESC')->get();
        return view('frontend.userdashboard.user_order_page', compact('orders'));
    } //End Method

    public function UserOrderDetails($order_id)
    {
        $order = Order::with('city', 'district', 'commune', 'user')->where('id', $order_id)->where('user_id', Auth::id())->first();
        $orderItem = OrderDetails::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        return view('frontend.order.order_details', compact('order', 'orderItem'));
    } //End Method

    public function UserInvoiceDownload($order_id)
    {
        $order = Order::with('city', 'district', 'commune', 'user')->where('id', $order_id)->where('user_id', Auth::id())->first();
        $orderItem = OrderDetails::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();

        $pdf = Pdf::loadView('frontend.order.order_invoice', compact('order', 'orderItem'))->setPaper('a4')->setOption(['tempDir' => public_path(), 'chroot' => public_path()]);
        return $pdf->download('invoice.pdf');
    } //End Method

    public function ReturnOrderPage()
    {
        $orders = Order::where('user_id', Auth::id())->where('return_date', '!=', NULL)->orderBy('return_date', 'DESC')->get();
        return view('frontend.order.return_order_view', compact('orders'));
    } //End Method

    public function ReturnOrderSubmit(Request $request, $order_id)
    {
        Order::findOrFail($order_id)->update([
            'return_date' => Carbon::now()->format('d-m-Y H:i:s'),
            'return_reason' => $request->return_reason,
            'return_order_status' => 1,
        ]);
        $all_admin_user = User::where('role', 'admin')->where('status', 'active')->get();
        $order = Order::where('id', $order_id)->first();
        // $first_admin_user = User::where('role', 'admin')->where('status', 'active')->first();
        // $order_date_format = date('m-d-Y H:i:s',strtotime($order->order_date));

        // //Mail To Admin
        // $subject = 'There is a request to return the order';
        // $message = 'Invoice information: <br><br>';

        // $message .= 'Order Number: ';
        // $message .= $order->order_number;
        // $message .= '<br>';

        // $message .= 'Invoice Number: ';
        // $message .= $order->invoice_number;
        // $message .= '<br>';

        // $message .= 'Full Name: ';
        // $message .= $order->name;
        // $message .= '<br>';

        // $message .= 'Email: ';
        // $message .= $order->email;
        // $message .= '<br>';

        // $message .= 'Phone Number: ';
        // $message .= $order->phone;
        // $message .= '<br>';

        // $message .= 'Payment Method: ';
        // $message .= $order->payment_method;
        // $message .= '<br>';

        // $message .= 'Payment Type: ';
        // $message .= $order->payment_type;
        // $message .= '<br>';

        // $message .= 'Total (USD): ';
        // $message .= $order->amount;
        // $message .= '<br>';

        // $message .= 'Order Date: ';
        // $message .= $order_date_format;
        // $message .= '<br>';

        // $message .= 'Return Date: ';
        // $message .= $order->return_date;
        // $message .= '<br>';

        // $message .= 'Reason: ';
        // $message .= $order->return_reason;
        // $message .= '<br>';

        // Mail::to($first_admin_user->email)->send(new WebsiteMail($subject, $message));

        //Notification To Admin
        Notification::send($all_admin_user, new ReturnOrderNotification($request));

        $notification = array(
            'message' => 'Submit Order Return Request Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('user.order.page')->with($notification);
    } //End Method

    public function CancelOrderPage()
    {
        $orders = Order::where('user_id', Auth::id())->where('cancel_date', '!=', NULL)->orderBy('cancel_date', 'DESC')->get();
        return view('frontend.order.cancel_order_view', compact('orders'));
    } //End Method

    public function CancelOrderSubmit(Request $request)
    {
        $order_id = $request->order_id;
        $all_admin_user = User::where('role', 'admin')->where('status', 'active')->get();
        Order::findOrFail($order_id)->update([
            'cancel_date' => Carbon::now()->format('d-m-Y H:i:s'),
            'cancel_order_status' => 1,
        ]);
        $notification = array(
            'message' => 'Order Cancellation Request Successful!',
            'alert-type' => 'success'
        );
        $order = Order::where('id', $order_id)->first();
        // $first_admin_user = User::where('role', 'admin')->where('status', 'active')->first();
        // $order_date_format = date('m-d-Y H:i:s',strtotime($order->order_date));

        //  //Mail To Admin
        //  $subject = 'There is a request to cancel the order';
        //  $message = 'Invoice information: <br><br>';

        //  $message .= 'Order Number: ';
        //  $message .= $order->order_number;
        //  $message .= '<br>';

        //  $message .= 'Invoice Number: ';
        //  $message .= $order->invoice_number;
        //  $message .= '<br>';

        //  $message .= 'Full Name: ';
        //  $message .= $order->name;
        //  $message .= '<br>';

        //  $message .= 'Email: ';
        //  $message .= $order->email;
        //  $message .= '<br>';

        //  $message .= 'Phone Number: ';
        //  $message .= $order->phone;
        //  $message .= '<br>';

        //  $message .= 'Payment Method: ';
        //  $message .= $order->payment_method;
        //  $message .= '<br>';

        //  $message .= 'Payment Type: ';
        //  $message .= $order->payment_type;
        //  $message .= '<br>';

        //  $message .= 'Total (USD): ';
        //  $message .= $order->amount;
        //  $message .= '<br>';

        //  $message .= 'Order Date: ';
        //  $message .= $order_date_format;
        //  $message .= '<br>';

        //  $message .= 'Cancel Date: ';
        //  $message .= $order->cancel_date;
        //  $message .= '<br>';

        //  Mail::to($first_admin_user->email)->send(new WebsiteMail($subject, $message));

        //Notification To Admin
        Notification::send($all_admin_user, new CancelOrderNotification($request));
        return redirect()->route('user.order.page')->with($notification);
    } //End Method
}

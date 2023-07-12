<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\CancelOrder;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\User;
use App\Notifications\CancelOrderNotification;
use App\Notifications\ReturnOrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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

        //Notification To Admin
        Notification::send($all_admin_user, new ReturnOrderNotification($request));

        $notification = array(
            'message' => 'Submit Order Return Request Successfully!',
            'alert-type' => 'success',
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
        $product = OrderDetails::where('order_id', $order_id)->get();
        foreach ($product as $item) {
            Product::where('id', $item->product_id)->update([
                'product_quantity' => DB::raw('product_quantity + ' . $item->quantity)
            ]);
        }
        Order::findOrFail($order_id)->update([
            'cancel_date' => Carbon::now()->format('d-m-Y H:i:s'),
            'cancel_order_status' => 1,
        ]);
        $order = Order::where('id', $order_id)->first();
        //Mail To Customer
        $subject = 'Order has been canceled successfully';

        $message = 'If you need assistance please contact us via: <br>';
        $message .= 'Call the hotline number: 1900 999 <br>';
        $message .= 'Or send an email to the address: support.nestshop@gmail.com <br>';
        $message .= 'Best regards, <br>';

        Mail::to($order->email)->send(new CancelOrder($subject, $message, $order));

        $notification = array(
            'message' => 'Order Canceled Successfully!!',
            'alert-type' => 'success'
        );

        //Notification To Admin
        Notification::send($all_admin_user, new CancelOrderNotification($request));
        return redirect()->route('user.order.page')->with($notification);
    } //End Method
}

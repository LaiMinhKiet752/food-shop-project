<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\ReturnOrder;
use App\Mail\WebsiteMail;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ReturnController extends Controller
{
    public function ReturnRequest()
    {
        $orders = Order::where('return_order_status', 1)->orderBy('return_date', 'DESC')->get();
        return view('backend.return_order.return_request', compact('orders'));
    } //End Method

    public function ReturnRequestApproved($order_id)
    {
        Order::where('id', $order_id)->update([
            'return_order_status' => 2,
        ]);

        $order = Order::where('id', $order_id)->first();

        //Mail To Customer
        $subject = 'Invoice has been returned successfully';

        $message = 'If you need assistance please contact us via: <br>';
        $message .= 'Call the hotline number: 1900 999 <br>';
        $message .= 'Or send an email to the address: support.nestshop@gmail.com <br>';
        $message .= 'Best regards, <br>';

        Mail::to($order->email)->send(new ReturnOrder($subject, $message, $order));

        $notification = array(
            'message' => 'Approved Return Order Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } //End Method

    public function CompleteReturnRequest()
    {
        $orders = Order::where('return_order_status', 2)->orderBy('return_date', 'DESC')->get();
        return view('backend.return_order.complete_return_request', compact('orders'));
    } //End Method

    public function ReturnOrderDetails($order_id)
    {
        $order = Order::with('city', 'district', 'commune', 'user')->where('id', $order_id)->first();
        $orderItem = OrderDetails::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        return view('backend.return_order.return_order_details', compact('order', 'orderItem'));
    } // End Method

    public function UpdateStatusReturnOrder($id)
    {
        DB::table('notifications')->where('id', $id)->update(['status' => 1]);
        return response()->json([
            'success' => 'OK!'
        ]);
    } // End Method
}

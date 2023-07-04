<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\WebsiteMail;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CancelController extends Controller
{
    public function CancelRequest()
    {
        $orders = Order::where('cancel_order_status', 1)->orderBy('cancel_date', 'DESC')->get();
        return view('backend.cancel_order.cancel_request', compact('orders'));
    } //End Method

    public function CancelRequestApproved($order_id)
    {
        Order::where('id', $order_id)->update([
            'cancel_order_status' => 2,
        ]);
        $order = Order::where('id', $order_id)->first();
        $order_date_format = date('d-m-Y H:i:s',strtotime($order->order_date));

        //Mail To Customer
        $subject = 'Invoice has been canceled successfully';
        $message = 'Invoice information: <br><br>';

        $message .= 'Order Number: ';
        $message .= $order->order_number;
        $message .= '<br>';

        $message .= 'Invoice Number: ';
        $message .= $order->invoice_number;
        $message .= '<br>';

        $message .= 'Full Name: ';
        $message .= $order->name;
        $message .= '<br>';

        $message .= 'Email: ';
        $message .= $order->email;
        $message .= '<br>';

        $message .= 'Phone Number: ';
        $message .= $order->phone;
        $message .= '<br>';

        $message .= 'Payment Method: ';
        $message .= $order->payment_method;
        $message .= '<br>';

        $message .= 'Payment Type: ';
        $message .= $order->payment_type;
        $message .= '<br>';

        $message .= 'Total (USD): ';
        $message .= $order->amount;
        $message .= '<br>';

        $message .= 'Order Date: ';
        $message .= $order_date_format;
        $message .= '<br>';

        $message .= 'Cancel Date: ';
        $message .= $order->cancel_date;
        $message .= '<br><br>';

        $message .= 'If you need assistance please contact us via: <br>';
        $message .= 'Call the hotline number: 1900 999 <br>';
        $message .= 'Or send an email to the address: support.nestshop@gmail.com <br>';
        $message .= 'Best regards, <br>';
        $message .= 'Nest Shop';

        Mail::to($order->email)->send(new WebsiteMail($subject, $message));

        $notification = array(
            'message' => 'Approved Cancel Order Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } //End Method

    public function CompleteCancelRequest()
    {
        $orders = Order::where('cancel_order_status', 2)->orderBy('cancel_date', 'DESC')->get();
        return view('backend.cancel_order.complete_cancel_request', compact('orders'));
    } //End Method

    public function CancelOrderDetails($order_id)
    {
        $order = Order::with('city', 'district', 'commune', 'user')->where('id', $order_id)->first();
        $orderItem = OrderDetails::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        return view('backend.cancel_order.cancel_order_details', compact('order', 'orderItem'));
    } // End Method
}

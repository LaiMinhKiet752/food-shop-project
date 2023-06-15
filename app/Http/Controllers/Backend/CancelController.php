<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;

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

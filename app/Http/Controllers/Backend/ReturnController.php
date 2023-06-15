<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;

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
}

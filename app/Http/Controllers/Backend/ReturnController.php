<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
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
}

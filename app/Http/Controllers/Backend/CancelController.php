<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\CancelOrder;
use App\Mail\WebsiteMail;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CancelController extends Controller
{
    public function CompleteCancelRequest()
    {
        $orders = Order::where('cancel_order_status', 1)->orderBy('cancel_date', 'DESC')->get();
        return view('backend.cancel_order.complete_cancel_request', compact('orders'));
    } //End Method

    public function CancelOrderDetails($order_id)
    {
        $order = Order::with('user')->where('id', $order_id)->first();
        $orderItem = OrderDetails::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        return view('backend.cancel_order.cancel_order_details', compact('order', 'orderItem'));
    } // End Method

    public function UpdateStatusCancelOrder($id)
    {
        DB::table('notifications')->where('id', $id)->update(['status' => 1]);
        return response()->json([
            'success' => 'OK!'
        ]);
    } // End Method
}

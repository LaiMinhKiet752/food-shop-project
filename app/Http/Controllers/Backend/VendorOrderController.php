<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetails;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class VendorOrderController extends Controller
{
    public function VendorOrder()
    {
        $id = Auth::user()->id;
        $orderdetails = OrderDetails::with('order')->where('vendor_id', $id)->orderBy('id', 'DESC')->select('order_id')->groupBy('order_id')->get();
        return view('vendor.backend.orders.all_orders', compact('orderdetails'));
    } // End Method

    public function VendorOrderDetails($order_id)
    {
        $order = Order::with('city', 'district', 'commune', 'user')->where('id', $order_id)->first();
        $orderItem = OrderDetails::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        return view('vendor.backend.orders.vendor_order_details', compact('order', 'orderItem'));
    } // End Method

    public function VendorReturnOrder()
    {
        $id = Auth::user()->id;
        $orderdetails = OrderDetails::with('order')->where('vendor_id', $id)->orderBy('id', 'DESC')->select('order_id')->groupBy('order_id')->get();
        return view('vendor.backend.orders.return_orders', compact('orderdetails'));
    } // End Method

    public function VendorReturnOrderDetails($order_id)
    {
        $order = Order::with('city', 'district', 'commune', 'user')->where('id', $order_id)->first();
        $orderItem = OrderDetails::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        return view('vendor.backend.orders.return_order_details', compact('order', 'orderItem'));
    } // End Method

    public function VendorCompleteReturnOrder()
    {
        $id = Auth::user()->id;
        $orderdetails = OrderDetails::with('order')->where('vendor_id', $id)->orderBy('id', 'DESC')->select('order_id')->groupBy('order_id')->get();
        return view('vendor.backend.orders.complete_return_orders', compact('orderdetails'));
    } // End Method

    public function VendorCancelOrder()
    {
        $id = Auth::user()->id;
        $orderdetails = OrderDetails::with('order')->where('vendor_id', $id)->orderBy('id', 'DESC')->select('order_id')->groupBy('order_id')->get();
        return view('vendor.backend.orders.cancel_orders', compact('orderdetails'));
    } // End Method

    public function VendorCancelOrderDetails($order_id)
    {
        $order = Order::with('city', 'district', 'commune', 'user')->where('id', $order_id)->first();
        $orderItem = OrderDetails::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        return view('vendor.backend.orders.cancel_order_details', compact('order', 'orderItem'));
    } // End Method

    public function VendorCompleteCancelOrder()
    {
        $id = Auth::user()->id;
        $orderdetails = OrderDetails::with('order')->where('vendor_id', $id)->orderBy('id', 'DESC')->select('order_id')->groupBy('order_id')->get();
        return view('vendor.backend.orders.complete_cancel_orders', compact('orderdetails'));
    } // End Method
}

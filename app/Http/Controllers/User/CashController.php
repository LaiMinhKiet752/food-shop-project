<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetails;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CashController extends Controller
{
    public function CashOrder(Request $request)
    {
        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
            $discount_percent = Session::get('coupon')['coupon_discount'];
            $discount_amount = Session::get('coupon')['discount_amount'];
        } else {
            $total_amount = round(Cart::total());
            $discount_amount = 0;
            $discount_percent = 0;
        }

        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'city_id' => $request->city_id,
            'district_id' => $request->district_id,
            'commune_id' => $request->commune_id,

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'post_code' => $request->post_code,
            'notes' => $request->notes,

            'payment_type' => 'Cash On Delivery',
            'payment_method' => 'Cash On Delivery',
            'currency' => 'usd',
            'amount' => $total_amount,
            'discount' => $discount_amount,
            'order_number' => hexdec(uniqid()),

            'invoice_number' => 'NFS' . mt_rand(1000000000, 10000000000),
            'order_date' => Carbon::now()->format('d F Y H:i:s'),
            'order_day' => Carbon::now()->format('d'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'pending',
            'created_at' => Carbon::now(),
        ]);
        $carts = Cart::content();
        foreach ($carts as $cart) {
            OrderDetails::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'brand_id' => $cart->options->brand_id,
                'vendor_id' => $cart->options->vendor_id,
                'price' => $cart->price,
                'quantity' => $cart->qty,
                'discount' => ($cart->price * $discount_percent / 100),
                'total' => $discount_percent == 0 ? ($cart->price * $cart->qty) : ($cart->price * $cart->qty * $discount_percent / 100),
                'created_at' => Carbon::now(),
            ]);
        }
        //Send Mail
        $order = Order::with('city', 'district', 'commune', 'user')->where('id', $order_id)->where('user_id', Auth::id())->first();
        $orderItem = OrderDetails::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        $subject = 'Nest Food Shop';
        Mail::to($request->email)->send(new OrderMail($order, $orderItem, $discount_amount, $subject));

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        Cart::destroy();
        $notification = array(
            'cash_order_success' => 'success',
        );
        return redirect()->route('dashboard')->with($notification);
    } //End Method
}

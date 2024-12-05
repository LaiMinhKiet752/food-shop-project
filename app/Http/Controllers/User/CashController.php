<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\CouponUse;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderCompleteNotification;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CashController extends Controller
{
    public function CashOrder(Request $request)
    {
        $user = User::where('role', 'admin')->get();
        if (Session::has('coupon')) {
            CouponUse::insert([
                'coupon_code' => Session::get('coupon')['coupon_code'],
                'user_id' => Auth::id(),
                'created_at' => Carbon::now()
            ]);
            $total_amount = Session::get('coupon')['total_amount'];
            $discount_amount = Session::get('coupon')['discount_amount'];
        } else {
            $total_amount = round(Cart::total(), 2);
            $discount_amount = 0;
        }

        if (Cart::total() < 200000) {
            $total_amount = $total_amount + 25000;
        }

        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'post_code' => $request->post_code,
            'notes' => $request->notes,

            'payment_type' => 'Thanh toán khi nhận hàng',
            'payment_method' => 'Thanh toán khi nhận hàng',
            'currency' => 'VND',
            'amount' => $total_amount,
            'discount' => $discount_amount,
            'order_number' => hexdec(uniqid()),

            'invoice_number' => 'BL' . time() .  mt_rand(100000, 1000000),
            'order_date' => Carbon::now()->format('d-m-Y H:i:s'),
            'order_day' => Carbon::now()->format('d'),
            'order_month' => Carbon::now()->format('m'),
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
                'price' => $cart->price,
                'quantity' => $cart->qty,
                'created_at' => Carbon::now(),
            ]);
        }
        $product = OrderDetails::where('order_id', $order_id)->get();
        foreach ($product as $item) {
            Product::where('id', $item->product_id)->update([
                'product_quantity' => DB::raw('product_quantity - ' . $item->quantity)
            ]);
        }

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        Cart::destroy();
        $notification = array(
            'cash_order_success' => 'success',
        );
        Notification::send($user, new OrderCompleteNotification($request->name));
        return redirect()->route('dashboard')->with($notification);
    } //End Method
}

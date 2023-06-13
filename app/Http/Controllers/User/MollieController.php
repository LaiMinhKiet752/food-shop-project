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
use Mollie\Laravel\Facades\Mollie;

class MollieController extends Controller
{
    public function MollieOrder(Request $request)
    {
        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
            $discount_amount = Session::get('coupon')['discount_amount'];
        } else {
            $total_amount = round(Cart::total());
            $discount_amount = 0;
        }
        $total_amount_convert_to_eur = 0.93 * $total_amount;

        $payment = Mollie::api()->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => number_format($total_amount_convert_to_eur, 2, '.', ''),
            ],
            "description" => "Nest Food Shop",
            "redirectUrl" => route('mollie.success'),
            'cancelUrl' => route('mollie.cancel'),
            "metadata" => [
                "order_id" => hexdec(uniqid()),
            ],
        ]);
        // dd($payment);

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

            'payment_type' => 'Credit Card',
            'payment_method' => 'Mollie Payment',
            'transaction_id' => $payment->id,
            'currency' => 'usd',
            'amount' => $total_amount,
            'order_number' => $payment->metadata->order_id,

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
                'quantity' => $cart->qty,
                'price' => $cart->price,
                'created_at' => Carbon::now(),
            ]);
        }
        
        //Send Mail
        $order = Order::with('city', 'district', 'commune', 'user')->where('id', $order_id)->where('user_id', Auth::id())->first();
        $orderItem = OrderDetails::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        $subject = 'Nest Food Shop';
        Mail::to($request->email)->send(new OrderMail($order, $orderItem, $discount_amount, $subject));

        // redirect customer to Mollie checkout page
        return redirect($payment->getCheckoutUrl(), 303);
    } //End Method

    public function MollieSuccess()
    {
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        Cart::destroy();
        $notification = array(
            'order_success' => 'success',
        );
        return redirect()->route('dashboard')->with($notification);
    } //End Method

    public function MollieCancel()
    {
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        Cart::destroy();
        $notification = array(
            'order_cancel' => 'cancel',
        );
        return redirect()->route('dashboard')->with($notification);
    } //End Method
}

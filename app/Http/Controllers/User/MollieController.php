<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderCompleteNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Mollie\Laravel\Facades\Mollie;

class MollieController extends Controller
{
    public function MollieOrder(Request $request)
    {
        $user = User::where('role','admin')->get();
        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
            $discount_amount = Session::get('coupon')['discount_amount'];
        } else {
            $total_amount = round(Cart::total(), 2);
            $discount_amount = 0;
        }
        $total_amount_convert_to_eur = 0.93 * $total_amount;

        $payment = Mollie::api()->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => number_format($total_amount_convert_to_eur, 2, '.', ''),
            ],
            "description" => "Nest Shop",
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

            'payment_type' => 'Credit Cards',
            'payment_method' => 'Mollie Payment',
            'transaction_id' => $payment->id,
            'currency' => 'usd',
            'amount' => $total_amount,
            'discount' => $discount_amount,
            'order_number' => $payment->metadata->order_id,

            'invoice_number' => 'NFS' . mt_rand(1000000000, 10000000000),
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
        //Send Mail
        $order = Order::with('city', 'district', 'commune', 'user')->where('id', $order_id)->where('user_id', Auth::id())->first();
        $orderItem = OrderDetails::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        $subject = 'Nest Shop';
        Mail::to($request->email)->send(new OrderMail($order, $orderItem, $discount_amount, $subject));

        //Notification To Admin
        Notification::send($user, new OrderCompleteNotification($request->name));

        // Redirect customer to Mollie checkout page
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

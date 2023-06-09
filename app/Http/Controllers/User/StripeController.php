<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{
    public function StripeOrder(Request $request)
    {
        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        } else {
            $total_amount = round(Cart::total());
        }
        \Stripe\Stripe::setApiKey('sk_test_51NFyfzAJXTVnrBbylAMd43EhMSyIqK8pkHER6ozicNfsxisCUJo10nOhRTTsefPQFxwcq1MP57ay1mkFEqhqSYZ400zve8G2pJ');

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
            'amount' => $total_amount * 100,
            'currency' => 'usd',
            'description' => 'Nest Food Shop',
            'source' => $token,
            'metadata' => ['order_id' => hexdec(uniqid())],
        ]);
        // dd($charge);
        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'city_id' => $request->city_id,
            'district_id' => $request->division_id,
            'commune_id' => $request->commune_id,

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'post_code' => $request->post_code,
            'notes' => $request->notes,

            'payment_type' => '',
            'payment_method ' => '',
            'transaction_id' => '',
            'currency' => '',
            'amount' => '',
            'order_number' => '',

            'invoice_number' => '',
            'order_date' => '',
            'order_month' => '',
            'order_year' => '',
            'confirmed_date' => '',

            'processing_date' => '',
            'picked_date' => '',
            'shipped_date' => '',
            'delivered_date' => '',
            'cancel_date' => '',
            'return_date' => '',
            'return_reason' => '',
            'status' => '',
            'created_at' => Carbon::now()
        ]);
    } //End Method
}

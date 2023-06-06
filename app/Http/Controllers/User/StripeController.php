<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function StripeOrder(Request $request)
    {
        \Stripe\Stripe::setApiKey('sk_test_51NFyfzAJXTVnrBbylAMd43EhMSyIqK8pkHER6ozicNfsxisCUJo10nOhRTTsefPQFxwcq1MP57ay1mkFEqhqSYZ400zve8G2pJ');

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
            'amount' => 999*100,
            'currency' => 'usd',
            'description' => 'Nest Food Shop',
            'source' => $token,
            'metadata' => ['order_id' => '6735'],
        ]);
        dd($charge);
    } //End Method
}

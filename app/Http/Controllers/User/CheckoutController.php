<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShipCommune;
use App\Models\ShipDistricts;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function DistrictGetAjax($city_id)
    {
        $ship = ShipDistricts::where('city_id', $city_id)->orderBy('district_name', 'ASC')->get();
        return json_encode($ship);
    } //End Method

    public function CommuneGetAjax($district_id)
    {
        $ship = ShipCommune::where('district_id', $district_id)->orderBy('commune_name', 'ASC')->get();
        return json_encode($ship);
    } //End Method

    public function CheckoutStore(Request $request)
    {
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_address'] = $request->shipping_address;
        $data['post_code'] = $request->post_code;
        $data['notes'] = $request->notes;

        $data['city_id'] = $request->city_id;
        $data['district_id'] = $request->district_id;
        $data['commune_id'] = $request->commune_id;

        $cartTotal = Cart::total();

        if ($request->payment_option == 'stripe') {
            return view('frontend.payment.stripe', compact('data', 'cartTotal'));
        } else if ($request->payment_option == 'card') {
            return 'Cart Page';
        } else {
            return view('frontend.payment.cash', compact('data', 'cartTotal'));
        }
    } //End Method
}

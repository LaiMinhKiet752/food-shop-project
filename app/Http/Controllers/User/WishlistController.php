<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function addToWishList(Request $request, $product_id)
    {
        if (Auth::check()) {
            $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $product_id)->first();
            if (!$exists) {
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => Carbon::now(),
                ]);
                return response()->json(['success' => 'Successfully Added On Your Wishlist!']);
            } else {
                return response()->json(['error' => 'This Product Is Already In Your Wishlist!']);
            }
        } else {
            return response()->json(['error' => 'At First Login Your Account!']);
        }
    } //End Method

    public function AllWishList()
    {
        return view('frontend.wishlist.view_wishlist');
    } //End Method

    public function GetWishListProduct()
    {
        $wishlist = Wishlist::with('product')->where('user_id', Auth::id())->latest()->get();
        $wishlistQuantity = wishlist::count();
        return response()->json([
            'wishlist' => $wishlist,
            'wishlistQuantity' => $wishlistQuantity
        ]);
    } //End Method
}

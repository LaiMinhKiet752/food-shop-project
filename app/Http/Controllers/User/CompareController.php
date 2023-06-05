<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Compare;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CompareController extends Controller
{
    public function addToCompare(Request $request, $product_id)
    {
        if (Auth::check()) {
            $exists = Compare::where('user_id', Auth::id())->where('product_id', $product_id)->first();
            if (!$exists) {
                Compare::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => Carbon::now(),
                ]);
                return response()->json(['success' => 'Successfully Added On Your List Compare!']);
            } else {
                return response()->json(['error' => 'This Product Is Already In Your List Compare!']);
            }
        } else {
            return response()->json(['error' => 'Please Login Before Adding Products To List Compare!']);
        }
    } //End Method

    public function AllCompare()
    {
        return view('frontend.compare.view_compare');
    } //End Method

    public function GetCompareProduct()
    {
        $compare = Compare::with('product')->where('user_id', Auth::id())->latest()->limit(5)->get();
        $compareQuantity = Compare::count();
        return response()->json([
            'compare' => $compare,
            'compareQuantity' => $compareQuantity
        ]);
    } //End Method

    public function CompareRemove($id)
    {
        Compare::where('user_id', Auth::id())->where('id', $id)->delete();
        return response()->json([
            'success' => 'Successfully Removed Product From Your List Compare!'
        ]);
    } //End Method
}

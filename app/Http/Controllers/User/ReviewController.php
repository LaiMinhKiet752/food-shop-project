<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function StoreReview(Request $request)
    {
        $product_id = $request->review_product_id;
        $vendor_id = $request->review_vendor_id;

        Review::insert([
            'product_id' => $product_id,
            'user_id' => Auth::user()->id,
            'comment' => $request->comment,
            'rating' => $request->quality,
            'vendor_id' => $vendor_id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Review Will Be Approved By Admin!',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    } //End Method
}

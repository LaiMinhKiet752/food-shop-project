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

    public function PendingReview()
    {
        $review = Review::where('status', 0)->latest()->get();
        return view('backend.review.pending_review', compact('review'));
    } //End Method

    public function ReviewDetails($id)
    {
        $review = Review::where('id', $id)->latest()->first();
        return view('backend.review.details_review', compact('review'));
    } //End Method

    public function ReviewApprove(Request $request)
    {
        $id = $request->id;
        Review::findOrFail($id)->update([
            'status' => 1,
        ]);
        $notification = array(
            'message' => 'Review Approved Successfully!',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.pending.review')->with($notification);
    } //End Method

    public function PublishReview()
    {
        $review = Review::where('status', 1)->latest()->get();
        return view('backend.review.publish_review', compact('review'));
    } //End Method

    public function ReviewDelete($id)
    {
        Review::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Review Deleted Successfully!',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    } //End Method

    public function VendorAllReview()
    {
        $id = Auth::user()->id;
        $review = Review::where('vendor_id', $id)->where('status', 1)->latest()->get();
        return view('vendor.backend.review.approve_review', compact('review'));
    } //End Method

    public function VendorReviewDetails($id)
    {
        $review = Review::where('id', $id)->latest()->first();
        return view('vendor.backend.review.details_review', compact('review'));
    } //End Method
}

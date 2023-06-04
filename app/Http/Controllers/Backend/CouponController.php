<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Carbon\Carbon;

class CouponController extends Controller
{
    public function AllCoupon()
    {
        $coupon = Coupon::latest()->get();
        return view('backend.coupon.coupon_all', compact('coupon'));
    } // End Method

    public function AddCoupon()
    {
        return view('backend.coupon.coupon_add');
    } // End Method

    public function StoreCoupon(Request $request)
    {
        $request->validate([
            'coupon_code' => 'unique:coupons',
        ], [
            'coupon_code.unique' => 'Coupon name already exists.',
        ]);
        Coupon::insert([
            'coupon_code' => strtoupper($request->coupon_code),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Coupon Inserted Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('all.coupon')->with($notification);
    } //End Method

    public function EditCoupon($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('backend.coupon.coupon_edit', compact('coupon'));
    } // End Method

    public function UpdateCoupon(Request $request)
    {
        $coupon_id = $request->id;
        $current_coupon_code = Coupon::findOrFail($coupon_id)->coupon_code;

        if ($current_coupon_code == $request->coupon_code) {
            Coupon::findOrFail($coupon_id)->update([
                'coupon_discount' => $request->coupon_discount,
                'coupon_validity' => $request->coupon_validity,
            ]);

            $notification = array(
                'message' => 'Coupon Updated Successfully!',
                'alert-type' => 'success'
            );
            return redirect()->route('all.coupon')->with($notification);
        } else {
            $request->validate([
                'coupon_code' => 'unique:coupons',
            ], [
                'coupon_code.unique' => 'Coupon name already exists.',
            ]);
            Coupon::findOrFail($coupon_id)->update([
                'coupon_code' => strtoupper($request->coupon_code),
                'coupon_discount' => $request->coupon_discount,
                'coupon_validity' => $request->coupon_validity,
            ]);

            $notification = array(
                'message' => 'Coupon Updated Successfully!',
                'alert-type' => 'success'
            );
            return redirect()->route('all.coupon')->with($notification);
        }
    } // End Method

    public function DeleteCoupon($id)
    {
        Coupon::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Coupon Deleted Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // End Method
}

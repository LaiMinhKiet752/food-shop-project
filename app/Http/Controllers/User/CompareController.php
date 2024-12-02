<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Compare;
use Illuminate\Http\Request;
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
                return response()->json(['success' => 'Đã thêm sản phẩm vào danh sách so sánh!']);
            } else {
                return response()->json(['error' => 'Sản phẩm đã nằm trong danh sách so sánh!']);
            }
        } else {
            return response()->json(['error' => 'Vui lòng đăng nhập để có thể so sánh sản phẩm!']);
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
            'success' => 'Đã xóa sản phẩm khỏi danh sách so sánh!'
        ]);
    } //End Method
}

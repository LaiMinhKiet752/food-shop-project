<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\CouponUse;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function AddMiniCart()
    {
        $carts = Cart::content();
        $cartQty = Cart::content()->count();
        $cartTotal = Cart::total();
        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal
        ));
    } // End Method

    public function AddProductToCart(Request $request, $id)
    {
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        $get_product = Product::where('id', $id)->first();
        $product_quantity_stock = $get_product->product_quantity;
        if ($request->quantity > $product_quantity_stock) {
            return response()->json(['error_quantity' => "Hiện tại chỉ còn $product_quantity_stock sản phẩm trong kho"]);
        }
        $check = Cart::content()->where('id', $id)->first();
        $count = 0;
        $check_add = 0;
        if ($check) {
            $count = $check->qty;
            $check_add = $request->quantity + $count;
        }
        if ($count > $product_quantity_stock) {
            return response()->json(['error_quantity' => "Hiện tại chỉ còn $product_quantity_stock sản phẩm trong kho"]);
        }
        if ($check_add > $product_quantity_stock) {
            return response()->json(['error_quantity' => "Hiện tại chỉ còn $product_quantity_stock sản phẩm trong kho"]);
        }

        $product = Product::findOrFail($id);
        if ($product->discount_price == NULL) {
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => ['image' => $product->product_thumbnail, 'brand_id' => $request->brand_id],
            ]);
            return response()->json(['success' => 'Đã thêm sản phẩm vào giỏ hàng của bạn!']);
        } else {
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => ['image' => $product->product_thumbnail, 'brand_id' => $request->brand_id],
            ]);
            return response()->json(['success' => 'Đã thêm sản phẩm vào giỏ hàng của bạn!']);
        }
    } //End Method

    public function MyCart()
    {
        return view('frontend.mycart.view_mycart');
    } //End Method

    public function GetCartProduct()
    {
        $carts = Cart::content();
        $cartQty = Cart::content()->count();
        $cartTotal = Cart::total();
        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal
        ));
    } //End Method

    public function RemoveMiniCart($rowId)
    {
        Cart::remove($rowId);
        if (Session::has('coupon')) {
            $coupon_code = Session::get('coupon')['coupon_code'];
            $coupon = Coupon::where('coupon_code', $coupon_code)->first();

            Session::put('coupon', [
                'coupon_code' => $coupon->coupon_code,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100, 2),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100, 2)
            ]);
        }
        return response()->json(['success' => 'Đã xóa sản phẩm khỏi giỏ hàng của bạn!']);
    } // End Method

    public function CartRemove($rowId)
    {
        Cart::remove($rowId);
        if (Session::has('coupon')) {
            $coupon_code = Session::get('coupon')['coupon_code'];
            $coupon = Coupon::where('coupon_code', $coupon_code)->first();

            Session::put('coupon', [
                'coupon_code' => $coupon->coupon_code,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100, 2),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100, 2)
            ]);
        }
        return response()->json(['success' => 'Đã xóa sản phẩm khỏi giỏ hàng của bạn!']);
    } //End Method

    public function CartRemoveAllProduct()
    {
        Cart::destroy();
        Session::forget('coupon');
        return redirect()->back();
    } //End Method

    public function CartDecrement($rowId)
    {
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);

        if (Session::has('coupon')) {
            $coupon_code = Session::get('coupon')['coupon_code'];
            $coupon = Coupon::where('coupon_code', $coupon_code)->first();

            Session::put('coupon', [
                'coupon_code' => $coupon->coupon_code,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100, 2),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100, 2)
            ]);
        }
        return response()->json('Decrement');
    } // End Method

    public function CartIncrement($rowId)
    {
        $row = Cart::get($rowId);
        $product_id = $row->id;
        $get_product_quantity_in_cart = $row->qty;
        $get_product = Product::where('id', $product_id)->first();
        $product_quantity_stock = $get_product->product_quantity;
        if ($product_quantity_stock == $get_product_quantity_in_cart) {
            return response()->json(['error_quantity' => "Hiện tại chỉ còn $product_quantity_stock sản phẩm trong kho"]);
        }

        Cart::update($rowId, $row->qty + 1);

        if (Session::has('coupon')) {
            $coupon_code = Session::get('coupon')['coupon_code'];
            $coupon = Coupon::where('coupon_code', $coupon_code)->first();

            Session::put('coupon', [
                'coupon_code' => $coupon->coupon_code,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100, 2),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100, 2)
            ]);
        }
        return response()->json('Increment');
    } //End Method

    public function CouponApply(Request $request)
    {
        if (Auth::check()) {
            $check = CouponUse::where('coupon_code', $request->coupon_code)->where('user_id', Auth::user()->id)->first();
            if ($check) {
                return response()->json(['error' => 'Mã giảm giá đã được sử dụng!']);
            } else {
                $coupon = Coupon::where('coupon_code', $request->coupon_code)->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))->first();
                if ($coupon) {
                    Session::put('coupon', [
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_discount' => $coupon->coupon_discount,
                        'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100, 2),
                        'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100, 2)
                    ]);
                    return response()->json(array(
                        'success' => 'Đã áp dụng mã giảm giá!'
                    ));
                } else {
                    return response()->json(['error' => 'Mã giảm giá không hợp lệ!']);
                }
            }
        } else {
            return response()->json(['error' => 'Vui lòng đăng nhập để sử dụng mã giảm giá!']);
        }
    } // End Method

    public function CouponCalculation()
    {
        if (Session::has('coupon')) {
            return response()->json(array(
                'subtotal' => Cart::total(),
                'coupon_code' => session()->get('coupon')['coupon_code'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ));
        } else {
            return response()->json(array(
                'total' => Cart::total(),
            ));
        }
    } // End Method

    public function CouponRemove()
    {
        Session::forget('coupon');
        return response()->json(array(
            'success' => 'Đã xóa mã giảm giá!'
        ));
    } // End Method

    public function CheckoutCreate()
    {
        if (Auth::check()) {
            if (Cart::total() > 0) {
                $carts = Cart::content();
                $cartQty = Cart::content()->count();
                $cartTotal = Cart::total();
                return view('frontend.checkout.checkout_view', compact('carts', 'cartQty', 'cartTotal'));
            } else {
                $notification = array(
                    'message' => 'Giỏ hàng đang trống. Vui lòng chọn sản phẩm để mua!',
                    'alert-type' => 'error',
                );
                return redirect()->to('/')->with($notification);
            }
        } else {
            $notification = array(
                'message' => 'Đầu tiên bạn cần đăng nhập vào trang web để tiến hàng thanh toán!',
                'alert-type' => 'warning',
            );
            return redirect()->route('login')->with($notification);
        }
    } // End Method
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function AddMiniCart()
    {
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();
        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal
        ));
    } // End Method
    
    public function AddToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        if ($product->discount_price == NULL || $product->discount_price == 0) {
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => ['image' => $product->product_thumbnail],
            ]);
            return response()->json(['success' => 'Successfully Added Product To Cart!']);
        } else {
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => ['image' => $product->product_thumbnail],
            ]);
            return response()->json(['success' => 'Successfully Added Product To Cart!']);
        }
    } //End Method

    public function AddToCartDetails(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        if ($product->discount_price == NULL || $product->discount_price == 0) {
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => ['image' => $product->product_thumbnail],
            ]);
            return response()->json(['success' => 'Successfully Added Product To Cart!']);
        } else {
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => ['image' => $product->product_thumbnail],
            ]);
            return response()->json(['success' => 'Successfully Added Product To Cart!']);
        }
    } // End Method

    public function AddToCartHomeNewProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        if ($product->discount_price == NULL || $product->discount_price == 0) {
            Cart::add([
                'id' => $id,
                'name' => $product->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => ['image' => $product->product_thumbnail],
            ]);
            return response()->json(['success' => 'Successfully Added Product To Cart!']);
        } else {
            Cart::add([
                'id' => $id,
                'name' => $product->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => ['image' => $product->product_thumbnail],
            ]);
            return response()->json(['success' => 'Successfully Added Product To Cart!']);
        }
    } // End Method

    public function AddToCartHomeNewProductCategory(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        if ($product->discount_price == NULL || $product->discount_price == 0) {
            Cart::add([
                'id' => $id,
                'name' => $product->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => ['image' => $product->product_thumbnail],
            ]);
            return response()->json(['success' => 'Successfully Added Product To Cart!']);
        } else {
            Cart::add([
                'id' => $id,
                'name' => $product->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => ['image' => $product->product_thumbnail],
            ]);
            return response()->json(['success' => 'Successfully Added Product To Cart!']);
        }
    } // End Method

    public function AddToCartFeaturedProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        if ($product->discount_price == NULL || $product->discount_price == 0) {
            Cart::add([
                'id' => $id,
                'name' => $product->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => ['image' => $product->product_thumbnail],
            ]);
            return response()->json(['success' => 'Successfully Added Product To Cart!']);
        } else {
            Cart::add([
                'id' => $id,
                'name' => $product->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => ['image' => $product->product_thumbnail],
            ]);
            return response()->json(['success' => 'Successfully Added Product To Cart!']);
        }
    } // End Method

    public function AddToCartCategoryProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        if ($product->discount_price == NULL || $product->discount_price == 0) {
            Cart::add([
                'id' => $id,
                'name' => $product->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => ['image' => $product->product_thumbnail],
            ]);
            return response()->json(['success' => 'Successfully Added Product To Cart!']);
        } else {
            Cart::add([
                'id' => $id,
                'name' => $product->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => ['image' => $product->product_thumbnail],
            ]);
            return response()->json(['success' => 'Successfully Added Product To Cart!']);
        }
    } // End Method

    public function AddToCartSubCategoryProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        if ($product->discount_price == NULL || $product->discount_price == 0) {
            Cart::add([
                'id' => $id,
                'name' => $product->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => ['image' => $product->product_thumbnail],
            ]);
            return response()->json(['success' => 'Successfully Added Product To Cart!']);
        } else {
            Cart::add([
                'id' => $id,
                'name' => $product->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => ['image' => $product->product_thumbnail],
            ]);
            return response()->json(['success' => 'Successfully Added Product To Cart!']);
        }
    } // End Method

    public function AddToCartVendorDetailsProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        if ($product->discount_price == NULL || $product->discount_price == 0) {
            Cart::add([
                'id' => $id,
                'name' => $product->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => ['image' => $product->product_thumbnail],
            ]);
            return response()->json(['success' => 'Successfully Added Product To Cart!']);
        } else {
            Cart::add([
                'id' => $id,
                'name' => $product->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => ['image' => $product->product_thumbnail],
            ]);
            return response()->json(['success' => 'Successfully Added Product To Cart!']);
        }
    } // End Method

    public function AddToCartCategoryOneProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        if ($product->discount_price == NULL || $product->discount_price == 0) {
            Cart::add([
                'id' => $id,
                'name' => $product->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => ['image' => $product->product_thumbnail],
            ]);
            return response()->json(['success' => 'Successfully Added Product To Cart!']);
        } else {
            Cart::add([
                'id' => $id,
                'name' => $product->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => ['image' => $product->product_thumbnail],
            ]);
            return response()->json(['success' => 'Successfully Added Product To Cart!']);
        }
    } // End Method

    public function AddToCartCategoryTwoProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        if ($product->discount_price == NULL || $product->discount_price == 0) {
            Cart::add([
                'id' => $id,
                'name' => $product->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => ['image' => $product->product_thumbnail],
            ]);
            return response()->json(['success' => 'Successfully Added Product To Cart!']);
        } else {
            Cart::add([
                'id' => $id,
                'name' => $product->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => ['image' => $product->product_thumbnail],
            ]);
            return response()->json(['success' => 'Successfully Added Product To Cart!']);
        }
    } // End Method

    public function AddToCartCategoryThreeProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        if ($product->discount_price == NULL || $product->discount_price == 0) {
            Cart::add([
                'id' => $id,
                'name' => $product->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => ['image' => $product->product_thumbnail],
            ]);
            return response()->json(['success' => 'Successfully Added Product To Cart!']);
        } else {
            Cart::add([
                'id' => $id,
                'name' => $product->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => ['image' => $product->product_thumbnail],
            ]);
            return response()->json(['success' => 'Successfully Added Product To Cart!']);
        }
    } // End Method

    public function AddToCartCategoryFourProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        if ($product->discount_price == NULL || $product->discount_price == 0) {
            Cart::add([
                'id' => $id,
                'name' => $product->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => ['image' => $product->product_thumbnail],
            ]);
            return response()->json(['success' => 'Successfully Added Product To Cart!']);
        } else {
            Cart::add([
                'id' => $id,
                'name' => $product->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => ['image' => $product->product_thumbnail],
            ]);
            return response()->json(['success' => 'Successfully Added Product To Cart!']);
        }
    } // End Method

    public function AddToCartCategoryFiveProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        if ($product->discount_price == NULL || $product->discount_price == 0) {
            Cart::add([
                'id' => $id,
                'name' => $product->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => ['image' => $product->product_thumbnail],
            ]);
            return response()->json(['success' => 'Successfully Added Product To Cart!']);
        } else {
            Cart::add([
                'id' => $id,
                'name' => $product->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => ['image' => $product->product_thumbnail],
            ]);
            return response()->json(['success' => 'Successfully Added Product To Cart!']);
        }
    } // End Method

    public function RemoveMiniCart($rowId)
    {
        Cart::remove($rowId);
        return response()->json(['success' => 'Successfully Removed Product From Cart!']);
    } // End Method
}

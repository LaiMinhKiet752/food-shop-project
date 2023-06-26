<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\MultiImage;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class IndexController extends Controller
{
    public function ProductDetails($id, $slug)
    {
        $product = Product::findOrFail($id);
        $multipleImage = MultiImage::where('product_id', $id)->get();
        $category_id = $product->category_id;
        $relatedProduct = Product::where('category_id', $category_id)->where('id', '!=', $id)->orderBy('id', 'DESC')->limit(4)->get();

        return view('frontend.product.product_details', compact('product', 'multipleImage', 'relatedProduct'));
    } //End Method

    public function Index()
    {
        $skip_category_0 = Category::skip(0)->first();
        $skip_product_0 = Product::where('status', 1)->where('category_id', $skip_category_0->id)->orderby('id', 'DESC')->limit(5)->get();

        $skip_category_1 = Category::skip(1)->first();
        $skip_product_1 = Product::where('status', 1)->where('category_id', $skip_category_1->id)->orderby('id', 'DESC')->limit(5)->get();

        $skip_category_2 = Category::skip(2)->first();
        $skip_product_2 = Product::where('status', 1)->where('category_id', $skip_category_2->id)->orderby('id', 'DESC')->limit(5)->get();

        $skip_category_3 = Category::skip(3)->first();
        $skip_product_3 = Product::where('status', 1)->where('category_id', $skip_category_3->id)->orderby('id', 'DESC')->limit(5)->get();

        $skip_category_4 = Category::skip(4)->first();
        $skip_product_4 = Product::where('status', 1)->where('category_id', $skip_category_4->id)->orderby('id', 'DESC')->limit(5)->get();

        $hot_deals = Product::where('status', 1)->where('hot_deals', 1)->where('discount_price', '!=', NULL)->where('discount_price', '!=', 0)->orderBy('id', 'DESC')->limit(3)->get();
        $special_offer = Product::where('status', 1)->where('special_offer', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $new = Product::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $special_deals = Product::where('status', 1)->where('special_deals', 1)->orderBy('id', 'DESC')->limit(3)->get();

        return view('frontend.index', compact('skip_category_0', 'skip_product_0', 'skip_category_1', 'skip_product_1', 'skip_category_2', 'skip_product_2', 'skip_category_3', 'skip_product_3', 'skip_category_4', 'skip_product_4', 'hot_deals', 'special_offer', 'new', 'special_deals'));
    } //End Method

    public function VendorDetails($id)
    {
        $vendor = User::findOrFail($id);
        $vproduct = Product::where('status', 1)->where('vendor_id', $id)->orderBy('id', 'DESC')->get();
        return view('frontend.vendor.vendor_details', compact('vendor', 'vproduct'));
    } // End Method

    public function VendorAll()
    {
        $vendors = User::where('status', 'active')->where('role', 'vendor')->orderBy('id', 'DESC')->get();
        return view('frontend.vendor.vendor_all', compact('vendors'));
    } // End Method


    public function CategoryWiseProduct(Request $request, $id, $slug)
    {
        $products = Product::where('status', 1)->where('category_id', $id)->orderBy('id', 'DESC')->get();
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $breadcategory = Category::where('id', $id)->first();
        $newProduct = Product::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        return view('frontend.product.category_view', compact('products', 'categories', 'breadcategory', 'newProduct'));
    } // End Method


    public function SubCategoryWiseProduct(Request $request, $id, $slug)
    {
        $products = Product::where('status', 1)->where('subcategory_id', $id)->orderBy('id', 'DESC')->get();
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $breadsubcategory = SubCategory::where('id', $id)->first();
        $newProduct = Product::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        return view('frontend.product.subcategory_view', compact('products', 'categories', 'breadsubcategory', 'newProduct'));
    } // End Method

    public function ProductViewAjax($id)
    {
        $product = Product::with('category', 'brand')->findOrFail($id);
        return response()->json(array(
            'product' => $product
        ));
    } // End Method

    public function ProductSearch(Request $request)
    {
        $request->validate(['search' => "required"]);

        $item = $request->search;
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $products = Product::where('product_name', 'LIKE', "%$item%")->get();
        $newProduct = Product::orderBy('id', 'DESC')->limit(3)->get();
        return view('frontend.product.search', compact('products', 'item', 'categories', 'newProduct'));
    } // End Method

    public function SearchProduct(Request $request)
    {
        $request->validate(['search' => "required"]);
        $item = $request->search;
        $products = Product::where('product_name', 'LIKE', "%$item%")->select('id', 'product_name', 'product_slug', 'product_thumbnail', 'selling_price')->limit(6)->get();
        return view('frontend.product.search_product', compact('products'));
    } // End Method
}

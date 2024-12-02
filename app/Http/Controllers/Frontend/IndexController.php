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
        return view('frontend.index');
    } //End Method

    public function CategoryWiseProduct(Request $request, $id, $slug)
    {
        $products = Product::where('status', 1)->where('category_id', $id)->orderBy('id', 'DESC')->paginate(20);
        $count_products = Product::where('status', 1)->where('category_id', $id)->orderBy('id', 'DESC')->get();
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $breadcategory = Category::where('id', $id)->first();
        $newProduct = Product::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        return view('frontend.product.category_view', compact('products', 'categories', 'breadcategory', 'newProduct', 'count_products'));
    } // End Method

    public function SubCategoryWiseProduct(Request $request, $id, $slug)
    {
        $products = Product::where('status', 1)->where('subcategory_id', $id)->orderBy('id', 'DESC')->paginate(20);
        $count_products = Product::where('status', 1)->where('subcategory_id', $id)->orderBy('id', 'DESC')->get();
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $breadsubcategory = SubCategory::where('id', $id)->first();
        $newProduct = Product::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        return view('frontend.product.subcategory_view', compact('products', 'categories', 'breadsubcategory', 'newProduct', 'count_products'));
    } // End Method

    public function ProductViewAjax($id)
    {
        $product = Product::with('category', 'subcategory', 'brand')->findOrFail($id);
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

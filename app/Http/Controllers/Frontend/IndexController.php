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

        $size = $product->product_size;
        $product_size = explode(',', $size);

        $color = $product->product_color;
        $product_color = explode(',', $color);

        return view('frontend.product.product_details', compact('product', 'product_size', 'product_color', 'multipleImage', 'relatedProduct'));
    } //End Method

    public function Index()
    {
        $skip_category_0 = Category::skip(0)->first();
        $skip_product_0 = Product::where('status', 1)->where('category_id', $skip_category_0->id)->orderby('id', 'DESC')->limit(5)->get();

        $skip_category_1 = Category::skip(1)->first();
        $skip_product_1 = Product::where('status', 1)->where('category_id', $skip_category_1->id)->orderby('id', 'DESC')->limit(5)->get();

        $skip_category_2 = Category::skip(2)->first();
        $skip_product_2 = Product::where('status', 1)->where('category_id', $skip_category_2->id)->orderby('id', 'DESC')->limit(5)->get();

        return view('frontend.index', compact('skip_category_0', 'skip_product_0', 'skip_category_1', 'skip_product_1', 'skip_category_2', 'skip_product_2'));
    } //End Method
}

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
}

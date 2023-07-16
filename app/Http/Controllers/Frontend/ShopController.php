<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function ShopPage()
    {
        $products = Product::query();
        $products = Product::where('status', 1)->orderBy('id', 'DESC')->get();
        if (!empty($_GET['brand'])) {
            $slugs = explode(',', $_GET['brand']);
            $brand_id = Brand::select('id')->whereIn('brand_slug', $slugs)->pluck('id')->toArray();
            $products = Product::whereIn('brand_id', $brand_id)->where('status', 1)->get();
        }
        if (!empty($_GET['category'])) {
            $slugs = explode(',', $_GET['category']);
            $catId = Category::select('id')->whereIn('category_slug', $slugs)->pluck('id')->toArray();
            $products = Product::whereIn('category_id', $catId)->where('status', 1)->get();
        }
        if (!empty($_GET['price'])) {
            $price = explode('-', $_GET['price']);
            $products = $products->whereBetween('selling_price', $price);
        }

        $categories = Category::orderBy('category_name', 'ASC')->get();
        $brands = Brand::orderBy('brand_name', 'ASC')->get();
        $newProduct = Product::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        return view('frontend.product.shop_page', compact('products', 'categories', 'brands', 'newProduct'));
    } //End Method

    public function ShopFilter(Request $request)
    {
        $data = $request->all();
        // dd($data);

        $catUrl = "";
        if (!empty($data['category'])) {
            foreach ($data['category'] as $category) {
                if (empty($catUrl)) {
                    $catUrl .= '&category=' . $category;
                } else {
                    $catUrl .= ',' . $category;
                }
            }
        }


        $brandUrl = "";
        if (!empty($data['brand'])) {
            foreach ($data['brand'] as $brand) {
                if (empty($brandUrl)) {
                    $brandUrl .= '&brand=' . $brand;
                } else {
                    $brandUrl .= ',' . $brand;
                }
            }
        }

        $pricerangeUrl = "";
        if (!empty($data['price_range'])) {
            $pricerangeUrl .= '&price=' . $data['price_range'];
        }

        return redirect()->route('shop.page', $catUrl . $brandUrl . $pricerangeUrl);
    } //End Method
}

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

        if (!empty($_GET['category'])) {
            $slugs = explode(',', $_GET['category']);
            $catId = Category::select('id')->whereIn('category_slug', $slugs)->pluck('id')->toArray();
            $products = $products->whereIn('category_id', $catId)->where('status', 1)->paginate(5);
        }
        if (!empty($_GET['brand'])) {
            $slugs = explode(',', $_GET['brand']);
            $brand_id = Brand::select('id')->whereIn('brand_slug', $slugs)->pluck('id')->toArray();
            $products = $products->whereIn('brand_id', $brand_id)->where('status', 1)->paginate(5);
        }
        if (!empty($_GET['price'])) {
            $price = explode('-', $_GET['price']);
            $products = $products->whereBetween('selling_price', $price)->paginate(2);
        } else if (empty($_GET['brand']) && empty($_GET['category']) && empty($_GET['price'])) {
            $products = Product::where('status', 1)->orderBy('id', 'DESC')->paginate(10);
        }

        $categories = Category::orderBy('category_name', 'ASC')->get();
        $brands = Brand::orderBy('brand_name', 'ASC')->get();
        $newProduct = Product::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        return view('frontend.product.shop_page', compact('products', 'categories', 'brands', 'newProduct'));
    } //End Method

    public function ShopFilter(Request $request)
    {
        $data = $request->all();

        $cat_url = "";
        if (!empty($data['category']) && empty($data['brand'])) {
            $brand_url = "";
            $price_range_url = "";
            foreach ($data['category'] as $category) {
                if (empty($cat_url)) {
                    $cat_url .= '&category=' . $category;
                } else {
                    $cat_url .= ',' . $category;
                }
            }
        }

        $brand_url = "";
        if (!empty($data['brand']) && empty($data['category'])) {
            $cat_url = "";
            $price_range_url = "";
            foreach ($data['brand'] as $brand) {
                if (empty($brand_url)) {
                    $brand_url .= '&brand=' . $brand;
                } else {
                    $brand_url .= ',' . $brand;
                }
            }
        }

        $price_range_url = "";
        if (!empty($data['price_range']) && empty($data['brand']) && empty($data['category'])) {
            $cat_url = "";
            $brand_url = "";
            $price_range_url .= '&price=' . $data['price_range'];
        }

        return redirect()->route('shop.page', $cat_url . $brand_url . $price_range_url);
    } //End Method
}

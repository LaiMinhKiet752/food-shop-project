<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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
            $category_id = Category::select('id')->whereIn('category_slug', $slugs)->pluck('id')->toArray();
            $products = Product::whereIn('category_id', $category_id)->get();
        } else {
            $products = Product::where('status', 1)->orderBy('id', 'DESC')->get();
        }
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $newProduct = Product::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        return view('frontend.product.shop_page', compact('products', 'categories', 'newProduct'));
    } //End Method

    public function ShopFilter(Request $request)
    {
        $data = $request->all();

        //Filter By Category
        $category_url = "";
        if (!empty($data['category'])) {
            foreach ($data['category'] as $category) {
                if (empty($category_url)) {
                    $category_url .= '&category=' . $category;
                } else {
                    $category_url .= ',' . $category;
                }
            }
            return redirect()->route('shop.page', $category_url);
        } else {
            return redirect()->route('shop.page');
        }
    } //End Method
}

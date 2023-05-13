<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\MultiImg;
use App\Models\Brand;
use App\Models\MultiImage;
use App\Models\Product;
use App\Models\User;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class VendorProductController extends Controller
{
     public function VendorAllProduct(){

        $id = Auth::user()->id;
        $products = Product::where('vendor_id',$id)->latest()->get();
        return view('vendor.backend.product.vendor_product_all',compact('products'));
    } // End Method


    public function VendorAddProduct()
    {

        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        return view('vendor.backend.product.vendor_product_add', compact('brands', 'categories'));
    } //End Method


    public function VendorGetSubCategory($category_id)
    {
        $sub_category = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name', 'ASC')->get();
        return json_encode($sub_category);
    } // End Method




    public function VendorStoreProduct(Request $request)
    {

        $file = $request->file('product_thumbnail');
        $filename = hexdec(uniqid()) . '_product_thumbnail' . '.' . $file->getClientOriginalExtension();
        Image::make($file)->resize(1000, 1000)->save('upload/products/thumbnail/' . $filename);
        $save_url = 'upload/products/thumbnail/' . $filename;

        $product_id =  Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'vendor_id' => $request->vendor_id,

            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'product_thumbnail' => $save_url,
            'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
            'product_quantity' => $request->product_quantity,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,

            'short_description' => $request->short_description,
            'long_description' => $request->long_description,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'manufacturing_date' => $request->manufacturing_date,
            'expire_date' => $request->expire_date,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,

            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        //Multiple Image Upload Form Here
        $images = $request->file('multiple_image');
        foreach ($images as $image) {
            $make_name = hexdec(uniqid()) . '_product' . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(1000, 1000)->save('upload/products/multiple_images/' . $make_name);
            $uploadPath = 'upload/products/multiple_images/' . $make_name;

            MultiImage::insert([
                'product_id' => $product_id,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(),
            ]);
        }
        $notification = array(
            'message' => 'Vendor Product Inserted Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('vendor.all.product')->with($notification);
    } //End Method
}

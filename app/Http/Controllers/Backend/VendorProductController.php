<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\MultiImage;
use App\Models\Product;
use App\Models\User;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class VendorProductController extends Controller
{
    public function VendorAllProduct()
    {
        $id = Auth::user()->id;
        $products = Product::where('vendor_id', $id)->latest()->get();
        return view('vendor.backend.product.vendor_product_all', compact('products'));
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
        $id = Auth::user()->id;
        $product_check = Product::where('vendor_id', $id)->onlyTrashed()->get();
        foreach ($product_check as $product) {
            if ($product['product_name'] == $request->product_name) {
                $notification = array(
                    'message' => "This Product Name Has Been Temporarily Removed. Please Check Again In 'Restore Product'",
                    'alert-type' => 'warning',
                );
                return redirect()->back()->with($notification);
            }
        }
        $request->validate([
            'product_code' => 'unique:products',
            'product_thumbnail' => 'image|max:2048',
            'multiple_image.*' => 'image|max:2048',
        ], [
            'product_code.unique' => 'Product code already exists.',
            'product_thumbnail.image' => 'The uploaded file must be an image in one of the following formats: jpg, jpeg, png, bmp, gif, svg, or webp.',
            'product_thumbnail.max' => 'The maximum upload image size is 2MB.',
            'multiple_image.*.image' => 'The uploaded file must be an image in one of the following formats: jpg, jpeg, png, bmp, gif, svg, or webp.',
            'multiple_image.*.max' => 'The maximum upload image size is 2MB.',
        ]);

        $file = $request->file('product_thumbnail');
        $filename = hexdec(uniqid()) . '_product_thumbnail' . '.' . $file->getClientOriginalExtension();
        Image::make($file)->resize(1000, 1000)->save('upload/products/thumbnail/' . $filename);
        $save_url = 'upload/products/thumbnail/' . $filename;

        $product_id =  Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'vendor_id' => Auth::user()->id,

            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'product_thumbnail' => $save_url,
            'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
            'product_quantity' => $request->product_quantity,
            'product_tags' => $request->product_tags,
            'product_weight' => $request->product_weight,
            'product_measure' => $request->product_measure,
            'product_dimensions' => $request->product_dimensions,

            'short_description' => $request->short_description,
            'long_description' => $request->long_description,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'manufacturing_date' => $request->manufacturing_date,
            'expiry_date' => $request->expiry_date,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,

            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        //Multiple Images Upload
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
            'message' => 'Product Added Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('vendor.all.product')->with($notification);
    } //End Method

    public function VendorEditProduct($id)
    {
        $products = Product::findOrFail($id);
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $get_category_id = $products->category_id;
        $subcategory = SubCategory::where('category_id', $get_category_id)->latest()->get();
        $multipleImages = MultiImage::where('product_id', $id)->latest()->get();
        return view('vendor.backend.product.vendor_product_edit', compact('brands', 'categories', 'subcategory', 'products', 'multipleImages'));
    } //End Method

    public function VendorUpdateProduct(Request $request)
    {
        $id = Auth::user()->id;
        $product_check = Product::where('vendor_id', $id)->onlyTrashed()->get();
        foreach ($product_check as $product) {
            if ($product['product_name'] == $request->product_name) {
                $notification = array(
                    'message' => "This Product Name Has Been Temporarily Removed. Please Check Again In 'Restore Product'",
                    'alert-type' => 'warning',
                );
                return redirect()->back()->with($notification);
            }
        }
        $product_id = $request->id;
        $current_product_code = Product::findOrFail($product_id)->product_code;

        if ($current_product_code != $request->product_code) {
            $request->validate([
                'product_code' => 'unique:products',
            ], [
                'product_code.unique' => 'Product code already exists.',
            ]);
            Product::findOrFail($product_id)->update([
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'vendor_id' => Auth::user()->id,

                'product_name' => $request->product_name,
                'product_code' => $request->product_code,
                'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
                'product_quantity' => $request->product_quantity,
                'product_tags' => $request->product_tags,
                'product_weight' => $request->product_weight,
                'product_measure' => $request->product_measure,
                'product_dimensions' => $request->product_dimensions,

                'short_description' => $request->short_description,
                'long_description' => $request->long_description,

                'selling_price' => $request->selling_price,
                'discount_price' => $request->discount_price,
                'manufacturing_date' => $request->manufacturing_date,
                'expiry_date' => $request->expiry_date,

                'hot_deals' => $request->hot_deals,
                'featured' => $request->featured,
                'special_offer' => $request->special_offer,
                'special_deals' => $request->special_deals,

                'status' => 1,
            ]);

            $notification = array(
                'message' => 'Product Updated Without Image Successfully!',
                'alert-type' => 'success',
            );
            return redirect()->route('vendor.all.product')->with($notification);
        } else {
            Product::findOrFail($product_id)->update([
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'vendor_id' => Auth::user()->id,

                'product_name' => $request->product_name,
                'product_code' => $request->product_code,
                'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
                'product_quantity' => $request->product_quantity,
                'product_tags' => $request->product_tags,
                'product_weight' => $request->product_weight,
                'product_measure' => $request->product_measure,
                'product_dimensions' => $request->product_dimensions,

                'short_description' => $request->short_description,
                'long_description' => $request->long_description,

                'selling_price' => $request->selling_price,
                'discount_price' => $request->discount_price,
                'manufacturing_date' => $request->manufacturing_date,
                'expiry_date' => $request->expiry_date,

                'hot_deals' => $request->hot_deals,
                'featured' => $request->featured,
                'special_offer' => $request->special_offer,
                'special_deals' => $request->special_deals,

                'status' => 1,
            ]);

            $notification = array(
                'message' => 'Product Updated Without Image Successfully!',
                'alert-type' => 'success',
            );
            return redirect()->route('vendor.all.product')->with($notification);
        }
    } //End Method

    public function VendorUpdateProductThumbnail(Request $request)
    {
        $product_id = $request->id;
        $oldImage = $request->old_image;
        $file = $request->file('product_thumbnail');
        $product_thumbnail = Product::where('product_thumbnail', $oldImage)->first();

        if ($oldImage != NULL && $product_thumbnail != NULL && $file == NULL) {
            $notification = array(
                'message' => "Upload Failed Because You Didn't Choose An Image!",
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        } else {
            $request->validate([
                'product_thumbnail' => 'image|max:2048',
            ], [
                'product_thumbnail.image' => 'The uploaded file must be an image in one of the following formats: jpg, jpeg, png, bmp, gif, svg, or webp.',
                'product_thumbnail.max' => 'The maximum upload image size is 2MB.',
            ]);
            $filename = hexdec(uniqid()) . '_product_thumbnail' . '.' . $file->getClientOriginalExtension();
            Image::make($file)->resize(1000, 1000)->save('upload/products/thumbnail/' . $filename);
            $save_url = 'upload/products/thumbnail/' . $filename;

            if (file_exists($oldImage)) {
                unlink($oldImage);
            }

            Product::findOrFail($product_id)->update([
                'product_thumbnail' => $save_url,
            ]);

            $notification = array(
                'message' => 'Product Thumbnail Updated Successfully!',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }
    } //End Method

    public function VendorAddNewProductMultipleImages(Request $request)
    {
        $product_id = $request->id;
        $images = $request->add_new_multiple_image;
        if ($images == NULL) {
            $notification = array(
                'message' => "Upload Failed Because You Didn't Choose An Image!",
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        } else {
            $request->validate([
                'add_new_multiple_image.*' => 'image|max:2048',
            ], [
                'add_new_multiple_image.*.image' => 'The uploaded file must be an image in one of the following formats: jpg, jpeg, png, bmp, gif, svg, or webp.',
                'add_new_multiple_image.*.max' => 'The maximum upload image size is 2MB.',
            ]);
            $images = $request->file('add_new_multiple_image');
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
                'message' => 'Product Multiple Images Added Successfully!',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }
    } //End Method

    public function VendorUpdateProductMultipleImages(Request $request)
    {
        $images = $request->multiple_image;
        if ($images == NULL) {
            $notification = array(
                'message' => "Upload Failed Because You Didn't Choose An Image!",
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        } else {
            $request->validate([
                'multiple_image.*' => 'image|max:2048',
            ], [
                'multiple_image.*.image' => 'The uploaded file must be an image in one of the following formats: jpg, jpeg, png, bmp, gif, svg, or webp.',
                'multiple_image.*.max' => 'The maximum upload image size is 2MB.',
            ]);
            foreach ($images as $id => $image) {
                $imageDelete = MultiImage::findOrFail($id);
                unlink($imageDelete->photo_name);
                $make_name = hexdec(uniqid()) . '_product' . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(800, 800)->save('upload/products/multiple_images/' . $make_name);
                $uploadPath = 'upload/products/multiple_images/' . $make_name;

                MultiImage::where('id', $id)->update([
                    'photo_name' => $uploadPath,
                ]);
            }
            $notification = array(
                'message' => 'Product Multiple Images Updated Successfully!',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }
    } //End Method

    public function VendorMultipleimagesDelete($id)
    {
        $old_image = MultiImage::findOrFail($id);
        unlink($old_image->photo_name);

        MultiImage::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Product Multiple Images Deleted Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } //End Method

    public function VendorProductInactive($id)
    {
        Product::findOrFail($id)->update([
            'status' => 0,
        ]);
        $notification = array(
            'message' => 'Product Inactivated Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } //End Method

    public function VendorProductActive($id)
    {
        Product::findOrFail($id)->update([
            'status' => 1,
        ]);
        $notification = array(
            'message' => 'Product Activated Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } //End Method

    public function VendorProductDelete($id)
    {
        $product = Product::findOrFail($id);
        unlink($product->product_thumbnail);
        Product::findOrFail($id)->delete();
        $images = MultiImage::where('product_id', $id)->get();
        foreach ($images as $image) {
            unlink($image->photo_name);
            MultiImage::where('product_id', $id)->delete();
        }
        $notification = array(
            'message' => 'Product Deleted Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } //End Method

    public function VendorRestoreProduct()
    {
        $id = Auth::user()->id;
        $products = Product::where('vendor_id', $id)->onlyTrashed()->get();
        return view('vendor.backend.product.vendor_product_restore', compact('products'));
    } //End Method

    public function VendorRestoreProductSubmit($id)
    {
        Product::whereId($id)->restore();
        $notification = array(
            'message' => 'Product Restored Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } //End Method

    public function VendorRestoreAllProductSubmit()
    {
        $id = Auth::user()->id;
        Product::where('vendor_id', $id)->onlyTrashed()->restore();
        $notification = array(
            'message' => 'All Product Restored Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } //End Method

    public function VendorProductStock()
    {
        $id = Auth::user()->id;
        $products = Product::where('vendor_id', $id)->latest()->get();
       return view('vendor.backend.product.vendor_product_stock',compact('products'));
    } //End Method
}

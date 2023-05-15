<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class BrandController extends Controller
{
    public function AllBrand()
    {
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_all', compact('brands'));
    } //End Method

    public function AddBrand()
    {
        return view('backend.brand.brand_add');
    } //End Method

    public function StoreBrand(Request $request)
    {
        $request->validate([
            'brand_image' => 'image|max:2048'
        ], [
            'brand_image.image' => 'The uploaded file must be an image in one of the following formats: jpg, jpeg, png, bmp, gif, svg, or webp.',
            'brand_image.max' => 'Maximum image size is 2MB.',
        ]);
        $file = $request->file('brand_image');
        $filename = hexdec(uniqid()) . '_brand' . '.' . $file->getClientOriginalExtension();
        Image::make($file)->resize(120, 120)->save('upload/brand/' . $filename);
        $save_url = 'upload/brand/' . $filename;

        $brand = new Brand();
        $brand->brand_name = $request->brand_name;
        $brand->brand_slug = strtolower(str_replace(' ', '-', $request->brand_name));
        $brand->brand_image = $save_url;
        $brand->save();

        $notification = array(
            'message' => 'Brand Inserted Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('all.brand')->with($notification);
    } //End Method

    public function EditBrand($id)
    {
        $brand = Brand::findOrFail($id);
        return view('backend.brand.brand_edit', compact('brand'));
    } //End Method

    public function UpdateBrand(Request $request)
    {
        $brand_id = $request->id;
        $old_image = $request->old_image;

        if ($request->file('brand_image')) {
            $request->validate([
                'brand_image' => 'image|max:2048'
            ], [
                'brand_image.image' => 'The uploaded file must be an image in one of the following formats: jpg, jpeg, png, bmp, gif, svg, or webp.',
                'brand_image.max' => 'Maximum image size is 2MB.',
            ]);
            $file = $request->file('brand_image');
            $filename = hexdec(uniqid()) . '_brand' . '.' . $file->getClientOriginalExtension();
            Image::make($file)->resize(1000, 1000)->save('upload/brand/' . $filename);
            $save_url = 'upload/brand/' . $filename;

            if (file_exists($old_image)) {
                unlink($old_image);
            }
            Brand::findOrFail($brand_id)->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                'brand_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Brand Updated With Image Successfully!',
                'alert-type' => 'success',
            );
            return redirect()->route('all.brand')->with($notification);
        } else {
            Brand::findOrFail($brand_id)->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
            ]);

            $notification = array(
                'message' => 'Brand Updated Without Image Successfully!',
                'alert-type' => 'success',
            );
            return redirect()->route('all.brand')->with($notification);
        }
    } //End Method

    public function DeleteBrand($id)
    {
        $brand = Brand::findOrFail($id);
        $img = $brand->brand_image;
        unlink($img);
        Brand::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Brand Deleted Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } //End Method
}

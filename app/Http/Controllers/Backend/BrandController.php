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
            'brand_image' => 'required|mimes:jpeg,png,jpg'
        ]);
        $file = $request->file('brand_image');
        $ext = $request->file('brand_image')->extension();
        $date = date('YmdHi');
        $filename = $date . '_brand' . '.' . $ext;
        Image::make($file)->resize(300, 300)->save('upload/brand/' . $filename);
        $save_url = 'upload/brand/' . $filename;

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
            'brand_image' => $save_url,
        ]);

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
                'brand_image' => 'required|mimes:jpeg,png,jpg'
            ]);
            $file = $request->file('brand_image');
            $ext = $request->file('brand_image')->extension();
            $date = date('YmdHi');
            $filename = $date . '_brand' . '.' . $ext;
            Image::make($file)->resize(300, 300)->save('upload/brand/' . $filename);
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

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
        $brand_check = Brand::onlyTrashed()->get();
        foreach ($brand_check as $brand) {
            if ($brand['brand_name'] == $request->brand_name) {
                $notification = array(
                    'message' => "This Brand Name Has Been Temporarily Removed. Please Check Again In 'Restore Brand'",
                    'alert-type' => 'warning',
                );
                return redirect()->back()->with($notification);
            }
        }
        $request->validate([
            'brand_image' => 'image|max:2048',
            'brand_name' => 'unique:brands',
            'brand_email' => 'unique:brands',
            'brand_phone' => 'unique:brands',
        ], [
            'brand_image.image' => 'The uploaded file must be an image in one of the following formats: jpg, jpeg, png, bmp, gif, svg, or webp.',
            'brand_image.max' => 'The maximum upload image size is 2MB.',
            'brand_name.unique' => 'The brand name already exists. Please enter another brand name.',
            'brand_email.unique' => 'The brand email already exists. Please enter another brand email.',
            'brand_phone.unique' => 'The phone number already exists. Please enter another phone number.',
        ]);
        $file = $request->file('brand_image');
        $filename = hexdec(uniqid()) . '_brand' . '.' . $file->getClientOriginalExtension();
        Image::make($file)->resize(120, 120)->save('upload/brand/' . $filename);
        $save_url = 'upload/brand/' . $filename;

        $brand = new Brand();
        $brand->brand_name = $request->brand_name;
        $brand->brand_email = $request->brand_email;
        $brand->brand_phone = $request->brand_phone;
        $brand->brand_address = $request->brand_address;
        $brand->brand_slug = strtolower(str_replace(' ', '-', $request->brand_name));
        $brand->brand_image = $save_url;
        $brand->save();

        $notification = array(
            'message' => 'Brand Added Successfully!',
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

        //With Image
        if ($request->file('brand_image')) {
            $brand_check = Brand::onlyTrashed()->get();
            foreach ($brand_check as $brand) {
                if ($brand['brand_name'] == $request->brand_name) {
                    $notification = array(
                        'message' => "This Brand Name Has Been Temporarily Removed. Please Check Again In 'Restore Brand'",
                        'alert-type' => 'warning',
                    );
                    return redirect()->back()->with($notification);
                }
            }
            $request->validate([
                'brand_image' => 'image|max:2048'
            ], [
                'brand_image.image' => 'The uploaded file must be an image in one of the following formats: jpg, jpeg, png, bmp, gif, svg, or webp.',
                'brand_image.max' => 'The maximum upload image size is 2MB.',
            ]);
            $file = $request->file('brand_image');
            $filename = hexdec(uniqid()) . '_brand' . '.' . $file->getClientOriginalExtension();
            $save_url = 'upload/brand/' . $filename;

            $current_brand_name = Brand::findOrFail($brand_id)->brand_name;
            $current_brand_email = Brand::findOrFail($brand_id)->brand_email;
            $current_brand_phone = Brand::findOrFail($brand_id)->brand_phone;
            $current_brand_address = Brand::findOrFail($brand_id)->brand_address;
            //Text is unchanged
            if ($current_brand_name == $request->brand_name && $current_brand_email == $request->brand_email && $current_brand_phone == $request->brand_phone && $current_brand_address == $request->brand_address) {
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
                Image::make($file)->resize(1000, 1000)->save('upload/brand/' . $filename);
                Brand::findOrFail($brand_id)->update([
                    'brand_image' => $save_url,
                ]);
                $notification = array(
                    'message' => 'Brand Updated With Image Successfully!',
                    'alert-type' => 'success',
                );
                return redirect()->route('all.brand')->with($notification);
            }
            //Text has changed
            else if ($current_brand_name != $request->brand_name && $current_brand_email == $request->brand_email && $current_brand_phone == $request->brand_phone && $current_brand_address == $request->brand_address) {
                $request->validate([
                    'brand_name' => 'unique:brands'
                ], [
                    'brand_name.unique' => 'The brand name already exists. Please enter another brand name.',
                ]);
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
                Image::make($file)->resize(1000, 1000)->save('upload/brand/' . $filename);
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
            } else if ($current_brand_name == $request->brand_name && $current_brand_email != $request->brand_email && $current_brand_phone == $request->brand_phone && $current_brand_address == $request->brand_address) {
                $request->validate([
                    'brand_email' => 'unique:brands'
                ], [
                    'brand_email.unique' => 'The brand email already exists. Please enter another brand email.',
                ]);
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
                Image::make($file)->resize(1000, 1000)->save('upload/brand/' . $filename);
                Brand::findOrFail($brand_id)->update([
                    'brand_email' => $request->brand_email,
                    'brand_image' => $save_url,
                ]);
                $notification = array(
                    'message' => 'Brand Updated With Image Successfully!',
                    'alert-type' => 'success',
                );
                return redirect()->route('all.brand')->with($notification);
            } else if ($current_brand_name == $request->brand_name && $current_brand_email == $request->brand_email && $current_brand_phone != $request->brand_phone && $current_brand_address == $request->brand_address) {
                $request->validate([
                    'brand_phone' => 'unique:brands'
                ], [
                    'brand_phone.unique' => 'The phone number already exists. Please enter another phone number.',
                ]);
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
                Image::make($file)->resize(1000, 1000)->save('upload/brand/' . $filename);
                Brand::findOrFail($brand_id)->update([
                    'brand_phone' => $request->brand_phone,
                    'brand_image' => $save_url,
                ]);
                $notification = array(
                    'message' => 'Brand Updated With Image Successfully!',
                    'alert-type' => 'success',
                );
                return redirect()->route('all.brand')->with($notification);
            } else if ($current_brand_name == $request->brand_name && $current_brand_email == $request->brand_email && $current_brand_phone == $request->brand_phone && $current_brand_address != $request->brand_address) {
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
                Image::make($file)->resize(1000, 1000)->save('upload/brand/' . $filename);
                Brand::findOrFail($brand_id)->update([
                    'brand_address' => $request->brand_address,
                ]);
                $notification = array(
                    'message' => 'Brand Updated With Image Successfully!',
                    'alert-type' => 'success',
                );
                return redirect()->route('all.brand')->with($notification);
            } else if ($current_brand_name != $request->brand_name && $current_brand_email != $request->brand_email && $current_brand_phone == $request->brand_phone && $current_brand_address == $request->brand_address) {
                $request->validate([
                    'brand_name' => 'unique:brands',
                    'brand_email' => 'unique:brands',
                ], [
                    'brand_name.unique' => 'The brand name already exists. Please enter another brand name.',
                    'brand_email.unique' => 'The brand email already exists. Please enter another brand email.',
                ]);
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
                Image::make($file)->resize(1000, 1000)->save('upload/brand/' . $filename);
                Brand::findOrFail($brand_id)->update([
                    'brand_name' => $request->brand_name,
                    'brand_email' => $request->brand_email,
                    'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                    'brand_image' => $save_url,
                ]);
                $notification = array(
                    'message' => 'Brand Updated With Image Successfully!',
                    'alert-type' => 'success',
                );
                return redirect()->route('all.brand')->with($notification);
            } else if ($current_brand_name != $request->brand_name && $current_brand_email == $request->brand_email && $current_brand_phone != $request->brand_phone && $current_brand_address == $request->brand_address) {
                $request->validate([
                    'brand_name' => 'unique:brands',
                    'brand_phone' => 'unique:brands',
                ], [
                    'brand_name.unique' => 'The brand name already exists. Please enter another brand name.',
                    'brand_phone.unique' => 'The phone number already exists. Please enter another phone number.',
                ]);
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
                Image::make($file)->resize(1000, 1000)->save('upload/brand/' . $filename);
                Brand::findOrFail($brand_id)->update([
                    'brand_name' => $request->brand_name,
                    'brand_phone' => $request->brand_phone,
                    'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                    'brand_image' => $save_url,
                ]);
                $notification = array(
                    'message' => 'Brand Updated With Image Successfully!',
                    'alert-type' => 'success',
                );
                return redirect()->route('all.brand')->with($notification);
            } else if ($current_brand_name != $request->brand_name && $current_brand_email == $request->brand_email && $current_brand_phone == $request->brand_phone && $current_brand_address != $request->brand_address) {
                $request->validate([
                    'brand_name' => 'unique:brands',
                ], [
                    'brand_name.unique' => 'The brand name already exists. Please enter another brand name.',
                ]);
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
                Image::make($file)->resize(1000, 1000)->save('upload/brand/' . $filename);
                Brand::findOrFail($brand_id)->update([
                    'brand_name' => $request->brand_name,
                    'brand_address' => $request->brand_address,
                    'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                    'brand_image' => $save_url,
                ]);
                $notification = array(
                    'message' => 'Brand Updated With Image Successfully!',
                    'alert-type' => 'success',
                );
                return redirect()->route('all.brand')->with($notification);
            } else if ($current_brand_name == $request->brand_name && $current_brand_email != $request->brand_email && $current_brand_phone != $request->brand_phone && $current_brand_address == $request->brand_address) {
                $request->validate([
                    'brand_email' => 'unique:brands',
                    'brand_phone' => 'unique:brands',
                ], [
                    'brand_email.unique' => 'The brand email already exists. Please enter another brand email.',
                    'brand_phone.unique' => 'The phone number already exists. Please enter another phone number.',
                ]);
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
                Image::make($file)->resize(1000, 1000)->save('upload/brand/' . $filename);
                Brand::findOrFail($brand_id)->update([
                    'brand_email' => $request->brand_email,
                    'brand_phone' => $request->brand_phone,
                    'brand_image' => $save_url,
                ]);
                $notification = array(
                    'message' => 'Brand Updated With Image Successfully!',
                    'alert-type' => 'success',
                );
                return redirect()->route('all.brand')->with($notification);
            } else if ($current_brand_name == $request->brand_name && $current_brand_email != $request->brand_email && $current_brand_phone == $request->brand_phone && $current_brand_address != $request->brand_address) {
                $request->validate([
                    'brand_email' => 'unique:brands',
                ], [
                    'brand_email.unique' => 'The brand email already exists. Please enter another brand email.',
                ]);
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
                Image::make($file)->resize(1000, 1000)->save('upload/brand/' . $filename);
                Brand::findOrFail($brand_id)->update([
                    'brand_email' => $request->brand_email,
                    'brand_address' => $request->brand_address,
                    'brand_image' => $save_url,
                ]);
                $notification = array(
                    'message' => 'Brand Updated With Image Successfully!',
                    'alert-type' => 'success',
                );
                return redirect()->route('all.brand')->with($notification);
            } else if ($current_brand_name == $request->brand_name && $current_brand_email == $request->brand_email && $current_brand_phone != $request->brand_phone && $current_brand_address != $request->brand_address) {
                $request->validate([
                    'brand_phone' => 'unique:brands',
                ], [
                    'brand_phone.unique' => 'The phone number already exists. Please enter another phone number.',
                ]);
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
                Image::make($file)->resize(1000, 1000)->save('upload/brand/' . $filename);
                Brand::findOrFail($brand_id)->update([
                    'brand_phone' => $request->brand_phone,
                    'brand_address' => $request->brand_address,
                    'brand_image' => $save_url,
                ]);
                $notification = array(
                    'message' => 'Brand Updated With Image Successfully!',
                    'alert-type' => 'success',
                );
                return redirect()->route('all.brand')->with($notification);
            } else if ($current_brand_name != $request->brand_name && $current_brand_email != $request->brand_email && $current_brand_phone != $request->brand_phone && $current_brand_address == $request->brand_address) {
                $request->validate([
                    'brand_name' => 'unique:brands',
                    'brand_email' => 'unique:brands',
                    'brand_phone' => 'unique:brands',
                ], [
                    'brand_name.unique' => 'The brand name already exists. Please enter another brand name.',
                    'brand_email.unique' => 'The brand email already exists. Please enter another brand email.',
                    'brand_phone.unique' => 'The phone number already exists. Please enter another phone number.',
                ]);
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
                Image::make($file)->resize(1000, 1000)->save('upload/brand/' . $filename);
                Brand::findOrFail($brand_id)->update([
                    'brand_name' => $request->brand_name,
                    'brand_email' => $request->brand_email,
                    'brand_phone' => $request->brand_phone,
                    'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                    'brand_image' => $save_url,
                ]);
                $notification = array(
                    'message' => 'Brand Updated With Image Successfully!',
                    'alert-type' => 'success',
                );
                return redirect()->route('all.brand')->with($notification);
            } else if ($current_brand_name != $request->brand_name && $current_brand_email != $request->brand_email && $current_brand_phone == $request->brand_phone && $current_brand_address != $request->brand_address) {
                $request->validate([
                    'brand_name' => 'unique:brands',
                    'brand_email' => 'unique:brands',
                ], [
                    'brand_name.unique' => 'The brand name already exists. Please enter another brand name.',
                    'brand_email.unique' => 'The brand email already exists. Please enter another brand email.',
                ]);
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
                Image::make($file)->resize(1000, 1000)->save('upload/brand/' . $filename);
                Brand::findOrFail($brand_id)->update([
                    'brand_name' => $request->brand_name,
                    'brand_email' => $request->brand_email,
                    'brand_address' => $request->brand_address,
                    'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                    'brand_image' => $save_url,
                ]);
                $notification = array(
                    'message' => 'Brand Updated With Image Successfully!',
                    'alert-type' => 'success',
                );
                return redirect()->route('all.brand')->with($notification);
            } else if ($current_brand_name != $request->brand_name && $current_brand_email == $request->brand_email && $current_brand_phone != $request->brand_phone && $current_brand_address != $request->brand_address) {
                $request->validate([
                    'brand_name' => 'unique:brands',
                    'brand_phone' => 'unique:brands',
                ], [
                    'brand_name.unique' => 'The brand name already exists. Please enter another brand name.',
                    'brand_phone.unique' => 'The phone number already exists. Please enter another phone number.',
                ]);
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
                Image::make($file)->resize(1000, 1000)->save('upload/brand/' . $filename);
                Brand::findOrFail($brand_id)->update([
                    'brand_name' => $request->brand_name,
                    'brand_phone' => $request->brand_phone,
                    'brand_address' => $request->brand_address,
                    'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                    'brand_image' => $save_url,
                ]);
                $notification = array(
                    'message' => 'Brand Updated With Image Successfully!',
                    'alert-type' => 'success',
                );
                return redirect()->route('all.brand')->with($notification);
            } else if ($current_brand_name == $request->brand_name && $current_brand_email != $request->brand_email && $current_brand_phone != $request->brand_phone && $current_brand_address != $request->brand_address) {
                $request->validate([
                    'brand_email' => 'unique:brands',
                    'brand_phone' => 'unique:brands',
                ], [
                    'brand_email.unique' => 'The brand email already exists. Please enter another brand email.',
                    'brand_phone.unique' => 'The phone number already exists. Please enter another phone number.',
                ]);
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
                Image::make($file)->resize(1000, 1000)->save('upload/brand/' . $filename);
                Brand::findOrFail($brand_id)->update([
                    'brand_email' => $request->brand_email,
                    'brand_phone' => $request->brand_phone,
                    'brand_address' => $request->brand_address,
                    'brand_image' => $save_url,
                ]);
                $notification = array(
                    'message' => 'Brand Updated With Image Successfully!',
                    'alert-type' => 'success',
                );
                return redirect()->route('all.brand')->with($notification);
            } else if ($current_brand_name != $request->brand_name && $current_brand_email != $request->brand_email && $current_brand_phone != $request->brand_phone && $current_brand_address != $request->brand_address) {
                $request->validate([
                    'brand_name' => 'unique:brands',
                    'brand_email' => 'unique:brands',
                    'brand_phone' => 'unique:brands',
                ], [
                    'brand_name.unique' => 'The brand name already exists. Please enter another brand name.',
                    'brand_email.unique' => 'The brand email already exists. Please enter another brand email.',
                    'brand_phone.unique' => 'The phone number already exists. Please enter another phone number.',
                ]);
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
                Image::make($file)->resize(1000, 1000)->save('upload/brand/' . $filename);
                Brand::findOrFail($brand_id)->update([
                    'brand_name' => $request->brand_name,
                    'brand_email' => $request->brand_email,
                    'brand_phone' => $request->brand_phone,
                    'brand_address' => $request->brand_address,
                    'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                    'brand_image' => $save_url,
                ]);
                $notification = array(
                    'message' => 'Brand Updated With Image Successfully!',
                    'alert-type' => 'success',
                );
                return redirect()->route('all.brand')->with($notification);
            }
        }

        //Without Image
        else {
            $brand_check = Brand::onlyTrashed()->get();
            foreach ($brand_check as $brand) {
                if ($brand['brand_name'] == $request->brand_name) {
                    $notification = array(
                        'message' => "This Brand Name Has Been Temporarily Removed. Please Check Again In 'Restore Brand'",
                        'alert-type' => 'warning',
                    );
                    return redirect()->back()->with($notification);
                }
            }
            $current_brand_name = Brand::findOrFail($brand_id)->brand_name;
            $current_brand_email = Brand::findOrFail($brand_id)->brand_email;
            $current_brand_phone = Brand::findOrFail($brand_id)->brand_phone;
            $current_brand_address = Brand::findOrFail($brand_id)->brand_address;
            //Text is unchanged
            if ($current_brand_name == $request->brand_name && $current_brand_email == $request->brand_email && $current_brand_phone == $request->brand_phone && $current_brand_address == $request->brand_address) {
                $notification = array(
                    'message' => 'Brand Updated Without Image Successfully!',
                    'alert-type' => 'success',
                );
                return redirect()->route('all.brand')->with($notification);
            } else if ($current_brand_name != $request->brand_name && $current_brand_email == $request->brand_email && $current_brand_phone == $request->brand_phone && $current_brand_address == $request->brand_address) {
                $request->validate([
                    'brand_name' => 'unique:brands'
                ], [
                    'brand_name.unique' => 'The brand name already exists. Please enter another brand name.',
                ]);
                Brand::findOrFail($brand_id)->update([
                    'brand_name' => $request->brand_name,
                    'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                ]);

                $notification = array(
                    'message' => 'Brand Updated Without Image Successfully!',
                    'alert-type' => 'success',
                );
                return redirect()->route('all.brand')->with($notification);
            } else if ($current_brand_name == $request->brand_name && $current_brand_email != $request->brand_email && $current_brand_phone == $request->brand_phone && $current_brand_address == $request->brand_address) {
                $request->validate([
                    'brand_email' => 'unique:brands'
                ], [
                    'brand_email.unique' => 'The brand email already exists. Please enter another brand email.',
                ]);
                Brand::findOrFail($brand_id)->update([
                    'brand_email' => $request->brand_email,
                ]);

                $notification = array(
                    'message' => 'Brand Updated Without Image Successfully!',
                    'alert-type' => 'success',
                );
                return redirect()->route('all.brand')->with($notification);
            } else if ($current_brand_name == $request->brand_name && $current_brand_email == $request->brand_email && $current_brand_phone != $request->brand_phone && $current_brand_address == $request->brand_address) {
                $request->validate([
                    'brand_phone' => 'unique:brands',
                ], [
                    'brand_phone.unique' => 'The phone number already exists. Please enter another phone number.',
                ]);
                Brand::findOrFail($brand_id)->update([
                    'brand_phone' => $request->brand_phone,
                ]);

                $notification = array(
                    'message' => 'Brand Updated Without Image Successfully!',
                    'alert-type' => 'success',
                );
                return redirect()->route('all.brand')->with($notification);
            } else if ($current_brand_name == $request->brand_name && $current_brand_email == $request->brand_email && $current_brand_phone == $request->brand_phone && $current_brand_address != $request->brand_address) {
                Brand::findOrFail($brand_id)->update([
                    'brand_address' => $request->brand_address,
                ]);

                $notification = array(
                    'message' => 'Brand Updated Without Image Successfully!',
                    'alert-type' => 'success',
                );
                return redirect()->route('all.brand')->with($notification);
            } else if ($current_brand_name != $request->brand_name && $current_brand_email != $request->brand_email && $current_brand_phone == $request->brand_phone && $current_brand_address == $request->brand_address) {
                $request->validate([
                    'brand_name' => 'unique:brands',
                    'brand_email' => 'unique:brands'
                ], [
                    'brand_name.unique' => 'The brand name already exists. Please enter another brand name.',
                    'brand_email.unique' => 'The brand email already exists. Please enter another brand email.'
                ]);
                Brand::findOrFail($brand_id)->update([
                    'brand_name' => $request->brand_name,
                    'brand_email' => $request->brand_email,
                    'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                ]);

                $notification = array(
                    'message' => 'Brand Updated Without Image Successfully!',
                    'alert-type' => 'success',
                );
                return redirect()->route('all.brand')->with($notification);
            } else if ($current_brand_name != $request->brand_name && $current_brand_email == $request->brand_email && $current_brand_phone != $request->brand_phone && $current_brand_address == $request->brand_address) {
                $request->validate([
                    'brand_name' => 'unique:brands',
                    'brand_phone' => 'unique:brands'
                ], [
                    'brand_name.unique' => 'The brand name already exists. Please enter another brand name.',
                    'brand_phone.unique' => 'The phone number already exists. Please enter another phone number.',
                ]);
                Brand::findOrFail($brand_id)->update([
                    'brand_name' => $request->brand_name,
                    'brand_phone' => $request->brand_phone,
                    'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                ]);

                $notification = array(
                    'message' => 'Brand Updated Without Image Successfully!',
                    'alert-type' => 'success',
                );
                return redirect()->route('all.brand')->with($notification);
            } else if ($current_brand_name != $request->brand_name && $current_brand_email == $request->brand_email && $current_brand_phone == $request->brand_phone && $current_brand_address != $request->brand_address) {
                $request->validate([
                    'brand_name' => 'unique:brands'
                ], [
                    'brand_name.unique' => 'The brand name already exists. Please enter another brand name.',
                ]);
                Brand::findOrFail($brand_id)->update([
                    'brand_name' => $request->brand_name,
                    'brand_address' => $request->brand_address,
                    'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                ]);

                $notification = array(
                    'message' => 'Brand Updated Without Image Successfully!',
                    'alert-type' => 'success',
                );
                return redirect()->route('all.brand')->with($notification);
            } else if ($current_brand_name == $request->brand_name && $current_brand_email != $request->brand_email && $current_brand_phone != $request->brand_phone && $current_brand_address == $request->brand_address) {
                $request->validate([
                    'brand_email' => 'unique:brands',
                    'brand_phone' => 'unique:brands'
                ], [
                    'brand_email.unique' => 'The brand email already exists. Please enter another brand email.',
                    'brand_phone.unique' => 'The phone number already exists. Please enter another phone number.',
                ]);
                Brand::findOrFail($brand_id)->update([
                    'brand_email' => $request->brand_email,
                    'brand_phone' => $request->brand_phone,
                ]);

                $notification = array(
                    'message' => 'Brand Updated Without Image Successfully!',
                    'alert-type' => 'success',
                );
                return redirect()->route('all.brand')->with($notification);
            } else if ($current_brand_name == $request->brand_name && $current_brand_email != $request->brand_email && $current_brand_phone == $request->brand_phone && $current_brand_address != $request->brand_address) {
                $request->validate([
                    'brand_email' => 'unique:brands',
                ], [
                    'brand_email.unique' => 'The brand email already exists. Please enter another brand email.',
                ]);
                Brand::findOrFail($brand_id)->update([
                    'brand_email' => $request->brand_email,
                    'brand_address' => $request->brand_address,
                ]);

                $notification = array(
                    'message' => 'Brand Updated Without Image Successfully!',
                    'alert-type' => 'success',
                );
                return redirect()->route('all.brand')->with($notification);
            } else if ($current_brand_name == $request->brand_name && $current_brand_email == $request->brand_email && $current_brand_phone != $request->brand_phone && $current_brand_address != $request->brand_address) {
                $request->validate([
                    'brand_phone' => 'unique:brands'
                ], [
                    'brand_phone.unique' => 'The phone number already exists. Please enter another phone number.',
                ]);
                Brand::findOrFail($brand_id)->update([
                    'brand_phone' => $request->brand_phone,
                    'brand_address' => $request->brand_address,
                ]);

                $notification = array(
                    'message' => 'Brand Updated Without Image Successfully!',
                    'alert-type' => 'success',
                );
                return redirect()->route('all.brand')->with($notification);
            } else if ($current_brand_name != $request->brand_name && $current_brand_email != $request->brand_email && $current_brand_phone != $request->brand_phone && $current_brand_address == $request->brand_address) {
                $request->validate([
                    'brand_name' => 'unique:brands',
                    'brand_email' => 'unique:brands',
                    'brand_phone' => 'unique:brands',
                ], [
                    'brand_name.unique' => 'The brand name already exists. Please enter another brand name.',
                    'brand_email.unique' => 'The brand email already exists. Please enter another brand email.',
                    'brand_phone.unique' => 'The phone number already exists. Please enter another phone number.',
                ]);
                Brand::findOrFail($brand_id)->update([
                    'brand_name' => $request->brand_name,
                    'brand_email' => $request->brand_email,
                    'brand_phone' => $request->brand_phone,
                    'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                ]);

                $notification = array(
                    'message' => 'Brand Updated Without Image Successfully!',
                    'alert-type' => 'success',
                );
                return redirect()->route('all.brand')->with($notification);
            } else if ($current_brand_name != $request->brand_name && $current_brand_email != $request->brand_email && $current_brand_phone == $request->brand_phone && $current_brand_address != $request->brand_address) {
                $request->validate([
                    'brand_name' => 'unique:brands',
                    'brand_email' => 'unique:brands',
                ], [
                    'brand_name.unique' => 'The brand name already exists. Please enter another brand name.',
                    'brand_email.unique' => 'The brand email already exists. Please enter another brand email.',
                ]);
                Brand::findOrFail($brand_id)->update([
                    'brand_name' => $request->brand_name,
                    'brand_email' => $request->brand_email,
                    'brand_address' => $request->brand_address,
                    'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                ]);

                $notification = array(
                    'message' => 'Brand Updated Without Image Successfully!',
                    'alert-type' => 'success',
                );
                return redirect()->route('all.brand')->with($notification);
            } else if ($current_brand_name != $request->brand_name && $current_brand_email == $request->brand_email && $current_brand_phone != $request->brand_phone && $current_brand_address != $request->brand_address) {
                $request->validate([
                    'brand_name' => 'unique:brands',
                    'brand_phone' => 'unique:brands',
                ], [
                    'brand_name.unique' => 'The brand name already exists. Please enter another brand name.',
                    'brand_phone.unique' => 'The phone number already exists. Please enter another phone number.',
                ]);
                Brand::findOrFail($brand_id)->update([
                    'brand_name' => $request->brand_name,
                    'brand_phone' => $request->brand_phone,
                    'brand_address' => $request->brand_address,
                    'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                ]);

                $notification = array(
                    'message' => 'Brand Updated Without Image Successfully!',
                    'alert-type' => 'success',
                );
                return redirect()->route('all.brand')->with($notification);
            } else if ($current_brand_name == $request->brand_name && $current_brand_email != $request->brand_email && $current_brand_phone != $request->brand_phone && $current_brand_address != $request->brand_address) {
                $request->validate([
                    'brand_email' => 'unique:brands',
                    'brand_phone' => 'unique:brands',
                ], [
                    'brand_email.unique' => 'The brand email already exists. Please enter another brand email.',
                    'brand_phone.unique' => 'The phone number already exists. Please enter another phone number.',
                ]);
                Brand::findOrFail($brand_id)->update([
                    'brand_email' => $request->brand_email,
                    'brand_phone' => $request->brand_phone,
                    'brand_address' => $request->brand_address,
                ]);

                $notification = array(
                    'message' => 'Brand Updated Without Image Successfully!',
                    'alert-type' => 'success',
                );
                return redirect()->route('all.brand')->with($notification);
            } else if ($current_brand_name != $request->brand_name && $current_brand_email != $request->brand_email && $current_brand_phone != $request->brand_phone && $current_brand_address != $request->brand_address) {
                $request->validate([
                    'brand_name' => 'unique:brands',
                    'brand_email' => 'unique:brands',
                    'brand_phone' => 'unique:brands',
                ], [
                    'brand_name.unique' => 'The brand name already exists. Please enter another brand name.',
                    'brand_email.unique' => 'The brand email already exists. Please enter another brand email.',
                    'brand_phone.unique' => 'The phone number already exists. Please enter another phone number.',
                ]);
                Brand::findOrFail($brand_id)->update([
                    'brand_name' => $request->brand_name,
                    'brand_email' => $request->brand_email,
                    'brand_phone' => $request->brand_phone,
                    'brand_address' => $request->brand_address,
                    'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                ]);

                $notification = array(
                    'message' => 'Brand Updated Without Image Successfully!',
                    'alert-type' => 'success',
                );
                return redirect()->route('all.brand')->with($notification);
            }
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

    public function RestoreBrand()
    {
        $brands = Brand::onlyTrashed()->get();
        return view('backend.brand.brand_restore', compact('brands'));
    } //End Method

    public function RestoreBrandSubmit($id)
    {
        Brand::whereId($id)->restore();
        $notification = array(
            'message' => 'Brand Restored Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } //End Method

    public function RestoreAllBrandSubmit()
    {
        Brand::onlyTrashed()->restore();
        $notification = array(
            'message' => 'All Brand Restored Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } //End Method
}

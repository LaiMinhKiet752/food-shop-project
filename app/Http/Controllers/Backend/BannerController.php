<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Banner;
use Carbon\Carbon;

class BannerController extends Controller
{
    public function AllBanner()
    {
        $banner = Banner::latest()->get();
        return view('backend.banner.banner_all', compact('banner'));
    } // End Method

    public function AddBanner()
    {
        return view('backend.banner.banner_add');
    } // End Method

    public function StoreBanner(Request $request)
    {
        $request->validate([
            'banner_image' => 'image|max:2048'
        ], [
            'banner_image.image' => 'The uploaded file must be an image in one of the following formats: jpg, jpeg, png, bmp, gif, svg, or webp.',
            'banner_image.max' => 'Maximum image size is 2MB.',
        ]);
        $image = $request->file('banner_image');
        $name_gen = hexdec(uniqid()) . '_banner' . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(768, 450)->save('upload/banner/' . $name_gen);
        $save_url = 'upload/banner/' . $name_gen;

        Banner::insert([
            'banner_title' => $request->banner_title,
            'banner_image' => $save_url,
            'status' => 'show',
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Banner Inserted Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.banner')->with($notification);
    } // End Method

    public function EditBanner($id)
    {
        $banner = Banner::findOrFail($id);
        return view('backend.banner.banner_edit', compact('banner'));
    } // End Method

    public function UpdateBanner(Request $request)
    {
        $banner_id = $request->id;
        $old_image = $request->old_img;

        if ($request->file('banner_image')) {
            $request->validate([
                'banner_image' => 'image|max:2048'
            ], [
                'banner_image.image' => 'The uploaded file must be an image in one of the following formats: jpg, jpeg, png, bmp, gif, svg, or webp.',
                'banner_image.max' => 'Maximum image size is 2MB.',
            ]);
            $image = $request->file('banner_image');
            $name_gen = hexdec(uniqid()) . '_banner' . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(768, 450)->save('upload/banner/' . $name_gen);
            $save_url = 'upload/banner/' . $name_gen;

            if (file_exists($old_image)) {
                unlink($old_image);
            }

            Banner::findOrFail($banner_id)->update([
                'banner_title' => $request->banner_title,
                'banner_image' => $save_url,
                'status' => $request->status,
            ]);

            $notification = array(
                'message' => 'Banner Updated With Image Successfully!',
                'alert-type' => 'success',
            );

            return redirect()->route('all.banner')->with($notification);
        } else {
            Banner::findOrFail($banner_id)->update([
                'banner_title' => $request->banner_title,
                'status' => $request->status,
            ]);
            $notification = array(
                'message' => 'Banner Updated Without Image Successfully!',
                'alert-type' => 'success',
            );

            return redirect()->route('all.banner')->with($notification);
        }
    } // End Method

    public function DeleteBanner($id)
    {
        $banner = Banner::findOrFail($id);
        $img = $banner->banner_image;
        unlink($img);

        Banner::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Banner Deleted Successfully!',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    } // End Method
}

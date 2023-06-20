<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Slider;
use Carbon\Carbon;

class SliderController extends Controller
{
    public function AllSlider()
    {
        $sliders = Slider::latest()->get();
        return view('backend.slider.slider_all', compact('sliders'));
    } //End Method

    public function AddSlider()
    {
        return view('backend.slider.slider_add');
    } //End Method

    public function StoreSlider(Request $request)
    {
        $request->validate([
            'slider_image' => 'image|max:2048'
        ], [
            'slider_image.image' => 'The uploaded file must be an image in one of the following formats: jpg, jpeg, png, bmp, gif, svg, or webp.',
            'slider_image.max' => 'The maximum upload image size is 2MB.',
        ]);
        $image = $request->file('slider_image');
        $name_gen = hexdec(uniqid()) . '_slider' . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(2376, 807)->save('upload/slider/' . $name_gen);
        $save_url = 'upload/slider/' . $name_gen;

        Slider::insert([
            'slider_title' => $request->slider_title,
            'short_title' => $request->short_title,
            'slider_image' => $save_url,
            'status' => 'show',
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Slider Added Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.slider')->with($notification);
    } // End Method

    public function EditSlider($id)
    {
        $sliders = Slider::findOrFail($id);
        return view('backend.slider.slider_edit', compact('sliders'));
    } //End Method

    public function UpdateSlider(Request $request)
    {
        $slider_id = $request->id;
        $old_image = $request->old_img;

        if ($request->file('slider_image')) {
            $request->validate([
                'slider_image' => 'image|max:2048'
            ], [
                'slider_image.image' => 'The uploaded file must be an image in one of the following formats: jpg, jpeg, png, bmp, gif, svg, or webp.',
                'slider_image.max' => 'The maximum upload image size is 2MB.',
            ]);
            $image = $request->file('slider_image');
            $name_gen = hexdec(uniqid()) . '_slider' . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(2376, 807)->save('upload/slider/' . $name_gen);
            $save_url = 'upload/slider/' . $name_gen;

            if (file_exists($old_image)) {
                unlink($old_image);
            }

            Slider::findOrFail($slider_id)->update([
                'slider_title' => $request->slider_title,
                'short_title' => $request->short_title,
                'slider_image' => $save_url,
                'status' => $request->status,
            ]);
            $notification = array(
                'message' => 'Slider Updated With Image Successfully!',
                'alert-type' => 'success'
            );
            return redirect()->route('all.slider')->with($notification);
        } else {
            Slider::findOrFail($slider_id)->update([
                'slider_title' => $request->slider_title,
                'short_title' => $request->short_title,
                'status' => $request->status,
            ]);
            $notification = array(
                'message' => 'Slider Updated Without Image Successfully!',
                'alert-type' => 'success'
            );
            return redirect()->route('all.slider')->with($notification);
        }
    } // End Method

    public function DeleteSlider($id)
    {
        $slider = Slider::findOrFail($id);
        $img = $slider->slider_image;
        unlink($img);
        Slider::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Slider Deleted Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } //End Method



}

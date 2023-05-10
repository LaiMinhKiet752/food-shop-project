<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Category;


class CategoryController extends Controller
{
    public function AllCategory()
    {
        $categories = Category::latest()->get();
        return view('backend.category.category_all', compact('categories'));
    } //End Method


    public function AddCategory()
    {
        return view('backend.category.category_add');
    } //End Method



    public function StoreCategory(Request $request)
    {
        $request->validate([
            'category_image' => 'mimes:jpeg,png,jpg'
        ]);
        $file = $request->file('category_image');
        $ext = $request->file('category_image')->extension();
        $date = date('YmdHi');
        $filename = $date . '_category' . '.' . $ext;
        Image::make($file)->resize(120, 120)->save('upload/category/' . $filename);
        $save_url = 'upload/category/' . $filename;

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->category_slug = strtolower(str_replace(' ', '-', $request->category_name));
        $category->category_image = $save_url;
        $category->save();

        // Category::insert([
        //     'category_name' => $request->category_name,
        //     'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
        //     'category_image' => $save_url,
        // ]);

        $notification = array(
            'message' => 'Category Inserted Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('all.category')->with($notification);
    } //End Method


    public function EditCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    } //End Method


    public function UpdateCategory(Request $request)
    {
        $cat_id = $request->id;
        $old_image = $request->old_image;


        if ($request->file('category_image')) {
            $request->validate([
                'category_image' => 'required|mimes:jpeg,png,jpg'
            ]);
            $file = $request->file('category_image');
            $ext = $request->file('category_image')->extension();
            $date = date('YmdHi');
            $filename = $date . '_category' . '.' . $ext;
            Image::make($file)->resize(120, 120)->save('upload/category/' . $filename);
            $save_url = 'upload/category/' . $filename;

            if (file_exists($old_image)) {
                unlink($old_image);
            }
            Category::findOrFail($cat_id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
                'category_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Category Updated With Image Successfully!',
                'alert-type' => 'success',
            );
            return redirect()->route('all.category')->with($notification);
        } else {
            Category::findOrFail($cat_id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            ]);

            $notification = array(
                'message' => 'Category Updated Without Image Successfully!',
                'alert-type' => 'success',
            );
            return redirect()->route('all.category')->with($notification);
        }
    } //End Method


    public function DeleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $img = $category->category_image;
        unlink($img);
        Category::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Category Deleted Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } //End Method


}

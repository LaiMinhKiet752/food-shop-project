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
        $category_check = Category::onlyTrashed()->get();
        foreach ($category_check as $category) {
            if ($category['category_name'] == $request->category_name) {
                $notification = array(
                    'message' => "This Category Name Has Been Temporarily Removed. Please Check Again In 'Restore Category'",
                    'alert-type' => 'warning',
                );
                return redirect()->back()->with($notification);
            }
        }
        $request->validate([
            'category_image' => 'image|max:2048',
            'category_name' => 'unique:categories'
        ], [
            'category_image.image' => 'The uploaded file must be an image in one of the following formats: jpg, jpeg, png, bmp, gif, svg, or webp.',
            'category_image.max' => 'Maximum image size is 2MB.',
            'category_name.unique' => 'The category name already exists. Please enter another category name.',
        ]);
        $file = $request->file('category_image');
        $filename = hexdec(uniqid()) . '_category' . '.' . $file->getClientOriginalExtension();
        Image::make($file)->resize(120, 120)->save('upload/category/' . $filename);
        $save_url = 'upload/category/' . $filename;

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->category_slug = strtolower(str_replace(' ', '-', $request->category_name));
        $category->category_image = $save_url;
        $category->save();

        $notification = array(
            'message' => 'Category Added Successfully!',
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

        //With Image
        if ($request->file('category_image')) {
            $category_check = Category::onlyTrashed()->get();
            foreach ($category_check as $category) {
                if ($category['category_name'] == $request->category_name) {
                    $notification = array(
                        'message' => "This Category Name Has Been Temporarily Removed. Please Check Again In 'Restore Category'",
                        'alert-type' => 'warning',
                    );
                    return redirect()->back()->with($notification);
                }
            }
            $request->validate([
                'category_image' => 'image|max:2048'
            ], [
                'category_image.image' => 'The uploaded file must be an image in one of the following formats: jpg, jpeg, png, bmp, gif, svg, or webp.',
                'category_image.max' => 'Maximum image size is 2MB.',
            ]);

            $file = $request->file('category_image');
            $filename = hexdec(uniqid()) . '_category' . '.' . $file->getClientOriginalExtension();
            $save_url = 'upload/category/' . $filename;

            $current_category_name = Category::findOrFail($cat_id)->category_name;
            //Text is unchanged
            if ($current_category_name == $request->category_name) {
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
                Image::make($file)->resize(120, 120)->save('upload/category/' . $filename);
                Category::findOrFail($cat_id)->update([
                    'category_image' => $save_url,
                ]);
                $notification = array(
                    'message' => 'Category Updated With Image Successfully!',
                    'alert-type' => 'success',
                );
                return redirect()->route('all.category')->with($notification);
            }
            //Text has changed
            else {
                $request->validate([
                    'category_name' => 'unique:categories'
                ], [
                    'category_name.unique' => 'The category name already exists. Please enter another category name.',
                ]);
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
                Image::make($file)->resize(120, 120)->save('upload/category/' . $filename);
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
            }
        }
        //Without Image
        else {
            $category_check = Category::onlyTrashed()->get();
            foreach ($category_check as $category) {
                if ($category['category_name'] == $request->category_name) {
                    $notification = array(
                        'message' => "This Category Name Has Been Temporarily Removed. Please Check Again In 'Restore Category'",
                        'alert-type' => 'warning',
                    );
                    return redirect()->back()->with($notification);
                }
            }
            $current_category_name = Category::findOrFail($cat_id)->category_name;
            if ($current_category_name == $request->category_name) {
                $notification = array(
                    'message' => 'Category Updated Without Image Successfully!',
                    'alert-type' => 'success',
                );
                return redirect()->route('all.category')->with($notification);
            } else {
                $request->validate([
                    'category_name' => 'unique:categories'
                ], [
                    'category_name.unique' => 'The category name already exists. Please enter another category name.',
                ]);
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

    public function RestoreCategory()
    {
        $categories = Category::onlyTrashed()->get();
        return view('backend.category.category_restore', compact('categories'));
    } //End Method

    public function RestoreCategorySubmit($id)
    {
        Category::whereId($id)->restore();
        $notification = array(
            'message' => 'Category Restored Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } //End Method

    public function RestoreAllCategorySubmit()
    {
        Category::onlyTrashed()->restore();
        $notification = array(
            'message' => 'All Category Restored Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } //End Method
}

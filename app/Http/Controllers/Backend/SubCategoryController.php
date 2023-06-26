<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    public function AllSubCategory()
    {
        $subcategories = SubCategory::latest()->get();
        return view('backend.subcategory.subcategory_all', compact('subcategories'));
    } //End Method

    public function AddSubCategory()
    {
        $categories = Category::orderBy('category_name', 'ASC')->get();
        return view('backend.subcategory.subcategory_add', compact('categories'));
    } //End Method

    public function StoreSubCategory(Request $request)
    {
        $subcategory_check = Subcategory::onlyTrashed()->get();
        foreach ($subcategory_check as $subcategory) {
            if ($subcategory['subcategory_name'] == $request->subcategory_name) {
                $notification = array(
                    'message' => "This Subcategory Name Has Been Temporarily Removed. Please Check Again In 'Restore Subcategory'",
                    'alert-type' => 'warning',
                );
                return redirect()->back()->with($notification);
            }
        }
        $request->validate([
            'subcategory_name' => 'unique:sub_categories'
        ], [
            'subcategory_name.unique' => 'The subcategory name already exists. Please enter another subcategory name.',
        ]);
        $subcategory = new SubCategory();
        $subcategory->category_id = $request->category_id;
        $subcategory->subcategory_name = strtoupper($request->subcategory_name);
        $subcategory->subcategory_slug = strtolower(str_replace(' ', '-', $request->subcategory_name));
        $subcategory->save();

        $notification = array(
            'message' => 'SubCategory Added Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('all.subcategory')->with($notification);
    } //End Method

    public function EditSubcategory($id)
    {
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $subcategory = SubCategory::findOrFail($id);
        return view('backend.subcategory.subcategory_edit', compact('categories', 'subcategory'));
    } //End Method

    public function UpdateSubcategory(Request $request)
    {
        $subcategory_check = Subcategory::onlyTrashed()->get();
        foreach ($subcategory_check as $subcategory) {
            if ($subcategory['subcategory_name'] == $request->subcategory_name) {
                $notification = array(
                    'message' => "This Subcategory Name Has Been Temporarily Removed. Please Check Again In 'Restore Subcategory'",
                    'alert-type' => 'warning',
                );
                return redirect()->back()->with($notification);
            }
        }
        $subcat_id = $request->id;
        $current_subcategory_name = SubCategory::findOrFail($subcat_id)->subcategory_name;
        if ($current_subcategory_name == $request->subcategory_name) {
            SubCategory::findOrFail($subcat_id)->update([
                'category_id' => $request->category_id,
                'subcategory_name' => strtoupper($request->subcategory_name),
                'subcategory_slug' => strtolower(str_replace(' ', '-', $request->subcategory_name)),
            ]);
            $notification = array(
                'message' => 'SubCategory Updated Successfully!',
                'alert-type' => 'success',
            );
            return redirect()->route('all.subcategory')->with($notification);
        } else {
            $request->validate([
                'subcategory_name' => 'unique:sub_categories'
            ], [
                'subcategory_name.unique' => 'The subcategory name already exists. Please enter another subcategory name.',
            ]);
            SubCategory::findOrFail($subcat_id)->update([
                'category_id' => $request->category_id,
                'subcategory_name' => strtoupper($request->subcategory_name),
                'subcategory_slug' => strtolower(str_replace(' ', '-', $request->subcategory_name)),
            ]);

            $notification = array(
                'message' => 'SubCategory Updated Successfully!',
                'alert-type' => 'success',
            );
            return redirect()->route('all.subcategory')->with($notification);
        }
    } //End Method

    public function DeleteSubcategory($id)
    {
        SubCategory::findOrFail($id)->delete();
        $notification = array(
            'message' => 'SubCategory Deleted Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } //End Method

    public function RestoreSubcategory()
    {
        $subcategories = Subcategory::onlyTrashed()->get();
        return view('backend.subcategory.subcategory_restore', compact('subcategories'));
    } //End Method

    public function RestoreSubcategorySubmit($id)
    {
        Subcategory::whereId($id)->restore();
        $notification = array(
            'message' => 'Subcategory Restored Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } //End Method

    public function RestoreAllSubcategorySubmit()
    {
        Subcategory::onlyTrashed()->restore();
        $notification = array(
            'message' => 'All Subcategory Restored Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } //End Method

    public function GetSubCategory($category_id)
    {
        $sub_category = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name', 'ASC')->get();
        return json_encode($sub_category);
    } // End Method
}

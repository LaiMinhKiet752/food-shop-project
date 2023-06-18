<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategogy;
use App\Models\BlogPost;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;

class BlogController extends Controller
{
        public function AllBlogCateogry(){
            $blogcategoryies = BlogCategogy::latest()->get();
            return view('backend.blog.category.blogcategroy_all',compact('blogcategoryies'));
        } // End Method

        public function AddBlogCateogry(){
            return view('backend.blog.category.blogcategroy_add');
        } // End Method

        public function StoreBlogCateogry(Request $request){

            BlogCategogy::insert([
                'blog_category_name' => $request->blog_category_name,
                'blog_category_slug' => strtolower(str_replace(' ', '-',$request->blog_category_name)),
                'created_at' => Carbon::now(),
            ]);

           $notification = array(
                'message' => 'Blog Category Inserted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.blog.category')->with($notification);

        }// End Method

        public function EditBlogCateogry($id){

            $blogcategoryies = BlogCategogy::findOrFail($id);
            return view('backend.blog.category.blogcategroy_edit',compact('blogcategoryies'));

        }// End Method

        public function UpdateBlogCateogry(Request $request){

            $blog_id = $request->id;

            BlogCategogy::findOrFail($blog_id)->update([
                  'blog_category_name' => $request->blog_category_name,
                  'blog_category_slug' => strtolower(str_replace(' ', '-',$request->blog_category_name)),
              ]);

             $notification = array(
                  'message' => 'Blog Category Updated Successfully',
                  'alert-type' => 'success'
              );

              return redirect()->route('admin.blog.category')->with($notification);

          }// End Method

          public function DeleteBlogCateogry($id){
            BlogCategogy::findOrFail($id)->delete();

            $notification = array(
                'message' => 'Blog Category Deleted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }// End Method




public function AllBlogPost(){

    $blogpost = BlogPost::latest()->get();
    return view('backend.blog.postt.blogpost_all',compact('blogpost'));

} // End Method


public function AddBlogPost(){
    $blogcategory = BlogCategogy::latest()->get();
    return view('backend.blog.postt.blogpost_add',compact('blogcategory'));
} // End Method






}




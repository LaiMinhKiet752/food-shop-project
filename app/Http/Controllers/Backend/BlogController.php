<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\BlogPost;
use App\Models\Product;
use App\Models\User;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{
    public function AllBlogCateogry()
    {
        $blogcategories = BlogCategory::latest()->get();
        return view('backend.blog.category.blogcategroy_all', compact('blogcategories'));
    } // End Method

    public function AddBlogCateogry()
    {
        return view('backend.blog.category.blogcategroy_add');
    } // End Method

    public function StoreBlogCateogry(Request $request)
    {
        BlogCategory::insert([
            'blog_category_name' => $request->blog_category_name,
            'blog_category_slug' => strtolower(str_replace(' ', '-', $request->blog_category_name)),
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Blog Category Added Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.blog.category')->with($notification);
    } // End Method

    public function EditBlogCateogry($id)
    {
        $blogcategories = BlogCategory::findOrFail($id);
        return view('backend.blog.category.blogcategroy_edit', compact('blogcategories'));
    } // End Method

    public function UpdateBlogCateogry(Request $request)
    {
        $blog_id = $request->id;
        BlogCategory::findOrFail($blog_id)->update([
            'blog_category_name' => $request->blog_category_name,
            'blog_category_slug' => strtolower(str_replace(' ', '-', $request->blog_category_name)),
        ]);
        $notification = array(
            'message' => 'Blog Category Updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.blog.category')->with($notification);
    } // End Method

    public function DeleteBlogCateogry($id)
    {
        BlogCategory::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Blog Category Deleted Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // End Method



    //////////-----Admin Blog Post Manage-----//////////
    public function AllBlogPost()
    {
        $blogpost = BlogPost::latest()->get();
        return view('backend.blog.post.blogpost_all', compact('blogpost'));
    } // End Method

    public function AddBlogPost()
    {
        $blogcategory = BlogCategory::latest()->get();
        return view('backend.blog.post.blogpost_add', compact('blogcategory'));
    } // End Method

    public function StoreBlogPost(Request $request)
    {
        $request->validate([
            'post_image' => 'image|max:2048',
        ], [
            'post_image.image' => 'The uploaded file must be an image in one of the following formats: jpg, jpeg, png, bmp, gif, svg, or webp.',
            'post_image.max' => 'The maximum upload image size is 2MB.',
        ]);
        $image = $request->file('post_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(1103, 906)->save('upload/blog/' . $name_gen);
        $save_url = 'upload/blog/' . $name_gen;

        BlogPost::insert([
            'category_id' => $request->category_id,
            'post_title' => $request->post_title,
            'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
            'post_short_description' => $request->post_short_description,
            'post_long_description' => $request->post_long_description,
            'post_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Blog Post Added Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.blog.post')->with($notification);
    } // End Method

    public function EditBlogPost($id)
    {
        $blogcategory = BlogCategory::latest()->get();
        $blogpost = BlogPost::findOrFail($id);
        return view('backend.blog.post.blogpost_edit', compact('blogcategory', 'blogpost'));
    } // End Method

    public function UpdateBlogPost(Request $request)
    {
        $post_id = $request->id;
        $old_img = $request->old_image;
        if ($request->file('post_image')) {
            $request->validate([
                'post_image' => 'image|max:2048',
            ], [
                'post_image.image' => 'The uploaded file must be an image in one of the following formats: jpg, jpeg, png, bmp, gif, svg, or webp.',
                'post_image.max' => 'The maximum upload image size is 2MB.',
            ]);
            $image = $request->file('post_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(1103, 906)->save('upload/blog/' . $name_gen);
            $save_url = 'upload/blog/' . $name_gen;

            if (file_exists($old_img)) {
                unlink($old_img);
            }
            BlogPost::findOrFail($post_id)->update([
                'category_id' => $request->category_id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                'post_short_description' => $request->post_short_description,
                'post_long_description' => $request->post_long_description,
                'post_image' => $save_url,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Blog Post Updated With Image Successfully!',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.blog.post')->with($notification);
        } else {
            BlogPost::findOrFail($post_id)->update([
                'category_id' => $request->category_id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                'post_short_description' => $request->post_short_description,
                'post_long_description' => $request->post_long_description,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Blog Post Updated Without Image Successfully!',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.blog.post')->with($notification);
        } // end else

    } // End Method

    public function DeleteBlogPost($id)
    {
        $blogpost = BlogPost::findOrFail($id);
        $img = $blogpost->post_image;
        unlink($img);
        BlogPost::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Blog Post Deleted Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // End Method

    public function AdminBlogComment()
    {
        $comment = BlogComment::where('parent_id', null)->latest()->get();
        return view('backend.blog.comment.comment_all', compact('comment'));
    } // End Method

    public function AdminCommentReply($id)
    {
        $comment = BlogComment::where('id', $id)->first();
        return view('backend.blog.comment.comment_reply', compact('comment'));
    } // End Method

    public function AdminReplyCommentSubmit(Request $request)
    {
        $id = $request->id;
        $blog_post_id = $request->blog_post_id;

        BlogComment::find($id)->update([
            'status' => 1,
        ]);
        BlogComment::insert([
            'blog_post_id' => $blog_post_id,
            'user_id' => 1,
            'parent_id' => $id,
            'comment' => $request->comment,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Reply To Comment Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('admin.blog.comment')->with($notification);
    } // End Method

    public function AdminCommentReplyEdit($id)
    {
        $comment = BlogComment::where('id', $id)->first();
        $comment_admin = BlogComment::where('parent_id', $id)->first();
        return view('backend.blog.comment.comment_edit', compact('comment', 'comment_admin'));
    } // End Method

    public function AdminReplyCommentUpdate(Request $request)
    {
        $id = $request->id;

        BlogComment::find($id)->update([
            'comment' => $request->admin_comment,
        ]);

        $notification = array(
            'message' => 'Comment Updated Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('admin.blog.comment')->with($notification);
    } // End Method



    //////////-----Frontend Blog Post-----//////////
    public function AllBlog()
    {
        $blogcategories = BlogCategory::latest()->get();
        $blogpost = BlogPost::latest()->get();
        $products = Product::where('status', 1)->orderBy('id', 'DESC')->limit(4)->get();
        return view('frontend.blog.home_blog', compact('blogcategories', 'blogpost', 'products'));
    } // End Method

    public function BlogDetails($id, $slug)
    {
        $blogcategories = BlogCategory::latest()->get();
        $blogdetails = BlogPost::findOrFail($id);
        $breadcat = BlogCategory::where('id', $blogdetails->category_id)->get();
        $products = Product::where('status', 1)->orderBy('id', 'DESC')->limit(4)->get();

        $new_value = $blogdetails->visitors + 1;
        $blogdetails->visitors = $new_value;
        $blogdetails->update();

        return view('frontend.blog.blog_details', compact('blogcategories', 'blogdetails', 'breadcat', 'products'));
    } // End Method

    public function BlogPostCategory($id, $slug)
    {
        $blogcategories = BlogCategory::latest()->get();
        $blogpost = BlogPost::where('category_id', $id)->latest()->get();
        $breadcat = BlogCategory::where('id', $id)->first();
        $products = Product::where('status', 1)->orderBy('id', 'DESC')->limit(4)->get();
        return view('frontend.blog.category_post', compact('blogcategories', 'blogpost', 'breadcat', 'products'));
    } // End Method

    public function BlogComments(Request $request)
    {
        if (Auth::check()) {
            $exists = BlogComment::where('user_id', Auth::id())->where('blog_post_id', $request->blog_post_id)->where('parent_id', null)->first();
            if (!$exists) {
                BlogComment::insert([
                    'blog_post_id' => $request->blog_post_id,
                    'user_id' => Auth::user()->id,
                    'comment' => $request->comment,
                    'created_at' => Carbon::now(),
                ]);
                $notification = array(
                    'message' => 'Post Comment Successfully!',
                    'alert-type' => 'success',
                );
                return redirect()->back()->with($notification);
            } else {
                $notification = array(
                    'message' => 'Sorry, You Can Only Comment Once Per Blog Post!',
                    'alert-type' => 'error',
                );
                return redirect()->back()->with($notification);
            }
        } else {
            return redirect()->to('/login');
        }
    } // End Method

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminDashboard()
    {

        return view('admin.index');
    } // End Mehtod


    public function AdminLogin()
    {
        return view('admin.admin_login');
    } // End Mehtod


    public function AdminDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Logout Successfully!',
            'alert-type' => 'success',
        );

        return redirect('/admin/login')->with($notification);
    } // End Mehtod


    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile_view', compact('adminData'));
    } // End Mehtod

    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->vendor_join = $request->vendor_join;
        $data->vendor_short_info = $request->address;

        if ($request->file('photo')) {
            $request->validate([
                'photo' => 'image|max:2048'
            ], [
                'photo.image' => 'The uploaded file must be an image in one of the following formats: jpg, jpeg, png, bmp, gif, svg, or webp.',
                'photo.max' => 'Maximum image size is 2MB.',
            ]);
            $file = $request->file('photo');
            $filename = hexdec(uniqid()) . '_admin' . '.' . $file->getClientOriginalExtension();
            @unlink(public_path('upload/admin_images/' . $data->photo));
            $file->move(public_path('upload/admin_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully!',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    } // End Mehtod

    public function AdminChangePassword()
    {
        return view('admin.admin_change_password');
    } //End Method

    public function AdminUpdatePassword(Request $request)
    {

        //Match the old password
        if (!Hash::check($request->old_password, auth::user()->password)) {
            $notification = array(
                'message' => "Old Password Doesn't Match!",
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        //Update the new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        $notification = array(
            'message' => 'Password Changed Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } //End Method

    public function InActiveVendor()
    {
        $inactiveVendor = User::where('status', 'inactive')->where('role', 'vendor')->latest()->get();
        return view('backend.vendor.inactive_vendor', compact('inactiveVendor'));
    } //End Method

    public function ActiveVendor()
    {
        $activeVendor = User::where('status', 'active')->where('role', 'vendor')->latest()->get();
        return view('backend.vendor.active_vendor', compact('activeVendor'));
    } //End Method

    public function InActiveVendorDetails($id)
    {
        $inactiveVendorDetails = User::findOrFail($id);
        return view('backend.vendor.inactive_vendor_details', compact('inactiveVendorDetails'));
    } //End Method

    public function ActiveVendorApprove(Request $request)
    {
        $vendor_id = $request->id;
        $user = User::findOrFail($vendor_id)->update([
            'status' => 'active',
        ]);
        $notification = array(
            'message' => 'Vendor Active Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('active.vendor')->with($notification);
    } //End Method

    public function ActiveVendorDetails($id)
    {
        $activeVendorDetails = User::findOrFail($id);
        return view('backend.vendor.active_vendor_details', compact('activeVendorDetails'));
    } //End Method

    public function InActiveVendorApprove(Request $request)
    {
        $vendor_id = $request->id;
        $user = User::findOrFail($vendor_id)->update([
            'status' => 'inactive',
        ]);
        $notification = array(
            'message' => 'Vendor InActive Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('inactive.vendor')->with($notification);
    } //End Method
}

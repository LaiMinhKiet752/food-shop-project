<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    public function VendorDashboard()
    {
        return view('vendor.index');
    } //End Method
    public function VendorLogin()
    {
        return view('vendor.vendor_login');
    } //End Method
    public function VendorDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/vendor/login');
    } // End Mehtod 
    public function VendorProfile()
    {
        $id = Auth::user()->id;
        $vendorData = User::find($id);
        return view('vendor.vendor_profile_view', compact('vendorData'));
    } //End Method
    public function VendorProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->vendor_join = $request->vendor_join;
        $data->vendor_short_info = $request->vendor_short_info;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            $ext = $request->file('photo')->extension();
            $date = date('YmdHi');
            $filename = $date . '_vendor' . '.' . $ext;
            @unlink(public_path('upload/vendor_images/' . $data->photo));
            $file->move(public_path('upload/vendor_images'), $filename);
            $data['photo'] = $filename;
        }
        $data->save();
        $notification = array(
            'message' => 'Vendor Profile Updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }//End Method
    public function VendorChangePassword()
    {
        return view('vendor.vendor_change_password');
    } //End Method

    public function VendorUpdatePassword(Request $request)
    {
        //Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
        ], [
            'new_password.regex' => ' Your password must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character.'
        ]);

        //Match the old password
        if (!Hash::check($request->old_password, auth::user()->password)) {
            return back()->with('error', "Old Password Doesn't Match!");
        }
        //Update the new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        return back()->with('status', 'Password Change Successfully!');
    }//End Method
}

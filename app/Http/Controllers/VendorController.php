<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

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

        $notification = array(
            'message' => 'Logout Successfully!',
            'alert-type' => 'success',
        );

        return redirect('/vendor/login')->with($notification);
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
        $data->shop_name = $request->shop_name;
        $data->address = $request->address;
        $data->vendor_join = $request->vendor_join;
        $data->vendor_short_info = $request->vendor_short_info;

        $current_phone_number = User::find($id)->phone;
        $current_email = User::find($id)->email;
        if ($current_phone_number == $request->phone && $current_email == $request->email) {
            if ($request->file('photo')) {
                $request->validate([
                    'photo' => 'image|max:2048'
                ], [
                    'photo.image' => 'The uploaded file must be an image in one of the following formats: jpg, jpeg, png, bmp, gif, svg, or webp.',
                    'photo.max' => 'Maximum image size is 2MB.',
                ]);
                $file = $request->file('photo');
                $filename = hexdec(uniqid()) . '_vendor' . '.' . $file->getClientOriginalExtension();
                @unlink(public_path('upload/vendor_images/' . $data->photo));
                $file->move(public_path('upload/vendor_images/'), $filename);
                $data['photo'] = $filename;
            }
            $data->save();
            $notification = array(
                'message' => 'Vendor Profile Updated Successfully!',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        } else if ($current_phone_number != $request->phone && $current_email == $request->email) {
            $request->validate([
                'phone' => ['unique:' . User::class],
            ], [
                'phone.unique' => 'The phone number already exists. Please enter another phone number.'
            ]);
            if ($request->file('photo')) {
                $request->validate([
                    'photo' => 'image|max:2048'
                ], [
                    'photo.image' => 'The uploaded file must be an image in one of the following formats: jpg, jpeg, png, bmp, gif, svg, or webp.',
                    'photo.max' => 'Maximum image size is 2MB.',
                ]);
                $file = $request->file('photo');
                $filename = hexdec(uniqid()) . '_vendor' . '.' . $file->getClientOriginalExtension();
                @unlink(public_path('upload/vendor_images/' . $data->photo));
                $file->move(public_path('upload/vendor_images/'), $filename);
                $data['photo'] = $filename;
            }
            $data->phone = $request->phone;
            $data->save();
            $notification = array(
                'message' => 'Vendor Profile Updated Successfully!',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        } else if ($current_phone_number == $request->phone && $current_email != $request->email) {
            $request->validate([
                'email' => ['unique:' . User::class],
            ], [
                'email.unique' => 'The email already exists. Please enter another email.'
            ]);
            if ($request->file('photo')) {
                $request->validate([
                    'photo' => 'image|max:2048'
                ], [
                    'photo.image' => 'The uploaded file must be an image in one of the following formats: jpg, jpeg, png, bmp, gif, svg, or webp.',
                    'photo.max' => 'Maximum image size is 2MB.',
                ]);
                $file = $request->file('photo');
                $filename = hexdec(uniqid()) . '_vendor' . '.' . $file->getClientOriginalExtension();
                @unlink(public_path('upload/vendor_images/' . $data->photo));
                $file->move(public_path('upload/vendor_images/'), $filename);
                $data['photo'] = $filename;
            }
            $data->email = $request->email;
            $data->save();
            $notification = array(
                'message' => 'Vendor Profile Updated Successfully!',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        } else if ($current_phone_number != $request->phone && $current_email != $request->email) {
            $request->validate([
                'email' => ['unique:' . User::class],
                'phone' => ['unique:' . User::class],
            ], [
                'email.unique' => 'The email already exists. Please enter another email.',
                'phone.unique' => 'The phone number already exists. Please enter another phone number.'
            ]);
            if ($request->file('photo')) {
                $request->validate([
                    'photo' => 'image|max:2048'
                ], [
                    'photo.image' => 'The uploaded file must be an image in one of the following formats: jpg, jpeg, png, bmp, gif, svg, or webp.',
                    'photo.max' => 'Maximum image size is 2MB.',
                ]);
                $file = $request->file('photo');
                $filename = hexdec(uniqid()) . '_vendor' . '.' . $file->getClientOriginalExtension();
                @unlink(public_path('upload/vendor_images/' . $data->photo));
                $file->move(public_path('upload/vendor_images/'), $filename);
                $data['photo'] = $filename;
            }
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->save();
            $notification = array(
                'message' => 'Vendor Profile Updated Successfully!',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }
    } //End Method
    public function VendorChangePassword()
    {
        return view('vendor.vendor_change_password');
    } //End Method

    public function VendorUpdatePassword(Request $request)
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

    public function BecomeVendor()
    {
        return view('auth.become_vendor');
    } //End Method

    public function VendorRegister(Request $request)
    {
        $request->validate([
            'username' => ['unique:' . User::class],
            'phone' => ['unique:' . User::class],
            'email' => ['unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'captcha_code' => 'captcha',
            'checkbox' => 'accepted'
        ], [
            'username.unique' => 'The user name already exists. Please create another user name.',
            'phone.unique' => 'The phone number already exists. Please create another phone number.',
            'email.unique' => 'The email already exists. Please create another email.',
            'checkbox.accepted' => 'Please agree to our policies to proceed with account registration.'
        ]);

        User::insert([
            'name' => $request->name,
            'username' => $request->username,
            'shop_name' => $request->shop_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'vendor_join' => $request->vendor_join,
            'password' => Hash::make($request->password),
            'role' => 'vendor',
            'status' => 'inactive',
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Vendor Register Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('vendor.login')->with($notification);
    } //End Method

    public function ReloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img('flat')]);
    }
}

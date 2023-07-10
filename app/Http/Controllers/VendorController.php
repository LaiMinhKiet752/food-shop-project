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
use App\Mail\WebsiteMail;
use App\Notifications\VendorRegisterNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

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
            'message' => 'Logged Out Successfully!',
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
                    'photo.max' => 'The maximum upload image size is 2MB.',
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
                    'photo.max' => 'The maximum upload image size is 2MB.',
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
                    'photo.max' => 'The maximum upload image size is 2MB.',
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
                    'photo.max' => 'The maximum upload image size is 2MB.',
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

    public function VendorForgotPassword()
    {
        return view('vendor.vendor_forget_password');
    } //End Method

    public function VendorForgotPasswordSubmit(Request $request)
    {
        $vendor_data = User::where('email', $request->email)->where('role', 'vendor')->first();
        if (!$vendor_data) {
            return redirect()->back()->with('error', 'Email address not found!');
        }
        $token = hash('sha256', time());
        $vendor_data->token = $token;
        $vendor_data->update();
        $reset_link = url('vendor/reset/password/' . $token . '/' . $request->email);
        $subject = 'Reset Password';
        $message = 'Please click on the following link: <br>';
        $message .= '<a href= "' . $reset_link . '">Click here</a>';

        Mail::to($request->email)->send(new WebsiteMail($subject, $message));

        return redirect('/vendor/login')->with('success', 'Check your email and follow the steps there.');
    } //End Method

    public function VendorResetPassword($token, $email)
    {
        $vendor_data = User::where('role', 'vendor')->where('email', $email)->where('token', $token)->first();
        if (!$vendor_data) {
            return redirect('/vendor/login');
        }
        return view('vendor.vendor_reset_password', compact('token', 'email'));
    } //End Method

    public function VendorResetPasswordSubmit(Request $request)
    {
        $vendor_data = User::where('role', 'vendor')->where('email', $request->email)->where('token', $request->token)->first();
        $vendor_data->password = Hash::make($request->password);
        $vendor_data->token = '';
        $vendor_data->update();
        return redirect('/vendor/login')->with('success', 'Password is reset successfully.');
    } //End Method

    public function BecomeVendor()
    {
        return view('auth.become_vendor');
    } //End Method

    public function VendorRegister(Request $request)
    {
        $super_admin_user = User::where('role', 'admin')->where('status','active')->first();
        $all_admin_user = User::where('role', 'admin')->where('status','active')->get();
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
            'message' => 'Vendor Registration Successful!',
            'alert-type' => 'success'
        );

        //Mail To SuperAdmin
        $subject = 'Request to become a vendor';
        $message = 'Registration information to become a vendor: <br>';

        $message .= 'Full Name: ';
        $message .= $request->name;
        $message .= '<br>';

        $message .= 'User Name: ';
        $message .= $request->username;
        $message .= '<br>';

        $message .= 'Shop Name: ';
        $message .= $request->shop_name;
        $message .= '<br>';

        $message .= 'Email: ';
        $message .= $request->email;
        $message .= '<br>';

        $message .= 'Phone Number: ';
        $message .= $request->phone;
        $message .= '<br>';

        Mail::to($super_admin_user->email)->send(new WebsiteMail($subject, $message));

        //Notification To All Admin
        Notification::send($all_admin_user, new VendorRegisterNotification($request));
        return redirect()->route('vendor.login')->with($notification);
    } //End Method

    public function ReloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img('flat')]);
    }

    public function UpdateStatusVendorApprove($id)
    {
        DB::table('notifications')->where('id', $id)->update(['status' => 1]);
        return response()->json([
            'success' => 'OK!'
        ]);
    } // End Method

    public function UpdateStatusVendorDisapprove($id)
    {
        DB::table('notifications')->where('id', $id)->update(['status' => 1]);
        return response()->json([
            'success' => 'OK!'
        ]);
    } // End Method

    public function DeleteAllNotification()
    {
        $user_id = Auth::user()->id;
        DB::table('notifications')->where('notifiable_id', $user_id)->delete();

        $notification = array(
            'message' => 'Successfully Deleted All Notifications!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } // End Method
}

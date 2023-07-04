<?php

namespace App\Http\Controllers;

use App\Mail\WebsiteMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\VendorApproveNotification;
use App\Notifications\VendorDisapproveNotification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

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
            'message' => 'Logged Out Successfully!',
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
        $data->address = $request->address;

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
                $filename = hexdec(uniqid()) . '_admin' . '.' . $file->getClientOriginalExtension();
                @unlink(public_path('upload/admin_images/' . $data->photo));
                $file->move(public_path('upload/admin_images'), $filename);
                $data['photo'] = $filename;
            }
            $data->phone = $request->phone;
            $data->save();
            $notification = array(
                'message' => 'Admin Profile Updated Successfully!',
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
                $filename = hexdec(uniqid()) . '_admin' . '.' . $file->getClientOriginalExtension();
                @unlink(public_path('upload/admin_images/' . $data->photo));
                $file->move(public_path('upload/admin_images'), $filename);
                $data['photo'] = $filename;
            }
            $data->email = $request->email;
            $data->save();
            $notification = array(
                'message' => 'Admin Profile Updated Successfully!',
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
                $filename = hexdec(uniqid()) . '_admin' . '.' . $file->getClientOriginalExtension();
                @unlink(public_path('upload/admin_images/' . $data->photo));
                $file->move(public_path('upload/admin_images'), $filename);
                $data['photo'] = $filename;
            }
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->save();
            $notification = array(
                'message' => 'Admin Profile Updated Successfully!',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }
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
        User::findOrFail($vendor_id)->update([
            'status' => 'active',
            'email_verified_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Vendor Activated Successfully!',
            'alert-type' => 'success',
        );
        $vendor_approve = User::where('id', $vendor_id)->where('role', 'vendor')->first();

        //Mail To Vendor
        $subject = 'Your Account Has Been Approved By Admin';
        $message = 'Welcome to NEST. Now you can use this account to be able to do business on Nest. <br>';
        $message .= 'Username: ';
        $message .= $vendor_approve->username;
        $message .= '<br>';
        $message .= 'Email: ';
        $message .= $vendor_approve->email;
        $message .= '<br>';
        $message .= 'If you need assistance with anything please email: support.nestshop@gmail.com <br>';
        $message .= 'Best regards! <br>';
        $message .= 'Nest Shop';
        Mail::to($vendor_approve->email)->send(new WebsiteMail($subject, $message));

        //Notification To Vendor
        Notification::send($vendor_approve, new VendorApproveNotification($request));
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
        User::findOrFail($vendor_id)->update([
            'status' => 'inactive',
        ]);
        $notification = array(
            'message' => 'Vendor Inactivated Successfully!',
            'alert-type' => 'success',
        );
        $vendor_disapprove = User::where('id', $vendor_id)->where('role', 'vendor')->first();

        //Mail To Vendor
        $subject = 'Your Account Has Been Disapproved By Admin';
        $message = 'It looks like you violated some of our policies, so your account is temporarily locked. <br>';
        $message .= 'Please contact us by: <br>';
        $message .= 'Call the hotline number: 1900 999 <br>';
        $message .= 'Or send an email to the address: support.nestshop@gmail.com <br>';
        $message .= 'Best regards! <br>';
        $message .= 'Nest Shop';
        Mail::to($vendor_disapprove->email)->send(new WebsiteMail($subject, $message));

        //Notification To Vendor
        Notification::send($vendor_disapprove, new VendorDisapproveNotification($request));
        return redirect()->route('inactive.vendor')->with($notification);
    } //End Method

    public function AllAdminAccount()
    {
        $allAdminAccount = User::where('role', 'admin')->latest()->get();
        return view('backend.admin.all_admin_account', compact('allAdminAccount'));
    } //End Method

    public function AddAdminAccount()
    {
        $role = Role::all();
        return view('backend.admin.add_admin_account', compact('role'));
    } //End Method

    public function AdminAccountStore(Request $request)
    {
        $request->validate([
            'username' => ['unique:' . User::class],
            'email' => ['unique:' . User::class],
            'phone' => ['unique:' . User::class],
        ], [
            'username.unique' => 'The user name already exists. Please enter another user name.',
            'email.unique' => 'The email already exists. Please enter another email.',
            'phone.unique' => 'The phone number already exists. Please enter another phone number.'
        ]);
        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->status = 'active';
        $user->email_verified_at = Carbon::now();
        $user->save();
        if ($request->roles) {
            $user->assignRole($request->roles);
        }
        $notification = array(
            'message' => 'Successfully Created New Admin User Account!',
            'alert-type' => 'success',
        );
        return redirect()->route('all.admin.account')->with($notification);
    } //End Method

    public function EditAdminRole($id)
    {
        $user = User::findOrFail($id);
        $role = Role::all();
        return view('backend.admin.edit_admin_account', compact('user', 'role'));
    } //End Method

    public function AdminAccountUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->address = $request->address;
        $user->role = 'admin';
        $user->status = 'active';

        $current_user_name = User::find($id)->username;
        $current_email = User::find($id)->email;
        $current_phone_number = User::find($id)->phone;

        if ($current_user_name == $request->username && $current_email == $request->email && $current_phone_number == $request->phone) {
            $user->update();
            $user->roles()->detach();
            if ($request->roles) {
                $user->assignRole($request->roles);
            }
            $notification = array(
                'message' => 'Successfully Updated Admin User Account!',
                'alert-type' => 'success',
            );
            return redirect()->route('all.admin.account')->with($notification);
        } else if ($current_user_name != $request->username && $current_email == $request->email && $current_phone_number == $request->phone) {
            $request->validate([
                'username' => ['unique:' . User::class],
            ], [
                'username.unique' => 'The user name already exists. Please enter another user name.',
            ]);
            $user->username = $request->username;
            $user->update();
            $user->roles()->detach();
            if ($request->roles) {
                $user->assignRole($request->roles);
            }
            $notification = array(
                'message' => 'Successfully Updated Admin User Account!',
                'alert-type' => 'success',
            );
            return redirect()->route('all.admin.account')->with($notification);
        } else if ($current_user_name == $request->username && $current_email != $request->email && $current_phone_number == $request->phone) {
            $request->validate([
                'email' => ['unique:' . User::class],
            ], [
                'email.unique' => 'The email already exists. Please enter another email.',
            ]);
            $user->email = $request->email;
            $user->update();
            $user->roles()->detach();
            if ($request->roles) {
                $user->assignRole($request->roles);
            }
            $notification = array(
                'message' => 'Successfully Updated Admin User Account!',
                'alert-type' => 'success',
            );
            return redirect()->route('all.admin.account')->with($notification);
        } else if ($current_user_name == $request->username && $current_email == $request->email && $current_phone_number != $request->phone) {
            $request->validate([
                'phone' => ['unique:' . User::class],
            ], [
                'phone.unique' => 'The phone number already exists. Please enter another phone number.',
            ]);
            $user->phone = $request->phone;
            $user->update();
            $user->roles()->detach();
            if ($request->roles) {
                $user->assignRole($request->roles);
            }
            $notification = array(
                'message' => 'Successfully Updated Admin User Account!',
                'alert-type' => 'success',
            );
            return redirect()->route('all.admin.account')->with($notification);
        } else if ($current_user_name != $request->username && $current_email != $request->email && $current_phone_number == $request->phone) {
            $request->validate([
                'username' => ['unique:' . User::class],
                'email' => ['unique:' . User::class],
            ], [
                'username.unique' => 'The user name already exists. Please enter another user name.',
                'email.unique' => 'The email already exists. Please enter another email.',
            ]);
            $user->username = $request->username;
            $user->email = $request->email;
            $user->update();
            $user->roles()->detach();
            if ($request->roles) {
                $user->assignRole($request->roles);
            }
            $notification = array(
                'message' => 'Successfully Updated Admin User Account!',
                'alert-type' => 'success',
            );
            return redirect()->route('all.admin.account')->with($notification);
        } else if ($current_user_name != $request->username && $current_email == $request->email && $current_phone_number != $request->phone) {
            $request->validate([
                'username' => ['unique:' . User::class],
                'phone' => ['unique:' . User::class],
            ], [
                'username.unique' => 'The user name already exists. Please enter another user name.',
                'phone.unique' => 'The phone number already exists. Please enter another phone number.',
            ]);
            $user->username = $request->username;
            $user->phone = $request->phone;
            $user->update();
            $user->roles()->detach();
            if ($request->roles) {
                $user->assignRole($request->roles);
            }
            $notification = array(
                'message' => 'Successfully Updated Admin User Account!',
                'alert-type' => 'success',
            );
            return redirect()->route('all.admin.account')->with($notification);
        } else if ($current_user_name == $request->username && $current_email != $request->email && $current_phone_number != $request->phone) {
            $request->validate([
                'email' => ['unique:' . User::class],
                'phone' => ['unique:' . User::class],
            ], [
                'email.unique' => 'The email already exists. Please enter another email.',
                'phone.unique' => 'The phone number already exists. Please enter another phone number.',
            ]);
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->update();
            $user->roles()->detach();
            if ($request->roles) {
                $user->assignRole($request->roles);
            }
            $notification = array(
                'message' => 'Successfully Updated Admin User Account!',
                'alert-type' => 'success',
            );
            return redirect()->route('all.admin.account')->with($notification);
        } else if ($current_user_name != $request->username && $current_email != $request->email && $current_phone_number != $request->phone) {
            $request->validate([
                'username' => ['unique:' . User::class],
                'email' => ['unique:' . User::class],
                'phone' => ['unique:' . User::class],
            ], [
                'username.unique' => 'The user name already exists. Please enter another user name.',
                'email.unique' => 'The email already exists. Please enter another email.',
                'phone.unique' => 'The phone number already exists. Please enter another phone number.'
            ]);
            $user->username = $request->username;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->update();
            $user->roles()->detach();
            if ($request->roles) {
                $user->assignRole($request->roles);
            }
            $notification = array(
                'message' => 'Successfully Updated Admin User Account!',
                'alert-type' => 'success',
            );
            return redirect()->route('all.admin.account')->with($notification);
        }
    } //End Method

    public function DeleteAdminRole($id)
    {
        $user = User::findOrFail($id);
        if (!is_null($user)) {
            $user->delete();
        }
        $notification = array(
            'message' => 'Successfully Deleted Admin User Account!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } //End Method

    public function DatabaseBackup()
    {
        return view('admin.database_backup')->with('files', File::allFiles(storage_path('/app/Nest')));
    } //End Method

    public function BackupNow()
    {
        Artisan::call('backup:run');

        $notification = array(
            'message' => 'Database Backup Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // End Method

    public function DownloadDatabase($getFilename)
    {
        $path = storage_path('app\Nest/' . $getFilename);
        return response()->download($path);
    } // End Method

    public function DeleteDatabase($getFilename)
    {
        Storage::delete('Nest/' . $getFilename);

        $notification = array(
            'message' => 'Database Deleted Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // End Method
}

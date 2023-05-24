<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function UserDashboard()
    {
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('index', compact('userData'));
    } //End Method
    public function UserProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')) {
            $request->validate([
                'photo' => 'image|max:2048'
            ], [
                'photo.image' => 'The uploaded file must be an image in one of the following formats: jpg, jpeg, png, bmp, gif, svg, or webp.',
                'photo.max' => 'Maximum image size is 2MB.',
            ]);
            $file = $request->file('photo');
            $filename = hexdec(uniqid()) . '_user' . '.' . $file->getClientOriginalExtension();
            @unlink(public_path('upload/user_images/' . $data->photo));
            $file->move(public_path('upload/user_images/'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'User Profile Updated Successfully!',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    } // End Mehtod
    public function UserLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'User Logout Successfully!',
            'alert-type' => 'success',
        );

        return redirect('/login')->with($notification);
    } // End Mehtod
    public function UserUpdatePassword(Request $request)
    {

        //Match the old password
        if (!Hash::check($request->old_password, auth::user()->password)) {
            $notification = array(
                'message' => "Old Password Doesn't Match!",
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        }
        //Update the new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        $notification = array(
            'message' => 'Password Changed Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } //End Method
}

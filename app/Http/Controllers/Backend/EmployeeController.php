<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AdvanceSalary;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class EmployeeController extends Controller
{
    public function AllEmployee()
    {
        $employee = Employee::latest()->get();
        return view('backend.employee.all_employee', compact('employee'));
    } //End Method

    public function AddEmployee()
    {
        return view('backend.employee.add_employee');
    } //End Method

    public function StoreEmployee(Request $request)
    {
        $request->validate([
            'employee_code' => ['unique:' . Employee::class],
            'employee_email' => ['unique:' . Employee::class],
            'employee_phone' => ['unique:' . Employee::class],
            'employee_photo' => 'image|max:2048',
        ], [
            'employee_code.unique' => 'The employee code already exists. Please enter another employee code.',
            'employee_email.unique' => 'The email already exists. Please enter another email.',
            'employee_phone.unique' => 'The phone number already exists. Please enter another phone number.',
            'employee_photo.image' => 'The uploaded file must be an image in one of the following formats: jpg, jpeg, png, bmp, gif, svg, or webp.',
            'employee_photo.max' => 'The maximum upload image size is 2MB.',
        ]);
        $file = $request->file('employee_photo');
        $filename = hexdec(uniqid()) . '_employee' . '.' . $file->getClientOriginalExtension();
        Image::make($file)->resize(110, 110)->save('upload/employee_images/' . $filename);
        $save_url = 'upload/employee_images/' . $filename;

        $employee_id = Employee::insertGetId([
            'employee_code' => strtoupper($request->employee_code),
            'employee_name' => $request->employee_name,
            'employee_email' => $request->employee_email,
            'employee_phone' => $request->employee_phone,
            'employee_address' => $request->employee_address,
            'employee_photo' => $save_url,
            'position' => $request->position,
            'experience' => $request->experience,
            'salary' => $request->salary,
            'created_at' => Carbon::now(),
        ]);

        AdvanceSalary::insert([
            'employee_id' => $employee_id,
            'month' =>  date("F"),
            'year' => date("Y"),
            'advance_salary' => 0,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Employee Added Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('all.employee')->with($notification);
    } //End Method

    public function EditEmployee($id)
    {
        $employee = Employee::findOrFail($id);
        return view('backend.employee.edit_employee', compact('employee'));
    } //End Method

    public function UpdateEmployee(Request $request)
    {
        $employee_id = $request->id;
        $old_image = $request->old_image;

        $data = Employee::find($employee_id);
        $data->employee_name = $request->employee_name;
        $data->employee_address = $request->employee_address;
        $data->position = $request->position;
        $data->experience = $request->experience;
        $data->salary = $request->salary;

        $current_employee_code = Employee::findOrFail($employee_id)->employee_code;
        $current_employee_email = Employee::findOrFail($employee_id)->employee_email;
        $current_employee_phone = Employee::findOrFail($employee_id)->employee_phone;

        if ($current_employee_code == $request->employee_code && $current_employee_email == $request->employee_email && $current_employee_phone == $request->employee_phone) {
            if ($request->file('employee_photo')) {
                $request->validate([
                    'employee_photo' => 'image|max:2048'
                ], [
                    'employee_photo.image' => 'The uploaded file must be an image in one of the following formats: jpg, jpeg, png, bmp, gif, svg, or webp.',
                    'employee_photo.max' => 'The maximum upload image size is 2MB.',
                ]);
                $file = $request->file('employee_photo');
                $filename = hexdec(uniqid()) . '_employee' . '.' . $file->getClientOriginalExtension();
                @unlink(public_path($old_image));
                Image::make($file)->resize(110, 110)->save('upload/employee_images/' . $filename);
                $data['employee_photo'] = 'upload/employee_images/' . $filename;
            }
            $data->save();
            $notification = array(
                'message' => 'Employee Information Update Successfull!',
                'alert-type' => 'success',
            );
            return redirect()->route('all.employee')->with($notification);
        } else if ($current_employee_code != $request->employee_code && $current_employee_email == $request->employee_email && $current_employee_phone == $request->employee_phone) {
            $request->validate([
                'employee_code' => ['unique:' . Employee::class],
            ], [
                'employee_code.unique' => 'The employee code already exists. Please enter another employee code.',
            ]);
            if ($request->file('employee_photo')) {
                $request->validate([
                    'employee_photo' => 'image|max:2048'
                ], [
                    'employee_photo.image' => 'The uploaded file must be an image in one of the following formats: jpg, jpeg, png, bmp, gif, svg, or webp.',
                    'employee_photo.max' => 'The maximum upload image size is 2MB.',
                ]);
                $file = $request->file('employee_photo');
                $filename = hexdec(uniqid()) . '_employee' . '.' . $file->getClientOriginalExtension();
                @unlink(public_path($old_image));
                Image::make($file)->resize(110, 110)->save('upload/employee_images/' . $filename);
                $data['employee_photo'] = 'upload/employee_images/' . $filename;
            }
            $data->employee_code = strtoupper($request->employee_code);
            $data->save();
            $notification = array(
                'message' => 'Employee Information Update Successfull!',
                'alert-type' => 'success',
            );
            return redirect()->route('all.employee')->with($notification);
        } else if ($current_employee_code == $request->employee_code && $current_employee_email != $request->employee_email && $current_employee_phone == $request->employee_phone) {
            $request->validate([
                'employee_email' => ['unique:' . Employee::class],
            ], [
                'employee_email.unique' => 'The email already exists. Please enter another email.',
            ]);
            if ($request->file('employee_photo')) {
                $request->validate([
                    'employee_photo' => 'image|max:2048'
                ], [
                    'employee_photo.image' => 'The uploaded file must be an image in one of the following formats: jpg, jpeg, png, bmp, gif, svg, or webp.',
                    'employee_photo.max' => 'The maximum upload image size is 2MB.',
                ]);
                $file = $request->file('employee_photo');
                $filename = hexdec(uniqid()) . '_employee' . '.' . $file->getClientOriginalExtension();
                @unlink(public_path($old_image));
                Image::make($file)->resize(110, 110)->save('upload/employee_images/' . $filename);
                $data['employee_photo'] = 'upload/employee_images/' . $filename;
            }
            $data->employee_email = $request->employee_email;
            $data->save();
            $notification = array(
                'message' => 'Employee Information Update Successfull!',
                'alert-type' => 'success',
            );
            return redirect()->route('all.employee')->with($notification);
        } else if ($current_employee_code == $request->employee_code && $current_employee_email == $request->employee_email && $current_employee_phone != $request->employee_phone) {
            $request->validate([
                'employee_phone' => ['unique:' . Employee::class],
            ], [
                'employee_phone.unique' => 'The phone number already exists. Please enter another phone number.',
            ]);
            if ($request->file('employee_photo')) {
                $request->validate([
                    'employee_photo' => 'image|max:2048'
                ], [
                    'employee_photo.image' => 'The uploaded file must be an image in one of the following formats: jpg, jpeg, png, bmp, gif, svg, or webp.',
                    'employee_photo.max' => 'The maximum upload image size is 2MB.',
                ]);
                $file = $request->file('employee_photo');
                $filename = hexdec(uniqid()) . '_employee' . '.' . $file->getClientOriginalExtension();
                @unlink(public_path($old_image));
                Image::make($file)->resize(110, 110)->save('upload/employee_images/' . $filename);
                $data['employee_photo'] = 'upload/employee_images/' . $filename;
            }
            $data->employee_phone = $request->employee_phone;
            $data->save();
            $notification = array(
                'message' => 'Employee Information Update Successfull!',
                'alert-type' => 'success',
            );
            return redirect()->route('all.employee')->with($notification);
        } else if ($current_employee_code != $request->employee_code && $current_employee_email != $request->employee_email && $current_employee_phone == $request->employee_phone) {
            $request->validate([
                'employee_code' => ['unique:' . Employee::class],
                'employee_email' => ['unique:' . Employee::class],
            ], [
                'employee_code.unique' => 'The employee code already exists. Please enter another employee code.',
                'employee_email.unique' => 'The email already exists. Please enter another email.',
            ]);
            if ($request->file('employee_photo')) {
                $request->validate([
                    'employee_photo' => 'image|max:2048'
                ], [
                    'employee_photo.image' => 'The uploaded file must be an image in one of the following formats: jpg, jpeg, png, bmp, gif, svg, or webp.',
                    'employee_photo.max' => 'The maximum upload image size is 2MB.',
                ]);
                $file = $request->file('employee_photo');
                $filename = hexdec(uniqid()) . '_employee' . '.' . $file->getClientOriginalExtension();
                @unlink(public_path($old_image));
                Image::make($file)->resize(110, 110)->save('upload/employee_images/' . $filename);
                $data['employee_photo'] = 'upload/employee_images/' . $filename;
            }
            $data->employee_code = strtoupper($request->employee_code);
            $data->employee_email = $request->employee_email;
            $data->save();
            $notification = array(
                'message' => 'Employee Information Update Successfull!',
                'alert-type' => 'success',
            );
            return redirect()->route('all.employee')->with($notification);
        } else if ($current_employee_code != $request->employee_code && $current_employee_email == $request->employee_email && $current_employee_phone != $request->employee_phone) {
            $request->validate([
                'employee_code' => ['unique:' . Employee::class],
                'employee_phone' => ['unique:' . Employee::class],
            ], [
                'employee_code.unique' => 'The employee code already exists. Please enter another employee code.',
                'employee_phone.unique' => 'The phone number already exists. Please enter another phone number.',
            ]);
            if ($request->file('employee_photo')) {
                $request->validate([
                    'employee_photo' => 'image|max:2048'
                ], [
                    'employee_photo.image' => 'The uploaded file must be an image in one of the following formats: jpg, jpeg, png, bmp, gif, svg, or webp.',
                    'employee_photo.max' => 'The maximum upload image size is 2MB.',
                ]);
                $file = $request->file('employee_photo');
                $filename = hexdec(uniqid()) . '_employee' . '.' . $file->getClientOriginalExtension();
                @unlink(public_path($old_image));
                Image::make($file)->resize(110, 110)->save('upload/employee_images/' . $filename);
                $data['employee_photo'] = 'upload/employee_images/' . $filename;
            }
            $data->employee_code = strtoupper($request->employee_code);
            $data->employee_phone = $request->employee_phone;
            $data->save();
            $notification = array(
                'message' => 'Employee Information Update Successfull!',
                'alert-type' => 'success',
            );
            return redirect()->route('all.employee')->with($notification);
        } else if ($current_employee_code == $request->employee_code && $current_employee_email != $request->employee_email && $current_employee_phone != $request->employee_phone) {
            $request->validate([
                'employee_email' => ['unique:' . Employee::class],
                'employee_phone' => ['unique:' . Employee::class],
            ], [
                'employee_email.unique' => 'The email already exists. Please enter another email.',
                'employee_phone.unique' => 'The phone number already exists. Please enter another phone number.',
            ]);
            if ($request->file('employee_photo')) {
                $request->validate([
                    'employee_photo' => 'image|max:2048'
                ], [
                    'employee_photo.image' => 'The uploaded file must be an image in one of the following formats: jpg, jpeg, png, bmp, gif, svg, or webp.',
                    'employee_photo.max' => 'The maximum upload image size is 2MB.',
                ]);
                $file = $request->file('employee_photo');
                $filename = hexdec(uniqid()) . '_employee' . '.' . $file->getClientOriginalExtension();
                @unlink(public_path($old_image));
                Image::make($file)->resize(110, 110)->save('upload/employee_images/' . $filename);
                $data['employee_photo'] = 'upload/employee_images/' . $filename;
            }
            $data->employee_email = $request->employee_email;
            $data->employee_phone = $request->employee_phone;
            $data->save();
            $notification = array(
                'message' => 'Employee Information Update Successfull!',
                'alert-type' => 'success',
            );
            return redirect()->route('all.employee')->with($notification);
        } else if ($current_employee_code != $request->employee_code && $current_employee_email != $request->employee_email && $current_employee_phone != $request->employee_phone) {
            $request->validate([
                'employee_code' => ['unique:' . Employee::class],
                'employee_email' => ['unique:' . Employee::class],
                'employee_phone' => ['unique:' . Employee::class],
            ], [
                'employee_code.unique' => 'The employee code already exists. Please enter another employee code.',
                'employee_email.unique' => 'The email already exists. Please enter another email.',
                'employee_phone.unique' => 'The phone number already exists. Please enter another phone number.',
            ]);
            if ($request->file('employee_photo')) {
                $request->validate([
                    'employee_photo' => 'image|max:2048'
                ], [
                    'employee_photo.image' => 'The uploaded file must be an image in one of the following formats: jpg, jpeg, png, bmp, gif, svg, or webp.',
                    'employee_photo.max' => 'The maximum upload image size is 2MB.',
                ]);
                $file = $request->file('employee_photo');
                $filename = hexdec(uniqid()) . '_employee' . '.' . $file->getClientOriginalExtension();
                @unlink(public_path($old_image));
                Image::make($file)->resize(110, 110)->save('upload/employee_images/' . $filename);
                $data['employee_photo'] = 'upload/employee_images/' . $filename;
            }
            $data->employee_code = strtoupper($request->employee_code);
            $data->employee_email = $request->employee_email;
            $data->employee_phone = $request->employee_phone;
            $data->save();
            $notification = array(
                'message' => 'Employee Information Update Successfull!',
                'alert-type' => 'success',
            );
            return redirect()->route('all.employee')->with($notification);
        }
    } //End Method

    public function DeleteEmployee($id)
    {
        $image = Employee::findOrFail($id)->employee_photo;
        @unlink($image);
        Employee::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Employee Deleted Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } //End Method
}

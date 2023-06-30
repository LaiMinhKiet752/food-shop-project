<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
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

        Employee::insert([
            'employee_code' => $request->employee_code,
            'employee_name' => $request->employee_name,
            'employee_email' => $request->employee_email,
            'employee_phone' => $request->employee_phone,
            'employee_address' => $request->employee_address,
            'employee_photo' => $save_url,
            'experience' => $request->experience,
            'salary' => $request->salary,
            'vacation' => $request->vacation,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Employee Added Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('all.employee')->with($notification);
    } //End Method
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AdvanceSalary;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SalaryController extends Controller
{
    public function AddAdvanceSalary()
    {
        $employee = Employee::latest()->get();
        return view('backend.salary.add_advance_salary', compact('employee'));
    } //End Method

    public function StoreAdvanceSalary(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        $employee_id = $request->employee_id;
        $advanced = AdvanceSalary::where('month', $month)->where('year', $year)->where('employee_id', $employee_id)->first();
        if ($advanced === NULL) {
            AdvanceSalary::insert([
                'employee_id' => $request->employee_id,
                'month' => $request->month,
                'year' => $request->year,
                'advance_salary' => $request->advance_salary,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Advance Salary Paid Successfully!',
                'alert-type' => 'success',
            );
            return redirect()->route('all.advance.salary')->with($notification);
        } else {
            $notification = array(
                'message' => 'Advance Salary Already Paid!',
                'alert-type' => 'warning',
            );
            return redirect()->back()->with($notification);
        }
    } // End Method

    public function AllAdvanceSalary()
    {
        $salary = AdvanceSalary::latest()->get();
        return view('backend.salary.all_advance_salary', compact('salary'));
    } // End Method

    public function EditAdvanceSalary($id)
    {
        $salary = AdvanceSalary::findOrFail($id);
        $employee = Employee::where('id',$salary->employee_id)->first();
        return view('backend.salary.edit_advance_salary', compact('salary', 'employee'));
    } // End Method

    public function UpdateAdvanceSalary(Request $request)
    {
        $salary_id = $request->id;
        AdvanceSalary::findOrFail($salary_id)->update([
            'employee_id' => $request->employee_id,
            'month' => $request->month,
            'year' => $request->year,
            'advance_salary' => $request->advance_salary,
            'updated_at'=>Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Advance Salary Updated Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('all.advance.salary')->with($notification);
    } // End Method

    public function DeleteAdvanceSalary($id)
    {
        AdvanceSalary::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Advance Salary Deleted Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } // End Method
}

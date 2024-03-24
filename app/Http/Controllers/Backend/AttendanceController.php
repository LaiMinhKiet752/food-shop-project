<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use DateTime;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function EmployeeAttendanceList()
    {
        $allData = Attendance::select('date')->groupBy('date')->orderBy('id', 'DESC')->get();
        return view('backend.attendance.view_employee_attendance', compact('allData'));
    } // End Methodz

    public function AddEmployeeAttendance()
    {
        $employees = Employee::all();
        return view('backend.attendance.add_employee_attendance', compact('employees'));
    } // End Method

    public function EmployeeAttendanceStore(Request $request)
    {
        Attendance::where('date', date('d-m-Y', strtotime($request->date)))->delete();
        $count_employee = count($request->employee_id);
        for ($i = 0; $i < $count_employee; $i++) {
            $attendance_status = 'status' . $i;
            $attendance = new Attendance();
            $attendance->employee_id = $request->employee_id[$i];
            $attendance->date = date('d-m-Y', strtotime($request->date));
            $attendance->day = date('d', strtotime($request->date));
            $attendance->month = date('m', strtotime($request->date));
            $attendance->year = date('Y', strtotime($request->date));
            $attendance->status  = $request->$attendance_status;
            $attendance->save();
        }
        $notification = array(
            'message' => 'Data Saved Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('employee.attendance.list')->with($notification);
    } // End Method

    public function EditEmployeeAttendance($date)
    {
        $employees = Employee::all();
        $editData = Attendance::where('date', $date)->get();
        return view('backend.attendance.edit_employee_attendance', compact('employees', 'editData'));
    } // End Method

    public function ViewEmployeeAttendance($date)
    {
        $details = Attendance::where('date', $date)->get();
        return view('backend.attendance.details_employee_attendance', compact('details'));
    } // End Method

    public function TimekeepingByMonth()
    {
        return view('backend.attendance.view_employee_attendance_by_month');
    } // End Method

    public function TimekeepingSearchByMonth(Request $request)
    {
        $format_month = $request->month;
        $format_year = $request->year;

        $allData = Attendance::where('month', $format_month)->where('year', $format_year)->select('employee_id')->groupBy('employee_id')->latest()->get();
        return view('backend.attendance.search_employee_attendance_by_month', compact('allData', 'format_month', 'format_year'));
    } // End Method
}

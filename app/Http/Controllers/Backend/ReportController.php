<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function ReportView()
    {
        return view('backend.report.report_view');
    } //End Method

    public function SearchByDate(Request $request)
    {
        $date = new DateTime($request->date);
        $format_day = $date->format('d');
        $format_month = $date->format('m');
        $format_year = $date->format('Y');
        $orders = Order::where('order_day', $format_day)->where('order_month', $format_month)->where('order_year', $format_year)->latest()->get();
        return view('backend.report.report_by_date', compact('orders', 'format_day', 'format_month', 'format_year'));
    } //End Method

    public function SearchByMonth(Request $request)
    {
        $month = $request->month;
        $year = $request->year_name;
        $orders = Order::where('order_month', $month)->where('order_year', $year)->latest()->get();
        return view('backend.report.report_by_month', compact('orders', 'month', 'year'));
    } //End Method

    public function SearchByYear(Request $request)
    {
        $year = $request->year;
        $orders = Order::where('order_year', $year)->latest()->get();
        return view('backend.report.report_by_year', compact('orders', 'year'));
    } //End Method

    public function ReportByCustomer()
    {
        $users = User::where('role', 'user')->latest()->get();
        return view('backend.report.report_by_customer', compact('users'));
    } //End Method

    public function SearchByCustomer(Request $request)
    {
        $users = $request->user;
        $orders = Order::where('user_id', $users)->latest()->get();
        $user_info = User::where('id', $users)->first();
        return view('backend.report.report_by_customer_show', compact('user_info', 'orders'));
    } //End Method
}

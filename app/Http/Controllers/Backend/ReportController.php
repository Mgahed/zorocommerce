<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use DateTime;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function ReportView()
    {

        return view('admin.report.report_view');
    }


    public function ReportByDate(Request $request)
    {
        // return $request->all();
        $date = new DateTime($request->date);
        $formatDate = $date;/*->format('d F Y');*/
        // return $formatDate;
        $orders = Order::whereDate('created_at', $formatDate)->latest()->get();
        return view('admin.report.report_show', compact('orders'));


    } // end mehtod


    public function ReportByMonth(Request $request)
    {
        /*return $request;*/
        $date = new DateTime($request->month);
        $month = $date->format('m');
        $year = $date->format('Y');
        $orders = Order::whereMonth('created_at', $month)->whereYear('created_at', $year)->latest()->get();
        return view('admin.report.report_show', compact('orders'));

    } // end mehtod


    public function ReportByYear(Request $request)
    {

        $orders = Order::whereYear('created_at', $request->year)->latest()->get();
        return view('admin.report.report_show', compact('orders'));

    } // end mehtod
}

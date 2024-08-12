<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Exports\ReportExcel;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('backend.report.index');
    }

    public function export(Request $request)
    {
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $loginUser = auth()->user()->first_name . ' ' . auth()->user()->last_name;

        return Excel::download(new ReportExcel($startDate, $endDate, $loginUser), 'laporan.xlsx');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Employee;
use App\Models\History;

class DateRangeController extends Controller
{
    function index(Request $request)
    {
        if(request()->ajax()) {

            if(!empty($request->from_date)) {

                $data = DB::table('histories')
                    ->whereBetween('created_at', array($request->from_date, $request->to_date))
                    ->get();

            } else {

                $data = DB::table('histories')
                    ->get();

            }

            return datatables()->of($data)->make(true);
        }

        return view('admin.payment.history');
    }
}
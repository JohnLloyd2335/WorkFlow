<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminJobController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Job::with(['employer'])->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('salary', function ($row) {
                    return '₱' . number_format($row->salary, 2);
                })
                ->addColumn('employer', function($row){
                    return $row->employer->user->name;
                })
                ->addColumn('company', function($row){
                    return $row->employer->company_name;
                })
                ->rawColumns(['salary'.'employer','company'])
                ->make(true);
        }

        return view('admin.job');
    }
}

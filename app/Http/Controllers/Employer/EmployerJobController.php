<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employer\StoreJobRequest;
use App\Http\Requests\Employer\UpdateJobRequest;
use App\Models\Job;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmployerJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Job::where('employer_id', auth()->user()->employer->id)->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('salary', function ($row) {
                    return '₱' . number_format($row->salary, 2);
                })
                ->addColumn('action', function ($row) {
                    return
                        "<div class='d-flex align-items-center justify-content-arround gap-2'>
                            <a href='" . route('employer.jobs.edit', $row) . "' class='btn btn-primary btn-sm'><span class='mdi mdi-pencil'></span></a>
                                <button data-id='$row->id' class='btn btn-danger btn-sm text-light deleteJobButton'><span class='mdi mdi-delete'></span></button>
                        </div>";
                })
                ->rawColumns(['action', 'salary'])
                ->make(true);
        }
        return view('employer.jobs.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employer.jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobRequest $request)
    {

        $employer_id = auth()->user()->employer->id;

        if (!in_array($request->work_type, ['Onsite', 'Hybrid'])) {
            $request->location = 'Not Applicable';
        }

        Job::create([
            'employer_id' => $employer_id,
            'title' => $request->title,
            'description' => $request->description,
            'salary' => $request->salary,
            'work_type' => $request->work_type,
            'location' => $request->location
        ]);

        return redirect(route('employer.jobs.index'))->with('success', 'Job Successfully Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        return view('employer.jobs.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobRequest $request, Job $job)
    {

        if (!in_array($request->work_type, ['Onsite', 'Hybrid'])) {
            $request->location = 'Not Applicable';
        }

        $job->update([
            'title' => $request->title,
            'description' => $request->description,
            'salary' => $request->salary,
            'work_type' => $request->work_type,
            'location' => $request->location
        ]);

        return redirect(route('employer.jobs.index'))->with('success', 'Job Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        $job->delete();

        return redirect(route('employer.jobs.index'))->with('success', 'Job Successfully Deleted');
    }
}

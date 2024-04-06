<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminApplicationController extends Controller
{
    public function index(Request $request)
    {
        $jobs = Job::has('applications')->with(['applications'])->withCount(['applications' => function ($query) {
            $query->whereIn('application_status', ['Pending', 'Interview Scheduled']);
        }])->get();

        if ($request->ajax()) {
            return DataTables::of($jobs)
                ->addIndexColumn()
                ->addColumn('application_id', function ($job) {
                    return $job->applications[0]->id;
                })
                ->addColumn('salary', function ($job) {
                    return "₱" . number_format($job->salary, 2);
                })
                ->addColumn('action', function ($job) {
                    return
                        "<div class='d-flex align-items-center justify-content-arround gap-2'>
                    <a href='" . route('admin.applications.show', $job->id) . "' class='btn btn-success btn-sm text-light'><span class='mdi mdi-eye'></span></a>
                </div>";
                })
                ->rawColumns(['application_id', 'action', 'salary'])
                ->make(true);
        }

        return view('admin.applications.index');
    }

    public function show(string $id, Request $request)
    {
        $job = Job::with('employer')->withCount(['applications' => function ($query) {
            $query->whereIn('application_status', ['Pending', 'Interview Scheduled']);
        }])->find($id);

        $applications = Application::with('jobSeeker')->where('job_id', $id)->get();

        if ($request->ajax()) {
            return DataTables::of($applications)
                ->addIndexColumn()
                ->addColumn('applicant_name', function ($application) {
                    return $application->jobSeeker->user->name;
                })
                ->addColumn('applicant_email', function ($application) {
                    return $application->jobSeeker->user->email;
                })
                ->addColumn('applicant_mobile_number', function ($application) {
                    return $application->jobSeeker->user->mobile_number;
                })
                ->addColumn('resume', function ($application) {

                    $resume = $application->jobSeeker->getMedia('resumes');

                    return  "<a target='_blank' href='" . $application->jobSeeker->getFirstMediaUrl('resumes') . "' class='rounded px-1 text-dark d-flex align-items-center justify-content-start gap-1 lead text-decoration-underline' ><span class='mdi mdi-file-pdf-box' style='font-size: 30px'></span>
                " . $resume[0]->name . ".pdf
                </a>";
                })
                ->addColumn('action', function ($application) {
                    return "<a href='" . route('admin.application.applicant.show', $application->id) . "' class='btn btn-success btn-sm text-light'><span class='mdi mdi-eye'></span></a>";
                })
                ->addColumn('application_date', function ($application) {
                    return date('M d, Y h:i A', strtotime($application->application_date));
                })
                ->rawColumns(['applicant_name', 'resume', 'applicant_email', 'applicant_mobile_number', 'application_date', 'action'])
                ->make(true);
        }

        return view('admin.applications.show', compact('job', 'applications'));
    }

    public function showApplicant(string $id)
    {

        $application = Application::findOrFail($id);

        return view('admin.applications.applicant_show', compact('application'));
    }
}

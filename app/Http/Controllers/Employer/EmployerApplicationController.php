<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employer\UpdateApplicationStatusRequest;
use App\Mail\Application\InterviewScheduledApplication;
use App\Mail\Application\RejectedApplication;
use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class EmployerApplicationController extends Controller
{
    public function index(Request $request)
    {
        $jobs = Job::has('applications')->with(['applications'])->withCount(['applications' => function ($query) {
            $query->whereIn('application_status', ['Pending', 'Interview Scheduled']);
        }])->where('employer_id', auth()->user()->employer->id)->get();


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
                    <a href='" . route('employer.applications.show', $job->id) . "' class='btn btn-success btn-sm text-light'><span class='mdi mdi-eye'></span></a>
                </div>";
                })
                ->rawColumns(['application_id', 'salary', 'action'])
                ->make(true);
        }

        return view('employer.applications.index');
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
                    $applicant_show_route = route('employer.application.applicant.show', $application->id);
                    $applicant_edit_route = route('employer.application.applicant.edit', $application);
                    $editButtonClass = in_array($application->application_status, ['Rejected', 'Withdrawn', 'Hired']) ? 'disabled' : '';

                    return "<div class='d-flex align-items-center justify-content-center gap-2'><a href='$applicant_show_route' class='btn btn-success btn-sm text-light'><span class='mdi mdi-eye'></span></a> <a href='$applicant_edit_route' class='btn btn-primary btn-sm text-light $editButtonClass'</a><span class='mdi mdi-pencil'></span></a><div>";
                })
                ->addColumn('application_date', function ($application) {
                    return date('M d, Y h:i A', strtotime($application->application_date));
                })
                ->rawColumns(['applicant_name', 'resume', 'applicant_email', 'applicant_mobile_number', 'application_date', 'action'])
                ->make(true);
        }

        return view('employer.applications.show', compact('job', 'applications'));
    }

    public function showApplicant(string $id)
    {

        $application = Application::findOrFail($id);



        return view('employer.applications.applicant_show', compact('application'));
    }

    public function edit(Application $application)
    {

        return view('employer.applications.edit', compact('application'));
    }

    public function update(Application $application, UpdateApplicationStatusRequest $request)
    {

        if ($request->has('application_status')) {

            $application->load(['jobSeeker', 'job']);

            $receiver = $application->jobSeeker->user->email;

            $mailData = [
                'job_seeker' => $application->jobSeeker->user->name,
                'position_applied' => $application->job->title,
                'company_name' => $application->job->employer->company_name
            ];

            if ($request->application_status == "Interview Scheduled") {
                $mailData['date_time'] = $request->interview_date_time;
                Mail::to($receiver)->send(new InterviewScheduledApplication($mailData));
            } else {
                $mailData['rejection_reason'] = $request->rejection_reason;
                Mail::to($receiver)->send(new RejectedApplication($mailData));
            }

            $application->update([
                'application_status' => $request->application_status
            ]);
        }

        return redirect(route('employer.applications.show', $application->job))->with('success', 'Application Status Successfully Updated');
    }
}

<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Job;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JobSeekerApplicationController extends Controller
{

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $applications = Application::with('jobSeeker', 'job')->where('job_seeker_id', auth()->user()->jobSeeker->id)->get();

            return DataTables::of($applications)
                ->addIndexColumn()
                ->addColumn('job_title', function ($application) {
                    return $application->job->title;
                })
                ->addColumn('company', function ($application) {
                    return $application->job->employer->company_name;
                })
                ->addColumn('work_type', function ($application) {
                    return $application->job->work_type;
                })
                ->addColumn('salary', function ($application) {
                    return "₱" . number_format($application->job->salary, 2);
                })
                ->addColumn('date_applied', function ($application) {
                    return $application->created_at->format('M d, Y');
                })
                ->addColumn('action', function ($application) {
                    $isDisabled = in_array($application->application_status, ['Hired', 'Rejected', 'Withdrawn']) ? 'disabled' : '';

                    return
                        "<div class='d-flex align-items-center justify-content-around gap-2'>
                        <a href='" . route('job_seeker.application.show', $application) . "' class='btn btn-success btn-sm'><i class='fas fa-eye'></i></a> 
                            <button data-id='$application->id' class='btn btn-danger btn-sm text-light withDrawnButton' " . $isDisabled . ">
                                <i class='fa-solid fa-x'></i>
                            </button>
                        </form>
                    </div>";
                })
                ->rawColumns(['job_title', 'company', 'work_type', 'salary', 'date_applied', 'action'])
                ->make(true);
        }

        return view('job_seeker.applications.index');
    }

    public function show(Application $application)
    {

        return view('job_seeker.applications.show', compact('application'));
    }

    public function store(Job $job)
    {
        if (!isset(auth()->user()->jobSeeker->resume_file_path)) {
            return redirect(route('job_seeker.jobs.show', $job))->with('error', 'Please upload resume before applying for a job');
        }

        $application_duplicate_count = Application::where('job_seeker_id', auth()->user()->jobSeeker->id)
            ->where('job_id', $job->id)->count();
        if ($application_duplicate_count > 0) {
            return redirect(route('job_seeker.jobs.show', $job))->with('error', 'You Already applied in this Job');
        }

        Application::create([
            'job_id' => $job->id,
            'job_seeker_id' => auth()->user()->jobSeeker->id,
            'application_status' => 'Pending',
            'application_date' => Carbon::now()
        ]);

        return redirect(route('job_seeker.jobs.show', $job))->with('success', 'Application Successful');
    }

    public function withdrawn($id)
    {

        $application = Application::findOrFail($id);

        $application->update([
            'application_status' => 'Withdrawn'
        ]);

        return redirect()->route('job_seeker.application.index')->with('success', 'Application Successfully Withdrawn');
    }
}

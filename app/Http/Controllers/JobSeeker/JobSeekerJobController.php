<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use App\Models\Job;

class JobSeekerJobController extends Controller
{

    public function index()
    {

        return view('job_seeker.jobs.index');
    }

    public function show(Job $job)
    {
        $job->load('employer');

        $bookmark_job_ids = Bookmark::where('job_seeker_id', auth()->user()->jobSeeker->id)
            ->pluck('job_id')
            ->toArray();

        $application_job_ids = Application::where('job_seeker_id', auth()->user()->jobSeeker->id)
            ->whereIn('application_status', ['Pending', 'Interview Scheduled', 'Hired'])
            ->pluck('job_id')
            ->toArray();


        return view('job_seeker.jobs.show', compact('job', 'bookmark_job_ids', 'application_job_ids'));
    }
}

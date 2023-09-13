<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use App\Models\Job;

class JobSeekerJobController extends Controller
{
    public function show(Job $job)
    {
        $job->load('employer');
        $bookmark_job_ids = Bookmark::where('job_seeker_id', auth()->user()->jobSeeker->id)
        ->pluck('job_id')
        ->toArray();

        $application_job_ids = Application::where('job_seeker_id', auth()->user()->jobSeeker->id)
        ->pluck('job_id')
        ->toArray();

        // dd($application_job_ids);

        return view('job_seeker.job',compact('job','bookmark_job_ids','application_job_ids'));
    }

    
}

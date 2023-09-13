<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;

class EmployerDashboardController extends Controller
{
    public function index(){

        $posted_jobs_count = Job::where('employer_id',auth()->user()->employer->id)->count();

        $hired_job_seekers_count = Job::whereHas('applications', function ($query) {
            $query->where('application_status', 'Hired');
        })
        ->where('employer_id', auth()->user()->employer->id)
        ->count();

        $pending_job_seekers_count = Job::whereHas('applications', function ($query) {
            $query->where('application_status', 'Pending');
        })
        ->where('employer_id', auth()->user()->employer->id)
        ->count();

        $withdrawn_job_seekers_count = Job::whereHas('applications', function ($query) {
            $query->where('application_status', 'Withdrawn');
        })
        ->where('employer_id', auth()->user()->employer->id)
        ->count();

        $rejected_job_seekers_count = Job::whereHas('applications', function ($query) {
            $query->where('application_status', 'Rejected');
        })
        ->where('employer_id', auth()->user()->employer->id)
        ->count();

        $total_applications = Job::has('applications')->where('employer_id',auth()->user()->employer->id)->count();

        $recent_applications = Job::with(['applications' => function($query){
            $query->orderByDesc('application_date');
        }])->has('applications')->where('employer_id',auth()->user()->employer->id)
        ->limit(3)
        ->get();

        //dd($recent_applications[0]->applications[0]->jobSeeker->user->name);



        return view('employer.dashboard',compact('posted_jobs_count','hired_job_seekers_count','pending_job_seekers_count','withdrawn_job_seekers_count','rejected_job_seekers_count','total_applications','recent_applications'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(){

        $posted_jobs_count = Job::count();

        $hired_job_seekers_count = Job::whereHas('applications', function ($query) {
            $query->where('application_status', 'Hired');
        })
        ->count();

        $pending_job_seekers_count = Job::whereHas('applications', function ($query) {
            $query->where('application_status', 'Pending');
        })
        ->count();

        $withdrawn_job_seekers_count = Job::whereHas('applications', function ($query) {
            $query->where('application_status', 'Withdrawn');
        })
        ->count();

        $rejected_job_seekers_count = Job::whereHas('applications', function ($query) {
            $query->where('application_status', 'Rejected');
        })
        ->count();

        $total_applications = Job::has('applications')->count();

        $recent_applications = Job::with(['applications' => function($query){
            $query->orderByDesc('application_date');
        }])->has('applications')
        ->limit(3)
        ->get();

        return view('admin.dashboard',compact('posted_jobs_count','hired_job_seekers_count','pending_job_seekers_count','withdrawn_job_seekers_count','rejected_job_seekers_count','total_applications','recent_applications'));
    }
}

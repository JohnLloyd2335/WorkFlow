<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Job;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $jobs = Job::with('employer')->paginate(3);
    
        $bookmark_job_ids = Bookmark::where('job_seeker_id', auth()->user()->jobSeeker->id)
            ->pluck('job_id')
            ->toArray();
    
        $selectedOption = "";
    
        if ($request->ajax()) {
            $jobs = Job::with('employer');
    
            if (isset($request->work_type) && $request->has('work_type')) {
                $selectedOption = $request->work_type;
                $jobs->where('work_type', $request->work_type);
            }

            if(isset($request->min,$request->max) && $request->has(['max','min'])){


                $jobs->whereBetween('salary',[$request->input('min'),$request->input('max')]);
            }
    
            $jobs = $jobs->paginate(3);
    
            $bookmark_job_ids = Bookmark::where('job_seeker_id', auth()->user()->jobSeeker->id)
                ->pluck('job_id')
                ->toArray();
    
            return view('job_seeker.partials.jobs', compact('jobs', 'bookmark_job_ids', 'selectedOption'));
        }
    
        return view('job_seeker.home', compact('jobs', 'bookmark_job_ids', 'selectedOption'));
    }

}

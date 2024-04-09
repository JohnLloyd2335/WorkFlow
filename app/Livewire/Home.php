<?php

namespace App\Livewire;

use App\Models\Bookmark;
use App\Models\Job;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
    public $search;
    public $work_type;
    public $min;
    public $max;

    use WithPagination;


    public function render(Request $request)
    {

        $jobs = Job::with('employer');

        $bookmark_job_ids = Bookmark::where('job_seeker_id', auth()->user()->jobSeeker->id)
            ->pluck('job_id')
            ->toArray();

        if (!empty($this->work_type)) {
            $jobs->where('work_type', $this->work_type);
        }


        if (!empty($this->search)) {
            $jobs->where('title', 'like', '%' . $this->search . '%');
        }

        $jobs = $jobs->paginate(3);

        $bookmark_job_ids = Bookmark::where('job_seeker_id', auth()->user()->jobSeeker->id)
            ->pluck('job_id')
            ->toArray();

        return view('livewire.home', compact('jobs', 'bookmark_job_ids'));
    }
}

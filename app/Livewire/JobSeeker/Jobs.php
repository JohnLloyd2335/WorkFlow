<?php

namespace App\Livewire\JobSeeker;

use App\Models\Bookmark;
use App\Models\Job;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class Jobs extends Component
{

    use WithPagination;

    public function render()
    {
        $jobs = Job::with('employer')->paginate(3);

        return view('livewire.job-seeker.jobs', ['jobs' => $jobs]);
    }
}

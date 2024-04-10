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

    public string $search;

    public array $job_types;

    public string $selectedJobType;

    public function mount()
    {
        $this->job_types = ['Work from Home', 'Onsite', 'Hybrid'];
    }

    public function render()
    {
        $jobs = Job::with('employer');

        if (isset($this->search)) {
            $jobs->where('title', 'like', '%' . $this->search . '%')
                ->orWhereHas('employer', function ($query) {
                    $query->where('company_name', 'like', '%' . $this->search . '%');
                });
        }

        if (isset($this->selectedJobType) && !$this->selectedJobType == 0) {
            $jobs->where('work_type', 'like', '%' . $this->selectedJobType . '%');
        }

        $jobs = $jobs->oldest()->paginate(3);

        return view('livewire.job-seeker.jobs', ['jobs' => $jobs]);
    }
}

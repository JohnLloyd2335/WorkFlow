<div>
    <div class="container-fluid my-5 mx-2">
        <div class="row">
            <div class="col-xl-4 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Filter Job</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <input type="text" class="form-control" placeholder="Job Title..." id="search-job" />
                                <button class="btn btn-dark my-2 w-100 main-button">
                                    Search
                                </button>
                            </div>
                            <div class="col-12 my-2">
                                <label class="input-label">Filter by Job Type</label>
                                <select name="" class="form-control" id="worktype-filter">
                                    <option value="Option1">Option1</option>
                                </select>
                                <button class="btn btn-dark my-2 w-100 main-button">
                                    Filter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-md-12 col-sm-12">
                <div class="card my-1">
                    <div class="card-header">Available Jobs</div>
                    <div class="card-body">

                        @forelse ($jobs as $job)
                            <div class="jobs border px-4 py-4">
                                <a id="job-title"
                                    href="{{ route('job_seeker.jobs.show', $job) }}">{{ $job->title }}</a>\
                                <div class="items my-2">
                                    <span>{{ $job->employer->company_name }}</span>
                                </div>
                                <p class="job-description">
                                    {{ $job->description }}
                                </p>
                                <div class="job-info">
                                    <div class="items mr-5">
                                        <i class="fas fa-briefcase fa-2x mr-2"></i><span>{{ $job->work_type }}</span>
                                    </div>
                                    @if (!in_array($job->work_type, ['Work from Home']))
                                        <div class="items mr-5">
                                            <i
                                                class="fas fa-location-arrow fa-2x mr-2"></i><span>{{ $job->location }}</span>
                                        </div>
                                    @endif
                                    <div class="items mr-5">
                                        <i
                                            class="fas fa-money-bill fa-2x mr-2"></i><span>{{ '₱' . number_format($job->salary, 2) }}</span>
                                    </div>
                                    <div class="items mr-5">
                                        <i
                                            class="fas fa-calendar fa-2x mr-2"></i><span>{{ $job->created_at->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <h3 class="text-center">No Job Found</h3>
                        @endforelse


                    </div>
                </div>

                <div class="pagination d-flex align-items-center justify-content-center my-5">
                    {{ $jobs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<div>
    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="row my-2">
                    <div class="col">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="d-flex align-items-center justify-content-arround gap-2">
                            <input type="search" name="" id="" class="form-control"
                                placeholder="Search for Jobs.." wire:model.live="search">
                            {{-- <button type="submit" class="btn btn-primary"><i
                                    class="fa-solid fa-magnifying-glass"></i></button> --}}
                        </div>
                    </div>




                    <div class="row mt-2">
                        <div class="col-md-4 border p-1">
                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                            aria-controls="panelsStayOpen-collapseOne">
                                            Filter by Work Type
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                        <div class="accordion-body py-5">
                                            <select name="work_type" class="form-control" id="work_type"
                                                wire:change="work_type">
                                                <option value="All">All</option>
                                                <option value="Onsite">Onsite</option>
                                                <option value="Hybrid">Hybrid</option>
                                                <option value="Work from Home">Work from Home</option>
                                            </select>

                                            <div class="float-end my-2 py-1">
                                                <a href="{{ route('home') }}">Clear</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo"
                                            aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo">
                                            Filter by Salary
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show">
                                        <div class="accordion-body">

                                            <div class="d-flex align-items-center justify-content-arround my-1 gap-2">
                                                <input type="number" name="min" id="min" class="form-control"
                                                    placeholder="MIN" value="0" wire:model="min">
                                                <input type="number" name="max" id="max" class="form-control"
                                                    placeholder="MAX" value="0" wire:model="max">
                                            </div>

                                            <button class="btn btn-outline-primary w-100 mt-1"
                                                id="filter-salary">Apply</button>
                                            <a href="{{ route('home') }}"
                                                class="btn btn-outline-primary w-100 mt-1">Clear</a>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="col-md-8 border d-flex flex-column" id="job-list">

                            @forelse ($jobs as $job)
                                <!-- -->
                                <div class="card px-2 py-3 mt-1">
                                    <div class="row d-flex justify-content-between">
                                        <div class="col col-md-10" style="line-height: 0">
                                            <h4>{{ $job->title }}</h4>
                                            <p class="small">{{ $job->created_at->format('M d, Y') }}</p>
                                            <p class="small">{{ $job->employer->company_name }}</p>
                                        </div>
                                        <div class="col col-md-2">
                                            <form action="{{ route('bookmark.store', $job) }}" method="post">
                                                @csrf
                                                <button @disabled(in_array($job->id, $bookmark_job_ids)) type="submit"
                                                    class="btn btn-outline-secondary text-dark float-end"><i
                                                        class="fa-solid fa-bookmark "></i></button>
                                            </form>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col col-md-12">
                                            <p
                                                style="text-align: justify; text-justify: inter-word;  overflow: hidden; text-overflow: ellipsis; display: -webkit-box;-webkit-line-clamp: 4; line-clamp: 4; -webkit-box-orient: vertical;">
                                                {{ $job->description }}</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col col-md-10 col-sm-10">
                                            <span>
                                                <span class="fa-solid fa-briefcase"></span>
                                                <span>{{ $job->work_type }}</span>
                                            </span>
                                            @if (in_array($job->work_type, ['Onsite', 'Hybrid']))
                                                <span>
                                                    <i class="fa-solid fa-location-pin"></i>
                                                    <span>{{ $job->location }}</span>
                                                </span>
                                            @endif
                                            <span>
                                                <i class="fa-solid fa-money-check-dollar"></i>
                                                <span>{{ '₱' . number_format($job->salary, 2) }}</span>
                                            </span>
                                        </div>
                                        <div class="col col-md-2 col-sm-2">
                                            <a href="{{ route('job_seeker.jobs.show', $job) }}" class="float-end">See
                                                more</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- -->
                            @empty
                                <div class="d-flex align-items-center justify-content-center my-2 p-5">
                                    <h3 class="text-center py-2">No Jobs Found.</h3>
                                </div>
                            @endforelse

                            <div class="my-2 py-2" id="job-links">
                                {{ $jobs->links() }}
                            </div>


                        </div>


                    </div>



                </div>
            </div>
        </div>



        {{-- <script>
            $(document).ready(function() {
                $('#work_type').change(function() {
                    // Get the selected value from the dropdown
                    var selectedValue = $(this).val();


                    // Send an AJAX request to the Laravel route
                    $.ajax({
                        url: "{{ route('home') }}",
                        type: 'GET',
                        data: {
                            work_type: selectedValue
                        },
                        success: function(response) {

                            $('#job-list').html(response);
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                        }
                    });
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $('#filter-salary').click(function() {
                    // Get the selected value from the dropdown
                    const min = $('#min').val();
                    const max = $('#max').val();


                    // Send an AJAX request to the Laravel route
                    $.ajax({
                        url: "{{ route('home') }}",
                        type: 'GET',
                        data: {
                            min: min,
                            max: max
                        },
                        success: function(response) {
                            $('#job-list').html(response);
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                        }
                    });
                });
            });
        </script> --}}
    </div>
</div>

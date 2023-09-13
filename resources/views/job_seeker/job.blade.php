@extends('job_seeker.layouts.app')
@section('content')
    <div class="container border rounded">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="d-flex align-items-center justify-content-start py-2 gap-3">
          <a href="{{ route('home') }}" class="btn"><i class="fas fa-chevron-left"></i>Back</a>
        </div>
        <div class="row px-3 mt-5">
         
            <div class="col col-md-5 col-sm-12">
              
                <div class="row d-flex flex-column">
                    <div class="col">
                        <h2>{{ $job->title }}</h2>
                        <p style="line-height: 0">{{ $job->employer->company_name }}</p>
                        <p style="line-height: 0">Date Posted: {{ $job->created_at->format('M d, Y') }}</p>
                        <p style="line-height: 0">Posted By: {{ $job->employer->user->name }}</p>
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

                    <div class="col d-flex align-items-start justify-content-start gap-2 mt-2 py-2">
                        <form action="{{ route('job_seeker.application.store',$job) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary btn-lg" @disabled(in_array($job->id, $application_job_ids))>Apply</button>
                        </form>
                        <form action="{{ route('bookmark.store', $job) }}" method="post">
                            @csrf
                            <button class="btn btn-outline-primary btn-lg" @disabled(in_array($job->id, $bookmark_job_ids))>Bookmark</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col col-md-7 col-sm-12">
                <h4>Description:</h4>
                <p class="lead" style="text-align: justify; text-justify: inter-word">{{ $job->description }}</p>
                <p class="float-end">{{ $job->applications->count() }} people applied for this Job</p>
            </div>
        </div>
    </div>
@endsection

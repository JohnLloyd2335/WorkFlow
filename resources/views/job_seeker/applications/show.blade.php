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
          <a href="{{ route('job_seeker.application.index') }}" class="btn"><i class="fas fa-chevron-left"></i>Back</a>
        </div>
        <div class="row px-3 py-2">
         
            <div class="col col-md-5 col-sm-12">
              
                <div class="row d-flex flex-column">
                    <div class="col">
                        <h2>{{ $application->job->title }}</h2>
                        <p style="line-height: 0">{{ $application->job->employer->company_name }}</p>
                        <p style="line-height: 0">Date Posted: {{ $application->job->created_at->format('M d, Y') }}</p>
                        <p style="line-height: 0">Posted By: {{ $application->job->employer->user->name }}</p>
                        <p style="line-height: 0">Application Date: {{ $application->created_at->format('M d, Y') }}</p>
                        <p style="line-height: 0">Application Status: {{ $application->application_status }}</p>
                        <span>
                            <span class="fa-solid fa-briefcase"></span>
                            <span>{{ $application->job->work_type }}</span>
                        </span>
                        @if (in_array($application->job->work_type, ['Onsite', 'Hybrid']))
                            <span>
                                <i class="fa-solid fa-location-pin"></i>
                                <span>{{ $application->job->location }}</span>
                            </span>
                        @endif
                        <span>
                            <i class="fa-solid fa-money-check-dollar"></i>
                            <span>{{ '₱' . number_format($application->job->salary, 2) }}</span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col col-md-7 col-sm-12">
                <h4>Description:</h4>
                <p class="lead" style="text-align: justify; text-justify: inter-word">{{ $application->job->description }}</p>
                
            </div>
        </div>
    </div>
@endsection

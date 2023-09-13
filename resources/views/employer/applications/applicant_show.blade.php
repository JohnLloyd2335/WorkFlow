@extends('employer.layouts.header-sidebar')
@section('content')
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb ">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">Applications</h4>
                </div>
                <div class="col-7 align-self-center">
                    <div class="d-flex align-items-center justify-content-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('employer.dashboard') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <a href="{{ route('employer.applications.index') }}">Applications</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <a
                                        href="{{ route('employer.applications.show', $application->job->id) }}">Application</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <a href="{{ route('employer.application.applicant.show', $application) }}">Applicant</a>
                                </li>

                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

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


        <div class="row">
            <div class="col-lg-12 mb-4 mb-sm-5 border">
                <div class="card card-style1 border-0">
                    <div class="card-body p-1-9 p-sm-2-3 p-md-6 p-lg-7">
                        <div class="row align-items-start">
                            <div class="col-lg-6 mb-4 mb-lg-0 d-flex align-items-center justify-content-center">
                                <img src="https://i.pinimg.com/originals/f1/0f/f7/f10ff70a7155e5ab666bcdd1b45b726d.jpg"
                                    alt="..." height="350" width="350">
                            </div>
                            <div class="col-lg-6 px-xl-10 py-5">
                                <div class="d-flex align-items-start justify-content-start flex-column">
                                    <h2 class="strong">{{ $application->jobSeeker->user->name }}</h2>

                                </div>
                                <ul class="list-unstyled mb-1-9">
                                    <li><span class="display-26 text-secondary me-2 font-weight-600">Email:</span>
                                        {{ $application->jobSeeker->user->email }}
                                    </li>
                                    <li><span class="display-26 text-secondary me-2 font-weight-600">Mobile Number:</span>
                                        {{ $application->jobSeeker->user->mobile_number }}
                                    </li>
                                    <li><span class="display-26 text-secondary me-2 font-weight-600">Job Title
                                            Applied:</span>
                                        {{ $application->job->title }}
                                    </li>
                                    <li><span class="display-26 text-secondary me-2 font-weight-600">Company:</span>
                                        {{ $application->job->employer->company_name }}
                                    </li>
                                    <li><span class="display-26 text-secondary me-2 font-weight-600">Posted by:</span>
                                        {{ $application->job->employer->user->name }}
                                    </li>
                                    <li><span class="display-26 text-secondary me-2 font-weight-600">Work Type:</span>
                                        {{ $application->job->work_type }}
                                    </li>
                                    @if (in_array($application->job->work_type, ['Onsite', 'Hybrid']))
                                        <li><span class="display-26 text-secondary me-2 font-weight-600">Work Type:</span>
                                            {{ $application->job->location }}
                                        </li>
                                    @endif
                                    <li><span class="display-26 text-secondary me-2 font-weight-600">Salary:</span>
                                        ₱{{ number_format($application->job->salary, 2) }}
                                    </li>
                                    <li><span class="display-26 text-secondary me-2 font-weight-600">Date Applied:</span>
                                        {{ date('M d, Y h:i A', strtotime($application->application_date)) }}
                                    </li>
                                    <li><span class="display-26 text-secondary me-2 font-weight-600">Application
                                            Status</span>
                                        {{ $application->application_status }}
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mb-4 mb-sm-5 border py-3 px-5">
                <div>
                    <h4>Education</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Highest Education</th>
                                <th>Year Graduated</th>
                                <th>Field of Study</th>
                                <th>School Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $application->jobSeeker->highest_education ?? 'Not Set' }}</td>
                                <td>
                                    @if (isset($application->jobSeeker->date_graduated))
                                        {{ date('M d, Y', strtotime($application->jobSeeker->date_graduated)) ?? 'Not Set' }}
                                    @else
                                        {{ 'Not Set' }}
                                    @endif
                                </td>
                                <td>{{ $application->jobSeeker->field_of_study ?? 'Not Set' }}</td>
                                <td>{{ $application->jobSeeker->school_name ?? 'Not Set' }}</td>
                            </tr>
                        </tbody>
                    </table>




                </div>
            </div>
            <div class="col-lg-12 mb-4 mb-sm-5 px-5">
                <div>
                    <h4>Skills</h4>
                    <div class="border p-2 d-flex align-items-center justify-content-start flex-wrap gap-1 py-4">
                        @forelse ($application->jobSeeker->skill as $skill)
                            <span class="bg-primary text-light fw-bold p-2 rounded">{{ $skill->name }}</span>
                        @empty
                            <p>Not Set</p>
                        @endforelse
                    </div>




                </div>
            </div>
            <div class="col-lg-12 mb-4 mb-sm-5 px-5">
                <div class="d-flex flex-column">
                    <h4>Resume</h4>
                    @if (isset($application->jobSeeker->resume_file_path))
                        <embed class="d-flex align-items-center justify-content-center"
                            src="{{ $application->jobSeeker->getFirstMediaUrl('resumes') }}" width="1300" height="1000"
                            alt="pdf" />
                    @endif


                </div>
            </div>
        </div>
    </div>
@endsection

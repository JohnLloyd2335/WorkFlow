@extends('employer.layouts.header-sidebar')
@section('content')
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">Dashboard</h4>
                </div>
                <div class="col-7 align-self-center">
                    <div class="d-flex align-items-center justify-content-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->

            <div class="row">
                <div class="col-md-3">
                    <div class="card bg-primary text-light">
                        <div class="card-body">
                            <div class="row d-flex align-items-center justify-content-between">
                                <div class="col-3">
                                    <span class="mdi mdi-briefcase" style="font-size: 60px"></span>
                                </div>
                                <div class="col-9 d-flex flex-column align-items-end">
                                    <h3 class="card-number">{{ $posted_jobs_count }}</h3>
                                    <h5 class="card-title">Posted Jobs</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-light">
                        <div class="card-body">
                            <div class="row d-flex align-items-center justify-content-between">
                                <div class="col-3">
                                    <span class="mdi mdi-account-check" style="font-size: 60px"></span>
                                </div>
                                <div class="col-9 d-flex flex-column align-items-end">
                                    <h3 class="card-number">{{ $hired_job_seekers_count }}</h3>
                                    <h5 class="card-title">Hired Job Seekers</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-secondary text-light">
                        <div class="card-body">
                            <div class="row d-flex align-items-center justify-content-between">
                                <div class="col-3">
                                    <span class="mdi mdi-calendar-clock" style="font-size: 60px"></span>
                                </div>
                                <div class="col-9 d-flex flex-column align-items-end">
                                    <h3 class="card-number">{{ $pending_job_seekers_count }}</h3>
                                    <h5 class="card-title">Pending Job Seekers</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-light">
                        <div class="card-body">
                            <div class="row d-flex align-items-center justify-content-between">
                                <div class="col-3">
                                    <span class="mdi mdi-briefcase-download" style="font-size: 60px"></span>
                                </div>
                                <div class="col-9 d-flex flex-column align-items-end">
                                    <h3 class="card-number">{{ $withdrawn_job_seekers_count }}</h3>
                                    <h5 class="card-title">Withdrawn Job Seekers</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-danger text-light">
                        <div class="card-body">
                            <div class="row d-flex align-items-center justify-content-between">
                                <div class="col-3">
                                    <span class="mdi mdi-close-circle" style="font-size: 60px"></span>
                                </div>
                                <div class="col-9 d-flex flex-column align-items-end">
                                    <h3 class="card-number">{{ $rejected_job_seekers_count }}</h3>
                                    <h5 class="card-title">Rejected Job Seekers</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-light">
                        <div class="card-body">
                            <div class="row d-flex align-items-center justify-content-between">
                                <div class="col-3">
                                    <span class="mdi mdi-view-list" style="font-size: 60px"></span>
                                </div>
                                <div class="col-9 d-flex flex-column align-items-end">
                                    <h3 class="card-number">{{ $total_applications }}</h3>
                                    <h5 class="card-title">Total Applications</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h4>Recent Application</h4>
                </div>
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Job Title</th>
                                <th>Applicant Name</th>
                                <th>Apllication Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recent_applications as $job)
                                <tr>
                                    <td>{{ $job->title }}</td>
                                    <td>{{ $job->applications[0]->jobSeeker->user->name }}</td>
                                    <td>{{ date('M d, Y h:i A', strtotime($job->applications[0]->application_date)) }}</td>
                                </tr>
                            @empty
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row mt-2 ">

                <div class="col-md-12">
                    <div class="card border p-2">
                        <div class="card-body">
                            <h3>Company Profile</h3>
                            <h4>Company Name: {{ auth()->user()->employer->company_name }}</h4>
                            <p style="line-height: 0">Services: {{ auth()->user()->employer->services }}</p>
                            <p style="line-height: 0">Company Description:</p>
                            <p style="text-align: justify; text-justify: inter-word;">
                                {{ auth()->user()->employer->company_description }}</p>
                        </div>
                    </div>
                </div>
            </div>



            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Right sidebar -->
            <!-- ============================================================== -->
            <!-- .right-sidebar -->
            <!-- ============================================================== -->
            <!-- End Right sidebar -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer text-center">

        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
@endsection

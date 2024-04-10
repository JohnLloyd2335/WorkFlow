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
                                    <a href="{{ route('employer.applications.show', $job->id) }}">Application</a>
                                </li>
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
            <div class="my-2">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->

            <div class="row px-3 py-2 border rounded">

                <div class="col col-md-5 col-sm-12">

                    <div class="row d-flex flex-column">
                        <div class="col">
                            <h4>{{ $job->title }}</h4>
                            <p style="line-height: 0">Company: {{ $job->employer->company_name }}</p>
                            <p style="line-height: 0">Date Posted: {{ $job->created_at->format('M d, Y') }}</p>
                            <p style="line-height: 0">Posted By: {{ $job->employer->user->name }}</p>
                            <p style="line-height: 0">No. of Applicants: {{ $job->applications_count }}</p>
                            <span>
                                <span class="mdi mdi-briefcase"></span>
                                <span>{{ $job->work_type }}</span>
                            </span>
                            @if (in_array($job->work_type, ['Onsite', 'Hybrid']))
                                <span>
                                    <span class="mdi mdi-map-marker-radius"></span>
                                    <span>{{ $job->location }}</span>
                                </span>
                            @endif
                            <span>
                                <span class="mdi mdi-cash"></span>
                                <span>{{ '₱' . number_format($job->salary, 2) }}</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col col-md-7 col-sm-12">
                    <h4>Description:</h4>
                    <p style="text-align: justify; text-justify: inter-word">{{ $job->description }}</p>

                </div>
            </div>

            <div class="row my-2">
                <div class="col">
                    <h4 class="page-title">Applicants</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table" id="applicantDataTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile Number</th>
                                        <th>Resume</th>
                                        <th>Application Date</th>
                                        <th>Application Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
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

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#applicantDataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('employer.applications.show', $job->id) }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'applicant_name',
                        name: 'applicant_name'
                    },
                    {
                        data: 'applicant_email',
                        name: 'applicant_email'
                    },
                    {
                        data: 'applicant_mobile_number',
                        name: 'applicant_mobile_number'
                    },
                    {
                        data: 'resume',
                        name: 'resume'
                    },
                    {
                        data: 'application_date',
                        name: 'application_date'
                    },
                    {
                        data: 'application_status',
                        name: 'application_status'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });
        });
    </script>
@endsection

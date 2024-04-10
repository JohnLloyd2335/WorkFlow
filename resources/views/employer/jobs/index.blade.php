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
                    <h4 class="page-title">Jobs</h4>
                </div>
                <div class="col-7 align-self-center">
                    <div class="d-flex align-items-center justify-content-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('employer.dashboard') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <a href="{{ route('employer.jobs.index') }}">Jobs</a>
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
            <div class="my-2">
                <a class="btn btn-primary" href='{{ route('employer.jobs.create') }}'>Add</a>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table" id="jobDataTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Salary</th>
                                        <th>Work Type</th>
                                        <th>Location</th>
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
    <script src="{{ asset('js/sweet-alert.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#jobDataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('employer.jobs.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'salary',
                        name: 'salary'
                    },
                    {
                        data: 'work_type',
                        name: 'work_type'
                    },
                    {
                        data: 'location',
                        name: 'location'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });

            $('#jobDataTable').on('click', '.deleteJobButton', function() {

                Swal.fire({
                    title: 'Are you sure you want to delete?',
                    icon: 'warning',
                    text: '',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let id = $('.deleteJobButton').data('id');
                        let url = "{{ route('employer.jobs.destroy', 'id') }}";
                        url = url.replace('id', id);
                        let token = "{{ csrf_token() }}";
                        console.log(url);
                        $.ajax({
                            url: url,
                            method: 'DELETE',
                            processData: false,
                            contentType: false,
                            headers: {
                                'X-CSRF-TOKEN': token
                            },
                            success: function() {
                                $('#jobDataTable').DataTable().ajax.reload();
                                Swal.fire({
                                    'title': 'Successful',
                                    'text': 'Job Application Successfully Withdrawn',
                                    'icon': 'success'
                                });
                            },
                            error: function(error) {

                                if (error.status == 405) {
                                    $('#jobDataTable').DataTable().ajax
                                        .reload();
                                    Swal.fire({
                                        'title': 'Successful',
                                        'text': 'Job Application Successfully Withdrawn',
                                        'icon': 'success'
                                    });
                                } else {
                                    Swal.fire({
                                        'title': 'Server Error',
                                        'text': 'Oops, There was an error',
                                        'icon': 'warning'
                                    });
                                }

                            }
                        });

                    }
                });

            });
        });
    </script>
@endsection

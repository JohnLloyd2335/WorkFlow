@extends('job_seeker.layouts.app')
@section('content')
    <div class="container border rounded my-4">
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

        <div class="row py-2 px-1">
            <div class="col">
                <h3 class="strong">Applications</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table" id="applicationDataTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Company</th>
                                    <th>Work Type</th>
                                    <th>Salary</th>
                                    <th>Date Applied</th>
                                    <th>Status</th>
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

    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('js/sweet-alert.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            let applicationTable = $('#applicationDataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('job_seeker.application.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'job_title',
                        name: 'job_title'
                    },
                    {
                        data: 'company',
                        name: 'company'
                    },
                    {
                        data: 'work_type',
                        name: 'work_type'
                    },
                    {
                        data: 'salary',
                        name: 'salary'
                    },
                    {
                        data: 'date_applied',
                        name: 'date_applied'
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

            $('#applicationDataTable').on('click', '.withDrawnButton', function() {

                Swal.fire({
                    title: 'Are you sure you want to delete?',
                    icon: 'warning',
                    text: '',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let id = $('.withDrawnButton').data('id');
                        let url = "{{ route('job_seeker.application.withdrawn', 'id') }}";
                        url = url.replace('id', id);
                        let token = "{{ csrf_token() }}";
                        console.log(url);
                        $.ajax({
                            url: url,
                            method: 'PUT',
                            processData: false,
                            contentType: false,
                            headers: {
                                'X-CSRF-TOKEN': token
                            },
                            success: function() {
                                $('#applicationDataTable').DataTable().ajax.reload();
                                Swal.fire({
                                    'title': 'Successful',
                                    'text': 'Job Application Successfully Withdrawn',
                                    'icon': 'success'
                                });
                            },
                            error: function(error) {

                                if (error.status == 405) {
                                    $('#applicationDataTable').DataTable().ajax
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

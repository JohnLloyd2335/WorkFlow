@extends('job_seeker.layouts.app')
@section('content')
    <div class="container border rounded my-5 mb-5">
        @include('includes.alert')

        <div class="row py-2 px-1 mt-5">
            <div class="col">
                <h3 class="strong">Bookmarks</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table" id="bookmarkDataTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Company</th>
                                    <th>Work Type</th>
                                    <th>Salary</th>
                                    <th>Date Added</th>
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
            $('#bookmarkDataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('bookmark.index') }}",
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
                        data: 'date_added',
                        name: 'date_added'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });

            $("#bookmarkDataTable").on('click', '.deleteBookmarkButton', function() {

                Swal.fire({
                    'title': 'Are you sure you want to delete?',
                    'text': '',
                    'icon': 'warning',
                    'showCancelButton': true,
                    'confirmButtonText': 'Yes, delete it'
                }).then((result) => {

                    if (result.isConfirmed) {
                        let id = $(this).data('id');
                        let url = "{{ route('bookmark.destroy', 'id') }}";
                        url = url.replace('id', id);
                        let token = "{{ csrf_token() }}";
                        $.ajax({
                            url: url,
                            method: 'DELETE',
                            processData: false,
                            contentType: false,
                            headers: {
                                'X-CSRF-TOKEN': token
                            },
                            success: function() {
                                $("#bookmarkDataTable").DataTable().ajax.reload();
                                Swal.fire({
                                    title: 'Success',
                                    text: 'Bookmark item successfully deleted',
                                    icon: 'success'
                                });
                            },
                            error: function(error) {

                                if (error.status == 405) {
                                    $("#bookmarkDataTable").DataTable().ajax.reload();
                                    Swal.fire({
                                        title: 'Success',
                                        text: 'Bookmark item successfully deleted',
                                        icon: 'success'
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Server Error',
                                        text: 'Oops, there was an error',
                                        icon: 'error'
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

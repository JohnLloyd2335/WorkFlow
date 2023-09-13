@extends('job_seeker.layouts.app')

@section('content')
    <div class="container-fluid">
       
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="row my-2">
                    <div class="col">
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <div class="d-flex align-items-center justify-content-arround gap-2">
                            <input type="search" name="" id="" class="form-control" placeholder="Search for Jobs..">
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
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
                                            <select name="work_type" class="form-control" id="work_type">
                                                <option selected disabled>--SELECT WORK TYPE--</option>
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
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true"
                                            aria-controls="panelsStayOpen-collapseTwo">
                                            Filter by Salary
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show">
                                        <div class="accordion-body">

                                            <div class="d-flex align-items-center justify-content-arround my-1 gap-2">
                                                <input type="number" name="min" id="min" class="form-control" placeholder="MIN" value="0">
                                                <input type="number" name="max" id="max" class="form-control" placeholder="MAX" value="0">
                                            </div>

                                            <button class="btn btn-outline-primary w-100 mt-1" id="filter-salary">Apply</button>
                                            <a href="{{ route('home') }}" class="btn btn-outline-primary w-100 mt-1" >Clear</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 border d-flex flex-column" id="job-list">

                            @include('job_seeker.partials.jobs')

                        </div>
                      
                        
                    </div>



                </div>
            </div>
        </div>

        

        <script>
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
</script>
        
    @endsection

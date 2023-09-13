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
                    <h4 class="page-title">Add Job</h4>
                </div>
                <div class="col-7 align-self-center">
                    <div class="d-flex align-items-center justify-content-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('employer.dashboard') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    <a href="{{ route('employer.jobs.index') }}">Jobs</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <a href="{{ route('employer.jobs.create') }}">Add Job</a>
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
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="{{ route('employer.jobs.store') }}" method="post">
                                @csrf

                                <div class="row">
                                    <div class="col">
                                        <label>Job Title</label>
                                        <input type="text" name="title"
                                            class="form-control @error('title') is-invalid @enderror"
                                            value="{{ old('title') }}">

                                        @error('title')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label>Description (Responsibilities & Qualifications)</label>
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" style="resize:none"
                                            cols="10" rows="10">{{ old('description') }}</textarea>

                                        @error('description')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col">
                                        <label>Expected Salary (PHP/month)</label>
                                        <input type="number" name="salary"
                                            class="form-control @error('salary') is-invalid @enderror"
                                            value="{{ old('salary') }}">

                                        @error('salary')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col">
                                        <label>Work Type</label>
                                        <select name="work_type"
                                            class="form-control @error('work_type') is-invalid @enderror" id="work_type">
                                            <option @selected(old('work_type') == 'Onsite') value="Onsite">Onsite</option>
                                            <option @selected(old('work_type') == 'Hybrid') value="Hybrid">Hybrid</option>
                                            <option @selected(old('work_type') == 'Work from Home') value="Work from Home">Work from Home
                                            </option>
                                        </select>

                                        @error('work_type')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col">
                                        <label>Work Location</label>
                                        <input type="text" name="location"
                                            class="form-control @error('location') is-invalid @enderror"
                                            value="{{ old('location') }}" id="work_location">

                                        @error('location')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>



                                <div class="row mt-2">
                                    <div class="col gap-2 d-flex align-items-center justify-content-end">
                                        <a href="{{ route('employer.jobs.index') }}" class="btn btn-primary">Back</a>
                                        <button type="submit" class="btn btn-success text-light">Add</button>
                                    </div>
                                </div>

                            </form>

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
            All Rights Reserved by Nice admin. Designed and Developed by
            <a href="https://www.wrappixel.com">WrapPixel</a>.
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

    <script>
        const work_type = document.getElementById('work_type');
        const work_location = document.getElementById('work_location');

        work_type.addEventListener('change', () => {
            if (work_type.value == "Work from Home") {
                work_location.disabled = true;
            } else {
                work_location.disabled = false;
            }
        });
    </script>
@endsection

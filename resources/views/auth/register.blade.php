@extends('job_seeker.layouts.app')

@section('content')
    <div class="main-content">
        <div id="registration-form">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <h3 class="my-2 text-center">Registration</h3>
                <div class="row">
                    <div class="col-xl-4 col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>User Type</label>
                            <select name="role" class="form-control @error('role') is-invalid @enderror" id="userType">
                                <option value="2">Employer</option>
                                <option value="3">Job Seeker</option>
                            </select>
                            @error('role')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Name" value="{{ old('name') }}" />

                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="Email" value="{{ old('email') }}" />
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-4 col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Mobile Number</label>
                            <input type="number" name="mobile_number"
                                class="form-control @error('mobile_number') is-invalid @enderror"
                                placeholder="Mobile Number" value="{{ old('mobile_number') }}" />
                            @error('mobile_number')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 col-sm-12">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="Password" />
                        @error('password')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-xl-4 col-md-4 col-sm-12">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            placeholder="Confirm Password" />
                        @error('password_confirmation')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="row employerFields">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-xl-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Company Name</label>
                                    <input type="text" name="company_name"
                                        class="form-control @error('company_name') is-invalid @enderror"
                                        placeholder="Company Name" value="{{ old('company_name') }}" />
                                    @error('company_name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Services</label>
                                    <input type="text" name="services"
                                        class="form-control @error('services') is-invalid @enderror" placeholder="Services"
                                        value="{{ old('services') }}" />
                                    @error('services')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Company Description</label>
                                    <textarea name="company_description" class="form-control @error('company_description') is-invalid @enderror"
                                        cols="5" rows="5">{{ old('company_description') }}</textarea>
                                    @error('company_description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 d-flex align-items-center justify-content-end">
                        <button type="submit" class="btn btn-sm float-end my-2">Register</button>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#userType").change(function() {
                let userType = $(this).val();
                let employerFields = $(".employerFields");
                if (userType == 2) {
                    employerFields.show();
                } else {
                    employerFields.hide();
                }
            });
        });
    </script>
@endsection

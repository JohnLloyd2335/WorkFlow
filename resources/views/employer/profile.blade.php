@extends('employer.layouts.header-sidebar')
@section('content')
    
        <div class="container">
            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

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


            <div class="row d-flex align-items-center justify-content-center px-5">
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
                                        <h2 class="strong">{{ auth()->user()->name }}</h2>
                                        <p>Employer</p>
                                    </div>
                                    <ul class="list-unstyled mb-1-9">
                                        <li class="mb-2 mb-xl-3 display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600">Email:</span>
                                            {{ auth()->user()->email }}</li>
                                        <li class="mb-2 mb-xl-3 display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600">Mobile Number:</span>
                                            {{ auth()->user()->mobile_number }}</li>

                                    </ul>
                                    <button class="btn btn-primary mt-1 float-end" data-bs-toggle="modal"
                                    data-bs-target="#editProfileModal">Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 border py-3 px-2">
                    <div class="card p-2">
                        <div class="card-body">
                            <h3>Company Profile</h3>
                            <h4>Company Name: {{ auth()->user()->employer->company_name }}</h4>
                            <p style="line-height: 0">Services: {{ auth()->user()->employer->services }}</p>
                            <p style="line-height: 0">Company Description:</p>
                            <p style="text-align: justify; text-justify: inter-word;">{{ auth()->user()->employer->company_description }}</p>
                            <button class="btn btn-primary float-end mt-2" data-bs-toggle="modal"
                            data-bs-target="#editCompanyProfileModal">Edit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


   


        <!-- Profile Modal -->
        <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('employer.profile.update',auth()->user()) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Mobile Number</label>
                                    <input type="number" name="mobile_number" class="form-control @error('mobile_number') is-invalid @enderror" value="{{ old('mobile_number') }}">
                                    @error('mobile_number')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Profile Modal -->

        <!-- Company Profile Modal -->
        <div class="modal fade" id="editCompanyProfileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Company Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('employer.profile.company_profile.update',auth()->user()) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col">
                                    <label>Company Name</label>
                                    <input type="text" name="company_name" class="form-control @error('company_name') is-invalid @enderror" value="{{ old('company_name') }}">
                                    @error('company_name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Services</label>
                                    <input type="text" name="services" class="form-control @error('services') is-invalid @enderror" value="{{ old('services') }}">
                                    @error('services')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Company Description</label>
                                   <textarea name="company_description" class="form-control @error('company_description') is-invalid @enderror"  cols="8" rows="8" style="resize: none">{{ old('company_description') }}</textarea>
                                    @error('company_description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Company Profile Modal -->

        

@endsection

@extends('job_seeker.layouts.app')
@section('content')
    <section class="bg-light">
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show my-1" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show my-1" role="alert">
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
                                        <h2 class="strong">{{ auth()->user()->name }}</h2>
                                        <p>Job Seeker</p>
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
                <div class="col-lg-12 mb-4 mb-sm-5 border py-3 px-2">
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

                                {{-- <td>{{ auth()->user()->jobSeeker->highest_education ?? 'Not Set' }}</td>
                                    <td>
                                        @if (isset(auth()->user()->jobSeeker->date_graduated))
                                            {{ date('M d, Y', strtotime(auth()->user()->jobSeeker->date_graduated)) ?? 'Not Set' }}
                                        @else
                                            {{ 'Not Set' }}
                                        @endif
                                    </td>
                                    <td>{{ auth()->user()->jobSeeker->field_of_study ?? 'Not Set' }}</td>
                                    <td>{{ auth()->user()->jobSeeker->school_name ?? 'Not Set' }}</td> --}}

                                @forelse ($highest_education as $education)
                                    <tr>
                                        <td>{{ $education->highest_education }}</td>
                                        <td>{{ date('M d, Y', strtotime($education->date_graduated)) }}</td>
                                        <td>{{ $education->field_of_study }}</td>
                                        <td>{{ $education->school_name }}</td>
                                    </tr>

                                @empty
                                    <tr colspan="4">
                                        <td>Not Set</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>

                        <div class="d-flex align-items-center justify-content-end gap-2">
                            @if ($highest_education->count() > 0)
                                <button class="btn btn-primary mt-1 float-end" data-bs-toggle="modal"
                                    data-bs-target="#editEducationModal">Edit</button>
                            @else
                                <button class="btn btn-primary mt-1 float-end" data-bs-toggle="modal"
                                    data-bs-target="#addEducationModal">Add</button>
                            @endif


                        </div>


                    </div>
                </div>
                <div class="col-lg-12 mb-4 mb-sm-5">
                    <div>
                        <h4>Skills ({{ auth()->user()->jobSeeker->skill->count() }}/5)</h4>
                        <div class="border p-2 d-flex align-items-center justify-content-start flex-wrap gap-1 py-4">

                            @foreach (auth()->user()->jobSeeker->skill as $skill)
                                <form action="{{ route('job_seeker.profile.skill.destroy', $skill) }}" method="post">
                                    <span class="bg-primary text-light fw-bold px-1 py-2 rounded">{{ $skill->name }}
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm text-light strong"><i
                                                class="fa-solid fa-x"></i></button>
                                    </span>
                                </form>
                            @endforeach

                        </div>
                        <button class="btn btn-primary mt-1 float-end" data-bs-toggle="modal" data-bs-target="#skillModal"
                            @disabled(auth()->user()->jobSeeker->skill->count() >= 5)>Add</button>


                    </div>
                </div>
                <div class="col-lg-12 mb-4 mb-sm-5">
                    <div class="d-flex flex-column">
                        <h4>Resume</h4>
                        @if (isset(auth()->user()->jobSeeker->resume_file_path))
                            @foreach ($auth_resumes as $auth_resume)
                                <a target="_blank" href="{{ auth()->user()->jobSeeker->getFirstMediaUrl('resumes') }}"
                                    class="rounded py-3 px-2 text-decoration-none bg-primary text-light d-flex align-items-center justify-content-start gap-1 px-3"
                                    style="">
                                    <i class="fa-solid fa-file-pdf fa-2x"></i>
                                    {{ $auth_resume->name }}
                                </a>
                            @endforeach
                        @else
                            <form action="{{ route('job_seeker.profile.resume.store', auth()->user()) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="file" name="resume" class="form-control">
                                <button class="btn btn-primary mt-1 float-end">Upload</button>
                            </form>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Add Education Modal -->
    <div class="modal fade" id="addEducationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Educational Attainment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('job_seeker.profile.education.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <label>Highest Education</label>
                                <select class="form-control @error('highest_education') is-invalid @enderror"
                                    name="highest_education">
                                    <option value="Bachelors Degree">Bachelors Degree</option>
                                    <option value="Secondary Education">Secondary Education</option>
                                    <option value="Primary Education">Primary Education</option>
                                    <option value="Vocational Studies">Vocational Studies</option>
                                </select>
                                @error('highest_education')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-8">
                                <label>Field of Study</label>
                                <input type="text" name="field_of_study"
                                    class="form-control @error('field_of_study') is-invalid @enderror"
                                    value="{{ old('field_of_study') }}">
                                @error('field_of_study')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label>Date Graduated</label>
                                <input type="date" name="date_graduated" id=""
                                    class="form-control @error('date_graduated') is-invalid @enderror"
                                    value="{{ old('date_graduated') }}">
                                @error('date_graduated')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-8">
                                <label>School Name</label>
                                <input type="text" name="school_name"
                                    class="form-control @error('school_name') is-invalid @enderror"
                                    value="{{ old('school_name') }}">
                                @error('school_name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Add Education Modal -->


    <!--Edit Education Modal -->
    <div class="modal fade" id="editEducationModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Educational Attainment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('job_seeker.profile.education.update', auth()->user()) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <label>Highest Education</label>
                                <select class="form-control @error('highest_education') is-invalid @enderror"
                                    name="highest_education">
                                    <option @selected(auth()->user()->jobSeeker->highest_education == 'Bachelors Degree') value="Bachelors Degree">Bachelors Degree</option>
                                    <option @selected(auth()->user()->jobSeeker->highest_education == 'Secondary Education') value="Secondary Education">Secondary Education
                                    </option>
                                    <option @selected(auth()->user()->jobSeeker->highest_education == 'Primary Education') value="Primary Education">Primary Education
                                    </option>
                                    <option @selected(auth()->user()->jobSeeker->highest_education == 'Vocational Studies') value="Vocational Studies">Vocational Studies
                                    </option>
                                </select>
                                @error('highest_education')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-8">
                                <label>Field of Study</label>
                                <input type="text" name="field_of_study"
                                    class="form-control @error('field_of_study') is-invalid @enderror"
                                    value="{{ auth()->user()->jobSeeker->field_of_study ?? '' }}">
                                @error('field_of_study')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label>Date Graduated</label>
                                <input type="date" name="date_graduated" id=""
                                    class="form-control @error('date_graduated') is-invalid @enderror"
                                    value="{{ auth()->user()->jobSeeker->date_graduated ?? '' }}">
                                @error('date_graduated')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-8">
                                <label>School Name</label>
                                <input type="text" name="school_name"
                                    class="form-control @error('school_name') is-invalid @enderror"
                                    value="{{ auth()->user()->jobSeeker->school_name ?? '' }}">
                                @error('school_name')
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
    <!--Edit Education Modal -->

    <!-- Skill Modal -->
    <div class="modal fade" id="skillModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Skill</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('job_seeker.profile.skill.store', auth()->user()) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label>Skill</label>
                                <input type="text" name="skill"
                                    class="form-control @error('skill') is-invalid @enderror">
                                @error('skill')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Skill Modal -->


    <!-- Profile Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('job_seeker.profile.update', auth()->user()) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col">
                                <label>Name</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>Email</label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>Mobile Number</label>
                                <input type="number" name="mobile_number"
                                    class="form-control @error('mobile_number') is-invalid @enderror"
                                    value="{{ old('mobile_number') }}">
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

@endsection

@extends('job_seeker.layouts.app')
@section('content')
    <div class="main-content">
        @include('includes.alert')
        <div class="container border rounded my-5">
            <div class="d-flex align-items-center justify-content-start py-2 gap-3">
                <a href="{{ route('job_seeker.jobs.index') }}" class="btn"><i class="fas fa-chevron-left"></i>Back</a>
            </div>
            <div class="row px-3 mt-5">
                <div class="col col-md-5 col-sm-12">
                    <div class="row d-flex flex-column">
                        <div class="col-12">
                            <h2>Job Title 1</h2>
                            <p style="line-height: 0">Pixel 8</p>
                            <p style="line-height: 0">Date Posted: January 30, 2023</p>
                            <p style="line-height: 0">Posted By: John Doe</p>
                            <span>
                                <span class="fa-solid fa-briefcase"></span>
                                <span>Work from Home</span>
                            </span>

                            <span>
                                <i class="fa-solid fa-location-pin"></i>
                                <span>Manila, Philippines</span>
                            </span>

                            <span>
                                <i class="fa-solid fa-money-check-dollar"></i>
                                <span>₱18,00.00</span>
                            </span>
                        </div>

                    </div>
                </div>
                <div class="col col-md-7 col-sm-12">
                    <h4>Description:</h4>
                    <p class="lead" style="text-align: justify; text-justify: inter-word">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                        Blanditiis a eius architecto nostrum quo explicabo repellendus
                        debitis. Enim officia sint recusandae numquam suscipit cumque!
                        Officiis error architecto molestias optio incidunt?
                    </p>
                    <p class="float-end">10 people applied for this Job</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('guest_layout.app')
@section('content')
<div class="bg-primary min-vh-100">
    <div class="row">
        <div class="col-lg-7 col-md-12 d-flex flex-column align-items-start justify-content-center px-3 px-md-5 mt-5">
            <h3 class="text-light" style="font-size: 6rem; font-weight: 900; margin-top: 30px; text-align: center;">Find your Dream Job</h3>
            <p class="text-light" style="font-size: 2rem; font-weight: 400; text-align: center;">Connecting Talent to Opportunity: Your Gateway to Career Success</p>
        </div>
        <div class="col-lg-5 col-md-12 d-flex align-items-center justify-content-center mt-5">
            <img src="{{ asset('assets/images/illustration.png') }}" alt="Illustration" class="img-fluid">
        </div>
    </div>
</div>

@endsection

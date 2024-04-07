@extends('guest_layout.app')
@section('content')
    <div class="container-fluid">
        <img src="{{ asset('assets/images/hero-bg.png') }}" alt="Hero Image" class="hero-bg" />
    </div>

    <div class="main-content">
        <h1>Find your <span id="dream-job">Dream Job</span></h1>
        <p id="hero-text">
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Animi debitis
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam ut
            provident placeat reiciendis. Placeat sequi nisi quaerat deleniti non,
            error ipsum nobis natus. Totam perferendis minima consequuntur quae illo
            est.
        </p>
        <button id="see-jobs">See Jobs</button>
    </div>
@endsection

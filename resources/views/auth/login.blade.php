@extends('guest_layout.app')
@section('content')
    <div class="bg-primary min-vh-100">
        <div class="row">
            <div class="col-lg-6 col-md-12 d-flex flex-column align-items-start justify-content-center px-3 px-md-5 my-5">
                <h5 class="text-light mt-5" style="font-size: 6rem; font-weight: 900; margin-top: 30px; text-align: center;">
                    Find
                    your Dream Job</h5>
                <p class="text-light" style="font-size: 2rem; font-weight: 400; text-align: center;">Connecting Talent to
                    Opportunity: Your Gateway to Career Success</p>
            </div>
            <div class="col-lg-6 col-md-12 d-flex align-items-center justify-content-start my-5 px-5">
                <div class="card mt-5 w-100">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email">{{ __('Email Address') }}</label>

                                <div class="col-md-12">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password">{{ __('Password') }}</label>

                                <div class="col-md-12">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember') }}
                                        </label>
                                    </div>
                                </div>

                                <div class="col-6">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link float-end" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-12 float-end">
                                    <button type="submit" class="btn btn-primary float-end">
                                        {{ __('Login') }}
                                    </button>


                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

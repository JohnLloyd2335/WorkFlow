@extends('guest_layout.app')
@section('content')
    <div class="main-content">
        <div class="login-form my-5">
            <div class="row">
                <div class="col-xl-6 col-md-12 col-sm-12" id="login-left-side">
                    <img src="{{ asset('assets/images/logo-icon.png') }}" alt="Logo Icon" />
                    <h3>Welcome to WorkFlow</h3>
                </div>
                <div class="col-xl-6 col-md-12 col-sm-12" id="login-right-side">
                    <h4>Login</h4>
                    <form action="{{ route('login') }}" method="post" id="login-form">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                                        autocomplete="off" value="{{ old('email') }}" />

                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="password" id=""
                                        class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                        autocomplete="off" />
                                    @error('password')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="{{ route('password.request') }}">Forgot your Password?</a>
                                    </div>
                                    <div class="col-6">
                                        <button type="submit" class="main-button">Login</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('guest_layout.app')

@section('content')


<div class="container mt-5">
    <div class="card">
        <div class="card-header">{{ __('Register') }}</div>
        <div class="card-body">
            <div class="container my-2">
                <ul class="nav nav-tabs" id="myTabs" role="tablist">
                  <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#job_seeker" role="tab" aria-controls="home" aria-selected="true">Job Seeker</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#employer" role="tab" aria-controls="profile" aria-selected="false">Employer</a>
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="job_seeker" role="tabpanel" aria-labelledby="job_seeker-tab">
                      <div class="container my-4">
                          <form method="POST" action="{{ route('register') }}">
                              @csrf
                              <input type="hidden" value="2" name="role"> 
                              <div class="row mb-3">
                                 
                                  <div class="col-md-6">
                                       <label for="name" >{{ __('Name') }}</label>
              
                                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
              
                                      @error('name')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
              
              
                                  <div class="col-md-6">
                                      <label for="email" >{{ __('Email Address') }}</label>
                                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
              
                                      @error('email')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
              
                              </div>
              
                             
                              <div class="row mb-3">

                                <div class="col-md-4">
                                    <label for="mobile_number" >{{ __('Mobile Number') }}</label>
                                    <input id="mobile_number" type="number" class="form-control @error('mobile_number') is-invalid @enderror" name="mobile_number" required >
            
                                    @error('mobile_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                  
                                <div class="col-md-4">
                                    <label for="password" >{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
            
                                <div class="col-md-4">
                                    <label for="password-confirm" >{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
            
                            </div>
              
                              <div class="row mb-0">
                                  <div class="col-md-12">
                                      <button type="submit" class="btn btn-primary  float-end">
                                          {{ __('Register') }}
                                      </button>
                                  </div>
                              </div>
                          </form>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="employer" role="tabpanel" aria-labelledby="employer-tab">
                        <div class="container my-4">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <input type="hidden" value="1" name="role">
                                <div class="row mb-3">
                                   
                                    <div class="col-md-6">
                                         <label for="name" >{{ __('Name') }}</label>
                
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                
                
                                    <div class="col-md-6">
                                        <label for="email" >{{ __('Email Address') }}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                
                                </div>


                                <div class="row mb-3">
                                   
                                    <div class="col-md-6">
                                         <label for="name" >{{ __('Company Name') }}</label>
                
                                        <input id="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name" value="{{ old('company_name') }}" required autocomplete="company_name" autofocus>
                
                                        @error('company_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                
                
                                    <div class="col-md-6">
                                        <label for="services" >{{ __('Services') }}</label>
                
                                        <input id="services" type="text" class="form-control @error('services') is-invalid @enderror" name="services" value="{{ old('services') }}" required autocomplete="services" autofocus>
                
                                        @error('services')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                
                                </div>


                                <div class="row mb-3">
                                    <label for="company_description" >{{ __('Company Description') }}</label>
                                    <textarea name="company_description" class="form-control"  cols="10" rows="10" style="resize: none"></textarea>
                                </div>
                
                               
                                <div class="row mb-3">
  
                                    <div class="col-md-4">
                                        <label for="mobile_number" >{{ __('Mobile Number') }}</label>
                                        <input id="mobile_number" type="number" class="form-control @error('mobile_number') is-invalid @enderror" name="mobile_number" required >
                
                                        @error('mobile_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                  <div class="col-md-4">
                                      <label for="password" >{{ __('Password') }}</label>
                                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
              
                                      @error('password')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
              
                                  <div class="col-md-4">
                                      <label for="password-confirm" >{{ __('Confirm Password') }}</label>
                                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                  </div>
              
                              </div>
                
                                <div class="row mb-0">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary  float-end">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                   
                  </div>
            </div>
        </div>
    </div>
</div>



    
   




  
@endsection

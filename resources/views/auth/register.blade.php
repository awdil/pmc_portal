<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>

  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

  <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/login_style.css') }}" rel="stylesheet">

</head>

<body class=" ">
  <div class="row">
    <div class="card-parent">
      <div class="main-card col-md-12">
        <div class="main-card-inner row">
          <div class="left col-md-6">
            <div class="login-screen-left">
              <div class="login-screen-inner">
                <p class="section-heading">Welcome<br> to PMC-ES</p>
                <div class="left-side-section">
                  <h5><i class="fa fa-user-o icon-circle" aria-hidden="true"></i> Step 1:</h5>
                  <p>Do PMC-ES login for online registration for MDCAT test 2021.</p>
                </div>
                <div class="left-side-section">
                  <h5> <i class="fa fa-plus-square-o icon-circle" aria-hidden="true"></i> Step 2:</h5>
                  <p>Sign Up for an account. Please remember the username and password as your roll no
                    slip
                    and result will be delivered to this email provided to PMC-ES</p>
                </div>
                <div class="left-side-section">
                  <h5><i class="fa fa-hand-o-up icon-circle" aria-hidden="true"></i>Step 3:</h5>
                  <p>After signing up, you will receive a confirmation email to the email provided at
                    PMC-ES
                    portal. Click on verify your account link. </p>
                </div>

                <div class="left-side-section lower row">
                  <p class="support d-flex"><i class="fa fa-envelope email-icon" aria-hidden="true">
                    </i>pmcsupport@beaconhouse.net</p>
                  <p class="support d-flex"><i class="fa fa-phone" aria-hidden="true"></i>
                    +42 111 277 111</p>
                </div>
              </div>
            </div>
          </div>
          <div class="login-screen-right col-md-6">
            <div class="login-screen-inner right-contnet signup">
              <div class="first-section signup">
                <div class="right-contnet signup-section">
                  <h1>Register</h1>
                  <p>
                    Please provide the following information to create your account.
                  </p>
                </div>
                <div class="logo">
                <img src="{{ asset('assets/img/pmslogo.png') }}" alt="logo">
                </div>
              </div>
              <div class="second-section col-md-12 row">
                <div class="col-md-6 login tab ">
                <i class="fa fa-sign-in" aria-hidden="true"></i>
                <a href="{{ route('login') }}">
                  <p>Login</p></a>
                </div>
                <div class="col-md-6 login tab active">
                <i class="fa fa-user-plus" aria-hidden="true"></i>
                  <p>Signup</p>
                </div>
              </div>
              <div class="third-section">
                <form method="POST" class="m-t register-form" role="form" action="{{ route('register') }}" autocomplete="off">
                    @csrf
                  <div class="form-group">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus placeholder="{{ __('Complete Name') }}">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <input id="mobile_number" type="text" class="form-control @error('mobile_number') is-invalid @enderror" name="mobile_number" value="{{ old('mobile_number') }}"  autocomplete="mobile_number" autofocus placeholder="{{ __('Mobile Number') }} (eg: 03319636191)">
                    @error('mobile_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <select class="form-control m-b  @error('gender') is-invalid @enderror" name="gender" id="gender" >
                            <option value="">Please Select Gender</option>
                            <option {{ old('gender') == 'Male' ? 'selected' : '' }} value="Male">Male</option>
                            <option {{ old('gender') == 'Female' ? 'selected' : '' }} value="Female">Female</option>
                        </select>
                        @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input id="cnic_number" type="text" class="form-control @error('cnic_number') is-invalid @enderror" name="cnic_number" value="{{ old('cnic_number') }}"  autocomplete="cnic_number" autofocus placeholder="{{ __('CNIC Number') }} (eg: 384038953093)">
                        @error('cnic_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" placeholder="{{ __('Email Address') }}">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" placeholder="{{ __('Password') }}">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input id="password_confirmation" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation"  autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="btn_forget_password d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary block full-width m-b mt-3 login-btn">
                      Signup
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>






<!-- <div class="loginColumns animated fadeInDown">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <span>
                            <img style=" width: 100px; padding:10px; " class="logo" src="{{ asset('assets/img/pmslogo.png') }}">
                        </span>
                    </div>
                    <div class="col-md-8 text-left" style="padding-left:0px;">
                        <h2 style="margin-bottom: 0px;" class="font-bold">
                            {{ __('Welcome to PMC-ES') }}
                        </h2>
                        <p style="margin: 0px;">
                            {{ __('Paper Less Examination.') }}
                        </p>
                    </div>
                </div>
                
                <p>
                    <strong>
                        {{ __('Step 1:') }}
                    </strong> 
                    {{ __('Do PMC-ES login for online registration for MDCAT test 2021.') }}
                </p>
                <p>
                    <strong>
                        {{ __('Step 2:') }}
                    </strong> 
                    {{ __('Sign up for an account. Please remember the username and password as your roll no slip and result will be delievered to this email provided to PMC-ES.') }}
                </p>
                <p>
                    <strong>
                        {{ __('Step 3:') }}
                    </strong> 
                    {{ __('After signing up, you will receive a confirmation email to the email provided at PMC-ES portal. Click on verify your account link.') }}
                </p>

            </div>
            <div class="col-md-6">

                <div class="tabs-container">
                    <ul class="nav nav-tabs" role="tablist">
                        <li>
                            <a class="nav-link" href="{{ route('login') }}">
                                {{ __('Login') }}
                            </a>
                        </li>
                        <li>
                            <a class="nav-link active" href="{{ route('register') }}">
                                {{ __('Registration') }}
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        
                        <div role="tabpanel" id="tab-2" class="tab-pane active">
                            <div class="panel-body">
                                <form method="POST" class="m-t" role="form" action="{{ route('register') }}">
                                     @csrf
                                    <div class="form-group">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus placeholder="{{ __('Complete Name') }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="mobile_number" type="text" class="form-control @error('mobile_number') is-invalid @enderror" name="mobile_number" value="{{ old('mobile_number') }}"  autocomplete="mobile_number" autofocus placeholder="{{ __('Mobile Number') }} (eg: 03319636191)">
                                    @error('mobile_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="cnic_number" type="text" class="form-control @error('cnic_number') is-invalid @enderror" name="cnic_number" value="{{ old('cnic_number') }}"  autocomplete="cnic_number" autofocus placeholder="{{ __('CNIC Number') }} (eg: 384038953093)">
                                    @error('cnic_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                       <select class="form-control m-b  @error('gender') is-invalid @enderror" name="gender" id="gender" >
                                        <option value="">Please Select Gender</option>
                                        <option {{ old('gender') == 'Male' ? 'selected' : '' }} value="Male">Male</option>
                                        <option {{ old('gender') == 'Female' ? 'selected' : '' }} value="Female">Female</option>
                                    </select>
                                    @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" placeholder="{{ __('Email Address') }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                   
                                    <div class="form-group">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" placeholder="{{ __('Password') }}">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="password_confirmation" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation"  autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary block full-width m-b">
                                        {{ __('Register') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="row">
            <div class="col-md-3 text-left">
                <strong>
                    {{ __('Copyrights Beaconhouse') }}
                </strong>
            </div>
            <div class="col-md-6">
                <strong>
                    {{ __('Note:') }}
                </strong> 
                    {{ __('In case of any query please contact us at ') }}
                <strong>
                    {{ __('info@beaconhouse.net') }}
                </strong>
                    {{ __(' or call us at ') }}
                <strong>
                    {{ __('111 277 111') }}
                </strong> 
            </div>
            <div class="col-md-3 text-right">
                {{ __(' © 2021-2022') }}
            </div>
        </div>         
    </div> -->
@extends('layouts.app')

@section('content')
 <div class="loginColumns animated fadeInDown">
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
                            <a class="nav-link active" href="{{ route('login') }}">
                                {{ __('Login') }}
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{ route('register') }}">
                                {{ __('Registration') }}
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                                <form method="POST" action="{{ route('login') }}">
                                     @csrf
                                    <div class="form-group">
                                        <input placeholder="Email Address" name="email" id="email" type="email" class="form-control @error('email') is-invalid @enderror"  value="{{ $email ?? old('email') }}"  autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input placeholder="Password" name="password" id="password" type="password" class="form-control @error('password') is-invalid @enderror"   autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary block full-width m-b">
                                        {{ __('Login') }}
                                    </button>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- <div class="footer">
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
@endsection



<!-- <!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom_style.css') }}" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

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
                                    <h5><img src="{{ asset('assets/img/Group -1.png') }}" /> Step 1:</h5>
                                    <p>Do PMC-ES login for online registration for MDCAT test 2021.</p>
                                </div>
                                <div class="left-side-section">
                                    <h5> <img src="{{ asset('assets/img/Group -2.png') }}" /> Step 2:</h5>
                                    <p>Sign Up for an account. Please remember the username and password as your roll no
                                        slip
                                        and result will be delivered to this email provided to PMC-ES</p>
                                </div>
                                <div class="left-side-section">
                                    <h5> <img src="{{ asset('assets/img/Group 3.png') }}" />Step 3:</h5>
                                    <p>After signing up, you will receive a confirmation email to the email provided at
                                        PMC-ES
                                        portal. Click on verify your account link. </p>
                                </div>
                                <div class="left-side-section lower">
                                    <p class="support d-flex"><span
                                            class="material-icons">email</span>pmcsupport@beaconhouse.net</p>
                                    <p class="support d-flex"><span class="material-icons">
                                            phone
                                        </span>+42 111 277 111</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="login-screen-right col-md-6">

                        <div class="login-screen-inner right-contnet">
                            <div class="first-section">
                                <div class="logo">
                                    <img src="{{ asset('assets/img/pmslogo.png') }}" alt="logo">
                                </div>
                                <div class="right-contnet">
                                    <h1>
                                        Login
                                    </h1>
                                    <p>
                                        Login by entering username and password in the given fields.
                                    </p>
                                </div>
                            </div>
                            <div class="second-section col-md-12 row">
                                <div class="col-md-6 login tab active">
                                    <span class="material-icons">person_add</span>
                                    <p>Login</p>
                                </div>
                                <div class="col-md-6 login tab">
                                    <span class="material-icons login-icon">
                                        person
                                    </span>
                                    <p>Signup</p>
                                </div>


                            </div>
                            <div class="third-section">

                                <form class="m-t" role="form" action="index.html">
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Username" required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Password" required="">
                                    </div>
                                    <div class="btn_forget_password d-flex justify-content-between">
                                        <button type="submit"
                                            class="btn btn-primary block full-width m-b mt-3 login-btn">Login</button>

                                        <a href="#" class="mt-3 text-right">
                                            <small>Forgot password?</small>
                                        </a>
                                    </div>
                                    <p class="text-muted text-center">
                                        <small>Do not have an account?</small>
                                    </p>
                                    <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
   
</body>

</html> -->

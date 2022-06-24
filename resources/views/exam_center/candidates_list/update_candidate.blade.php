@extends('candidate.layouts.candidate_main')

@section('header')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>CandidateProfile</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>CandidateProfile</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="wrapper wrapper-content">
    <div class="row">   
        <div class="col-md-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Update Profile</h5>
                </div>
                <div class="ibox-content">

                    <form class="m-t" role="form" method="post" enctype="multipart/form-data" action="{{ route('update-candidate-profile') }}">
                        @csrf
                        <div class="form-group">
                            <label>Complete Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Please Enter Your Complete Name" required="" value="{{ $user->name }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Father Name</label>
                            <input type="text" name="father_name" class="form-control @error('father_name') is-invalid @enderror" placeholder="Please Enter Your Father's Name" required="" value="{{ $user->father_name }}">
                            @error('father_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select class="form-control m-b  @error('status') is-invalid @enderror" name="gender" id="gender">
                            <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>CNIC / Passport No</label>
                            <input type="text" name="cnic_number" class="form-control @error('cnic_number') is-invalid @enderror" placeholder="Please Enter CNIC or Passport No." required="" value="{{ $user->cnic_number }}">
                            @error('cnic_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Contact No.</label>
                            <input type="text" name="mobile_number" class="form-control @error('mobile_number') is-invalid @enderror" placeholder="Please Enter Contact No." required="" value="{{ $user->mobile_number }}">
                            @error('mobile_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Please Enter Email Address" required="" value="{{ $user->email }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Profile Picture</label>
                            <div class="custom-file">
                                <input id="profile_picture" name="profile_picture" type="file" class="custom-file-input">
                                <label for="logo" class="custom-file-label">Please Upload Profile Picture</label>
                            </div> 
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row text-right">
                            <div class="col-sm-12 ">
                                <button class="btn btn-white btn-sm" type="submit">Cancel</button>
                                <button class="btn btn-primary btn-sm" type="submit">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><strong>Note! </strong>Important Instructions</h5>
                </div>
                <div class="ibox-content">
                    
                    <p><strong>1:</strong> If changing the mobile number you need to verify it through the verifcation code sent onthe mobile number.</p>
                    <p><strong>2:</strong> If changing the email you need to verify it through the email verifcation link on the email address.</p>
                    <p><strong>3:</strong> Please upload profile image with blue background having image size less then 1MB.</p>

                </div>
            </div>  
        </div>
    </div>
</div>
@endsection

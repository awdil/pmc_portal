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
<div class="row">
    <div class="cendidate_profile-bg col-md-12">
        <div class="col-md-2">
            <div class="profile-img-circle">
                <img alt="image" class="rounded-circle user-image new-design" src="{{ \Auth::user()->profile_picture_url }}" />
            </div>
            <div id="edit_icon"><i class="fa fa-edit pr-0"></i></div>
        </div>
        <div class="col-md-10">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="cendidate-profile-top-left">
                        <h5>Cendidate Profile</h5>
                        <h2>{{ $user->name }} /<span>{{ $user->urdu_name }}</span></h2>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="edit-btn-outer">
                        <button id="edit_p_btn" class="edit-profile-btn" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-edit"></i>Edit Profile</button>
                    </div>
                </div>
                <div class="section-devider-line col-md-12"></div>
                <div class="cendidate_inf0 col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="cendidate-info-single">
                                <h5><i class="fa fa-envelope"></i>{{ $user->email }}</h5>
                                <h5><i class="fa fa-circle-o    "></i>{{ $user->gender}}</h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="cendidate-info-single">
                                <h5><i class="fa fa-phone"></i>{{ $user->mobile_number }}</h5>
                                <h5><i class="fa fa-map-marker"></i>Lahore, Punjab, Pakistan</h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="cendidate-info-single">
                                <h5><i class="fa fa-users"></i>M Ashraf</h5>
                                <!-- <h5><i class="fa fa-envelope"></i>{{ $user->father_name }}</h5> -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-10 offset-1">
    <div class="edit_form_main">
        <div class="collapse" id="collapseExample">
            <div class="cendidate_profile_edit">

                <div class="col-md-12">
                    <div class="ibox float-e-margins">

                        <div class="cendidata_profile_uper_main">
                            <div class="ibox-title border_del">
                                <h5>Update Profile</h5>
                            </div>
                            <div class="ibox-content">

                                <form class="m-t" role="form" method="post" enctype="multipart/form-data" action="{{ route('update-candidate-profile') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Complete Name <span class="text-danger">*</span></label>
                                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Please Enter Your Complete Name" value="{{ $user->name }}">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Complete Urdu Name <span class="text-danger"></span></label>
                                                <input type="text" name="urdu_name" class="form-control @error('urdu_name') is-invalid @enderror" placeholder="Please Enter Your Urdu Name" value="{{ $user->urdu_name }}">
                                                @error('urdu_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Gender <span class="text-danger">*</span></label>
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
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Father Name <span class="text-danger">*</span></label>
                                                <input type="text" name="father_name" class="form-control @error('father_name') is-invalid @enderror" placeholder="Please Enter Your Father's Name" value="{{ $user->father_name }}">
                                                @error('father_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group ">
                                                <label>Contact No. <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="mobile_number" id="mobile_number" class="form-control @error('mobile_number') is-invalid @enderror" placeholder="Please Enter Contact No." value="{{ $user->mobile_number }}">
                                                    @if($user->mobile_verified_at ==NULL)
                                                    <span class="input-group-append">
                                                        <button data-mobile_number11="{{ $user->mobile_number }}" data-user_id="{{ Auth::id() }}" type="button" class="mb-0 btn btn-primary verfiy-mobile-modal-cls">Verify</button>
                                                    </span>
                                                    @endif
                                                </div>

                                                @error('mobile_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <small class="text-muted form-text m-b-none text-right">Format: 923001234567</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email Address <span class="text-danger">*</span></label>
                                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Please Enter Email Address" value="{{ $user->email }}">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>CNIC / Passport No <span class="text-danger">*</span></label>
                                                <input type="text" name="cnic_number" class="form-control @error('cnic_number') is-invalid @enderror" placeholder="Please Enter CNIC or Passport No." value="{{ $user->cnic_number }}">
                                                @error('cnic_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>CNIC / Passport No Expire Date <span class="text-danger"></span></label>
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    <input type="text" id="cnic_expire_date" name="cnic_expire_date" class="inputgcogroup form-control datepicker @error('cnic_expire_date') is-invalid @enderror" placeholder="CNIC / Passport No expire date" value="{{ $user->cnic_expire_date}}">
                                                    @error('cnic_expire_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <small class="text-muted form-text m-b-none text-right">Date Format: 31/12/2020</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>CNIC / Passport No. Front Side Picture </label>
                                                <div class="custom-file">
                                                    <input id="cnic_front_img" name="cnic_front_img" type="file" class="custom-file-input">
                                                    <label for="logo" class="custom-file-label">CNIC Front Side Picture </label>
                                                </div>
                                                @error('cnic_front_img')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <small class="text-muted form-text m-b-none text-right"><a data-toggle="modal" data-target="#CNIC-front-img-modal" href="" title="Picture Front Side"><i class="fa fa-plus-circle"></i> Preview Front Side Picture</a></small>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>CNIC / Passport No. Back Side Picture </label>
                                                <div class="custom-file">
                                                    <input id="cnic_back_img" name="cnic_back_img" type="file" class="custom-file-input">
                                                    <label for="logo" class="custom-file-label">CNIC Back Side Picture </label>
                                                </div>
                                                @error('cnic_back_img')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <small class="text-muted form-text m-b-none text-right"><a data-toggle="modal" data-target="#CNIC-back-img-modal" href="" title="Picture Back Side" data-gallery=""><i class="fa fa-plus-circle"></i> Preview Back Side Picture</a></small>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Please Select Country Name <span class="text-danger">*</span></label>
                                                <select class="load_select form-control  @error('country_id') is-invalid @enderror" name="country_id" id="country_id" data-target="state_id" data-url="{{ route('list-states') }}">
                                                    <option value="">Select Country</option>
                                                    @foreach ($countries as $single)
                                                    <option {{ $single->id == $user->city->state->country->id ? 'selected' : '' }} value="{{$single->id}}">{{$single->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('country_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Please Select Province Name <span class="text-danger">*</span></label>
                                                <select class="load_select form-control  @error('state_id') is-invalid @enderror" name="state_id" id="state_id" data-target="city_id" data-url="{{ route('list-cities') }}">
                                                    @foreach ($states as $single)
                                                    <option {{ $single->id == $user->city->state->id ? 'selected' : '' }} value="{{$single->id}}">{{$single->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('state_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Please Select City Name <span class="text-danger">*</span></label>
                                                <select class="load_select form-control  @error('city_id') is-invalid @enderror" name="city_id" id="city_id" data-target="exam_center_id" data-url="{{ route('list-exam-centers') }}">
                                                    @foreach ($cities as $single)
                                                    <option {{ $single->id == $user->city->id ? 'selected' : '' }} value="{{$single->id}}">{{$single->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('city_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

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
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-10 offset-1">
    <div id="cendidate_profile_lower">
        <div class="cendidata_profile_uper_main">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="cendidata_profile_uper_inner">
                        <h5>CNIC / Passport No : {{ $user->cnic_number }}</h5>
                        <h5>CNIC / Passport Expiry Date : {{ $user->cnic_expire_date}}</h5>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="cendidata_profile_uper_inner">
                        <div class="cendidata_profile_uper_heading">
                            <h5>CNIC / Passport Picture</h5>
                        </div>
                        <div class="passport_img">
                            <div class="row">
                                <div class="col-md-6 d-flex align-items-center justify-content-center">

                                    <h5 class="pr-2">Front : </h5>
                                    <div class="passport_img_box img-uploaded">
                                        <i class="fa fa-plus pr-0"></i>
                                    </div>

                                </div>
                                <div class="col-md-6 d-flex align-items-center justify-content-center">
                                    <h5 class="pr-2">Back : </h5>
                                    <div class="passport_img_box">
                                        <i class="fa fa-plus pr-0"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile_bottom_cards mt-3">
            <div class="row">
                <div class="col-md-6">
                    <div class="bottom_card_inner">
                        <div class="bottom_cards_headings col-12">
                            <h5><i class="fa fa-file-text"></i>Important Instructions</h5>
                        </div>
                        <div class="buttom_card_content p-3 col-12">
                            <p>1: If changing the mobile number you need to verify it through the verifcation code sent onthe mobile number.</p>

                            <p>2: If changing the email you need to verify it through the email verifcation link on the email address.</p>

                            <p> 3: Please upload profile image with blue background having image size less then 1MB.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bottom_card_inner warn">
                        <div class="bottom_cards_headings warning col-12">
                            <h5><i class="fa fa-warning"></i>Note! Please complete your profile</h5>
                        </div>
                        <div class="buttom_card_content p-3 col-12">
                            <p>1. Your NADRA record is not verified yet</p>
                            <p>2. Your mobile number is not verified yet</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






@endsection

@section('content')

@endsection

@push('header_scripts')
<link href="{{ asset('assets/js/plugins/croppie/croppie.css') }}" rel="stylesheet">
@endpush


@push('footer_scripts')
<script src="{{ asset('assets/js/plugins/croppie/croppie.js') }}"></script>
<script>
    const editIcon = document.getElementById("edit_icon");
    const btn = document.getElementById("edit_p_btn");
    const targetDiv = document.getElementById("cendidate_profile_lower");
    editIcon.style.opacity = "0";
    targetDiv.style.opacity = "1";

    btn.onclick = function() {

        if (targetDiv.style.opacity !== "0") {
            targetDiv.style.opacity = "0";
        }
        else{
            targetDiv.style.opacity = "1";
        }
        // if(editIcon.style.display === "none"){
        //         editIcon.style.display = "block";
        // }
        // else{
        //     editIcon.style.display = "none";
        // }

        // if (targetDiv.style.display !== "none") {
        //     targetDiv.style.display = "none";
        // } else {
        //     targetDiv.style.display = "block";
        // }
        // console.log(targetDiv.style.display)
    }
</script>
<script>
    $(document).ready(function() {

        $('.user-image').on('click', function(e) {
            $("#upload_image").trigger("click");
        });

        $image_crop = $('#image_demo').croppie({
            enableExif: true,
            viewport: {
                width: 200,
                height: 200,
                type: 'square' //circle
            },
            boundary: {
                width: 300,
                height: 300
            }
        });

        $('#upload_image').on('change', function() {
            var reader = new FileReader();
            reader.onload = function(event) {
                $image_crop.croppie('bind', {
                    url: event.target.result
                }).then(function() {
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
            $('#uploadimageModal').modal('show');
        });

        $('.crop_image').click(function(event) {
            $image_crop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(response) {
                $.ajax({
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    url: "{{ route('profile-picture')}}",
                    type: "POST",
                    data: {
                        "image": response
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.status == 'success' && data.faces.length == 1 && data.faces[0].attributes.sunglasses < 0.5) {
                            $('#uploadimageModal').modal('hide');
                            $('.user-image').attr('src', data.media.uri);
                        } else {

                            var html = '';

                            if (data.faces.length == 0) {
                                html += '<span class="label label-danger">#No Face</span>';
                            }

                            if (data.faces.length > 1) {
                                html += '<span class="label label-danger">#Multi Faces</span>';
                            }

                            if (data.weapon > 0.5) {
                                html += '<span class="label label-danger">#Multi Faces</span>';
                            }

                            if (data.nudity.safe < 0.5) {
                                html += '<span class="label label-danger">#Nudity</span>';
                            }

                            if (data.alcohol > 0.5 || data.drugs > 0.5) {
                                html += '<span class="label label-danger">#Nudity</span>';
                            }

                            if (data.faces[0].attributes.sunglasses > 0.5) {
                                html += '<span class="label label-danger">#Sunglasses</span>';
                            }

                            $('#profile-pic-attr').html(html).show();

                            console.log(html);
                        }
                    },
                    beforeSend: function() {
                        $('#profile-pic-attr').hide().html('');
                        showLoading();
                    },
                    complete: function() {
                        hideLoading();
                    }
                });
            })
        });

        $(document).on('click', '.verfiy-mobile-modal-cls', function(e) {
            e.preventDefault();

            var user_id = $(this).data('user_id');
            var mobile_number = $('#mobile_number').val();
            if (phonenumber(mobile_number)) {
                $.ajax({
                    url: '{{ route("sms-verification") }}',
                    type: "POST",
                    data: {
                        user_id: user_id,
                        mobile_number: mobile_number
                    },
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    cache: false,
                    success: function(resp) {
                        //if resonpnse is succfully then show the model
                        // $('#verify-mobile-number-modal').html(html);
                        $('#verify-mobile-number-modal #user_id').val(user_id);
                        $('#verify-mobile-number-modal #number_string').text('Please enter the 4 digit code that send to this ' + mobile_number);

                        $('#verify-mobile-number-modal').modal('show');
                    },
                    error: function() {

                    },
                    beforeSend: function() {

                    },
                    complete: function() {

                    }
                });
            }
        });

        $(document).on('click', '#verify-mobile-number-btn', function(e) {
            e.preventDefault();

            $.ajax({

                url: '{{ route("update-mobile-verification-status") }}',
                type: "POST",
                data: $('#form-verify-mobile-number').serializeArray(),
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                cache: false,
                success: function(resp) {
                    if (resp.status == 'success') {
                        toastr.success(resp.msg);
                        location.reload();
                    }
                    if (resp.status == 'error') {
                        toastr.error(resp.msg);
                    }
                },
                error: function() {
                    toastr.error(resp.msg);
                },
                beforeSend: function() {

                },
                complete: function(resp) {
                    if (resp.status == 'success') {
                        $('#verify-mobile-number-modal').modal('hide');
                    }
                }
            });
        });

        function phonenumber(inputtxt) {
            var phoneno = /^\d{12}$/;
            if (inputtxt.match(phoneno)) {
                return true;
            } else {
                alert("Number is invalid");
                return false;
            }
        }

    });
</script>
@endpush
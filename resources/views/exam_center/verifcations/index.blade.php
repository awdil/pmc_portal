@extends('exam_center.layouts.exam_center_main')

@section('header')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Verifications</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Verifications</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <!-- <a href="" class="btn btn-primary">Add New</a> -->
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="row wrapper p-sm border-bottom white-bg page-heading profile_head">
                <div class="col-md-4">
                    <div class="info-box">
                        <span ><img class="rounded-circle" src="{{ asset('assets/img/avatar.jpg') }}"></span>
                        <div class="profile-details">
                            <p class="text-success p-name">Muhammad Salman</p>
                            <p class="designation"><i class="fa fa-user-o" aria-hidden="true"></i> Exam Coordinator </p>
                            <p><i class="fa fa-map-marker"></i> Head Office Staff</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <h3 class="main_heading text-success">Exam Center Solution</h3>
                    <a href="#" class="exam_center">Exam Center Interface</a>
                </div>
                <div class="col-md-4">
                    <div class="info-box">
                        <div class="campus-details text-right">
                            <b>Beaconhouse</b>
                            <p>Beaconhouse Newlands Lahore</p>
                            <a href="">Switch Exam Center</a>
                        </div>
                        <span><i style=" padding-top: 16px; " class="fa fa-institution fa-5x"></i></span>
                    </div>
                </div>
            </div>
            <div class="ibox ">
                <div class="ibox-content">
                    <div class="wrapper wrapper-content">
                        <div class="row">
                            <!-- Tabs Begins-->
                            <div class="col-lg-12">
                                <div class="tabs-container">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li><a class="nav-link active show" data-toggle="tab" href="#tab-1"> Nadra Verification </a></li>
                                        <li><a class="nav-link" data-toggle="tab" href="#tab-2"> Student Verification</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" id="tab-1" class="tab-pane active show">
                                            <div class="panel-body">
                                                <!-- Begins Nadra verifcation section Search-->
                                                <div class="col-md-6">
                                                    <div id="" class="search_roll_no">
                                                        <div class="input-group"><input type="text" placeholder="Search CNIC No." class="form-control"> <span class="input-group-append"> <button type="button" class="btn btn-primary">Search!</button> </span></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="text-right date_time">
                                                        <!-- <p class="time">9:43 AM</p>
                                                        <p class="date">02 December, 2021</p> -->
                                                    </div>
                                                </div>
                                                <!-- End Nadra verifcation section Search-->
                                                <div class="panel panel-primary"> 
                                                    <div class="panel-heading"> Nadra Verification </div> 
                                                        <div class="panel-body"> 
                                                            <div class="ibox">
                                                                <div style=" background: none; " class="jumbotron">
                                                                    <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="row pb-2">
                                                                                    <div class="col-md-6">
                                                                                        <div id="cluster_info" class="student-profile-image">
                                                                                            <img src="{{ asset('assets/img/profile_small.jpg') }}" class="rounded-circle circle-border m-b-md" alt="profile">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6 text-right pb-2">
                                                                                        <span ><img style=" width: 156px;" class="" src="{{ asset('assets/img/NADRA_logo.png ') }}"></span>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <div class="table-responsive">
                                                                                    <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped display" width="100%"> 
                                                                                        <tbody> 
                                                                                            <tr> 
                                                                                                <td><b>CNIC</b></td> 
                                                                                                <td colspan="5">35101-2123123-9</td> 
                                                                                            </tr> 
                                                                                            <tr> 
                                                                                                <td><b>Name</b></td> 
                                                                                                <td colspan="5">Ahtisham Agha</td> 
                                                                                            </tr> 
                                                                                            <tr> 
                                                                                                <td><b>Gender</b></td> 
                                                                                                <td colspan="5">Male</td> 
                                                                                            </tr> 
                                                                                            <tr> 
                                                                                                <td><b>Father/Husband Name</b></td> 
                                                                                                <td colspan="5">Azmatullah</td> 
                                                                                            </tr> 
                                                                                            <tr> 
                                                                                                <td><b>Identification Mark</b></td> 
                                                                                                <td colspan="5">Mole on neck</td> 
                                                                                            </tr>
                                                                                            <tr> 
                                                                                                <td><b>Date Of Birth</b></td> 
                                                                                                <td colspan="5">31/12/1999</td> 
                                                                                            </tr>
                                                                                            <tr> 
                                                                                                <td><b>Family Number</b></td> 
                                                                                                <td colspan="5">845985</td> 
                                                                                            </tr>
                                                                                            <tr> 
                                                                                                <td><b>Address</b></td> 
                                                                                                <td colspan="5">10/4 F Block Main Market، Gulberg 2, Lahore, Punjab</td> 
                                                                                            </tr>
                                                                                            <tr> 
                                                                                                <td><b>CNIC Expiry Date</b></td> 
                                                                                                <td colspan="5">28/12/2028</td> 
                                                                                            </tr> 
                                                                                        </tbody> 
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                    </div>
                                                                </div>       
                                                                
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div role="tabpanel" id="tab-2" class="tab-pane">
                                            <div class="panel-body">
                                                <!-- Begins Student verifcation section Search-->
                                                <div class="col-md-6">
                                                    <div id="" class="search_roll_no">
                                                        <div class="input-group"><input type="text" placeholder="Scan Roll No. Slip QR Code" class="form-control"> <span class="input-group-append"> <button type="button" class="btn btn-primary">Search!</button> </span></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="text-right date_time">
                                                        <!-- <p class="time">9:43 AM</p>
                                                        <p class="date">02 December, 2021</p> -->
                                                    </div>
                                                </div>
                                                <!-- End Student verifcation section Search-->
                                                <div class="panel panel-primary">
                                                    <div class="panel-heading">
                                                        Student Verification
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="ibox">
                                                            <div class="jumbotron">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="row">
                                                                    <div class="col-md-8">
                                                                        <dl class="row mb-0">
                                                                            <div class="col-sm-4 text-sm-right">
                                                                                <dt>Candidate Name:</dt>
                                                                            </div>
                                                                            <div class="col-sm-8 text-sm-left">
                                                                                <dd class="mb-1">Muhammad Usman</dd>
                                                                            </div>
                                                                        </dl>
                                                                        <dl class="row mb-0">
                                                                            <div class="col-sm-4 text-sm-right">
                                                                                <dt>Roll No:</dt>
                                                                            </div>
                                                                            <div class="col-sm-8 text-sm-left">
                                                                                <dd class="mb-1">59868</dd>
                                                                            </div>
                                                                        </dl>
                                                                        <dl class="row mb-0">
                                                                            <div class="col-sm-4 text-sm-right">
                                                                                <dt>CNIC Number:</dt>
                                                                            </div>
                                                                            <div class="col-sm-8 text-sm-left">
                                                                                <dd class="mb-1"> 31101-9403296-7 <i class="text-right fa fa-check-square"></i></dd>
                                                                            </div>
                                                                        </dl>
                                                                        <dl class="row mb-0">
                                                                            <div class="col-sm-4 text-sm-right">
                                                                                <dt>Exam:</dt>
                                                                            </div>
                                                                            <div class="col-sm-8 text-sm-left">
                                                                                <dd class="mb-1"><a href="#" class="text-navy"> CS-903 DB</a></dd>
                                                                            </div>
                                                                        </dl>
                                                                        <dl class="row mb-0">
                                                                            <div class="col-sm-4 text-sm-right">
                                                                                <dt>Registration Number:</dt>
                                                                            </div>
                                                                            <div class="col-sm-8 text-sm-left">
                                                                                <dd class="mb-1"> CS-365985-2016</dd>
                                                                            </div>
                                                                        </dl>
                                                                        <dl class="row mb-0">
                                                                            <div class="col-sm-4 text-sm-right">
                                                                                <dt>Arrival:</dt>
                                                                            </div>
                                                                            <div class="col-sm-8 text-sm-left">
                                                                                <dd class="mb-1"> 07:58 PST</dd>
                                                                            </div>
                                                                        </dl>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div id="cluster_info" class="student-profile-image">
                                                                            <img src="{{ asset('assets/img/profile_small.jpg') }}" class="rounded-circle circle-border m-b-md" alt="profile">
                                                                        </div>
                                                                        <div style="display: none;" id="seat_info" class="student-profile-image">
                                                                            <div class="widget style1 lazur-bg">
                                                                                <div class="row">
                                                                                    <div class="col-12 text-center">
                                                                                        <i class="fa fa-edit fa-5x"></i>
                                                                                    </div>
                                                                                    <div class="col-12 text-center">
                                                                                        <h3 class="font-bold">Seat No 12</h3>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <!-- <a class="btn btn-primary btn-rounded btn-block" href="#"><i class="fa fa-check"></i> Mark Present</a> -->
                                                                        <button id="buttonverify" type="submit" class="btn btn-primary btn-rounded btn-block"> <i class="fa fa-check"></i> Mark Present </button>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Tabs Ends -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

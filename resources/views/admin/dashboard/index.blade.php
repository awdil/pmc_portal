@extends('admin.layouts.admin_main')

@section('header')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Admin Dashboard</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html">Admin</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Admin Dashboard</strong>
            </li>
        </ol>
    </div>
    {{-- <div class="col-sm-8">
        <div class="title-action">
            <a href="" class="btn btn-primary">Admin This is action area</a>
        </div>
    </div> --}}
</div>
@endsection

@section('content')
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-success float-right">Capacity</span>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">4,088</h1>
                    <div class="stat-percent font-bold text-success"><i class="fa fa-address-card-o"></i></div>
                    <small>Total Seating Capacity per shift</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-info float-right">Registration</span>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">275,800</h1>
                    <div class="stat-percent font-bold text-info"><i class="fa fa-users"></i></div>
                    <small>Total Registration in this term</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-primary float-right">On waiting</span>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">106,120</h1>
                    <div class="stat-percent font-bold text-navy"><i class="fa fa-clock"></i></div>
                    <small>Student Waiting to take the exam</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-danger float-right">Exam Centers</span>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">23</h1>
                    <div class="stat-percent font-bold text-danger"> <i class="fa fa-building"></i></div>
                    <small>Exam Centers</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

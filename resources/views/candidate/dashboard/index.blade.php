@extends('candidate.layouts.candidate_main')

@section('header')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Dashboard</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Dashboard</strong>
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
        <div class="col-lg-4">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-success float-right">Monthly</span>
                    <h5>Examination</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">21</h1>
                    <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                    <small>Total Examination</small>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-info float-right">Annual</span>
                    <h5>Attempts</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">17</h1>
                    <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
                    <small>Attempts</small>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-primary float-right">Today</span>
                    <h5>Result Awaiting</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">1</h1>
                    <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>
                    <small>Result Awaiting</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

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
        <div class="col-md-8">                    
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Fee Payment</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="widget style1 lazur-bg">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <i class="fa fa-credit-card fa-5x"></i>
                                    </div>
                                    <div class="col-12 text-center">
                                        <h3 class="font-bold">Pay Through Credit/Debit</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="widget style1 yellow-bg">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <i class="fa fa-file-o fa-5x"></i>
                                    </div>
                                    <div class="col-12 text-center">
                                        <h3 class="font-bold">Through Bank Challan Form</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><strong>Note! </strong>Important Instructions!</h5>
                </div>
                <div class="ibox-content">
                <p><strong>1:</strong> You can pay online through any debit or credit card.</p>
                <p><strong>2:</strong> You can all so pay in bank and upload the chalan here.</p>
                <p><strong>3:</strong> Once paymet is verified you will be able to doenload the examination slip.</p>
               

                </div>
            </div>  
        </div>
    </div>
</div>
@endsection

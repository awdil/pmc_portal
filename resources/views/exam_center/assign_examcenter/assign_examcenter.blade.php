@extends('exam_center.layouts.exam_center_main')

@section('header')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Assigne Exam Center</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Assigne Exam Center</strong>
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
                    <h5>Assigne Exam Center</h5>
                </div>
                <div class="ibox-content">
                <form class="m-t" role="form" action="{{ route('update-assign-exam-center', ['id' => $user->id]) }}" method="POST" >
                    @csrf
                    <div class="row"> 
                        <div class="col-lg-12">
                            <div class="contact-box center-version">
                                <a href="profile.html">
                                    <img alt="image" class="rounded-circle" src="{{asset('assets/img/a2.jpg')}}">
                                    <h3 class="m-b-xs"><strong>{{ $user->name }}</strong></h3>
                                    <div class="font-bold">Role Name</div>
                                    <address class="m-t-md">
                                        <i class="fa fa-envelope"></i> <strong></strong>{{ $user->email }} <br>
                                        <i class="fa fa-phone"></i> <strong></strong> {{ $user->mobile_number }}
                                    </address>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Exam Centers <span class="text-danger">*</span></label>
                                <select class="select-2 form-control  @error('exam_center_id') is-invalid @enderror" name="exam_center_id" id="exam_center_id" data-target="exam_dates" data-url="{{ route('list-exam-calendar') }}">
                                    @foreach ($examcenters as $single)
                                        <option value="{{$single->id}}">{{$single->name}}</option>
                                    @endforeach
                                </select>
                                @error('exam_center_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>  
                    </div>       
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <div class="col-sm-12 text-right">
                                <button class="btn btn-white btn-sm" type="reset">Cancel</button>
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
                    <h5><strong>Note! </strong>Important Instructions!</h5>
                </div>
                <div class="ibox-content">
                    <p><strong>Step 1:</strong> Select the exam center!.</p>
                    <p><strong>Step 2:</strong> After the selection of exam, You need to submit your form the center will be assigned to the user.</p>
                </div>
            </div>
        </div>      
    </div>
</div>
@endsection
@push('footer_scripts')
    <script>
    </script>
@endpush

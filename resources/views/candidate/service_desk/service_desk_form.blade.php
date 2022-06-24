@extends('candidate.layouts.candidate_main')

@section('header')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Support Service Desk</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Support Service Desk</strong>
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

	<div class="wrapper wrapper-content">
		<div class="row">
			<div class="col-lg-9 animated fadeInRight">
		        <div class="mail-box-header">
		            <!-- <div class="float-right tooltip-demo">
		                <a href="mailbox.html" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to draft folder"><i class="fa fa-pencil"></i> Draft</a>
		                <a href="mailbox.html" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Discard email"><i class="fa fa-times"></i> Discard</a>
		            </div> -->
		            <h2> Raise a support ticket</h2>
		        </div>
		        <div class="mail-box">
	                <form method="post" action="{{ route('raise-support-ticket') }}">
	                	@csrf
			            <div class="mail-body">
		                	<div class="form-group row">
		                    	<label class="col-sm-2 col-form-label">From:</label>
		                        <div class="col-sm-10">
		                        	<input type="text" class="form-control" value="{{ \Auth::user()->email }}" readonly name="from_email">
		                        </div>
		                    </div>
		                    <div class="form-group row">
		                    	<label class="col-sm-2 col-form-label">To:</label>
		                        <div class="col-sm-10">
		                        	<input type="text" class="form-control" value="pmcsupport@bh.edu.pk" readonly name="to_email">
		                        </div>
		                    </div>
		                    <div class="form-group row">
		                    	<label class="col-sm-2 col-form-label">Subject:</label>
		                        <div class="col-sm-10">
		                        	<input type="text" class="form-control" value="" placeholder="Please enter your subject" name="email_subject">
		                        </div>
		                    </div>
			            </div>

			            <div class="mail-text h-200">
			            	<textarea name="email_body" class="summernote"></textarea>
							<div class="clearfix"></div>	
			            </div>
			            <div class="mail-body text-right tooltip-demo">
			                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i> Send</button>
			                <button type="reset" class="btn btn-white btn-sm"><i class="fa fa-times"></i> Discard</button>
			                <!-- <a href="mailbox.html" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Draft</a> -->
			            </div>
			            <div class="clearfix"></div>
			        </form>
		        </div>
		    </div>
		</div>
	</div>
</div>
@endsection



@push('footer_scripts')
    <script src="{{ asset('assets/js/plugins/summernote/summernote-bs4.js') }}"></script>

    <script>
        $(document).ready(function () {
           $('.summernote').summernote({height: 200});
        });
    </script> 
@endpush

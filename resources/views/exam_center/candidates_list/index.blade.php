@extends('exam_center.layouts.exam_center_main')

@section('header')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>List of Candidates</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>List of Candidates</strong>
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
           
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>List of Candidates</h5>
                </div>
                <div class="ibox-content">
                    <div class="wrapper wrapper-content">
                        <form class="m-b" role="form" method="post" enctype="multipart/form-data" action="{{ route('export-candidates') }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <select class="load_select form-control" name="country_id" id="country_id" data-target="state_id" data-url="{{ route('list-states') }}">
                                            <option value="">Select Country</option>
                                            @foreach ($country as $single)
                                            <option value="{{$single->id}}">{{$single->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <select class="load_select form-control" name="state_id" id="state_id" data-target="city_id" data-url="{{ route('list-cities') }}">
                                            <option value="">Select Province</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <select class="load_select form-control" name="city_id" id="city_id" data-target="exam_center_id" data-url="{{ route('list-exam-centers') }}">
                                            <option value="">Select City</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <select class="select-2 form-control" name="exam_center_id" id="exam_center_id">
                                            <option value="">Select Exam Center</option>
                                        </select>
                                    </div> 
                                </div>  
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Search..." name="search_term" id="search_term">
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                        
                            <div class="form-group row text-right">
                                <div class="col-sm-12 ">
                                    <button class="btn btn-primary " value="submit" name="submit" type="submit"><i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;<span class="bold">Export</span></button>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="candidate-list">
                                <thead>
                                    <tr>
                                        <th>Candidate Name</th>
                                        <th>CNIC Number</th>
                                        <th>Exam</th>
                                        <th>Registration No.</th>
                                        <th>Arrival</th>
                                        <th>City</th>
                                        <th style=" text-align: center; ">Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('footer_scripts')
    <script>
        $(document).ready(function () {
            // init datatable.
            var candidateList = $('#candidate-list').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                pageLength: 10,
                scrollX: true,
                searching: false, 
                paging: false,
                pageLength: 50,
                "order": [[ 0, "desc" ]],
                ajax: {
                    url: "{{ route('candidates') }}",
                    data: function ( d ) {
                        d.country_id = $('#country_id').val();
                        d.state_id = $('#state_id').val();
                        d.city_id = $('#city_id').val();
                        d.exam_center_id = $('#exam_center_id').val();
                        d.search_term = $('#search_term').val();
                    }
                },
                columns: [
                    {data: 'std_name', name: 'std_name'},
                    {data: 'user.cnic_number', name: 'user.cnic_number'}, //candidate cnic number
                    {data: 'timeslot.exam_calander.exam.exam_title', name: 'timeslot.exam_calander.exam.exam_title'}, //candidate exam title
                    {data: 'reg_number', name: 'reg_number'}, //candidate exam registration numner
                    {data: 'timeslot.exam_begins_at', name: 'timeslot.exam_begins_at'}, // candidate arriavel
                    {data: 'city.name', name: 'city.name'}, // candidate arriavel
                    {data: 'action', name: 'action',orderable:false,serachable:false,sClass:'text-center'},
                ]
            });

            $(document).on('change','#country_id, #state_id, #city_id, #exam_center_id',function(e){
                console.log('searching...');
                candidateList.ajax.reload( null, false );
            });

            $(document).on('keyup','#search_term',function(e){
                console.log('searching...');
                candidateList.ajax.reload( null, false );
            });
        });
    </script> 
@endpush

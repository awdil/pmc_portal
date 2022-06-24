@extends('exam_center.layouts.exam_center_main')

@section('header')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>List of Examiners</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>List of Examiners</strong>
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
                    <h5>List of Examiners</h5>
                </div>
                <div class="ibox-content">
                    <div class="wrapper wrapper-content">
                        <form class="m-b" role="form" method="post" enctype="multipart/form-data" action="{{ route('export-examiners') }}">
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
                            <table class="table table-bordered" id="examiners-list">
                                <thead>
                                    <tr>
                                        <th>Examiner Name</th>
                                        <th>Phone Number</th>
                                        <th>Eamil</th>
                                        <th>City Name</th>
                                        <th>Status</th>
                                        <th>Created at</th>
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
<div class="modal inmodal" id="assign-exam-center-modal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeIn">
            <div class="modal-header p-2">
                <h2><span id="examiner_name"></span></h2>
            </div>
            <div class="modal-body">
                <form class="m-t" role="form" id="form-assign-exam-center">
                    @csrf  
                    <div class="modal-body p-2">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        
                                        <th>Sr. </th>
                                        <th>Center Name </th>
                                        <th>Address</th>
                                        <th>
                                            <input type="hidden" name="user_id" id="user_id">
                                            <input type="checkbox" class="i-checks-all" name="all"> 
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer p-2">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="button" id="assign-exam-center-btn" class="btn btn-primary" type="submit">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('footer_scripts')
    <script>
        $(document).ready(function () {

            $('.i-checks-all').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            }).on('ifChecked', function(event){
                $('.exam-center-checkbox').iCheck('check');
            }).on('ifUnchecked', function(event){
                $('.exam-center-checkbox').iCheck('uncheck');
            });

            var examinersListTbl = $('#examiners-list').DataTable({
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
                    url: "{{ route('examiners-list') }}",
                    data: function ( d ) {
                        d.country_id = $('#country_id').val();
                        d.state_id = $('#state_id').val();
                        d.city_id = $('#city_id').val();
                        d.exam_center_id = $('#exam_center_id').val();
                        d.search_term = $('#search_term').val();
                    }
                },
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'mobile_number', name: 'mobile_number'},
                    {data: 'email', name: 'email'}, 
                    {data: 'city.name', name: 'city.name'}, 
                    {data: 'status', name: 'status'}, 
                    {data: 'created_at', name: 'created_at'}, 
                    {data: 'action', name: 'action',orderable:false,serachable:false,sClass:'text-center'},
                ]
            });
            $(document).on('change','#country_id, #state_id, #city_id, #exam_center_id',function(e){
                console.log('searching...');
                examinersListTbl.ajax.reload( null, false );
            });

            $(document).on('keyup','#search_term',function(e){
                console.log('searching...');
                examinersListTbl.ajax.reload( null, false );
            });

            $(document).on('click','.assign-exam-center-modal',function(e){
                e.preventDefault();

                var user_id         = $(this).data('user_id');
                var examiner_name   = $(this).data('examiner_name');
                $.ajax({

                    url: '{{ route("examiner-exam-centers") }}',
                    type: "GET",
                    data : { user_id: user_id },
                    headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    cache   : false,
                    success : function(resp){

                        var html = '';

                        $.each( resp.data, function( key, v ) {
                        
                            html += `

                                <tr>
                                    <td>${ key+1 }</td>
                                    <td>${ v.name }</td>
                                    <td>${ v.address }</td>
                                    <td>
                                        <div class="exam-center-checkbox">
                                            <input type="checkbox" name="exam_center_id[]" value="${ v.id }" ${ v.checked }> 
                                        </div>
                                    </td>
                                </tr>

                            `;
                        });

                        $('#assign-exam-center-modal tbody').html(html);
                        $('#assign-exam-center-modal #user_id').val(user_id);
                        $('#assign-exam-center-modal #examiner_name').text('Name of examiner: '+examiner_name);

                        $('.exam-center-checkbox').iCheck({
                            checkboxClass: 'icheckbox_square-green',
                            radioClass: 'iradio_square-green',
                        });

                        $('#assign-exam-center-modal').modal('show');
                    },
                    error : function(){

                    },
                    beforeSend : function(){

                    },
                    complete   : function () {

                    }
                });
            });

            $(document).on('click','#assign-exam-center-btn',function(e){
                e.preventDefault();

                $.ajax({

                    url: '{{ route("update-assign-exam-center") }}',
                    type: "POST",
                    data : $('#form-assign-exam-center').serializeArray(),
                    headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    cache   : false,
                    success : function(resp){
                        toastr.success(resp.msg);
                    },
                    error : function(){
                        toastr.error(resp.msg);
                    },
                    beforeSend : function(){

                    },
                    complete   : function () {
                        $('#assign-exam-center-modal').modal('hide');
                        $('.i-checks-all').iCheck('uncheck');
                    }
                });
            });


        });
    </script> 

   
@endpush

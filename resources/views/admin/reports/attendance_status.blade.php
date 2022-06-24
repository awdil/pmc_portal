@extends('admin.layouts.admin_main')

@section('header')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2>Candidate Attendance Report</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="">Reports</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Candidate Attendance Report</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <!-- <a href="" class="btn btn-primary">Admin This is action area</a> -->
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
                    <h5>Candidate Attendance Report</h5>
                </div>
                <div class="ibox-content">
                    <div class="wrapper wrapper-content">
                        <form class="m-b" role="form" method="post" enctype="multipart/form-data" action="{{ route('export-candidates') }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <select data-placeholder="Select Country" class="load_select form-control" name="country_id" id="country_id" data-target="state_id" data-url="{{ route('list-states') }}">
                                            <option value="">Select Country</option>
                                            @foreach ($country as $single)
                                                <option value="{{$single->id}}">{{$single->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <select data-placeholder="Select Province" class="load_select form-control" name="state_id" id="state_id" data-target="city_id" data-url="{{ route('list-cities') }}">
                                            <option value="">Select Province</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <select data-placeholder="Select City" class="load_select form-control" name="city_id" id="city_id" data-target="exam_center_id" data-url="{{ route('list-exam-centers') }}">
                                            <option value="">Select City</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <select data-placeholder="Select Exam Center" class="select-2 form-control" name="exam_center_id" id="exam_center_id">
                                            <option value="">Select Exam Center</option>
                                        </select>
                                    </div> 
                                </div> 
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <select data-placeholder="Select Exam" class="select-2 form-control" name="exam_id" id="exam_id">
                                            <option value="">Select Exam</option>
                                            @foreach ($exams as $single)
                                                <option value="{{$single->id}}">{{$single->exam_title}}</option>
                                            @endforeach
                                        </select>
                                    </div> 
                                </div>   
                                <div class="col-sm-4">
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
                            <table class="table table-bordered" id="attendance-status">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Registration No.</th>
                                        <th>Attendance</th>
                                        <th>Candidate Name</th>
                                        <th>Country</th>
                                        <th>Provience</th>
                                        <th>City</th>
                                        <th>Exam</th>
                                        <th>Exam Center</th>
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
    <script type="text/javascript">

        function format ( d ) {
            // `d` is the original data object for the row
            return '<table class="table table-bordered">'+
                '<tr>'+
                    '<th>Exam Date:</th>'+
                    '<td>'+d.created_at+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<th>Exam Time:</th>'+
                    '<td>'+d.created_at+'</td>'+
                '</tr>'+
            '</table>';
        }


        $(document).ready(function () {
            // init datatable.
            var attendanceStatus = $('#attendance-status').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                pageLength: 10,
                scrollX: true,
                searching: false, 
                paging: true,
                pageLength: 50,
                ordering: false,
                order: [[ 1, "desc" ]],
                ajax: {
                    url: "{{ route('report.attendance-status') }}",
                    data: function ( d ) {
                        d.country_id = $('#country_id').val();
                        d.state_id = $('#state_id').val();
                        d.city_id = $('#city_id').val();
                        d.exam_center_id = $('#exam_center_id').val();
                        d.exam_id = $('#exam_id').val();
                        d.search_term = $('#search_term').val();
                    }
                },
                columns: [
                    {
                        "className":      'dt-control',
                        "orderable":      false,
                        "data":           '<i class="fa fa-minus-square-o"></i>',
                        "defaultContent": '<i class="fa fa-plus-square-o"></i>'
                    },
                    {data: 'reg_number', name: 'reg_number'},
                    {data: 'attendance', name: 'attendance'},
                    {data: 'user.name', name: 'user.name'},
                    {data: 'city.state.country.name', name: 'city.state.country.name'},
                    {data: 'city.state.name', name: 'city.state.name'},
                    {data: 'city.name', name: 'city.name'},
                    {data: 'timeslot.exam_calander.exam.exam_title', name: 'timeslot.exam_calander.exam.exam_title'},
                    {data: 'exam_center.name', name: 'exam_center.name'},
                    // {data: 'action', name: 'action',orderable:false,serachable:false,sClass:'text-center'},
                ]
            });

            $('#attendance-status tbody').on('click', 'td.dt-control', function () {
                var tr = $(this).closest('tr');
                var row = attendanceStatus.row( tr );
         
                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                }
            });

            $(document).on('change','#country_id, #state_id, #city_id, #exam_center_id, #exam_id',function(e){
                console.log('searching...');
                attendanceStatus.ajax.reload( null, false );
            });

            $(document).on('keyup','#search_term',function(e){
                console.log('searching...');
                attendanceStatus.ajax.reload( null, false );
            });
        });
    </script>
@endpush
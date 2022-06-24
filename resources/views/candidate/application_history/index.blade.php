@extends('candidate.layouts.candidate_main')

@section('header')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Application History</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Application History</strong>
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
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Application History</h5>
            </div>
            <div class="ibox-content">
                <!-- <div class="table-responsive"> -->
                    <table class="table table-striped table-bordered table-hover" id="application-history">
                        <thead>
                            <tr>
                                <th>Exam Title</th>
                                <th>Exam Center</th>
                                <th>Exam Date</th>
                                <th>Time</th>
                                <th>Registration Status</th>
                                <th>Applied on</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        
                    </table>
                <!-- </div> -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('footer_scripts')
    <script>
        $(document).ready(function () {
            // init datatable.
            var dataTable = $('#application-history').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                pageLength: 10,
                scrollX: true,
                "order": [[ 0, "desc" ]],
                ajax: '{{ route('application-history') }}',
                columns: [
                    {data: 'timeslot.exam_calander.exam.exam_title', name: 'timeslot.exam_calander.exam.exam_title'},
                    {data: 'exam_center.name', name: 'exam_center.name'},
                    {data: 'timeslot.exam_calander.exam_date', name: 'timeslot.exam_calander.exam_date'},
                    {data: 'timeslot.time_from', name: 'timeslot.time_from'},
                    {data: 'registration_status', name: 'registration_status'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action',orderable:false,serachable:false,sClass:'text-center'},
                ]
            });
            
            $('.dataTables_scrollBody').removeAttr('style');
        });
    </script> 
@endpush

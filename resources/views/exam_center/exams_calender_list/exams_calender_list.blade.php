@extends('exam_center.layouts.exam_center_main')
@push('table-style')
 <!-- <link href="{{ asset('assets/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet"> -->
@endpush
@section('header')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Exam Calender</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('exam-list') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Exam Calender</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <!-- <a href="/add-exam-center" class="btn btn-primary">Add New Exam Center</a> -->
        </div>
    </div>
</div>
@endsection

@section('content')

@if(isset($exam_calendar))
    @include('exam_center.exams_calender_list.update_exam_calender')
@else
    @include('exam_center.exams_calender_list.add_new_exam_calender')
@endif

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Exam Calender List</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="exam-calender-list">
                            <thead>
                                <tr>
                                    <th>Exam Name</th>
                                    <th>Exam Center</th>
                                    <th>Exam Date</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                    <th width="150" class="text-center">Action</th>
                                </tr>
                            </thead>
                        </table>
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
            var dataTable = $('#exam-calender-list').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                pageLength: 10,
                scrollX: true,
                "order": [[ 0, "desc" ]],
                ajax: '{{ route('exams-calender') }}',
                columns: [
                    {data: 'exam.exam_title', name: 'exam.exam_title'},
                    {data: 'exam_center.name', name: 'exam_center.name'},
                    {data: 'exam_date', name: 'exam_date'},
                    {data: 'status', name: 'status'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action',orderable:false,serachable:false,sClass:'text-center'},
                ]
            });

            $('.dataTables_scrollBody').removeAttr('style');
        });
    </script> 
@endpush
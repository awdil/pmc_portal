@extends('exam_center.layouts.exam_center_main')
@push('table-style')
 <!-- <link href="{{ asset('assets/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet"> -->
@endpush
@section('header')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Exam Centers</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('exam-centers') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Exam Centers</strong>
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

@if(isset($examcenter))
    @include('exam_center.exam_centers.update_exam_center')
@else
    @include('exam_center.exam_centers.add_new_exam_center')
@endif

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Exam Centers List</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="exam-centers">
                            <thead>
                                <tr>
                                    <th>Center Name</th>
                                    <th>Capacity</th>
                                    <th>City</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th width="110">Address</th>
                                    <th width="50" class="text-center">Action</th>
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
            var dataTable = $('#exam-centers').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                pageLength: 10,
                scrollX: true,
                "order": [[ 0, "desc" ]],
                ajax: '{{ route('exam-centers') }}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'capacity', name: 'capacity'},
                    {data: 'city.name', name: 'city.name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone_number', name: 'phone_number'},
                    {data: 'status', name: 'status'},
                    {data: 'address', name: 'address'},
                    {data: 'action', name: 'action',orderable:false,serachable:false,sClass:'text-center'},
                ]
            });

            $('.dataTables_scrollBody').removeAttr('style');
        });
    </script> 
@endpush
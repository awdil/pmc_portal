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
                        <div class="table-responsive">
                            <table class="table table-bordered" id="candidate-list">
                                <thead>
                                    <tr>
                                        <th>Candidate Name</th>
                                        <th>CNIC Number</th>
                                        <th>Exam</th>
                                        <th>Registration No.</th>
                                        <th>Arrival</th>
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
            var dataTable = $('#candidate-list').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                pageLength: 10,
                scrollX: true,
                "order": [[ 0, "desc" ]],
                ajax: '{{ route('candidates') }}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'mobile_number', name: 'mobile_number'},
                    {data: 'email', name: 'email'}, 
                    {data: 'status', name: 'status'}, 
                    {data: 'created_at', name: 'created_at'}, 
                    {data: 'action', name: 'action',orderable:false,serachable:false,sClass:'text-center'},
                ]
            });
        });
    </script> 
@endpush

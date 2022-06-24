@extends('admin.layouts.admin_main')
@section('header')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>List of roles</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>List of roles</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <a class="btn btn-primary btn-lg" href="{{ route('roles.create') }}">Create a new role</a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container">
    <div class="wrapper wrapper-content">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="ibox">
                <div class="ibox-title"><h5> Roles List </h5></div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dt-roles-list">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Display Name</th>
                                    <th>#Permissions</th>
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
            
            var dataTable = $('#dt-roles-list').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                pageLength: 10,
                scrollX: true,
                "order": [[ 0, "desc" ]],
                ajax: '{{ route('roles.index') }}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'display_name', name: 'display_name'},
                    {data: 'permissions', name: 'permissions'},
                    {data: 'action', name: 'action',orderable:false,serachable:false,sClass:'text-center'},
                ]
            });

            $('.dataTables_scrollBody').removeAttr('style');
        });
    </script> 
@endpush
@extends('admin.layouts.admin_main')
@section('header')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Edit a permission</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Edit a permission</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <!-- <a href="" class="btn btn-primary">Admin This is action area</a> -->
        </div>
    </div>
</div>
<div class="container">
    <div class="wrapper wrapper-content">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">Permission Board</div>
                <div class="card-body">
                    <p>Permission <b>{{ $permission->display_name }}</b> was created <b>{{ $permission->created_at->diffForHumans() }}</b> and last updated <b>{{ $permission->updated_at->diffForHumans() }}</b></p>
                    <form method="post" action="{{ route('admin.permissions.destroy', $permission) }}">
                        @csrf
                        @method('delete')
                        <button onclick="return confirm('Are you sure you want to delete this?')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i>Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
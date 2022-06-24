@extends('admin.layouts.admin_main')
@section('header')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Create a new role</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Create a new role</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <a class="btn btn-primary btn-lg" href="{{ route('roles.roles') }}">Roles List</a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container">
	<div class="wrapper wrapper-content">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">Create a new role</div>
				<div class="card-body">
					<form action="{{ route('roles.store') }}" method="post">
						@csrf
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputEmail4">Role name</label>
								<input type="text" name="name" class="form-control">
							</div>
							<div class="form-group col-md-6">
								<label for="inputPassword4">Role display name</label>
								<input type="text" name="display_name" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label for="formGroupExampleInput">Role Description</label>
							<input type="text" name="description" class="form-control">
						</div>
						<button type="submit" class="btn btn-primary btn-sm">Create new role</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
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
@endsection

@section('content')
<div class="container">
	<div class="wrapper wrapper-content">
        <div class="col-sm-12 col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header">Edit permission</div>
				<div class="card-body">
					<form action="{{ route('permissions.update', $permission->id) }}" method="post">
						@csrf
						@method('PATCH')
						<div class="form-row">
							<div class="form-group col-md-6">
								<label class="form-label">Permission name</label>
								<input type="text" name="name" value="{{ $permission->name }}" class="form-control @error('name') is-invalid @enderror">
								@error('name')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
							<div class="form-group col-md-6">
								<label class="form-label">Permission display name</label>
								<input type="text" name="display_name" value="{{ $permission->display_name }}"  class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="form-label">Permission Description</label>
							<input type="text" name="description" value="{{ $permission->description }}"  class="form-control">
						</div>
						<button type="submit" class="btn btn-primary btn-sm">Update permission</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
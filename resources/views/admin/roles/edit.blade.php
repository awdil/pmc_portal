@extends('admin.layouts.admin_main')
@section('header')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Edit role</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Edit role</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <a class="btn btn-primary btn-lg" href="{{ route('roles.index') }}">Roles List</a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="wrapper wrapper-content">
	<div class="col-md-12 col-lg-12">
		<div class="card">
			<div class="card-header">Editing {{ $role->name }} </div>
			<div class="card-body">
				<form action="{{ route('roles.update', $role) }}" method="POST">
					@csrf
					@method('PUT')
					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<label class="form-label">Role name<span class="form-required">*</span></label>
								<input type="text" name="name" value="{{ $role->name }}" class="form-control" required="">
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label class="form-label">Display name</label>
								<input type="text" name="display_name" value="{{ $role->display_name }}"  class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label class="form-label">Description</label>
								<input type="text" name="description" value="{{ $role->description }}"  class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="card mb-3">
								<div class="card-header">Permissions</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
											<thead>
												<tr>
													<th>Box</th>
													<th>name</th>
													<th>Display name</th>
													<th>Description</th>
												</tr>
											</thead>
											<tbody>
												@foreach($permissions as $item)
												<tr>
													<td>
														<input
														type="checkbox"
														class="form-checkbox h-4 w-4"
														name="permissions[]"
														value="{{$item->id}}"
														{!! $item->assigned ? 'checked' : '' !!}
														>
														{{-- @if(in_array($item->id, $role_permissions))
														<input type="checkbox" name="permissions[]" value="{{ $item->id }}" checked>
														@else
														<input type="checkbox" name="permissions[]" value="{{ $item->id }}">
														@endif --}}
													</td>
													<td>{{ $item->name }}</td>
													<td>{{ $item->display_name }}</td>
													<td>{{ $item->description }}</td>
												</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-footer">
						<button type="submit" class="btn btn-primary btn-sm">Update role</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
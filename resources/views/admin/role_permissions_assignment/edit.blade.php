@extends('admin.layouts.admin_main')
@section('header')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Edit Roles Assignment</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Edit Roles Assignment</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        
    </div>
</div>
@endsection

@section('content')
<div class="wrapper wrapper-content">
	<div class="col-md-12 col-lg-12">
		<div class="card">
			<div class="card-header">Roles Permissions Assignment</div>
			<div class="card-body">
				<form method="POST" action ="{{ route('assign-role-permissions', $user->id) }}" class="" >
        @csrf
        {{-- @method('PUT') --}}
					<div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label class="form-label">User name<span class="form-required"></span></label>
                  <input type="text" value="{{ $user->name }}" class="form-control" disabled>
                </div>
              </div>
              
              <div class="col-12">
                <div class="card mb-3">
                  <div class="card-header">
                    <div class="row">
                        <div class="col-6 mt-1">Roles</div>
                        <div class="col-6 text-right">
                          <button type="submit" class="btn btn-primary btn-sm" type="submit" >Update</button>
                        </div>
                    </div>
                  </div>
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
                          @foreach ($roles as $role)
                          <tr>
                            <td>
                              {{-- @if(in_array($item->id, $user_roles))
                              <input type="checkbox" name="permissions[]" value="{{ $item->id }}" checked>
                              @else
                              <input type="checkbox" name="permissions[]" value="{{ $item->id }}">
                              @endif --}}
                              <input
                                type="checkbox"
                                @if ($role->assigned && !$role->isRemovable)
                                class="form-checkbox focus:shadow-none focus:border-transparent text-gray-500 h-4 w-4"
                                @else
                                class="form-checkbox h-4 w-4"
                                @endif
                                name="roles[]"
                                value="{{$role->id}}"
                                {!! $role->assigned ? 'checked' : '' !!}
                                {!! $role->assigned && !$role->isRemovable ? 'onclick="return false;"' : '' !!}
                              >
                            </td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->display_name }}</td>
                            <td></td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                @if ($permissions)
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
                          @foreach ($permissions as $permission)
                          <tr>
                            <td>
                              <input
                              type="checkbox"
                              class="form-checkbox h-4 w-4"
                              name="permissions[]"
                              value="{{$permission->id}}"
                              {!! $permission->assigned ? 'checked' : '' !!}
                            >
                            </td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->display_name }}</td>
                            <td></td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              @endif
          </div>
          <div class="form-footer">
            <button type="submit" class="btn btn-primary btn-sm btn-block" type="submit" >Update</button>
          </div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@push('footer_scripts')
    <script>
        
    </script> 
@endpush
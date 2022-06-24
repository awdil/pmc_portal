<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRoleRequest;
use DataTables;

class RoleController extends Controller
{
    
    public function index(Request $request)
    {
        //$roles = Role::with('permissions')->get();
        //dd($roles->toArray());
        if ($request->ajax()) {
            $data = Role::with('permissions')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '

                    <div class="btn-group">
                        <a class="btn-primary btn btn-xs" href="'.route("roles.edit",  $row->id).'">Edit</a>
                        <a class="btn-danger btn btn-xs text-white" data-table="dt-roles-list">Delete</a>
                    </div>';

                    return $actionBtn;
                })
                ->addColumn('permissions', function($row){
                    $count = ($row->permissions->count());
                    return $count;
                })
                ->rawColumns(['action', 'permissions'])
                ->make(true);
        }
        return view('admin.roles.index');
    }
    
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(CreateRoleRequest $request)
    {
        
        try {
            $role = Role::create([
                'name' => $request->name,
                'display_name' => $request->display_name,
                'description' => $request->description,
            ]);
            
            if ($role->wasRecentlyCreated) {
                return redirect('roles')->with('success', 'Role is created!');
            }else{
                return redirect('roles')->withErrors($request)->withInput();
            }

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }
    
    public function show(Role $role)
    {
        return view('admin.roles.show', compact('role'));
    }
    
    public function edit(Role $role)
    {
        //$permissions = Permission::orderBy('display_name', 'ASC')->get();
        $role_permissions = $role->permissions()->get()->pluck('id')->toArray();
        $permissions = Permission::all(['id', 'name', 'display_name'])
            ->map(function ($permission) use ($role) {
                $permission->assigned = $role->permissions
                    ->pluck('id')
                    ->contains($permission->id);

                return $permission;
            });

        return view('admin.roles.edit', compact('role', 'permissions', 'role_permissions'));
    }
   
    public function update(CreateRoleRequest $request, Role $role)
    {
        $role->update([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description,
        ]);

        if($role->save()){
            if($request->input('permissions')){
                $role->syncPermissions($request->input('permissions'));
            }
        }

        return redirect(route('roles.index'))->with('success', 'Role is updated!');
    }
    
    public function destroy(Role $role)
    {
        $role->users()->sync([]);
        $role->permissions()->sync([]);
        $role->delete();

        return redirect(route('roles.index'));
    }
}

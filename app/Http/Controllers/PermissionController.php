<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePermissionRequest;
use DataTables;

class PermissionController extends Controller
{
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Permission::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '

                    <div class="btn-group">
                        <a class="btn-primary btn btn-xs" href="'.route("permissions.edit", $row->id).'">Edit</a>
                        <a class="btn-danger btn btn-xs text-white" data-table="dt-permissions-list">Delete</a>
                    </div>';

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.permissions.index');
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(CreatePermissionRequest $request)
    {
        try {
            $permission = Permission::create([
                'name' => $request->name,
                'display_name' => $request->display_name,
                'description' => $request->description,
            ]);
            
            if ($permission->wasRecentlyCreated) {
                return redirect('permissions')->with('success', 'Permission is created!');
            }else{
                return redirect('permissions')->withErrors($request)->withInput();
                //return back()->withErrors($request->errors());
            }

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function show(Permission $permission)
    {
        return view('admin.permissions.show', [
            'permission' => $permission
        ]);
    }

    public function edit($id)
    {
        $permission = Permission::where([
            'id' => $id,
        ])->first();
        return view('admin.permissions.edit', [
            'permission' => $permission
        ]);
    }

    // public function update(CreatePermissionRequest $request, $id)
    // {
    //     $permission = Permission::where('id', $id)->first();  
    //     $permission->update([
    //         'name' => $request->name,
    //         'display_name' => $request->display_name,
    //         'description' => $request->description,
    //     ]);

    //     return redirect(route('admin.permissions.index'));
    // }

    public function update(CreatePermissionRequest $request, Permission $permission)
    {
        $permission->update([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description,
        ]);

        return redirect(route('permissions.index'))->with('success', 'Permission is updated!');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect(route('admin.permissions.index'));
    }
}

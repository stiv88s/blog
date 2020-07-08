<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Permission as GPermission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Permission::class);

        $permissions = Permission::all();

        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Permission::class);

        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Permission::class);

        $permission = Permission::create([
            'name' => $request->name
        ]);

        Session::flash('status', 'Permission is stored');

        return redirect()->route('permission.index', app()->getLocale());
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        $this->authorize('update', $permission);

        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $this->authorize('update', $permission);

        $permission->fill([
            'name' => $request->name
        ]);

        $permission->save();

        Session::flash('status', 'Permission is Updated');

        return redirect()->route('permission.index', app()->getLocale());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $this->authorize('delete', $permission);

        $permission->delete();

        $permissions = Permission::all();
        return $permissions;

    }

    public function generate(Request $request)
    {
        $this->authorize('create', Permission::class);
        $permission = GPermission::generate();

        Session::flash('status', 'Permission is Generated');

        if ($request->wantsJson()) {
            return $permission;
        }

        return redirect()->route('permission.index', app()->getLocale());
    }
}

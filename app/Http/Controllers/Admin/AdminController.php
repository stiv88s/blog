<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Admin;
use App\Model\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Admin::class);

        $admins = Admin::all();

        return view('admin.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Admin::class);

        $roles = Role::all()->pluck('rolename', 'id');

        return view('admin.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Admin::class);

        DB::beginTransaction();



        try {
            $admin = Admin::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'status' => $request->input('status', 0),
                'password' => bcrypt($request->input('password')),
                'active_to' => $request->input('active_to',null)

            ]);

            if($request->active_to){
                $admin->active_to = $request->active_to;
            }

            $admin->save();

            $admin->roles()->sync($request->roles);

        } catch (\Exception $e) {

            DB::rollBack();
        }
        DB::commit();

        Session::flash('status', 'Admin is Created');

        return redirect()->route('admin.index', app()->getLocale());


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        $this->authorize('update', $admin);

        $roles = Role::all()->pluck('rolename', 'id');

        return view('admin.admins.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $activeTo = $request->input('active_to');

        if(!$activeTo ){
           $status = 1;
        }else{
            $status = $request->input('status');
        }

        $this->authorize('update', $admin);

        $admin->fill([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'status' => $status,
            'active_to' => $request->input('active_to',null)
        ]);
        if ($request->input('password')) {
            $admin->password = bcrypt($request->input('password'));
        }

        $admin->save();

        $admin->roles()->sync($request->roles);

        Session::flash('status', 'Admin is Updated');

        return redirect()->route('admin.index', app()->getLocale());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $this->authorize('delete', $admin);

        if (!$admin->posts->isEmpty()) {
            foreach ($admin->posts as $post) {
                $post->delete();
            }
        }
        $admin->delete();
    }
}

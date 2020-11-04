<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Session;

class PermissionController extends Controller {

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index() {
        $permissions = Permission::all(); //Get all permissions

        return view('permissions.index')->with('permissions', $permissions);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create() {
        $roles = Role::get(); //Get all roles
        $permission = new Permission();
        return view('permissions.create', compact('roles', 'permission'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request) {
        $this->validate($request, [
            'name'=>'required|max:40',
            'roles'=>'required'
        ]);
        $permission = Permission::create(['name' => $request['name']]);

        $permission->syncRoles($request['roles']);

        return redirect()->route('permissions.edit', compact('permission'))
            ->with('success','Permission '. $permission->name.' added!');

    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id) {
        return redirect('permissions');
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id) {
        $permission = Permission::findOrFail($id);
        $roles = Role::get(); //Get all roles

        return view('permissions.edit', compact('permission'))->with('roles', $roles);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id) {
        $permission = Permission::findOrFail($id);
        $this->validate($request, [
            'roles'=>'required'
        ]);
        $input = $request->all();
        $permission->syncRoles($input['roles']);
        // $input = array_except($input,['roles']);
        // $permission->fill($input)->save();

        return redirect()->route('permissions.edit', compact('permission'))
            ->with('success',
             'Permission'. $permission->name.' updated!');

    }
}
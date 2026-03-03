<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    //
    public function index()
{
    $roles = Role::all();
    return view('admin.roles.index', compact('roles'));
}
public function store(Request $request)
{
    $request->validate([
        'name'=>'required'
    ]);
    Role::create(['name' => $request->name]);
    return back()->with(['success'=>'Role added ']);
}
public function update(Request $request,$id){
   $request->validate([
        'name' => 'required|unique:roles,name,' . $id,
    ]);

    $role = Role::findOrFail($id);

    $role->name = $request->name;
    $role->save();

    return back()->with('success', 'Role Updated Successfully');
}
public function destroy($id){
    $role = Role::findOrFail($id);
    $role->delete();
     return back()->with('success', 'Role Deleted Successfully');
}
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
    Role::create(['name' => $request->name]);
    return back();
}
}

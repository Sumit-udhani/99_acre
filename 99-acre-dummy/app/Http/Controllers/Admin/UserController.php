<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
class UserController extends Controller
{
    //
    function index(){

        $users = User::with('roles')->get();
       return view('admin.users.index', compact('users'));
    }
    public function update(Request $request, User $user)
{
    $user->syncRoles([$request->role]);
    return back()->with('success','Role updated');
}
}

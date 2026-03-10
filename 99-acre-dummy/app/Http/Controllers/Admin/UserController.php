<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\UserApprovedMail;
use App\Mail\UserRejectedMail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class UserController extends Controller
{
    //
    function index(){

        $users = User::with('roles')->get();
          $roles = Role::all();
       return view('admin.users.index', compact('users','roles'));
    }
    function store(Request $req){
    $req->validate([
    'name'=>'required',
    'email' => 'required|email|unique:users,email',
          'password' => 'required|min:6',
    'role'=>'required'
    ]);
    $users = new User();
    $users->name= $req->name;
    $users->email= $req->email;
     $users->password = Hash::make($req->password);
     $users->assignRole($req->role);
    if ($users->save()) {
        return back()->with(['success'=>"User added successfully"]);
    }

    }
   public function update(Request $request, User $user)
{
    $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|min:6',
        'role' => 'required'
    ]);

    // Update basic fields
    $user->name  = $request->name;
    $user->email = $request->email;

    // Update password only if entered
    if($request->filled('password')){
        $user->password = bcrypt($request->password);
    }

    $user->save();

    // Update role
    $user->syncRoles([$request->role]);

    return back()->with('success','User updated successfully');
}
public function destroy(string $id){
    $users = User::findOrFail($id);
    $users->delete();
    return back()->with(['success'=>'User deleted successfully']);
}
public function updateStatus(Request $request, User $user)
{
   
    $request->validate([
        'status' => 'required|in:pending,approved,rejected'
    ]);

    $user->update([
        'status' => $request->status
    ]);

    if ($request->status === 'approved') {
        Mail::to($user->email)->send(new UserApprovedMail($user));
    }

    if ($request->status === 'rejected') {
        Mail::to($user->email)->send(new UserRejectedMail($user));
    }

    return response()->json([
        'status' => true,
        'message' => 'User status updated successfully.'
    ]);
}


}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\AdminUserRegisteredMail;
use App\Mail\UserRegisteredMail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
   public function store(Request $request): RedirectResponse
{
$request->validate([
'name' => ['required','string','max:255'],
'email' => ['required','string','email','max:255','unique:users,email'],
'country_code' => ['required','in:+91,+61'],
'phone' => [
'required',
'numeric',
$request->country_code == '+91' ? 'digits:10' : 'digits_between:9,10',
'unique:users,phone'
],
'password' => ['required', Rules\Password::defaults()],
]);

$user = User::create([
'name' => $request->name,
'email' => $request->email,
'country_code' => $request->country_code,
'phone' => $request->phone,
'password' => Hash::make($request->password),
]);

$user->assignRole('user');

Mail::to($user->email)->send(new UserRegisteredMail($user));
Mail::to(env('ADMIN_EMAIL'))->send(new AdminUserRegisteredMail($user));

event(new Registered($user));

  if ($request->from_modal) {
        return redirect()->back()
            ->with('showLoginModal', true)
            ->with('status', 'Registered successfully! Please verify your email from your mail.');
    }

    // 🔹 Normal register page
    return redirect()->back()
        ->with('status', 'Registered successfully! Please verify your email from your mail.');
}
}

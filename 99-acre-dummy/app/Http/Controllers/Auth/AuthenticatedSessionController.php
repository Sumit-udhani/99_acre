<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }   

public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();
    $request->session()->regenerate();
$user = $request->user();

// if (!$user->hasVerifiedEmail()) {

//     Auth::logout();

//     $request->session()->invalidate();
//     $request->session()->regenerateToken();

//     return back()->withErrors([
//         'email' => 'Please verify your email before logging in.'
//     ]);
// }
    // ✅ Admin can always login
    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }

    // 🚫 Only normal users must be approved
    if (! $user->isApproved()) {

       Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
        return back()->withErrors([
            'email' => 'Your account is not approved yet.',
        ]);
    }

   return redirect()->intended(route('dashboard'));
}
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

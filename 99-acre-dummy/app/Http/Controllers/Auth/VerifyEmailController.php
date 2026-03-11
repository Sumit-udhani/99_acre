<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
     public function __invoke(EmailVerificationRequest $request,$id,$hash): RedirectResponse
    {
      
       $user = User::findOrFail($id);
  if (! hash_equals(sha1($user->getEmailForVerification()), $hash)) {
        abort(403);
    }

    if (! $user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
        event(new Verified($user));
    }

    return redirect()->route('login')
        ->with('status', 'Email verified successfully. Please login.');
    }

    // private function redirectAfterVerify($request)
    // {
    //     if ($request->redirect === 'modal') {

    //         return redirect('/post-property?openLoginModal=1&verified=1');
    //     }

    //     return redirect()->route('login')
    //         ->with('status','Email verified successfully. Please login.');
    // }
}

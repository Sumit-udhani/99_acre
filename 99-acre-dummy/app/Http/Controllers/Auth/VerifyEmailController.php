<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
     public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
      
       $request->fulfill();

        return redirect()->route('login')
            ->with('status','Email verified successfully. Please login.');
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

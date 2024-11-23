<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('account.index', absolute: false));
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with([
            'status' => 'success',
            'message' => 'Email verification link has been sent to your email address.'
        ]);
    }
}

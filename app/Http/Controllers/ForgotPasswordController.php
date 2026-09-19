<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email',
            ],
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with([
                'status' => __($status),
            ])
            : back()->withErrors([
                'email' => __($status),
            ]);
    }
    public function resetPassword(Request $request)
{
    $request->validate([
        'token' => [
            'required',
        ],
        'email' => [
            'required',
            'email',
        ],
        'password' => [
            'required',
            'min:8',
            'confirmed',
        ],
    ]);

    $status = Password::reset(
        $request->only(
            'email',
            'password',
            'password_confirmation',
            'token'
        ),
        function ($user, $password) {

            $user->forceFill([
                'password' => \Illuminate\Support\Facades\Hash::make($password),
            ])->setRememberToken(
                \Illuminate\Support\Str::random(60)
            );

            $user->save();

            event(
                new \Illuminate\Auth\Events\PasswordReset($user)
            );
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()
            ->route('login')
            ->with('status', __($status))
        : back()->withErrors([
            'email' => [
                __($status),
            ],
        ]);
}
}
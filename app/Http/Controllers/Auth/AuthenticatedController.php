<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Request\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedController extends Controller
{
    public function showLogin(): Response
    {
        return Inertia::render('Auth/Signin');
    }

    public function login(LoginRequest $loginRequest)
    {
        $loginRequest->authenticate();

        $loginRequest->session()->regenerate();

        if (Auth::check()) 
        {
            $is_admin = Auth::user()->is_admin;

            if($is_admin)
            {
                return redirect()->intended(route('dashboard.admin'));
            } 
            else 
            {
                return redirect()->intended(route('dashboard.student'));
            }
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('login'));
    }
}

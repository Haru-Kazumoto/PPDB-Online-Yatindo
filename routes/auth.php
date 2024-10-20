<?php

use App\Http\Controllers\Auth\AuthenticatedController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
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

    return redirect()->route('login');
});

Route::middleware(['guest'])->group(function() {
    Route::get('login', [AuthenticatedController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthenticatedController::class, 'login']);

    Route::get('register-smp', [RegisteredUserController::class, 'showRegisterSmp'])->name('register.smp');
    Route::get('register-smk', [RegisteredUserController::class, 'showRegisterSmk'])->name('register.smk');
});

Route::middleware(['auth','web'])->group(function() {
    Route::post('logout', [AuthenticatedController::class, 'logout'])->name('logout');
});
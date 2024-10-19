<?php

use App\Http\Controllers\Auth\AuthenticatedController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function() {
    Route::get('login', [AuthenticatedController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthenticatedController::class, 'login']);

    Route::get('register-smp', [RegisteredUserController::class, 'showRegisterSmp'])->name('register.smp');
    Route::get('register-smk', [RegisteredUserController::class, 'showRegisterSmk'])->name('register.smk');
});
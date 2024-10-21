<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\PurchasingController;
use App\Http\Controllers\RegistrationBatchController;
use App\Http\Controllers\RegistrationPathController;
use App\Http\Controllers\RegistrationStepController;
use App\Http\Controllers\ReturningController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/dashboard/admin', [DashboardController::class, 'showAdminDashboard'])->name('dashboard.admin');
    Route::get('/dashboard/student', [DashboardController::class, 'showStudentDashboard'])->name('dashboard.student');
});

Route::middleware(['auth','web'])->group(function() {

    // Registration step
    Route::name('registration-step')->prefix('registration-step')->group(function() {
        Route::get('', [RegistrationStepController::class, 'index'])->name('.index');
        Route::get('create', [RegistrationStepController::class, 'create'])->name('.create');
        Route::post('store', [RegistrationStepController::class, 'store'])->name('.store');
        Route::get('edit/{registrationStep}', [RegistrationStepController::class, 'edit'])->name('.edit');
        Route::patch('update/{registrationStep}', [RegistrationStepController::class, 'update'])->name('.update');
        Route::delete('delete/{registrationStep}', [RegistrationStepController::class, 'destroy'])->name('.delete');
    });

    // Registration path
    Route::name('registration-path')->prefix('registration-path')->group(function() {
        Route::get('', [RegistrationPathController::class, 'index'])->name('.index');
        Route::get('create', [RegistrationPathController::class, 'create'])->name('.create');
        Route::post('store', [RegistrationPathController::class, 'store'])->name('.store');
        Route::get('detail/{registrationPath}', [RegistrationPathController::class, 'show'])->name('.detail');
        Route::get('edit/{registrationPath}', [RegistrationPathController::class, 'edit'])->name('.edit');
        Route::patch('update/{registrationPath}', [RegistrationPathController::class, 'update'])->name('.update');
        Route::delete('delete/{registrationPath}', [RegistrationPathController::class, 'destroy'])->name('.delete');
    });

    // Registration Batch
    Route::name('registration-batch')->prefix('registration-batch')->group(function() {
        Route::get('', [RegistrationBatchController::class, 'index'])->name('.index');
        Route::get('create/{registrationPath}', [RegistrationBatchController::class, 'create'])->name('.create');
        Route::post('store', [RegistrationBatchController::class, 'store'])->name('.store');
        Route::get('detail/{registrationBatch}', [RegistrationBatchController::class, 'show'])->name('.detail');
        Route::get('edit/{registrationBatch}', [RegistrationBatchController::class, 'edit'])->name('.edit');
        Route::patch('update/{registrationBatch}', [RegistrationBatchController::class, 'update'])->name('.update');
        Route::delete('delete/{registrationBatch}', [RegistrationBatchController::class, 'destroy'])->name('.delete');
    });

    //Participants
    Route::name('participant')->prefix('participants')->group(function() {
        Route::get('', [ParticipantController::class, 'indexBatches'])->name('.index-batch');
        Route::get('list/{registrationBatch}', [ParticipantController::class, 'detailBatchesAndParticipants'])->name('.list');
    });

    // Purchasing
    Route::name('purchasing')->prefix('purchasing')->group(function() {
        Route::get('', [PurchasingController::class, 'index'])->name('.index');
        Route::post('/purchase-update', [PurchasingController::class, 'updateInfo'])->name('.purchase-update');
        Route::post('/payment-add', [PurchasingController::class, 'addPayment'])->name('.payment-add');
        
        // Route::post('/post-assign', [PurchasingController::class, 'purchaseForm'])->name('.assign-1');
    });

    // Returning
    Route::name('returning')->prefix('returning')->group(function() {
        Route::get('', [ReturningController::class, 'index'])->name('.index');
        Route::post('/purchase-update', [ReturningController::class, 'updateInfo'])->name('.returning-update');
        Route::post('/payment-add', [ReturningController::class, 'addPayment'])->name('.payment-add');
        Route::post('/profile-add', [ReturningController::class, 'addProfile'])->name('.profile-add');
        Route::post('/family-card-add', [ReturningController::class, 'addFamilyCard'])->name('.family-card-add');
        Route::post('/birth-card-add', [ReturningController::class, 'addBirthCertificate'])->name('.birth-card-add');
//         addFamilyCard
// 
    });

});

Route::get('/ppdb', [LandingPageController::class, 'show']);

require __DIR__.'/auth.php';
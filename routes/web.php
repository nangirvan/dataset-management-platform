<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskManagementController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('auth')->name('auth.')->group(function() {
    Route::get('/login', [AuthController::class, 'index'])->name('login.view');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('auth')->group(function() {
    Route::redirect('/', '/task-management')->name('home');
    Route::resources([
        '/task-management' => TaskManagementController::class,
    ]);
    Route::prefix('task-management')->name('task-management.')->group(function() {
        Route::post('/booking', [TaskManagementController::class, 'booking'])->name('booking');
        Route::post('/revoke-booking', [TaskManagementController::class, 'revokeBooking'])->name('revoke-booking');    
        Route::post('/download', [TaskManagementController::class, 'downloadDataset'])->name('download');
    });
});

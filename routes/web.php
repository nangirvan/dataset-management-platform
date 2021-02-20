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

Route::redirect('/', '/task-management')->name('home')->middleware('auth');

Route::prefix('auth')->name('auth.')->group(function() {
    Route::get('/login', [AuthController::class, 'index'])->name('login.view');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::resources([
    '/task-management' => TaskManagementController::class,
]);
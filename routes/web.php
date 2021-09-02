<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminGroup;
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

Route::get('/', [HomeController::class, 'index']);

Route::middleware(['auth'])->group(function() {

    Route::resource('/users', UserController::class);
    Route::get('/dashboard',[DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/change-password', [UserController::class, 'view_password'])->name('change-password.view');
    Route::post('/change-password', [UserController::class, 'reset_password'])->name('change-password.reset');  
    Route::get('/change-profile', [UserController::class, 'view_profile'])->name('change-profile.view');
    Route::resource('/list-task',ListController::class);
    Route::resource('/tasks',TaskController::class);
    
});


require __DIR__.'/auth.php';

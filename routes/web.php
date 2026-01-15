<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('auth.welcome');
})->name('home');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.auth');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'storeRegister'])->name('register.store');

Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot.password');
Route::post('/forgot-password', [AuthController::class, 'sendForgotPassword'])->name('forgot.send');

// Tambahkan route logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('auth.dashboard');
})->name('dashboard');

Route::get('/jurnal', function () {
    return view('auth.jurnal');
})->name('jurnal'); 

Route::get('/report', function () {
    return view('auth.report');
})->name('report');

Route::get('/database-user', function () {
    return view('auth.database_user'); 
})->name('database-user');

Route::get('/update-data', function () {
    return view('auth.update_data');
})->name('update-data');

Route::get('/reset-password', function () {
    return view('auth.reset_password');
})->name('reset-password');
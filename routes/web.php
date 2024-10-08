<?php

use Illuminate\Support\Facades\Route;
// AUTHENTICATION ROUTES
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('Auth.auth');
    })->name('login');
    Route::post('/register', [App\Http\Controllers\Authentication\UserController::class, 'register']);
    Route::post('/login', [App\Http\Controllers\Authentication\UserController::class, 'login']);
});
Route::get('/logout', [App\Http\Controllers\Authentication\UserController::class, 'logout']);

Route::middleware(['role:PARTICIPANTS'])->group(function () {});

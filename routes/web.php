<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

// Rute root
Route::get('/', function () {
    return redirect()->route('login'); // Arahkan ke halaman login
})->name('root');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
    Route::get('/home', function () {
        echo 'Welcome to the home page';
    })->name('home');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::middleware('role:ANGGOTA')->group(function () {
        Route::get('/anggota', [LoginController::class, 'anggota'])->name('anggota');
    });
    Route::middleware('role:ADMIN')->group(function () {
        Route::get('/admin', [LoginController::class, 'admin'])->name('admin');
    });
});
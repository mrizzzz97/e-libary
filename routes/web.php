<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HallController;
use App\Http\Controllers\LoginController;


// Homepage
Route::get('/', function () {
    return view('homepage', ['title' => 'Homepage']);
});

// About
Route::get('/about', function () {
    return view('about', ['title' => 'About']);
});

// Dashboard (HANYA ADMIN)
Route::get('/dashboard', function () {
    return view('dashboard', ['title' => 'Dashboard']);
})->middleware(['auth', 'isAdmin']);

// Hall
Route::get('/hall', [HallController::class, 'index']);
Route::get('/hall/book/{book:slug}', [HallController::class, 'singleBook']);

// Login (guest only)
Route::get('/login', [LoginController::class, 'login'])
    ->name('login')
    ->middleware('guest');

Route::post('/login', [LoginController::class, 'authenticate'])
    ->middleware('guest');

// Registration (guest only)
Route::get('/registration', [LoginController::class, 'registration'])
    ->middleware('guest');

Route::post('/registration', [LoginController::class, 'store'])
    ->middleware('guest');

// Logout (auth only)
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth');
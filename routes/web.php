<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HallController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;

use function Pest\Laravel\call;

// About
Route::get('/about', function () {
    return view('about', ['title' => 'About']);
});

// Homepage
Route::get('/',[HomeController::class, 'index']);

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

// Forbidden page
Route::get('/forbidden', function () {
    return view('forbidden');
});

// Dashboard (HANYA ADMIN)
Route::get('/dashboard', function () {
    return view('dashboard.dashboard', ['title' => 'Dashboard']);
})->middleware(['auth', 'isAdmin']);

// Dashboard dengan prefix dan middleware
Route::prefix('dashboard')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/', function () {
        return view('dashboard.dashboard', ['title' => 'Dashboard']);
    });

    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create',[CategoryController::class, 'create'])->name('category.create');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/{category:slug}/edit', [CategoryController::class, 'edit']);
    Route::put('/category/{category:slug}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{category:slug}', [CategoryController::class, 'destroy'])->name('category.destroy');

    // author resource routes
    Route::resource('author', AuthorController::class);
    Route::resource('user', UserController::class);
    Route::resource('book', BookController::class);
});


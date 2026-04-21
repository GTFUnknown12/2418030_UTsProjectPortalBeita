<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Auth\AuthController;
use App\Models\News;

// Halaman Depan (User)
Route::get('/', function () {
    $news = News::with('category')->latest()->get();
    return view('welcome', compact('news'));
});

// Route untuk Dokumentasi API
Route::get('/api-docs', function () {
    $markdown = file_get_contents(base_path('Dokumentasi.md'));
    $parsedown = new Parsedown();
    $html = $parsedown->text($markdown);
    return view('api-docs', compact('html'));
});

// Authentication Routes
Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

// Halaman Admin (Protected dengan middleware auth dan admin)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard Utama Admin (Home)
    Route::get('/', function () {
        $news = News::with('category')->latest()->get();
        return view('admin.home', compact('news'));
    })->name('dashboard');

    Route::resource('categories', CategoryController::class);
    Route::resource('news', NewsController::class);
});
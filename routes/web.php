<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\SparePartController;

// Anasayfa
Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('homepage');

// Kullanici dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// admin dashboard
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');

// cart
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/items', [CartController::class, 'items'])->name('cart.items');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');


Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->group(function () {
        Route::resource('spare-parts', SparePartController::class);
    });

// Profil islemleri
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

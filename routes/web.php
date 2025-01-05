<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\GerejaController;
use App\Http\Controllers\KeanggotaanController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware(['role:admin', 'log'])->group(function () {
    Route::get('/admin/dashboard', [BerandaController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::resource('gereja', GerejaController::class); 
    Route::resource('pengguna', UserController::class); 
    Route::resource('anggota', KeanggotaanController::class)->parameters(['anggota' => 'anggota']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

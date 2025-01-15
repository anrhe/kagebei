<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\GerejaController;
use App\Http\Controllers\KeanggotaanController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RoleMiddleware;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware(['role:admin', 'log'])->group(function () {
    Route::get('/admin/dashboard', [BerandaController::class, 'dashboardAdminGlobal'])->name('admin.dashboard');
    Route::get('/admin/list-pengguna', [UserController::class, 'listPengguna'])->name('admin.list.pengguna');
    Route::resource('pengguna', UserController::class);
});


Route::middleware(['role:operator,gembala,user', 'log'])->group(function () {
    Route::get('/gereja/jemaat', [BerandaController::class, 'dashboardAdminGereja'])->name('admin.gereja.dashboard');
    Route::get('/gereja/keuangan', [TransaksiController::class, 'summary'])->name('laporan.summary');
});

Route::middleware(['role:admin,operator', 'log'])->group(function () {
    Route::resource('gereja', GerejaController::class); 
    Route::resource('anggota', KeanggotaanController::class)->parameters(['anggota' => 'anggota']);
});

Route::middleware(['role:operator,gembala', 'log'])->group(function () {
    Route::resource('transaksi', TransaksiController::class);
    Route::resource('pengumuman', PengumumanController::class);
});

Route::middleware(['role:operator', 'log'])->group(function () {
    Route::resource('laporan', TransaksiController::class);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/beranda', function () {
        return view('admin.beranda');
    })->name('dashboard');
    Route::get('/informasi', [PengumumanController::class, 'index'])->name('pengumuman');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

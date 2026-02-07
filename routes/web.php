<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('landingpage');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==================== ROLE-BASED DASHBOARDS ====================

// Dashboard untuk Admin (Supervisor)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard/supervisor', function () {
        return view('dashboard');
    })->name('dashboard.supervisor');
});

// Dashboard untuk Operator (Kasir)
Route::middleware(['auth', 'role:operator'])->group(function () {
    Route::get('/dashboard/kasir', function () {
        return view('dashboard');
    })->name('dashboard.kasir');
});

// ==================== MANAGER ROUTES (SUPER ADMIN) ====================
Route::middleware(['auth', 'role:super_admin'])->prefix('manager')->name('manager.')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('manager.dashboard');
    })->name('dashboard');

    // ===== KELOLA USER (CRUD) =====
    Route::resource('users', \App\Http\Controllers\Manager\UserController::class);

    // ===== KELOLA DISKON (CRUD) =====
    Route::resource('diskon', \App\Http\Controllers\Manager\DiskonController::class);

    // ===== KELOLA BARANG (CRUD) =====
    Route::resource('barang', \App\Http\Controllers\Manager\BarangController::class);

    // ===== TRANSAKSI PEMBELIAN (Supplier langsung di sini) =====
    Route::resource('pembelian', \App\Http\Controllers\Manager\PembelianController::class);

    // ===== TRANSAKSI PENJUALAN =====
    Route::resource('penjualan', \App\Http\Controllers\Manager\PenjualanController::class);
    Route::put('penjualan/{penjualan}/cancel', [\App\Http\Controllers\Manager\PenjualanController::class, 'cancel'])
        ->name('penjualan.cancel');

    // ===== LAPORAN TRANSAKSI =====
    Route::get('laporan', [\App\Http\Controllers\Manager\LaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/export', [\App\Http\Controllers\Manager\LaporanController::class, 'export'])->name('laporan.export');
    Route::get('laporan/print', [\App\Http\Controllers\Manager\LaporanController::class, 'print'])->name('laporan.print');
});

require __DIR__ . '/auth.php';

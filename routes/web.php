<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landingpage');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard/supervisor', function () {
        return view('dashboard');
    })->middleware('role:admin')
        ->name('dashboard.supervisor');

    Route::get('/dashboard/kasir', function () {
        return view('dashboard');
    })->middleware('role:operator')
        ->name('dashboard.kasir');
});

Route::middleware(['auth', 'role:super_admin'])->prefix('manager')->name('manager.')->group(function () {

    Route::get('/dashboard', function () {
        return view('manager.dashboard');
    })->name('dashboard');
});


require __DIR__ . '/auth.php';

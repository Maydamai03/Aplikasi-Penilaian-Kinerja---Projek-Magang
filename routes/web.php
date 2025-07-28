<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // <-- 1. Jangan lupa tambahkan ini di atas
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KaryawanController; // <-- Tambahkan ini
use App\Http\Controllers\Admin\JobListController; // <-- Tambahkan ini


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(); // <-- 2. Tambahkan baris ini

// Route untuk redirect halaman utama ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Route untuk halaman setelah login (biasanya dashboard)
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('home');

     // Route BARU untuk CRUD Karyawan
    Route::resource('karyawan', KaryawanController::class);

    // Route BARU untuk update status karyawan langsung di detail info karyawan
    Route::patch('/karyawan/{karyawan}/status', [KaryawanController::class, 'updateStatus'])->name('karyawan.updateStatus');

   

    // JOB LIST ROUTES
    Route::get('/karyawan/{karyawan}/joblist', [JobListController::class, 'index'])->name('joblist.index');
    Route::post('/karyawan/{karyawan}/joblist', [JobListController::class, 'store'])->name('joblist.store');
    Route::get('/karyawan/{karyawan}/joblist/{week}/{year}', [JobListController::class, 'show'])->name('joblist.show');
    Route::delete('/karyawan/{karyawan}/joblist/{week}/{year}', [JobListController::class, 'destroy'])->name('joblist.destroy');

});


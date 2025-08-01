<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // <-- 1. Jangan lupa tambahkan ini di atas
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\Admin\JobListController;
use App\Http\Controllers\Admin\PenilaianController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Superadmin\KelolaAdminController;


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



    // --- JOB & PENILAIAN ROUTES ---
    // Menampilkan halaman kelola joblist (Siang & Malam)
    Route::get('/karyawan/{karyawan}/job', [JobListController::class, 'showTetap'])->name('job.tetap');
    // Menyimpan joblist baru (dari form di halaman kelola joblist)
    Route::post('/karyawan/{karyawan}/job', [JobListController::class, 'store'])->name('job.store');
    // Menghapus item joblist
    Route::delete('/job/{joblist}', [JobListController::class, 'destroy'])->name('job.destroy');
    // Menampilkan form edit item joblist
    Route::get('/job/{joblist}/edit', [JobListController::class, 'edit'])->name('job.edit');
    // Mengupdate item joblist
    Route::patch('/job/{joblist}', [JobListController::class, 'update'])->name('job.update');

    // Menampilkan halaman form penilaian per shift
    Route::get('/karyawan/{karyawan}/penilaian/create/{shift}', [PenilaianController::class, 'create'])->name('penilaian.create');
    // Menyimpan data dari form penilaian
    Route::post('/karyawan/{karyawan}/penilaian', [PenilaianController::class, 'store'])->name('penilaian.store');
    // --- REPORT ROUTES (BARU) ---
    Route::get('/laporan', [ReportController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/export-pdf', [ReportController::class, 'exportPdf'])->name('laporan.exportPdf');


});

// --- ROUTE KHUSUS SUPERADMIN ---
Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::resource('kelola-admin', KelolaAdminController::class);
});


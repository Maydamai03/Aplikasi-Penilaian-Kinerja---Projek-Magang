<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\JobList; // <-- Tambahkan ini
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik yang masih relevan
        $totalKaryawanAktif = Karyawan::where('status_karyawan', 'Aktif')->count();

        // Statistik BARU yang relevan dengan sistem sekarang
        $totalJobTetap = JobList::where('tipe_job', 'Tetap')->count();
        $totalJobOpsional = JobList::where('tipe_job', 'Opsional')->count();

        // Menghitung total durasi kerja bulan ini dalam jam
        $totalMenitBulanIni = JobList::whereMonth('created_at', Carbon::now()->month)
                                     ->whereYear('created_at', Carbon::now()->year)
                                     ->sum('durasi_waktu');
        $totalJamBulanIni = round($totalMenitBulanIni / 60, 1);


        return view('admin.dashboard', [
            'totalKaryawanAktif' => $totalKaryawanAktif,
            'totalJobTetap' => $totalJobTetap,
            'totalJobOpsional' => $totalJobOpsional,
            'totalJamBulanIni' => $totalJamBulanIni,
        ]);
    }
}

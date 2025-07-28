<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Mendapatkan minggu dan tahun saat ini
        $mingguSekarang = Carbon::now()->weekOfYear;
        $tahunSekarang = Carbon::now()->year;

        // 1. Total Karyawan Aktif
        $totalKaryawanAktif = Karyawan::where('status_karyawan', 'Aktif')->count();

        // 2. Karyawan yang sudah punya joblist minggu ini
        $karyawanDenganJoblist = Karyawan::where('status_karyawan', 'Aktif')
            ->whereHas('jobLists', function ($query) use ($mingguSekarang, $tahunSekarang) {
                $query->where('minggu_ke', $mingguSekarang)->where('tahun', $tahunSekarang);
            })->count();

        // 3. Karyawan belum diberi joblist
        $belumDiberiJoblist = $totalKaryawanAktif - $karyawanDenganJoblist;

        // 4. Karyawan yang sudah dinilai minggu ini
        $sudahDinilai = Karyawan::where('status_karyawan', 'Aktif')
            ->whereHas('jobLists', function ($query) use ($mingguSekarang, $tahunSekarang) {
                $query->where('minggu_ke', $mingguSekarang)
                      ->where('tahun', $tahunSekarang)
                      ->whereHas('penilaian'); // Cek jika joblist punya relasi penilaian
            })->count();

        // 5. Karyawan belum dinilai
        $belumDinilai = $karyawanDenganJoblist - $sudahDinilai;

        return view('admin.dashboard', [
            'totalKaryawanAktif' => $totalKaryawanAktif,
            'belumDiberiJoblist' => $belumDiberiJoblist,
            'belumDinilai' => $belumDinilai,
            'sudahDinilai' => $sudahDinilai,
            'mingguSekarang' => $mingguSekarang,
            'tahunSekarang' => $tahunSekarang,
        ]);
    }
}

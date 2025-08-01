<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\JobList;
use App\Models\PenilaianKinerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PenilaianController extends Controller
{
    /**
     * Menampilkan form untuk melakukan penilaian kinerja per shift.
     */
    public function create(Karyawan $karyawan, $shift)
{
    $jobLists = JobList::where('karyawan_id', $karyawan->id)
                        ->where('shift', $shift)
                        ->get();

    return view('admin.penilaian.create', compact('karyawan', 'jobLists', 'shift'));
}

    /**
     * Menyimpan data penilaian kinerja.
     */
    public function store(Request $request, Karyawan $karyawan)
{
    $request->validate([
        'status.*' => 'required|in:Dikerjakan,Tidak Dikerjakan',
        'skala.*' => 'nullable|in:Baik,Sedang,Cukup',
        'shift' => 'required|in:Siang,Malam',
        // Validasi untuk job opsional dinamis (jika ada)
        'opsional_nama.*' => 'nullable|string|max:255',
        'opsional_durasi.*' => 'nullable|integer|min:1',
        'opsional_status.*' => 'nullable|in:Dikerjakan,Tidak Dikerjakan',
        'opsional_skala.*' => 'nullable|in:Baik,Sedang,Cukup',
    ]);

    $tanggalPenilaian = Carbon::now();
    $jamKerjaMenit = 8 * 60; // 480 menit

    // 1. Proses Penilaian Job Tetap
    if ($request->has('status')) {
        foreach ($request->status as $jobListId => $status) {
            // Hanya proses yang statusnya "Dikerjakan"
            if ($status === 'Tidak Dikerjakan') {
                continue; // Lewati pekerjaan ini
            }

            $job = JobList::find($jobListId);
            // Pastikan job ada dan skalanya diisi
            if (!$job || empty($request->skala[$jobListId])) {
                continue;
            }

            $skala = $request->skala[$jobListId];

            // --- RUMUS BARU YANG SUDAH DIPERBAIKI ---
            $bobot = ($job->durasi_waktu / $jamKerjaMenit) * 100;
            $nilai = 0; // Default nilai adalah 0

            switch ($skala) {
                case 'Cukup':
                    // Misal: Cukup = 50% dari bobot
                    $nilai = $bobot * 0.5;
                    break;
                case 'Sedang':
                    // Misal: Sedang = 75% dari bobot
                    $nilai = $bobot * 0.75;
                    break;
                case 'Baik':
                    // Misal: Baik = 100% dari bobot
                    $nilai = $bobot * 1;
                    break;
            }

            PenilaianKinerja::create([
                'job_list_id' => $jobListId,
                'penilai_id' => Auth::id(),
                'skala' => $skala,
                'nilai' => round($nilai, 2), // Bulatkan nilainya
                'catatan_penilai' => $request->catatan[$jobListId] ?? null,
                'tanggal_penilaian' => $tanggalPenilaian,
            ]);
        }
    }

    // ... (Logika untuk Job Opsional bisa disesuaikan dengan cara yang sama) ...

    return redirect()->route('job.tetap', $karyawan->id)
                     ->with('success', 'Penilaian kinerja berhasil disimpan.');
}
}

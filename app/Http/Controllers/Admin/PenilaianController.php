<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\JobList;
use App\Models\PenilaianKinerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class PenilaianController extends Controller
{
    /**
     * Menampilkan form untuk melakukan penilaian kinerja per shift.
     */
    public function create(Karyawan $karyawan, $shift)
    {
        // Ambil hanya job tetap untuk shift yang dipilih
        $jobLists = JobList::where('karyawan_id', $karyawan->id)
                            ->where('shift', $shift)
                            ->where('tipe_job', 'Tetap')
                            ->get();

        return view('admin.penilaian.create', compact('karyawan', 'jobLists', 'shift'));
    }

    /**
     * Menyimpan data penilaian kinerja.
     */
    // app/Http/Controllers/Admin/PenilaianController.php

public function store(Request $request, Karyawan $karyawan)
{
    $request->validate([
        'status.*' => 'required|in:Dikerjakan,Tidak Dikerjakan',
        // Validasi diubah ke teks baru
        'skala.*' => 'nullable|in:Tidak Dikerjakan,Melakukan Tapi Tidak Benar,Melakukan Dengan Benar',
        'shift' => 'required|in:Siang,Malam',
        // ... (validasi opsional jika ada)
    ]);

    $tanggalPenilaian = Carbon::now();
    $jamKerjaMenit = 8 * 60;

    if ($request->has('status')) {
        foreach ($request->status as $jobListId => $status) {
            if ($status === 'Tidak Dikerjakan') {
                continue;
            }
            $job = JobList::find($jobListId);
            if (!$job || empty($request->skala[$jobListId])) {
                continue;
            }

            $skala = $request->skala[$jobListId];
            $bobot = ($job->durasi_waktu / $jamKerjaMenit) * 100;
            $nilai = 0;

            // Switch case diubah ke teks baru
            switch ($skala) {
                case 'Tidak Dikerjakan':
                    $nilai = 0;
                    break;
                case 'Melakukan Tapi Tidak Benar':
                    $nilai = $bobot * 0.5; // 50% dari bobot
                    break;
                case 'Melakukan Dengan Benar':
                    $nilai = $bobot * 1; // 100% dari bobot
                    break;
            }

            PenilaianKinerja::create([
                'job_list_id' => $jobListId,
                'penilai_id' => Auth::id(),
                'skala' => $skala,
                'nilai' => round($nilai, 2),
                'catatan_penilai' => $request->catatan[$jobListId] ?? null,
                'tanggal_penilaian' => $tanggalPenilaian,
            ]);
        }
    }

    // ... (Logika untuk Job Opsional) ...

    return redirect()->route('job.tetap', $karyawan->id)
                     ->with('success', 'Penilaian kinerja berhasil disimpan.');
}
}

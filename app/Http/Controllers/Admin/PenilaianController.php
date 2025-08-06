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
        // [DIUBAH] Sesuaikan validasi dengan teks baru dari dropdown
        'skala.*' => ['nullable', Rule::in(['Tidak Dikerjakan', 'Melakukan Tapi Tidak Benar', 'Melakukan Dengan Benar'])],
        'shift' => 'required|in:Siang,Malam',
        'opsional_nama.*' => 'nullable|string|max:255',
        'opsional_durasi.*' => 'nullable|integer|min:1',
        'opsional_status.*' => 'nullable|in:Dikerjakan,Tidak Dikerjakan',
        'opsional_skala.*' => ['nullable', Rule::in(['Tidak Dikerjakan', 'Melakukan Tapi Tidak Benar', 'Melakukan Dengan Benar'])],
    ]);

    $tanggalPenilaian = Carbon::now();
    $jamKerjaMenit = 8 * 60;

    // 1. Proses Penilaian Job Tetap
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

            // [DIUBAH] Sesuaikan case dengan teks baru
            switch ($skala) {
                case 'Tidak Dikerjakan':
                    $nilai = 0; //Nilai jelek
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

    // 2. Proses Penambahan dan Penilaian Job Opsional
    if ($request->has('opsional_nama')) {
        foreach ($request->opsional_nama as $key => $nama) {
            if (empty($nama) || $request->opsional_status[$key] === 'Tidak Dikerjakan') {
                continue;
            }

            $jobOpsional = JobList::create([
                'karyawan_id' => $karyawan->id,
                'tipe_job' => 'Opsional',
                'shift' => $request->shift,
                'nama_pekerjaan' => $nama,
                'durasi_waktu' => $request->opsional_durasi[$key],
            ]);

            $skalaOpsional = $request->opsional_skala[$key];
            if (empty($skalaOpsional)) continue;

            $bobotOpsional = ($jobOpsional->durasi_waktu / $jamKerjaMenit) * 100;
            $nilaiOpsional = 0;

            // [DIUBAH] Sesuaikan case dengan teks baru
            switch ($skalaOpsional) {
                case 'Tidak Dikerjakan': $nilaiOpsional = 0; break;
                case 'Melakukan Tapi Tidak Benar': $nilaiOpsional = $bobotOpsional * 0.5; break;
                case 'Melakukan Dengan Benar': $nilaiOpsional = $bobotOpsional * 1; break;
            }

            PenilaianKinerja::create([
                'job_list_id' => $jobOpsional->id,
                'penilai_id' => Auth::id(),
                'skala' => $skalaOpsional,
                'nilai' => round($nilaiOpsional, 2),
                'catatan_penilai' => $request->opsional_catatan[$key] ?? null,
                'tanggal_penilaian' => $tanggalPenilaian,
            ]);
        }
    }

    return redirect()->route('job.tetap', $karyawan->id)
                     ->with('success', 'Penilaian kinerja berhasil disimpan.');
}
}

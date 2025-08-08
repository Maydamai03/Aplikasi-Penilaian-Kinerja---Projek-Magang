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
    public function store(Request $request, Karyawan $karyawan)
    {
        $request->validate([
            'tanggal_penilaian' => 'required|date',
            'status.*' => 'required|in:Dikerjakan,Tidak Dikerjakan',
            'skala.*' => ['nullable', Rule::in(['Tidak Dikerjakan', 'Melakukan Tapi Tidak Benar', 'Melakukan Dengan Benar'])],
            'shift' => 'required|in:Pagi,Siang',
            'opsional_nama.*' => 'nullable|string|max:255',
            'opsional_durasi.*' => 'nullable|integer|min:1',
            'opsional_status.*' => 'nullable|in:Dikerjakan,Tidak Dikerjakan',
            'opsional_skala.*' => ['nullable', Rule::in(['Tidak Dikerjakan', 'Melakukan Tapi Tidak Benar', 'Melakukan Dengan Benar'])],
        ]);

        $tanggalPenilaian = Carbon::parse($request->tanggal_penilaian);
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

                switch ($skala) {
                    case 'Tidak Dikerjakan':
                        $nilai = 0;
                        break;
                    case 'Melakukan Tapi Tidak Benar':
                        $nilai = $bobot * 0.5;
                        break;
                    case 'Melakukan Dengan Benar':
                        $nilai = $bobot * 1;
                        break;
                }

                PenilaianKinerja::create([
                    'job_list_id' => $jobListId,
                    'penilai_id' => Auth::id(),
                    'skala' => $skala,
                    'nilai' => round($nilai, 1),
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

                switch ($skalaOpsional) {
                    case 'Tidak Dikerjakan': $nilaiOpsional = 0; break;
                    case 'Melakukan Tapi Tidak Benar': $nilaiOpsional = $bobotOpsional * 0.5; break;
                    case 'Melakukan Dengan Benar': $nilaiOpsional = $bobotOpsional * 1; break;
                }

                PenilaianKinerja::create([
                    'job_list_id' => $jobOpsional->id,
                    'penilai_id' => Auth::id(),
                    'skala' => $skalaOpsional,
                    'nilai' => round($nilaiOpsional, 1),
                    'catatan_penilai' => $request->opsional_catatan[$key] ?? null,
                    'tanggal_penilaian' => $tanggalPenilaian,
                ]);
            }
        }

        return redirect()->route('job.tetap', $karyawan->id)
                         ->with('success', 'Penilaian kinerja berhasil disimpan.');
    }

    public function edit(PenilaianKinerja $penilaian_kinerja)
    {
        return view('admin.penilaian.edit', compact('penilaian_kinerja'));
    }

    /**
     * [BARU] Memperbarui satu entri penilaian di database.
     */
    public function update(Request $request, PenilaianKinerja $penilaian_kinerja)
    {
        $request->validate([
            'skala' => ['required', Rule::in(['Tidak Dikerjakan', 'Melakukan Tapi Tidak Benar', 'Melakukan Dengan Benar'])],
            'catatan_penilai' => 'nullable|string',
        ]);

        $job = $penilaian_kinerja->jobList;
        if (!$job) {
            return redirect()->back()->with('error', 'Job terkait tidak ditemukan.');
        }

        $skala = $request->skala;
        $jamKerjaMenit = 8 * 60;
        $bobot = ($job->durasi_waktu / $jamKerjaMenit) * 100;
        $nilai = 0;

        switch ($skala) {
            case 'Tidak Dikerjakan': $nilai = 0; break;
            case 'Melakukan Tapi Tidak Benar': $nilai = $bobot * 0.5; break;
            case 'Melakukan Dengan Benar': $nilai = $bobot * 1; break;
        }

        $penilaian_kinerja->update([
            'skala' => $skala,
            'nilai' => round($nilai, 1),
            'catatan_penilai' => $request->catatan_penilai,
        ]);

        // Buat URL untuk kembali ke halaman laporan dengan filter yang sama
        $queryParams = [
            'tab' => 'karyawan',
            'karyawan_id' => $job->karyawan_id,
            'start_date' => $penilaian_kinerja->tanggal_penilaian,
            'end_date' => $penilaian_kinerja->tanggal_penilaian,
        ];

        return redirect()->route('laporan.index', $queryParams)
                         ->with('success', 'Penilaian berhasil diperbarui.');
    }

    public function destroyByDate(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawan,id',
            'tanggal' => 'required|date_format:Y-m-d',
        ]);

        // Cari semua job list ID yang dinilai pada hari itu untuk karyawan tersebut
        $penilaianToDelete = PenilaianKinerja::whereHas('jobList', function ($query) use ($request) {
                $query->where('karyawan_id', $request->karyawan_id);
            })
            ->whereDate('tanggal_penilaian', $request->tanggal);

        // Ambil ID job list yang bertipe Opsional sebelum dihapus
        $jobListIdsOpsional = $penilaianToDelete->with('jobList')
            ->get()
            ->filter(fn($item) => $item->jobList && $item->jobList->tipe_job === 'Opsional')
            ->pluck('job_list_id');

        // Hapus semua data penilaian pada tanggal tersebut
        PenilaianKinerja::whereHas('jobList', function ($query) use ($request) {
                $query->where('karyawan_id', $request->karyawan_id);
            })
            ->whereDate('tanggal_penilaian', $request->tanggal)
            ->delete();

        // Hapus juga job opsional yang dibuat pada hari itu
        if ($jobListIdsOpsional->isNotEmpty()) {
            JobList::whereIn('id', $jobListIdsOpsional)->delete();
        }

        return redirect()->back()->with('success', 'Semua penilaian pada tanggal ' . Carbon::parse($request->tanggal)->format('d F Y') . ' berhasil dihapus.');
    }
}

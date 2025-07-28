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
     * Menampilkan form untuk melakukan penilaian kinerja.
     */
    public function create(Karyawan $karyawan)
{
    // Ambil SEMUA job milik karyawan, lalu kelompokkan berdasarkan tipenya
    $jobLists = JobList::where('karyawan_id', $karyawan->id)
                        ->get()
                        ->groupBy('tipe_job');

    return view('admin.penilaian.create', compact('karyawan', 'jobLists'));
}

    /**
     * Menyimpan data penilaian kinerja.
     */
    public function store(Request $request, Karyawan $karyawan)
    {
        $request->validate([
            'nilai.*' => 'required|integer|min:0|max:100', // Validasi setiap input nilai
            'catatan.*' => 'nullable|string',
        ]);

        $tanggalPenilaian = Carbon::now();

        // Loop melalui setiap nilai yang dikirim dari form
        foreach ($request->nilai as $jobListId => $nilai) {
            PenilaianKinerja::create([
                'job_list_id' => $jobListId,
                'penilai_id' => Auth::id(), // ID admin yang sedang login
                'nilai' => $nilai,
                'catatan_penilai' => $request->catatan[$jobListId] ?? null,
                'tanggal_penilaian' => $tanggalPenilaian,
            ]);
        }

        return redirect()->route('job.tetap', $karyawan->id)
                         ->with('success', 'Penilaian kinerja berhasil disimpan.');
    }
}

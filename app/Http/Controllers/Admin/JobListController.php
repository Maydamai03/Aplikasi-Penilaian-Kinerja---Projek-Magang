<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\JobList;
use Illuminate\Http\Request;

class JobListController extends Controller
{
    /**
     * Menampilkan halaman untuk mengelola joblist Shift Siang & Malam.
     */
    public function showTetap(Karyawan $karyawan)
{
    // [DIUBAH] Tambahkan filter untuk hanya mengambil Job Tetap
    $jobLists = $karyawan->jobLists()
                         ->where('tipe_job', 'Tetap')
                         ->get()
                         ->groupBy('shift');

    $jobSiang = $jobLists->get('Siang', collect());
    $jobMalam = $jobLists->get('Malam', collect());

    return view('admin.joblist.tetap', compact('karyawan', 'jobSiang', 'jobMalam'));
}

    /**
     * Menyimpan job baru (Siang atau Malam).
     */
    public function store(Request $request, Karyawan $karyawan)
    {
        $request->validate([
            'nama_pekerjaan' => 'required|string|max:255',
            'durasi_waktu' => 'required|integer|min:1',
            'shift' => 'required|in:Siang,Malam',
            'tipe_job' => 'required|in:Tetap,Opsional'
        ]);

        $karyawan->jobLists()->create($request->all());

        return redirect()->back()->with('success', 'Pekerjaan baru berhasil ditambahkan.');
    }

    public function edit(JobList $joblist)
    {
        $karyawan = $joblist->karyawan; // Mengambil data karyawan dari relasi
        return view('admin.joblist.edit', compact('joblist', 'karyawan'));
    }

    /**
     * [BARU] Memperbarui item pekerjaan di database.
     */
    public function update(Request $request, JobList $joblist)
    {
        $request->validate([
            'nama_pekerjaan' => 'required|string|max:255',
            'durasi_waktu' => 'required|integer|min:1',
        ]);

        $joblist->update($request->all());

        // Redirect kembali ke halaman kelola joblist utama
        return redirect()->route('job.tetap', $joblist->karyawan_id)
                         ->with('success', 'Pekerjaan berhasil diperbarui.');
    }

    /**
     * Menghapus satu item pekerjaan.
     */
    public function destroy(JobList $joblist)
    {
        $joblist->delete();
        return redirect()->back()->with('success', 'Pekerjaan berhasil dihapus.');
    }
}

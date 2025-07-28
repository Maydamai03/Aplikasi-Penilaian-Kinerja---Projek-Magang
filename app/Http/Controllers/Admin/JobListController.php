<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\JobList;
use Illuminate\Http\Request;

class JobListController extends Controller
{
    /**
     * Menampilkan halaman CRUD untuk Job Tetap.
     */
    public function showTetap(Karyawan $karyawan)
    {
        $jobLists = JobList::where('karyawan_id', $karyawan->id)
                            ->where('tipe_job', 'Tetap')
                            ->get();
        return view('admin.joblist.tetap', compact('karyawan', 'jobLists'));
    }

    /**
     * Menampilkan halaman CRUD untuk Job Opsional.
     */
    public function showOpsional(Karyawan $karyawan)
    {
        $jobLists = JobList::where('karyawan_id', $karyawan->id)
                            ->where('tipe_job', 'Opsional')
                            ->get();
        return view('admin.joblist.opsional', compact('karyawan', 'jobLists'));
    }

    /**
     * Menyimpan job baru (Tetap atau Opsional).
     */
    public function store(Request $request, Karyawan $karyawan)
    {
        $request->validate([
            'nama_pekerjaan' => 'required|string|max:255',
            'tipe_job' => 'required|in:Tetap,Opsional',
            'bobot' => 'required|integer|min:0',
            'durasi_waktu' => 'required|integer|min:1',
        ]);

        $karyawan->jobLists()->create($request->all());

        return redirect()->back()->with('success', 'Pekerjaan baru berhasil ditambahkan.');
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

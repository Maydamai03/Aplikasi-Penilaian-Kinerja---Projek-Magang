<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\JobList;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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

    $jobPagi = $jobLists->get('Pagi', collect());
    $jobSiang = $jobLists->get('Siang', collect());

    return view('admin.joblist.tetap', compact('karyawan', 'jobPagi', 'jobSiang'));
}

    /**
     * Menyimpan job baru (Siang atau Malam).
     */
    public function store(Request $request, Karyawan $karyawan)
    {
        $request->validate([
            'nama_pekerjaan' => 'required|string|max:255',
            'durasi_waktu' => 'required|integer|min:1',
            'shift' => 'required|in:Pagi,Siang',
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

    public function exportJoblistPdf(Karyawan $karyawan, $shift)
    {
        // Ambil data joblist sesuai karyawan dan shift yang diminta
        $jobLists = JobList::where('karyawan_id', $karyawan->id)
                            ->where('tipe_job', 'Tetap')
                            ->where('shift', $shift)
                            ->get();

        if ($jobLists->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada joblist untuk diekspor pada shift ini.');
        }

        // Buat PDF
        $pdf = Pdf::loadView('admin.joblist.pdf', [
            'jobLists' => $jobLists,
            'karyawan' => $karyawan,
            'shift' => $shift
        ]);

        // Download PDF
        return $pdf->download('joblist-' . $karyawan->nama_lengkap . '-shift-' . $shift . '.pdf');
    }
}

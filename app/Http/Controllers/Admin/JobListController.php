<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\JobList;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException; // Penting untuk melempar ValidationException

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
        // Validasi dasar input
        $request->validate([
            'nama_pekerjaan' => 'required|string|max:255',
            'tipe_job' => 'required|in:Tetap,Opsional',
            'bobot' => 'required|integer|min:0|max:100', // Validasi awal bobot per item
            'durasi_waktu' => 'required|integer|min:1',
        ]);

        $tipeJob = $request->input('tipe_job');
        $bobotBaru = (int) $request->input('bobot'); // Pastikan bobot adalah integer

        // Cek apakah request datang dari konfirmasi SweetAlert (user memilih salah satu opsi)
        if ($request->has('action_confirmed')) {
            $action = $request->input('action_confirmed');
            // 'except' digunakan untuk menghapus token dan flag konfirmasi dari data yang akan disimpan
            $jobData = $request->except(['_token', 'action_confirmed']);

            if ($action === 'auto_fill') {
                // Hitung total bobot yang ada sebelum penambahan job ini (saat konfirmasi)
                $totalBobotYangAdaSaatKonfirmasi = JobList::where('karyawan_id', $karyawan->id)
                    ->where('tipe_job', $tipeJob)
                    ->sum('bobot');
                // Hitung sisa bobot yang dibutuhkan untuk mencapai 100%
                $sisaBobot = 100 - $totalBobotYangAdaSaatKonfirmasi;
                // Bobot baru yang akan disimpan adalah sisa bobot tersebut (jika bobotBaru sudah memenuhi, ambil 100)
                // Ini memastikan total mencapai 100% dengan satu item saja jika memungkinkan
                $jobData['bobot'] = $sisaBobot;
                // Namun, jika bobotBaru yang diinput user sudah cukup, gunakan itu
                // Logika ini harus hati-hati agar tidak menggelembungkan bobot lebih dari 100
                // Solusi yang lebih tepat adalah user mengisi sisa bobot sebagai item terakhir.
                // Untuk 'auto_fill' agar menjadi 100%, maka item yang baru akan memiliki bobot = sisa untuk 100%
                $jobData['bobot'] = 100 - $totalBobotYangAdaSaatKonfirmasi; // Bobot item ini akan mengisi sisa agar total 100%
                // Penting: Pastikan bobot yang dihasilkan tidak negatif atau lebih dari 100 jika sudah ada banyak item
                if ($jobData['bobot'] < 0) $jobData['bobot'] = 0; // Jika sudah lebih dari 100%, mungkin jadi 0
                if ($jobData['bobot'] > 100) $jobData['bobot'] = 100; // Tidak boleh lebih dari 100
            }
            // Jika action === 'continue_anyway', jobData['bobot'] tetap menggunakan bobotBaru dari input user

            $karyawan->jobLists()->create($jobData);
            return response()->json([
                'success' => true,
                'message' => 'Pekerjaan berhasil ditambahkan.',
            ]);
        }

        // Ini adalah eksekusi pertama kali (tanpa flag action_confirmed)
        $totalBobotYangAda = JobList::where('karyawan_id', $karyawan->id)
            ->where('tipe_job', $tipeJob)
            ->sum('bobot');

        $totalBobotSetelahTambah = $totalBobotYangAda + $bobotBaru;

        if ($totalBobotSetelahTambah > 100) {
            // Jika total bobot melebihi 100%, lempar ValidationException
            throw ValidationException::withMessages([
                'bobot' => 'Total bobot untuk pekerjaan ' . $tipeJob . ' tidak boleh melebihi 100%. Total saat ini: ' . $totalBobotYangAda . '%. Bobot yang diinput: ' . $bobotBaru . '%. Sisa yang tersedia: ' . (100 - $totalBobotYangAda) . '%.',
            ]);
        } elseif ($totalBobotSetelahTambah < 100) {
            // Jika total bobot kurang dari 100%, kembalikan JSON response untuk pop-up konfirmasi di frontend
            return response()->json([
                'status' => 'rekomendasi',
                'message' => 'masih ' . $totalBobotSetelahTambah . '% dari 100%.',
                'sisa_bobot' => 100 - $totalBobotYangAda, // Sisa bobot untuk mencapai 100% sebelum item ini dimasukkan
                'karyawan_id' => $karyawan->id,
                'job_data' => $request->all(), // Kirim kembali data input awal
            ]);
        }

        // Jika total bobot tepat 100% pada percobaan pertama
        $karyawan->jobLists()->create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Pekerjaan baru berhasil ditambahkan dan total bobot 100%.',
        ]);
    }

    /**
     * Menampilkan form untuk mengedit item pekerjaan.
     */
    public function edit(JobList $joblist)
    {
        $karyawan = $joblist->karyawan;
        return view('admin.joblist.edit', compact('joblist', 'karyawan'));
    }

    /**
     * Memperbarui item pekerjaan di database.
     */
    public function update(Request $request, JobList $joblist)
    {
        $request->validate([
            'nama_pekerjaan' => 'required|string|max:255',
            'bobot' => 'required|integer|min:0|max:100',
            'durasi_waktu' => 'required|integer|min:1',
        ]);

        $bobotBaru = (int) $request->input('bobot');

        // Cek apakah request datang dari konfirmasi SweetAlert
        if ($request->has('action_confirmed')) {
            $action = $request->input('action_confirmed');
            $jobData = $request->except(['_token', '_method', 'action_confirmed']);

            if ($action === 'auto_fill') {
                $totalBobotTanpaJobIniSaatKonfirmasi = JobList::where('karyawan_id', $joblist->karyawan_id)
                    ->where('tipe_job', $joblist->tipe_job)
                    ->where('id', '!=', $joblist->id)
                    ->sum('bobot');
                $sisaBobot = 100 - $totalBobotTanpaJobIniSaatKonfirmasi;
                $jobData['bobot'] = $sisaBobot;
                if ($jobData['bobot'] < 0) $jobData['bobot'] = 0;
                if ($jobData['bobot'] > 100) $jobData['bobot'] = 100;
            }

            $joblist->update($jobData);
            return response()->json([
                'success' => true,
                'message' => 'Pekerjaan berhasil diperbarui.',
            ]);
        }

        $totalBobotTanpaJobIni = JobList::where('karyawan_id', $joblist->karyawan_id)
            ->where('tipe_job', $joblist->tipe_job)
            ->where('id', '!=', $joblist->id)
            ->sum('bobot');

        $totalBobotSetelahUpdate = $totalBobotTanpaJobIni + $bobotBaru;

        if ($totalBobotSetelahUpdate > 100) {
            throw ValidationException::withMessages([
                'bobot' => 'Total bobot untuk pekerjaan ' . $joblist->tipe_job . ' tidak boleh melebihi 100%. Total saat ini (tanpa pekerjaan ini): ' . $totalBobotTanpaJobIni . '%. Bobot yang diinput: ' . $bobotBaru . '%. Sisa yang tersedia: ' . (100 - $totalBobotTanpaJobIni) . '%.',
            ]);
        } elseif ($totalBobotSetelahUpdate < 100) {
            return response()->json([
                'status' => 'rekomendasi',
                'message' => 'masih ' . $totalBobotSetelahUpdate . '% dari 100%.',
                'sisa_bobot' => 100 - $totalBobotTanpaJobIni, // Sisa bobot untuk mencapai 100% tanpa job ini
                'joblist_id' => $joblist->id,
                'karyawan_id' => $joblist->karyawan_id,
                'job_data' => $request->all(),
            ]);
        }

        // Jika total bobot tepat 100% pada percobaan pertama
        $joblist->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Pekerjaan berhasil diperbarui dan total bobot 100%.',
        ]);
    }

    /**
     * Menghapus satu item pekerjaan.
     */
    public function destroy(JobList $joblist)
    {
        $joblist->delete();
        // Metode destroy ini tidak diubah untuk menggunakan AJAX dalam contoh ini.
        // Jika Anda ingin mengimplementasikan AJAX untuk delete juga, Anda perlu mengubah ini
        // untuk mengembalikan JSON response (misalnya, {'success': true}) dan menangani di JS.
        return redirect()->back()->with('success', 'Pekerjaan berhasil dihapus.');
    }
}

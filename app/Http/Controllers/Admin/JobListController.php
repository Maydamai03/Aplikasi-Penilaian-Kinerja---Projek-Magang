<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\JobList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JobListController extends Controller
{
    public function index(Karyawan $karyawan, Request $request)
    {
        $query = DB::table('job_lists')
            ->select('minggu_ke', 'tahun')
            ->where('karyawan_id', $karyawan->id)
            ->distinct()
            ->orderBy('tahun', 'asc')
            ->orderBy('minggu_ke', 'asc');

        $weeklyPeriods = $query->paginate(10);
        foreach ($weeklyPeriods as $period) {
            $period->tanggal_mulai = Carbon::now()->setISODate($period->tahun, $period->minggu_ke)->startOfWeek();
            $period->tanggal_selesai = Carbon::now()->setISODate($period->tahun, $period->minggu_ke)->endOfWeek();
            $isAssessed = DB::table('job_lists as jl')
                ->join('penilaian_kinerja as pk', 'jl.id', '=', 'pk.job_list_id')
                ->where('jl.karyawan_id', $karyawan->id)
                ->where('jl.minggu_ke', $period->minggu_ke)
                ->where('jl.tahun', $period->tahun)
                ->exists();
            $period->status_penilaian = $isAssessed ? 'Sudah dinilai' : 'Belum dinilai';
        }
        return view('admin.joblist.index', compact('karyawan', 'weeklyPeriods'));
    }

    /**
     * [DIUBAH] Menyimpan periode kerja berdasarkan tanggal yang dipilih dari modal.
     */
    public function store(Request $request, Karyawan $karyawan)
    {
        $request->validate(['tanggal' => 'required|date']);

        // Hitung minggu dan tahun dari tanggal yang diinput
        $tanggal = Carbon::parse($request->input('tanggal'));
        $minggu = $tanggal->weekOfYear;
        $tahun = $tanggal->year;

        $exists = JobList::where('karyawan_id', $karyawan->id)
            ->where('minggu_ke', $minggu)
            ->where('tahun', $tahun)
            ->exists();

        if ($exists) {
            return redirect()->route('joblist.index', $karyawan->id)->with('error', "Periode kerja untuk minggu tersebut sudah ada.");
        }

        JobList::create([
            'karyawan_id' => $karyawan->id,
            'nama_pekerjaan' => 'Default task for Week ' . $minggu,
            'deskripsi_pekerjaan' => 'Silakan edit joblist ini.',
            'bobot' => 0,
            'minggu_ke' => $minggu,
            'tahun' => $tahun,
        ]);

        return redirect()->route('joblist.index', $karyawan->id)->with('success', "Periode kerja untuk tanggal yang dipilih berhasil ditambahkan.");
    }

    public function show(Karyawan $karyawan, $week, $year)
    {
        return "Halaman untuk mengelola joblist karyawan {$karyawan->nama_lengkap} di Minggu ke-{$week}, Tahun {$year}.";
    }

    public function destroy(Karyawan $karyawan, $week, $year)
    {
        $jobLists = JobList::where('karyawan_id', $karyawan->id)
                           ->where('minggu_ke', $week)
                           ->where('tahun', $year);
        $jobLists->delete();
        return redirect()->route('joblist.index', $karyawan->id)->with('success', 'Periode kerja berhasil dihapus.');
    }
}

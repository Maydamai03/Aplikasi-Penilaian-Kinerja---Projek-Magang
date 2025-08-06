<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\PenilaianKinerja;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    /**
     * Menampilkan halaman laporan kinerja dengan filter.
     */
    public function index(Request $request)
    {
        // Data untuk filter
        $divisions = Divisi::orderBy('nama_divisi')->get();

        $employeesQuery = Karyawan::orderBy('nama_lengkap');
        if ($request->filled('divisi_id')) {
            $employeesQuery->where('divisi_id', $request->divisi_id);
        }
        $employees = $employeesQuery->get();

        // Variabel untuk menampung hasil
        $reportData = null;
        $selectedKaryawan = null;
        $selectedDivisi = null;
        $startDate = $request->start_date ? Carbon::parse($request->start_date) : null;
        $endDate = $request->end_date ? Carbon::parse($request->end_date) : null;

        // Tentukan tab yang aktif berdasarkan input form, defaultnya 'karyawan'
        $activeTab = $request->input('tab', 'karyawan');

        // Proses data jika form disubmit
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $request->validate([
                'end_date' => 'after_or_equal:start_date'
            ], [
                'end_date.after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai.'
            ]);

            // Logika untuk Tab "Per Karyawan"
            if ($activeTab == 'karyawan' && $request->filled('karyawan_id')) {
                $selectedKaryawan = Karyawan::findOrFail($request->karyawan_id);
                $reportData = $this->generateReportData($selectedKaryawan, $startDate, $endDate);
            }
            // Logika untuk Tab "Per Divisi"
            elseif ($activeTab == 'divisi' && $request->filled('divisi_id')) {
                $selectedDivisi = Divisi::findOrFail($request->divisi_id);
                $reportData = $this->generateDivisionReportData($selectedDivisi, $startDate, $endDate);
            }
        }

        return view('admin.laporan.index', compact(
            'divisions',
            'employees',
            'reportData',
            'selectedKaryawan',
            'selectedDivisi',
            'startDate',
            'endDate',
            'activeTab'
        ));
    }

    /**
     * Mengexport laporan kinerja ke dalam format PDF.
     */
    public function exportPdf(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawan,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $selectedKaryawan = Karyawan::findOrFail($request->karyawan_id);
        $reportData = $this->generateReportData($selectedKaryawan, $startDate, $endDate);

        if (!$reportData) {
            return redirect()->back()->with('error', 'Tidak ada data untuk diekspor ke PDF.');
        }

        $pdf = Pdf::loadView('admin.laporan.pdf', [
            'reportData' => $reportData,
            'karyawan' => $selectedKaryawan,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);

        return $pdf->download('laporan-kinerja-' . $selectedKaryawan->nama_lengkap . '-' . time() . '.pdf');
    }

    /**
     * Helper function untuk mengambil data laporan satu divisi penuh.
     */
    private function generateDivisionReportData(Divisi $divisi, Carbon $startDate, Carbon $endDate)
    {
        $karyawanInDivisi = Karyawan::where('divisi_id', $divisi->id)->get();
        $karyawanReports = [];

        foreach ($karyawanInDivisi as $karyawan) {
            $singleReport = $this->generateReportData($karyawan, $startDate, $endDate);
            if ($singleReport) {
                $karyawanReports[] = [
                    'karyawan' => $karyawan,
                    'data' => $singleReport,
                ];
            }
        }
        return $karyawanReports;
    }

    /**
     * Helper function untuk mengambil dan menghitung data laporan per karyawan.
     */
    private function generateReportData(Karyawan $karyawan, Carbon $startDate, Carbon $endDate)
    {
        $penilaian = PenilaianKinerja::with('jobList')
            ->whereHas('jobList', function ($query) use ($karyawan) {
                $query->where('karyawan_id', $karyawan->id);
            })
            // Filter ini untuk mengecualikan pekerjaan yang tidak dikerjakan
            ->where('skala', '!=', 'Tidak Dikerjakan')
            ->whereBetween('tanggal_penilaian', [$startDate, $endDate])
            ->get();

        if ($penilaian->isEmpty()) {
            return null;
        }

        $jamKerjaMenit = 8 * 60; // 480 menit

        // Hitung bobot untuk setiap item penilaian secara dinamis
        foreach ($penilaian as $item) {
            if ($item->jobList) {
                $item->jobList->bobot = ($item->jobList->durasi_waktu / $jamKerjaMenit) * 100;
            } else {
                $item->jobList = (object)['bobot' => 0, 'durasi_waktu' => 0, 'nama_pekerjaan' => 'Pekerjaan Dihapus', 'tipe_job' => 'N/A'];
            }
        }

        // Hitung total nilai yang berhasil dicapai (Skor Kinerja)
        $skorKinerja = round($penilaian->sum('nilai'), 2);

        // Hitung total bobot dari semua pekerjaan yang dinilai (Beban Kerja)
        $bebanKerja = round($penilaian->sum('jobList.bobot'), 2);

        $totalDurasiMenit = $penilaian->sum('jobList.durasi_waktu');
        $totalJamKerja = round($totalDurasiMenit / 60, 2);

        // Hitung selisih jam kerja
        $jumlahHariKerja = $startDate->diffInDays($endDate) + 1;
        $waktuKerjaIdealMenit = $jumlahHariKerja * $jamKerjaMenit;
        $selisihJam = round(($totalDurasiMenit - $waktuKerjaIdealMenit) / 60, 2);

        // Menghitung total job tetap dan opsional
        $totalJobTetap = $penilaian->where('jobList.tipe_job', 'Tetap')->count();
        $totalJobOpsional = $penilaian->where('jobList.tipe_job', 'Opsional')->count();

        $predikatKinerja = $this->getPredikatKinerja($skorKinerja);

        return [
            'penilaian' => $penilaian->groupBy(fn($item) => Carbon::parse($item->tanggal_penilaian)->format('Y-m-d')),
            'predikat_kinerja' => $predikatKinerja,
            'skor_kinerja' => $skorKinerja,
            'beban_kerja' => $bebanKerja,
            'total_durasi_jam' => $totalJamKerja,
            'selisih_jam_kerja' => $selisihJam,
            'total_job_tetap' => $totalJobTetap,
            'total_job_opsional' => $totalJobOpsional,
        ];
    }

    /**
     * Helper function untuk menentukan predikat kinerja.
     */
    private function getPredikatKinerja($skorKinerja)
    {
        if ($skorKinerja > 90) {
            return 'Handal Cermattzy';
        } elseif ($skorKinerja >= 80) {
            return 'Baik';
        } elseif ($skorKinerja >= 70) {
            return 'Cukup';
        } elseif ($skorKinerja >= 60) {
            return 'Kurang Memuaskan';
        } else {
            return 'SP 1 ';
        }
    }
}

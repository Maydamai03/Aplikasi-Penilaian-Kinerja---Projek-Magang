<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\PenilaianKinerja;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf; // Import facade PDF

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua karyawan untuk pilihan filter
        $employees = Karyawan::orderBy('nama_lengkap')->get();
        $reportData = null;
        $selectedKaryawan = null;
        $startDate = null;
        $endDate = null;

        // Jika ada request filter, proses data
        if ($request->filled('karyawan_id') && $request->filled('start_date') && $request->filled('end_date')) {
            $startDate = Carbon::parse($request->start_date);
            $endDate = Carbon::parse($request->end_date);
            $selectedKaryawan = Karyawan::findOrFail($request->karyawan_id);

            $reportData = $this->generateReportData($selectedKaryawan, $startDate, $endDate);
        }

        return view('admin.laporan.index', compact('employees', 'reportData', 'selectedKaryawan', 'startDate', 'endDate'));
    }

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

        // Buat PDF
        $pdf = Pdf::loadView('admin.laporan.pdf', [
            'reportData' => $reportData,
            'karyawan' => $selectedKaryawan,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);

        // Download PDF
        return $pdf->download('laporan-kinerja-'.$selectedKaryawan->nama_lengkap.'-'.time().'.pdf');
    }

    /**
     * Helper function untuk mengambil dan menghitung data laporan
     */
    private function generateReportData(Karyawan $karyawan, Carbon $startDate, Carbon $endDate)
    {
        // Ambil semua penilaian dalam rentang tanggal
        $penilaian = PenilaianKinerja::with('jobList')
            ->whereHas('jobList', function ($query) use ($karyawan) {
                $query->where('karyawan_id', $karyawan->id);
            })
            ->whereBetween('tanggal_penilaian', [$startDate, $endDate])
            ->get();

        if ($penilaian->isEmpty()) {
            return null;
        }

        // Hitung Skor Kinerja
        $totalBobot = $penilaian->sum('jobList.bobot');
        $totalNilaiBobot = $penilaian->sum(function ($item) {
            return $item->nilai * $item->jobList->bobot;
        });
        $skorKinerja = ($totalBobot > 0) ? round($totalNilaiBobot / $totalBobot, 2) : 0;

        // 1. Menghitung total durasi semua job yang dinilai (dalam menit)
        $totalDurasiMenit = $penilaian->sum('jobList.durasi_waktu');

        // 2. Menghitung jumlah hari kerja dalam periode (tidak termasuk Sabtu-Minggu)
        $jumlahHariKerja = $startDate->diffInWeekdays($endDate) + 1; // +1 agar tanggal akhir ikut terhitung

        // 3. Menghitung total waktu kerja ideal (8 jam/hari dikali 60 menit)
        $waktuKerjaIdealMenit = $jumlahHariKerja * 8 * 60;

        // 4. RUMUS BEBAN KERJA: (Total Durasi Aktual / Total Durasi Ideal) * 100%
        $bebanKerja = ($waktuKerjaIdealMenit > 0) ? round(($totalDurasiMenit / $waktuKerjaIdealMenit) * 100, 2) : 0;

        // Kelompokkan hasil penilaian berdasarkan tanggalnya
        $penilaianGroupedByDate = $penilaian->groupBy(function($item) {
            return Carbon::parse($item->tanggal_penilaian)->format('Y-m-d');
        });


        // --- [BARU] Menentukan Predikat Kinerja ---
        $predikatKinerja = '';
        if ($skorKinerja > 90) {
            $predikatKinerja = 'Handal Cermattzy';
        } elseif ($skorKinerja >= 80) {
            $predikatKinerja = 'Baik';
        } elseif ($skorKinerja >= 70) {
            $predikatKinerja = 'Cukup';
        } elseif ($skorKinerja >= 60) {
            $predikatKinerja = 'Kurang Memuaskan';
        } else {
            $predikatKinerja = 'KIRIM SP 1 WAKAKAKA';
        }

        return [
            'penilaian' => $penilaianGroupedByDate,
            'predikat_kinerja' => $predikatKinerja,
            'skor_kinerja' => $skorKinerja,
            'beban_kerja' => $bebanKerja,
            'total_durasi_jam' => round($totalDurasiMenit / 60, 2),
            'jumlah_hari_kerja' => $jumlahHariKerja,
        ];
    }
}

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Kinerja</title>
    <style>
        body { font-family: sans-serif; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; font-size: 12px; }
        .table th { background-color: #f2f2f2; text-align: left; }
        h1, h2, h3 { text-align: center; }
        .summary { margin-bottom: 20px; }
    </style>
</head>
<body>
    <h3>Laporan Kinerja Karyawan</h3>
    <hr>
    <p><strong>Nama:</strong> {{ $karyawan->nama_lengkap }}</p>
    <p><strong>Periode:</strong> {{ $startDate->format('d M Y') }} - {{ $endDate->format('d M Y') }}</p>

    <div class="summary">
        <p><strong>Skor Kinerja Rata-Rata:</strong> {{ $reportData['skor_kinerja'] }}</p>
        <p><strong>Beban Kerja:</strong> {{ $reportData['beban_kerja'] }}%</p>
    </div>

    <h4>Detail Penilaian</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Pekerjaan</th>
                <th>Nilai</th>
                <th>Bobot</th>
                <th>Durasi</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reportData['penilaian'] as $item)
                <tr>
                    <td>{{ $item->jobList->nama_pekerjaan }}</td>
                    <td>{{ $item->nilai }}</td>
                    <td>{{ $item->jobList->bobot }}%</td>
                    <td>{{ $item->jobList->durasi_waktu }} menit</td>
                    <td>{{ $item->catatan_penilai }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

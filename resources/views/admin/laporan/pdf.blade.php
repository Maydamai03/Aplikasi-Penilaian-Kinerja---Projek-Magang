<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Laporan Kinerja Karyawan</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 11px; /* Ukuran font disesuaikan agar lebih muat */
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h3 {
            margin: 0;
        }

        .info {
            margin-bottom: 20px;
            font-size: 12px;
        }

        .info p {
            margin: 4px 0;
        }

        .summary {
            border: 1px solid #eee;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-size: 12px;
        }

        .summary p {
            margin: 5px 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 6px; /* Padding diperkecil */
            text-align: left;
            vertical-align: top;
        }

        .table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .date-separator td {
            background-color: #e9ecef;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <h3>Laporan Kinerja Karyawan</h3>
    </div>
    <hr>
    <div class="info">
        <p><strong>Nama:</strong> {{ $karyawan->nama_lengkap }}</p>
        <p><strong>NIP:</strong> {{ $karyawan->nip }}</p>
        <p><strong>Jabatan:</strong> {{ $karyawan->jabatan->nama_jabatan ?? '-' }}</p>
        <p><strong>Divisi:</strong> {{ $karyawan->divisi->nama_divisi }}</p>
        <p><strong>Periode:</strong> {{ $startDate->format('d F Y') }} - {{ $endDate->format('d F Y') }}</p>
    </div>

    <div class="summary">
        <p><strong>Skor Kinerja Rata-Rata:</strong> {{ $reportData['skor_kinerja'] }}</p>
        <p><strong>Predikat Kinerja:</strong> {{ $reportData['predikat_kinerja'] }}</p>
        <p><strong>Beban Kerja:</strong> {{ $reportData['beban_kerja'] }}%</p>
        <hr style="border-style: dashed; border-width: 0.5px;">
        <p><strong>Total Jam Kerja Tercatat:</strong> {{ $reportData['total_durasi_jam'] }} Jam ({{ $reportData['total_durasi_jam'] * 60 }} menit)</p>
        <p><strong>Selisih Jam Kerja:</strong> {{ $reportData['selisih_jam_kerja'] }} Jam ({{ $reportData['selisih_jam_kerja'] * 60 }} menit)
            @if ($reportData['selisih_jam_kerja'] > 0)
                <span style="color: red;">(Kelebihan)</span>
            @elseif($reportData['selisih_jam_kerja'] < 0)
                <span style="color: orange;">(Kekurangan)</span>
            @else
                <span>(Sesuai)</span>
            @endif
        </p>
        <hr style="border-style: dashed; border-width: 0.5px;">
        <p><strong>Total Job Tetap Dikerjakan:</strong> {{ $reportData['total_job_tetap'] }}</p>
        <p><strong>Total Job Opsional Dikerjakan:</strong> {{ $reportData['total_job_opsional'] }}</p>
    </div>

    <h4>Detail Penilaian</h4>
    <table class="table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 25%;">Pekerjaan</th>
                <th>Tipe</th>
                <th>Shift</th>
                <th>Skala</th>
                <th>Bobot (%)</th>
                <th>Durasi</th>
                <th>Nilai</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @php $counter = 1; @endphp
            @foreach ($reportData['penilaian'] as $tanggal => $penilaianHarian)
                <tr class="date-separator">
                    <td colspan="9">
                        Penilaian Tanggal: {{ \Carbon\Carbon::parse($tanggal)->format('d F Y') }}
                    </td>
                </tr>
                @foreach ($penilaianHarian as $item)
                    <tr>
                        <td>{{ $counter++ }}</td>
                        <td>{{ $item->jobList->nama_pekerjaan ?? 'Pekerjaan Dihapus' }}</td>
                        <td>{{ $item->jobList->tipe_job ?? 'N/A' }}</td>
                        <td>{{ $item->jobList->shift ?? 'N/A' }}</td>
                        <td>{{ $item->skala }}</td>
                        <td>{{ number_format($item->jobList->bobot ?? 0, 1) }}%</td>
                        <td>{{ $item->jobList->durasi_waktu ?? 0 }} menit</td>
                        <td>{{ number_format($item->nilai, 1) }}</td>
                        <td>{{ $item->catatan_penilai }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>

</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Joblist Karyawan</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .info p { margin: 4px 0; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .table th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Daftar Pekerjaan (Joblist)</h2>
    </div>
    <div class="info">
        <p><strong>Nama Karyawan:</strong> {{ $karyawan->nama_lengkap }}</p>
        <p><strong>NIP:</strong> {{ $karyawan->nip }}</p>
        <p><strong>Shift:</strong> {{ $shift }}</p>
        <p><strong>Tanggal Cetak:</strong> {{ date('d F Y') }}</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th>Nama Pekerjaan</th>
                <th style="width: 20%;">Durasi (Menit)</th>
                <th style="width: 20%;">Bobot (%)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($jobLists as $job)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $job->nama_pekerjaan }}</td>
                    <td>{{ $job->durasi_waktu }}</td>
                    <td>{{ number_format(($job->durasi_waktu / 480) * 100, 1) }}%</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">Tidak ada pekerjaan untuk shift ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>

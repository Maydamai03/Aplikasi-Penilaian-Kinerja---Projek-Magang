<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Laporan Kinerja Karyawan</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 12px;
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
            font-size: 13px;
        }

        .info p {
            margin: 5px 0;
        }

        .summary {
            border: 1px solid #eee;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .summary p {
            margin: 6px 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
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
        <p><strong>Nama:</strong> <?php echo e($karyawan->nama_lengkap); ?></p>
        <p><strong>NIP:</strong> <?php echo e($karyawan->nip); ?></p>
        <p><strong>Divisi:</strong> <?php echo e($karyawan->divisi->nama_divisi); ?></p>
        <p><strong>Periode:</strong> <?php echo e($startDate->format('d F Y')); ?> - <?php echo e($endDate->format('d F Y')); ?></p>
    </div>

    <div class="summary">
        <p><strong>Skor Kinerja:</strong> <?php echo e($reportData['skor_kinerja']); ?></p>
        <p><strong>Predikat Kinerja:</strong> <?php echo e($reportData['predikat_kinerja']); ?></p>
        <p><strong>Beban Kerja:</strong> <?php echo e($reportData['beban_kerja']); ?>%</p>
        <hr style="border-style: dashed; border-width: 0.5px;">
        <p><strong>Total Jam Kerja Tercatat:</strong> <?php echo e($reportData['total_durasi_jam']); ?> Jam
            (<?php echo e($reportData['total_durasi_jam'] * 60); ?> menit)</p>
        <p><strong>Selisih Jam Kerja:</strong> <?php echo e($reportData['selisih_jam_kerja']); ?> Jam
            (<?php echo e($reportData['selisih_jam_kerja'] * 60); ?> menit)
            <?php if($reportData['selisih_jam_kerja'] > 0): ?>
                <span style="color: red;">(Kelebihan)</span>
            <?php elseif($reportData['selisih_jam_kerja'] < 0): ?>
                <span style="color: blue;">(Kekurangan)</span>
            <?php else: ?>
                <span>(Sesuai)</span>
            <?php endif; ?>
        </p>
    </div>

    <h4>Detail Penilaian</h4>
    <table class="table">
        <thead>
            <tr>
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
            <?php $__currentLoopData = $reportData['penilaian']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tanggal => $penilaianHarian): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="date-separator">
                <td colspan="8">
                    Penilaian Tanggal: <?php echo e(\Carbon\Carbon::parse($tanggal)->format('d F Y')); ?>

                </td>
            </tr>
            <?php $__currentLoopData = $penilaianHarian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($item->jobList->nama_pekerjaan ?? 'Pekerjaan Dihapus'); ?></td>
                <td><?php echo e($item->jobList->tipe_job ?? 'N/A'); ?></td>
                <td><?php echo e($item->jobList->shift ?? 'N/A'); ?></td>
                <td><?php echo e($item->skala); ?></td>
                
                <td><?php echo e(number_format($item->jobList->bobot ?? 0, 2)); ?>%</td>
                <td><?php echo e($item->jobList->durasi_waktu ?? 0); ?> menit</td>
                
                <td><?php echo e(number_format($item->nilai, 2)); ?></td>
                <td><?php echo e($item->catatan_penilai); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</body>

</html><?php /**PATH D:\Tugas Kuliah\Magang\Projek Karyawan\PenilaianKaryawan\resources\views/admin/laporan/pdf.blade.php ENDPATH**/ ?>
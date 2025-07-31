<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Kinerja</title>
    <style>
        body {
            font-family: sans-serif;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 12px;
        }

        .table th {
            background-color: #f2f2f2;
            text-align: left;
        }

        h1,
        h2,
        h3 {
            text-align: center;
        }

        .summary {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <h3>Laporan Kinerja Karyawan</h3>
    <hr>
    <p><strong>Nama:</strong> <?php echo e($karyawan->nama_lengkap); ?></p>
    <p><strong>Periode:</strong> <?php echo e($startDate->format('d M Y')); ?> - <?php echo e($endDate->format('d M Y')); ?></p>

    <div class="summary">
        <p><strong>Skor Kinerja Rata-Rata:</strong> <?php echo e($reportData['skor_kinerja']); ?></p>
        <p><strong>Beban Kerja:</strong> <?php echo e($reportData['beban_kerja']); ?>%</p>
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
            
            <?php $__currentLoopData = $reportData['penilaian']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tanggal => $penilaianHarian): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <tr>
                    <td colspan="5" style="background-color: #f2f2f2; font-weight: bold;">
                        Penilaian Tanggal: <?php echo e(\Carbon\Carbon::parse($tanggal)->format('d F Y')); ?>

                    </td>
                </tr>

                
                <?php $__currentLoopData = $penilaianHarian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($item->jobList->nama_pekerjaan); ?></td>
                        <td><?php echo e($item->nilai); ?></td>
                        <td><?php echo e($item->jobList->bobot); ?>%</td>
                        <td><?php echo e($item->jobList->durasi_waktu); ?> menit</td>
                        <td><?php echo e($item->catatan_penilai); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</body>

</html>
<?php /**PATH D:\xampp\jobdesk-karyawan\resources\views/admin/laporan/pdf.blade.php ENDPATH**/ ?>
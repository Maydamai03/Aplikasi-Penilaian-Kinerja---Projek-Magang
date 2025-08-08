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
        <p><strong>Nama Karyawan:</strong> <?php echo e($karyawan->nama_lengkap); ?></p>
        <p><strong>NIP:</strong> <?php echo e($karyawan->nip); ?></p>
        <p><strong>Shift:</strong> <?php echo e($shift); ?></p>
        <p><strong>Tanggal Cetak:</strong> <?php echo e(date('d F Y')); ?></p>
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
            <?php $__empty_1 = true; $__currentLoopData = $jobLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($job->nama_pekerjaan); ?></td>
                    <td><?php echo e($job->durasi_waktu); ?></td>
                    <td><?php echo e(number_format(($job->durasi_waktu / 480) * 100, 1)); ?>%</td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="4" style="text-align: center;">Tidak ada pekerjaan untuk shift ini.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
<?php /**PATH D:\xampp\jobdesk-karyawan\resources\views/admin/joblist/pdf.blade.php ENDPATH**/ ?>
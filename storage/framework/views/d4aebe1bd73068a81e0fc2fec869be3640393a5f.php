<?php $__env->startSection('content'); ?>
<style>
    .btn-back {
        background-color: var(--accent-color); color: var(--text-light); padding: 8px 15px;
        border-radius: 8px; font-weight: 500; text-decoration: none; display: inline-flex;
        align-items: center; gap: 8px; margin-bottom: 25px; transition: background-color 0.3s;
    }
    .btn-back:hover { background-color: #6d0000; }

    /* Kartu Utama */
    .appraisal-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        color: #1f2937 !important;
        padding: 30px;
        border-radius: 20px;
        border: 1px solid #e9ecef;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    }
    .appraisal-header {
        padding-bottom: 20px;
        margin-bottom: 25px;
        border-bottom: 1px solid #e9ecef;
    }
    .appraisal-header h3 {
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .appraisal-header p {
        margin: 10px 0 0 0;
        color: #4b5563;
        font-weight: 500;
    }

    /* Tabel Penilaian */
    .table {
        width: 100%;
        border-collapse: collapse;
    }
    .table th, .table td {
        padding: 16px 15px;
        vertical-align: middle;
        text-align: left;
        border-bottom: 1px solid #f3f4f6;
    }
    .table thead th {
        background-color: #f9fafb;
        font-weight: 700;
        color: #374151;
        font-size: 0.9rem;
        text-transform: uppercase;
    }

    /* Input di dalam tabel */
    .form-control-table {
        width: 100%;
        height: 42px;
        padding: 8px 12px;
        border-radius: 8px;
        border: 1px solid #ddd;
        background-color: #fff;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .form-control-table:focus {
        border-color: #ffd700;
        box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.2);
        outline: none;
    }
    .form-control-table.text-center {
        text-align: center;
    }

    /* Pembatas Tipe Job */
    .job-type-separator td {
        background-color: #e9ecef;
        font-weight: 700;
        color: #495057;
        padding: 12px 15px;
    }

    /* Tombol Simpan */
    .btn-save-appraisal {
        background: linear-gradient(135deg, #22c55e, #16a34a);
        color: white;
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 700;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3);
    }
    .btn-save-appraisal:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(34, 197, 94, 0.4);
    }
</style>

<a href="<?php echo e(url()->previous()); ?>" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>
<form action="<?php echo e(route('penilaian.store', $karyawan->id)); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <div class="appraisal-card mt-3">
        <div class="appraisal-header">
            <h3><i class="fas fa-clipboard-check"></i> Form Penilaian Kinerja</h3>
            <p>
                <strong>Karyawan:</strong> <?php echo e($karyawan->nama_lengkap); ?><br>
                <strong>Tanggal Penilaian:</strong> <?php echo e(\Carbon\Carbon::now()->format('d F Y')); ?>

            </p>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 40%;">Pekerjaan</th>
                        <th class="text-center">Bobot</th>
                        <th class="text-center">Durasi (Menit)</th>
                        <th class="text-center" style="width: 15%;">Nilai (1-100)</th>
                        <th style="width: 25%;">Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php if(isset($jobLists['Tetap']) && $jobLists['Tetap']->isNotEmpty()): ?>
                        <tr class="job-type-separator">
                            <td colspan="5">Job Tetap</td>
                        </tr>
                        <?php $__currentLoopData = $jobLists['Tetap']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($job->nama_pekerjaan); ?></td>
                            <td class="text-center"><?php echo e($job->bobot); ?>%</td>
                            <td class="text-center"><?php echo e($job->durasi_waktu); ?></td>
                            <td>
                                <input type="number" name="nilai[<?php echo e($job->id); ?>]" class="form-control-table text-center" min="0" max="100" required>
                            </td>
                            <td>
                                <input type="text" name="catatan[<?php echo e($job->id); ?>]" class="form-control-table">
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                    
                    <?php if(isset($jobLists['Opsional']) && $jobLists['Opsional']->isNotEmpty()): ?>
                        <tr class="job-type-separator">
                            <td colspan="5">Job Opsional</td>
                        </tr>
                        <?php $__currentLoopData = $jobLists['Opsional']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($job->nama_pekerjaan); ?></td>
                            <td class="text-center"><?php echo e($job->bobot); ?>%</td>
                            <td class="text-center"><?php echo e($job->durasi_waktu); ?></td>
                            <td>
                                <input type="number" name="nilai[<?php echo e($job->id); ?>]" class="form-control-table text-center" min="0" max="100" required>
                            </td>
                            <td>
                                <input type="text" name="catatan[<?php echo e($job->id); ?>]" class="form-control-table">
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                    
                    <?php if($jobLists->isEmpty()): ?>
                        <tr><td colspan="5" class="text-center p-5">Belum ada pekerjaan yang bisa dinilai.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($jobLists->isNotEmpty()): ?>
            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn-save-appraisal">
                    <i class="fas fa-save"></i> Simpan Penilaian
                </button>
            </div>
        <?php endif; ?>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\jobdesk-karyawan\resources\views/admin/penilaian/create.blade.php ENDPATH**/ ?>


<?php $__env->startSection('content'); ?>
<style>
    .appraisal-card {
        background-color: #ffffff;
        color: #1f2937;
        padding: 25px 30px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        margin-top: 20px;
    }

    .appraisal-header h3 {
        margin-bottom: 5px;
        font-size: 1.5rem;
        font-weight: 600;
    }

    .appraisal-header p {
        margin-bottom: 20px;
        font-size: 0.95rem;
        color: #555;
    }

    .table thead th {
        background-color: #f1f5f9;
        text-align: center;
        vertical-align: middle;
    }

    .table td {
        vertical-align: middle;
    }

    .form-control-table,
    .form-select {
        width: 100%;
        padding: 6px 10px;
        font-size: 0.9rem;
        border-radius: 6px;
        border: 1px solid #ccc;
    }

    .form-control-table:disabled,
    .form-select:disabled {
        background-color: #f3f4f6;
        color: #9ca3af;
        cursor: not-allowed;
        opacity: 0.7;
    }

    .btn-back {
        display: inline-block;
        margin-bottom: 10px;
        background: none;
        color: #2563eb;
        text-decoration: none;
        font-weight: 500;
    }

    .btn-save-appraisal {
        background-color: #10b981;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        font-size: 0.95rem;
        transition: background-color 0.2s;
    }

    .btn-save-appraisal:hover {
        background-color: #059669;
    }
</style>

<a href="<?php echo e(url()->previous()); ?>" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>

<form action="<?php echo e(route('penilaian.store', $karyawan->id)); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="shift" value="<?php echo e($shift); ?>">
    <div class="appraisal-card">
        <div class="appraisal-header">
            <h3>Form Penilaian Kinerja (Shift <?php echo e($shift); ?>)</h3>
            <p>
                Karyawan: <strong><?php echo e($karyawan->nama_lengkap); ?></strong> |
                Tanggal: <strong><?php echo e(\Carbon\Carbon::now()->format('d F Y')); ?></strong>
            </p>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th style="width: 30%;">Pekerjaan</th>
                        <th style="width: 20%;">Status</th>
                        <th style="width: 25%;">Skala Penilaian</th>
                        <th style="width: 25%;">Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $jobLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($job->nama_pekerjaan); ?></td>
                        <td>
                            <select name="status[<?php echo e($job->id); ?>]" class="form-select form-control-table status-dropdown" required>
                                <option value="Dikerjakan">Dikerjakan</option>
                                <option value="Tidak Dikerjakan">Tidak Dikerjakan</option>
                            </select>
                        </td>
                        <td>
                            <select name="skala[<?php echo e($job->id); ?>]" class="form-select form-control-table skala-dropdown">
                                <option value="">-- Pilih Skala --</option>
                                <option value="Tidak Dikerjakan">Tidak Dikerjakan</option>
                                <option value="Melakukan Tapi Tidak Benar">Melakukan Tapi Tidak Benar</option>
                                <option value="Melakukan Dengan Benar">Melakukan Dengan Benar</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" name="catatan[<?php echo e($job->id); ?>]" class="form-control-table catatan-input" placeholder="Isi jika perlu">
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">
                            Belum ada pekerjaan yang bisa dinilai untuk shift ini.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($jobLists->isNotEmpty()): ?>
        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn-save-appraisal"><i class="fas fa-save"></i> Simpan Penilaian</button>
        </div>
        <?php endif; ?>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function handleStatusChange(statusDropdown) {
            const row = statusDropdown.closest('tr');
            const skalaDropdown = row.querySelector('.skala-dropdown');
            const catatanInput = row.querySelector('.catatan-input');

            if (statusDropdown.value === 'Tidak Dikerjakan') {
                skalaDropdown.disabled = true;
                skalaDropdown.required = false;
                skalaDropdown.value = '';

                catatanInput.disabled = true;
                catatanInput.value = '';
                catatanInput.placeholder = 'Tidak dapat diisi';
            } else {
                skalaDropdown.disabled = false;
                skalaDropdown.required = true;

                catatanInput.disabled = false;
                catatanInput.placeholder = 'Isi jika perlu';
            }
        }

        document.querySelectorAll('.status-dropdown').forEach(dropdown => {
            handleStatusChange(dropdown);
            dropdown.addEventListener('change', () => handleStatusChange(dropdown));
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Tugas Kuliah\Magang\Projek Karyawan\PenilaianKaryawan\resources\views/admin/penilaian/create.blade.php ENDPATH**/ ?>
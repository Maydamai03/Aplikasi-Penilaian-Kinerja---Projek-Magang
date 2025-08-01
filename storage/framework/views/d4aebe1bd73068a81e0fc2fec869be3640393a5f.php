<?php $__env->startSection('content'); ?>
<style>
    /* ... (CSS dari sebelumnya bisa digunakan, tidak perlu diubah) ... */
    .appraisal-card { background-color: white; color: #1f2937; padding: 30px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
    .table thead th { background-color: #f9fafb; }
</style>

<a href="<?php echo e(url()->previous()); ?>" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>

<form action="<?php echo e(route('penilaian.store', $karyawan->id)); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="shift" value="<?php echo e($shift); ?>">
    <div class="appraisal-card mt-3">
        
        <div class="appraisal-header">
             <h3>Form Penilaian Kinerja (Shift <?php echo e($shift); ?>)</h3>
             <p>Karyawan: <strong><?php echo e($karyawan->nama_lengkap); ?></strong> | Tanggal: <strong><?php echo e(\Carbon\Carbon::now()->format('d F Y')); ?></strong></p>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 30%;">Pekerjaan</th>
                        <th class="text-center" style="width: 20%;">Status</th>
                        <th class="text-center" style="width: 20%;">Skala Penilaian</th>
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
                                <option value="Baik">Baik</option>
                                <option value="Sedang">Sedang</option>
                                <option value="Cukup">Cukup</option>
                            </select>
                        </td>
                        <td><input type="text" name="catatan[<?php echo e($job->id); ?>]" class="form-control-table"></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="4" class="text-center p-5">Belum ada pekerjaan yang bisa dinilai untuk shift ini.</td></tr>
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
document.addEventListener('DOMContentLoaded', function () {
    // Fungsi untuk mengatur dropdown Skala berdasarkan Status
    function handleStatusChange(statusDropdown) {
        const row = statusDropdown.closest('tr');
        const skalaDropdown = row.querySelector('.skala-dropdown');

        if (statusDropdown.value === 'Tidak Dikerjakan') {
            skalaDropdown.disabled = true; // Matikan dropdown skala
            skalaDropdown.required = false; // Hapus validasi required
            skalaDropdown.value = ''; // Kosongkan nilainya
        } else {
            skalaDropdown.disabled = false; // Aktifkan kembali
            skalaDropdown.required = true; // Jadikan wajib diisi
        }
    }

    // Terapkan fungsi ke semua dropdown status yang ada
    const allStatusDropdowns = document.querySelectorAll('.status-dropdown');
    allStatusDropdowns.forEach(dropdown => {
        handleStatusChange(dropdown); // Panggil saat halaman dimuat
        dropdown.addEventListener('change', () => handleStatusChange(dropdown)); // Panggil saat nilainya berubah
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\jobdesk-karyawan\resources\views/admin/penilaian/create.blade.php ENDPATH**/ ?>
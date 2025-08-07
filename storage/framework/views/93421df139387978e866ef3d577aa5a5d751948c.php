

<?php $__env->startSection('content'); ?>
    <style>
        /* Anda bisa menyalin style dari form create.blade.php di sini */
        .edit-card {
            background-color: #ffffff;
            color: #1f2937;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            margin-top: 20px;
        }
        .form-control-table, .form-select {
            width: 100%;
            padding: 6px 10px;
            font-size: 0.9rem;
            border-radius: 6px;
            border: 1px solid #ccc;
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

    <div class="edit-card">
        <h3>Edit Penilaian Kinerja</h3>
        <p>Pekerjaan: <strong><?php echo e($penilaian_kinerja->jobList->nama_pekerjaan ?? 'Pekerjaan Dihapus'); ?></strong></p>
        <p>Tanggal: <strong><?php echo e(\Carbon\Carbon::parse($penilaian_kinerja->tanggal_penilaian)->format('d F Y')); ?></strong></p>

        <form action="<?php echo e(route('penilaian.update', $penilaian_kinerja->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-3">
                <label for="skala" class="form-label">Skala Penilaian</label>
                <select name="skala" id="skala" class="form-select" required>
                    <option value="Melakukan Dengan Benar" <?php echo e($penilaian_kinerja->skala == 'Melakukan Dengan Benar' ? 'selected' : ''); ?>>Melakukan Dengan Benar</option>
                    <option value="Melakukan Tapi Tidak Benar" <?php echo e($penilaian_kinerja->skala == 'Melakukan Tapi Tidak Benar' ? 'selected' : ''); ?>>Melakukan Tapi Tidak Benar</option>
                    <option value="Tidak Dikerjakan" <?php echo e($penilaian_kinerja->skala == 'Tidak Dikerjakan' ? 'selected' : ''); ?>>Tidak Dikerjakan</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="catatan" class="form-label">Catatan</label>
                <textarea name="catatan" id="catatan" class="form-control-table" rows="3"><?php echo e($penilaian_kinerja->catatan_penilai); ?></textarea>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn-save-appraisal"><i class="fas fa-save"></i> Simpan Perubahan</button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Tugas Kuliah\Magang\Projek Karyawan\PenilaianKaryawan\resources\views/admin/penilaian/edit.blade.php ENDPATH**/ ?>
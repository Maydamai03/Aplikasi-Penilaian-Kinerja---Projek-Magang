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

        .appraisal-card {
            background-color: white;
            color: #1f2937;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .table thead th {
            background-color: #f9fafb;
        }

        .form-control-table:disabled {
            background-color: #f3f4f6;
            cursor: not-allowed;
        }

        .btn-add-opsional {
            background-color: #3B82F6;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            font-weight: 600;
        }

        .btn-delete-opsional {
            background-color: #EF4444;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 6px;
        }
    </style>

    <a href="<?php echo e(url()->previous()); ?>" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>

    <form action="<?php echo e(route('penilaian.store', $karyawan->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="shift" value="<?php echo e($shift); ?>">
        <div class="appraisal-card mt-3">
            <div class="appraisal-header">
                <h3>Form Penilaian Kinerja (Shift <?php echo e($shift); ?>)</h3>
                <p>Karyawan: <strong><?php echo e($karyawan->nama_lengkap); ?></strong> | Tanggal:
                    <strong><?php echo e(\Carbon\Carbon::now()->format('d F Y')); ?></strong>
                </p>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th style="width: 35%;">Pekerjaan</th>
                            <th class="text-center" style="width: 20%;">Status</th>
                            <th class="text-center" style="width: 20%;">Skala Penilaian</th>
                            <th style="width: 25%;">Catatan</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr class="job-type-header">
                            <td colspan="5">Job Tetap</td>
                        </tr>

                        <?php $__empty_1 = true; $__currentLoopData = $jobLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($job->nama_pekerjaan); ?></td>
                                <td>
                                    <select name="status[<?php echo e($job->id); ?>]"
                                        class="form-select form-control-table status-dropdown" required>
                                        <option value="Dikerjakan">Dikerjakan</option>
                                        <option value="Tidak Dikerjakan">Tidak Dikerjakan</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="skala[<?php echo e($job->id); ?>]"
                                        class="form-select form-control-table skala-dropdown" required>
                                        <option value="">-- Pilih Skala --</option>
                                        <option value="Melakukan Dengan Benar">Melakukan Dengan Benar</option>
                                        <option value="Melakukan Tapi Tidak Benar">Melakukan Tapi Tidak Benar</option>
                                        <option value="Tidak Dikerjakan">Tidak Dikerjakan</option>
                                    </select>
                                </td>
                                <td><input type="text" name="catatan[<?php echo e($job->id); ?>]"
                                        class="form-control-table catatan-input" placeholder="Isi jika perlu"></td>
                                <td></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada Job Tetap untuk dinilai.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                    
                    <tbody id="opsional-jobs-container">
                        <tr class="job-type-header">
                            <td colspan="5">Job Opsional</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <button type="button" id="add-opsional-btn" class="btn-add-opsional mt-3"><i class="fas fa-plus"></i> Tambah
                Job Opsional</button>
            <hr class="my-4">
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn-save-appraisal"><i class="fas fa-save"></i> Simpan Penilaian</button>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk mengatur dropdown Skala berdasarkan Status
            function handleStatusChange(statusDropdown) {
                const row = statusDropdown.closest('tr');
                const skalaDropdown = row.querySelector('.skala-dropdown');
                const catatanInput = row.querySelector('.catatan-input');

                if (statusDropdown.value === 'Tidak Dikerjakan') {
                    skalaDropdown.disabled = true;
                    skalaDropdown.required = false;
                    skalaDropdown.value = '';
                    if (catatanInput) catatanInput.disabled = true;
                } else {
                    skalaDropdown.disabled = false;
                    skalaDropdown.required = true;
                    if (catatanInput) catatanInput.disabled = false;
                }
            }

            // Terapkan fungsi ke semua dropdown status yang ada saat ini
            document.querySelectorAll('.status-dropdown').forEach(dropdown => {
                handleStatusChange(dropdown);
                dropdown.addEventListener('change', () => handleStatusChange(dropdown));
            });

            // Fungsi untuk menambah baris form job opsional
            document.getElementById('add-opsional-btn').addEventListener('click', function() {
                const container = document.getElementById('opsional-jobs-container');
                const newRow = document.createElement('tr');
                const uniqueId = 'opsional_' + Date.now();
                newRow.id = uniqueId;
                newRow.innerHTML = `
            <td>
                <input type="text" name="opsional_nama[]" class="form-control-table" placeholder="Nama Job Opsional" required>
                <div class="mt-2">
                    <label class="form-label-sm">Durasi (menit):</label>
                    <input type="number" name="opsional_durasi[]" class="form-control-table d-inline-block" style="width: 100px;" required>
                </div>
            </td>
            <td>
                <select name="opsional_status[]" class="form-select form-control-table status-dropdown" required>
                    <option value="Dikerjakan">Dikerjakan</option>
                    <option value="Tidak Dikerjakan">Tidak Dikerjakan</option>
                </select>
            </td>
            <td>
        <select name="opsional_skala[]" class="form-select form-control-table skala-dropdown" required>
            <option value="">-- Pilih Skala --</option>
            <option value="Melakukan Dengan Benar">Melakukan Dengan Benar</option>
            <option value="Melakukan Tapi Tidak Benar">Melakukan Tapi Tidak Benar</option>
            <option value="Tidak Dikerjakan">Tidak Dikerjakan</option>
        </select>
    </td>
            <td><input type="text" name="opsional_catatan[]" class="form-control-table catatan-input"></td>
            <td>
                <button type="button" class="btn-delete-opsional" onclick="document.getElementById('${uniqueId}').remove()">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        `;
                container.appendChild(newRow);

                // Terapkan kembali event listener ke dropdown status yang baru ditambahkan
                newRow.querySelector('.status-dropdown').addEventListener('change', function() {
                    handleStatusChange(this);
                });
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\jobdesk-karyawan\resources\views/admin/penilaian/create.blade.php ENDPATH**/ ?>
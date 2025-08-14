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
            vertical-align: top;
            padding: 12px 8px;
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
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            background-color: var(--gray-100);
            color: var(--gray-700);
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.2s ease;
            border: 1px solid var(--gray-300);
            margin-bottom: 25px;
        }

        .btn-back:hover {
            background-color: var(--gray-200);
            color: var(--gray-800);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
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

        .btn-add-opsional {
            background-color: #3B82F6;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            font-weight: 600;
            transition: background-color 0.2s;
        }

        .btn-add-opsional:hover {
            background-color: #2563eb;
        }

        .btn-delete-opsional {
            background-color: #EF4444;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
            transition: background-color 0.2s;
            cursor: pointer;
        }

        .btn-delete-opsional:hover {
            background-color: #dc2626;
        }

        .job-type-header td {
            background-color: #f8fafc;
            font-weight: 600;
            color: #374151;
            padding: 12px 15px;
            border-top: 2px solid #e5e7eb;
        }

        .opsional-job-row {
            background-color: #fefefe;
        }

        .opsional-job-row:hover {
            background-color: #f9fafb;
        }

        .mb-2 {
            margin-bottom: 8px;
        }

        .job-duration-section {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 8px;
        }

        .opsional-field-wrapper {
            padding-top: 4px;
        }

        .opsional-field-wrapper .form-control-table,
        .opsional-field-wrapper .form-select {
            margin-top: 0;
        }

        .duration-label {
            font-size: 0.8rem;
            color: #6b7280;
            white-space: nowrap;
            min-width: 70px;
        }

        .duration-input {
            width: 80px !important;
            padding: 4px 8px;
            font-size: 0.85rem;
        }

        .action-cell {
            text-align: center;
            width: 60px;
        }

        .empty-state {
            text-align: center;
            color: #9ca3af;
            font-style: italic;
            padding: 20px;
        }

        .form-control-small {
            font-size: 0.85rem;
            padding: 4px 8px;
        }

        /* ============ RESPONSIVE STYLES ============ */

        /* Tablet styles */
        @media (max-width: 992px) {
            .appraisal-card {
                padding: 20px 15px;
            }

            .table td {
                padding: 8px 4px;
                font-size: 0.85rem;
            }

            .table th {
                padding: 8px 4px;
                font-size: 0.8rem;
            }

            .form-control-table,
            .form-select {
                font-size: 0.8rem;
                padding: 4px 6px;
            }
        }

        /* Mobile styles */
        @media (max-width: 768px) {
            .appraisal-card {
                margin-top: 10px;
                padding: 15px;
            }

            .appraisal-header h3 {
                font-size: 1.2rem;
            }

            .btn-back {
                padding: 8px 12px;
                font-size: 0.9rem;
                margin-bottom: 15px;
            }

            /* Responsive table - horizontal scroll */
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .table {
                min-width: 700px;
                font-size: 0.75rem;
            }

            .table th,
            .table td {
                padding: 6px 4px;
                white-space: nowrap;
            }

            .form-control-table,
            .form-select {
                font-size: 0.75rem;
                padding: 3px 5px;
                min-width: 80px;
            }

            .duration-input {
                width: 60px !important;
                font-size: 0.7rem;
            }

            .btn-add-opsional,
            .btn-save-appraisal {
                width: 100%;
                padding: 12px;
                margin-bottom: 10px;
                font-size: 0.9rem;
            }

            .btn-delete-opsional {
                padding: 4px 6px;
                font-size: 0.7rem;
            }

            .job-duration-section {
                flex-direction: column;
                gap: 4px;
                align-items: flex-start;
            }

            .duration-label {
                font-size: 0.7rem;
                min-width: auto;
            }
        }

        /* Extra small mobile */
        @media (max-width: 480px) {
            .appraisal-card {
                padding: 10px;
            }

            .btn-back {
                padding: 6px 8px;
                font-size: 0.8rem;
            }

            .table {
                font-size: 0.7rem;
                min-width: 600px;
            }

            .form-control-table,
            .form-select {
                font-size: 0.7rem;
                padding: 2px 4px;
                min-width: 70px;
            }
        }

        /* Improve mobile scrolling experience */
        @media (max-width: 768px) {
            .table-responsive {
                border: 1px solid #dee2e6;
                border-radius: 0.375rem;
            }

            .table-responsive::after {
                content: "← Geser untuk melihat selengkapnya →";
                display: block;
                text-align: center;
                padding: 8px;
                background-color: #f8f9fa;
                color: #6c757d;
                font-size: 0.75rem;
                border-top: 1px solid #dee2e6;
            }
        }
    </style>

    <a href="<?php echo e(url()->previous()); ?>" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>

    <form action="<?php echo e(route('penilaian.store', $karyawan->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="shift" value="<?php echo e($shift); ?>">
        <div class="appraisal-card mt-3">
            <div class="appraisal-header">
                <h3>Form Penilaian Kinerja (Shift <?php echo e($shift); ?>)</h3>
                <p>Karyawan: <strong><?php echo e($karyawan->nama_lengkap); ?></strong></p>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="tanggal_penilaian" class="form-label fw-bold">Pilih Tanggal Penilaian</label>
                        <input type="date" id="tanggal_penilaian" name="tanggal_penilaian" class="form-control"
                            value="<?php echo e(date('Y-m-d')); ?>" required>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th style="width: 5%;">No.</th>
                            <th style="width: 30%;">Pekerjaan</th>
                            <th class="text-center" style="width: 18%;">Status</th>
                            <th class="text-center" style="width: 20%;">Skala Penilaian</th>
                            <th style="width: 22%;">Catatan</th>
                            <th class="text-center" style="width: 5%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="job-type-header">
                            <td colspan="6">Job Tetap</td>
                        </tr>

                        <?php $__empty_1 = true; $__currentLoopData = $jobLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($job->nama_pekerjaan); ?></td>
                                <td>
                                    <select name="status[<?php echo e($job->id); ?>]" class="form-select form-control-table status-dropdown"
                                        required>
                                        <option value="Dikerjakan">Dikerjakan</option>
                                        <option value="Tidak Dikerjakan">Tidak Dikerjakan</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="skala[<?php echo e($job->id); ?>]" class="form-select form-control-table skala-dropdown"
                                        required>
                                        <option value="">-- Pilih Skala --</option>
                                        <option value="Melakukan Dengan Benar">Melakukan Dengan Benar</option>
                                        <option value="Melakukan Tapi Tidak Benar">Melakukan Tapi Tidak Benar</option>
                                        <option value="Tidak Dikerjakan">Tidak Dikerjakan</option>
                                    </select>
                                </td>
                                <td><input type="text" name="catatan[<?php echo e($job->id); ?>]" class="form-control-table catatan-input"
                                        placeholder="Isi jika perlu"></td>
                                <td class="action-cell"></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="empty-state">Belum ada Job Tetap untuk dinilai.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                    <tbody id="opsional-jobs-container">
                        <tr class="job-type-header">
                            <td colspan="6">Job Opsional</td>
                        </tr>
                        <tr id="no-opsional-jobs" class="empty-state-row">
                            <td colspan="6" class="empty-state">Belum ada Job Opsional. Klik tombol di bawah untuk
                                menambah.</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <button type="button" id="add-opsional-btn" class="btn-add-opsional mt-3">
                <i class="fas fa-plus"></i> Tambah Job Opsional
            </button>
            <hr class="my-4">
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn-save-appraisal"><i class="fas fa-save"></i> Simpan Penilaian</button>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // SweetAlert2 pop-up notifications
        <?php if(session('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?php echo e(session('success')); ?>',
                showConfirmButton: false,
                timer: 1500
            });
        <?php endif; ?>

        <?php if(session('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan!',
                text: '<?php echo e(session('error')); ?>',
                showConfirmButton: false,
                timer: 1500
            });
        <?php endif; ?>

        document.addEventListener('DOMContentLoaded', function () {
            let opsionalCounter = 0;

            // Fungsi untuk mengatur dropdown Skala berdasarkan Status
            function handleStatusChange(statusDropdown) {
                const row = statusDropdown.closest('tr');
                const skalaDropdown = row.querySelector('.skala-dropdown');
                const catatanInput = row.querySelector('.catatan-input');

                if (statusDropdown.value === 'Tidak Dikerjakan') {
                    skalaDropdown.disabled = true;
                    skalaDropdown.required = false;
                    skalaDropdown.value = 'Tidak Dikerjakan';
                    if (catatanInput) catatanInput.disabled = true;
                } else {
                    skalaDropdown.disabled = false;
                    skalaDropdown.required = true;
                    if (skalaDropdown.value === 'Tidak Dikerjakan') {
                        skalaDropdown.value = '';
                    }
                    if (catatanInput) catatanInput.disabled = false;
                }
            }

            // Fungsi untuk menghapus baris job opsional
            function deleteOpsionalJob(button) {
                const row = button.closest('tr');
                row.remove();

                // Cek apakah masih ada job opsional
                const container = document.getElementById('opsional-jobs-container');
                const opsionalRows = container.querySelectorAll('.opsional-job-row');

                if (opsionalRows.length === 0) {
                    document.getElementById('no-opsional-jobs').style.display = '';
                }
            }

            // Fungsi untuk menambah validasi form
            function addFormValidation(row) {
                const inputs = row.querySelectorAll('input[required], select[required]');
                inputs.forEach(input => {
                    input.addEventListener('invalid', function () {
                        this.style.borderColor = '#ef4444';
                    });

                    input.addEventListener('input', function () {
                        if (this.checkValidity()) {
                            this.style.borderColor = '#d1d5db';
                        }
                    });
                });
            }

            // Terapkan fungsi ke semua dropdown status yang ada saat ini
            document.querySelectorAll('.status-dropdown').forEach(dropdown => {
                handleStatusChange(dropdown);
                dropdown.addEventListener('change', () => handleStatusChange(dropdown));
            });

            // Fungsi untuk menambah baris form job opsional
            document.getElementById('add-opsional-btn').addEventListener('click', function () {
                opsionalCounter++;
                const container = document.getElementById('opsional-jobs-container');
                const uniqueId = `opsional_row_${opsionalCounter}`;

                // Sembunyikan pesan kosong
                document.getElementById('no-opsional-jobs').style.display = 'none';

                const newRow = document.createElement('tr');
                newRow.className = 'opsional-job-row';
                newRow.id = uniqueId;

                newRow.innerHTML = `
                    <td class="text-center">${opsionalCounter}.</td>
                        <td>
                            <input type="text"
                                   name="opsional_nama[]"
                                   class="form-control-table mb-2"
                                   placeholder="Masukkan nama pekerjaan..."
                                   required
                                   maxlength="100">
                            <div class="job-duration-section">
                                <span class="duration-label">Durasi:</span>
                                <input type="number"
                                       name="opsional_durasi[]"
                                       class="form-control-table duration-input"
                                       placeholder="0"
                                       min="1"
                                       max="999"
                                       required>
                                <small class="text-muted">menit</small>
                            </div>
                        </td>
                        <td class="opsional-field-wrapper">
                            <select name="opsional_status[]" class="form-select form-control-table status-dropdown" required>
                                <option value="Dikerjakan">Dikerjakan</option>
                                <option value="Tidak Dikerjakan">Tidak Dikerjakan</option>
                            </select>
                        </td>
                        <td class="opsional-field-wrapper">
                            <select name="opsional_skala[]" class="form-select form-control-table skala-dropdown" required>
                                <option value="">-- Pilih Skala --</option>
                                <option value="Melakukan Dengan Benar">Melakukan Dengan Benar</option>
                                <option value="Melakukan Tapi Tidak Benar">Melakukan Tapi Tidak Benar</option>
                                <option value="Tidak Dikerjakan">Tidak Dikerjakan</option>
                            </select>
                        </td>
                        <td class="opsional-field-wrapper">
                            <input type="text"
                                   name="opsional_catatan[]"
                                   class="form-control-table catatan-input"
                                   placeholder="Catatan tambahan..."
                                   maxlength="255">
                        </td>
                        <td class="action-cell opsional-field-wrapper">
                            <button type="button"
                                    class="btn-delete-opsional"
                                    onclick="deleteOpsionalJob(this)"
                                    title="Hapus pekerjaan ini">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    `;

                container.appendChild(newRow);

                // Terapkan event listeners dan validasi ke baris baru
                const statusDropdown = newRow.querySelector('.status-dropdown');
                statusDropdown.addEventListener('change', function () {
                    handleStatusChange(this);
                });

                // Trigger initial state
                handleStatusChange(statusDropdown);

                // Tambahkan validasi
                addFormValidation(newRow);

                // Focus ke input nama pekerjaan
                newRow.querySelector('input[name="opsional_nama[]"]').focus();
            });

            // Buat fungsi delete tersedia secara global
            window.deleteOpsionalJob = deleteOpsionalJob;

            // Validasi form sebelum submit
            document.querySelector('form').addEventListener('submit', function (e) {
                let hasError = false;
                const requiredFields = this.querySelectorAll('input[required], select[required]');

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.style.borderColor = '#ef4444';
                        hasError = true;
                    } else {
                        field.style.borderColor = '#d1d5db';
                    }
                });

                if (hasError) {
                    e.preventDefault();
                    alert('Mohon lengkapi semua field yang wajib diisi.');
                    return false;
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\jobdesk-karyawan\resources\views/admin/penilaian/create.blade.php ENDPATH**/ ?>
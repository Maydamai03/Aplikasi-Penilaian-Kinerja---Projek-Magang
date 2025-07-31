<?php $__env->startSection('content'); ?>
    <style>
        /* Page Header */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            position: relative;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: -10px;
            left: -20px;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, #ffd700, #ff6b35);
            border-radius: 2px;
        }

        .page-header h1 {
            font-size: 2.2rem;
            margin: 0;
            color: #292828 !important;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .btn-add-karyawan {
            background: linear-gradient(135deg, #ffd700, #ff9500);
            color: #1f2937 !important;
            padding: 14px 24px;
            border-radius: 12px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
            border: none;
            position: relative;
            overflow: hidden;
        }

        .btn-add-karyawan::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-add-karyawan:hover::before {
            left: 100%;
        }

        .btn-add-karyawan:hover {
            background: linear-gradient(135deg, #ff9500, #ff6b35);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 215, 0, 0.4);
            color: #1f2937 !important;
        }

        .table-container {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            color: #1f2937 !important;
            padding: 30px;
            border-radius: 20px;
            border: 1px solid #e9ecef;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            position: relative;
            overflow: hidden;
        }

        .table-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ffd700, #ff6b35);
        }

        .filter-form {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .search-box {
            position: relative;
            flex-grow: 1;
            min-width: 250px;
        }

        .search-box input {
            width: 100%;
            height: 48px;
            padding: 12px 20px 12px 50px;
            border-radius: 12px;
            border: 2px solid #e5e7eb;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
            color: #1f2937 !important;
        }

        .search-box input:focus {
            border-color: #ffd700;
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.1);
            outline: none;
        }

        .search-box i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 1.1rem;
        }

        .filter-form select {
            height: 48px;
            border-radius: 12px;
            border: 2px solid #e5e7eb;
            min-width: 200px;
            padding: 0 16px;
            font-weight: 500;
            color: #1f2937 !important;
            background: white;
            transition: all 0.3s ease;
        }

        .filter-form select:focus {
            border-color: #ffd700;
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.1);
            outline: none;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .truncate-name {
            display: inline-block;
            /* Diperlukan agar max-width berfungsi */
            max-width: 150px;
            /* Atur lebar maksimal nama sebelum terpotong */
            white-space: nowrap;
            /* Mencegah teks turun ke baris baru */
            overflow: hidden;
            /* Sembunyikan teks yang berlebih */
            text-overflow: ellipsis;
            /* Tampilkan "..." pada teks yang terpotong */
            vertical-align: middle;
            /* Agar posisi teks sejajar dengan avatar */
        }

        .table th,
        .table td {
            border-bottom: 1px solid #f3f4f6;
            padding: 18px 15px;
            font-size: 0.95rem;
            vertical-align: middle;
        }

        .table th {
            border-bottom: 2px solid #e5e7eb;
            text-align: left;
            font-weight: 700;
            color: #374151 !important;
            background: rgba(255, 215, 0, 0.05);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background: rgba(255, 215, 0, 0.08);
            transform: translateX(4px);
            box-shadow: -4px 0 0 #ffd700;
        }

        .table th.text-center,
        .table td.text-center {
            text-align: center;
        }

        .table td {
            color: #1f2937 !important;
            font-weight: 500;
        }

        .status-badge {
            color: white !important;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .action-buttons form {
            margin: 0;
            padding: 0;
            display: contents;
        }

        .btn-action {
            padding: 8px 16px;
            border-radius: 8px;
            color: white !important;
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            min-width: 80px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .btn-action::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-action:hover::before {
            left: 100%;
        }

        .btn-info {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        .btn-success {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);
        }

        .btn-info:hover {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.4);
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #16a34a, #15803d);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(34, 197, 94, 0.4);
        }

        .btn-job {
            padding: 10px 18px;
            border-radius: 10px;
            color: white !important;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            gap: 6px;
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-job::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-job:hover::before {
            left: 100%;
        }

        .btn-job-tetap {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);
        }

        .btn-job-opsional {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .btn-job-tetap:hover {
            background: linear-gradient(135deg, #16a34a, #15803d);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(34, 197, 94, 0.4);
        }

        .btn-job-opsional:hover {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6b7280 !important;
        }

        .empty-state i {
            font-size: 4rem;
            color: #d1d5db;
            margin-bottom: 20px;
            display: block;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            color: #374151 !important;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .pagination-wrapper {
            margin-top: 30px;
            display: flex;
            justify-content: center;
        }

        /* Custom Pagination Styling */
        .pagination {
            display: flex;
            gap: 8px;
        }

        .pagination .page-link {
            padding: 10px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            color: #374151 !important;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            background: white;
        }

        .pagination .page-link:hover {
            border-color: #ffd700;
            background: #ffd700;
            color: #1f2937 !important;
            transform: translateY(-2px);
        }

        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #ffd700, #ff9500);
            border-color: #ffd700;
            color: #1f2937 !important;
        }

        /* Animations */
        @keyframes  fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .table-container {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                gap: 20px;
                align-items: flex-start;
            }

            .filter-form {
                flex-direction: column;
                gap: 15px;
            }

            .search-box {
                min-width: auto;
            }

            .table-container {
                padding: 20px;
                overflow-x: auto;
            }

            .table {
                min-width: 800px;
            }

            .action-buttons {
                flex-direction: column;
                gap: 8px;
            }

            .btn-action,
            .btn-job {
                width: 100%;
                min-width: auto;
            }
        }

        /* Loading State */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #ffd700;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes  spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Custom Scrollbar */
        .table-container::-webkit-scrollbar {
            height: 8px;
        }

        .table-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .table-container::-webkit-scrollbar-thumb {
            background: linear-gradient(90deg, #ffd700, #ff9500);
            border-radius: 4px;
        }

        .table-container::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(90deg, #ff9500, #ff6b35);
        }
    </style>

    <div class="page-header">
        <h1>Manajemen Job Karyawan</h1>
        <a href="<?php echo e(route('karyawan.create')); ?>" class="btn-add-karyawan">
            <i class="fas fa-user-plus"></i>
            Add Karyawan
        </a>
    </div>

    <div class="table-container">
        <form action="<?php echo e(route('karyawan.index')); ?>" method="GET" class="filter-form">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" name="search" placeholder="Cari nama atau NIP karyawan..."
                    value="<?php echo e(request('search')); ?>">
            </div>
            <select name="divisi_id" class="form-select" onchange="this.form.submit()">
                <option value="">Semua Divisi</option>
                <?php $__currentLoopData = $divisi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($d->id); ?>" <?php echo e(request('divisi_id') == $d->id ? 'selected' : ''); ?>>
                        <?php echo e($d->nama_divisi); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </form>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            <i class="fas fa-id-card" style="margin-right: 8px; color: #ffd700;"></i>
                            NIP
                        </th>
                        <th>
                            <i class="fas fa-user" style="margin-right: 8px; color: #ffd700;"></i>
                            NAMA
                        </th>
                        <th>
                            <i class="fas fa-building" style="margin-right: 8px; color: #ffd700;"></i>
                            DIVISI
                        </th>
                        <th class="text-center">
                            <i class="fas fa-info-circle" style="margin-right: 8px; color: #ffd700;"></i>
                            STATUS
                        </th>
                        <th class="text-center">
                            <i class="fas fa-cogs" style="margin-right: 8px; color: #ffd700;"></i>
                            PROFIL
                        </th>
                        <th class="text-center">
                            <i class="fas fa-tasks" style="margin-right: 8px; color: #ffd700;"></i>
                            JOBLIST
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $karyawan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <strong><?php echo e($k->nip); ?></strong>
                            </td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div
                                        style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #ffd700, #ff9500); display: flex; align-items: center; justify-content: center; color: #1f2937; font-weight: bold; font-size: 0.9rem;">
                                        <?php echo e(strtoupper(substr($k->nama_lengkap, 0, 2))); ?>

                                    </div>
                                    <strong title="<?php echo e($k->nama_lengkap); ?>">
                                        <span class="truncate-name"><?php echo e($k->nama_lengkap); ?></span>
                                    </strong>
                                </div>
                            </td>
                            <td>
                                <span
                                    style="background: rgba(255, 215, 0, 0.1); padding: 4px 12px; border-radius: 20px; font-weight: 600; color: #b45309;">
                                    <?php echo e($k->divisi->nama_divisi); ?>

                                </span>
                            </td>
                            <td class="text-center">
                                <span class="status-badge"
                                    style="background-color: <?php echo e($k->status_karyawan == 'Aktif' ? '#22C55E' : ($k->status_karyawan == 'Cuti' ? '#F59E0B' : '#EF4444')); ?>;">
                                    <i
                                        class="fas fa-<?php echo e($k->status_karyawan == 'Aktif' ? 'check' : ($k->status_karyawan == 'Cuti' ? 'clock' : 'times')); ?>"></i>
                                    <?php echo e($k->status_karyawan); ?>

                                </span>
                            </td>
                            <td class="text-center">
                                <div class="action-buttons">
                                    <a href="<?php echo e(route('karyawan.show', $k->id)); ?>" class="btn-action btn-info">
                                        <i class="fas fa-eye"></i>
                                        Info
                                    </a>

                                    <form id="delete-form-<?php echo e($k->id); ?>"
                                        action="<?php echo e(route('karyawan.destroy', $k->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="button" class="btn-action btn-danger"
                                            onclick="deleteConfirmation(<?php echo e($k->id); ?>)">
                                            <i class="fas fa-trash"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="action-buttons">
                                    <a href="<?php echo e(route('job.tetap', $k->id)); ?>" class="btn-job btn-job-tetap">
                                        <i class="fas fa-briefcase"></i>
                                        Job Tetap
                                    </a>
                                    <a href="<?php echo e(route('job.opsional', $k->id)); ?>" class="btn-job btn-job-opsional">
                                        <i class="fas fa-tasks"></i>
                                        Job Opsional
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="empty-state">
                                <i class="fas fa-users"></i>
                                <h3>Tidak Ada Data Karyawan</h3>
                                <p>Belum ada karyawan yang terdaftar dalam sistem.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            <?php echo e($karyawan->appends(request()->query())->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function deleteConfirmation(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data karyawan ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EF4444',
                cancelButtonColor: '#6B7280',
                confirmButtonText: '<i class="fas fa-trash" style="margin-right: 8px;"></i>Ya, Hapus!',
                cancelButtonText: '<i class="fas fa-times" style="margin-right: 8px;"></i>Batal',
                background: '#ffffff',
                color: '#1f2937',
                customClass: {
                    popup: 'animated fadeInDown faster',
                    confirmButton: 'btn-confirm-delete',
                    cancelButton: 'btn-cancel-delete'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading
                    Swal.fire({
                        title: 'Menghapus Data...',
                        text: 'Mohon tunggu sebentar',
                        icon: 'info',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });

                    // Submit form
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }

        // Auto-submit search form with delay
        let searchTimeout;
        document.querySelector('input[name="search"]').addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                this.form.submit();
            }, 1000);
        });

        // Add loading effect on form submission
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function() {
                    // Add loading overlay (optional)
                    const overlay = document.createElement('div');
                    overlay.className = 'loading-overlay';
                    overlay.innerHTML = '<div class="loading-spinner"></div>';
                    document.body.appendChild(overlay);
                });
            });
        });
    </script>

    <style>
        /* Custom SweetAlert2 Styling */
        .btn-confirm-delete {
            background: linear-gradient(135deg, #ef4444, #dc2626) !important;
            color: white !important;
            border: none !important;
            padding: 12px 24px !important;
            border-radius: 10px !important;
            font-weight: 700 !important;
            margin: 0 8px !important;
        }

        .btn-cancel-delete {
            background: linear-gradient(135deg, #6b7280, #4b5563) !important;
            color: white !important;
            border: none !important;
            padding: 12px 24px !important;
            border-radius: 10px !important;
            font-weight: 700 !important;
            margin: 0 8px !important;
        }

        .btn-confirm-delete:hover,
        .btn-cancel-delete:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2) !important;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\jobdesk-karyawan\resources\views/admin/karyawan/index.blade.php ENDPATH**/ ?>
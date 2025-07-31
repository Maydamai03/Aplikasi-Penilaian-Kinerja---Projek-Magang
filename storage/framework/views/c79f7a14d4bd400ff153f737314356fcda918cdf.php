<?php $__env->startSection('content'); ?>
    <style>
        /* Page Header */
        .page-header {
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
            color: #292828 !important;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            margin: 0;
        }

        .report-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            color: #1f2937 !important;
            padding: 30px;
            border-radius: 20px;
            border: 1px solid #e9ecef;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .report-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ffd700, #ff6b35);
        }

        .filter-card {
            margin-bottom: 30px;
            background: #ffffff;
            color: #1f2937 !important;
            position: relative;
            overflow: hidden;
        }

        .filter-card::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .filter-card h4 {
            color: #1f2937 !important;
            font-weight: 800;
            font-size: 1.4rem;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .filter-form {
            position: relative;
            z-index: 2;
        }

        .filter-form .row {
            align-items: end;
        }

        .filter-form label {
            font-weight: 700 !important;
            color: #1f2937 !important;
            margin-bottom: 8px;
            display: block;
            font-size: 0.95rem;
        }

        .filter-form .form-select,
        .filter-form .form-control {
            height: 48px;
            border-radius: 12px;
            border: 2px solid rgba(31, 41, 55, 0.1);
            font-weight: 500;
            color: #1f2937 !important;
            background: rgba(255, 255, 255, 0.9);
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .filter-form .form-select:focus,
        .filter-form .form-control:focus {
            border-color: #1f2937;
            box-shadow: 0 0 0 3px rgba(31, 41, 55, 0.1);
            outline: none;
            background: white;
        }

        .filter-form .btn {
            height: 48px;
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: white !important;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.3);
            position: relative;
            overflow: hidden;
            margin-top: 15px;
        }

        .filter-form .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .filter-form .btn:hover::before {
            left: 100%;
        }

        .filter-form .btn:hover {
            background: linear-gradient(135deg, #b91c1c, #991b1b);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(220, 38, 38, 0.4);
        }

        /* ... (Letakkan ini di bawah CSS .filter-form yang sudah ada) ... */

        .filter-form {
            display: flex;
            align-items: flex-end;
            /* Membuat semua elemen rata bawah */
            gap: 20px;
        }

        .filter-group {
            flex: 1;
            /* Membuat setiap grup input memiliki lebar yang fleksibel */
        }

        .filter-group label {
            margin-bottom: 8px;
            display: block;
            font-weight: 600;
        }

        .filter-group:last-child {
            flex: 0 0 auto;
            /* Mencegah tombol "Tampilkan" merentang terlalu lebar */
        }

        /* Override style lama yang tidak diperlukan lagi */
        .filter-form label {
            font-weight: 600 !important;
        }

        .filter-form .btn {
            margin-top: 0;
        }

        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .report-info h3 {
            color: #1f2937 !important;
            font-weight: 800;
            font-size: 1.8rem;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .report-info p {
            color: #4b5563 !important;
            font-weight: 500;
            margin: 0;
            line-height: 1.6;
        }

        .report-info strong {
            color: #1f2937 !important;
            font-weight: 700;
        }

        .btn-export {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: white !important;
            padding: 14px 24px;
            border-radius: 12px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.3);
            border: none;
            position: relative;
            overflow: hidden;
        }

        .btn-export::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-export:hover::before {
            left: 100%;
        }

        .btn-export:hover {
            background: linear-gradient(135deg, #b91c1c, #991b1b);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(220, 38, 38, 0.4);
            color: white !important;
        }

        .report-summary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin: 30px 0;
        }

        .summary-box {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 30px;
            border-radius: 20px;
            text-align: center;
            border: 2px solid #e2e8f0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .summary-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ffd700, #ff6b35);
        }

        .summary-box:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
            border-color: #ffd700;
        }

        .summary-box .icon-wrapper {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px auto;
            transition: transform 0.3s ease;
        }

        .summary-box:nth-child(1) .icon-wrapper {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }

        .summary-box:nth-child(2) .icon-wrapper {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
        }

        .summary-box:hover .icon-wrapper {
            transform: scale(1.1) rotate(5deg);
        }

        .summary-box .icon-wrapper i {
            font-size: 2.2rem;
            color: white;
        }

        .summary-box .value {
            font-size: 3.2rem;
            font-weight: 800;
            color: #1f2937 !important;
            margin-bottom: 10px;
            line-height: 1;
        }

        .summary-box .label {
            font-weight: 600;
            color: #6b7280 !important;
            font-size: 1rem;
            margin-bottom: 15px;
        }

        .summary-box .predicate {
            font-size: 1.2rem;
            font-weight: 700;
            padding: 8px 20px;
            border-radius: 20px;
            color: white !important;
            background: linear-gradient(135deg, #ffd700, #ff9500);
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 12px rgba(255, 215, 0, 0.3);
        }

        .detail-section {
            margin-top: 40px;
        }

        .detail-section h4 {
            color: #1f2937 !important;
            font-weight: 800;
            font-size: 1.5rem;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            padding-bottom: 15px;
            border-bottom: 3px solid #f3f4f6;
            position: relative;
        }

        .detail-section h4::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, #ffd700, #ff6b35);
        }

        .table-wrapper {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            background: white;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
            background: white;
        }

        .table th {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            color: #374151 !important;
            font-weight: 700;
            padding: 18px 15px;
            text-align: left;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e5e7eb;
        }

        .table th i {
            color: #ffd700;
            margin-right: 8px;
        }

        .table td {
            padding: 16px 15px;
            color: #1f2937 !important;
            font-weight: 500;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: middle;
        }

        .table tbody tr {
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background: rgba(255, 215, 0, 0.05);
            transform: translateX(4px);
            box-shadow: -4px 0 0 #ffd700;
        }

        .date-separator {
            background: linear-gradient(135deg, #ffd700, #ff9500) !important;
        }

        .date-separator td {
            background: transparent !important;
            color: #1f2937 !important;
            font-weight: 800 !important;
            padding: 16px 15px !important;
            text-align: left !important;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .date-separator td i {
            color: #1f2937 !important;
            margin-right: 10px;
            font-size: 1.1rem;
        }

        /* New section header for job types */
        .job-type-header {
            background: linear-gradient(135deg, #6c757d, #495057);
            /* Gray gradient */
            color: white !important;
            font-weight: 700;
            padding: 12px 15px;
            text-align: left;
            font-size: 1.1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #dee2e6;
        }

        .job-type-header i {
            color: white !important;
            margin-right: 10px;
            font-size: 1.2rem;
        }


        .no-data-card {
            text-align: center;
            padding: 60px 30px;
            color: #6b7280 !important;
        }

        .no-data-card i {
            font-size: 4rem;
            color: #d1d5db;
            margin-bottom: 20px;
            display: block;
        }

        .no-data-card h3 {
            font-size: 1.5rem;
            color: #374151 !important;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .no-data-card p {
            color: #6b7280 !important;
            font-size: 1.1rem;
        }

        /* Nilai Badge Styling */
        .nilai-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            font-weight: 800;
            font-size: 1.1rem;
            color: white !important;
            position: relative;
        }

        .nilai-badge.excellent {
            background: linear-gradient(135deg, #22c55e, #16a34a);
        }

        .nilai-badge.good {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
        }

        .nilai-badge.average {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }

        .nilai-badge.poor {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }

        .bobot-badge {
            background: rgba(255, 215, 0, 0.1);
            color: #b45309 !important;
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.85rem;
        }

        .durasi-badge {
            background: rgba(59, 130, 246, 0.1);
            color: #1e40af !important;
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.85rem;
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

        .report-card {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .report-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .report-summary {
                grid-template-columns: 1fr;
            }

            .filter-form .row {
                flex-direction: column;
                gap: 20px;
            }

            .table-wrapper {
                overflow-x: auto;
            }

            .table {
                min-width: 600px;
            }

            .summary-box .value {
                font-size: 2.5rem;
            }
        }

        /* Loading State */
        .loading-state {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            color: #6b7280;
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid #ffd700;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 15px;
        }

        @keyframes  spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    <div class="page-header">
        <h1>Laporan Kinerja Karyawan</h1>
    </div>

    <div class="report-card filter-card">
        <h4>
            <i class="fas fa-filter"></i>
            Filter Laporan
        </h4>
        <form action="<?php echo e(route('laporan.index')); ?>" method="GET" class="filter-form">
            <div class="filter-group">
                <label for="karyawan_id">Pilih Karyawan</label>
                <select name="karyawan_id" id="karyawan_id" class="form-select" required>
                    <option value="">-- Pilih Karyawan --</option>
                    <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($employee->id); ?>" title="<?php echo e($employee->nama_lengkap); ?>" 
                            <?php echo e(request('karyawan_id') == $employee->id ? 'selected' : ''); ?>>
                            <?php echo e(Str::limit($employee->nama_lengkap, 30, '...')); ?> 
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="filter-group">
                <label for="start_date">Dari Tanggal</label>
                <input type="date" name="start_date" id="start_date" class="form-control"
                    value="<?php echo e(request('start_date')); ?>" required>
            </div>
            <div class="filter-group">
                <label for="end_date">Sampai Tanggal</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="<?php echo e(request('end_date')); ?>"
                    required>
            </div>
            <div class="filter-group">
                <button type="submit" class="btn w-100">
                    <i class="fas fa-search"></i> Tampilkan
                </button>
            </div>
        </form>
    </div>

    <?php if($reportData): ?>
        <div class="report-card">
            <div class="report-header">
                <div class="report-info">
                    <h3>
                        <i class="fas fa-chart-line"></i>
                        Hasil Laporan Kinerja
                    </h3>
                    <p>
                        <strong><?php echo e($selectedKaryawan->nama_lengkap); ?></strong><br>
                        <i class="fas fa-calendar" style="margin-right: 6px;"></i>
                        Periode: <?php echo e($startDate->format('d M Y')); ?> - <?php echo e($endDate->format('d M Y')); ?>

                    </p>
                </div>
                <a href="<?php echo e(route('laporan.exportPdf', request()->query())); ?>" class="btn-export">
                    <i class="fas fa-file-pdf"></i>
                    Ekspor ke PDF
                </a>
            </div>

            <div class="report-summary">
                <div class="summary-box">
                    <div class="icon-wrapper">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="value"><?php echo e($reportData['skor_kinerja']); ?></div>
                    <div class="label">Skor Kinerja Rata-Rata</div>
                    <div class="predicate"><?php echo e($reportData['predikat_kinerja']); ?></div>
                </div>
                <div class="summary-box">
                    <div class="icon-wrapper">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="value"><?php echo e($reportData['beban_kerja']); ?>%</div>
                    <div class="label">Beban Kerja</div>
                </div>
            </div>

            <div class="detail-section">
                <h4>
                    <i class="fas fa-list-alt"></i>
                    Detail Penilaian
                </h4>
                <div class="table-wrapper">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <i class="fas fa-briefcase"></i>
                                    Pekerjaan
                                </th>
                                <th>
                                    <i class="fas fa-medal"></i>
                                    Nilai
                                </th>
                                <th>
                                    <i class="fas fa-weight-hanging"></i>
                                    Bobot
                                </th>
                                <th>
                                    <i class="fas fa-clock"></i>
                                    Durasi
                                </th>
                                <th>
                                    <i class="fas fa-tag"></i> Tipe Job
                                </th>
                                <th>
                                    <i class="fas fa-sticky-note"></i>
                                    Catatan
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $reportData['penilaian']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tanggal => $penilaianHarian): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="date-separator">
                                    <td colspan="6"> <i class="fas fa-calendar-day"></i>
                                        Penilaian Tanggal: <?php echo e(\Carbon\Carbon::parse($tanggal)->format('d F Y')); ?>

                                    </td>
                                </tr>

                                <?php
                                    $mandatoryJobs = $penilaianHarian->filter(function ($item) {
                                        return $item->jobList->tipe_job === 'Tetap';
                                    });
                                    $optionalJobs = $penilaianHarian->filter(function ($item) {
                                        return $item->jobList->tipe_job === 'Opsional';
                                    });
                                ?>

                                <?php if($mandatoryJobs->isNotEmpty()): ?>
                                    <tr>
                                        <td colspan="6" class="job-type-header">
                                            <i class="fas fa-thumbtack"></i> Pekerjaan Wajib
                                        </td>
                                    </tr>
                                    <?php $__currentLoopData = $mandatoryJobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <strong><?php echo e($item->jobList->nama_pekerjaan); ?></strong>
                                            </td>
                                            <td>
                                                <span
                                                    class="nilai-badge <?php echo e($item->nilai >= 90 ? 'excellent' : ($item->nilai >= 80 ? 'good' : ($item->nilai >= 70 ? 'average' : 'poor'))); ?>">
                                                    <?php echo e($item->nilai); ?>

                                                </span>
                                            </td>
                                            <td>
                                                <span class="bobot-badge"><?php echo e($item->jobList->bobot); ?>%</span>
                                            </td>
                                            <td>
                                                <span class="durasi-badge"><?php echo e($item->jobList->durasi_waktu); ?> menit</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary"><?php echo e($item->jobList->tipe_job); ?></span>
                                            </td>
                                            <td>
                                                <?php echo e($item->catatan_penilai ?: 'Tidak ada catatan'); ?>

                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                                <?php if($optionalJobs->isNotEmpty()): ?>
                                    <tr>
                                        <td colspan="6" class="job-type-header">
                                            <i class="fas fa-lightbulb"></i> Pekerjaan Opsional
                                        </td>
                                    </tr>
                                    <?php $__currentLoopData = $optionalJobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <strong><?php echo e($item->jobList->nama_pekerjaan); ?></strong>
                                            </td>
                                            <td>
                                                <span
                                                    class="nilai-badge <?php echo e($item->nilai >= 90 ? 'excellent' : ($item->nilai >= 80 ? 'good' : ($item->nilai >= 70 ? 'average' : 'poor'))); ?>">
                                                    <?php echo e($item->nilai); ?>

                                                </span>
                                            </td>
                                            <td>
                                                <span class="bobot-badge"><?php echo e($item->jobList->bobot); ?>%</span>
                                            </td>
                                            <td>
                                                <span class="durasi-badge"><?php echo e($item->jobList->durasi_waktu); ?> menit</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-info"><?php echo e($item->jobList->tipe_job); ?></span>
                                            </td>
                                            <td>
                                                <?php echo e($item->catatan_penilai ?: 'Tidak ada catatan'); ?>

                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php elseif(request()->filled('karyawan_id')): ?>
        <div class="report-card">
            <div class="no-data-card">
                <i class="fas fa-chart-line"></i>
                <h3>Tidak Ada Data Penilaian</h3>
                <p>Tidak ada data penilaian untuk karyawan dan periode yang dipilih.</p>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\jobdesk-karyawan\resources\views/admin/laporan/index.blade.php ENDPATH**/ ?>


<?php $__env->startSection('content'); ?>
<style>
    /* Page Header */
    .page-header h1 {
        font-size: 2.2rem;
        color: #292828;
        font-weight: 700;
        margin: 0 0 30px 0;
    }

    /* Main Card & Tabs */
    .main-card {
        background: #ffffff;
        color: #1f2937;
        padding: 10px 30px 30px;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
    }

    .tabs-nav {
        display: flex;
        border-bottom: 1px solid #dee2e6;
        margin-bottom: 25px;
    }

    .tab-link {
        padding: 15px 25px;
        cursor: pointer;
        font-size: 1rem;
        font-weight: 600;
        color: #6c757d;
        border: none;
        background: transparent;
        border-bottom: 3px solid transparent;
    }

    .tab-link.active {
        color: #1f2937;
        border-bottom-color: var(--accent-color);
    }

    .tab-panel {
        display: none;
    }

    .tab-panel.active {
        display: block;
    }

    .tab-link i {
        margin-right: 8px;
    }

    /* Filter Form */
    .filter-form h4 {
        font-weight: 700;
        font-size: 1.2rem;
        margin-bottom: 20px;
    }

    .filter-form .form-label {
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 0.9rem;
    }

    .filter-form .form-control,
    .filter-form .form-select {
        height: 48px;
        border-radius: 10px;
        border: 1px solid #ddd;
    }

    .btn-tampilkan {
        height: 48px;
        background: var(--accent-color, #dc2626);
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 700;
    }

    /* Employee Summary Card (Divisi Report) */
    /* Employee Summary Card (Divisi Report) - Modified */
    .division-report-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        /* Maksimal 3 kolom */
        gap: 25px;
        max-height: 70vh;
        /* Batasi tinggi container */
        overflow-y: auto;
        /* Enable scroll vertikal */
        padding-right: 10px;
        /* Space untuk scrollbar */
    }

    /* Responsive design untuk layar yang lebih kecil */
    @media (max-width: 1200px) {
        .division-report-grid {
            grid-template-columns: repeat(2, 1fr);
            /* 2 kolom untuk layar medium */
        }
    }

    @media (max-width: 768px) {
        .division-report-grid {
            grid-template-columns: 1fr;
            /* 1 kolom untuk layar kecil */
            max-height: 60vh;
            /* Sesuaikan tinggi untuk mobile */
        }
    }

    /* Styling untuk scrollbar (opsional, untuk webkit browsers) */
    .division-report-grid::-webkit-scrollbar {
        width: 8px;
    }

    .division-report-grid::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .division-report-grid::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 10px;
    }

    .division-report-grid::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }

    .employee-summary-card {
        background-color: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 20px;
        min-height: 200px;
        /* Minimum height untuk konsistensi */
    }

    .employee-summary-header {
        display: flex;
        align-items: center;
        gap: 15px;
        padding-bottom: 15px;
        margin-bottom: 15px;
        border-bottom: 1px solid #e5e7eb;
    }

    .employee-summary-header img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
    }

    .employee-summary-header .name {
        font-weight: 600;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: block;
        max-width: 300px;
        /* Adjusted for 3-column layout */
    }

    .employee-summary-stats {
        display: flex;
        justify-content: space-around;
        text-align: center;
    }

    .stat-item .value {
        font-size: 1.5rem;
        font-weight: 700;
    }

    .stat-item .label {
        font-size: 0.8rem;
        color: #6b7280;
    }

    .employee-summary-card .btn-export {
        width: 100%;
        justify-content: center;
        margin-top: 20px;
        background-color: #dc2626;
        color: white;
        padding: 10px;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: background-color 0.3s ease;
    }

    .employee-summary-card .btn-export:hover {
        background-color: #b91c1c;
        color: white;
        text-decoration: none;
    }

    /* Report Card for Individual Employee */
    .report-card {
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        padding: 25px;
        margin-top: 20px;
    }

    .report-header {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 25px;
        padding-bottom: 20px;
        border-bottom: 2px solid #dee2e6;
    }

    .report-header img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
    }

    .report-header .info h3 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 700;
        color: #1f2937;
    }

    .report-header .info p {
        margin: 5px 0 0 0;
        color: #6b7280;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 25px;
    }

    .stat-card {
        background: white;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .stat-card .value {
        font-size: 2rem;
        font-weight: 700;
        color: #dc2626;
    }

    .stat-card .label {
        font-size: 0.9rem;
        color: #6b7280;
        margin-top: 5px;
    }

    .detail-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .detail-table th,
    .detail-table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #dee2e6;
    }

    .detail-table th {
        background-color: #f8f9fa;
        font-weight: 600;
    }

    .detail-table tr:hover {
        background-color: #f8f9fa;
    }

    /* [BARU] Style untuk menyesuaikan tampilan Select2 */
    .select2-container .select2-selection--single {
        height: 48px !important;
        border-radius: 10px !important;
        border: 1px solid #ddd !important;
        display: flex;
        align-items: center;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 46px !important;
        padding-left: 15px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 46px !important;
    }

    .select2-dropdown {
        border-radius: 10px !important;
        border: 1px solid #ddd !important;
    }

    /* Untuk teks pada item yang sedang TERPILIH */
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #1f2937 !important;
        font-weight: 500;
    }

    /* Untuk teks pada setiap OPSI di dalam dropdown */
    .select2-results__option {
        color: #1f2937;
    }

    /* (Opsional) Untuk teks pada opsi yang sedang di-highlight/dipilih */
    .select2-results__option--highlighted {
        color: white;
    }
</style>

<div class="page-header">
    <h1>Laporan Kinerja</h1>
</div>

<div class="main-card">
    <div class="tabs-nav">
        <button class="tab-link <?php echo e($activeTab == 'karyawan' ? 'active' : ''); ?>" data-tab="karyawan"><i
                class="fas fa-user"></i> Per Karyawan</button>
        <button class="tab-link <?php echo e($activeTab == 'divisi' ? 'active' : ''); ?>" data-tab="divisi"><i
                class="fas fa-building"></i> Per Divisi</button>
    </div>

    <div class="tabs-content">
        <div id="karyawan" class="tab-panel <?php echo e($activeTab == 'karyawan' ? 'active' : ''); ?>">
            <div class="filter-form">
                <h4><i class="fas fa-filter"></i> Filter Laporan per Karyawan</h4>
                <form action="<?php echo e(route('laporan.index')); ?>" method="GET">
                    <input type="hidden" name="tab" value="karyawan">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="karyawan_id_single" class="form-label">Pilih Karyawan</label>
                            <select name="karyawan_id" id="karyawan_id_single" class="form-select" required>
                                <option value="">-- Pilih Karyawan --</option>
                                <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($employee->id); ?>" title="<?php echo e($employee->nama_lengkap); ?>"
                                    <?php echo e(request('karyawan_id') == $employee->id && $activeTab == 'karyawan' ? 'selected' : ''); ?>>
                                    <?php echo e(Str::limit($employee->nama_lengkap, 30, '...')); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="start_date_single" class="form-label">Dari Tanggal</label>
                            <input type="date" name="start_date" id="start_date_single" class="form-control"
                                value="<?php echo e(request('start_date', date('Y-m-01'))); ?>" required>
                        </div>
                        <div class="col-md-3">
                            <label for="end_date_single" class="form-label">Sampai Tanggal</label>
                            <input type="date" name="end_date" id="end_date_single" class="form-control"
                                value="<?php echo e(request('end_date', date('Y-m-t'))); ?>" required>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn-tampilkan w-100">Tampilkan</button>
                        </div>
                    </div>
                </form>
            </div>

            <?php if($activeTab == 'karyawan' && $reportData && $selectedKaryawan): ?>
            <div class="report-card">
                <div class="report-header">
                    <img src="<?php echo e($selectedKaryawan->foto_profil ? Storage::url('karyawan/' . $selectedKaryawan->foto_profil) : 'https://via.placeholder.com/80'); ?>"
                        alt="Foto <?php echo e($selectedKaryawan->nama_lengkap); ?>">
                    <div class="info">
                        <h3><?php echo e($selectedKaryawan->nama_lengkap); ?></h3>
                        <p><?php echo e($selectedKaryawan->divisi->nama_divisi ?? 'Divisi tidak tersedia'); ?></p>
                        <p>Periode: <?php echo e($startDate->format('d/m/Y')); ?> - <?php echo e($endDate->format('d/m/Y')); ?></p>
                    </div>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="value"><?php echo e($reportData['skor_kinerja']); ?></div>
                        <div class="label">Skor Kinerja</div>
                    </div>
                    <div class="stat-card">
                        <div class="value"><?php echo e($reportData['beban_kerja']); ?>%</div>
                        <div class="label">Beban Kerja</div>
                    </div>
                    <div class="stat-card">
                        <div class="value"><?php echo e($reportData['total_durasi_jam']); ?></div>
                        <div class="label">Total Jam Kerja</div>
                    </div>
                    <div class="stat-card">
                        <div class="value"><?php echo e($reportData['predikat_kinerja']); ?></div>
                        <div class="label">Predikat</div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5>Detail Penilaian Harian</h5>
                    <a href="<?php echo e(route('laporan.exportPdf', ['karyawan_id' => $selectedKaryawan->id, 'start_date' => $startDate->toDateString(), 'end_date' => $endDate->toDateString()])); ?>"
                        class="btn btn-danger">
                        <i class="fas fa-file-pdf"></i> Export PDF
                    </a>
                </div>

                <table class="detail-table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Pekerjaan</th>
                            <th>Tipe Job</th>
                            <th>Durasi (Jam)</th>
                            <th>Nilai</th>
                            <th>Bobot (%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $reportData['penilaian']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tanggal => $penilaianHarian): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $penilaianHarian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $penilaian): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e(Carbon\Carbon::parse($tanggal)->format('d/m/Y')); ?></td>
                            <td><?php echo e($penilaian->jobList->nama_pekerjaan ?? 'Pekerjaan Dihapus'); ?></td>
                            <td><?php echo e($penilaian->jobList->tipe_job ?? 'N/A'); ?></td>
                            <td><?php echo e(round(($penilaian->jobList->durasi_waktu ?? 0) / 60, 2)); ?></td>
                            <td><?php echo e($penilaian->nilai); ?></td>
                            <td><?php echo e(round($penilaian->jobList->bobot ?? 0, 2)); ?>%</td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <?php elseif($activeTab == 'karyawan' && request()->has(['karyawan_id', 'start_date', 'end_date'])): ?>
            <div class="alert alert-warning mt-4">
                <i class="fas fa-exclamation-triangle"></i> Tidak ada data penilaian untuk karyawan ini pada periode
                yang dipilih.
            </div>
            <?php endif; ?>
        </div>

        <div id="divisi" class="tab-panel <?php echo e($activeTab == 'divisi' ? 'active' : ''); ?>">
            <div class="filter-form">
                <h4><i class="fas fa-filter"></i> Filter Laporan per Divisi</h4>
                <form action="<?php echo e(route('laporan.index')); ?>" method="GET">
                    <input type="hidden" name="tab" value="divisi">
                    <div class="row g-3">
                        <div class="col-md-5">
                            <label for="divisi_id_div" class="form-label">Pilih Divisi</label>
                            <select name="divisi_id" id="divisi_id_div" class="form-select" required>
                                <option value="">-- Pilih Divisi --</option>
                                <?php $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $division): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($division->id); ?>"
                                    <?php echo e(request('divisi_id') == $division->id && $activeTab == 'divisi' ? 'selected' : ''); ?>>
                                    <?php echo e($division->nama_divisi); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="start_date_div" class="form-label">Dari Tanggal</label>
                            <input type="date" name="start_date" id="start_date_div" class="form-control"
                                value="<?php echo e(request('start_date', date('Y-m-01'))); ?>" required>
                        </div>
                        <div class="col-md-3">
                            <label for="end_date_div" class="form-label">Sampai Tanggal</label>
                            <input type="date" name="end_date" id="end_date_div" class="form-control"
                                value="<?php echo e(request('end_date', date('Y-m-t'))); ?>" required>
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="submit" class="btn-tampilkan w-100">Ok</button>
                        </div>
                    </div>
                </form>
            </div>

            <?php if($activeTab == 'divisi' && $reportData && $selectedDivisi): ?>
            <h3 class="mt-4">Ringkasan Divisi: <?php echo e($selectedDivisi->nama_divisi); ?></h3>
            <div class="division-report-grid">
                <?php $__empty_1 = true; $__currentLoopData = $reportData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $karyawanReport): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="employee-summary-card">
                    <div class="employee-summary-header">
                        <img src="<?php echo e($karyawanReport['karyawan']->foto_profil ? Storage::url('karyawan/' . $karyawanReport['karyawan']->foto_profil) : 'https://via.placeholder.com/50'); ?>"
                            alt="Foto">
                        <div>
                            <div class="name"><?php echo e($karyawanReport['karyawan']->nama_lengkap); ?></div>
                            <small><?php echo e($karyawanReport['data']['predikat_kinerja']); ?></small>
                        </div>
                    </div>
                    <div class="employee-summary-stats">
                        <div class="stat-item">
                            <div class="value"><?php echo e($karyawanReport['data']['skor_kinerja']); ?></div>
                            <div class="label">Skor</div>
                        </div>
                        <div class="stat-item">
                            <div class="value"><?php echo e($karyawanReport['data']['beban_kerja']); ?>%</div>
                            <div class="label">Beban</div>
                        </div>
                    </div>
                    <a href="<?php echo e(route('laporan.exportPdf', ['karyawan_id' => $karyawanReport['karyawan']->id, 'start_date' => $startDate->toDateString(), 'end_date' => $endDate->toDateString()])); ?>"
                        class="btn-export">
                        <i class="fas fa-file-pdf"></i> Ekspor PDF
                    </a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p>Tidak ada data penilaian untuk divisi ini pada periode yang dipilih.</p>
                <?php endif; ?>
            </div>
            <?php elseif($activeTab == 'divisi' && request()->has(['divisi_id', 'start_date', 'end_date'])): ?>
            <div class="alert alert-warning mt-4">
                <i class="fas fa-exclamation-triangle"></i> Tidak ada data penilaian untuk divisi ini pada periode
                yang dipilih.
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabLinks = document.querySelectorAll('.tab-link');
        const tabPanels = document.querySelectorAll('.tab-panel');

        tabLinks.forEach(link => {
            link.addEventListener('click', () => {
                const tabId = link.getAttribute('data-tab');

                tabLinks.forEach(l => l.classList.remove('active'));
                tabPanels.forEach(p => p.classList.remove('active'));

                link.classList.add('active');
                document.getElementById(tabId).classList.add('active');
            });
        });
    });

    // Script untuk tabs (tidak berubah)
    document.addEventListener('DOMContentLoaded', function() {
        /* ... kode tabs ... */
    });

    // [BARU] Inisialisasi Select2 untuk dropdown karyawan
    $(document).ready(function() {
        $('#karyawan_id_single').select2({
            placeholder: "-- Pilih Karyawan --",
            allowClear: true
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\jobdesk-karyawan\resources\views/admin/laporan/index.blade.php ENDPATH**/ ?>
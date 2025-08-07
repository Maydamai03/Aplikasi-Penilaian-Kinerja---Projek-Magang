<?php $__env->startSection('content'); ?>
<style>
    :root {
        /* Yellow Theme - Professional & Clean */
        --primary-yellow: #f5d62d;
        --yellow-light: #fef3c7;
        --yellow-dark: #d69e2e;
        --yellow-darker: #b7791f;

        /* Neutral Colors */
        --white: #ffffff;
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-300: #d1d5db;
        --gray-400: #9ca3af;
        --gray-500: #6b7280;
        --gray-600: #4b5563;
        --gray-700: #374151;
        --gray-800: #1f2937;
        --gray-900: #111827;

        /* Theme Variables */
        --text-dark: var(--gray-800);
        --text-muted: var(--gray-500);
        --border-color: var(--gray-200);
        --border-radius: 8px;
        --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    }

    /* Page Header */
    .page-header h1 {
        font-size: 1.875rem;
        color: var(--text-dark);
        font-weight: 700;
        margin: 0 0 25px 0;
    }

    /* Main Card & Tabs */
    .main-card {
        background: var(--white);
        color: var(--text-dark);
        padding: 0;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        border: 1px solid var(--border-color);
    }

    .tabs-nav {
        display: flex;
        border-bottom: 1px solid var(--border-color);
        margin: 0;
        background: var(--gray-50);
        border-radius: var(--border-radius) var(--border-radius) 0 0;
    }

    .tab-link {
        padding: 18px 30px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
        color: var(--text-muted);
        border: none;
        background: transparent;
        border-bottom: 2px solid transparent;
        transition: all 0.2s ease;
    }

    .tab-link:hover {
        color: var(--text-dark);
        background: var(--yellow-light);
    }

    .tab-link.active {
        color: var(--text-dark);
        border-bottom-color: var(--primary-yellow);
        background: var(--white);
    }

    .tab-panel {
        display: none;
        padding: 30px;
    }

    .tab-panel.active {
        display: block;
    }

    .tab-link i {
        margin-right: 8px;
    }

    /* Filter Form */
    .filter-form {
        background: var(--gray-50);
        padding: 25px;
        border-radius: var(--border-radius);
        margin-bottom: 30px;
        border: 1px solid var(--border-color);
    }

    .filter-form h4 {
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 20px;
        color: var(--text-dark);
    }

    .filter-form .form-label {
        font-weight: 500;
        margin-bottom: 6px;
        font-size: 14px;
        color: var(--text-dark);
    }

    .filter-form .form-control,
    .filter-form .form-select {
        height: 42px;
        border-radius: var(--border-radius);
        border: 1px solid var(--border-color);
        padding: 8px 15px;
        font-size: 14px;
        transition: border-color 0.2s ease;
    }

    .filter-form .form-control:focus,
    .filter-form .form-select:focus {
        border-color: var(--primary-yellow);
        box-shadow: 0 0 0 2px rgba(245, 214, 45, 0.2);
        outline: none;
    }

    .btn-tampilkan {
        height: 42px;
        background: var(--primary-yellow);
        color: var(--text-dark);
        border: none;
        border-radius: var(--border-radius);
        font-weight: 600;
        padding: 0 25px;
        font-size: 14px;
        transition: all 0.2s ease;
    }

    .btn-tampilkan:hover {
        background: var(--yellow-dark);
        color: var(--text-dark);
    }

    .btn-export {
        background: #dc2626;
        color: white !important;
        padding: 10px 20px;
        border-radius: var(--border-radius);
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
        border: none;
        font-size: 14px;
    }

    .btn-export:hover {
        background: #b91c1c;
        color: white;
        text-decoration: none;
    }

    /* Division Report Grid */
    .division-report-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 20px;
        max-height: 70vh;
        overflow-y: auto;
        padding-right: 10px;
    }

    /* Responsive design untuk layar yang lebih kecil */
    @media (max-width: 768px) {
        .division-report-grid {
            grid-template-columns: 1fr;
            max-height: 60vh;
        }
    }

    /* Styling untuk scrollbar */
    .division-report-grid::-webkit-scrollbar {
        width: 6px;
    }

    .division-report-grid::-webkit-scrollbar-track {
        background: var(--gray-100);
        border-radius: 10px;
    }

    .division-report-grid::-webkit-scrollbar-thumb {
        background: var(--gray-300);
        border-radius: 10px;
    }

    .division-report-grid::-webkit-scrollbar-thumb:hover {
        background: var(--gray-400);
    }

    .employee-summary-card {
        background-color: var(--white);
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius);
        padding: 20px;
        transition: box-shadow 0.2s ease;
    }

    .employee-summary-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .employee-summary-header {
        display: flex;
        align-items: center;
        gap: 12px;
        padding-bottom: 15px;
        margin-bottom: 15px;
        border-bottom: 1px solid var(--border-color);
    }

    .employee-summary-header img {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--yellow-light);
    }

    .employee-summary-header .name {
        font-weight: 600;
        font-size: 14px;
        color: var(--text-dark);
        margin-bottom: 2px;
    }

    .employee-summary-header small {
        color: var(--text-muted);
        font-size: 12px;
    }

    .employee-summary-stats {
        display: flex;
        justify-content: space-around;
        text-align: center;
        margin-bottom: 20px;
    }

    .stat-item .value {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-dark);
    }

    .stat-item .label {
        font-size: 12px;
        color: var(--text-muted);
    }

    .employee-summary-card .btn-export {
        width: 100%;
        justify-content: center;
        margin-top: 15px;
    }

    /* Report Card for Individual Employee */
    .report-card {
        background-color: var(--white);
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius);
        padding: 25px;
        margin-top: 20px;
    }

    .report-header {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 25px;
        padding-bottom: 20px;
        border-bottom: 1px solid var(--border-color);
    }

    .report-header img {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--yellow-light);
    }

    .report-header .info h3 {
        margin: 0;
        font-size: 1.375rem;
        font-weight: 700;
        color: var(--text-dark);
    }

    .report-header .info p {
        margin: 5px 0 0 0;
        color: var(--text-muted);
        font-size: 14px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 25px;
    }

    .stat-card {
        background: var(--yellow-light);
        padding: 20px;
        border-radius: var(--border-radius);
        text-align: center;
        border: 1px solid var(--primary-yellow);
    }

    .stat-card .value {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--text-dark);
    }

    .stat-card .label {
        font-size: 14px;
        color: var(--text-muted);
        margin-top: 5px;
    }

    .detail-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        font-size: 14px;
    }

    .detail-table th,
    .detail-table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid var(--border-color);
    }

    .detail-table th {
        background-color: var(--gray-50);
        font-weight: 600;
        color: var(--text-dark);
    }

    .detail-table tr:hover {
        background-color: var(--gray-50);
    }

    .wrap-text {
        max-width: 250px;
        word-wrap: break-word;
        white-space: normal;
    }

    /* Alert styling */
    .alert {
        padding: 15px 20px;
        border-radius: var(--border-radius);
        border: 1px solid transparent;
        font-size: 14px;
    }

    .alert-warning {
        background-color: #fef3c7;
        border-color: #f59e0b;
        color: #92400e;
    }

    /* Select2 Styling */
    .select2-container .select2-selection--single {
        height: 42px !important;
        border-radius: var(--border-radius) !important;
        border: 1px solid var(--border-color) !important;
        display: flex;
        align-items: center;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 40px !important;
        padding-left: 15px !important;
        color: var(--text-dark) !important;
        font-weight: 400;
        font-size: 14px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 40px !important;
        right: 10px !important;
    }

    .select2-dropdown {
        border-radius: var(--border-radius) !important;
        border: 1px solid var(--border-color) !important;
        box-shadow: var(--shadow);
    }

    .select2-results__option {
        color: var(--text-dark);
        font-size: 14px;
    }

    .select2-results__option--highlighted {
        background-color: var(--yellow-light) !important;
        color: var(--text-dark) !important;
    }

    .select2-container--default .select2-selection--single:focus {
        border-color: var(--primary-yellow) !important;
    }

    /* Form table styling */
    .filter-form table {
        width: 100%;
        border: 0;
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    .filter-form table td {
        vertical-align: middle;
        padding: 5px 10px 5px 0;
    }

    .filter-form table td:first-child {
        width: 180px;
        font-weight: 500;
    }

    /* Header actions */
    .d-flex.justify-content-between {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .d-flex.justify-content-between h5 {
        margin: 0;
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-dark);
    }

    /* Division report title */
    .mt-4 {
        margin-top: 25px !important;
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 20px;
    }
</style>

<div class="page-header">
    <h1>Laporan Kinerja</h1>
</div>

<div class="main-card">
    <div class="tabs-nav">
        <button class="tab-link <?php echo e($activeTab == 'karyawan' ? 'active' : ''); ?>" data-tab="karyawan">
            <i class="fas fa-user"></i> Per Karyawan
        </button>
        <button class="tab-link <?php echo e($activeTab == 'divisi' ? 'active' : ''); ?>" data-tab="divisi">
            <i class="fas fa-building"></i> Per Divisi
        </button>
    </div>

    <div class="tabs-content">
        <div id="karyawan" class="tab-panel <?php echo e($activeTab == 'karyawan' ? 'active' : ''); ?>">
            <div class="filter-form">
                <h4><i class="fas fa-filter"></i> Filter Laporan per Karyawan</h4>
                <form action="<?php echo e(route('laporan.index')); ?>" method="GET">
                    <input type="hidden" name="tab" value="karyawan">
                    <table>
                        <tr>
                            <td>
                                <label for="karyawan_id_single" class="form-label">Pilih Karyawan</label>
                            </td>
                            <td>
                                <select name="karyawan_id" id="karyawan_id_single" class="form-select w-100" required>
                                    <option value="">-- Pilih Karyawan --</option>
                                    <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($employee->id); ?>" title="<?php echo e($employee->nama_lengkap); ?>"
                                        <?php echo e(request('karyawan_id') == $employee->id && $activeTab == 'karyawan' ? 'selected' : ''); ?>>
                                        <?php echo e(Str::limit($employee->nama_lengkap, 30, '...')); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="start_date_single" class="form-label">Dari Tanggal</label></td>
                            <td>
                                <input type="date" name="start_date" id="start_date_single" class="form-control"
                                    value="<?php echo e(request('start_date', date('Y-m-d'))); ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="end_date_single" class="form-label">Sampai Tanggal</label></td>
                            <td>
                                <input type="date" name="end_date" id="end_date_single" class="form-control"
                                    value="<?php echo e(request('end_date', date('Y-m-d'))); ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <button type="submit" class="btn btn-tampilkan">Tampilkan</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>

            <?php if($activeTab == 'karyawan' && $reportData && $selectedKaryawan): ?>
            <div class="report-card">
                <div class="report-header">
                    <img src="<?php echo e($selectedKaryawan->foto_profil ? Storage::url('karyawan/' . $selectedKaryawan->foto_profil) : 'https://via.placeholder.com/80'); ?>"
                        alt="Foto <?php echo e($selectedKaryawan->nama_lengkap); ?>">
                    <div class="info">
                        <h3><?php echo e($selectedKaryawan->nama_lengkap); ?></h3>
                        <p><?php echo e($selectedKaryawan->jabatan->nama_jabatan ?? 'Jabatan tidak tersedia'); ?> |
                            <?php echo e($selectedKaryawan->divisi->nama_divisi ?? 'Divisi tidak tersedia'); ?>

                        </p>
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
                        class="btn-export">
                        <i class="fas fa-file-pdf"></i> Ekspor ke PDF
                    </a>
                </div>

                <table class="detail-table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Pekerjaan</th>
                            <th>Tipe Job</th>
                            <th>Shift</th>
                            
                            <th>Bobot (%)</th>
                            <th>Durasi (%)</th>
                            <th>Nilai (%)</th>
                            <th>Aksi</th>
                        </tr>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter = 1; ?>
                        <?php $__currentLoopData = $reportData['penilaian']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tanggal => $penilaianHarian): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="date-separator">
                            <td colspan="8">
                                Penilaian Tanggal: <?php echo e(\Carbon\Carbon::parse($tanggal)->format('d F Y')); ?>

                                <form action="<?php echo e(route('penilaian.destroy.bydate')); ?>" method="POST" class="d-inline-block float-end" onsubmit="return confirm('Apakah Anda yakin ingin menghapus semua penilaian pada tanggal ini? Tindakan ini tidak bisa dibatalkan.');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <input type="hidden" name="karyawan_id" value="<?php echo e($selectedKaryawan->id); ?>">
                                    <input type="hidden" name="tanggal" value="<?php echo e($tanggal); ?>">
                                    <button type="submit" class="btn btn-sm btn-danger ms-2" title="Hapus semua penilaian pada hari ini">
                                        <i class="fas fa-trash"></i> Hapus Hari Ini
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php $__currentLoopData = $penilaianHarian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $penilaian): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($counter++); ?></td>
                            <td>
                                <div class="wrap-text">
                                    <?php echo e($penilaian->jobList->nama_pekerjaan ?? 'Pekerjaan Dihapus'); ?>

                                </div>
                            </td>
                            <td><?php echo e($penilaian->jobList->tipe_job ?? 'N/A'); ?></td>
                            <td><?php echo e($penilaian->jobList->shift ?? 'N/A'); ?></td>
                            
                            <td><?php echo e(number_format($penilaian->jobList->bobot ?? 0, 2)); ?>%</td>
                            <td><?php echo e($penilaian->jobList->durasi_waktu ?? 0); ?> menit</td>
                            <td><?php echo e(number_format($penilaian->nilai, 2)); ?></td>
                            
                            <td>
                                <a href="<?php echo e(route('penilaian.edit', $penilaian->id)); ?>" class="btn btn-sm btn-info">Edit</a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <?php elseif($activeTab == 'karyawan' && request()->has(['karyawan_id', 'start_date', 'end_date'])): ?>
            <div class="alert alert-warning mt-4">
                <i class="fas fa-exclamation-triangle"></i> Tidak ada data penilaian untuk karyawan ini pada periode yang dipilih.
            </div>
            <?php endif; ?>
        </div>

        <div id="divisi" class="tab-panel <?php echo e($activeTab == 'divisi' ? 'active' : ''); ?>">
            <div class="filter-form">
                <h4><i class="fas fa-filter"></i> Filter Laporan per Divisi</h4>
                <form action="<?php echo e(route('laporan.index')); ?>" method="GET">
                    <input type="hidden" name="tab" value="divisi">
                    <table>
                        <tr>
                            <td>
                                <label for="divisi_id_div" class="form-label">Pilih Divisi</label>
                            </td>
                            <td>
                                <select name="divisi_id" id="divisi_id_div" class="form-select w-100" required>
                                    <option value="">-- Pilih Divisi --</option>
                                    <?php $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $division): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($division->id); ?>"
                                        <?php echo e(request('divisi_id') == $division->id && $activeTab == 'divisi' ? 'selected' : ''); ?>>
                                        <?php echo e($division->nama_divisi); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="start_date_div" class="form-label">Dari Tanggal</label></td>
                            <td>
                                <input type="date" name="start_date" id="start_date_div" class="form-control"
                                    value="<?php echo e(request('start_date', date('Y-m-d'))); ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="end_date_div" class="form-label">Sampai Tanggal</label></td>
                            <td>
                                <input type="date" name="end_date" id="end_date_div" class="form-control"
                                    value="<?php echo e(request('end_date', date('Y-m-d'))); ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <button type="submit" class="btn btn-tampilkan">Tampilkan</button>
                            </td>
                        </tr>
                    </table>
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
                <i class="fas fa-exclamation-triangle"></i> Tidak ada data penilaian untuk divisi ini pada periode yang dipilih.
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

    // Inisialisasi Select2 untuk dropdown karyawan
    $(document).ready(function() {
        $('#karyawan_id_single').select2({
            placeholder: "-- Pilih Karyawan --",
            allowClear: true
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\jobdesk-karyawan\resources\views/admin/laporan/index.blade.php ENDPATH**/ ?>
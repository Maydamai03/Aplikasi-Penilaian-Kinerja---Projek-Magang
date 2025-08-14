@extends('layouts.admin')

@section('content')
    <style>
        /* DashboardHeader Style */
        .dashboard-header {
            position: relative;
            margin-bottom: 40px;
        }

        .dashboard-header::before {
            content: '';
            position: absolute;
            top: -10px;
            left: -20px;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, #ffd700, #ff6b35);
            border-radius: 2px;
        }

        .dashboard-header h1 {
            font-size: 2.2rem;
            margin: 0;
            color: #292828 !important;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .dashboard-header p {
            font-size: 1.1rem;
            color: #292828 !important;
            margin-top: 8px;
            font-weight: 400;
        }

        /* Main Card */
        .main-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            color: #414141 !important;
            padding: 0;
            border-radius: 20px;
            border: 1px solid #e9ecef;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            position: relative;
            overflow: hidden;
        }

        .main-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ffd700, #ff6b35);
        }

        /* Tabs */
        .tabs-nav {
            display: flex;
            border-bottom: 1px solid #e9ecef;
            margin: 0;
            background: #f8f9fa;
            padding: 0 30px;
        }

        .tab-link {
            padding: 20px 30px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            color: #6b7280 !important;
            border: none;
            background: transparent;
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
        }

        .tab-link:hover {
            color: #292828 !important;
            background: rgba(255, 215, 0, 0.05);
        }

        .tab-link.active {
            color: #292828 !important;
            border-bottom-color: #ffd700;
            background: #ffffff;
        }

        .tab-panel {
            display: none;
            padding: 30px;
        }

        .tab-panel.active {
            display: block;
        }

        /* Filter Form */
        .filter-form {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            padding: 30px;
            border-radius: 20px;
            margin-bottom: 30px;
            border: 1px solid #e9ecef;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            position: relative;
        }

        .filter-form::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ffd700, #ff6b35);
        }

        .filter-form h4 {
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 25px;
            color: #292828 !important;
        }

        .filter-form .form-label {
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
            color: #292828 !important;
        }

        .filter-form .form-control,
        .filter-form .form-select {
            height: 50px;
            border-radius: 12px;
            border: 2px solid #e9ecef;
            padding: 12px 18px;
            font-size: 14px;
            color: #292828 !important;
            background: #ffffff !important;
        }

        .filter-form .form-control:focus,
        .filter-form .form-select:focus {
            border-color: #ffd700;
            box-shadow: 0 0 0 4px rgba(255, 215, 0, 0.1);
            outline: none;
        }

        .btn-tampilkan {
            height: 50px;
            background: linear-gradient(135deg, #ffd700, #ff6b35);
            color: #292828 !important;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            padding: 0 30px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-tampilkan:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 215, 0, 0.4);
        }

        .btn-export {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: white !important;
            padding: 12px 25px;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            border: none;
            font-size: 14px;
        }

        .btn-export:hover {
            background: linear-gradient(135deg, #b91c1c, #991b1b);
            transform: translateY(-2px);
            color: white !important;
            text-decoration: none;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            color: #414141 !important;
            padding: 25px;
            border-radius: 16px;
            border: 1px solid #e9ecef;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            position: relative;
            text-align: center;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #ffd700, #ff6b35);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .stat-card .value {
            font-size: 2rem;
            font-weight: 800;
            color: #292828 !important;
            margin-bottom: 8px;
        }

        .stat-card .label {
            font-size: 14px;
            color: #6b7280 !important;
            font-weight: 600;
        }

        /* Report Card */
        .report-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            border: 1px solid #e9ecef;
            padding: 30px;
            margin-top: 25px;
            position: relative;
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

        .report-header {
            display: flex;
            align-items: center;
            gap: 25px;
            margin-bottom: 30px;
            padding-bottom: 25px;
            border-bottom: 2px solid #e9ecef;
        }

        .report-header img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #ffd700;
        }

        .report-header .info h3 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
            color: #292828 !important;
        }

        .report-header .info p {
            margin: 8px 0 0 0;
            color: #6b7280 !important;
            font-size: 14px;
        }

        /* Employee Summary Cards */
        .division-report-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 25px;
            max-height: 70vh;
            overflow-y: auto;
        }

        .employee-summary-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border: 1px solid #e9ecef;
            border-radius: 16px;
            padding: 25px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
            position: relative;
        }

        .employee-summary-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #ffd700, #ff6b35);
        }

        .employee-summary-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .employee-summary-header {
            display: flex;
            align-items: center;
            gap: 15px;
            padding-bottom: 20px;
            margin-bottom: 20px;
            border-bottom: 1px solid #e9ecef;
        }

        .employee-summary-header img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #ffd700;
        }

        .employee-summary-header .name {
            font-weight: 700;
            font-size: 15px;
            color: #292828 !important;
            margin-bottom: 4px;
        }

        .employee-summary-header small {
            color: #6b7280 !important;
            font-size: 12px;
        }

        .employee-summary-stats {
            display: flex;
            justify-content: space-around;
            text-align: center;
            margin-bottom: 20px;
        }

        .employee-summary-stats .stat-item .value {
            font-size: 1.4rem;
            font-weight: 700;
            color: #292828 !important;
        }

        .employee-summary-stats .stat-item .label {
            font-size: 12px;
            color: #6b7280 !important;
            margin-top: 5px;
        }

        .employee-summary-card .btn-export {
            width: 100%;
            justify-content: center;
            margin-top: 15px;
        }

        /* Table */
        .detail-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
        }

        .detail-table th,
        .detail-table td {
            padding: 15px 12px;
            text-align: left;
            border-bottom: 1px solid #e9ecef;
            color: #292828 !important;
        }

        .detail-table th {
            background: #f8f9fa;
            font-weight: 700;
            font-size: 13px;
        }

        .detail-table tr:hover {
            background-color: rgba(255, 215, 0, 0.05);
        }

        .date-separator td {
            background: linear-gradient(135deg, #ffd700, #ff6b35) !important;
            color: white !important;
            font-weight: 700;
            padding: 12px;
        }

        .wrap-text {
            max-width: 250px;
            word-wrap: break-word;
            white-space: normal;
        }

        /* Alert */
        .alert-warning {
            background: #fef3c7;
            color: #92400e !important;
            border: 1px solid #f59e0b;
            padding: 20px;
            border-radius: 12px;
            margin-top: 20px;
        }

        /* Form table */
        .filter-form table {
            width: 100%;
            border-spacing: 0 15px;
        }

        .filter-form table td {
            vertical-align: middle;
            padding: 8px 15px 8px 0;
        }

        .filter-form table td:first-child {
            width: 180px;
            font-weight: 600;
            color: #292828 !important;
        }

        /* Buttons */
        .btn-sm {
            padding: 8px 15px;
            font-size: 12px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-info {
            background: linear-gradient(135deg, #0ea5e9, #0284c7);
            color: white !important;
            border: none;
        }

        .btn-info:hover {
            background: linear-gradient(135deg, #0284c7, #0369a1);
            transform: translateY(-1px);
            color: white !important;
            text-decoration: none;
        }

        .btn-danger {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: white !important;
            border: none;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #b91c1c, #991b1b);
            transform: translateY(-1px);
            color: white !important;
            text-decoration: none;
        }

        /* Header styling */
        .d-flex.justify-content-between h5 {
            margin: 0;
            font-size: 1.2rem;
            font-weight: 700;
            color: #292828 !important;
        }

        .mt-4 {
            margin-top: 30px !important;
            font-size: 1.4rem;
            font-weight: 700;
            color: #292828 !important;
            margin-bottom: 25px;
        }

        /* Select2 */
        .select2-container .select2-selection--single {
            height: 50px !important;
            border-radius: 12px !important;
            border: 2px solid #e9ecef !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 46px !important;
            padding-left: 18px !important;
            color: #292828 !important;
            font-size: 14px;
        }

        .select2-dropdown {
            border-radius: 12px !important;
            border: 2px solid #e9ecef !important;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .select2-results__option--highlighted {
            background: #ffd700 !important;
            color: #292828 !important;
        }

        /* Animation */
        .floating-element {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .stats-grid,
            .division-report-grid {
                grid-template-columns: 1fr;
            }

            .dashboard-header h1 {
                font-size: 1.8rem;
            }

            .tabs-nav {
                padding: 0 20px;
            }
        }
    </style>

    <div class="dashboard-header floating-element">
        <h1>Laporan Kinerja</h1>
        <p>Analisis dan evaluasi kinerja karyawan berdasarkan periode waktu tertentu.</p>
    </div>

    <div class="main-card">
        <div class="tabs-nav">
            <button class="tab-link {{ $activeTab == 'karyawan' ? 'active' : '' }}" data-tab="karyawan">
                <i class="fas fa-user"></i> Per Karyawan
            </button>
            <button class="tab-link {{ $activeTab == 'divisi' ? 'active' : '' }}" data-tab="divisi">
                <i class="fas fa-building"></i> Per Divisi
            </button>
        </div>

        <div class="tabs-content">
            <div id="karyawan" class="tab-panel {{ $activeTab == 'karyawan' ? 'active' : '' }}">
                <div class="filter-form">
                    <h4><i class="fas fa-filter"></i> Filter Laporan per Karyawan</h4>
                    <form action="{{ route('laporan.index') }}" method="GET">
                        <input type="hidden" name="tab" value="karyawan">
                        <table>
                            <tr>
                                <td>
                                    <label for="karyawan_id_single" class="form-label">Pilih Karyawan</label>
                                </td>
                                <td>
                                    <select name="karyawan_id" id="karyawan_id_single" class="form-select w-100" required>
                                        <option value="">-- Pilih Karyawan --</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}" title="{{ $employee->nama_lengkap }}"
                                                {{ request('karyawan_id') == $employee->id && $activeTab == 'karyawan' ? 'selected' : '' }}>
                                                {{ Str::limit($employee->nama_lengkap, 30, '...') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="start_date_single" class="form-label">Dari Tanggal</label></td>
                                <td>
                                    <input type="date" name="start_date" id="start_date_single" class="form-control"
                                        value="{{ request('start_date', date('Y-m-d')) }}" required>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="end_date_single" class="form-label">Sampai Tanggal</label></td>
                                <td>
                                    <input type="date" name="end_date" id="end_date_single" class="form-control"
                                        value="{{ request('end_date', date('Y-m-d')) }}" required>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <button type="submit" class="btn btn-tampilkan">
                                        <i class="fas fa-search"></i> Tampilkan Laporan
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>

                @if ($activeTab == 'karyawan' && $reportData && $selectedKaryawan)
                    <div class="report-card">
                        <div class="report-header">
                            <img src="{{ $selectedKaryawan->foto_profil ? Storage::url('karyawan/' . $selectedKaryawan->foto_profil) : 'https://via.placeholder.com/80' }}"
                                alt="Foto {{ $selectedKaryawan->nama_lengkap }}">
                            <div class="info">
                                <h3>{{ $selectedKaryawan->nama_lengkap }}</h3>
                                <p>{{ $selectedKaryawan->jabatan->nama_jabatan ?? 'Jabatan tidak tersedia' }} |
                                    {{ $selectedKaryawan->divisi->nama_divisi ?? 'Divisi tidak tersedia' }}
                                </p>
                                <p>Periode: {{ $startDate->format('d/m/Y') }} - {{ $endDate->format('d/m/Y') }}</p>
                            </div>
                        </div>

                        <div class="stats-grid">
                            <div class="stat-card">
                                <div class="value">{{ number_format($reportData['skor_kinerja'], 2) }}</div>
                                <div class="label">Skor Kinerja</div>
                            </div>
                            <div class="stat-card">
                                <div class="value">{{ number_format($reportData['beban_kerja'], 2) }}%</div>
                                <div class="label">Beban Kerja</div>
                            </div>
                            <div class="stat-card">
                                <div class="value">{{ number_format($reportData['total_durasi_jam'], 2) }}</div>
                                <div class="label">Total Jam Kerja</div>
                            </div>
                            <div class="stat-card">
                                <div class="value">{{ $reportData['predikat_kinerja'] }}</div>
                                <div class="label">Predikat</div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5><i class="fas fa-chart-line"></i> Detail Penilaian Harian</h5>
                            <a href="{{ route('laporan.exportPdf', ['karyawan_id' => $selectedKaryawan->id, 'start_date' => $startDate->toDateString(), 'end_date' => $endDate->toDateString()]) }}"
                                class="btn-export">
                                <i class="fas fa-file-pdf"></i> Ekspor ke PDF
                            </a>
                        </div>

                        <table class="detail-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pekerjaan</th>
                                    <th>Tipe Job</th>
                                    <th>Shift</th>
                                    <th>Bobot (%)</th>
                                    <th>Durasi</th>
                                    <th>Nilai (%)</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $counter = 1; @endphp
                                @foreach ($reportData['penilaian'] as $tanggal => $penilaianHarian)
                                    <tr class="date-separator">
                                        <td colspan="8">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span><i class="fas fa-calendar-day"></i> Penilaian Tanggal: {{ \Carbon\Carbon::parse($tanggal)->format('d F Y') }}</span>
                                                <form action="{{ route('penilaian.destroy.bydate') }}" method="POST" class="d-inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus semua penilaian pada tanggal ini? Tindakan ini tidak bisa dibatalkan.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="karyawan_id" value="{{ $selectedKaryawan->id }}">
                                                    <input type="hidden" name="tanggal" value="{{ $tanggal }}">
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus semua penilaian pada hari ini">
                                                        <i class="fas fa-trash"></i> Hapus Hari Ini
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @foreach ($penilaianHarian as $penilaian)
                                        <tr>
                                            <td>{{ $counter++ }}</td>
                                            <td>
                                                <div class="wrap-text">
                                                    {{ $penilaian->jobList->nama_pekerjaan ?? 'Pekerjaan Dihapus' }}
                                                </div>
                                            </td>
                                            <td>{{ $penilaian->jobList->tipe_job ?? 'N/A' }}</td>
                                            <td>{{ $penilaian->jobList->shift ?? 'N/A' }}</td>
                                            <td>{{ number_format($penilaian->jobList->bobot ?? 0, 2) }}%</td>
                                            <td>{{ number_format($penilaian->jobList->durasi_waktu ?? 0) }} menit</td>
                                            <td>{{ number_format($penilaian->nilai, 2) }}</td>
                                            <td>
                                                <a href="{{ route('penilaian.edit', $penilaian->id) }}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @elseif($activeTab == 'karyawan' && request()->has(['karyawan_id', 'start_date', 'end_date']))
                    <div class="alert alert-warning mt-4">
                        <i class="fas fa-exclamation-triangle"></i> Tidak ada data penilaian untuk karyawan ini pada periode yang dipilih.
                    </div>
                @endif
            </div>

            <div id="divisi" class="tab-panel {{ $activeTab == 'divisi' ? 'active' : '' }}">
                <div class="filter-form">
                    <h4><i class="fas fa-filter"></i> Filter Laporan per Divisi</h4>
                    <form action="{{ route('laporan.index') }}" method="GET">
                        <input type="hidden" name="tab" value="divisi">
                        <table>
                            <tr>
                                <td>
                                    <label for="divisi_id_div" class="form-label">Pilih Divisi</label>
                                </td>
                                <td>
                                    <select name="divisi_id" id="divisi_id_div" class="form-select w-100" required>
                                        <option value="">-- Pilih Divisi --</option>
                                        @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}"
                                                {{ request('divisi_id') == $division->id && $activeTab == 'divisi' ? 'selected' : '' }}>
                                                {{ $division->nama_divisi }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="start_date_div" class="form-label">Dari Tanggal</label></td>
                                <td>
                                    <input type="date" name="start_date" id="start_date_div" class="form-control"
                                        value="{{ request('start_date', date('Y-m-d')) }}" required>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="end_date_div" class="form-label">Sampai Tanggal</label></td>
                                <td>
                                    <input type="date" name="end_date" id="end_date_div" class="form-control"
                                        value="{{ request('end_date', date('Y-m-d')) }}" required>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <button type="submit" class="btn btn-tampilkan">
                                        <i class="fas fa-search"></i> Tampilkan Laporan
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>

                @if ($activeTab == 'divisi' && $reportData && $selectedDivisi)
                    <h3 class="mt-4"><i class="fas fa-building"></i> Ringkasan Divisi: {{ $selectedDivisi->nama_divisi }}</h3>
                    <div class="division-report-grid">
                        @forelse($reportData as $karyawanReport)
                            <div class="employee-summary-card">
                                <div class="employee-summary-header">
                                    <img src="{{ $karyawanReport['karyawan']->foto_profil ? Storage::url('karyawan/' . $karyawanReport['karyawan']->foto_profil) : 'https://via.placeholder.com/50' }}"
                                        alt="Foto">
                                    <div>
                                        <div class="name">{{ $karyawanReport['karyawan']->nama_lengkap }}</div>
                                        <small>{{ $karyawanReport['data']['predikat_kinerja'] }}</small>
                                    </div>
                                </div>
                                <div class="employee-summary-stats">
                                    <div class="stat-item">
                                        <div class="value">{{ number_format($karyawanReport['data']['skor_kinerja'], 2) }}</div>
                                        <div class="label">Skor</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="value">{{ number_format($karyawanReport['data']['beban_kerja'], 2) }}%</div>
                                        <div class="label">Beban</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="value">{{ number_format($karyawanReport['data']['total_durasi_jam'], 2) }}</div>
                                        <div class="label">Jam</div>
                                    </div>
                                </div>
                                <a href="{{ route('laporan.exportPdf', ['karyawan_id' => $karyawanReport['karyawan']->id, 'start_date' => $startDate->toDateString(), 'end_date' => $endDate->toDateString()]) }}"
                                    class="btn-export">
                                    <i class="fas fa-file-pdf"></i> Ekspor PDF
                                </a>
                            </div>
                        @empty
                            <div class="alert alert-warning">
                                <i class="fas fa-info-circle"></i> Tidak ada data penilaian untuk divisi ini pada periode yang dipilih.
                            </div>
                        @endforelse
                    </div>
                @elseif($activeTab == 'divisi' && request()->has(['divisi_id', 'start_date', 'end_date']))
                    <div class="alert alert-warning mt-4">
                        <i class="fas fa-exclamation-triangle"></i> Tidak ada data penilaian untuk divisi ini pada periode yang dipilih.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
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

            $('#divisi_id_div').select2({
                placeholder: "-- Pilih Divisi --",
                allowClear: true
            });
        });
    </script>
@endpush
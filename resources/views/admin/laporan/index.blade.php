@extends('layouts.admin')

@section('content')
    <style>
        .report-card {
            background-color: var(--card-bg);
            color: var(--text-dark);
            padding: 30px;
            border-radius: 15px;
        }

        .filter-card {
            margin-bottom: 25px;
        }

        .report-summary {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 20px;
        }

        .summary-box {
            background-color: #f9fafb;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        .summary-box .value {
            font-size: 2.5rem;
            font-weight: 700;
        }

        .summary-box .label {
            font-weight: 500;
            color: #555;
        }

        .summary-box .predicate {
            font-size: 1.1rem;
            font-weight: 600;
            margin-top: 8px;
            color: var(--accent-color);
        }

        .date-separator td {
            background-color: #f0f0f0;
            font-weight: bold;
            padding: 10px 15px;
            text-align: left !important;
        }
    </style>

    <h1>Laporan Kinerja Karyawan</h1>

    <div class="report-card filter-card">
        <h4>Filter Laporan</h4>
        <form action="{{ route('laporan.index') }}" method="GET">
            <div class="row">
                <div class="col-md-4">
                    <label for="karyawan_id">Pilih Karyawan</label>
                    <select name="karyawan_id" id="karyawan_id" class="form-select" required>
                        <option value="">-- Pilih Karyawan --</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}"
                                {{ request('karyawan_id') == $employee->id ? 'selected' : '' }}>
                                {{ $employee->nama_lengkap }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="start_date">Dari Tanggal</label>
                    <input type="date" name="start_date" id="start_date" class="form-control"
                        value="{{ request('start_date') }}" required>
                </div>
                <div class="col-md-3">
                    <label for="end_date">Sampai Tanggal</label>
                    <input type="date" name="end_date" id="end_date" class="form-control"
                        value="{{ request('end_date') }}" required>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Tampilkan</button>
                </div>
            </div>
        </form>
    </div>

    @if ($reportData)
        <div class="report-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3>Hasil Laporan Kinerja</h3>
                    <p>
                        <strong>{{ $selectedKaryawan->nama_lengkap }}</strong><br>
                        Periode: {{ $startDate->format('d M Y') }} - {{ $endDate->format('d M Y') }}
                    </p>
                </div>
                <a href="{{ route('laporan.exportPdf', request()->query()) }}" class="btn btn-danger"><i
                        class="fas fa-file-pdf"></i> Ekspor ke PDF</a>
            </div>

            <div class="report-summary">
                <div class="summary-box">
                    <div class="value">{{ $reportData['skor_kinerja'] }}</div>
                    <div class="label">Skor Kinerja Rata-Rata</div>
                    {{-- Tampilkan predikat di sini --}}
                    <p class="predicate">{{ $reportData['predikat_kinerja'] }}</p>
                </div>
                <div class="summary-box">
                    <div class="value">{{ $reportData['beban_kerja'] }}%</div>
                    <div class="label">Beban Kerja</div>
                </div>
            </div>

            <h4 class="mt-4">Detail Penilaian</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>Pekerjaan</th>
                        <th>Nilai</th>
                        <th>Bobot</th>
                        <th>Durasi</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Loop pertama untuk setiap tanggal --}}
                    @foreach ($reportData['penilaian'] as $tanggal => $penilaianHarian)
                        {{-- Ini adalah baris pembatas tanggal --}}
                        <tr class="date-separator">
                            <td colspan="5">
                                <i class="fas fa-calendar-alt"></i> &nbsp;
                                Penilaian Tanggal: {{ \Carbon\Carbon::parse($tanggal)->format('d F Y') }}
                            </td>
                        </tr>

                        {{-- Loop kedua untuk setiap item pekerjaan di tanggal tersebut --}}
                        @foreach ($penilaianHarian as $item)
                            <tr>
                                <td>{{ $item->jobList->nama_pekerjaan }}</td>
                                <td>{{ $item->nilai }}</td>
                                <td>{{ $item->jobList->bobot }}%</td>
                                <td>{{ $item->jobList->durasi_waktu }} menit</td>
                                <td>{{ $item->catatan_penilai }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    @elseif(request()->filled('karyawan_id'))
        <div class="report-card">
            <p class="text-center">Tidak ada data penilaian untuk karyawan dan periode yang dipilih.</p>
        </div>
    @endif

@endsection

@extends('layouts.admin')

@section('content')
    <style>
        /* Semua CSS dari sebelumnya tetap sama */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .page-header h1 {
            font-size: 1.8rem;
            margin: 0;
        }

        .btn-add-karyawan {
            background-color: #e3c322;
            color: var(--text-light);
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn-add-karyawan:hover {
            background-color: #ac9317;
            color: var(--text-light);
        }

        .table-container {
            background-color: var(--card-bg);
            color: var(--text-dark);
            padding: 25px;
            border-radius: 15px;
        }

        .filter-form {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
        }

        .search-box {
            position: relative;
            flex-grow: 1;
        }

        .search-box input {
            width: 100%;
            height: 42px;
            padding: 10px 15px 10px 40px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
        }

        .filter-form select {
            height: 42px;
            border-radius: 8px;
            border: 1px solid #ddd;
            min-width: 200px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border-bottom: 1px solid #eee;
            padding: 15px;
            font-size: 14px;
            vertical-align: middle;
        }

        .table th {
            border-bottom-width: 2px;
            border-bottom-color: #ddd;
            text-align: left;
            font-weight: 600;
            color: #555;
        }

        .table tbody tr:hover {
            background-color: #f7f7f7;
        }

        .table th.text-center,
        .table td.text-center {
            text-align: center;
        }

        .status-badge {
            color: white;
            padding: 5px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            justify-content: center;
        }

        .action-buttons form {
            margin: 0;
            padding: 0;
            display: contents;
        }

        .btn-action {
            padding: 6px 0;
            border-radius: 6px;
            color: white;
            text-decoration: none;
            font-size: 12px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            display: inline-block;
            text-align: center;
            width: 75px;
            transition: background-color 0.2s ease-in-out;
        }

        .btn-info {
            background-color: #3B82F6;
        }

        .btn-danger {
            background-color: #EF4444;
        }

        .btn-success {
            background-color: #22C55E;
        }

        .btn-info:hover {
            background-color: #2563EB;
        }

        .btn-danger:hover {
            background-color: #DC2626;
        }

        .btn-success:hover {
            background-color: #16A34A;
        }

        .btn-job {
            padding: 6px 15px;
            border-radius: 6px;
            color: white;
            text-decoration: none;
            font-size: 12px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        .btn-job-tetap {
            background-color: #22C55E;
            /* Hijau */
        }

        .btn-job-opsional {
            background-color: #3B82F6;
            /* Biru */
        }

        .btn-job-tetap:hover {
            background-color: #16A34A;
        }

        .btn-job-opsional:hover {
            background-color: #2563EB;
        }
    </style>

    <div class="page-header">
        <h1>Manajemen Job Karyawan</h1>
        <a href="{{ route('karyawan.create') }}" class="btn-add-karyawan">+ Add Karyawan</a>
    </div>

    <div class="table-container">
        <form action="{{ route('karyawan.index') }}" method="GET" class="filter-form">
            {{-- Form filter sama seperti sebelumnya --}}
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" name="search" placeholder="Cari nama atau NIP karyawan..."
                    value="{{ request('search') }}">
            </div>
            <select name="divisi_id" class="form-select" onchange="this.form.submit()">
                <option value="">Semua Divisi</option>
                @foreach ($divisi as $d)
                    <option value="{{ $d->id }}" {{ request('divisi_id') == $d->id ? 'selected' : '' }}>
                        {{ $d->nama_divisi }}</option>
                @endforeach
            </select>
        </form>

        <table class="table">
            <thead>
                {{-- Header tabel sama seperti sebelumnya --}}
                <tr>
                    <th>NIP</th>
                    <th>NAMA</th>
                    <th>DIVISI</th>
                    <th class="text-center">STATUS</th>
                    <th class="text-center">PROFIL</th>
                    <th class="text-center">JOBLIST</th>
                </tr>
            </thead>
            <tbody>
                @forelse($karyawan as $k)
                    <tr>
                        <td>{{ $k->nip }}</td>
                        <td>{{ $k->nama_lengkap }}</td>
                        <td>{{ $k->divisi->nama_divisi }}</td>
                        <td class="text-center">
                            <span class="status-badge"
                                style="background-color: {{ $k->status_karyawan == 'Aktif' ? '#22C55E' : ($k->status_karyawan == 'Cuti' ? '#F59E0B' : '#EF4444') }};">
                                {{ $k->status_karyawan }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="action-buttons">
                                <a href="{{ route('karyawan.show', $k->id) }}" class="btn-action btn-info">Info</a>

                                <form id="delete-form-{{ $k->id }}"
                                    action="{{ route('karyawan.destroy', $k->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    {{-- Tombol diubah menjadi type="button" dan memanggil fungsi JS --}}
                                    <button type="button" class="btn-action btn-danger"
                                        onclick="deleteConfirmation({{ $k->id }})">Hapus</button>
                                </form>

                            </div>
                        </td>
                        <td class="text-center">
                            <div class="action-buttons">
                                <a href="{{ route('job.tetap', $k->id) }}" class="btn-job btn-job-tetap">Job Tetap</a>
                                <a href="{{ route('job.opsional', $k->id) }}" class="btn-job btn-job-opsional">Job
                                    Opsional</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 20px;">Data Karyawan tidak ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            {{ $karyawan->appends(request()->query())->links() }}
        </div>
    </div>
@endsection


@push('scripts')
    {{-- 1. Memanggil library SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // 2. Fungsi untuk menampilkan popup konfirmasi
        function deleteConfirmation(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data karyawan ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EF4444', // Merah
                cancelButtonColor: '#6B7280', // Abu-abu
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                // 3. Jika user menekan "Ya, Hapus!"
                if (result.isConfirmed) {
                    // Cari form berdasarkan id dan submit
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
@endpush

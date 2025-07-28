@extends('layouts.admin')

@section('content')
    {{-- Style sama persis dengan tetap.blade.php, bisa disatukan di file CSS utama nanti --}}
    <style>
        .employee-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
        }

        .employee-header img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
        }

        .employee-info p {
            margin: 0;
            line-height: 1.5;
            color: var(--text-light);
        }

        .employee-info p .label {
            font-weight: 600;
        }

        .btn-back {
            background-color: var(--accent-color);
            color: var(--text-light);
            padding: 8px 15px;
            margin-bottom: 26px;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .form-card {
            background-color: var(--card-bg);
            color: var(--text-dark);
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 25px;
        }

        .form-card h3 {
            margin-top: 0;
        }

        .add-job-form {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px 20px;
            align-items: flex-end;
        }

        .form-group {
            width: 100%;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .btn-add {
            background-color: var(--accent-color);
            color: var(--text-light);
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            cursor: pointer;
        }

        .joblist-card {
            background-color: var(--card-bg);
            color: var(--text-dark);
            padding: 25px;
            border-radius: 15px;
        }

        .joblist-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .joblist-header h3 {
            margin: 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
        }

        .table thead th {
            background-color: #f9fafb;
            font-weight: 600;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .btn-table {
            padding: 5px 15px;
            border-radius: 6px;
            color: white;
            text-decoration: none;
            font-size: 13px;
            border: none;
            cursor: pointer;
        }

        .btn-edit {
            background-color: #3B82F6;
        }

        .btn-delete {
            background-color: #EF4444;
        }
    </style>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('karyawan.index') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>
        <div class="employee-header m-0">
            <img src="{{ $karyawan->foto_profil ? Storage::url('karyawan/' . $karyawan->foto_profil) : 'https://via.placeholder.com/60' }}"
                alt="Foto">
            <div class="employee-info">
                <p><span class="label">Nama:</span> {{ $karyawan->nama_lengkap }}</p>
                <p><span class="label">NIP:</span> {{ $karyawan->nip }}</p>
                <p><span class="label">Divisi:</span> {{ $karyawan->divisi->nama_divisi }}</p>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success mb-3">{{ session('success') }}</div>
    @endif

    <div class="form-card">
        <h3>Tambah Pekerjaan Opsional</h3>
        <form action="{{ route('job.store', $karyawan->id) }}" method="POST">
            @csrf
            <input type="hidden" name="tipe_job" value="Opsional">
            <div class="add-job-form">
                <div class="form-group" style="grid-column: 1 / 3;">
                    <label for="nama_pekerjaan">Nama Pekerjaan *</label>
                    <input type="text" id="nama_pekerjaan" name="nama_pekerjaan" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="bobot">Bobot (1-100%) *</label>
                    <input type="number" id="bobot" name="bobot" class="form-control" placeholder="1-100 %" required>
                </div>
                <div class="form-group">
                    <label for="durasi_waktu">Durasi *</label>
                    <input type="number" id="durasi_waktu" name="durasi_waktu" class="form-control" placeholder="Menit"
                        required>
                </div>
                <div class="form-group" style="grid-column: 1 / 3;">
                    <button type="submit" class="btn-add">+ Add</button>
                </div>
            </div>
        </form>
    </div>

    <div class="joblist-card">
        <div class="joblist-header">
            <h3>Daftar Job Opsional</h3>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th>Pekerjaan</th>
                    <th>Bobot</th>
                    <th>Durasi (Menit)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jobLists as $job)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $job->nama_pekerjaan }}</td>
                        <td>{{ $job->bobot }}%</td>
                        <td>{{ $job->durasi_waktu }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('job.edit', $job->id) }}" class="btn-table btn-edit">Edit</a>
                                <button type="button" class="btn-table btn-delete"
                                    onclick="deleteConfirmation({{ $job->id }})">Hapus</button>
                                <form id="delete-form-{{ $job->id }}" action="{{ route('job.destroy', $job->id) }}"
                                    method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada job opsional yang ditambahkan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deleteConfirmation(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Pekerjaan ini akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EF4444',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
@endpush

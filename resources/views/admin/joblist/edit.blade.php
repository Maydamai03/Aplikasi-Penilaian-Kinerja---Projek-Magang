@extends('layouts.admin')

@section('content')
    <style>
        /* Anda bisa menggunakan style yang sama persis dengan halaman create/tetap/opsional */
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

        .btn-update {
            background-color: #3B82F6;
            color: white;
            padding: 10px 25px;
            margin-top: 20px;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            cursor: pointer;
        }
    </style>

    <div class="d-flex justify-content-between align-items-center mb-4">
        {{-- Tombol kembali akan mengarah ke halaman yang sesuai (tetap/opsional) --}}
        @php
            $backRoute =
                $joblist->tipe_job == 'Tetap'
                    ? route('job.tetap', $joblist->karyawan_id)
                    : route('job.opsional', $joblist->karyawan_id);
        @endphp
        <a href="{{ $backRoute }}" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>

        <div class="employee-header m-0">
            <img src="{{ $karyawan->foto_profil ? Storage::url('karyawan/' . $karyawan->foto_profil) : 'https://via.placeholder.com/60' }}"
                alt="Foto">
            <div class="employee-info">
                <p><span class="label">Nama:</span> {{ $karyawan->nama_lengkap }}</p>
                <p><span class="label">NIP:</span> {{ $karyawan->nip }}</p>
            </div>
        </div>
    </div>

    <div class="form-card">
        <h3>Edit Pekerjaan {{ $joblist->tipe_job }}</h3>

        <form action="{{ route('job.update', $joblist->id) }}" method="POST">
            @csrf
            @method('PATCH') {{-- Method untuk update --}}

            <div class="row mt-4">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Pekerjaan *</label>
                    {{-- Isi value dengan data yang ada --}}
                    <input type="text" name="nama_pekerjaan" class="form-control"
                        value="{{ old('nama_pekerjaan', $joblist->nama_pekerjaan) }}" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Bobot *</label>
                    <input type="number" name="bobot" class="form-control" value="{{ old('bobot', $joblist->bobot) }}"
                        required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Durasi (menit) *</label>
                    <input type="number" name="durasi_waktu" class="form-control"
                        value="{{ old('durasi_waktu', $joblist->durasi_waktu) }}" required>
                </div>
            </div>
            <button type="submit" class="btn-update">Update Pekerjaan</button>
        </form>
    </div>
@endsection

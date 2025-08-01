@extends('layouts.admin')

@section('content')
    <style>
        /* Menggunakan style yang sama dengan halaman kelola joblist */
        .btn-back {
            background-color: var(--accent-color);
            color: var(--text-light);
            padding: 8px 15px;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .form-card {
            background: white;
            color: #1f2937;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            margin-top: 20px
        }

        .form-header {
            margin-bottom: 25px;
        }

        .form-header h1 {
            font-weight: 700;
            margin: 0;
        }

        .form-header p {
            color: #6b7280;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }

        .form-control {
            width: 100%;
            height: 48px;
            padding: 0 15px;
            border-radius: 10px;
            border: 1px solid #ddd;
        }

        .form-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 30px;
        }

        .btn-submit {
            background-color: #3B82F6;
            color: white;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }

        .employee-header {
            display: flex;
            align-items: center;
            gap: 15px;
            color: var(--text-light);
        }

        .employee-header img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .employee-info p {
            margin: 0;
            line-height: 1.4;
        }

        .employee-info .nama {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .employee-info .detail {
            font-size: 0.9rem;
            color: #ccc;
        }
    </style>

    {{-- <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('job.tetap', $karyawan->id) }}" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>

        <div class="employee-header m-0">
            <img src="{{ $karyawan->foto_profil ? Storage::url('karyawan/' . $karyawan->foto_profil) : 'https://via.placeholder.com/60' }}"
                alt="Foto">
            <div class="employee-info">
                <p class="nama">{{ $karyawan->nama_lengkap }}</p>
                <p class="detail">{{ $karyawan->nip }} | {{ $karyawan->divisi->nama_divisi }}</p>
            </div>
        </div>
    </div> --}}
    <a href="{{ route('job.tetap', $karyawan->id) }}" class="btn-back"><i class="fas fa-arrow-left "></i> Kembali</a>


    <div class="form-card">
        <div class="form-header">
            <h1>Edit Pekerjaan (Shift {{ $joblist->shift }})</h1>
        </div>

        <form action="{{ route('job.update', $joblist->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="row mt-4">
                <div class="col-md-8 mb-3">
                    <div class="form-group">
                        <label for="nama_pekerjaan">Nama Pekerjaan *</label>
                        <input type="text" name="nama_pekerjaan" class="form-control"
                            value="{{ old('nama_pekerjaan', $joblist->nama_pekerjaan) }}" required>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-group">
                        <label for="durasi_waktu">Durasi (menit) *</label>
                        <input type="number" name="durasi_waktu" class="form-control"
                            value="{{ old('durasi_waktu', $joblist->durasi_waktu) }}" required>
                    </div>
                </div>
            </div>
            <div class="form-buttons">
                <button type="submit" class="btn-submit">Update Pekerjaan</button>
            </div>
        </form>
    </div>
@endsection

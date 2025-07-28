@extends('layouts.admin')

@section('content')
    <style>
        .detail-card {
            background-color: var(--card-bg);
            color: var(--text-dark);
            padding: 30px;
            border-radius: 15px;
        }

        .detail-header {
            padding: 20px;
            border-radius: 15px 15px 0 0;
            margin: -30px -30px 30px -30px;
            background: linear-gradient(to right, #ffd700, #f0c419);
            color: #333;
        }

        .profile-sidebar {
            text-align: center;
        }

        .profile-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .profile-name {
            font-size: 1.5rem;
            font-weight: 700;
            margin-top: 15px;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 15px;
            border-radius: 15px;
            font-weight: 500;
            color: white;
            margin-top: 10px;
        }

        .detail-list {
            list-style: none;
            padding: 0;
        }

        .detail-list li {
            display: flex;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }

        .detail-list li .label {
            font-weight: 600;
            width: 150px;
            color: #555;
        }

        .detail-list li .value {
            flex: 1;
        }

        .detail-actions {
            margin-top: 30px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn-form {
            padding: 10px 25px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-edit {
            background-color: #3B82F6;
            color: white;
        }

        .btn-back {
            background-color: #E5E7EB;
            color: #374151;
        }

        .status-update-form {
            margin-top: 20px;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }

        .status-update-form .form-group {
            display: flex;
            gap: 10px;
        }

        .status-update-form select {
            flex: 1;
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 0 10px;
        }

        .status-update-form button {
            background-color: #1e1e1e;
            color: white;
            font-weight: 500;
        }
    </style>

    <h1 style="font-size: 1.8rem;">Data Karyawan</h1>

    <div class="detail-card mt-4">
        <div class="detail-header">
            <h3 style="margin: 0; font-weight:700;">Informasi Karyawan</h3>
            <p style="margin: 5px 0 0 0;">Detail lengkap data karyawan</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            <div class="col-md-4 profile-sidebar">
                <img src="{{ $karyawan->foto_profil ? Storage::url('karyawan/' . $karyawan->foto_profil) : 'https://via.placeholder.com/150' }}"
                    alt="Foto Profil" class="profile-img">
                <h4 class="profile-name">{{ $karyawan->nama_lengkap }}</h4>
                <span class="status-badge"
                    style="background-color: {{ $karyawan->status_karyawan == 'Aktif' ? '#22C55E' : ($karyawan->status_karyawan == 'Cuti' ? '#F59E0B' : '#EF4444') }};">
                    {{ $karyawan->status_karyawan }}
                </span>
                {{-- Form untuk ubah status  --}}
                <div class="status-update-form">
                    <form action="{{ route('karyawan.updateStatus', $karyawan->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <label class="mb-2 d-block" style="font-weight: 600;">Ubah Status:</label>
                        <div class="form-group">
                            <select name="status_karyawan" class="form-control">
                                <option value="Aktif" {{ $karyawan->status_karyawan == 'Aktif' ? 'selected' : '' }}>Aktif
                                </option>
                                <option value="Cuti" {{ $karyawan->status_karyawan == 'Cuti' ? 'selected' : '' }}>Cuti
                                </option>
                                <option value="Resign" {{ $karyawan->status_karyawan == 'Resign' ? 'selected' : '' }}>Resign
                                </option>
                            </select>
                            <button type="submit" class="btn-form">Update</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <ul class="detail-list">
                    <li>
                        <span class="label">NIP</span>
                        <span class="value">: {{ $karyawan->nip }}</span>
                    </li>
                    <li>
                        <span class="label">Nama Lengkap</span>
                        <span class="value">: {{ $karyawan->nama_lengkap }}</span>
                    </li>
                    <li>
                        <span class="label">Divisi</span>
                        <span class="value">: {{ $karyawan->divisi->nama_divisi }}</span>
                    </li>
                    <li>
                        <span class="label">Nomor Telepon</span>
                        <span class="value">: {{ $karyawan->nomor_telepon }}</span>
                    </li>
                    <li>
                        <span class="label">Email</span>
                        <span class="value">: {{ $karyawan->email }}</span>
                    </li>
                    <li>
                        <span class="label">Alamat</span>
                        <span class="value">: {{ $karyawan->alamat }}</span>
                    </li>
                    <li>
                        <span class="label">Tanggal Bergabung</span>
                        <span class="value">:
                            {{ \Carbon\Carbon::parse($karyawan->tanggal_masuk)->format('d F Y') }}</span>
                    </li>
                    <li>
                        <span class="label">Status</span>
                        <span class="value">: {{ $karyawan->status_karyawan }}</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="detail-actions">
            <a href="{{ route('karyawan.index') }}" class="btn-form btn-back">Kembali</a>
            <a href="{{ route('karyawan.edit', $karyawan->id) }}" class="btn-form btn-edit">Edit Profil</a>
        </div>
    </div>
@endsection

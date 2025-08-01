@extends('layouts.admin')

@section('content')
<style>
    .btn-back {
        background-color: var(--accent-color); color: var(--text-light); padding: 8px 15px;
        border-radius: 8px; font-weight: 500; text-decoration: none; display: inline-flex;
        align-items: center; gap: 8px; margin-bottom: 25px; transition: background-color 0.3s;
    }
    .btn-back:hover { background-color: #6d0000; }

    /* Kartu Utama */
    .detail-container {
        background: white;
        color: #1f2937;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    }
    /* Header di dalam kartu */
    .detail-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 20px;
        margin-bottom: 25px;
        border-bottom: 1px solid #e9ecef;
    }
    .detail-header h3 {
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .header-actions { display: flex; gap: 10px; }
    .btn-action { text-decoration: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; transition: all 0.3s; }
    .btn-edit { background-color: #3B82F6; color: white; }
    .btn-edit:hover { background-color: #2563EB; transform: translateY(-2px); }

    /* Konten Detail */
    .detail-body {
        display: flex;
        gap: 40px;
    }
    /* Sidebar Profil Kiri */
    .profile-sidebar {
        flex: 0 0 200px; /* Lebar tetap 200px */
        text-align: center;
    }
    .profile-img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid #fff;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        margin-bottom: 15px;
    }
    .profile-name { font-size: 1.4rem; font-weight: 700; margin-bottom: 5px; }
    .profile-nip { font-size: 0.9rem; color: #6b7280; margin-bottom: 15px; }
    .status-badge { display: inline-block; padding: 6px 15px; border-radius: 999px; font-weight: 500; color: white; }

    /* Form Update Status */
    .status-update-form {
        margin-top: 20px;
        text-align: left;
        background-color: #f9fafb;
        padding: 15px;
        border-radius: 10px;
    }
    .status-update-form label { font-weight: 600; font-size: 0.9rem; margin-bottom: 8px; display: block; }
    .status-update-form .form-select { width: 100%; height: 40px; border-radius: 8px; border: 1px solid #ddd; }
    .btn-update-status { width: 100%; margin-top: 10px; background-color: #1f2937; color: white; border: none; padding: 8px; border-radius: 8px; cursor: pointer; }

    /* Panel Detail Kanan */
    .profile-details { flex: 1; }
    .detail-list { list-style: none; padding: 0; margin: 0; }
    .detail-item {
        display: flex;
        padding: 15px 0;
        border-bottom: 1px solid #f3f4f6;
    }
    .detail-item .label {
        font-weight: 600;
        width: 150px;
        color: #4b5563;
        flex-shrink: 0;
    }
    .detail-item .value {
        font-weight: 500;
    }
</style>

<a href="{{ route('karyawan.index') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali ke Daftar</a>

@if(session('success'))
    <div class="alert alert-success mb-3">{{ session('success') }}</div>
@endif

<div class="detail-container">
    <div class="detail-header">
        <h3><i class="fas fa-user-circle"></i> Informasi Karyawan</h3>
        <div class="header-actions">
            <a href="{{ route('karyawan.edit', $karyawan->id) }}" class="btn-action btn-edit">Edit Profil</a>
        </div>
    </div>

    <div class="detail-body">
        <div class="profile-sidebar">
            <img src="{{ $karyawan->foto_profil ? Storage::url('karyawan/' . $karyawan->foto_profil) : 'https://via.placeholder.com/150' }}" alt="Foto Profil" class="profile-img">
            <h4 class="profile-name">{{ $karyawan->nama_lengkap }}</h4>
            <p class="profile-nip">{{ $karyawan->nip }}</p>
            <span class="status-badge" style="background-color: {{ $karyawan->status_karyawan == 'Aktif' ? '#22C55E' : ($karyawan->status_karyawan == 'Cuti' ? '#F59E0B' : '#EF4444') }};">
                {{ $karyawan->status_karyawan }}
            </span>

            <div class="status-update-form">
                <form action="{{ route('karyawan.updateStatus', $karyawan->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <label for="status_karyawan">Ubah Status:</label>
                    <select name="status_karyawan" id="status_karyawan" class="form-select">
                        <option value="Aktif" {{ $karyawan->status_karyawan == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Cuti" {{ $karyawan->status_karyawan == 'Cuti' ? 'selected' : '' }}>Cuti</option>
                        <option value="Resign" {{ $karyawan->status_karyawan == 'Resign' ? 'selected' : '' }}>Resign</option>
                    </select>
                    <button type="submit" class="btn-update-status">Update</button>
                </form>
            </div>
        </div>

        <div class="profile-details">
            <ul class="detail-list">
                <li class="detail-item">
                    <span class="label">Divisi</span>
                    <span class="value">: {{ $karyawan->divisi->nama_divisi }}</span>
                </li>
                <li class="detail-item">
                    <span class="label">Nomor Telepon</span>
                    <span class="value">: {{ $karyawan->nomor_telepon }}</span>
                </li>
                <li class="detail-item">
                    <span class="label">Email</span>
                    <span class="value">: {{ $karyawan->email }}</span>
                </li>
                <li class="detail-item">
                    <span class="label">Tanggal Bergabung</span>
                    <span class="value">: {{ \Carbon\Carbon::parse($karyawan->tanggal_masuk)->format('d F Y') }}</span>
                </li>
                <li class="detail-item">
                    <span class="label">Alamat</span>
                    <span class="value">: {{ $karyawan->alamat }}</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection

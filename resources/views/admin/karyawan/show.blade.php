@extends('layouts.admin')

@section('content')
    <style>
        /* Page Header */
        .page-header {
            margin-bottom: 30px;
            position: relative;
        }
        
        .page-header::before {
            content: '';
            position: absolute;
            top: -10px;
            left: -20px;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, #ffd700, #ff6b35);
            border-radius: 2px;
        }
        
        .page-header h1 {
            font-size: 2.2rem;
            color: #ffffff !important;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
            margin: 0;
        }

        .detail-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            color: #1f2937 !important;
            padding: 30px;
            border-radius: 20px;
            border: 1px solid #e9ecef;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .detail-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ffd700, #ff6b35);
        }

        .detail-header {
            padding: 25px;
            border-radius: 15px;
            margin: -30px -30px 30px -30px;
            background: linear-gradient(135deg, #ffd700 0%, #ff9500 100%);
            color: #1f2937 !important;
            position: relative;
            overflow: hidden;
        }
        
        .detail-header::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .detail-header h3 {
            margin: 0 !important;
            font-weight: 800 !important;
            font-size: 1.6rem;
            color: #1f2937 !important;
        }

        .detail-header p {
            margin: 8px 0 0 0 !important;
            color: #374151 !important;
            font-weight: 500;
        }

        .profile-sidebar {
            text-align: center;
            position: relative;
        }

        .profile-img-wrapper {
            position: relative;
            display: inline-block;
            margin-bottom: 20px;
        }

        .profile-img {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            object-fit: cover;
            border: 6px solid #ffffff;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            transition: transform 0.3s ease;
        }

        .profile-img:hover {
            transform: scale(1.05);
        }

        .profile-img-wrapper::after {
            content: '';
            position: absolute;
            top: -10px;
            left: -10px;
            right: -10px;
            bottom: -10px;
            border: 2px solid #ffd700;
            border-radius: 50%;
            opacity: 0.3;
        }

        .profile-name {
            font-size: 1.6rem !important;
            font-weight: 800 !important;
            margin-top: 15px;
            color: #1f2937 !important;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: 600;
            color: white !important;
            margin-top: 12px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .detail-list {
            list-style: none;
            padding: 0;
        }

        .detail-list li {
            display: flex;
            padding: 16px 0;
            border-bottom: 1px solid #e5e7eb;
            transition: background-color 0.2s ease;
        }
        
        .detail-list li:hover {
            background-color: rgba(255, 215, 0, 0.05);
            margin: 0 -15px;
            padding-left: 15px;
            padding-right: 15px;
            border-radius: 8px;
        }

        .detail-list li:last-child {
            border-bottom: none;
        }

        .detail-list li .label {
            font-weight: 700;
            width: 180px;
            color: #374151 !important;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .detail-list li .label::before {
            content: '';
            width: 4px;
            height: 4px;
            background: #ffd700;
            border-radius: 50%;
        }

        .detail-list li .value {
            flex: 1;
            color: #1f2937 !important;
            font-weight: 500;
        }

        .detail-actions {
            margin-top: 40px;
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn-form {
            padding: 14px 28px;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 0.95rem;
            position: relative;
            overflow: hidden;
        }

        .btn-form::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-form:hover::before {
            left: 100%;
        }

        .btn-edit {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white !important;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .btn-edit:hover {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
        }

        .btn-back {
            background: linear-gradient(135deg, #6b7280, #4b5563);
            color: white !important;
            box-shadow: 0 4px 15px rgba(107, 114, 128, 0.3);
        }

        .btn-back:hover {
            background: linear-gradient(135deg, #4b5563, #374151);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(107, 114, 128, 0.4);
        }

        .status-update-form {
            margin-top: 30px;
            border-top: 2px solid #f3f4f6;
            padding-top: 25px;
            background: rgba(255, 215, 0, 0.05);
            padding: 25px 20px 20px 20px;
            border-radius: 12px;
            margin-left: -20px;
            margin-right: -20px;
        }

        .status-update-form label {
            font-weight: 700 !important;
            color: #374151 !important;
            font-size: 1rem;
            margin-bottom: 12px !important;
        }

        .status-update-form .form-group {
            display: flex;
            gap: 12px;
            align-items: stretch;
        }

        .status-update-form select {
            flex: 1;
            border-radius: 10px;
            border: 2px solid #e5e7eb;
            padding: 12px 16px;
            font-weight: 500;
            color: #1f2937 !important;
            background: white;
            transition: all 0.3s ease;
        }

        .status-update-form select:focus {
            border-color: #ffd700;
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.1);
            outline: none;
        }

        .status-update-form button {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: white !important;
            font-weight: 700;
            padding: 12px 24px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.3);
            position: relative;
            overflow: hidden;
        }

        .status-update-form button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .status-update-form button:hover::before {
            left: 100%;
        }

        .status-update-form button:hover {
            background: linear-gradient(135deg, #b91c1c, #991b1b);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(220, 38, 38, 0.4);
        }

        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            border: none;
            font-weight: 600;
        }

        .alert-success {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            color: #065f46 !important;
            border-left: 4px solid #10b981;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .detail-card {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .detail-actions {
                justify-content: center;
            }
            
            .btn-form {
                flex: 1;
                justify-content: center;
                min-width: 120px;
            }
            
            .status-update-form .form-group {
                flex-direction: column;
                gap: 15px;
            }
            
            .detail-list li {
                flex-direction: column;
                gap: 5px;
            }
            
            .detail-list li .label {
                width: auto;
                font-size: 0.9rem;
            }
        }
    </style>

    <div class="page-header">
        <h1>Data Karyawan</h1>
    </div>

    <div class="detail-card mt-4">
        <div class="detail-header">
            <h3>Informasi Karyawan</h3>
            <p>Detail lengkap data karyawan</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle" style="margin-right: 8px;"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-4 profile-sidebar">
                <div class="profile-img-wrapper">
                    <img src="{{ $karyawan->foto_profil ? Storage::url('karyawan/' . $karyawan->foto_profil) : 'https://via.placeholder.com/160' }}"
                        alt="Foto Profil" class="profile-img">
                </div>
                <h4 class="profile-name">{{ $karyawan->nama_lengkap }}</h4>
                <span class="status-badge"
                    style="background-color: {{ $karyawan->status_karyawan == 'Aktif' ? '#22C55E' : ($karyawan->status_karyawan == 'Cuti' ? '#F59E0B' : '#EF4444') }};">
                    <i class="fas fa-{{ $karyawan->status_karyawan == 'Aktif' ? 'check' : ($karyawan->status_karyawan == 'Cuti' ? 'clock' : 'times') }}" style="margin-right: 6px;"></i>
                    {{ $karyawan->status_karyawan }}
                </span>
                
                <div class="status-update-form">
                    <form action="{{ route('karyawan.updateStatus', $karyawan->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <label class="mb-2 d-block">
                            <i class="fas fa-edit" style="margin-right: 6px;"></i>
                            Ubah Status:
                        </label>
                        <div class="form-group">
                            <select name="status_karyawan" class="form-control">
                                <option value="Aktif" {{ $karyawan->status_karyawan == 'Aktif' ? 'selected' : '' }}>
                                    <i class="fas fa-check"></i> Aktif
                                </option>
                                <option value="Cuti" {{ $karyawan->status_karyawan == 'Cuti' ? 'selected' : '' }}>
                                    <i class="fas fa-clock"></i> Cuti
                                </option>
                                <option value="Resign" {{ $karyawan->status_karyawan == 'Resign' ? 'selected' : '' }}>
                                    <i class="fas fa-times"></i> Resign
                                </option>
                            </select>
                            <button type="submit">
                                <i class="fas fa-save" style="margin-right: 6px;"></i>
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <ul class="detail-list">
                    <li>
                        <span class="label">
                            <i class="fas fa-id-card" style="color: #ffd700; margin-right: 6px;"></i>
                            NIP
                        </span>
                        <span class="value">: {{ $karyawan->nip }}</span>
                    </li>
                    <li>
                        <span class="label">
                            <i class="fas fa-user" style="color: #ffd700; margin-right: 6px;"></i>
                            Nama Lengkap
                        </span>
                        <span class="value">: {{ $karyawan->nama_lengkap }}</span>
                    </li>
                    <li>
                        <span class="label">
                            <i class="fas fa-building" style="color: #ffd700; margin-right: 6px;"></i>
                            Divisi
                        </span>
                        <span class="value">: {{ $karyawan->divisi->nama_divisi }}</span>
                    </li>
                    <li>
                        <span class="label">
                            <i class="fas fa-phone" style="color: #ffd700; margin-right: 6px;"></i>
                            Nomor Telepon
                        </span>
                        <span class="value">: {{ $karyawan->nomor_telepon }}</span>
                    </li>
                    <li>
                        <span class="label">
                            <i class="fas fa-envelope" style="color: #ffd700; margin-right: 6px;"></i>
                            Email
                        </span>
                        <span class="value">: {{ $karyawan->email }}</span>
                    </li>
                    <li>
                        <span class="label">
                            <i class="fas fa-map-marker-alt" style="color: #ffd700; margin-right: 6px;"></i>
                            Alamat
                        </span>
                        <span class="value">: {{ $karyawan->alamat }}</span>
                    </li>
                    <li>
                        <span class="label">
                            <i class="fas fa-calendar-alt" style="color: #ffd700; margin-right: 6px;"></i>
                            Tanggal Bergabung
                        </span>
                        <span class="value">:
                            {{ \Carbon\Carbon::parse($karyawan->tanggal_masuk)->format('d F Y') }}</span>
                    </li>
                    <li>
                        <span class="label">
                            <i class="fas fa-info-circle" style="color: #ffd700; margin-right: 6px;"></i>
                            Status
                        </span>
                        <span class="value">: {{ $karyawan->status_karyawan }}</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="detail-actions">
            <a href="{{ route('karyawan.index') }}" class="btn-form btn-back">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
            <a href="{{ route('karyawan.edit', $karyawan->id) }}" class="btn-form btn-edit">
                <i class="fas fa-edit"></i>
                Edit Profil
            </a>
        </div>
    </div>
@endsection
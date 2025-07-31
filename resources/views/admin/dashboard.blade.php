@extends('layouts.admin')

@section('content')
<style>
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
        color: #ffffff !important;
        font-weight: 700;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .dashboard-header p {
        font-size: 1.1rem;
        color: #d1d5db !important;
        margin-top: 8px;
        font-weight: 400;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
        margin-top: 40px;
    }

    .stat-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        color: #1f2937 !important;
        padding: 30px;
        border-radius: 20px;
        border: 1px solid #e9ecef;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #ffd700, #ff6b35);
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        border-color: #ffd700;
    }

    .stat-card:nth-child(1) .icon-wrapper {
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
    }

    .stat-card:nth-child(2) .icon-wrapper {
        background: linear-gradient(135deg, #dc2626, #ef4444);
    }

    .stat-card:nth-child(3) .icon-wrapper {
        background: linear-gradient(135deg, #f59e0b, #ff6b35);
    }

    .stat-card:nth-child(4) .icon-wrapper {
        background: linear-gradient(135deg, #059669, #10b981);
    }

    .icon-wrapper {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        transition: transform 0.3s ease;
    }

    .stat-card:hover .icon-wrapper {
        transform: scale(1.1) rotate(5deg);
    }

    .stat-card i {
        font-size: 1.8rem;
        color: white;
        margin: 0;
    }

    .stat-card .number {
        font-size: 3rem;
        font-weight: 800;
        margin: 15px 0 8px 0;
        color: #1f2937 !important;
        line-height: 1;
    }

    .stat-card .description {
        font-size: 1.1rem;
        font-weight: 600;
        color: #6b7280 !important;
        margin: 0;
    }

    .btn-main {
        background: linear-gradient(135deg, #dc2626, #b91c1c);
        color: white;
        padding: 18px 35px;
        border: none;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1.1rem;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        margin-top: 50px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 15px rgba(220, 38, 38, 0.3);
        position: relative;
        overflow: hidden;
    }

    .btn-main::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn-main:hover::before {
        left: 100%;
    }

    .btn-main:hover {
        background: linear-gradient(135deg, #b91c1c, #991b1b);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(220, 38, 38, 0.4);
    }

    .btn-main:active {
        transform: translateY(0);
    }

    .stats-container {
        position: relative;
    }

    .stats-container::after {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(255, 215, 0, 0.05) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    .floating-element {
        animation: float 3s ease-in-out infinite;
    }

    .pulse-effect {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.7;
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .dashboard-header h1 {
            font-size: 1.8rem;
        }

        .stat-card .number {
            font-size: 2.5rem;
        }
    }
</style>

<div class="dashboard-header floating-element">
    <h1>Dashboard Admin</h1>
    <p>Ringkasan umum aktivitas dan data karyawan.</p>
</div>

<div class="stats-container">
    <div class="stats-grid">
        <div class="stat-card">
            <div class="icon-wrapper">
                <i class="fas fa-users"></i>
            </div>
            <p class="number">{{ $totalKaryawanAktif }}</p>
            <p class="description">Total Karyawan Aktif</p>
        </div>
        <div class="stat-card">
            <div class="icon-wrapper">
                <i class="fas fa-briefcase"></i>
            </div>
            <p class="number">{{ $totalJobTetap }}</p>
            <p class="description">Total Job Tetap</p>
        </div>
        <div class="stat-card">
            <div class="icon-wrapper">
                <i class="fas fa-tasks"></i>
            </div>
            <p class="number">{{ $totalJobOpsional }}</p>
            <p class="description">Total Job Opsional</p>
        </div>
        <div class="stat-card">
            <div class="icon-wrapper">
                <i class="fas fa-clock"></i>
            </div>
            <p class="number">{{ $totalJamBulanIni }} <span style="font-size: 1.8rem; font-weight: 600;">Jam</span></p>
            <p class="description">Total Durasi Kerja Bulan Ini</p>
        </div>
    </div>
</div>

<a href="{{ route('karyawan.index') }}" class="btn-main">
    <i class="fas fa-chart-line"></i>
    Lihat Data Karyawan
</a>

@endsection
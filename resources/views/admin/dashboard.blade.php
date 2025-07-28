@extends('layouts.admin')

@section('content')
<style>
    .dashboard-header h1 {
        font-size: 1.8rem;
        margin: 0;
    }
    .dashboard-header p {
        font-size: 1rem;
        color: #aaa;
        margin-top: 5px;
    }
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 25px;
        margin-top: 30px;
    }
    .stat-card {
        background-color: var(--card-bg);
        color: var(--text-dark);
        padding: 25px;
        border-radius: 15px;
    }
    .stat-card i {
        font-size: 1.5rem;
        margin-bottom: 15px;
        display: block;
    }
    .stat-card .number {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
    }
    .stat-card .description {
        font-size: 1rem;
        font-weight: 500;
        color: #555;
    }
    .btn-main {
        background-color: var(--accent-color);
        color: var(--text-light);
        padding: 15px 30px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        margin-top: 40px;
        transition: background-color 0.3s;
    }
    .btn-main:hover {
        background-color: #6d0000;
    }
</style>

<div class="dashboard-header">
    <h1>Dashboard Admin</h1>
    <p>Ringkasan umum aktivitas dan data karyawan.</p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <i class="fas fa-users"></i>
        <p class="number">{{ $totalKaryawanAktif }}</p>
        <p class="description">Total Karyawan Aktif</p>
    </div>
    <div class="stat-card">
        <i class="fas fa-briefcase"></i>
        <p class="number">{{ $totalJobTetap }}</p>
        <p class="description">Total Job Tetap</p>
    </div>
    <div class="stat-card">
        <i class="fas fa-tasks"></i>
        <p class="number">{{ $totalJobOpsional }}</p>
        <p class="description">Total Job Opsional</p>
    </div>
    <div class="stat-card">
        <i class="fas fa-clock"></i>
        <p class="number">{{ $totalJamBulanIni }} <span style="font-size: 1.5rem;">Jam</span></p>
        <p class="description">Total Durasi Kerja Bulan Ini</p>
    </div>
</div>

<a href="#" class="btn-main">Lihat Data Karyawan</a>

@endsection

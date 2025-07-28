@extends('layouts.admin')

@section('content')
    <style>
        /* Tombol Kembali */
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
            margin-bottom: 20px;
            transition: background-color 0.2s;
        }

        .btn-back:hover {
            background-color: #6d0000;
        }

        /* KARTU UTAMA UNTUK SEMUA KONTEN */
        .content-wrapper {
            background-color: var(--card-bg);
            color: var(--text-dark);
            padding: 30px;
            border-radius: 15px;
        }

        /* Header di dalam kartu */
        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
            margin-bottom: 20px;
        }

        .content-header h1 {
            font-size: 1.8rem;
            margin: 0;
            color: var(--text-dark);
        }

        .btn-add-job {
            background-color: var(--accent-color);
            color: var(--text-light);
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        /* Info Karyawan di dalam kartu */
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
            font-size: 14px;
        }

        .employee-info p .label {
            font-weight: 600;
            color: #555;
        }

        /* Tabel yang sudah dirapikan */
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 15px;
            font-size: 14px;
            vertical-align: middle;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
        }

        .table thead th {
            background-color: #f9fafb;
            font-weight: 600;
            color: #374151;
            border-bottom-width: 2px;
            border-bottom-color: #e5e7eb;
        }

        .table td.text-center,
        .table th.text-center {
            text-align: center;
        }

        .status-badge {
            color: white;
            padding: 5px 12px;
            border-radius: 999px;
            /* Membuat badge berbentuk pil */
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
            min-width: 100px;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            justify-content: center;
        }

        .btn-action {
            border-radius: 6px;
            color: white;
            border: none;
            cursor: pointer;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 35px;
            height: 35px;
            transition: transform 0.2s;
        }

        .btn-action:hover {
            transform: scale(1.1);
        }

        .btn-info {
            background-color: #3B82F6;
        }

        .btn-danger {
            background-color: #EF4444;
        }

        .action-buttons form {
            display: contents;
        }

        /* Style Modal tidak berubah */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
            z-index: 100;
        }

        .modal-overlay.show {
            display: flex;
        }

        .modal-box {
            background: white;
            color: var(--text-dark);
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            max-width: 400px;
        }

        .modal-box h3 {
            margin-top: 0;
            margin-bottom: 10px;
        }

        .modal-box p {
            margin-bottom: 25px;
            color: #555;
        }

        .modal-buttons {
            margin-top: 25px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn {
            padding: 10px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
        }

        .btn-cancel {
            background-color: #ddd;
            color: #333;
        }

        .btn-confirm {
            background-color: var(--accent-color);
            color: var(--text-light);
        }
    </style>

    <a href="{{ route('karyawan.index') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>

    {{-- Menampilkan pesan sukses/error --}}
    @if (session('success'))
        <div class="alert alert-success mb-3">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger mb-3">{{ session('error') }}</div>
    @endif

    <div class="content-wrapper">
        <div class="content-header">
            <h1>Week Job</h1>
            <button type="button" class="btn-add-job" id="addWeekJobButton">+ Add New Week Job</button>
        </div>

        <div class="employee-header">
            <img src="{{ $karyawan->foto_profil ? Storage::url('karyawan/' . $karyawan->foto_profil) : 'https://via.placeholder.com/80' }}"
                alt="Foto">
            <div class="employee-info">
                <p><span class="label">Nama:</span> {{ $karyawan->nama_lengkap }}</p>
                <p><span class="label">NIP:</span> {{ $karyawan->nip }}</p>
                <p><span class="label">Divisi:</span> {{ $karyawan->divisi->nama_divisi }}</p>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th>Minggu</th>
                    <th>Tanggal</th>
                    <th>Periode</th>
                    <th class="text-center">Keterangan</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($weeklyPeriods as $period)
                    <tr>
                        <td>{{ $loop->iteration + ($weeklyPeriods->currentPage() - 1) * $weeklyPeriods->perPage() }}</td>
                        <td>Minggu {{ $loop->iteration + ($weeklyPeriods->currentPage() - 1) * $weeklyPeriods->perPage() }}
                        </td>
                        <td>{{ $period->tanggal_mulai->format('d M') }} - {{ $period->tanggal_selesai->format('d M Y') }}
                        </td>
                        <td>{{ $period->tahun }}</td>
                        <td class="text-center">
                            <span class="status-badge"
                                style="background-color: {{ $period->status_penilaian == 'Sudah dinilai' ? '#16A34A' : '#DC2626' }}">
                                {{ $period->status_penilaian }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="action-buttons">
                                <a href="{{ route('joblist.show', ['karyawan' => $karyawan->id, 'week' => $period->minggu_ke, 'year' => $period->tahun]) }}"
                                    class="btn-action btn-info" title="Edit Joblist"><i class="fas fa-pencil-alt"></i></a>
                                <form id="delete-form-{{ $period->minggu_ke }}-{{ $period->tahun }}"
                                    action="{{ route('joblist.destroy', ['karyawan' => $karyawan->id, 'week' => $period->minggu_ke, 'year' => $period->tahun]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-action btn-danger"
                                        onclick="deleteWeekConfirmation('{{ $period->minggu_ke }}', '{{ $period->tahun }}')"
                                        title="Hapus Periode"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 20px;">Belum ada data periode kerja. Klik
                            "Add New Week Job" untuk memulai.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div style="margin-top: 20px;">
            {{ $weeklyPeriods->links() }}
        </div>
    </div>

    <div class="modal-overlay" id="addWeekModal">
        <div class="modal-box">
            <h3>Pilih Tanggal</h3>
            <p>Sistem akan membuat periode kerja mingguan berdasarkan tanggal yang Anda pilih.</p>
            <form action="{{ route('joblist.store', $karyawan->id) }}" method="POST">
                @csrf
                <div class="form-group my-3 text-start">
                    <label for="tanggal">Pilih Tanggal *</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                </div>
                <div class="modal-buttons">
                    <button type="button" class="btn btn-cancel" id="cancelAddWeek">Batal</button>
                    <button type="submit" class="btn btn-confirm">Tambah Periode</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- JavaScript tidak berubah --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const addWeekModal = document.getElementById('addWeekModal');
        const addWeekBtn = document.getElementById('addWeekJobButton');
        const cancelAddWeekBtn = document.getElementById('cancelAddWeek');
        addWeekBtn.addEventListener('click', () => addWeekModal.classList.add('show'));
        cancelAddWeekBtn.addEventListener('click', () => addWeekModal.classList.remove('show'));
        addWeekModal.addEventListener('click', (event) => {
            if (event.target === addWeekModal) {
                addWeekModal.classList.remove('show');
            }
        });

        function deleteWeekConfirmation(week, year) {
            Swal.fire({
                title: `Hapus Periode Minggu ini?`,
                text: "Semua joblist dan penilaian di periode ini akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EF4444',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${week}-${year}`).submit();
                }
            })
        }
    </script>
@endpush

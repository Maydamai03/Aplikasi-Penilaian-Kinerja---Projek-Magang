@extends('layouts.admin')

@section('content')
    <style>
        /* Header & Tombol Kembali */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .btn-back {
            background: linear-gradient(135deg, #6c757d, #495057);
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        .employee-header {
            display: flex;
            align-items: center;
            gap: 15px;
            color: #000000;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .employee-header img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ffd700;
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
            color: #000000;
        }

        /* Kontainer Utama & Tabs */
        .tabs-container {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            color: #1f2937;
            padding: 10px 30px 30px 30px;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        .tabs-nav {
            display: flex;
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 25px;
        }

        .tab-link {
            padding: 15px 25px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            color: #6c757d;
            border: none;
            background: transparent;
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
        }

        .tab-link.active {
            color: #1f2937;
            border-bottom-color: #ffd700;
        }

        .tab-link i {
            margin-right: 8px;
        }

        .tab-panel {
            display: none;
        }

        .tab-panel.active {
            display: block;
            animation: fadeInUp 0.5s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Form & Tabel di dalam Tabs */
        .shift-header {
            margin-bottom: 20px;
        }

        .shift-header h3 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .form-control {
            width: 100%;
            height: 48px;
            padding: 0 15px;
            border-radius: 10px;
            border: 1px solid #dee2e6;
            background-color: #f8f9fa;
        }

        .btn-add {
            height: 48px;
            width: 120px;
            background: linear-gradient(135deg, #1f2937, #374151);
            color: white;
            font-weight: 700;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-export-joblist {
            background-color: #6c757d;
            color: white;
            padding: 8px 15px;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 16px 15px;
            text-align: left;
            border-bottom: 1px solid #f3f4f6;
        }

        .table thead th {
            background-color: transparent;
            font-weight: 700;
            color: #4b5563;
            font-size: 0.8rem;
            text-transform: uppercase;
        }

        .table tbody tr:hover {
            background-color: rgba(255, 215, 0, 0.05);
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .btn-table {
            font-size: 13px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            padding: 8px 16px;
            border-radius: 8px;
            color: white;
            transition: transform 0.2s;
        }

        .btn-table:hover {
            transform: translateY(-2px);
        }

        .btn-edit {
            background-color: #3B82F6;
        }

        .btn-delete {
            background-color: #EF4444;
        }

        .btn-penilaian {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            color: white;
            padding: 12px 25px;
            border-radius: 10px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3);
            transition: all 0.3s ease;
        }

        .btn-penilaian:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(34, 197, 94, 0.4);
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

    {{-- @if (session('success')) <div class="alert alert-success mb-3">{{ session('success') }}</div> @endif --}}

    <div class="tabs-container">
        <div class="tabs-nav">
            <button class="tab-link active" data-tab="pagi"><i class="fas fa-sun"></i> Shift Pagi</button>
            <button class="tab-link" data-tab="siang"><i class="fas fa-cloud-sun"></i> Shift Siang</button>
        </div>

        <div class="tabs-content">
            <div id="pagi" class="tab-panel active">
                {{-- Form tidak berubah --}}
                <div class="shift-header">
                    <h3>Tambah Pekerjaan Shift Pagi</h3>
                </div>
                <form action="{{ route('job.store', $karyawan->id) }}" method="POST" class="mb-4">
                    @csrf
                    <input type="hidden" name="tipe_job" value="Tetap">
                    <input type="hidden" name="shift" value="Pagi">
                    <div class="row align-items-end g-3">
                        <div class="col-md-6"><label>Nama Pekerjaan</label><input type="text" name="nama_pekerjaan"
                                class="form-control" required></div> <br>
                        <div class="col-md-4"><label>Durasi (menit)</label><input type="number" name="durasi_waktu"
                                class="form-control" required></div> <br>
                        <div class="col-md-2"><button type="submit" class="btn-add w-100">+ Add</button></div> <br>
                    </div>
                </form>
                <hr>
                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('job.exportPdf', ['karyawan' => $karyawan->id, 'shift' => 'Pagi']) }}"
                        class="btn-export-joblist">
                        <i class="fas fa-file-pdf"></i> Ekspor Joblist Pagi
                    </a>
                </div>
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th>Pekerjaan</th>
                            <th>Bobot (%)</th>
                            <th>Durasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jobPagi as $job)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $job->nama_pekerjaan }}</td>
                                {{-- DIPERBAIKI: Menampilkan bobot dengan 1 desimal --}}
                                <td>{{ number_format(($job->durasi_waktu / 480) * 100, 1) }}%</td>
                                <td>{{ $job->durasi_waktu }} menit</td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('job.edit', $job->id) }}" class="btn-table btn-edit">Edit</a>
                                        <button type="button" class="btn-table btn-delete"
                                            onclick="deleteConfirmation({{ $job->id }})">Hapus</button>
                                        <form id="delete-form-{{ $job->id }}"
                                            action="{{ route('job.destroy', $job->id) }}" method="POST"
                                            style="display: none;">@csrf @method('DELETE')</form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center p-4">Belum ada job untuk shift Pagi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <br>
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('penilaian.create', ['karyawan' => $karyawan->id, 'shift' => 'Pagi']) }}"
                        class="btn-penilaian">Penilaian Kinerja Shift Pagi</a>
                </div>
            </div>

            <div id="siang" class="tab-panel">
                {{-- Form tidak berubah --}}
                <div class="shift-header">
                    <h3>Tambah Pekerjaan Shift Siang</h3>
                </div>
                <form action="{{ route('job.store', $karyawan->id) }}" method="POST" class="mb-4">
                    @csrf
                    <input type="hidden" name="tipe_job" value="Tetap">
                    <input type="hidden" name="shift" value="Siang">
                    <div class="row align-items-end g-3">
                        <div class="col-md-6"><label>Nama Pekerjaan</label><input type="text" name="nama_pekerjaan"
                                class="form-control" required></div> <br>
                        <div class="col-md-4"><label>Durasi (menit)</label><input type="number" name="durasi_waktu"
                                class="form-control" required></div> <br>
                        <div class="col-md-2"><button type="submit" class="btn-add w-100">+ Add</button></div> <br>
                    </div>
                </form>
                <hr>
                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('job.exportPdf', ['karyawan' => $karyawan->id, 'shift' => 'Siang']) }}"
                        class="btn-export-joblist">
                        <i class="fas fa-file-pdf"></i> Ekspor Joblist Siang
                    </a>
                </div>
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th>Pekerjaan</th>
                            <th>Bobot (%)</th>
                            <th>Durasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jobSiang as $job)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $job->nama_pekerjaan }}</td>
                                {{-- DIPERBAIKI: Menampilkan bobot dengan 1 desimal --}}
                                <td>{{ number_format(($job->durasi_waktu / 480) * 100, 1) }}%</td>
                                <td>{{ $job->durasi_waktu }} menit</td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('job.edit', $job->id) }}" class="btn-table btn-edit">Edit</a>
                                        <button type="button" class="btn-table btn-delete"
                                            onclick="deleteConfirmation({{ $job->id }})">Hapus</button>
                                        <form id="delete-form-{{ $job->id }}"
                                            action="{{ route('job.destroy', $job->id) }}" method="POST"
                                            style="display: none;">@csrf @method('DELETE')</form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center p-4">Belum ada job untuk shift Siang.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <br>
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('penilaian.create', ['karyawan' => $karyawan->id, 'shift' => 'Siang']) }}"
                        class="btn-penilaian">Penilaian Kinerja Shift Siang</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabLinks = document.querySelectorAll('.tab-link');
            const tabPanels = document.querySelectorAll('.tab-panel');

            // --- LOGIKA BARU UNTUK MENGINGAT TAB ---

            // 1. Cek parameter 'tab' di URL saat halaman pertama kali dimuat
            const urlParams = new URLSearchParams(window.location.search);
            const activeTabFromUrl = urlParams.get('tab') || 'pagi'; // Default ke 'pagi'

            // Fungsi untuk mengaktifkan tab
            function activateTab(tabId) {
                tabLinks.forEach(link => {
                    link.classList.toggle('active', link.getAttribute('data-tab') === tabId);
                });
                tabPanels.forEach(panel => {
                    panel.classList.toggle('active', panel.id === tabId);
                });
            }

            // Aktifkan tab yang benar saat halaman dimuat
            activateTab(activeTabFromUrl);

            // 2. Saat tab di-klik, hanya ganti tampilan (tanpa reload) dan update URL
            tabLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault(); // Mencegah aksi default
                    const tabId = link.getAttribute('data-tab');
                    activateTab(tabId);

                    // Update URL di browser tanpa me-reload halaman
                    const url = new URL(window.location);
                    url.searchParams.set('tab', tabId);
                    window.history.pushState({}, '', url);
                });
            });

            // 3. Saat form di-submit, tambahkan info tab yang aktif
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function() {
                    // Hapus dulu jika sudah ada, untuk mencegah duplikat
                    let oldTabInput = this.querySelector('input[name="tab"]');
                    if (oldTabInput) {
                        oldTabInput.remove();
                    }

                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'tab';
                    hiddenInput.value = document.querySelector('.tab-link.active').getAttribute(
                        'data-tab');
                    this.appendChild(hiddenInput);
                });
            });
        });

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

@extends('layouts.admin')

@section('content')
    <style>
        .appraisal-card {
            background-color: #ffffff;
            color: #1f2937;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            margin-top: 20px;
        }

        .appraisal-header h3 {
            margin-bottom: 5px;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .appraisal-header p {
            margin-bottom: 20px;
            font-size: 0.95rem;
            color: #555;
        }

        .table thead th {
            background-color: #f1f5f9;
            text-align: center;
            vertical-align: middle;
        }

        .table td {
            vertical-align: top;
            padding: 12px 8px;
        }

        .form-control-table,
        .form-select {
            width: 100%;
            padding: 6px 10px;
            font-size: 0.9rem;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .form-control-table:disabled,
        .form-select:disabled {
            background-color: #f3f4f6;
            color: #9ca3af;
            cursor: not-allowed;
            opacity: 0.7;
        }

        .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 18px;
        background-color: var(--gray-100);
        color: var(--gray-700);
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.2s ease;
        border: 1px solid var(--gray-300);
        margin-bottom: 25px;
    }

    .btn-back:hover {
        background-color: var(--gray-200);
        color: var(--gray-800);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

        .btn-save-appraisal {
            background-color: #10b981;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-size: 0.95rem;
            transition: background-color 0.2s;
        }

        .btn-save-appraisal:hover {
            background-color: #059669;
        }

        .btn-add-opsional {
            background-color: #3B82F6;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            font-weight: 600;
            transition: background-color 0.2s;
        }

        .btn-add-opsional:hover {
            background-color: #2563eb;
        }

        .btn-delete-opsional {
            background-color: #EF4444;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
            transition: background-color 0.2s;
            cursor: pointer;
        }

        .btn-delete-opsional:hover {
            background-color: #dc2626;
        }

        .job-type-header td {
            background-color: #f8fafc;
            font-weight: 600;
            color: #374151;
            padding: 12px 15px;
            border-top: 2px solid #e5e7eb;
        }

        .opsional-job-row {
            background-color: #fefefe;
        }

        .opsional-job-row:hover {
            background-color: #f9fafb;
        }

        .mb-2 {
            margin-bottom: 8px;
        }

        .job-duration-section {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 8px;
        }

        .opsional-field-wrapper {
            padding-top: 4px;
        }

        .opsional-field-wrapper .form-control-table,
        .opsional-field-wrapper .form-select {
            margin-top: 0;
        }

        .duration-label {
            font-size: 0.8rem;
            color: #6b7280;
            white-space: nowrap;
            min-width: 70px;
        }

        .duration-input {
            width: 80px !important;
            padding: 4px 8px;
            font-size: 0.85rem;
        }

        .action-cell {
            text-align: center;
            width: 60px;
        }

        .empty-state {
            text-align: center;
            color: #9ca3af;
            font-style: italic;
            padding: 20px;
        }

        .form-control-small {
            font-size: 0.85rem;
            padding: 4px 8px;
        }
    </style>

    <a href="{{ url()->previous() }}" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>

    <form action="{{ route('penilaian.store', $karyawan->id) }}" method="POST">
        @csrf
        <input type="hidden" name="shift" value="{{ $shift }}">
        <div class="appraisal-card mt-3">
            <div class="appraisal-header">
                <h3>Form Penilaian Kinerja (Shift {{ $shift }})</h3>
                <p>Karyawan: <strong>{{ $karyawan->nama_lengkap }}</strong></p>

                {{-- [BARU] Tambahkan input tanggal di sini --}}
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="tanggal_penilaian" class="form-label fw-bold">Pilih Tanggal Penilaian</label>
                        <input type="date" id="tanggal_penilaian" name="tanggal_penilaian" class="form-control"
                            value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th style="width: 5%;">No.</th>
                            <th style="width: 30%;">Pekerjaan</th>
                            <th class="text-center" style="width: 18%;">Status</th>
                            <th class="text-center" style="width: 20%;">Skala Penilaian</th>
                            <th style="width: 22%;">Catatan</th>
                            <th class="text-center" style="width: 5%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Judul untuk Job Tetap --}}
                        <tr class="job-type-header">
                            <td colspan="5">Job Tetap</td>
                        </tr>

                        @forelse ($jobLists as $job)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td> {{-- [BARU] Menampilkan nomor urut --}}
                                <td>{{ $job->nama_pekerjaan }}</td>
                                <td>
                                    <select name="status[{{ $job->id }}]" class="form-select form-control-table status-dropdown"
                                        required>
                                        <option value="Dikerjakan">Dikerjakan</option>
                                        <option value="Tidak Dikerjakan">Tidak Dikerjakan</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="skala[{{ $job->id }}]" class="form-select form-control-table skala-dropdown"
                                        required>
                                        <option value="">-- Pilih Skala --</option>
                                        <option value="Melakukan Dengan Benar">Melakukan Dengan Benar</option>
                                        <option value="Melakukan Tapi Tidak Benar">Melakukan Tapi Tidak Benar</option>
                                        <option value="Tidak Dikerjakan">Tidak Dikerjakan</option>
                                    </select>
                                </td>
                                <td><input type="text" name="catatan[{{ $job->id }}]" class="form-control-table catatan-input"
                                        placeholder="Isi jika perlu"></td>
                                <td class="action-cell"></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="empty-state">Belum ada Job Tetap untuk dinilai.</td>
                            </tr>
                        @endforelse
                    </tbody>

                    {{-- Container untuk Job Opsional dinamis --}}
                    <tbody id="opsional-jobs-container">
                        <tr class="job-type-header">
                            <td colspan="5">Job Opsional</td>
                        </tr>
                        <tr id="no-opsional-jobs" class="empty-state-row">
                            <td colspan="5" class="empty-state">Belum ada Job Opsional. Klik tombol di bawah untuk
                                menambah.</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <button type="button" id="add-opsional-btn" class="btn-add-opsional mt-3">
                <i class="fas fa-plus"></i> Tambah Job Opsional
            </button>
            <hr class="my-4">
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn-save-appraisal"><i class="fas fa-save"></i> Simpan Penilaian</button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // SweetAlert2 pop-up notifications
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan!',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 1500
            });
        @endif

        document.addEventListener('DOMContentLoaded', function () {
            let opsionalCounter = 0;

            // Fungsi untuk mengatur dropdown Skala berdasarkan Status
            function handleStatusChange(statusDropdown) {
                const row = statusDropdown.closest('tr');
                const skalaDropdown = row.querySelector('.skala-dropdown');
                const catatanInput = row.querySelector('.catatan-input');

                if (statusDropdown.value === 'Tidak Dikerjakan') {
                    skalaDropdown.disabled = true;
                    skalaDropdown.required = false;
                    skalaDropdown.value = 'Tidak Dikerjakan';
                    if (catatanInput) catatanInput.disabled = true;
                } else {
                    skalaDropdown.disabled = false;
                    skalaDropdown.required = true;
                    if (skalaDropdown.value === 'Tidak Dikerjakan') {
                        skalaDropdown.value = '';
                    }
                    if (catatanInput) catatanInput.disabled = false;
                }
            }

            // Fungsi untuk menghapus baris job opsional
            function deleteOpsionalJob(button) {
                const row = button.closest('tr');
                row.remove();

                // Cek apakah masih ada job opsional
                const container = document.getElementById('opsional-jobs-container');
                const opsionalRows = container.querySelectorAll('.opsional-job-row');

                if (opsionalRows.length === 0) {
                    document.getElementById('no-opsional-jobs').style.display = '';
                }
            }

            // Fungsi untuk menambah validasi form
            function addFormValidation(row) {
                const inputs = row.querySelectorAll('input[required], select[required]');
                inputs.forEach(input => {
                    input.addEventListener('invalid', function () {
                        this.style.borderColor = '#ef4444';
                    });

                    input.addEventListener('input', function () {
                        if (this.checkValidity()) {
                            this.style.borderColor = '#d1d5db';
                        }
                    });
                });
            }

            // Terapkan fungsi ke semua dropdown status yang ada saat ini
            document.querySelectorAll('.status-dropdown').forEach(dropdown => {
                handleStatusChange(dropdown);
                dropdown.addEventListener('change', () => handleStatusChange(dropdown));
            });

            // Fungsi untuk menambah baris form job opsional
            document.getElementById('add-opsional-btn').addEventListener('click', function () {
                opsionalCounter++;
                const container = document.getElementById('opsional-jobs-container');
                const uniqueId = `opsional_row_${opsionalCounter}`;

                // Sembunyikan pesan kosong
                document.getElementById('no-opsional-jobs').style.display = 'none';

                const newRow = document.createElement('tr');
                newRow.className = 'opsional-job-row';
                newRow.id = uniqueId;

                newRow.innerHTML = `
                    <td class="text-center">${opsionalCounter}.</td>
                        <td>
                            <input type="text"
                                   name="opsional_nama[]"
                                   class="form-control-table mb-2"
                                   placeholder="Masukkan nama pekerjaan..."
                                   required
                                   maxlength="100">
                            <div class="job-duration-section">
                                <span class="duration-label">Durasi:</span>
                                <input type="number"
                                       name="opsional_durasi[]"
                                       class="form-control-table duration-input"
                                       placeholder="0"
                                       min="1"
                                       max="999"
                                       required>
                                <small class="text-muted">menit</small>
                            </div>
                        </td>
                        <td class="opsional-field-wrapper">
                            <select name="opsional_status[]" class="form-select form-control-table status-dropdown" required>
                                <option value="Dikerjakan">Dikerjakan</option>
                                <option value="Tidak Dikerjakan">Tidak Dikerjakan</option>
                            </select>
                        </td>
                        <td class="opsional-field-wrapper">
                            <select name="opsional_skala[]" class="form-select form-control-table skala-dropdown" required>
                                <option value="">-- Pilih Skala --</option>
                                <option value="Melakukan Dengan Benar">Melakukan Dengan Benar</option>
                                <option value="Melakukan Tapi Tidak Benar">Melakukan Tapi Tidak Benar</option>
                                <option value="Tidak Dikerjakan">Tidak Dikerjakan</option>
                            </select>
                        </td>
                        <td class="opsional-field-wrapper">
                            <input type="text"
                                   name="opsional_catatan[]"
                                   class="form-control-table catatan-input"
                                   placeholder="Catatan tambahan..."
                                   maxlength="255">
                        </td>
                        <td class="action-cell opsional-field-wrapper">
                            <button type="button"
                                    class="btn-delete-opsional"
                                    onclick="deleteOpsionalJob(this)"
                                    title="Hapus pekerjaan ini">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    `;

                container.appendChild(newRow);

                // Terapkan event listeners dan validasi ke baris baru
                const statusDropdown = newRow.querySelector('.status-dropdown');
                statusDropdown.addEventListener('change', function () {
                    handleStatusChange(this);
                });

                // Trigger initial state
                handleStatusChange(statusDropdown);

                // Tambahkan validasi
                addFormValidation(newRow);

                // Focus ke input nama pekerjaan
                newRow.querySelector('input[name="opsional_nama[]"]').focus();
            });

            // Buat fungsi delete tersedia secara global
            window.deleteOpsionalJob = deleteOpsionalJob;

            // Validasi form sebelum submit
            document.querySelector('form').addEventListener('submit', function (e) {
                let hasError = false;
                const requiredFields = this.querySelectorAll('input[required], select[required]');

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.style.borderColor = '#ef4444';
                        hasError = true;
                    } else {
                        field.style.borderColor = '#d1d5db';
                    }
                });

                if (hasError) {
                    e.preventDefault();
                    alert('Mohon lengkapi semua field yang wajib diisi.');
                    return false;
                }
            });
        });
    </script>
@endpush

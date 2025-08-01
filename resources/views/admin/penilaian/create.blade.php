@extends('layouts.admin')

@section('content')
<style>
    /* ... (CSS dari sebelumnya bisa digunakan, tidak perlu diubah) ... */
    .appraisal-card { background-color: white; color: #1f2937; padding: 30px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
    .table thead th { background-color: #f9fafb; }
</style>

<a href="{{ url()->previous() }}" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>

<form action="{{ route('penilaian.store', $karyawan->id) }}" method="POST">
    @csrf
    <input type="hidden" name="shift" value="{{ $shift }}">
    <div class="appraisal-card mt-3">
        {{-- Header Form --}}
        <div class="appraisal-header">
             <h3>Form Penilaian Kinerja (Shift {{ $shift }})</h3>
             <p>Karyawan: <strong>{{ $karyawan->nama_lengkap }}</strong> | Tanggal: <strong>{{ \Carbon\Carbon::now()->format('d F Y') }}</strong></p>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 30%;">Pekerjaan</th>
                        <th class="text-center" style="width: 20%;">Status</th>
                        <th class="text-center" style="width: 20%;">Skala Penilaian</th>
                        <th style="width: 25%;">Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jobLists as $job)
                    <tr>
                        <td>{{ $job->nama_pekerjaan }}</td>
                        <td>
                            <select name="status[{{ $job->id }}]" class="form-select form-control-table status-dropdown" required>
                                <option value="Dikerjakan">Dikerjakan</option>
                                <option value="Tidak Dikerjakan">Tidak Dikerjakan</option>
                            </select>
                        </td>
                        <td>
                            <select name="skala[{{ $job->id }}]" class="form-select form-control-table skala-dropdown">
                                <option value="">-- Pilih Skala --</option>
                                <option value="Baik">Baik</option>
                                <option value="Sedang">Sedang</option>
                                <option value="Cukup">Cukup</option>
                            </select>
                        </td>
                        <td><input type="text" name="catatan[{{ $job->id }}]" class="form-control-table"></td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center p-5">Belum ada pekerjaan yang bisa dinilai untuk shift ini.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Tombol untuk Job Opsional bisa ditambahkan di sini jika perlu --}}

        @if($jobLists->isNotEmpty())
            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn-save-appraisal"><i class="fas fa-save"></i> Simpan Penilaian</button>
            </div>
        @endif
    </div>
</form>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Fungsi untuk mengatur dropdown Skala berdasarkan Status
    function handleStatusChange(statusDropdown) {
        const row = statusDropdown.closest('tr');
        const skalaDropdown = row.querySelector('.skala-dropdown');

        if (statusDropdown.value === 'Tidak Dikerjakan') {
            skalaDropdown.disabled = true; // Matikan dropdown skala
            skalaDropdown.required = false; // Hapus validasi required
            skalaDropdown.value = ''; // Kosongkan nilainya
        } else {
            skalaDropdown.disabled = false; // Aktifkan kembali
            skalaDropdown.required = true; // Jadikan wajib diisi
        }
    }

    // Terapkan fungsi ke semua dropdown status yang ada
    const allStatusDropdowns = document.querySelectorAll('.status-dropdown');
    allStatusDropdowns.forEach(dropdown => {
        handleStatusChange(dropdown); // Panggil saat halaman dimuat
        dropdown.addEventListener('change', () => handleStatusChange(dropdown)); // Panggil saat nilainya berubah
    });
});
</script>
@endpush

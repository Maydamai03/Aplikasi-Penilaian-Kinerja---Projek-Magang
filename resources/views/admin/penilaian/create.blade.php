@extends('layouts.admin')

@section('content')
    <style>
        .job-card {
            background-color: var(--card-bg);
            color: var(--text-dark);
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 25px;
        }

        .job-header {
            padding-bottom: 15px;
            margin-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .table thead th {
            background-color: #f9fafb;
        }

        .form-control-sm {
            height: 38px;
            padding: 5px 10px;
            border-radius: 6px;
            border: 1px solid #ddd;
            width: 100%;
        }
    </style>

    <a href="{{ route('job.tetap', $karyawan->id) }}" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali ke Job
        Tetap</a>

    <form action="{{ route('penilaian.store', $karyawan->id) }}" method="POST">
        @csrf
        <div class="job-card mt-4">
            <div class="job-header">
                <h3>Form Penilaian Kinerja</h3>
                <p>
                    Karyawan: <strong>{{ $karyawan->nama_lengkap }}</strong><br>
                    Tanggal Penilaian: <strong>{{ date('d F Y') }}</strong>
                </p>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 40%;">Pekerjaan</th>
                        <th class="text-center">Bobot</th>
                        <th class="text-center">Durasi (Menit)</th>
                        <th class="text-center" style="width: 15%;">Nilai (1-100)</th>
                        <th style="width: 25%;">Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Tampilkan Kelompok Job Tetap --}}
                    @if (isset($jobLists['Tetap']) && $jobLists['Tetap']->isNotEmpty())
                        <tr class="date-separator">
                            <td colspan="5"><strong>Job Tetap</strong></td>
                        </tr>
                        @foreach ($jobLists['Tetap'] as $job)
                            <tr>
                                <td>{{ $job->nama_pekerjaan }}</td>
                                <td class="text-center">{{ $job->bobot }}%</td>
                                <td class="text-center">{{ $job->durasi_waktu }} menit</td>
                                <td>
                                    <input type="number" name="nilai[{{ $job->id }}]"
                                        class="form-control-sm text-center" min="0" max="100" required>
                                </td>
                                <td>
                                    <input type="text" name="catatan[{{ $job->id }}]" class="form-control-sm">
                                </td>
                            </tr>
                        @endforeach
                    @endif

                    {{-- Tampilkan Kelompok Job Opsional --}}
                    @if (isset($jobLists['Opsional']) && $jobLists['Opsional']->isNotEmpty())
                        <tr class="date-separator">
                            <td colspan="5"><strong>Job Opsional</strong></td>
                        </tr>
                        @foreach ($jobLists['Opsional'] as $job)
                            <tr>
                                <td>{{ $job->nama_pekerjaan }}</td>
                                <td class="text-center">{{ $job->bobot }}%</td>
                                <td class="text-center">{{ $job->durasi_waktu }} menit</td>
                                <td>
                                    <input type="number" name="nilai[{{ $job->id }}]"
                                        class="form-control-sm text-center" min="0" max="100" required>
                                </td>
                                <td>
                                    <input type="text" name="catatan[{{ $job->id }}]" class="form-control-sm">
                                </td>
                            </tr>
                        @endforeach
                    @endif

                    {{-- Pesan jika tidak ada job sama sekali --}}
                    @if ($jobLists->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">Belum ada pekerjaan yang bisa dinilai.</td>
                        </tr>
                    @endif
                </tbody>
            </table>

            @if ($jobLists->isNotEmpty())
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-success">Simpan Penilaian</button>
                </div>
            @endif
        </div>
    </form>
@endsection

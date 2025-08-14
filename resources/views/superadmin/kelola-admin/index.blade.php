@extends('layouts.admin')

@section('content')
<style>
    :root {
        /* Yellow Theme - Professional & Clean */
        --primary-yellow: #f5d62d;
        --yellow-light: #fef3c7;
        --yellow-dark: #d69e2e;
        --yellow-darker: #b7791f;

        /* Neutral Colors */
        --white: #ffffff;
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-300: #d1d5db;
        --gray-400: #9ca3af;
        --gray-500: #6b7280;
        --gray-600: #4b5563;
        --gray-700: #374151;
        --gray-800: #1f2937;
        --gray-900: #111827;

        /* Theme Variables */
        --text-dark: var(--gray-800);
        --text-muted: var(--gray-500);
        --border-color: var(--gray-200);
        --border-radius: 8px;
        --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

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
            color: #292828 !important;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .dashboard-header p {
            font-size: 1.1rem;
            color: #292828 !important;
            margin-top: 8px;
            font-weight: 400;
        }

    /* Page Header */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    /* .page-header h1 {
        font-size: 1.875rem;
        color: var(--text-dark) !important;
        font-weight: 700;
        margin: 0;
    } */

    .btn-add-admin {
        background: var(--primary-yellow);
        color: var(--text-dark) !important;
        padding: 12px 24px;
        border-radius: var(--border-radius);
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
        border: 1px solid var(--yellow-dark);
        font-size: 14px;
    }

    .btn-add-admin:hover {
        background: var(--yellow-dark);
        color: var(--text-dark) !important;
        text-decoration: none;
    }

    /* Alert Success */
    .alert {
        padding: 15px 20px;
        border-radius: var(--border-radius);
        border: 1px solid transparent;
        font-size: 14px;
        margin-bottom: 20px;
    }

    .alert-success {
        background-color: #d1fae5;
        border-color: #10b981;
        color: #065f46;
    }

    /* Table Container */
    .table-container {
        background: var(--white);
        color: var(--text-dark);
        padding: 0;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        border: 1px solid var(--border-color);
        overflow: hidden;
    }

    /* Table Styling */
    .table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
        font-size: 14px;
    }

    .table th, .table td {
        padding: 16px 20px;
        text-align: left;
        border-bottom: 1px solid var(--border-color);
        vertical-align: middle;
    }

    .table thead th {
        background-color: var(--gray-50);
        font-weight: 600;
        color: var(--text-dark);
        font-size: 14px;
        border-bottom: 2px solid var(--border-color);
    }

    .table tbody tr:hover {
        background-color: var(--gray-50);
    }

    .table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .btn-action {
        padding: 8px 16px;
        border-radius: var(--border-radius);
        color: white !important;
        text-decoration: none;
        font-size: 13px;
        font-weight: 500;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
    }

    .btn-info {
        background-color: #3b82f6;
    }

    .btn-info:hover {
        background-color: #2563eb;
        color: white !important;
        text-decoration: none;
    }

    .btn-danger {
        background-color: #ef4444;
    }

    .btn-danger:hover {
        background-color: #dc2626;
        color: white !important;
        text-decoration: none;
    }

    /* Empty State */
    .text-center {
        text-align: center;
    }

    .p-5 {
        padding: 40px 20px;
        color: var(--text-muted);
        font-style: italic;
    }

    /* Table Column Widths */
    .table th:first-child,
    .table td:first-child {
        width: 80px;
        text-align: center;
    }

    .table th:last-child,
    .table td:last-child {
        width: 180px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            gap: 15px;
            align-items: flex-start;
        }

        .page-header h1 {
            font-size: 1.5rem;
        }

        .table-container {
            overflow-x: auto;
        }

        .table {
            min-width: 600px;
        }

        .action-buttons {
            flex-direction: column;
            gap: 5px;
        }

        .btn-action {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .table th, .table td {
            padding: 12px 10px;
            font-size: 13px;
        }

        .btn-add-admin {
            padding: 10px 20px;
            font-size: 13px;
        }
    }

    /* Custom SweetAlert2 Styling */
    .swal2-popup {
        border-radius: var(--border-radius) !important;
    }

    .swal2-confirm {
        background-color: #ef4444 !important;
        border-radius: var(--border-radius) !important;
    }

    .swal2-cancel {
        background-color: var(--gray-500) !important;
        border-radius: var(--border-radius) !important;
    }
</style>

<div class="page-header">
    <div class="dashboard-header floating-element">
        <h1>Kelola Admin</h1>
        <p>Tambahkan atau edit admin untuk keperluan akses ke sistem.</p>
    </div>
    <a href="{{ route('kelola-admin.create') }}" class="btn-add-admin">
        <i class="fas fa-user-plus"></i> Tambah Admin
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
@endif

<div class="table-container">
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($admins as $admin)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <div style="font-weight: 500;">{{ $admin->name }}</div>
                </td>
                <td>
                    <div style="color: var(--text-muted);">{{ $admin->email }}</div>
                </td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('kelola-admin.edit', $admin->id) }}" class="btn-action btn-info">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form id="delete-form-{{ $admin->id }}" action="{{ route('kelola-admin.destroy', $admin->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn-action btn-danger" onclick="deleteConfirmation({{ $admin->id }})">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center p-5">
                    <i class="fas fa-users" style="font-size: 2rem; color: var(--text-muted); margin-bottom: 10px; display: block;"></i>
                    Belum ada akun admin yang terdaftar.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function deleteConfirmation(id) {
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: "Akun admin ini akan dihapus permanen dan tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                popup: 'swal2-popup',
                confirmButton: 'swal2-confirm',
                cancelButton: 'swal2-cancel'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading state
                Swal.fire({
                    title: 'Menghapus...',
                    text: 'Sedang memproses permintaan Anda',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Submit form
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endpush

@extends('layouts.admin')

@section('content')
<style>
    /* Menggunakan style yang mirip dengan karyawan/index.blade.php */
    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
    .page-header h1 { font-size: 2.2rem; color: #292828 !important; font-weight: 700; margin: 0; }
    .btn-add-admin { background: linear-gradient(135deg, #ffd700, #ff9500); color: #1f2937 !important; padding: 14px 24px; border-radius: 12px; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s; box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3); }
    .btn-add-admin:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(255, 215, 0, 0.4); }
    .table-container { background: white; color: #1f2937; padding: 30px; border-radius: 20px; box-shadow: 0 8px 25px rgba(0,0,0,0.08); }
    .table { width: 100%; border-collapse: collapse; }
    .table th, .table td { padding: 18px 15px; text-align: left; border-bottom: 1px solid #f3f4f6; vertical-align: middle; }
    .table thead th { background-color: #f9fafb; font-weight: 700; color: #374151; font-size: 0.85rem; text-transform: uppercase; }
    .action-buttons { display: flex; gap: 10px; }
    .btn-action { padding: 8px 16px; border-radius: 8px; color: white !important; text-decoration: none; font-size: 0.8rem; font-weight: 600; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; transition: transform 0.2s; }
    .btn-info { background-color: #3B82F6; }
    .btn-danger { background-color: #EF4444; }
    .btn-action:hover { transform: translateY(-2px); }
</style>

<div class="page-header">
    <h1>Kelola Akun Admin</h1>
    <a href="{{ route('kelola-admin.create') }}" class="btn-add-admin">
        <i class="fas fa-user-plus"></i> Tambah Admin
    </a>
</div>

@if(session('success')) <div class="alert alert-success mb-3">{{ session('success') }}</div> @endif

<div class="table-container">
    <table class="table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th>Nama</th>
                <th>Email</th>
                <th style="width: 20%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($admins as $admin)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('kelola-admin.edit', $admin->id) }}" class="btn-action btn-info"><i class="fas fa-pencil-alt"></i> Edit</a>
                        <form id="delete-form-{{ $admin->id }}" action="{{ route('kelola-admin.destroy', $admin->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn-action btn-danger" onclick="deleteConfirmation({{ $admin->id }})"><i class="fas fa-trash"></i> Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="text-center p-5">Belum ada akun admin yang terdaftar.</td></tr>
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
            title: 'Apakah Anda yakin?',
            text: "Akun admin ini akan dihapus permanen!",
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

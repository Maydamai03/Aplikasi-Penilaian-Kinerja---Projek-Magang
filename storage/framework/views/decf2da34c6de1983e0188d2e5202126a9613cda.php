

<?php $__env->startSection('content'); ?>
<style>
    /* Variabel CSS untuk tema, jika diperlukan */
    :root {
        --primary-yellow: #f5d62d;
        --yellow-light: #fef3c7;
        --yellow-dark: #d69e2e;
        --yellow-darker: #b7791f;

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

        --accent-color: #3B82F6; /* Warna biru untuk tombol aksi */
        --danger-color: #EF4444; /* Warna merah untuk aksi berbahaya */
    }

    /* Style untuk tombol kembali yang diperbarui */
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

    .btn-back i {
        font-size: 1rem;
    }

    .detail-container {
        background: white;
        color: #1f2937;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    }

    .detail-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 20px;
        margin-bottom: 25px;
        border-bottom: 1px solid #e9ecef;
    }

    .detail-header h3 {
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .header-actions {
        display: flex;
        gap: 10px;
    }

    .btn-action {
        text-decoration: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-edit {
        background-color: var(--accent-color);
        color: white;
    }

    .btn-edit:hover {
        background-color: #2563EB;
        transform: translateY(-2px);
    }

    .detail-body {
        display: flex;
        gap: 40px;
    }

    .profile-sidebar {
        flex: 0 0 200px;
        text-align: center;
    }

    .profile-img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid #fff;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 15px;
    }

    .profile-name {
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .profile-nip {
        font-size: 0.9rem;
        color: #6b7280;
        margin-bottom: 15px;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 15px;
        border-radius: 999px;
        font-weight: 500;
        color: white;
    }

    .status-update-form {
        margin-top: 20px;
        text-align: left;
        background-color: var(--gray-50);
        padding: 15px;
        border-radius: 10px;
        border: 1px solid var(--gray-200);
    }

    .status-update-form label {
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 8px;
        display: block;
    }

    .status-update-form .form-select {
        width: 100%;
        height: 40px;
        border-radius: 8px;
        border: 1px solid var(--gray-300);
        padding: 0 10px;
        font-size: 14px;
        background-color: white;
        transition: border-color 0.2s;
    }

    .status-update-form .form-select:focus {
        outline: none;
        border-color: var(--accent-color);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
    }


    .btn-update-status {
        width: 100%;
        margin-top: 10px;
        background-color: var(--gray-800);
        color: white;
        border: none;
        padding: 8px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 500;
        transition: background-color 0.2s ease;
    }

    .btn-update-status:hover {
        background-color: var(--gray-700);
    }

    .profile-details {
        flex: 1;
    }

    .detail-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .detail-item {
        display: flex;
        padding: 15px 0;
        border-bottom: 1px solid var(--gray-100);
    }

    .detail-item:last-child {
        border-bottom: none;
    }

    .detail-item .label {
        font-weight: 600;
        width: 150px;
        color: var(--gray-600);
        flex-shrink: 0;
    }

    .detail-item .value {
        font-weight: 500;
        word-break: break-word;
    }

    /* ========================= */
    /* RESPONSIVE DESIGN */
    /* ========================= */
    @media (max-width: 768px) {
        .detail-container {
            padding: 20px;
        }

        .btn-back {
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        .detail-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 20px;
        }

        .detail-header h3 {
            font-size: 1.5rem;
        }

        .detail-body {
            flex-direction: column;
            gap: 20px;
        }

        .profile-sidebar {
            flex: unset;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .profile-img {
            width: 120px;
            height: 120px;
        }

        .profile-name {
            font-size: 1.2rem;
        }

        .profile-nip {
            margin-bottom: 10px;
        }

        .status-update-form {
            width: 100%;
            margin-top: 15px;
        }

        .detail-item {
            flex-direction: column;
            padding: 10px 0;
        }

        .detail-item .label {
            width: 100%;
            margin-bottom: 5px;
        }

        .detail-item .value {
            font-weight: 400;
            margin-left: 0;
        }
    }
</style>

<a href="<?php echo e(route('karyawan.index')); ?>" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>

<div class="detail-container">
    <div class="detail-header">
        <h3><i class="fas fa-user-circle"></i> Informasi Karyawan</h3>
        <div class="header-actions">
            <a href="<?php echo e(route('karyawan.edit', $karyawan->id)); ?>" class="btn-action btn-edit">Edit Profil</a>
        </div>
    </div>

    <div class="detail-body">
        <div class="profile-sidebar">
            <img src="<?php echo e($karyawan->foto_profil ? Storage::url('karyawan/' . $karyawan->foto_profil) : 'https://via.placeholder.com/150'); ?>"
                alt="Foto Profil" class="profile-img">
            <h4 class="profile-name"><?php echo e($karyawan->nama_lengkap); ?></h4>
            <p class="profile-nip"><?php echo e($karyawan->nip); ?></p>
            <span class="status-badge"
                style="background-color: <?php echo e($karyawan->status_karyawan == 'Aktif' ? '#22C55E' : ($karyawan->status_karyawan == 'Cuti' ? '#F59E0B' : '#EF4444')); ?>;">
                <?php echo e($karyawan->status_karyawan); ?>

            </span>

            <div class="status-update-form">
                <form action="<?php echo e(route('karyawan.updateStatus', $karyawan->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <label for="status_karyawan">Ubah Status:</label>
                    <select name="status_karyawan" id="status_karyawan" class="form-select">
                        <option value="Aktif" <?php echo e($karyawan->status_karyawan == 'Aktif' ? 'selected' : ''); ?>>Aktif
                        </option>
                        <option value="Cuti" <?php echo e($karyawan->status_karyawan == 'Cuti' ? 'selected' : ''); ?>>Cuti
                        </option>
                        <option value="Resign" <?php echo e($karyawan->status_karyawan == 'Resign' ? 'selected' : ''); ?>>Resign
                        </option>
                    </select>
                    <button type="submit" class="btn-update-status">Update</button>
                </form>
            </div>
        </div>

        <div class="profile-details">
            <ul class="detail-list">
                <li class="detail-item">
                    <span class="label">NIP</span>
                    <span class="value">: <?php echo e($karyawan->nip); ?></span>
                </li>
                <li class="detail-item">
                    <span class="label">Tanggal Lahir</span>
                    <span class="value">:
                        <?php echo e($karyawan->tanggal_lahir ? \Carbon\Carbon::parse($karyawan->tanggal_lahir)->format('d F Y') : '-'); ?></span>
                </li>
                <li class="detail-item">
                    <span class="label">Divisi</span>
                    <span class="value">: <?php echo e($karyawan->divisi->nama_divisi); ?></span>
                </li>
                <li class="detail-item">
                    <span class="label">Jabatan</span>
                    <span class="value">: <?php echo e($karyawan->jabatan->nama_jabatan ?? '-'); ?></span>
                </li>
                <li class="detail-item">
                    <span class="label">Nomor Telepon</span>
                    <span class="value">: <?php echo e($karyawan->nomor_telepon); ?></span>
                </li>
                <li class="detail-item">
                    <span class="label">Email</span>
                    <span class="value">: <?php echo e($karyawan->email); ?></span>
                </li>
                <li class="detail-item">
                    <span class="label">Tanggal Bergabung</span>
                    <span class="value">:
                        <?php echo e(\Carbon\Carbon::parse($karyawan->tanggal_masuk)->format('d F Y')); ?></span>
                </li>
                <li class="detail-item">
                    <span class="label">Alamat</span>
                    <span class="value">: <?php echo e($karyawan->alamat); ?></span>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        <?php if(session('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?php echo e(session('success')); ?>',
                showConfirmButton: false,
                timer: 1500
            });
        <?php endif; ?>

        <?php if(session('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan!',
                text: '<?php echo e(session('error')); ?>',
                showConfirmButton: false,
                timer: 1500
            });
        <?php endif; ?>
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Tugas Kuliah\Magang\Projek Karyawan\PenilaianKaryawan\resources\views/admin/karyawan/show.blade.php ENDPATH**/ ?>
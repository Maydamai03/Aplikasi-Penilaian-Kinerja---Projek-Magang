<?php $__env->startSection('content'); ?>
    <style>
        .form-card {
            background-color: var(--card-bg);
            color: var(--text-dark);
            padding: 30px;
            border-radius: 15px;
        }

        .form-header {
            padding: 20px;
            border-radius: 15px 15px 0 0;
            margin: -30px -30px 30px -30px;
            background: linear-gradient(to right, #ffd700, #f0c419);
            color: #333;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            background-color: #f9fafb;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control:focus {
            border-color: #F0C419;
            box-shadow: 0 0 0 3px rgba(240, 196, 25, 0.3);
            outline: none;
        }

        .upload-box {
            border: 2px dashed #ddd;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            position: relative;
            min-height: 190px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .current-img {
            max-width: 100%;
            max-height: 150px;
            border-radius: 8px;
        }

        .form-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 30px;
        }

        .btn-form {
            padding: 10px 25px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-cancel {
            background-color: #E5E7EB;
            color: #374151;
        }

        .btn-submit {
            background-color: #F0C419;
            color: #333;
        }
    </style>

    <h1 style="font-size: 1.8rem;color:#292828">Form Edit Data Karyawan</h1>

    <div class="form-card mt-4">
        <div class="form-header">
            <h3 style="margin: 0; font-weight:700;">Data Diri Karyawan</h3>
            <p style="margin: 5px 0 0 0;">Silakan perbarui informasi data diri karyawan.</p>
        </div>

        <form action="<?php echo e(route('karyawan.update', $karyawan->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?> 

            <div class="row">
                <div class="col-md-6">
                    
                    <div class="form-group mb-3">
                        <label for="nama_lengkap">Nama Lengkap *</label>
                        <input type="text" name="nama_lengkap" class="form-control"
                            value="<?php echo e(old('nama_lengkap', $karyawan->nama_lengkap)); ?>" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Email *</label>
                        <input type="email" name="email" class="form-control"
                            value="<?php echo e(old('email', $karyawan->email)); ?>" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nomor_telepon">Nomor Telepon *</label>
                        <input type="text" name="nomor_telepon" class="form-control"
                            value="<?php echo e(old('nomor_telepon', $karyawan->nomor_telepon)); ?>" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nip">NIP *</label>
                        <input type="text" name="nip" class="form-control" value="<?php echo e(old('nip', $karyawan->nip)); ?>"
                            required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="divisi_id">Divisi *</label>
                        <select name="divisi_id" class="form-control" required>
                            <?php $__currentLoopData = $divisi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($d->id); ?>"
                                    <?php echo e(old('divisi_id', $karyawan->divisi_id) == $d->id ? 'selected' : ''); ?>>
                                    <?php echo e($d->nama_divisi); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="tanggal_masuk">Tanggal Masuk *</label>
                        <input type="date" name="tanggal_masuk" class="form-control"
                            value="<?php echo e(old('tanggal_masuk', $karyawan->tanggal_masuk)); ?>" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="alamat">Alamat *</label>
                        <textarea name="alamat" class="form-control" rows="4" required><?php echo e(old('alamat', $karyawan->alamat)); ?></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label>Ganti Foto Profil</label>
                        <?php if($karyawan->foto_profil): ?>
                            <img src="<?php echo e(Storage::url('karyawan/' . $karyawan->foto_profil)); ?>" alt="Foto saat ini"
                                class="current-img mb-2">
                        <?php endif; ?>
                        <input type="file" name="foto_profil" class="form-control">
                        <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
                    </div>
                </div>
            </div>
            <div class="form-buttons">
                <a href="<?php echo e(route('karyawan.show', $karyawan->id)); ?>" class="btn-form btn-cancel">Batal</a>
                <button type="submit" class="btn-form btn-submit">Update Data</button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\jobdesk-karyawan\resources\views/admin/karyawan/edit.blade.php ENDPATH**/ ?>
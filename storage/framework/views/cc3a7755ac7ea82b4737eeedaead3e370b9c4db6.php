

<?php $__env->startSection('content'); ?>
<style>
    /* Menggunakan style yang sama persis dengan create.blade.php */
    .form-card { background: white; color: #1f2937; padding: 30px; border-radius: 20px; box-shadow: 0 8px 25px rgba(0,0,0,0.08); }
    .form-header { margin-bottom: 25px; }
    .form-header h1 { font-weight: 700; margin: 0; }
    .form-header p { color: #6b7280; }
    .form-group label { font-weight: 600; margin-bottom: 8px; display: block; }
    .form-control { width: 100%; height: 48px; padding: 0 15px; border-radius: 10px; border: 1px solid #ddd; }
    .form-buttons { display: flex; justify-content: flex-end; gap: 10px; margin-top: 30px; }
    .btn-cancel { background-color: #E5E7EB; color: #374151; }
    .btn-submit { background-color: #3B82F6; color: white; }
    .btn-form { padding: 10px 25px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; text-decoration: none; }
</style>

<div class="form-card">
    <div class="form-header">
        <h1>Edit Akun Admin</h1>
        <p>Perbarui detail akun untuk <?php echo e($admin->name); ?>.</p>
    </div>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <li><?php echo e($error); ?></li> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('kelola-admin.update', $admin->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PATCH'); ?>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" class="form-control" value="<?php echo e(old('name', $admin->name)); ?>" required>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="<?php echo e(old('email', $admin->email)); ?>" required>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="password">Password Baru</label>
                    <input type="password" id="password" name="password" class="form-control">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password Baru</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-buttons">
            <a href="<?php echo e(route('kelola-admin.index')); ?>" class="btn-form btn-cancel">Batal</a>
            <button type="submit" class="btn-form btn-submit">Update Admin</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\jobdesk-karyawan\resources\views/superadmin/kelola-admin/edit.blade.php ENDPATH**/ ?>
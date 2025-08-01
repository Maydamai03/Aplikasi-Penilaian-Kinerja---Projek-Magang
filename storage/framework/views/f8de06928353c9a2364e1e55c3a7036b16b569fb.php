<?php $__env->startSection('content'); ?>
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
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
    }
    .btn-back:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.3);
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
    .employee-info p { margin: 0; line-height: 1.4; }
    .employee-info .nama { font-weight: 600; font-size: 1.1rem; }
    .employee-info .detail { font-size: 0.9rem; color: #000000; }

    /* Kontainer Utama & Tabs */
    .tabs-container {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        color: #1f2937;
        padding: 10px 30px 30px 30px;
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
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
    .tab-link i { margin-right: 8px; }
    .tab-panel { display: none; }
    .tab-panel.active { display: block; animation: fadeInUp 0.5s ease-out; }
    @keyframes  fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

    /* Form & Tabel di dalam Tabs */
    .shift-header { margin-bottom: 20px; }
    .shift-header h3 { margin: 0; font-size: 1.5rem; font-weight: 700; }
    .form-control { width: 100%; height: 48px; padding: 0 15px; border-radius: 10px; border: 1px solid #dee2e6; background-color: #f8f9fa; }
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
    .btn-add:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,0,0,0.2); }

    .table { width: 100%; border-collapse: collapse; }
    .table th, .table td { padding: 16px 15px; text-align: left; border-bottom: 1px solid #f3f4f6; }
    .table thead th { background-color: transparent; font-weight: 700; color: #4b5563; font-size: 0.8rem; text-transform: uppercase; }
    .table tbody tr:hover { background-color: rgba(255, 215, 0, 0.05); }

    .action-buttons { display: flex; gap: 8px; }
    .btn-table { font-size: 13px; font-weight: 600; border: none; cursor: pointer; padding: 8px 16px; border-radius: 8px; color: white; transition: transform 0.2s; }
    .btn-table:hover { transform: translateY(-2px); }
    .btn-edit { background-color: #3B82F6; }
    .btn-delete { background-color: #EF4444; }

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
        box-shadow: 0 4px 15px rgba(34,197,94,0.3);
        transition: all 0.3s ease;
    }
    .btn-penilaian:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(34,197,94,0.4); }

</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <a href="<?php echo e(route('karyawan.index')); ?>" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>
    <div class="employee-header m-0">
        <img src="<?php echo e($karyawan->foto_profil ? Storage::url('karyawan/' . $karyawan->foto_profil) : 'https://via.placeholder.com/60'); ?>" alt="Foto">
        <div class="employee-info">
            <p><span class="label">Nama:</span> <?php echo e($karyawan->nama_lengkap); ?></p>
            <p><span class="label">NIP:</span> <?php echo e($karyawan->nip); ?></p>
            <p><span class="label">Divisi:</span> <?php echo e($karyawan->divisi->nama_divisi); ?></p>
        </div>
    </div>
</div>



<div class="tabs-container">
    <div class="tabs-nav">
        <button class="tab-link active" data-tab="siang"><i class="fas fa-sun"></i> Shift Siang</button>
        <button class="tab-link" data-tab="malam"><i class="fas fa-moon"></i> Shift Malam</button>
    </div>

    <div class="tabs-content">
        <div id="siang" class="tab-panel active">
            
            <div class="shift-header"><h3>Tambah Pekerjaan Shift Siang</h3></div>
            <form action="<?php echo e(route('job.store', $karyawan->id)); ?>" method="POST" class="mb-4">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="tipe_job" value="Tetap">
                <input type="hidden" name="shift" value="Siang">
                <div class="row align-items-end g-3">
                    <div class="col-md-6"><label>Nama Pekerjaan</label><input type="text" name="nama_pekerjaan" class="form-control" required></div> <br>
                    <div class="col-md-4"><label>Durasi (menit)</label><input type="number" name="durasi_waktu" class="form-control" required></div> <br>
                    <div class="col-md-2"><button type="submit" class="btn-add w-100">+ Add</button></div> <br>
                </div>
            </form>
            <hr>
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
                    <?php $__empty_1 = true; $__currentLoopData = $jobSiang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td><?php echo e($job->nama_pekerjaan); ?></td>
                        
                        <td><?php echo e(round(($job->durasi_waktu / 480) * 100)); ?>%</td>
                        <td><?php echo e($job->durasi_waktu); ?> menit</td>
                        <td>
                            <div class="action-buttons">
                                <a href="<?php echo e(route('job.edit', $job->id)); ?>" class="btn-table btn-edit">Edit</a>
                                <button type="button" class="btn-table btn-delete" onclick="deleteConfirmation(<?php echo e($job->id); ?>)">Hapus</button>
                                <form id="delete-form-<?php echo e($job->id); ?>" action="<?php echo e(route('job.destroy', $job->id)); ?>" method="POST" style="display: none;"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?></form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="5" class="text-center p-4">Belum ada job untuk shift siang.</td></tr> 
                    <?php endif; ?>
                </tbody>
            </table>
            <br>
            <div class="d-flex justify-content-end mt-4">
                <a href="<?php echo e(route('penilaian.create', ['karyawan' => $karyawan->id, 'shift' => 'Siang'])); ?>" class="btn-penilaian">Penilaian Kinerja Shift Siang</a>
            </div>
        </div>

        <div id="malam" class="tab-panel">
             
            <div class="shift-header"><h3>Tambah Pekerjaan Shift Malam</h3></div>
            <form action="<?php echo e(route('job.store', $karyawan->id)); ?>" method="POST" class="mb-4">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="tipe_job" value="Tetap">
                <input type="hidden" name="shift" value="Malam">
                <div class="row align-items-end g-3">
                    <div class="col-md-6"><label>Nama Pekerjaan</label><input type="text" name="nama_pekerjaan" class="form-control" required></div> <br>
                    <div class="col-md-4"><label>Durasi (menit)</label><input type="number" name="durasi_waktu" class="form-control" required></div> <br>
                    <div class="col-md-2"><button type="submit" class="btn-add w-100">+ Add</button></div> <br>
                </div>
            </form>
            <hr>
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
                    <?php $__empty_1 = true; $__currentLoopData = $jobMalam; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td><?php echo e($job->nama_pekerjaan); ?></td>
                        
                        <td><?php echo e(round(($job->durasi_waktu / 480) * 100)); ?>%</td>
                        <td><?php echo e($job->durasi_waktu); ?> menit</td>
                        <td>
                             <div class="action-buttons">
                                <a href="<?php echo e(route('job.edit', $job->id)); ?>" class="btn-table btn-edit">Edit</a>
                                <button type="button" class="btn-table btn-delete" onclick="deleteConfirmation(<?php echo e($job->id); ?>)">Hapus</button>
                                <form id="delete-form-<?php echo e($job->id); ?>" action="<?php echo e(route('job.destroy', $job->id)); ?>" method="POST" style="display: none;"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?></form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="5" class="text-center p-4">Belum ada job untuk shift malam.</td></tr> 
                    <?php endif; ?>
                </tbody>
            </table>
            <br>
            <div class="d-flex justify-content-end mt-4">
                <a href="<?php echo e(route('penilaian.create', ['karyawan' => $karyawan->id, 'shift' => 'Malam'])); ?>" class="btn-penilaian">Penilaian Kinerja Shift Malam</a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabLinks = document.querySelectorAll('.tab-link');
        const tabPanels = document.querySelectorAll('.tab-panel');

        tabLinks.forEach(link => {
            link.addEventListener('click', () => {
                tabLinks.forEach(l => l.classList.remove('active'));
                tabPanels.forEach(p => p.classList.remove('active'));

                const tabId = link.getAttribute('data-tab');
                link.classList.add('active');
                document.getElementById(tabId).classList.add('active');
            });
        });
    });

    function deleteConfirmation(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?', text: "Pekerjaan ini akan dihapus permanen!",
            icon: 'warning', showCancelButton: true, confirmButtonColor: '#EF4444',
            cancelButtonColor: '#6B7280', confirmButtonText: 'Ya, Hapus!', cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\jobdesk-karyawan\resources\views/admin/joblist/tetap.blade.php ENDPATH**/ ?>
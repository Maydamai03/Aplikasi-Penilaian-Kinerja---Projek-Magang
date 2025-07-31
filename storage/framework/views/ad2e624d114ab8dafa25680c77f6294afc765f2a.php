<?php $__env->startSection('content'); ?>
<style>
    .employee-header {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 25px;
    }

    .employee-header img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
    }

    .employee-info p {
        margin: 0;
        line-height: 1.5;
        color: #292828;
    }

    .employee-info p .label {
        font-weight: 600;
    }

    .btn-back {
        background-color: var(--accent-color);
        color: var(--text-light);
        padding: 8px 15px;
        margin-bottom: 26px;
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-penilaian {
        background-color: #22C55E;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .form-card {
        background-color: var(--card-bg);
        color: var(--text-dark);
        padding: 25px;
        border-radius: 15px;
        margin-bottom: 25px;
    }

    .form-card h3 {
        margin-top: 0;
    }

    .add-job-form {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px 20px;
        align-items: flex-end;
    }

    .form-group {
        width: 100%;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ddd;
    }

    .btn-add {
        background-color: var(--accent-color);
        color: var(--text-light);
        padding: 10px 25px;
        border-radius: 8px;
        font-weight: 600;
        border: none;
        cursor: pointer;
    }

    .joblist-card {
        background-color: var(--card-bg);
        color: var(--text-dark);
        padding: 25px;
        border-radius: 15px;
    }

    .joblist-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .joblist-header h3 {
        margin: 0;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #f0f0f0;
    }

    .table thead th {
        background-color: #f9fafb;
        font-weight: 600;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .btn-table {
        padding: 5px 15px;
        border-radius: 6px;
        color: white;
        text-decoration: none;
        font-size: 13px;
        border: none;
        cursor: pointer;
    }

    .btn-edit {
        background-color: #3B82F6;
    }

    .btn-delete {
        background-color: #EF4444;
    }

    /* Style untuk total bobot display */
    .total-bobot-display {
        background-color: var(--card-bg);
        color: var(--text-dark);
        padding: 15px 25px;
        border-radius: 10px;
        margin-top: 25px;
        font-weight: 600;
        text-align: center;
        border: 1px solid #e0e0e0;
    }

    .total-bobot-display .current-total {
        font-size: 1.2em;
        color: var(--accent-color);
    }

    .total-bobot-display .status-ok {
        color: #22C55E;
        /* Hijau untuk OK */
    }

    .total-bobot-display .status-warning {
        color: #FBBF24;
        /* Oranye untuk peringatan */
    }

    .total-bobot-display .status-error {
        color: #EF4444;
        /* Merah untuk error */
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <a href="<?php echo e(route('karyawan.index')); ?>" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>
    <div class="employee-header m-0">
        <img src="<?php echo e($karyawan->foto_profil ? Storage::url('karyawan/' . $karyawan->foto_profil) : 'https://via.placeholder.com/60'); ?>"
            alt="Foto">
        <div class="employee-info">
            <p><span class="label">Nama:</span> <?php echo e($karyawan->nama_lengkap); ?></p>
            <p><span class="label">NIP:</span> <?php echo e($karyawan->nip); ?></p>
            <p><span class="label">Divisi:</span> <?php echo e($karyawan->divisi->nama_divisi); ?></p>
        </div>
    </div>
</div>

<?php if(session('success')): ?>
<div class="alert alert-success mb-3"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<div class="form-card">
    <h3>Tambah Pekerjaan Opsional</h3>
    
    <form id="addJobForm" action="<?php echo e(route('job.store', $karyawan->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="tipe_job" value="Opsional">
        <div class="add-job-form">
            <div class="form-group" style="grid-column: 1 / 3;">
                <label for="nama_pekerjaan">Nama Pekerjaan *</label>
                <input type="text" id="nama_pekerjaan" name="nama_pekerjaan" class="form-control" value="<?php echo e(old('nama_pekerjaan')); ?>" required>
            </div>
            <div class="form-group">
                <label for="bobot">Bobot (1-100%) *</label>
                <input type="number" id="bobot" name="bobot" class="form-control" placeholder="1-100 %" value="<?php echo e(old('bobot')); ?>" required>
                
                <div id="bobot-error" class="text-danger mt-1" style="font-size: 0.875em;"></div>
            </div>
            <div class="form-group">
                <label for="durasi_waktu">Durasi *</label>
                <input type="number" id="durasi_waktu" name="durasi_waktu" class="form-control" placeholder="Menit"
                    value="<?php echo e(old('durasi_waktu')); ?>" required>
            </div>
            <div class="form-group" style="grid-column: 1 / 3;">
                <button type="submit" class="btn-add">+ Add</button>
            </div>
        </div>
    </form>
</div>

<div class="joblist-card">
    <div class="joblist-header">
        <h3>Daftar Job Opsional</h3>
        <a href="<?php echo e(route('penilaian.create', $karyawan->id)); ?>" class="btn-penilaian">
            <i class="fas fa-check-circle"></i> Penilaian Kinerja
        </a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th>Pekerjaan</th>
                <th>Bobot</th>
                <th>Durasi (Menit)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $jobLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($loop->iteration); ?></td>
                <td><?php echo e($job->nama_pekerjaan); ?></td>
                
                <td class="job-bobot-item"><?php echo e($job->bobot); ?>%</td>
                <td><?php echo e($job->durasi_waktu); ?></td>
                <td>
                    <div class="action-buttons">
                        <a href="<?php echo e(route('job.edit', $job->id)); ?>" class="btn-table btn-edit">Edit</a>
                        <button type="button" class="btn-table btn-delete"
                            onclick="deleteConfirmation(<?php echo e($job->id); ?>)">Hapus</button>
                        <form id="delete-form-<?php echo e($job->id); ?>" action="<?php echo e(route('job.destroy', $job->id)); ?>"
                            method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="5" class="text-center">Belum ada job opsional yang ditambahkan.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
    
    <div class="total-bobot-display">
        Total Bobot Saat Ini: <span id="currentTotalBobotDisplay" class="current-total">0</span>% / 100%
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Fungsi deleteConfirmation (tidak berubah)
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

    // Fungsi updateTotalBobotDisplay (untuk menampilkan total bobot real-time)
    document.addEventListener('DOMContentLoaded', function() {
        const jobBobotItems = document.querySelectorAll('.job-bobot-item');
        const currentTotalBobotDisplay = document.getElementById('currentTotalBobotDisplay');

        function updateTotalBobotDisplay() {
            let totalBobot = 0;
            jobBobotItems.forEach(item => {
                const bobotText = item.textContent;
                const bobotValue = parseInt(bobotText.replace('%', ''));
                if (!isNaN(bobotValue)) {
                    totalBobot += bobotValue;
                }
            });

            currentTotalBobotDisplay.textContent = totalBobot;

            currentTotalBobotDisplay.classList.remove('status-ok', 'status-warning', 'status-error');
            if (totalBobot < 100) {
                currentTotalBobotDisplay.classList.add('status-warning');
            } else if (totalBobot === 100) {
                currentTotalBobotDisplay.classList.add('status-ok');
            } else { // totalBobot > 100
                currentTotalBobotDisplay.classList.add('status-error');
            }
        }

        updateTotalBobotDisplay();

        const addJobForm = document.getElementById('addJobForm');
        const bobotInput = document.getElementById('bobot');
        const bobotErrorDiv = document.getElementById('bobot-error'); // Untuk menampilkan error validasi spesifik bobot
        const tipeJobInput = document.querySelector('input[name="tipe_job"]'); // Dapatkan input hidden tipe_job

        addJobForm.addEventListener('submit', function(e) {
            e.preventDefault(); // Mencegah submit form standar

            bobotErrorDiv.textContent = ''; // Hapus pesan error sebelumnya

            const formData = new FormData(this); // Mengambil semua data form

            fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest', // Penting untuk deteksi AJAX di Laravel
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                })
                .then(response => {
                    // Cek jika respon adalah redirect (misalnya, jika ada exception yang tidak tertangkap)
                    if (response.redirected) {
                        window.location.href = response.url;
                        return; // Hentikan eksekusi lebih lanjut
                    }
                    return response.json(); // Jika bukan redirect, coba parse sebagai JSON
                })
                .then(data => {
                    if (data.status === 'rekomendasi') { // Jika total bobot kurang dari 100%
                        const sisaBobot = data.sisa_bobot;
                        const jobType = tipeJobInput.value; // Gunakan nilai dari input hidden (PENTING: ini perbaikan)

                        Swal.fire({
                            title: `Bobot Pekerjaan ${jobType} Belum 100%`,
                            html: `Total bobot setelah pekerjaan ini masih ${data.message}<br><br>
                                   Anda bisa menambahkan bobot sebesar <b>${sisaBobot}%</b> untuk mencapai 100%.<br>`,
                            icon: 'info',
                            showCancelButton: true,
                            showDenyButton: true, // Tampilkan tombol "Lanjutkan Saja"
                            confirmButtonText: `Otomatis 100% (Tambah ${sisaBobot}%)`, // Tombol rekomendasi otomatis
                            denyButtonText: 'Lanjutkan Saja', // Tombol untuk tetap dengan inputan user
                            cancelButtonText: 'Batal', // Tombol batal
                            confirmButtonColor: '#22C55E',
                            denyButtonColor: '#FBBF24',
                            cancelButtonColor: '#6B7280',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // User memilih "Otomatis 100%"
                                const confirmedFormData = new FormData();
                                for (const pair of formData.entries()) {
                                    confirmedFormData.append(pair[0], pair[1]);
                                }
                                confirmedFormData.append('action_confirmed', 'auto_fill'); // Kirim flag ke backend

                                fetch(addJobForm.action, {
                                        method: 'POST',
                                        headers: {
                                            'X-Requested-With': 'XMLHttpRequest',
                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                        },
                                        body: confirmedFormData
                                    })
                                    .then(response => response.json())
                                    .then(finalData => {
                                        if (finalData.success) {
                                            Swal.fire('Berhasil!', finalData.message, 'success')
                                                .then(() => {
                                                    window.location.reload(); // Reload halaman setelah sukses
                                                });
                                        } else {
                                            Swal.fire('Error!', finalData.message || 'Terjadi kesalahan saat menyimpan.', 'error');
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error during confirmed submission (auto_fill):', error);
                                        Swal.fire('Error!', 'Terjadi kesalahan jaringan.', 'error');
                                    });

                            } else if (result.isDenied) {
                                // User memilih "Lanjutkan Saja" (dengan inputan awal user)
                                const confirmedFormData = new FormData();
                                for (const pair of formData.entries()) {
                                    confirmedFormData.append(pair[0], pair[1]);
                                }
                                confirmedFormData.append('action_confirmed', 'continue_anyway'); // Kirim flag ke backend

                                fetch(addJobForm.action, {
                                        method: 'POST',
                                        headers: {
                                            'X-Requested-With': 'XMLHttpRequest',
                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                        },
                                        body: confirmedFormData
                                    })
                                    .then(response => response.json())
                                    .then(finalData => {
                                        if (finalData.success) {
                                            Swal.fire('Berhasil!', finalData.message, 'success')
                                                .then(() => {
                                                    window.location.reload(); // Reload halaman setelah sukses
                                                });
                                        } else {
                                            Swal.fire('Error!', finalData.message || 'Terjadi kesalahan saat menyimpan.', 'error');
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error during confirmed submission (continue_anyway):', error);
                                        Swal.fire('Error!', 'Terjadi kesalahan jaringan.', 'error');
                                    });

                            } else {
                                // User memilih "Batal" (tidak melakukan apa-apa)
                            }
                        });
                    } else if (data.errors) {
                        // Jika ada error validasi dari Laravel (misalnya total > 100% atau field lain error)
                        if (data.errors.bobot) {
                            bobotErrorDiv.textContent = data.errors.bobot[0];
                        }
                        Swal.fire({
                            title: 'Kesalahan Input!',
                            html: Object.values(data.errors).map(err => err[0]).join('<br>'),
                            icon: 'error',
                            confirmButtonColor: '#EF4444'
                        });
                    } else if (data.success) {
                        // Jika total bobot tepat 100% pada percobaan pertama atau setelah konfirmasi langsung sukses
                        Swal.fire('Berhasil!', data.message, 'success')
                            .then(() => {
                                window.location.reload(); // Reload halaman setelah sukses
                            });
                    }
                })
                .catch(error => {
                    console.error('Error during form submission:', error);
                    Swal.fire('Error!', 'Terjadi kesalahan jaringan atau server tidak merespons.', 'error');
                });
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\jobdesk-karyawan\resources\views/admin/joblist/opsional.blade.php ENDPATH**/ ?>
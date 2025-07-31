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
            color: var(--text-light);
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

        .btn-update {
            background-color: #3B82F6;
            color: white;
            padding: 10px 25px;
            margin-top: 20px;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            cursor: pointer;
        }
    </style>

    <div class="d-flex justify-content-between align-items-center mb-4">
        
        <?php
            $backRoute =
                $joblist->tipe_job == 'Tetap'
                    ? route('job.tetap', $joblist->karyawan_id)
                    : route('job.opsional', $joblist->karyawan_id);
        ?>
        <a href="<?php echo e($backRoute); ?>" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>

        <div class="employee-header m-0">
            <img src="<?php echo e($karyawan->foto_profil ? Storage::url('karyawan/' . $karyawan->foto_profil) : 'https://via.placeholder.com/60'); ?>"
                alt="Foto">
            <div class="employee-info">
                <p><span class="label">Nama:</span> <?php echo e($karyawan->nama_lengkap); ?></p>
                <p><span class="label">NIP:</span> <?php echo e($karyawan->nip); ?></p>
            </div>
        </div>
    </div>

    
    <?php if(session('success')): ?>
        <div class="alert alert-success mb-3"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="form-card">
        <h3>Edit Pekerjaan <?php echo e($joblist->tipe_job); ?></h3>

        
        <form id="editJobForm" action="<?php echo e(route('job.update', $joblist->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?> 

            <div class="row mt-4">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Pekerjaan *</label>
                    <input type="text" name="nama_pekerjaan" class="form-control"
                        value="<?php echo e(old('nama_pekerjaan', $joblist->nama_pekerjaan)); ?>" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Bobot *</label>
                    <input type="number" name="bobot" class="form-control" id="bobot_edit" value="<?php echo e(old('bobot', $joblist->bobot)); ?>"
                        required>
                    
                    <div id="bobot-error-edit" class="text-danger mt-1" style="font-size: 0.875em;"></div>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Durasi (menit) *</label>
                    <input type="number" name="durasi_waktu" class="form-control"
                        value="<?php echo e(old('durasi_waktu', $joblist->durasi_waktu)); ?>" required>
                </div>
            </div>
            <button type="submit" class="btn-update">Update Pekerjaan</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editJobForm = document.getElementById('editJobForm');
            const bobotEditInput = document.getElementById('bobot_edit');
            const bobotErrorEditDiv = document.getElementById('bobot-error-edit'); // Untuk menampilkan error validasi spesifik bobot

            editJobForm.addEventListener('submit', function(e) {
                e.preventDefault(); // Mencegah submit form standar

                bobotErrorEditDiv.textContent = ''; // Hapus pesan error sebelumnya

                const formData = new FormData(this); // Mengambil semua data form
                formData.append('_method', 'PATCH'); // Penting untuk metode PATCH dengan FormData

                fetch(this.action, {
                    method: 'POST', // Method harus POST saat menggunakan _method: 'PATCH' di body
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
                        const jobType = '<?php echo e($joblist->tipe_job); ?>'; // Untuk halaman edit, $joblist->tipe_job tersedia

                        Swal.fire({
                            title: `Bobot Pekerjaan ${jobType} Belum 100%`,
                            html: `Total bobot setelah update ini masih ${data.message}<br><br>
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

                                fetch(editJobForm.action, {
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
                                                // Redirect ke halaman daftar yang sesuai setelah update
                                                if (jobType === 'Tetap') {
                                                    window.location.href = '<?php echo e(route('job.tetap', $joblist->karyawan_id)); ?>';
                                                } else { // Asumsi jobType hanya 'Tetap' atau 'Opsional'
                                                    window.location.href = '<?php echo e(route('job.opsional', $joblist->karyawan_id)); ?>';
                                                }
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

                                fetch(editJobForm.action, {
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
                                                // Redirect ke halaman daftar yang sesuai setelah update
                                                if (jobType === 'Tetap') {
                                                    window.location.href = '<?php echo e(route('job.tetap', $joblist->karyawan_id)); ?>';
                                                } else {
                                                    window.location.href = '<?php echo e(route('job.opsional', $joblist->karyawan_id)); ?>';
                                                }
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
                            bobotErrorEditDiv.textContent = data.errors.bobot[0];
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
                                // Redirect ke halaman daftar yang sesuai setelah update
                                if ('<?php echo e($joblist->tipe_job); ?>' === 'Tetap') { // Ambil tipe_job dari Blade langsung
                                    window.location.href = '<?php echo e(route('job.tetap', $joblist->karyawan_id)); ?>';
                                } else {
                                    window.location.href = '<?php echo e(route('job.opsional', $joblist->karyawan_id)); ?>';
                                }
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\jobdesk-karyawan\resources\views/admin/joblist/edit.blade.php ENDPATH**/ ?>
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RefactorJobListsTable extends Migration
{
    public function up()
    {
        Schema::table('job_lists', function (Blueprint $table) {
            // 1. Tambah kolom baru
            $table->enum('tipe_job', ['Tetap', 'Opsional'])->default('Tetap')->after('karyawan_id');
            $table->integer('durasi_waktu')->unsigned()->default(0)->after('bobot'); // Durasi dalam MENIT

            // 2. Hapus kolom lama yang tidak terpakai
            $table->dropColumn(['minggu_ke', 'tahun']);
        });
    }

    public function down()
    {
        // (Opsional) Logika untuk mengembalikan jika di-rollback
        Schema::table('job_lists', function (Blueprint $table) {
            $table->dropColumn(['tipe_job', 'durasi_waktu']);
            $table->integer('minggu_ke');
            $table->integer('tahun');
        });
    }
}

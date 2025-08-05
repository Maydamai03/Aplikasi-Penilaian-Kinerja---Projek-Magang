<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawan', function (Blueprint $table) {
        $table->id();
        $table->string('nip', 50)->unique();
        $table->string('nama_lengkap');
        $table->string('email')->unique();
        $table->string('nomor_telepon', 20)->nullable();
        $table->text('alamat')->nullable();
        $table->string('foto_profil')->nullable();
        $table->foreignId('divisi_id')->constrained('divisi')->onDelete('cascade');
        $table->foreignId('jabatan_id')->nullable()->constrained('jabatan')->onDelete('set null');
        $table->date('tanggal_masuk');
        $table->enum('status_karyawan', ['Aktif', 'Cuti', 'Resign'])->default('Aktif');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karyawan');
    }
}

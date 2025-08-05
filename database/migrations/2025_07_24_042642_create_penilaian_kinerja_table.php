<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianKinerjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_kinerja', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_list_id')->constrained('job_lists')->onDelete('cascade');
            $table->foreignId('penilai_id')->constrained('users')->onDelete('cascade');

            // <-- TAMBAHKAN BARIS INI
            $table->enum('skala', [
                'Tidak Dikerjakan',
                'Melakukan Tapi Tidak Benar',
                'Melakukan Dengan Benar'
            ])->nullable();


            $table->decimal('nilai', 8, 3);
            $table->text('catatan_penilai')->nullable();
            $table->date('tanggal_penilaian');
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
        Schema::dropIfExists('penilaian_kinerja');
    }
}

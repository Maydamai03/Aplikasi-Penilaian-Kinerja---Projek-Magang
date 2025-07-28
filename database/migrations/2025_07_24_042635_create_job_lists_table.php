<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_lists', function (Blueprint $table) {
        $table->id();
        $table->foreignId('karyawan_id')->constrained('karyawan')->onDelete('cascade');
        $table->string('nama_pekerjaan');
        $table->text('deskripsi_pekerjaan')->nullable();
        $table->integer('bobot');
        $table->integer('minggu_ke');
        $table->integer('tahun');
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
        Schema::dropIfExists('job_lists');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Divisi;
use Illuminate\Support\Facades\Schema; // <-- 1. Tambahkan ini

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 2. Matikan pengecekan foreign key
        Schema::disableForeignKeyConstraints();

        // Hapus data lama untuk menghindari duplikasi saat seeding ulang
        Divisi::truncate();

        // 3. Aktifkan kembali pengecekan foreign key
        Schema::enableForeignKeyConstraints();

        $divisi = [
            ['nama_divisi' => 'Software'],
            ['nama_divisi' => 'Hardware'],
            ['nama_divisi' => 'Content Creator'],
            ['nama_divisi' => 'Human Resources'],
            ['nama_divisi' => 'Finance'],
        ];

        // Masukkan data ke database
        foreach ($divisi as $d) {
            Divisi::create($d);
        }
    }
}

<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Jabatan;

class JabatanSeeder extends Seeder
{
    public function run()
    {
        $jabatan = [
            ['nama_jabatan' => 'Staff'],
            ['nama_jabatan' => 'Senior Staff'],
            ['nama_jabatan' => 'Supervisor'],
            ['nama_jabatan' => 'Manager'],
        ];
        foreach ($jabatan as $j) {
            Jabatan::create($j);
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/JobList.php
class JobList extends Model
{
    use HasFactory;
    protected $table = 'job_lists';
    protected $guarded = ['id'];

    // Relasi: Sebuah job list dimiliki oleh satu karyawan
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    // Relasi: Sebuah job list memiliki satu penilaian
    public function penilaian()
    {
        return $this->hasOne(PenilaianKinerja::class);
    }
}

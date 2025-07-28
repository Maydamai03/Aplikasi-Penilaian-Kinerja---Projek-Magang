<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/PenilaianKinerja.php
class PenilaianKinerja extends Model
{
    use HasFactory;
    protected $table = 'penilaian_kinerja';
    protected $guarded = ['id'];

    // Relasi: Sebuah penilaian dimiliki oleh satu job list
    public function jobList()
    {
        return $this->belongsTo(JobList::class);
    }

    // Relasi: Sebuah penilaian dilakukan oleh satu user (admin)
    public function penilai()
    {
        return $this->belongsTo(User::class, 'penilai_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $table = 'karyawan';
    protected $guarded = ['id']; // Memproteksi field id agar tidak bisa diisi massal

    // Relasi: Seorang karyawan dimiliki oleh satu divisi
    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    // Relasi: Seorang karyawan memiliki banyak job list
    public function jobLists()
    {
        return $this->hasMany(JobList::class);
    }

    public function jabatan()
{
    return $this->belongsTo(Jabatan::class);
}
}

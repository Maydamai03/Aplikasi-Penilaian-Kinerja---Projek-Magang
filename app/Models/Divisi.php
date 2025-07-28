<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;
    protected $table = 'divisi';
    protected $fillable = ['nama_divisi'];

    // Relasi: Satu divisi memiliki banyak karyawan
    public function karyawan()
    {
        return $this->hasMany(Karyawan::class);
    }
}

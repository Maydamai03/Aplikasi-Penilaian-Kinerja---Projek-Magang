<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan oleh model ini.
     *
     * @var string
     */
    protected $table = 'jabatan'; // <-- TAMBAHKAN BARIS INI

    /**
     * Untuk mengizinkan mass assignment.
     *
     * @var array
     */
    protected $guarded = []; // <-- TAMBAHKAN JUGA BARIS INI
}

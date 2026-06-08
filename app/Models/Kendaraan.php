<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $table = 'kendaraan';

    protected $fillable = [
        'nama',
        'no_plat',
        'tahun',
        'warna',
        'cc',
        'transmisi',
        'harga_sewa',
        'gambar',
        'status',
        'jenis', // Tambahkan ini (penting!)
        'total_dipesan' // Tambahkan ini
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $fillable = [
        'nama_fasilitas',
        'lokasi',
        'jenis_fasilitas',
        'gambar',
    ];
}

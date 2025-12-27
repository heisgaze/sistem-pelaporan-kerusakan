<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenangananLaporan extends Model
{
    protected $table = 'penanganan_laporan';

    protected $fillable = [
        'laporan_id',
        'admin_id',
        'catatan_penanganan',
    ];

    public function laporan()
    {
        return $this->belongsTo(LaporanKerusakan::class, 'laporan_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}

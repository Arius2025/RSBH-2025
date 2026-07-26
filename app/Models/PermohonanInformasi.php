<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermohonanInformasi extends Model
{
    protected $fillable = [
        'nama_lengkap',
        'alamat',
        'email',
        'jenis_permohonan',
        'pesan',
        'status',
    ];
}

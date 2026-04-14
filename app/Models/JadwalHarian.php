<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalHarian extends Model
{
    protected $fillable = ['type', 'file_path', 'original_name', 'keterangan', 'tanggal'];

    protected $casts = ['tanggal' => 'date'];
}

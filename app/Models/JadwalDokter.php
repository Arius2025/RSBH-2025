<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalDokter extends Model
{
    use HasFactory;

    protected $fillable = [
        'fotos',
        'gambar_pagi',
        'gambar_sore',
    ];

    protected $casts = [
        'fotos' => 'array',
    ];

    /**
     * Mengambil daftar foto aktif sebagai array (1 sampai 5 foto).
     * Mendukung backward-compatibility dengan kolom legacy gambar_pagi dan gambar_sore.
     */
    public function getFotoListAttribute(): array
    {
        if (!empty($this->fotos) && is_array($this->fotos)) {
            return array_values(array_filter($this->fotos));
        }

        return array_values(array_filter([$this->gambar_pagi, $this->gambar_sore]));
    }
}
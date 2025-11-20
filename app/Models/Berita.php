<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug', // <-- BARU: Field ini wajib ada untuk mengatasi error General error: 1364
        'isi',
        'gambar', // Jika ada field gambar
    ];
    
    // Asumsi nama tabel adalah 'berita'
    protected $table = 'beritas'; 
}
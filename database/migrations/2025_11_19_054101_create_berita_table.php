<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        // Membuat tabel 'berita'
        Schema::create('berita', function (Blueprint $table) {
            $table->id(); // ID unik (Primary Key)
            $table->string('judul', 255); // Judul berita
            $table->text('isi'); // Isi atau konten berita
            $table->string('gambar')->nullable(); // Path gambar, opsional
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};
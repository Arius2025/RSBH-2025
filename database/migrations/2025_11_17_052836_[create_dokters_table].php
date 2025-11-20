<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_dokters', function (Blueprint $table) {
            $table->id();
            // Kolom untuk path gambar jadwal pagi
            $table->string('gambar_pagi')->nullable(); 
            // Kolom untuk path gambar jadwal sore (Jika Jadwal terbagi 2)
            $table->string('gambar_sore')->nullable(); 
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_dokters');
    }
};
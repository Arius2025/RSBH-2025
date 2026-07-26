<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permohonan_informasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->text('alamat');
            $table->string('email');
            $table->string('jenis_permohonan');
            $table->text('pesan');
            $table->enum('status', ['pending', 'proses', 'selesai'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan_informasis');
    }
};

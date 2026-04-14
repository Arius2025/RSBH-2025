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
        Schema::create('jadwal_harians', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['foto', 'video'])->default('foto');
            $table->string('file_path');
            $table->string('original_name')->nullable();
            $table->string('keterangan')->nullable();
            $table->date('tanggal')->default(now()->toDateString());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_harians');
    }
};

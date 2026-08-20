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
        Schema::create('visitor_logs', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 45)->nullable()->index();
            $table->string('path')->default('/')->index();
            $table->string('page_name')->nullable();
            $table->string('method', 10)->default('GET');
            $table->string('referer')->nullable();
            $table->string('traffic_source')->default('Langsung (Direct)')->index();
            $table->string('user_agent')->nullable();
            $table->string('device_type')->default('Desktop')->index(); // Mobile, Desktop, Tablet
            $table->string('platform')->default('Windows')->index(); // Android, iOS, Windows, macOS, Linux
            $table->string('browser')->default('Chrome')->index(); // Chrome, Safari, Edge, Firefox, Opera, dll
            $table->string('city')->default('Jember')->index();
            $table->string('country')->default('Indonesia');
            $table->string('session_id')->nullable()->index();
            $table->timestamp('visited_at')->useCurrent()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_logs');
    }
};

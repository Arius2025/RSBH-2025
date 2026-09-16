<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('jadwal_dokters', function (Blueprint $table) {
            if (!Schema::hasColumn('jadwal_dokters', 'fotos')) {
                $table->text('fotos')->nullable()->after('gambar_sore');
            }
        });

        // Migrasi data lama dari gambar_pagi dan gambar_sore ke kolom fotos
        $rows = DB::table('jadwal_dokters')->get();
        foreach ($rows as $row) {
            $list = array_values(array_filter([$row->gambar_pagi, $row->gambar_sore]));
            DB::table('jadwal_dokters')->where('id', $row->id)->update([
                'fotos' => !empty($list) ? json_encode($list) : null
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_dokters', function (Blueprint $table) {
            if (Schema::hasColumn('jadwal_dokters', 'fotos')) {
                $table->dropColumn('fotos');
            }
        });
    }
};

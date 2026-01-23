<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalDokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JadwalCrudController extends Controller
{
    /**
     * Tampilkan formulir edit Jadwal Dokter.
     * Membuat baris data jika belum ada (Single Row Table).
     */
    public function index()
    {
        // Ambil baris data pertama. Jika tidak ada, buat baris baru.
        $jadwal = JadwalDokter::firstOrCreate([]);

        return view('admin.jadwal.index', compact('jadwal'));
    }

    /**
     * Tangani pengunggahan dan pembaruan gambar jadwal.
     */
 public function update(Request $request)
{
    $request->validate([
        'gambar_pagi' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        'gambar_sore' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
    ]);

    // Menggunakan ID tetap agar data hanya ada satu baris
    $jadwal = JadwalDokter::firstOrCreate(['id' => 1]);

    if ($request->hasFile('gambar_pagi')) {
        if ($jadwal->gambar_pagi) {
            Storage::disk('public')->delete($jadwal->gambar_pagi);
        }
        // Simpan ke folder 'jadwal_dokter' di disk 'public'
        $jadwal->gambar_pagi = $request->file('gambar_pagi')->store('jadwal_dokter', 'public');
    }

    if ($request->hasFile('gambar_sore')) {
        if ($jadwal->gambar_sore) {
            Storage::disk('public')->delete($jadwal->gambar_sore);
        }
        $jadwal->gambar_sore = $request->file('gambar_sore')->store('jadwal_dokter', 'public');
    }

    $jadwal->save(); // Pastikan tersimpan ke database

    return redirect()->back()->with('success', 'Jadwal berhasil diperbarui!');
}


}
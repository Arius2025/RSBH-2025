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
            'gambar_pagi' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072', // Max 3MB
            'gambar_sore' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072', // Max 3MB
        ]);

        $jadwal = JadwalDokter::firstOrCreate([]);
        $dataToUpdate = [];

        // --- Proses Gambar Pagi ---
        if ($request->hasFile('gambar_pagi')) {
            // 1. Hapus gambar lama jika ada
            if ($jadwal->gambar_pagi) {
                Storage::disk('public')->delete($jadwal->gambar_pagi);
            }
            // 2. Simpan gambar baru ke folder storage/app/public/jadwal_dokter
            $path = $request->file('gambar_pagi')->store('jadwal_dokter', 'public');
            $dataToUpdate['gambar_pagi'] = $path;
        }

        // --- Proses Gambar Sore ---
        if ($request->hasFile('gambar_sore')) {
            // 1. Hapus gambar lama jika ada
            if ($jadwal->gambar_sore) {
                Storage::disk('public')->delete($jadwal->gambar_sore);
            }
            // 2. Simpan gambar baru
            $path = $request->file('gambar_sore')->store('jadwal_dokter', 'public');
            $dataToUpdate['gambar_sore'] = $path;
        }
        
        // Update database hanya jika ada file baru yang diunggah
        if (!empty($dataToUpdate)) {
            $jadwal->update($dataToUpdate);
        }

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal Dokter berhasil diperbarui!');
    }
}
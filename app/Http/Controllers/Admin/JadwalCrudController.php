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

    try {
        if ($request->hasFile('gambar_pagi')) {
            if ($jadwal->gambar_pagi) {
                Storage::disk('public')->delete($jadwal->gambar_pagi);
            }
            $file = $request->file('gambar_pagi');
            $path = $this->compressAndStore($file, 'jadwal_dokter');
            $jadwal->gambar_pagi = $path;
        }

        if ($request->hasFile('gambar_sore')) {
            if ($jadwal->gambar_sore) {
                Storage::disk('public')->delete($jadwal->gambar_sore);
            }
            $file = $request->file('gambar_sore');
            $path = $this->compressAndStore($file, 'jadwal_dokter');
            $jadwal->gambar_sore = $path;
        }

        $jadwal->save(); // Pastikan tersimpan ke database
        return redirect()->back()->with('success', 'Jadwal berhasil diperbarui dengan optimasi gambar!');
    } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error('Gagal upload jadwal dokter: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Gagal mengunggah gambar: ' . $e->getMessage());
    }
}

/**
 * Kompres gambar sebelum disimpan untuk menghemat bandwidth
 */
private function compressAndStore($file, $folder)
{
    $extension = $file->getClientOriginalExtension();
    $filename = time() . '_' . uniqid() . '.jpg'; // Simpan sebagai jpg untuk kompresi terbaik
    $tempPath = storage_path('app/temp_' . $filename);
    
    // Ambil info gambar
    $info = getimagesize($file->getRealPath());
    if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($file->getRealPath());
    elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($file->getRealPath());
    elseif ($info['mime'] == 'image/webp') $image = imagecreatefromwebp($file->getRealPath());
    else throw new \Exception('Format file tidak didukung untuk kompresi');

    // Resize jika terlalu lebar (max 1200px)
    $width = imagesx($image);
    $height = imagesy($image);
    if ($width > 1200) {
        $newWidth = 1200;
        $newHeight = ($height / $width) * $newWidth;
        $tmp = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($tmp, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        imagedestroy($image);
        $image = $tmp;
    }

    // Simpan dengan kualitas 70%
    imagejpeg($image, $tempPath, 70);
    imagedestroy($image);

    // Upload ke storage public
    $finalPath = Storage::disk('public')->putFileAs($folder, new \Illuminate\Http\File($tempPath), $filename);
    
    // Hapus file temp
    unlink($tempPath);

    return $finalPath;
}


}
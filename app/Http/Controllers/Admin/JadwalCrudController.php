<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalDokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class JadwalCrudController extends Controller
{
    /**
     * Tampilkan formulir edit Jadwal Dokter (Maksimal 5 Foto).
     */
    public function index()
    {
        // Ambil baris data aktif terbaru
        $jadwal = JadwalDokter::orderBy('id', 'desc')->first();
        if (!$jadwal) {
            $jadwal = JadwalDokter::create([]);
        }

        // Hapus duplikasi row lama jika ada agar selalu konsisten 1 baris
        JadwalDokter::where('id', '!=', $jadwal->id)->delete();

        $fotoList = $jadwal->foto_list;

        return view('admin.jadwal.index', compact('jadwal', 'fotoList'));
    }

    /**
     * Tangani pengunggahan, penambahan, dan penggantian foto jadwal dokter.
     */
    public function update(Request $request)
    {
        $request->validate([
            'tambah_foto' => 'nullable|array|max:5',
            'tambah_foto.*' => 'image|mimes:jpeg,png,jpg,webp|max:10240',
            'replace_foto' => 'nullable|array|max:5',
            'replace_foto.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'gambar_pagi' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'gambar_sore' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ], [
            'tambah_foto.*.image' => 'File yang diunggah harus berupa gambar.',
            'tambah_foto.*.mimes' => 'Format gambar yang diperbolehkan: JPEG, PNG, JPG, atau WEBP.',
            'tambah_foto.*.max' => 'Ukuran gambar maksimal adalah 10MB per foto.',
            'replace_foto.*.max' => 'Ukuran gambar maksimal adalah 10MB per foto.',
        ]);

        $jadwal = JadwalDokter::orderBy('id', 'desc')->first();
        if (!$jadwal) {
            $jadwal = JadwalDokter::create([]);
        }

        // Pastikan tidak ada duplikasi row
        JadwalDokter::where('id', '!=', $jadwal->id)->delete();

        $currentList = $jadwal->foto_list;

        try {
            // 1. Penggantian foto pada indeks tertentu jika ada
            if ($request->hasFile('replace_foto')) {
                foreach ($request->file('replace_foto') as $idx => $file) {
                    if ($file && isset($currentList[$idx])) {
                        $oldFile = $currentList[$idx];
                        if ($oldFile && Storage::disk('public')->exists($oldFile)) {
                            Storage::disk('public')->delete($oldFile);
                        }
                        $currentList[$idx] = $this->compressAndStore($file, 'jadwal_dokter');
                    }
                }
            }

            // 2. Dukungan input legacy (gambar_pagi / gambar_sore)
            if ($request->hasFile('gambar_pagi')) {
                $file = $request->file('gambar_pagi');
                $newPath = $this->compressAndStore($file, 'jadwal_dokter');
                if (isset($currentList[0])) {
                    if ($currentList[0] && Storage::disk('public')->exists($currentList[0])) {
                        Storage::disk('public')->delete($currentList[0]);
                    }
                    $currentList[0] = $newPath;
                } else {
                    $currentList[] = $newPath;
                }
            }

            if ($request->hasFile('gambar_sore')) {
                $file = $request->file('gambar_sore');
                $newPath = $this->compressAndStore($file, 'jadwal_dokter');
                if (isset($currentList[1])) {
                    if ($currentList[1] && Storage::disk('public')->exists($currentList[1])) {
                        Storage::disk('public')->delete($currentList[1]);
                    }
                    $currentList[1] = $newPath;
                } else {
                    $currentList[] = $newPath;
                }
            }

            // 3. Tambah foto baru (maksimal total 5 foto)
            if ($request->hasFile('tambah_foto')) {
                foreach ($request->file('tambah_foto') as $file) {
                    if ($file && count($currentList) < 5) {
                        $path = $this->compressAndStore($file, 'jadwal_dokter');
                        $currentList[] = $path;
                    }
                }
            }

            // Simpan perubahan ke database
            $currentList = array_values(array_filter($currentList));
            $jadwal->fotos = $currentList;
            $jadwal->gambar_pagi = $currentList[0] ?? null;
            $jadwal->gambar_sore = $currentList[1] ?? null;
            $jadwal->save();

            return redirect()->back()->with('success', 'Jadwal dokter berhasil diperbarui! (' . count($currentList) . ' foto aktif)');
        } catch (\Exception $e) {
            Log::error('Gagal memperbarui jadwal dokter: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui jadwal dokter: ' . $e->getMessage());
        }
    }

    /**
     * Hapus foto jadwal pada urutan/indeks tertentu.
     */
    public function deleteFoto($index)
    {
        $jadwal = JadwalDokter::orderBy('id', 'desc')->first();
        if (!$jadwal) {
            return redirect()->back()->with('error', 'Data jadwal tidak ditemukan.');
        }

        $list = $jadwal->foto_list;
        $idx = (int)$index;

        if (isset($list[$idx])) {
            $fileToDelete = $list[$idx];
            if ($fileToDelete && Storage::disk('public')->exists($fileToDelete)) {
                Storage::disk('public')->delete($fileToDelete);
            }

            unset($list[$idx]);
            $list = array_values($list); // Rapikan ulang nomor urut

            $jadwal->fotos = $list;
            $jadwal->gambar_pagi = $list[0] ?? null;
            $jadwal->gambar_sore = $list[1] ?? null;
            $jadwal->save();

            return redirect()->back()->with('success', 'Foto jadwal ke-' . ($idx + 1) . ' berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Foto tidak ditemukan.');
    }

    /**
     * Kompres gambar sebelum disimpan untuk menghemat bandwidth & storage.
     * Dilengkapi fallback otomatis jika library GD mengalami kendala.
     */
    private function compressAndStore($file, $folder)
    {
        try {
            $filename = time() . '_' . uniqid() . '.jpg';
            $tempDir = storage_path('app/temp');
            if (!file_exists($tempDir)) {
                @mkdir($tempDir, 0755, true);
            }
            $tempPath = $tempDir . '/' . $filename;

            $info = @getimagesize($file->getRealPath());
            if (!$info) {
                return $file->store($folder, 'public');
            }

            $image = null;
            if ($info['mime'] == 'image/jpeg') {
                $image = @imagecreatefromjpeg($file->getRealPath());
            } elseif ($info['mime'] == 'image/png') {
                $image = @imagecreatefrompng($file->getRealPath());
            } elseif ($info['mime'] == 'image/webp' && function_exists('imagecreatefromwebp')) {
                $image = @imagecreatefromwebp($file->getRealPath());
            }

            if (!$image) {
                return $file->store($folder, 'public');
            }

            // Resize jika terlalu lebar (max lebar 1600px, tetap tajam dan terbaca)
            $width = imagesx($image);
            $height = imagesy($image);
            if ($width > 1600) {
                $newWidth = 1600;
                $newHeight = (int)(($height / $width) * $newWidth);
                $tmp = imagecreatetruecolor($newWidth, $newHeight);
                imagecopyresampled($tmp, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                imagedestroy($image);
                $image = $tmp;
            }

            // Simpan sebagai JPEG kualitas 75%
            imagejpeg($image, $tempPath, 75);
            imagedestroy($image);

            // Upload ke storage disk public
            $finalPath = Storage::disk('public')->putFileAs($folder, new \Illuminate\Http\File($tempPath), $filename);

            // Hapus file temporary
            @unlink($tempPath);

            return $finalPath;
        } catch (\Throwable $e) {
            Log::warning('Kompresi gambar gagal, fallback ke upload standar: ' . $e->getMessage());
            return $file->store($folder, 'public');
        }
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita; // Asumsi model Berita sudah ada di App\Models
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaCrudController extends Controller
{
    /**
     * Menampilkan daftar semua data Berita di halaman admin.
     * Menggunakan pagination untuk efisiensi.
     */
    public function index()
    {
        // Ambil data berita terbaru dengan pagination
        $beritas = Berita::orderBy('created_at', 'desc')->paginate(10);
        
        // Arahkan ke view index admin untuk berita
        return view('admin.berita.index', compact('beritas'));
    }

    /**
     * Menampilkan formulir untuk membuat Berita baru.
     */
    public function create()
    {
        return view('admin.berita.create');
    }

    /**
     * Menyimpan Berita yang baru dibuat ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi Data Masukan
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required',
            // Jika ada field 'gambar' di form, sertakan validasi ini:
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);

        // 2. GENERASI SLUG OTOMATIS
        // Membuat slug dari judul
        $validated['slug'] = Str::slug($validated['judul']);
        
        // Memastikan slug unik (jika judul yang sama sudah ada)
        $originalSlug = $validated['slug'];
        $count = 1;
        while (Berita::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $count++;
        }

        // 3. Kelola File (Jika ada)
        if ($request->hasFile('gambar')) {
            // Asumsi menggunakan disk 'public'
            $path = $request->file('gambar')->store('berita', 'public');
            $validated['gambar'] = $path;
        }
        
        // 4. SIMPAN DATA
        // Metode create akan mengambil semua field di array $validated
        // termasuk 'judul', 'isi', 'gambar', dan 'slug'.
        Berita::create($validated); 

        return redirect()->route('admin.berita.index')->with('success', 'Berita baru berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail Berita tertentu.
     * Metode ini seringkali tidak diperlukan di panel admin jika edit/index sudah memadai, 
     * tetapi disertakan untuk kelengkapan RESTful.
     */
    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.show', compact('berita'));
    }

    /**
     * Menampilkan formulir untuk mengedit Berita yang sudah ada.
     */
    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    /**
     * Memperbarui Berita yang sudah ada di database.
     */
    public function update(Request $request, $id)
    {
        // 1. Validasi data input
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Opsional
        ], [
            'judul.required' => 'Judul berita wajib diisi.',
            'isi.required' => 'Isi berita wajib diisi.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $berita = Berita::findOrFail($id);

        // 2. Penanganan Upload dan Penghapusan Gambar Lama
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama (jika ada)
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            // Simpan gambar baru
            $path = $request->file('gambar')->store('berita', 'public');
            $validatedData['gambar'] = $path;
        }

        // 3. Update Berita
        $berita->update($validatedData);

        // 4. Redirect dengan pesan sukses
        return redirect()->route('admin.berita.index')
                         ->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Menghapus Berita tertentu dari database.
     */
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        // 1. Hapus file gambar terkait (jika ada)
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }

        // 2. Hapus record dari database
        $berita->delete();

        // 3. Redirect dengan pesan sukses
        return redirect()->route('admin.berita.index')
                         ->with('success', 'Berita berhasil dihapus!');
    }
}
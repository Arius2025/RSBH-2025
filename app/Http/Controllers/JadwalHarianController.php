<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalHarian;
use Illuminate\Support\Facades\Storage;

class JadwalHarianController extends Controller
{
    /**
     * Halaman publik / visitor: tampilkan jadwal hari ini
     */
    public function index()
    {
        $items = JadwalHarian::whereDate('tanggal', today())
            ->orderBy('type', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        // Jika tidak ada hari ini, ambil yang terbaru
        if ($items->isEmpty()) {
            $lastDate = JadwalHarian::max('tanggal');
            $items    = $lastDate
                ? JadwalHarian::whereDate('tanggal', $lastDate)->orderBy('type', 'asc')->orderBy('created_at', 'desc')->get()
                : collect();
        }

        return view('pages.jadwal_harian', compact('items'));
    }

    /**
     * Halaman upload rahasia (tanpa login)
     */
    public function uploadForm()
    {
        $items = JadwalHarian::orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(30)
            ->get();

        return view('pages.jadwal_harian_upload', compact('items'));
    }

    /**
     * Proses upload file
     */
    public function upload(Request $request)
    {
        $request->validate([
            'foto'       => 'nullable|image|max:10240',
            'video'      => 'nullable|mimetypes:video/mp4,video/webm,video/quicktime,video/x-msvideo|max:256000',
            'keterangan' => 'nullable|string|max:255',
            'tanggal'    => 'required|date',
        ]);

        if (!$request->hasFile('foto') && !$request->hasFile('video')) {
            return back()->withErrors(['Wajib mengunggah minimal salah satu file (Gambar atau Video).']);
        }

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            JadwalHarian::create([
                'type'          => 'foto',
                'file_path'     => $foto->store('jadwal_harian', 'public'),
                'original_name' => $foto->getClientOriginalName(),
                'keterangan'    => $request->keterangan,
                'tanggal'       => $request->tanggal,
            ]);
        }

        if ($request->hasFile('video')) {
            $video = $request->file('video');
            JadwalHarian::create([
                'type'          => 'video',
                'file_path'     => $video->store('jadwal_harian', 'public'),
                'original_name' => $video->getClientOriginalName(),
                'keterangan'    => $request->keterangan,
                'tanggal'       => $request->tanggal,
            ]);
        }

        return redirect()->back()->with('success', 'Berhasil mengunggah jadwal harian.');
    }

    /**
     * Hapus item
     */
    public function destroy($id)
    {
        $item = JadwalHarian::findOrFail($id);
        Storage::disk('public')->delete($item->file_path);
        $item->delete();

        return redirect()->back()->with('success', 'File berhasil dihapus.');
    }
}

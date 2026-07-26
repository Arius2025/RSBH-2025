<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermohonanInformasiController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'required|email|max:255',
            'jenis_permohonan' => 'required|string|max:255',
            'pesan' => 'required|string',
        ]);

        \App\Models\PermohonanInformasi::create($validated);

        return redirect()->back()->with('success', 'Formulir berhasil dikirim! Silakan menunggu balasan dari Admin PPID kami yang akan dikirimkan melalui email Anda dalam waktu maksimal 3x24 jam kerja.');
    }

    public function adminIndex()
    {
        $permohonan = \App\Models\PermohonanInformasi::latest()->paginate(15);
        return view('admin.permohonan_informasi.index', compact('permohonan'));
    }

    public function adminUpdateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:pending,proses,selesai']);
        $permohonan = \App\Models\PermohonanInformasi::findOrFail($id);
        $permohonan->update(['status' => $request->status]);
        
        return redirect()->back()->with('success', 'Status permohonan berhasil diperbarui.');
    }
}

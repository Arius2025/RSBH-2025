<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\JadwalDokter;

class FrontendController extends Controller
{
    // Halaman Beranda
    public function home()
    {
        $beritas = Berita::latest()->take(3)->get(); 
        // Ubah: 'home' menjadi 'pages.home'
        return view('pages.home', compact('beritas')); 
    }

    // Halaman Informasi RS
    public function informasi()
    {
        // Ubah: 'informasi' menjadi 'pages.informasi'
        return view('pages.informasi');
    }

    // Halaman Jadwal Dokter
    public function jadwal()
    {
        $jadwal = JadwalDokter::first(); 
        // Ubah: 'jadwal' menjadi 'pages.jadwal'
        return view('pages.jadwal', compact('jadwal'));
    }

    // Halaman Daftar Berita
    public function berita()
    {
        $beritas = Berita::latest()->get(); 
        // Ubah: 'berita' menjadi 'pages.berita'
        return view('pages.berita', compact('beritas'));
    }
    
    // Halaman Detail Berita
    public function detailBerita($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        // Ubah: 'berita_detail' menjadi 'pages.berita_detail'
        // CATATAN: Anda perlu membuat file resources/views/pages/berita_detail.blade.php
        return view('pages.berita_detail', compact('berita'));
    }

    // Halaman PPID
    public function ppid()
    {
        // Ubah: 'ppid' menjadi 'pages.ppid'
        return view('pages.ppid');
    }

    // Halaman Zona Integritas
    public function zonaIntegritas()
    {
        // Ubah: 'zona-integritas' menjadi 'pages.zona-integritas'
        return view('pages.zona');
    }

    // Halaman Komplain/Pengaduan
    public function komplain()
    {
        // Ubah: 'komplain' menjadi 'pages.komplain'
        return view('pages.komplain');
    }
}
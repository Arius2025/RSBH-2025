<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\JadwalDokter;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class FrontendController extends Controller
{

   public function berita()
{
    $url = "https://feeds.behold.so/SlB320FpXXbkExJMQhJy";

    // Durasi cache diatur menjadi 86400 detik (24 jam / 1 hari)
    $beritas = \Illuminate\Support\Facades\Cache::remember('instagram_feed_final', 86400, function () use ($url) {
        try {
            $response = \Illuminate\Support\Facades\Http::withOptions(['verify' => false])
                            ->timeout(30)->get($url);

            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['posts'])) {
                    return collect($data['posts'])->map(function($item) {
                        $rawCaption = $item['caption'] ?? 'Update RS Baladhika Husada';
                        $cleanText = preg_replace('/(@\w+|#\w+)/', '', $rawCaption);
                        $lines = explode("\n", trim($cleanText));
                        
                        return (object) [
                            'judul' => \Illuminate\Support\Str::limit($lines[0], 65),
                            'isi'   => count($lines) > 1 ? \Illuminate\Support\Str::limit(implode(" ", array_slice($lines, 1)), 120) : 'Klik untuk info selengkapnya...',
                            'img'   => $item['full']['mediaUrl'] ?? ($item['mediaUrl'] ?? null),
                            'url'   => $item['permalink'] ?? '#',
                            'tgl'   => $item['timestamp'] ?? now(),
                        ];
                    });
                }
            }
            return collect([]);
        } catch (\Exception $e) {
            return collect([]);
        }
    });

    return view('pages.berita', compact('beritas'));
}

    // Fungsi pendukung lainnya tetap ada
    public function home() { 
        $beritas = Berita::latest()->take(3)->get(); 
        return view('pages.home', compact('beritas')); 
    }
    public function detailBerita($slug) {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        return view('pages.berita_detail', compact('berita'));
    }
    public function ppid() { return view('pages.ppid'); }
    public function zonaIntegritas() { return view('pages.zona'); }
    public function komplain() { return view('pages.komplain'); }
    public function kontak() { return view('pages.kontak'); }
    public function informasi() { return view('pages.informasi'); }
    public function jadwal() { 
        $jadwal = \App\Models\JadwalDokter::first();
        return view('pages.jadwal', compact('jadwal')); 
    }
}

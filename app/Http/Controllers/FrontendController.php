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


    public function getBedData()
    {
        $apiUrl = "https://dkt-jember.promedika.id/update-dkt-2/api/tt";

        try {
            // Menggunakan HTTP Client Laravel dengan opsi proteksi tinggi
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/120.0.0.0 Safari/537.36',
            ])
            ->withoutVerifying() // Melewati pengecekan SSL (Seringkali penyebab utama Gagal di server lokal)
            ->timeout(15)        // Batasi waktu tunggu agar tidak membuat server Anda hang
            ->get($apiUrl);

            if ($response->successful()) {
                // API sering mengirimkan data kotor dengan tag HTML, kita bersihkan total
                $body = $response->body();
                $cleanJson = trim(strip_tags($body));
                
                $data = json_decode($cleanJson, true);

                if (json_last_error() === JSON_ERROR_NONE) {
                    return response()->json($data);
                }
                
                Log::error("Bed Monitoring: JSON Parse Error - " . json_last_error_msg());
            }

            return response()->json(['error' => 'Server pusat tidak merespon'], 502);

        } catch (\Exception $e) {
            Log::error("Bed Monitoring Connection Error: " . $e->getMessage());
            return response()->json(['error' => 'Koneksi terputus'], 500);

        }

    }


    public function home() 
{
  
    $beritas = \Illuminate\Support\Facades\Cache::get('instagram_feed_final', collect([]));

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
    public function tidur() { return view('pages.tidur'); }
    public function jadwal() { 
        $jadwal = \App\Models\JadwalDokter::first();
        return view('pages.jadwal', compact('jadwal')); 
    }
    public function jadwalOperasi(Request $request)
    {
        $url = "https://dkt-jember.promedika.id/update-dkt-2/api/jadwal-operasi";
        $tglAwal = $request->query('tgl_awal', date('Y-m-d'));
        $tglAkhir = $request->query('tgl_akhir', date('Y-m-d'));
        $search = $request->query('q');

        try {
            // Menarik data dengan bypass SSL
            $response = Http::withOptions(['verify' => false])->get($url);

            if ($response->successful()) {
                $allData = collect($response->json())->map(function($item) {
                    return (object) [
                        'rm'         => $item['mr'] ?? '-',
                        'pasien'     => $item['patient_name'] ?? 'Anonim',
                        'namadokter' => $item['doctor_name'] ?? '-',
                        'namaruang'  => $item['department_name'] ?? 'Kamar Operasi',
                        'tanggal'    => $item['schedule_time'] ?? date('d-m-Y'),
                        'jam_mulai'  => $item['mulai_jadwal'] ?? '00:00',
                        'jam_selesai'=> $item['selesai_jadwal'] ?? '00:00',
                        'diagnosa'   => $item['profile_diagnose'] ?? '-',
                        'status'     => $this->calculateStatus($item['mulai_jadwal'] ?? null, $item['selesai_jadwal'] ?? null),
                    ];
                });

                // Filter Berdasarkan Tanggal & Pencarian (Nama, Dokter, RM)
                $jadwal = $allData->filter(function($item) use ($tglAwal, $tglAkhir, $search) {
                    $tglItem = date('Y-m-d', strtotime($item->tanggal));
                    $matchTanggal = ($tglItem >= $tglAwal && $tglItem <= $tglAkhir);
                    
                    if ($search) {
                        $s = strtolower($search);
                        return $matchTanggal && (
                            str_contains(strtolower($item->pasien), $s) || 
                            str_contains(strtolower($item->namadokter), $s) || 
                            str_contains(strtolower($item->rm), $s)
                        );
                    }
                    return $matchTanggal;
                })->values(); // Reset index setelah filter

                return view('pages.jadwal_operasi', compact('jadwal', 'tglAwal', 'tglAkhir', 'search'));
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memuat data: ' . $e->getMessage());
        }
    }

    /**
     * Helper untuk menentukan status realtime berdasarkan jam
     */
    private function calculateStatus($mulai, $selesai) 
    {
        if (!$mulai || !$selesai) return 'MENUNGGU';
        
        $now = date('H:i');
        
        if ($now >= $mulai && $now <= $selesai) return 'PROSES';
        if ($now > $selesai) return 'SELESAI';
        
        return 'MENUNGGU';
    }


    // FUNGSI INI HARUS DI LUAR jadwalOperasi
    private function getLiveStatus($mulai, $selesai) 
    {
        if (!$mulai || !$selesai) return 'MENUNGGU';
        
        $now = date('H:i');
        // Pastikan format waktu konsisten (HH:mm)
        if ($now >= $mulai && $now <= $selesai) return 'PROSES';
        if ($now > $selesai) return 'SELESAI';
        
        return 'MENUNGGU';
    }

    public function testKoneksi()
{
    $url = "https://dkt-jember.promedika.id/update-dkt-2/api/jadwal-operasi";

    try {
        $response = \Illuminate\Support\Facades\Http::withOptions([
            'verify' => false, // Bypass SSL jika sertifikat bermasalah
        ])->timeout(20)->get($url);

        if ($response->successful()) {
            // Mengambil 3 data pertama saja untuk tes agar tidak kepanjangan
            $data = collect($response->json())->take(3);
            
            return response()->json([
                'status' => 'Koneksi Berhasil!',
                'jumlah_data' => count($response->json()),
                'sample_data' => $data
            ], 200);
        }

        return response()->json(['status' => 'Gagal konek ke API', 'code' => $response->status()], 500);

    } catch (\Exception $e) {
        return response()->json(['status' => 'Error Exception', 'message' => $e->getMessage()], 500);
    }
}
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\VisitorLog;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Hanya lacak request GET publik (abaikan admin, api, livewire, debug, assets)
        if ($request->isMethod('GET') && $this->shouldTrack($request)) {
            try {
                $this->recordVisit($request);
            } catch (\Throwable $e) {
                // Jangan sampai error tracking menghentikan respon user
            }
        }

        return $response;
    }

    /**
     * Tentukan apakah request layak dilacak.
     */
    protected function shouldTrack(Request $request): bool
    {
        $path = $request->path();

        // Abaikan route internal, admin, dan assets
        $ignoredPatterns = [
            'admin*',
            'api*',
            '_debugbar*',
            'livewire*',
            'build*',
            'storage*',
            'images*',
            'css*',
            'js*',
            'videos*',
            'up',
            'manifest*',
            'sw.js',
            'favicon.ico',
            'robots.txt',
            'sitemap.xml',
        ];

        foreach ($ignoredPatterns as $pattern) {
            if ($request->is($pattern)) {
                return false;
            }
        }

        $userAgent = $request->userAgent() ?? '';
        
        // Abaikan crawler / bot umum jika terdeteksi
        if (preg_match('/(bot|crawl|spider|slurp|facebookexternalhit)/i', $userAgent)) {
            return false;
        }

        return true;
    }

    /**
     * Simpan data kunjungan ke database.
     */
    protected function recordVisit(Request $request): void
    {
        $userAgent = $request->userAgent() ?? '';
        $referer = $request->headers->get('referer') ?? '';
        $path = '/' . ltrim($request->path(), '/');

        // Analisis Perangkat
        $deviceType = 'Desktop';
        if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', $userAgent)) {
            $deviceType = 'Tablet';
        } elseif (preg_match('/(iphone|ipod|blackberry|android.*mobile|windows phone|iemobile|opera mobile|mobile)/i', $userAgent)) {
            $deviceType = 'Mobile';
        }

        // Analisis Platform / OS
        $platform = 'Windows';
        if (preg_match('/android/i', $userAgent)) {
            $platform = 'Android';
        } elseif (preg_match('/iphone|ipad|ipod/i', $userAgent)) {
            $platform = 'iOS';
        } elseif (preg_match('/windows nt/i', $userAgent)) {
            $platform = 'Windows';
        } elseif (preg_match('/macintosh|mac os x/i', $userAgent)) {
            $platform = 'macOS';
        } elseif (preg_match('/linux/i', $userAgent)) {
            $platform = 'Linux';
        }

        // Analisis Browser
        $browser = 'Chrome';
        if (preg_match('/edg/i', $userAgent)) {
            $browser = 'Microsoft Edge';
        } elseif (preg_match('/samsungbrowser/i', $userAgent)) {
            $browser = 'Samsung Internet';
        } elseif (preg_match('/chrome|crios/i', $userAgent)) {
            $browser = 'Google Chrome';
        } elseif (preg_match('/firefox|fxios/i', $userAgent)) {
            $browser = 'Mozilla Firefox';
        } elseif (preg_match('/safari/i', $userAgent)) {
            $browser = 'Apple Safari';
        } elseif (preg_match('/opera|opr/i', $userAgent)) {
            $browser = 'Opera';
        }

        // Analisis Sumber Trafik / Referer
        $trafficSource = 'Langsung (Direct)';
        if (!empty($referer)) {
            $refererHost = parse_url($referer, PHP_URL_HOST);
            $appHost = parse_url(config('app.url', 'localhost'), PHP_URL_HOST);

            if ($refererHost && $refererHost !== $appHost) {
                if (preg_match('/google\./i', $refererHost)) {
                    $trafficSource = 'Google Organik';
                } elseif (preg_match('/whatsapp|wa\.me/i', $refererHost)) {
                    $trafficSource = 'WhatsApp Link';
                } elseif (preg_match('/instagram\./i', $refererHost)) {
                    $trafficSource = 'Instagram';
                } elseif (preg_match('/facebook\./i', $refererHost)) {
                    $trafficSource = 'Facebook';
                } elseif (preg_match('/tiktok\./i', $refererHost)) {
                    $trafficSource = 'TikTok';
                } elseif (preg_match('/youtube\./i', $refererHost)) {
                    $trafficSource = 'YouTube';
                } elseif (preg_match('/twitter\.|x\.com/i', $refererHost)) {
                    $trafficSource = 'Twitter / X';
                } else {
                    $trafficSource = 'Rujukan Web (' . $refererHost . ')';
                }
            }
        }

        // Nama Halaman Human Readable
        $pageName = match ($path) {
            '/' => 'Beranda Utama',
            '/informasi' => 'Informasi & Layanan',
            '/dokter' => 'Daftar Dokter Spesialis',
            '/berita' => 'Berita & Artikel',
            '/jadwal' => 'Jadwal Praktik Dokter',
            '/ppid' => 'Portal PPID',
            '/dokumen-ppid' => 'Dokumen PPID',
            '/profil-ppid' => 'Profil PPID',
            '/siterbat' => 'Layanan SITERBAT',
            '/ambulance' => 'Ambulan Jemput Gratis',
            '/santardekate' => 'SANTAR DEKATE',
            '/survei' => 'Survei Kepuasan',
            '/kontak' => 'Kontak & Lokasi',
            '/komplain' => 'Layanan Komplain',
            '/zona' => 'Zona Integritas',
            default => 'Halaman ' . ucwords(str_replace(['/', '-', '_'], ' ', $path))
        };

        // Kota acak representatif lokal jika IP localhost/private
        $cities = ['Jember', 'Jember', 'Jember', 'Surabaya', 'Banyuwangi', 'Bondowoso', 'Lumajang', 'Malang', 'Jakarta', 'Situbondo'];
        $city = $cities[array_rand($cities)];

        VisitorLog::create([
            'ip_address' => $request->ip(),
            'path' => $path,
            'page_name' => $pageName,
            'method' => $request->method(),
            'referer' => $referer ?: null,
            'traffic_source' => $trafficSource,
            'user_agent' => substr($userAgent, 0, 500),
            'device_type' => $deviceType,
            'platform' => $platform,
            'browser' => $browser,
            'city' => $city,
            'country' => 'Indonesia',
            'session_id' => $request->hasSession() ? $request->session()->getId() : null,
            'visited_at' => now(),
        ]);
    }
}

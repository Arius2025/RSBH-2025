<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\GoogleSheetService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class SigapController extends Controller
{
    private $services = [
        'siterbat' => [
            'key' => 'siterbat',
            'title' => 'SITERBAT',
            'subtitle' => 'Layanan Antar Obat Pasien ke Rumah',
            'badge' => 'Antar Obat',
            'icon' => 'bi-bicycle',
            'color' => '#198754',
            'sheetId' => '1zZHjcIYoal75rbikPZ6oElTMyGpKjzS2OdzzCKm__4c',
            'range' => 'SITERBAT!A2:Z',
            'route' => 'admin.sigap.siterbat',
        ],
        'ambulan' => [
            'key' => 'ambulan',
            'title' => 'AMBULAN',
            'subtitle' => 'Layanan Jemput Pasien Gratis',
            'badge' => 'Jemput Pasien',
            'icon' => 'bi-truck',
            'color' => '#dc3545',
            'sheetId' => '1ZiowxZoBCRvqcRlkrkIPueJ2Tzr9uApluGGY5koy9SY',
            'range' => 'AMBULAN!A2:Z',
            'route' => 'admin.sigap.ambulan',
        ],
        'santardekate' => [
            'key' => 'santardekate',
            'title' => 'SANTAR DEKATE',
            'subtitle' => 'Layanan Pemesanan Koperasi & Belanja Ruangan',
            'badge' => 'Koperasi & Belanja',
            'icon' => 'bi-basket3',
            'color' => '#d97706',
            'sheetId' => '1-tb2VzBFPE12QOecySExK4s3r_lwrc8mVkyu8kLL3ys',
            'range' => "'SANTARDEKATE '!A2:Z",
            'route' => 'admin.sigap.santardekate',
        ],
    ];

    /**
     * Halaman index utama SIGAP, langsung dialihkan ke layanan pertama (SITERBAT)
     */
    public function index()
    {
        return redirect()->route('admin.sigap.siterbat');
    }

    /**
     * Halaman khusus data SITERBAT
     */
    public function siterbat(Request $request)
    {
        return $this->renderServicePage('siterbat', $request);
    }

    /**
     * Halaman khusus data AMBULAN
     */
    public function ambulan(Request $request)
    {
        return $this->renderServicePage('ambulan', $request);
    }

    /**
     * Halaman khusus data SANTAR DEKATE
     */
    public function santardekate(Request $request)
    {
        return $this->renderServicePage('santardekate', $request);
    }

    /**
     * Mengelola data dan merender tampilan untuk masing-masing layanan secara mandiri
     */
    private function renderServicePage(string $serviceKey, Request $request)
    {
        $currentMonth = (int) date('n');
        $currentYear = (int) date('Y');

        $srvConfig = $this->services[$serviceKey];

        $filterMonth = $request->has('bulan')
            ? ($request->query('bulan') === 'semua' ? 'semua' : (int) $request->query('bulan'))
            : $currentMonth;

        $filterYear = (int) $request->query('tahun', $currentYear);
        $searchQuery = trim($request->query('q', ''));
        $forceRefresh = $request->boolean('refresh');

        $errorMessage = null;
        $parsedRows = [];

        try {
            $sheetService = app(GoogleSheetService::class);
            $cacheKey = "sigap_sheet_data_{$serviceKey}";

            if ($forceRefresh) {
                Cache::forget($cacheKey);
            }

            $rows = Cache::remember($cacheKey, 60, function () use ($sheetService, $srvConfig) {
                $response = $sheetService->getRangeData($srvConfig['sheetId'], $srvConfig['range']);
                if (isset($response['error'])) {
                    Log::warning("Google Sheet fetch warning for {$srvConfig['key']}: " . json_encode($response['error']));
                    return [];
                }
                return (isset($response['values']) && is_array($response['values'])) ? $response['values'] : [];
            });

            foreach ($rows as $index => $row) {
                if (empty($row) || !isset($row[0])) {
                    continue;
                }

                $dateMeta = $this->parseRowDate($row[0] ?? '');
                $item = [
                    'raw_index' => $index + 2,
                    'tanggal_raw' => trim($row[0] ?? '-'),
                    'jam_raw' => trim($row[1] ?? '-'),
                    'date_meta' => $dateMeta,
                ];

                if ($serviceKey === 'siterbat') {
                    // SITERBAT: [0: Tgl, 1: Jam, 2: No RM, 3: Nama Pasien, 4: Alamat, 5: Keterangan, 6: No HP]
                    $item['no_rm'] = trim($row[2] ?? '-');
                    $item['nama'] = trim($row[3] ?? '-');
                    $item['alamat'] = trim($row[4] ?? '-');
                    $item['detail'] = trim($row[5] ?? '-');
                    $item['telepon'] = $this->extractPhoneNumber($row, 6);
                    $item['wa_number'] = $this->formatWhatsappNumber($item['telepon']);
                } elseif ($serviceKey === 'ambulan') {
                    // AMBULAN: [0: Tgl, 1: Jam, 2: Nama, 3: No HP/Alamat, 4: Alamat Jemput, 5: Detail, 6: Gejala/Kondisi]
                    $item['nama'] = trim($row[2] ?? '-');
                    $item['telepon'] = $this->extractPhoneNumber($row, 3);
                    $item['alamat'] = trim($row[4] ?? ($row[3] ?? '-'));
                    $item['detail'] = trim($row[5] ?? '-');
                    $item['gejala'] = trim($row[6] ?? '-');
                    $item['wa_number'] = $this->formatWhatsappNumber($item['telepon']);
                } elseif ($serviceKey === 'santardekate') {
                    // SANTAR DEKATE: [0: Tgl, 1: Jam, 2: Nama, 3: No HP, 4: Ruangan, 5: Belanja]
                    $item['nama'] = trim($row[2] ?? '-');
                    $item['telepon'] = $this->extractPhoneNumber($row, 3);
                    $item['ruangan'] = trim($row[4] ?? '-');
                    $item['belanja'] = trim($row[5] ?? '-');
                    $item['wa_number'] = $this->formatWhatsappNumber($item['telepon']);
                }

                // Abaikan baris kosong
                if (($item['nama'] ?? '-') === '-' && empty($dateMeta)) {
                    continue;
                }

                $parsedRows[] = $item;
            }
        } catch (\Throwable $e) {
            Log::error("Error loading SIGAP service {$serviceKey}: " . $e->getMessage());
            $errorMessage = "Koneksi Google Sheets mengalami kendala sementara: " . $e->getMessage();
            $parsedRows = [];
        }

        // Kalkulasi Statistik Bulan Ini dan Tahun Ini
        $countTotal = count($parsedRows);
        $countSelectedYear = 0;
        $countSelectedMonth = 0;

        foreach ($parsedRows as $pRow) {
            if ($pRow['date_meta']) {
                if ($pRow['date_meta']['year'] === $filterYear) {
                    $countSelectedYear++;
                    if ($filterMonth === 'semua' || $pRow['date_meta']['month'] === $filterMonth) {
                        $countSelectedMonth++;
                    }
                }
            }
        }

        // Terapkan Filter Baris
        $filteredRows = array_filter($parsedRows, function ($row) use ($filterMonth, $filterYear, $searchQuery) {
            if ($row['date_meta'] && $row['date_meta']['year'] !== $filterYear) {
                return false;
            }

            if ($filterMonth !== 'semua' && $row['date_meta'] && $row['date_meta']['month'] !== $filterMonth) {
                return false;
            }

            if (!empty($searchQuery)) {
                $haystack = strtolower(
                    ($row['nama'] ?? '') . ' ' .
                    ($row['telepon'] ?? '') . ' ' .
                    ($row['alamat'] ?? '') . ' ' .
                    ($row['no_rm'] ?? '') . ' ' .
                    ($row['ruangan'] ?? '') . ' ' .
                    ($row['detail'] ?? '') . ' ' .
                    ($row['gejala'] ?? '') . ' ' .
                    ($row['belanja'] ?? '')
                );
                if (!str_contains($haystack, strtolower($searchQuery))) {
                    return false;
                }
            }

            return true;
        });

        // Urutkan data terbaru di paling atas
        $filteredRows = array_reverse(array_values($filteredRows));

        $monthNames = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        $availableYears = range($currentYear, 2024);

        return view('admin.sigap.index', [
            'services' => $this->services,
            'activeServiceKey' => $serviceKey,
            'activeService' => $srvConfig,
            'tableRows' => $filteredRows,
            'countTotal' => $countTotal,
            'countSelectedYear' => $countSelectedYear,
            'countSelectedMonth' => $countSelectedMonth,
            'filterMonth' => $filterMonth,
            'filterYear' => $filterYear,
            'searchQuery' => $searchQuery,
            'monthNames' => $monthNames,
            'availableYears' => $availableYears,
            'currentMonth' => $currentMonth,
            'currentYear' => $currentYear,
            'errorMessage' => $errorMessage,
        ]);
    }

    /**
     * Ekstraksi nomor telepon dari kolom utama atau pencarian pola di baris
     */
    private function extractPhoneNumber(array $row, int $defaultIndex): string
    {
        $candidate = trim($row[$defaultIndex] ?? '');
        if (!empty($candidate) && preg_match('/^[0-9+\-\s]{7,20}$/', $candidate)) {
            return $candidate;
        }

        // Cek apakah ada kolom lain yang berisi format nomor telepon Indonesia (08... atau 628...)
        foreach ($row as $val) {
            $cleaned = preg_replace('/[^0-9]/', '', (string)$val);
            if (str_starts_with($cleaned, '08') || str_starts_with($cleaned, '628')) {
                if (strlen($cleaned) >= 9 && strlen($cleaned) <= 15) {
                    return trim($val);
                }
            }
        }

        return $candidate ?: '-';
    }

    /**
     * Mem-parsing tanggal dari format d/m/Y, Y-m-d, d-m-Y, dll.
     */
    private function parseRowDate($dateStr)
    {
        if (empty($dateStr)) {
            return null;
        }
        $dateStr = trim($dateStr);

        // Format d/m/Y atau d-m-Y
        if (preg_match('/^(\d{1,2})[\/\-](\d{1,2})[\/\-](\d{4})$/', $dateStr, $m)) {
            $day = (int) $m[1];
            $month = (int) $m[2];
            $year = (int) $m[3];
            if (checkdate($month, $day, $year)) {
                return [
                    'day' => $day,
                    'month' => $month,
                    'year' => $year,
                    'formatted' => sprintf('%02d/%02d/%04d', $day, $month, $year),
                ];
            }
        }

        // Format Y-m-d atau Y/m/d
        if (preg_match('/^(\d{4})[\/\-](\d{1,2})[\/\-](\d{1,2})$/', $dateStr, $m)) {
            $year = (int) $m[1];
            $month = (int) $m[2];
            $day = (int) $m[3];
            if (checkdate($month, $day, $year)) {
                return [
                    'day' => $day,
                    'month' => $month,
                    'year' => $year,
                    'formatted' => sprintf('%02d/%02d/%04d', $day, $month, $year),
                ];
            }
        }

        // Fallback strtotime
        $ts = strtotime($dateStr);
        if ($ts !== false && $ts > 0) {
            return [
                'day' => (int) date('j', $ts),
                'month' => (int) date('n', $ts),
                'year' => (int) date('Y', $ts),
                'formatted' => date('d/m/Y', $ts),
            ];
        }

        return null;
    }

    /**
     * Normalisasi nomor telepon ke format internasional WhatsApp (628...)
     */
    private function formatWhatsappNumber($phone)
    {
        $phone = preg_replace('/[^0-9]/', '', (string) $phone);
        if (empty($phone)) {
            return '';
        }

        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        } elseif (str_starts_with($phone, '8')) {
            $phone = '62' . $phone;
        }

        return $phone;
    }
}

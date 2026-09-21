<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\GoogleSheetService;
use Illuminate\Support\Facades\Cache;

class SigapController extends Controller
{
    private $services = [
        'siterbat' => [
            'key' => 'siterbat',
            'title' => 'SITERBAT',
            'subtitle' => 'Antar Obat Pasien ke Rumah',
            'badge' => 'Antar Obat',
            'icon' => 'bi-bicycle',
            'sheetId' => '1zZHjcIYoal75rbikPZ6oElTMyGpKjzS2OdzzCKm__4c',
            'sheetName' => 'SITERBAT',
            'range' => "'SITERBAT'!A2:Z",
        ],
        'ambulan' => [
            'key' => 'ambulan',
            'title' => 'AMBULAN',
            'subtitle' => 'Layanan Jemput Pasien Gratis',
            'badge' => 'Jemput Pasien',
            'icon' => 'bi-truck',
            'sheetId' => '1ZiowxZoBCRvqcRlkrkIPueJ2Tzr9uApluGGY5koy9SY',
            'sheetName' => 'AMBULAN',
            'range' => "'AMBULAN'!A2:Z",
        ],
        'santardekate' => [
            'key' => 'santardekate',
            'title' => 'SANTAR DEKATE',
            'subtitle' => 'Pemesanan Koperasi & Belanja Ruangan',
            'badge' => 'Koperasi & Belanja',
            'icon' => 'bi-basket3',
            'sheetId' => '1-tb2VzBFPE12QOecySExK4s3r_lwrc8mVkyu8kLL3ys',
            'sheetName' => 'SANTARDEKATE ',
            'range' => "'SANTARDEKATE '!A2:Z",
        ],
    ];

    public function index(Request $request, GoogleSheetService $sheetService)
    {
        $currentMonth = (int) date('n');
        $currentYear = (int) date('Y');

        // Parameter input
        $activeService = $request->query('service', 'siterbat');
        if (!array_key_exists($activeService, $this->services)) {
            $activeService = 'siterbat';
        }

        $filterMonth = $request->has('bulan') ? ($request->query('bulan') === 'semua' ? 'semua' : (int) $request->query('bulan')) : $currentMonth;
        $filterYear = (int) $request->query('tahun', $currentYear);
        $searchQuery = trim($request->query('q', ''));
        $forceRefresh = $request->boolean('refresh');

        // Ambil data untuk ketiga layanan guna menghitung ringkasan global
        $serviceCounts = [];
        $allServicesData = [];

        foreach ($this->services as $srvKey => $srvConfig) {
            $cacheKey = "sigap_sheet_raw_{$srvKey}";
            if ($forceRefresh) {
                Cache::forget($cacheKey);
            }

            $rows = Cache::remember($cacheKey, 60, function () use ($sheetService, $srvConfig) {
                $response = $sheetService->getRangeData($srvConfig['sheetId'], $srvConfig['range']);
                return (isset($response['values']) && is_array($response['values'])) ? $response['values'] : [];
            });

            // Normalisasi data baris
            $parsedRows = [];
            foreach ($rows as $index => $row) {
                if (empty($row) || !isset($row[0])) {
                    continue;
                }

                $dateMeta = $this->parseRowDate($row[0] ?? '');
                $item = [
                    'raw_index' => $index + 2, // nomor baris di sheet
                    'tanggal_raw' => $row[0] ?? '-',
                    'jam_raw' => $row[1] ?? '-',
                    'date_meta' => $dateMeta,
                ];

                if ($srvKey === 'siterbat') {
                    // SITERBAT: [0: Tgl, 1: Jam, 2: No RM, 3: Nama Pasien, 4: Alamat, 5: Keterangan, 6: No HP]
                    $item['no_rm'] = trim($row[2] ?? '-');
                    $item['nama'] = trim($row[3] ?? '-');
                    $item['alamat'] = trim($row[4] ?? '-');
                    $item['detail'] = trim($row[5] ?? '-');
                    $item['telepon'] = trim($row[6] ?? '-');
                    $item['wa_number'] = $this->formatWhatsappNumber($item['telepon']);
                } elseif ($srvKey === 'ambulan') {
                    // AMBULAN: [0: Tgl, 1: Jam, 2: Nama, 3: No HP, 4: Alamat Jemput, 5: Detail, 6: Gejala/Kondisi]
                    $item['nama'] = trim($row[2] ?? '-');
                    $item['telepon'] = trim($row[3] ?? '-');
                    $item['alamat'] = trim($row[4] ?? '-');
                    $item['detail'] = trim($row[5] ?? '-');
                    $item['gejala'] = trim($row[6] ?? '-');
                    $item['wa_number'] = $this->formatWhatsappNumber($item['telepon']);
                } elseif ($srvKey === 'santardekate') {
                    // SANTAR DEKATE: [0: Tgl, 1: Jam, 2: Nama, 3: No HP, 4: Ruangan, 5: Belanja]
                    $item['nama'] = trim($row[2] ?? '-');
                    $item['telepon'] = trim($row[3] ?? '-');
                    $item['ruangan'] = trim($row[4] ?? '-');
                    $item['belanja'] = trim($row[5] ?? '-');
                    $item['wa_number'] = $this->formatWhatsappNumber($item['telepon']);
                }

                // Jangan masukkan jika baris kosong (tidak ada nama dan tidak ada tanggal)
                if (($item['nama'] ?? '-') === '-' && empty($dateMeta)) {
                    continue;
                }

                $parsedRows[] = $item;
            }

            // Simpan data terurai
            $allServicesData[$srvKey] = $parsedRows;

            // Hitung statistik untuk layanan ini
            $countSelectedMonth = 0;
            $countSelectedYear = 0;
            $countTotal = count($parsedRows);

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

            $serviceCounts[$srvKey] = [
                'total' => $countTotal,
                'year_count' => $countSelectedYear,
                'month_count' => $countSelectedMonth,
            ];
        }

        // Filter data untuk layanan aktif
        $activeRows = $allServicesData[$activeService] ?? [];

        $filteredRows = array_filter($activeRows, function ($row) use ($filterMonth, $filterYear, $searchQuery, $activeService) {
            // Filter Tahun
            if ($row['date_meta'] && $row['date_meta']['year'] !== $filterYear) {
                return false;
            }

            // Filter Bulan
            if ($filterMonth !== 'semua' && $row['date_meta'] && $row['date_meta']['month'] !== $filterMonth) {
                return false;
            }

            // Filter Pencarian Teks
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

        // Urutkan data: terbaru di atas (LIFO)
        $filteredRows = array_reverse(array_values($filteredRows));

        // Pilihan bulan untuk filter
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

        // Daftar tahun yang relevan
        $availableYears = range($currentYear, 2024);

        return view('admin.sigap.index', [
            'services' => $this->services,
            'activeServiceKey' => $activeService,
            'activeService' => $this->services[$activeService],
            'tableRows' => $filteredRows,
            'serviceCounts' => $serviceCounts,
            'filterMonth' => $filterMonth,
            'filterYear' => $filterYear,
            'searchQuery' => $searchQuery,
            'monthNames' => $monthNames,
            'availableYears' => $availableYears,
            'currentMonth' => $currentMonth,
            'currentYear' => $currentYear,
        ]);
    }

    /**
     * Mem-parsing tanggal dari format d/m/Y, Y-m-d, d-m-Y, d/m/y, dll.
     */
    private function parseRowDate($dateStr)
    {
        if (empty($dateStr)) {
            return null;
        }
        $dateStr = trim($dateStr);

        // d/m/Y atau d-m-Y
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

        // Y-m-d atau Y/m/d
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

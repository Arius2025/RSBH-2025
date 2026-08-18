<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TarifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $group = $request->input('group', 'OBAT DAN ALKES'); // Default to OBAT DAN ALKES if not provided
        $room = $request->input('room');
        $search = $request->input('search');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $apiKey = config('services.rsdkt.key');

        $query = [];
        if ($group) {
            $query['group'] = $group;
        }
        if ($room) {
            $query['room'] = $room;
        }

        try {
            $response = Http::withoutVerifying()->withHeaders([
                'x-api-key' => $apiKey
            ])->get('https://dkt-jember.promedika.id/update-dkt-2/api/tarif', $query);

            if ($response->successful()) {
                $body = $response->json();
                $rawData = $body['data'] ?? [];
                
                $data = $this->normalizeData($rawData, $group);

                // Filter berdasarkan keyword pencarian nama / kode jika ada
                if (!empty($search)) {
                    $searchLower = strtolower($search);
                    $data = array_values(array_filter($data, function($item) use ($searchLower) {
                        return str_contains(strtolower($item['name'] ?? ''), $searchLower) ||
                               str_contains(strtolower($item['code'] ?? ''), $searchLower) ||
                               str_contains(strtolower($item['code_tariff'] ?? ''), $searchLower);
                    }));
                }

                // Filter berdasarkan harga minimum
                if (!empty($minPrice) && is_numeric($minPrice)) {
                    $data = array_values(array_filter($data, function($item) use ($minPrice) {
                        return ($item['price'] ?? 0) >= (float)$minPrice;
                    }));
                }

                // Filter berdasarkan harga maksimum
                if (!empty($maxPrice) && is_numeric($maxPrice)) {
                    $data = array_values(array_filter($data, function($item) use ($maxPrice) {
                        return ($item['price'] ?? 0) <= (float)$maxPrice;
                    }));
                }

            } else {
                $data = [];
                session()->flash('error', 'Gagal mengambil data dari API Tarif. Status: ' . $response->status());
            }
        } catch (\Exception $e) {
            $data = [];
            session()->flash('error', 'Terjadi kesalahan saat menghubungi API: ' . $e->getMessage());
        }

        $groups = [
            'OBAT DAN ALKES', 
            'TINDAKAN MEDIS', 
            'LAB', 
            'RADIOLOGI', 
            'TEMPLATE'
        ];

        return view('admin.tarif.index', compact('data', 'group', 'groups', 'room', 'search', 'minPrice', 'maxPrice'));
    }

    /**
     * Display a printable version of the data.
     *
     * @return \Illuminate\Http\Response
     */
    public function print(Request $request)
    {
        $group = $request->input('group');
        $room = $request->input('room');
        $apiKey = config('services.rsdkt.key');

        $query = [];
        if ($group) {
            $query['group'] = $group;
        }
        if ($room) {
            $query['room'] = $room;
        }

        try {
            $response = Http::withoutVerifying()->withHeaders([
                'x-api-key' => $apiKey
            ])->get('https://dkt-jember.promedika.id/update-dkt-2/api/tarif', $query);

            if ($response->successful()) {
                $body = $response->json();
                $rawData = $body['data'] ?? [];
                
                $data = $this->normalizeData($rawData, $group);
            } else {
                $data = [];
            }
        } catch (\Exception $e) {
            $data = [];
        }

        return view('admin.tarif.print', compact('data', 'group', 'room'));
    }

    /**
     * Normalize JSON data from API
     */
    private function normalizeData($rawData, $group)
    {
        $data = [];
        if ($group === 'TEMPLATE') {
            foreach ($rawData as $key => $val) {
                $data[] = [
                    'name' => $key,
                    'code' => '-',
                    'price' => 0,
                    'code_tariff' => $val['code_tariff'] ?? '-',
                    'detail' => $val['pemeriksaan'] ?? []
                ];
            }
        } else {
            foreach ($rawData as $val) {
                $data[] = [
                    'name' => $val['name'] ?? '-',
                    'code' => $val['code'] ?? '-',
                    'price' => $val['price'] ?? 0,
                    'code_tariff' => $val['code_tariff'] ?? '-',
                    'detail' => []
                ];
            }
        }
        return $data;
    }
}

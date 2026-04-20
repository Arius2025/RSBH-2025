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
        $group = $request->input('group');
        $apiKey = config('services.rsdkt.key');

        $query = [];
        if ($group) {
            $query['group'] = $group;
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

        return view('admin.tarif.index', compact('data', 'group', 'groups'));
    }

    /**
     * Display a printable version of the data.
     *
     * @return \Illuminate\Http\Response
     */
    public function print(Request $request)
    {
        $group = $request->input('group');
        $apiKey = config('services.rsdkt.key');

        $query = [];
        if ($group) {
            $query['group'] = $group;
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

        return view('admin.tarif.print', compact('data', 'group'));
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

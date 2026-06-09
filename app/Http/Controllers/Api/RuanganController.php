<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;

class RuanganController extends Controller
{
    /**
     * Return list of rooms from upstream API or fallback to extracting from tarif endpoint.
     */
    public function index(Request $request)
    {
        $apiKey = config('services.rsdkt.key');

        // Try direct ruangan endpoint first
        try {
            $resp = Http::withoutVerifying()->withHeaders([
                'x-api-key' => $apiKey
            ])->get('https://dkt-jember.promedika.id/update-dkt-2/api/ruangan');

            if ($resp->successful()) {
                $body = $resp->json();
                $items = $body['data'] ?? $body;
                $list = [];

                foreach ($items as $it) {
                    $id = $it['id'] ?? ($it['code'] ?? null);
                    $name = $it['name'] ?? ($it['nama'] ?? $it['room_name'] ?? null);
                    if ($name) {
                        $list[] = ['id' => $id ?? $name, 'name' => $name];
                    }
                }

                return response()->json(['data' => array_values($list)]);
            }
        } catch (\Exception $e) {
            // continue to fallback
        }

        // Fallback: extract rooms from tarif endpoint
        try {
            $resp = Http::withoutVerifying()->withHeaders([
                'x-api-key' => $apiKey
            ])->get('https://dkt-jember.promedika.id/update-dkt-2/api/tarif');

            if ($resp->successful()) {
                $body = $resp->json();
                $raw = $body['data'] ?? [];
                $map = [];

                foreach ($raw as $item) {
                    // try several keys commonly used upstream
                    $roomName = Arr::get($item, 'ruangan') ?? Arr::get($item, 'room') ?? Arr::get($item, 'unit') ?? Arr::get($item, 'nama_ruangan') ?? null;
                    $roomId = Arr::get($item, 'ruangan_id') ?? Arr::get($item, 'room_id') ?? null;
                    if ($roomName) {
                        $key = $roomId ?? $roomName;
                        $map[$key] = ['id' => $roomId ?? $roomName, 'name' => $roomName];
                    }
                }

                return response()->json(['data' => array_values($map)]);
            }
        } catch (\Exception $e) {
            // if fail, return empty
        }

        return response()->json(['data' => []]);
    }
}

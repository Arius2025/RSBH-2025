<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GoogleSheetService;

class SiterbatController extends Controller
{
    private $sheetService;

    public function __construct(GoogleSheetService $sheetService)
    {
        $this->sheetService = $sheetService;
    }

    public function submit(Request $request)
    {
        $request->validate([
            'rm' => 'required|string',
            'name' => 'required|string',
            'address' => 'required|string',
            'detail' => 'required|string',
            'phone' => 'required|string',
        ]);

        $data = [
            'rm' => $request->rm,
            'name' => $request->name,
            'address' => $request->address,
            'detail' => $request->detail,
            'phone' => $request->phone,
        ];

        $success = $this->sheetService->appendRow($data, 'SITERBAT!A2:G');

        if ($success) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Gagal menyimpan ke Google Sheet'], 500);
    }
}

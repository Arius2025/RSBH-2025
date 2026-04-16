<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GoogleSheetService;

class SantardekateController extends Controller
{
    private $sheetService;
    // Santardekate Spreadsheet ID from dashboard mapping
    private $spreadsheetId = '1-tb2VzBFPE12QOecySExK4s3r_lwrc8mVkyu8kLL3ys';

    public function __construct(GoogleSheetService $sheetService)
    {
        $this->sheetService = $sheetService;
        $this->sheetService->setSpreadsheetId($this->spreadsheetId);
    }

    public function index()
    {
        return view('pages.santardekate');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|numeric|min:10',
            'ruangan' => 'required|string',
            'belanja' => 'required|string',
        ]);

        $data = [
            'nama' => $request->name,
            'phone' => $request->phone,
            'ruangan' => $request->ruangan,
            'belanja' => $request->belanja,
        ];

        // Format: TANGGAL | JAM | NAMA | PHONE | RUANGAN | BELANJA
        // appendRow adds Date and Time automatically
        // Range A2:F for 6 columns
        $success = $this->sheetService->appendRow($data, 'SANTARDEKATE !A2:F');

        if ($success) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Gagal menyimpan ke Google Sheet'], 500);
    }
}

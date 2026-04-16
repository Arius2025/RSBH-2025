<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GoogleSheetService;

class AmbulanceController extends Controller
{
    private $sheetService;

    public function __construct(GoogleSheetService $sheetService)
    {
        $this->sheetService = $sheetService;
        $this->sheetService->setSpreadsheetId('1ZiowxZoBCRvqcRlkrkIPueJ2Tzr9uApluGGY5koy9SY');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'detail' => 'required|string',
            'gejala' => 'required|string',
        ]);

        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'detail' => $request->detail,
            'gejala' => $request->gejala,
        ];

        // Using AMBULAN as per check_amb_spread.php results
        $success = $this->sheetService->appendRow($data, 'AMBULAN!A2:G');

        if ($success) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Gagal menyimpan ke Google Sheet'], 500);
    }
}

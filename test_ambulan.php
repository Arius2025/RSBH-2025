<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Services\GoogleSheetService;

$service = new GoogleSheetService();
$service->setSpreadsheetId('1ZiowxZoBCRvqcRlkrkIPueJ2Tzr9uApluGGY5koy9SY');

$data = [
    'name' => 'Test cURL Override Amb',
    'phone' => '08111222333',
    'address' => 'Jl Test',
    'detail' => 'Kecelakaan',
    'gejala' => 'Patah tulang'
];

echo "Testing append to AMBULAN with pure cURL...\n";
$success = $service->appendRow($data, "'AMBULAN'!A2:G");

if ($success) {
    echo "SUCCESS: Data appended.\n";
} else {
    echo "FAILED: Check logs.\n";
}

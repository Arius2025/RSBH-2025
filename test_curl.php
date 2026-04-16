<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Services\GoogleSheetService;

$service = new GoogleSheetService();
$service->setSpreadsheetId('1-tb2VzBFPE12QOecySExK4s3r_lwrc8mVkyu8kLL3ys');

$data = [
    'nama' => 'Test cURL Override',
    'phone' => '08111222333',
    'ruangan' => 'IGD',
    'belanja' => 'Testing cURL Host',
];

echo "Testing append to SANTARDEKATE with pure cURL...\n";
$success = $service->appendRow($data, "'SANTARDEKATE '!A2:F");

if ($success) {
    echo "SUCCESS: Data appended.\n";
} else {
    echo "FAILED: Check logs.\n";
}

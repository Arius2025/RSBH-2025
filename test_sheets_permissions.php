<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Services\GoogleSheetService;

$service = new GoogleSheetService();
$sheets = [
    'SITERBAT' => '1zZHjcIYoal75rbikPZ6oElTMyGpKjzS2OdzzCKm__4c',
    'AMBULAN' => '1ZiowxZoBCRvqcRlkrkIPueJ2Tzr9uApluGGY5koy9SY',
    'SANTARDEKATE' => '1-tb2VzBFPE12QOecySExK4s3r_lwrc8mVkyu8kLL3ys'
];

foreach ($sheets as $name => $id) {
    echo "Testing $name ($id)...\n";
    $service->setSpreadsheetId($id);
    
    // Attempt to get token
    $token = (new ReflectionMethod($service, 'getAccessToken'))->getClosure($service)();
    if (!$token) {
        echo "FAILED to get access token. Check logs.\n";
        continue;
    }
    
    // Attempt a simple GET of the first few rows to test permission
    $response = Illuminate\Support\Facades\Http::withOptions(['verify' => false])
        ->withToken($token)
        ->get("https://sheets.googleapis.com/v4/spreadsheets/$id/values/A1:A5");
        
    if ($response->successful()) {
        echo "SUCCESS: $name is accessible.\n";
    } else {
        echo "FAILED: $name - Status: " . $response->status() . " - " . $response->body() . "\n";
    }
    echo "-----------------------------------\n";
}

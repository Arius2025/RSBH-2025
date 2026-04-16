<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Services\GoogleSheetService;

$service = new GoogleSheetService();
$service->setSpreadsheetId('1ZiowxZoBCRvqcRlkrkIPueJ2Tzr9uApluGGY5koy9SY'); // AMBULAN

// We have to use the getAccessToken method which is private, let's use reflection
$token = (new ReflectionMethod($service, 'getAccessToken'))->getClosure($service)();

if (!$token) {
    echo "FAILED TO GET TOKEN\n";
    exit;
}

$ch = curl_init("https://sheets.googleapis.com/v4/spreadsheets/1ZiowxZoBCRvqcRlkrkIPueJ2Tzr9uApluGGY5koy9SY");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer $token"]);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$resMeta = curl_exec($ch);
$httpCodeMeta = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCodeMeta == 200) {
    $data = json_decode($resMeta, true);
    echo "SPREADSHEET: " . $data['properties']['title'] . "\n";
    foreach ($data['sheets'] as $sheet) {
        $t = $sheet['properties']['title'];
        echo "TAB: [" . $t . "] HEX: " . bin2hex($t) . "\n";
    }
} else {
    echo "HTTP CODE: $httpCodeMeta\n";
    echo $resMeta . "\n";
}

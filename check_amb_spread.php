<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$config = json_decode(file_get_contents(base_path('sigap-dkt-30d10a90662e.json')), true);
$header = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode(json_encode(['alg' => 'RS256', 'typ' => 'JWT'])));
$payload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode(json_encode([
    'iss' => $config['client_email'],
    'scope' => 'https://www.googleapis.com/auth/spreadsheets',
    'aud' => 'https://oauth2.googleapis.com/token',
    'exp' => time() + 3600,
    'iat' => time()
])));
$signature = '';
openssl_sign($header . '.' . $payload, $signature, $config['private_key'], OPENSSL_ALGO_SHA256);
$signature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
$jwt = $header . '.' . $payload . '.' . $signature;

$response = Illuminate\Support\Facades\Http::withoutVerifying()->asForm()->post('https://oauth2.googleapis.com/token', [
    'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
    'assertion' => $jwt
]);
$token = $response->json('access_token');

$id = '1zZHjcIYoal75rbikPZ6oElTMyGpKjzS2OdzzCKm__4c';
$res = Illuminate\Support\Facades\Http::withoutVerifying()->withToken($token)->get("https://sheets.googleapis.com/v4/spreadsheets/$id/values/SITERBAT!A2:A");
echo "DATA: " . json_encode($res->json()) . "\n";

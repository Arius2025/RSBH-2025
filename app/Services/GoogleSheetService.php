<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleSheetService
{
    private $jsonPath;
    private $spreadsheetId;

    public function __construct($spreadsheetId = null)
    {
        $this->spreadsheetId = $spreadsheetId ?? '1zZHjcIYoal75rbikPZ6oElTMyGpKjzS2OdzzCKm__4c';
        $this->jsonPath = base_path('sigap-credentials.json');
    }

    public function setSpreadsheetId($id)
    {
        $this->spreadsheetId = $id;
        return $this;
    }

    public function appendRow(array $values, $range = 'SITERBAT!A2:E')
    {
        try {
            $token = $this->getAccessToken();
            if (!$token) {
                throw new \Exception("Failed to get Google Access Token");
            }

            $encodedRange = urlencode($range);
            $url = "https://sheets.googleapis.com/v4/spreadsheets/{$this->spreadsheetId}/values/{$encodedRange}:append?valueInputOption=RAW";

            $response = Http::withOptions(['verify' => false])
                ->withToken($token)
                ->post($url, [
                    'values' => [
                        array_merge([date('d/m/Y'), date('H:i:s')], array_values($values))
                    ]
                ]);

            if (!$response->successful()) {
                Log::error("Google Sheets API Error [Sheet ID: {$this->spreadsheetId}]: " . $response->body());
                return false;
            }

            return true;
        } catch (\Exception $e) {
            Log::error("Google Sheets Service Error: " . $e->getMessage());
            return false;
        }
    }

    private function getAccessToken()
    {
        try {
            $config = json_decode(file_get_contents($this->jsonPath), true);
            $privateKey = $config['private_key'];
            $clientEmail = $config['client_email'];

            $header = ['alg' => 'RS256', 'typ' => 'JWT'];
            $now = time();
            $payload = [
                'iss' => $clientEmail,
                'scope' => 'https://www.googleapis.com/auth/spreadsheets',
                'aud' => 'https://oauth2.googleapis.com/token',
                'exp' => $now + 3600,
                'iat' => $now - 60 // Compensate for small clock differences
            ];

            $base64UrlHeader = $this->base64UrlEncode(json_encode($header));
            $base64UrlPayload = $this->base64UrlEncode(json_encode($payload, JSON_UNESCAPED_SLASHES));

            $signature = '';
            if (!openssl_sign($base64UrlHeader . "." . $base64UrlPayload, $signature, $privateKey, OPENSSL_ALGO_SHA256)) {
                throw new \Exception("openssl_sign failed: " . openssl_error_string());
            }
            $base64UrlSignature = $this->base64UrlEncode($signature);

            $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

            $response = Http::withOptions(['verify' => false])->asForm()->post('https://oauth2.googleapis.com/token', [
                'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                'assertion' => $jwt
            ]);

            if ($response->successful()) {
                return $response->json('access_token');
            }

            Log::error("Google Token Error: " . $response->body());
            return null;
        } catch (\Exception $e) {
            Log::error("Get Access Token Exception: " . $e->getMessage());
            return null;
        }
    }

    private function base64UrlEncode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
}

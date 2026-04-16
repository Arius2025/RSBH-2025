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
        $this->jsonPath = base_path('sigap-dkt-30d10a90662e.json');
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

            $url = "https://sheets.googleapis.com/v4/spreadsheets/{$this->spreadsheetId}/values/{$range}:append?valueInputOption=RAW";

            $response = Http::withoutVerifying()
                ->withToken($token)
                ->post($url, [
                    'values' => [
                        array_merge([date('d/m/Y'), date('H:i:s')], array_values($values))
                    ]
                ]);

            Log::info("Google Sheets Response: " . $response->body());

            if (!$response->successful()) {
                Log::error("Google Sheets API Error: " . $response->body());
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
        $config = json_decode(file_get_contents($this->jsonPath), true);
        $privateKey = $config['private_key'];
        $clientEmail = $config['client_email'];

        $header = json_encode(['alg' => 'RS256', 'typ' => 'JWT']);
        $iat = time();
        $exp = $iat + 3600;
        $payload = json_encode([
            'iss' => $clientEmail,
            'scope' => 'https://www.googleapis.com/auth/spreadsheets',
            'aud' => 'https://oauth2.googleapis.com/token',
            'exp' => $exp,
            'iat' => $iat
        ]);

        $base64UrlHeader = $this->base64UrlEncode($header);
        $base64UrlPayload = $this->base64UrlEncode($payload);

        $signature = '';
        openssl_sign($base64UrlHeader . "." . $base64UrlPayload, $signature, $privateKey, OPENSSL_ALGO_SHA256);
        $base64UrlSignature = $this->base64UrlEncode($signature);

        $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

        $response = Http::withoutVerifying()->asForm()->post('https://oauth2.googleapis.com/token', [
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion' => $jwt
        ]);

        if ($response->successful()) {
            return $response->json('access_token');
        }

        Log::error("Google Token Error: " . $response->body());
        return null;
    }

    private function base64UrlEncode($data)
    {
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($data));
    }
}

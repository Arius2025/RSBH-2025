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
        $config = json_decode(file_get_contents($this->jsonPath), true);
        $privateKey = $config['private_key'];
        $clientEmail = $config['client_email'];

        $header = json_encode(['alg' => 'RS256', 'typ' => 'JWT']);
        $iat = time();
        $exp = $iat + 3600;
        $payload = json_encode([
            'iss' => trim($clientEmail),
            'scope' => 'https://www.googleapis.com/auth/spreadsheets',
            'aud' => 'https://oauth2.googleapis.com/token',
            'exp' => $exp,
            'iat' => $iat
        ]);
        // Note: Not using JSON_UNESCAPED_SLASHES here to see if default behavior works

        $base64UrlHeader = $this->base64UrlEncode($header);
        $base64UrlPayload = $this->base64UrlEncode($payload);

        $signature = '';
        $resKey = openssl_get_privatekey($privateKey);
        if (!$resKey) {
            Log::error("OpenSSL Get Private Key Error: " . openssl_error_string());
            return null;
        }

        if (!openssl_sign($base64UrlHeader . "." . $base64UrlPayload, $signature, $resKey, OPENSSL_ALGO_SHA256)) {
            Log::error("OpenSSL Sign Error: " . openssl_error_string());
            return null;
        }
        openssl_free_key($resKey);
        $base64UrlSignature = $this->base64UrlEncode($signature);

        $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

        $response = Http::withOptions(['verify' => false])
            ->asForm()
            ->post('https://oauth2.googleapis.com/token', [
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
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
}

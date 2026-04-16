<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class GoogleSheetService
{
    private $jsonPath;
    private $spreadsheetId;

    public function __construct($spreadsheetId = null)
    {
        $this->spreadsheetId = $spreadsheetId ?? '1zZHjcIYoal75rbikPZ6oElTMyGpKjzS2OdzzCKm__4c';
        // Pastikan path credential benar (di root laravel)
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
                throw new \Exception("Failed to get Google Access Token, cek sigap-credentials.json");
            }

            // Encode spasi pada nama sheet seperti "SANTARDEKATE " atau quote "'SANTARDEKATE '!A2:F"
            $encodedRange = rawurlencode($range);
            $url = "https://sheets.googleapis.com/v4/spreadsheets/{$this->spreadsheetId}/values/{$encodedRange}:append?valueInputOption=RAW";

            $postData = json_encode([
                'values' => [
                    array_merge([date('d/m/Y'), date('H:i:s')], array_values($values))
                ]
            ]);

            // Menggunakan cURL native untuk menghindari masalah dengan Guzzle/Http client di hosting
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Authorization: Bearer $token",
                "Content-Type: application/json"
            ]);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Bypass SSL error
            
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode != 200) {
                Log::error("Google Sheets API Error [Sheet ID: {$this->spreadsheetId}]: HTTP $httpCode - $response");
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
            if (!file_exists($this->jsonPath)) {
                throw new \Exception("sigap-credentials.json file NOT FOUND at " . $this->jsonPath);
            }

            $config = json_decode(file_get_contents($this->jsonPath), true);
            if (!$config || !isset($config['private_key'])) {
                throw new \Exception("Invalid sigap-credentials.json content.");
            }

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

            // Menggunakan cURL native untuk Request Token
            $ch = curl_init('https://oauth2.googleapis.com/token');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
                'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                'assertion' => $jwt
            ]));
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Bypass SSL error
            
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode == 200) {
                $data = json_decode($response, true);
                return $data['access_token'] ?? null;
            }

            Log::error("Google Token Error: HTTP $httpCode - $response");
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

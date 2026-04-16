<?php
// PHP Script untuk Debugging Google Sheets di Hosting
// Upload file ini ke folder root hosting, lalu akses via browser: domain.com/hosting_debug.php

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Google Sheets Hosting Debug</h1>";

// 1. Cek File Credentials
// Karena script di public/, credentials ada di ../
$jsonPath = __DIR__ . '/../sigap-credentials.json';
echo "Checking sigap-credentials.json: ";
if (file_exists($jsonPath)) {
    echo "EXISTS ✅<br>";
    $json = json_decode(file_get_contents($jsonPath), true);
    if ($json) {
        echo "JSON valid: YES ✅ (Email: " . $json['client_email'] . ")<br>";
    } else {
        echo "JSON valid: NO ❌ (Check file formatting)<br>";
    }
} else {
    echo "EXISTS: NO ❌ (File not found in root: " . $jsonPath . ")<br>";
}

// 2. Cek OpenSSL Extension
echo "Checking OpenSSL extension: ";
if (extension_loaded('openssl')) {
    echo "LOADED ✅<br>";
} else {
    echo "LOADED: NO ❌ (Please enable OpenSSL extension in hosting PHP settings)<br>";
}

// 3. Tes Koneksi ke Google (OAuth)
echo "Testing connection to Google Token API...<br>";

// Manual JWT logic from Service
function b64u($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

if (isset($json)) {
    $header = b64u(json_encode(['alg' => 'RS256', 'typ' => 'JWT']));
    $now = time();
    $payload = b64u(json_encode([
        'iss' => $json['client_email'],
        'scope' => 'https://www.googleapis.com/auth/spreadsheets',
        'aud' => 'https://oauth2.googleapis.com/token',
        'exp' => $now + 3600,
        'iat' => $now - 60
    ]));

    $signature = '';
    $signOk = openssl_sign($header . '.' . $payload, $signature, $json['private_key'], 'sha256');
    if ($signOk) {
        echo "JWT Signing: SUCCESS ✅<br>";
        $jwt = $header . '.' . $payload . '.' . b64u($signature);
        
        // Use cURL for token fetch (no Laravel wrapper here)
        $ch = curl_init('https://oauth2.googleapis.com/token');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion' => $jwt
        ]));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Bypass SSL for testing
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpCode == 200) {
            echo "Token Fetch: SUCCESS ✅<br>";
            $tokenData = json_decode($response, true);
            $token = $tokenData['access_token'];
            echo "Access Token acquired.<br>";
            
            // 4. Tes Baca Spreadsheet Meta
            echo "Testing Spreadsheet Access (SANTARDEKATE)...<br>";
            $id = '1-tb2VzBFPE12QOecySExK4s3r_lwrc8mVkyu8kLL3ys';
            $ch = curl_init("https://sheets.googleapis.com/v4/spreadsheets/$id");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer $token"]);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            
            $resMeta = curl_exec($ch);
            $httpCodeMeta = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            
            if ($httpCodeMeta == 200) {
                echo "Spreadsheet Access: SUCCESS ✅ (Title: " . json_decode($resMeta, true)['properties']['title'] . ")<br>";
                echo "<h2>ALL TESTS PASSED! Integration should work.</h2>";
            } else {
                echo "Spreadsheet Access: FAILED ❌ (HTTP $httpCodeMeta - $resMeta)<br>";
            }

        } else {
            echo "Token Fetch: FAILED ❌ (HTTP $httpCode - $response)<br>";
        }
    } else {
        echo "JWT Signing: FAILED ❌ (" . openssl_error_string() . ")<br>";
    }
}
?>

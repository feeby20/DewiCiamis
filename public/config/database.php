<?php
/**
 * Database Connection Bridge & Session Synchronizer
 * untuk Halaman Legacy (public/detail/*.php, pemesanan tiket/*.php, simpan.php, dll)
 * Membaca konfigurasi dari file .env utama
 */

if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
    @session_start();
}

$envFile = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . '.env';

$dbHost = '127.0.0.1';
$dbPort = '3306';
$dbName = 'db_disparcms';
$dbUser = 'root';
$dbPass = '';
$appKey = '';

if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#')) continue;
        if (str_contains($line, '=')) {
            [$key, $val] = explode('=', $line, 2);
            $key = trim($key);
            $val = trim($val, " \t\n\r\0\x0B\"'");
            if ($key === 'DB_HOST') $dbHost = $val;
            if ($key === 'DB_PORT') $dbPort = $val;
            if ($key === 'DB_DATABASE') $dbName = $val;
            if ($key === 'DB_USERNAME') $dbUser = $val;
            if ($key === 'DB_PASSWORD') $dbPass = $val;
            if ($key === 'APP_KEY') $appKey = $val;
        }
    }
}

// -------------------------------------------------------------
// SINKRONISASI SESSION LARAVEL KE NATIVE PHP SESSION ($_SESSION)
// -------------------------------------------------------------
if (!isset($_SESSION['user_id']) && !empty($_COOKIE) && !empty($appKey)) {
    $rawKey = base64_decode(str_starts_with($appKey, 'base64:') ? substr($appKey, 7) : $appKey);
    $sessionDir = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'framework' . DIRECTORY_SEPARATOR . 'sessions';

    if (is_dir($sessionDir) && strlen($rawKey) === 32) {
        foreach ($_COOKIE as $cookieName => $cookieVal) {
            if (!is_string($cookieVal) || strlen($cookieVal) < 20) continue;

            $payload = json_decode(base64_decode($cookieVal), true);
            if (!$payload || !isset($payload['iv'], $payload['value'])) continue;

            $iv = base64_decode($payload['iv']);
            $dec = openssl_decrypt(base64_decode($payload['value']), 'AES-256-CBC', $rawKey, OPENSSL_RAW_DATA, $iv);
            if ($dec !== false && is_string($dec) && strlen($dec) >= 20) {
                $parts = explode('|', $dec);
                $sessionId = end($parts);
                $sessionFile = $sessionDir . DIRECTORY_SEPARATOR . $sessionId;
                if (file_exists($sessionFile)) {
                    $sessData = @unserialize(file_get_contents($sessionFile));
                    if (is_array($sessData) && isset($sessData['user_id'])) {
                        $_SESSION['user_id'] = $sessData['user_id'];
                        $_SESSION['user_nama'] = $sessData['user_nama'] ?? 'Pengunjung';
                        $_SESSION['role'] = $sessData['role'] ?? 'user';
                        break;
                    }
                }
            }
        }
    }
}

// -------------------------------------------------------------
// KONEKSI PDO DATABASE
// -------------------------------------------------------------
try {
    $pdo = new PDO(
        "mysql:host={$dbHost};port={$dbPort};dbname={$dbName};charset=utf8mb4",
        $dbUser,
        $dbPass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {
    // Fallback coba db_dispar jika db_disparcms tidak ada
    try {
        $pdo = new PDO(
            "mysql:host={$dbHost};port={$dbPort};dbname=db_dispar;charset=utf8mb4",
            $dbUser,
            $dbPass,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
    } catch (PDOException $ex) {
        error_log('Database PDO Bridge Error: ' . $ex->getMessage());
        die('Koneksi database gagal: ' . $ex->getMessage());
    }
}

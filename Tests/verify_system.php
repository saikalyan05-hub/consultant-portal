<?php
// Mock config for testing
define('DB_HOST', 'localhost');
define('DB_NAME', 'staffing_portal');
define('DB_USER', 'root');
define('DB_PASS', '');
define('JWT_SECRET', 'test_secret');
define('JWT_EXPIRY', 3600);

require_once 'App/Core/Database.php';
require_once 'App/Helpers/JWTHelper.php';

use App\Core\Database;
use App\Helpers\JWTHelper;

echo "System Verification:\n";

// 1. Database Class Load
if (class_exists('App\Core\Database')) {
    echo "[PASS] Database class loaded.\n";
} else {
    echo "[FAIL] Database class not found.\n";
}

// 2. JWT Helper Check
$token = JWTHelper::generateToken(['id' => 1, 'role' => 'Admin']);
$decoded = JWTHelper::decodeToken($token);
if ($decoded && $decoded['role'] === 'Admin') {
    echo "[PASS] JWT generation and decoding works.\n";
} else {
    echo "[FAIL] JWT verification failed.\n";
}

// 3. Routing Check (Static analysis of App.php)
require_once 'App/Core/App.php';
if (class_exists('App\Core\App')) {
    echo "[PASS] Router class loaded.\n";
} else {
    echo "[FAIL] Router class not found.\n";
}

echo "Verification Complete.\n";
?>

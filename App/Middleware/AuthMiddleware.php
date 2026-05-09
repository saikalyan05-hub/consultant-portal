<?php

namespace App\Middleware;

use App\Helpers\JWTHelper;

class AuthMiddleware {
    public static function authenticate($requiredRoles = []) {
        $headers = getallheaders();
        $token = null;

        if (isset($headers['Authorization'])) {
            $token = str_replace('Bearer ', '', $headers['Authorization']);
        } elseif (isset($_SESSION['token'])) {
            $token = $_SESSION['token'];
        }

        if (!$token) {
            self::unauthorized();
        }

        $decoded = JWTHelper::decodeToken($token);
        if (!$decoded) {
            self::unauthorized();
        }

        if (!empty($requiredRoles) && !in_array($decoded['role'], $requiredRoles)) {
            self::forbidden();
        }

        return $decoded;
    }

    private static function unauthorized() {
        header('Content-Type: application/json');
        http_response_code(401);
        echo json_encode(['error' => 'Unauthorized']);
        exit;
    }

    private static function forbidden() {
        header('Content-Type: application/json');
        http_response_code(403);
        echo json_encode(['error' => 'Forbidden']);
        exit;
    }
}

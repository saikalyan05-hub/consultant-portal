<?php

namespace App\Helpers;

class JWTHelper {
    public static function generateToken($payload) {
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        $header = self::base64UrlEncode($header);

        $payload['exp'] = time() + JWT_EXPIRY;
        $payload = json_encode($payload);
        $payload = self::base64UrlEncode($payload);

        $signature = hash_hmac('sha256', "$header.$payload", JWT_SECRET, true);
        $signature = self::base64UrlEncode($signature);

        return "$header.$payload.$signature";
    }

    public static function decodeToken($token) {
        $parts = explode('.', $token);
        if (count($parts) !== 3) return false;

        list($header, $payload, $signature) = $parts;

        $validSignature = hash_hmac('sha256', "$header.$payload", JWT_SECRET, true);
        $validSignature = self::base64UrlEncode($validSignature);

        if ($signature !== $validSignature) return false;

        $decodedPayload = json_decode(self::base64UrlDecode($payload), true);
        if (!$decodedPayload || (isset($decodedPayload['exp']) && $decodedPayload['exp'] < time())) {
            return false;
        }

        return $decodedPayload;
    }

    private static function base64UrlEncode($data) {
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($data));
    }

    private static function base64UrlDecode($data) {
        $remainder = strlen($data) % 4;
        if ($remainder) {
            $data .= str_repeat('=', 4 - $remainder);
        }
        return base64_decode(str_replace(['-', '_'], ['+', '/'], $data));
    }
}

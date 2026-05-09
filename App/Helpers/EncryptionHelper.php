<?php

namespace App\Helpers;

class EncryptionHelper {
    private static $method = 'aes-256-cbc';

    public static function encrypt($data) {
        $key = hash('sha256', JWT_SECRET);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(self::$method));
        $encrypted = openssl_encrypt($data, self::$method, $key, 0, $iv);
        return base64_encode($encrypted . '::' . $iv);
    }

    public static function decrypt($data) {
        $key = hash('sha256', JWT_SECRET);
        list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
        return openssl_decrypt($encrypted_data, self::$method, $key, 0, $iv);
    }
}

<?php

namespace App\Helpers;

class FileHelper {
    public static function upload($file, $directory) {
        $allowedExtensions = ['pdf', 'docx'];
        $fileInfo = pathinfo($file['name']);
        $extension = strtolower($fileInfo['extension']);

        if (!in_array($extension, $allowedExtensions)) {
            return ['error' => 'Invalid file type. Only PDF and DOCX are allowed.'];
        }

        if ($file['size'] > 5000000) { // 5MB limit
            return ['error' => 'File size exceeds 5MB limit.'];
        }

        $randomName = bin2hex(random_bytes(16)) . '.' . $extension;
        $targetPath = $directory . '/' . $randomName;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return ['success' => true, 'file_name' => $randomName, 'original_name' => $file['name']];
        }

        return ['error' => 'Failed to upload file.'];
    }
}

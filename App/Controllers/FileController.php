<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;

class FileController extends Controller {
    public function download($type, $filename) {
        AuthMiddleware::authenticate(['Super Admin', 'Manager', 'Recruiter', 'Consultant']);

        $directory = '';
        if ($type === 'resume') {
            $directory = UPLOAD_PATH . '/resumes';
        } elseif ($type === 'work_auth') {
            $directory = UPLOAD_PATH . '/work_auth';
        } else {
            $this->jsonResponse(['error' => 'Invalid file type'], 400);
        }

        $filePath = $directory . '/' . $filename;

        if (file_exists($filePath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));
            readfile($filePath);
            exit;
        } else {
            $this->jsonResponse(['error' => 'File not found'], 404);
        }
    }
}

<?php

namespace App\Helpers;

// On GoDaddy shared hosting, PHPMailer would be included manually if not using composer
// require_once __DIR__ . '/../Vendor/PHPMailer/src/Exception.php';
// require_once __DIR__ . '/../Vendor/PHPMailer/src/PHPMailer.php';
// require_once __DIR__ . '/../Vendor/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailHelper {
    public static function send($to, $subject, $body) {
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = SMTP_HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = SMTP_USER;
            $mail->Password   = SMTP_PASS;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = SMTP_PORT;

            // Recipients
            $mail->setFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);
            $mail->addAddress($to);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Mail Error: {$mail->ErrorInfo}");
            return false;
        }
    }
}

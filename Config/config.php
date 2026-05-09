<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'staffing_portal');
define('DB_USER', 'root');
define('DB_PASS', '');

// JWT Secret Key
define('JWT_SECRET', 'your_super_secret_key_here_123456');
define('JWT_EXPIRY', 3600 * 24); // 24 hours

// SMTP Configuration (Brevo)
define('SMTP_HOST', 'smtp-relay.brevo.com');
define('SMTP_PORT', 587);
define('SMTP_USER', 'your_brevo_email@example.com');
define('SMTP_PASS', 'your_brevo_smtp_key');
define('SMTP_FROM_EMAIL', 'noreply@staffingportal.com');
define('SMTP_FROM_NAME', 'Staffing Portal');

// App Configuration
define('BASE_URL', 'http://localhost/staffing_portal');
define('UPLOAD_PATH', dirname(__DIR__) . '/uploads');
?>

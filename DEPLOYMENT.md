# Staffing Portal Deployment for GoDaddy cPanel

## Prerequisites
- PHP 8.1+
- MySQL 5.7+ or MariaDB
- cPanel access with File Manager and phpMyAdmin

## Database Setup
1. Open **phpMyAdmin** in cPanel.
2. Create a new database (e.g., `staffing_portal`).
3. Import `Database/schema.sql`.

## Configuration
1. Open `Config/config.php`.
2. Update `DB_HOST`, `DB_NAME`, `DB_USER`, and `DB_PASS` with your cPanel database details.
3. Update `BASE_URL` to your domain (e.g., `https://yourdomain.com`).
4. Update `SMTP_USER` and `SMTP_PASS` with your **Brevo SMTP** credentials.

## File Upload
1. Upload all project files to your `public_html` directory (or a subdirectory).
2. Ensure the `Uploads/` directory and its subdirectories have write permissions (usually 755).
3. The `.htaccess` files in `Public/` and `Uploads/` will handle routing and security automatically.

## Notes
- The entry point is `Public/index.php`. If you are deploying to a subdirectory, ensure `BASE_URL` reflects this.
- If not using Composer, manually upload the `PHPMailer` library into `App/Vendor/PHPMailer`.

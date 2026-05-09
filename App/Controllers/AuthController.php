<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\UserModel;
use App\Models\InviteModel;
use App\Helpers\JWTHelper;

class AuthController extends Controller {
    private $userModel;
    private $inviteModel;

    public function __construct() {
        $this->userModel = new UserModel();
        $this->inviteModel = new InviteModel();
    }

    public function verifyOTP() {
        $user_id = $_POST['user_id'] ?? '';
        $otp = $_POST['otp'] ?? '';

        $db = (new \App\Core\Database())->connect();
        $stmt = $db->prepare("SELECT * FROM email_verifications WHERE user_id = ? AND otp_code = ? AND expires_at > NOW() ORDER BY created_at DESC LIMIT 1");
        $stmt->execute([$user_id, $otp]);
        $verification = $stmt->fetch();

        if ($verification) {
            $stmt = $db->prepare("SELECT u.*, r.name as role_name FROM users u JOIN roles r ON u.role_id = r.id WHERE u.id = ?");
            $stmt->execute([$user_id]);
            $user = $stmt->fetch();

            $token = JWTHelper::generateToken([
                'id' => $user['id'],
                'email' => $user['email'],
                'role' => $user['role_name']
            ]);

            $this->jsonResponse([
                'message' => 'Login successful',
                'token' => $token,
                'user' => [
                    'id' => $user['id'],
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name'],
                    'role' => $user['role_name']
                ]
            ]);
        } else {
            $this->jsonResponse(['error' => 'Invalid or expired OTP'], 401);
        }
    }

    public function login() {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            $this->jsonResponse(['error' => 'Email and password are required'], 400);
        }

        $user = $this->userModel->getUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            if (!$user['is_active']) {
                $this->jsonResponse(['error' => 'Account is inactive'], 403);
            }

            $otp = rand(100000, 999999);
            $expires_at = date('Y-m-d H:i:s', strtotime('+10 minutes'));

            $db = (new \App\Core\Database())->connect();
            $stmt = $db->prepare("INSERT INTO email_verifications (user_id, otp_code, expires_at) VALUES (?, ?, ?)");
            $stmt->execute([$user['id'], $otp, $expires_at]);

            \App\Helpers\MailHelper::send($user['email'], "Your OTP Code", "Your code is: $otp");

            $this->jsonResponse([
                'message' => 'OTP sent to your email',
                'user_id' => $user['id']
            ]);
        } else {
            $this->jsonResponse(['error' => 'Invalid email or password'], 401);
        }
    }

    public function forgotPassword() {
        $email = $_POST['email'] ?? '';
        if (empty($email)) {
            $this->jsonResponse(['error' => 'Email is required'], 400);
        }

        $user = $this->userModel->getUserByEmail($email);
        if ($user) {
            $token = bin2hex(random_bytes(32));
            $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour'));

            // Store token in password_resets table (model logic would go here)
            // Send email with reset link
        }

        $this->jsonResponse(['message' => 'If an account exists, a reset link has been sent']);
    }

    public function register() {
        $token = $_POST['token'] ?? '';
        if (empty($token)) {
            $this->jsonResponse(['error' => 'Invite token is required'], 400);
        }

        $invite = $this->inviteModel->getInviteByToken($token);
        if (!$invite) {
            $this->jsonResponse(['error' => 'Invalid or expired invite token'], 400);
        }

        $data = [
            'first_name' => $_POST['first_name'] ?? '',
            'last_name' => $_POST['last_name'] ?? '',
            'email' => $invite['email'],
            'password' => password_hash($_POST['password'] ?? '', PASSWORD_BCRYPT),
            'role_id' => $invite['role_id']
        ];

        if (empty($data['first_name']) || empty($data['last_name']) || empty($_POST['password'])) {
            $this->jsonResponse(['error' => 'All fields are required'], 400);
        }

        $userId = $this->userModel->createUser($data);
        if ($userId) {
            $this->inviteModel->markAsUsed($token);
            $this->jsonResponse(['message' => 'Registration successful']);
        } else {
            $this->jsonResponse(['error' => 'Registration failed'], 500);
        }
    }
}

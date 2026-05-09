<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\InviteModel;
use App\Middleware\AuthMiddleware;

class InviteController extends Controller {
    private $inviteModel;

    public function __construct() {
        $this->inviteModel = new InviteModel();
    }

    public function generate() {
        $user = AuthMiddleware::authenticate(['Super Admin', 'Manager']);

        $email = $_POST['email'] ?? '';
        $role_id = $_POST['role_id'] ?? '';

        if (empty($email) || empty($role_id)) {
            $this->jsonResponse(['error' => 'Email and Role are required'], 400);
        }

        $token = bin2hex(random_bytes(32));
        $expires_at = date('Y-m-d H:i:s', strtotime('+48 hours'));

        if ($this->inviteModel->createInvite($user['id'], $email, $role_id, $token, $expires_at)) {
            // In a real app, send email here
            $inviteLink = BASE_URL . "/auth/register?token=" . $token;
            $this->jsonResponse(['message' => 'Invite link generated', 'link' => $inviteLink]);
        } else {
            $this->jsonResponse(['error' => 'Failed to generate invite'], 500);
        }
    }
}

<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\NotificationModel;
use App\Middleware\AuthMiddleware;

class NotificationController extends Controller {
    private $notificationModel;

    public function __construct() {
        $this->notificationModel = new NotificationModel();
    }

    public function index() {
        $user = AuthMiddleware::authenticate();
        $notifications = $this->notificationModel->getUnreadNotifications($user['id']);
        $this->jsonResponse($notifications);
    }

    public function markRead() {
        AuthMiddleware::authenticate();
        $id = $_POST['id'] ?? '';
        if ($this->notificationModel->markAsRead($id)) {
            $this->jsonResponse(['message' => 'Notification marked as read']);
        } else {
            $this->jsonResponse(['error' => 'Failed to mark as read'], 500);
        }
    }
}

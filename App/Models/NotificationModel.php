<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class NotificationModel {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function addNotification($user_id, $type, $message) {
        $query = "INSERT INTO notifications (user_id, type, message) VALUES (:user_id, :type, :message)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':message', $message);
        return $stmt->execute();
    }

    public function getUnreadNotifications($user_id) {
        $query = "SELECT * FROM notifications WHERE user_id = :user_id AND is_read = 0 ORDER BY created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function markAsRead($id) {
        $query = "UPDATE notifications SET is_read = 1 WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

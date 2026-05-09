<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class InviteModel {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function createInvite($sender_id, $email, $role_id, $token, $expires_at) {
        $query = "INSERT INTO invite_links (sender_id, email, role_id, token, expires_at) VALUES (:sender_id, :email, :role_id, :token, :expires_at)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':sender_id', $sender_id);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':role_id', $role_id);
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':expires_at', $expires_at);
        return $stmt->execute();
    }

    public function getInviteByToken($token) {
        $query = "SELECT * FROM invite_links WHERE token = :token AND used_at IS NULL AND expires_at > NOW()";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function markAsUsed($token) {
        $query = "UPDATE invite_links SET used_at = NOW() WHERE token = :token";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':token', $token);
        return $stmt->execute();
    }
}

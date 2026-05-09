<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class UserModel {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function createUser($data) {
        $query = "INSERT INTO users (role_id, first_name, last_name, email, password) VALUES (:role_id, :first_name, :last_name, :email, :password)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':role_id', $data['role_id']);
        $stmt->bindParam(':first_name', $data['first_name']);
        $stmt->bindParam(':last_name', $data['last_name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $data['password']);

        if ($stmt->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    public function getUserByEmail($email) {
        $query = "SELECT u.*, r.name as role_name FROM users u JOIN roles r ON u.role_id = r.id WHERE u.email = :email AND u.deleted_at IS NULL";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }
}

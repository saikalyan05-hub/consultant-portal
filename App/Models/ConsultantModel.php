<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class ConsultantModel {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function createConsultant($data) {
        $query = "INSERT INTO consultants (user_id, skills, experience_years, location, linkedin_url, education, work_authorization_status) VALUES (:user_id, :skills, :experience_years, :location, :linkedin_url, :education, :work_authorization_status)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $data['user_id']);
        $stmt->bindParam(':skills', $data['skills']);
        $stmt->bindParam(':experience_years', $data['experience_years']);
        $stmt->bindParam(':location', $data['location']);
        $stmt->bindParam(':linkedin_url', $data['linkedin_url']);
        $stmt->bindParam(':education', $data['education']);
        $stmt->bindParam(':work_authorization_status', $data['work_authorization_status']);
        return $stmt->execute();
    }

    public function getConsultantByUserId($user_id) {
        $query = "SELECT c.*, u.first_name, u.last_name, u.email FROM consultants c JOIN users u ON c.user_id = u.id WHERE c.user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getAllConsultants() {
        $query = "SELECT c.*, u.first_name, u.last_name, u.email FROM consultants c JOIN users u ON c.user_id = u.id";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class JobSubmissionModel {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function createSubmission($data) {
        $query = "INSERT INTO job_submissions (recruiter_id, consultant_id, resume_id, company_name, vendor_name, job_title, location, rate, notes) VALUES (:recruiter_id, :consultant_id, :resume_id, :company_name, :vendor_name, :job_title, :location, :rate, :notes)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':recruiter_id', $data['recruiter_id']);
        $stmt->bindParam(':consultant_id', $data['consultant_id']);
        $stmt->bindParam(':resume_id', $data['resume_id']);
        $stmt->bindParam(':company_name', $data['company_name']);
        $stmt->bindParam(':vendor_name', $data['vendor_name']);
        $stmt->bindParam(':job_title', $data['job_title']);
        $stmt->bindParam(':location', $data['location']);
        $stmt->bindParam(':rate', $data['rate']);
        $stmt->bindParam(':notes', $data['notes']);
        return $stmt->execute();
    }

    public function getAllSubmissions($filters = []) {
        $query = "SELECT js.*, u.first_name as recruiter_name, u.last_name as recruiter_last_name, c_u.first_name as consultant_name, c_u.last_name as consultant_last_name
                  FROM job_submissions js
                  JOIN users u ON js.recruiter_id = u.id
                  JOIN consultants c ON js.consultant_id = c.id
                  JOIN users c_u ON c.user_id = c_u.id WHERE 1=1";

        if (isset($filters['status'])) {
            $query .= " AND js.status = :status";
        }

        $stmt = $this->db->prepare($query);
        if (isset($filters['status'])) {
            $stmt->bindParam(':status', $filters['status']);
        }
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function updateStatus($id, $status) {
        $query = "UPDATE job_submissions SET status = :status WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class InterviewModel {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function scheduleInterview($data) {
        $query = "INSERT INTO interviews (submission_id, interview_date, interview_type, status) VALUES (:submission_id, :interview_date, :interview_type, 'Scheduled')";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':submission_id', $data['submission_id']);
        $stmt->bindParam(':interview_date', $data['interview_date']);
        $stmt->bindParam(':interview_type', $data['interview_type']);
        return $stmt->execute();
    }

    public function getInterviewsBySubmission($submission_id) {
        $query = "SELECT * FROM interviews WHERE submission_id = :submission_id ORDER BY interview_date DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':submission_id', $submission_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function updateFeedback($id, $feedback, $status) {
        $query = "UPDATE interviews SET feedback = :feedback, status = :status WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':feedback', $feedback);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

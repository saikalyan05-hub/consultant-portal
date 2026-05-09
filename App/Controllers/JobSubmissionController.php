<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\JobSubmissionModel;
use App\Middleware\AuthMiddleware;

class JobSubmissionController extends Controller {
    private $submissionModel;

    public function __construct() {
        $this->submissionModel = new JobSubmissionModel();
    }

    public function index() {
        AuthMiddleware::authenticate(['Super Admin', 'Manager', 'Recruiter']);
        $filters = [];
        if (isset($_GET['status'])) {
            $filters['status'] = $_GET['status'];
        }
        $submissions = $this->submissionModel->getAllSubmissions($filters);
        $this->jsonResponse($submissions);
    }

    public function create() {
        $user = AuthMiddleware::authenticate(['Recruiter', 'Super Admin']);

        $data = [
            'recruiter_id' => $user['id'],
            'consultant_id' => $_POST['consultant_id'] ?? '',
            'resume_id' => $_POST['resume_id'] ?? '',
            'company_name' => $_POST['company_name'] ?? '',
            'vendor_name' => $_POST['vendor_name'] ?? '',
            'job_title' => $_POST['job_title'] ?? '',
            'location' => $_POST['location'] ?? '',
            'rate' => $_POST['rate'] ?? '',
            'notes' => $_POST['notes'] ?? ''
        ];

        if (empty($data['consultant_id']) || empty($data['company_name']) || empty($data['job_title'])) {
            $this->jsonResponse(['error' => 'Required fields are missing'], 400);
        }

        if ($this->submissionModel->createSubmission($data)) {
            $this->jsonResponse(['message' => 'Job submission created successfully']);
        } else {
            $this->jsonResponse(['error' => 'Failed to create job submission'], 500);
        }
    }

    public function updateStatus() {
        AuthMiddleware::authenticate(['Recruiter', 'Manager', 'Super Admin']);
        $id = $_POST['id'] ?? '';
        $status = $_POST['status'] ?? '';

        if (empty($id) || empty($status)) {
            $this->jsonResponse(['error' => 'ID and status are required'], 400);
        }

        if ($this->submissionModel->updateStatus($id, $status)) {
            $this->jsonResponse(['message' => 'Status updated successfully']);
        } else {
            $this->jsonResponse(['error' => 'Failed to update status'], 500);
        }
    }
}

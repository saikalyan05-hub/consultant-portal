<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\InterviewModel;
use App\Models\JobSubmissionModel;
use App\Middleware\AuthMiddleware;
use App\Helpers\MailHelper;

class InterviewController extends Controller {
    private $interviewModel;
    private $submissionModel;

    public function __construct() {
        $this->interviewModel = new InterviewModel();
        $this->submissionModel = new JobSubmissionModel();
    }

    public function schedule() {
        AuthMiddleware::authenticate(['Recruiter', 'Super Admin']);

        $data = [
            'submission_id' => $_POST['submission_id'] ?? '',
            'interview_date' => $_POST['interview_date'] ?? '',
            'interview_type' => $_POST['interview_type'] ?? ''
        ];

        if (empty($data['submission_id']) || empty($data['interview_date'])) {
            $this->jsonResponse(['error' => 'Submission ID and date are required'], 400);
        }

        if ($this->interviewModel->scheduleInterview($data)) {
            // Update submission status
            $this->submissionModel->updateStatus($data['submission_id'], 'Interview Scheduled');

            // Notify consultant (Mock)
            MailHelper::send('consultant@example.com', 'Interview Scheduled', 'Your interview has been scheduled for ' . $data['interview_date']);

            $this->jsonResponse(['message' => 'Interview scheduled successfully']);
        } else {
            $this->jsonResponse(['error' => 'Failed to schedule interview'], 500);
        }
    }

    public function feedback() {
        AuthMiddleware::authenticate(['Recruiter', 'Manager', 'Super Admin']);
        $id = $_POST['id'] ?? '';
        $feedback = $_POST['feedback'] ?? '';
        $status = $_POST['status'] ?? 'Completed';

        if (empty($id) || empty($feedback)) {
            $this->jsonResponse(['error' => 'ID and feedback are required'], 400);
        }

        if ($this->interviewModel->updateFeedback($id, $feedback, $status)) {
            $this->jsonResponse(['message' => 'Feedback updated successfully']);
        } else {
            $this->jsonResponse(['error' => 'Failed to update feedback'], 500);
        }
    }
}

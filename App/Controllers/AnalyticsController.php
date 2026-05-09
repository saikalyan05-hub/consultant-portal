<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\JobSubmissionModel;
use App\Middleware\AuthMiddleware;

class AnalyticsController extends Controller {
    private $submissionModel;

    public function __construct() {
        $this->submissionModel = new JobSubmissionModel();
    }

    public function performance() {
        AuthMiddleware::authenticate(['Manager', 'Super Admin']);

        $db = (new \App\Core\Database())->connect();
        $query = "SELECT u.first_name, u.last_name, COUNT(js.id) as total_submissions
                  FROM users u
                  LEFT JOIN job_submissions js ON u.id = js.recruiter_id
                  WHERE u.role_id = 3
                  GROUP BY u.id";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $stats = $stmt->fetchAll();

        $this->jsonResponse($stats);
    }

    public function exportSubmissions() {
        AuthMiddleware::authenticate(['Manager', 'Super Admin']);
        $submissions = $this->submissionModel->getAllSubmissions();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="submissions_report.csv"');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['ID', 'Recruiter', 'Consultant', 'Company', 'Job Title', 'Status', 'Date']);

        foreach ($submissions as $sub) {
            fputcsv($output, [
                $sub['id'],
                $sub['recruiter_name'],
                $sub['consultant_name'],
                $sub['company_name'],
                $sub['job_title'],
                $sub['status'],
                $sub['created_at']
            ]);
        }
        fclose($output);
        exit;
    }
}

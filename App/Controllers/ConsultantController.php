<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\ConsultantModel;
use App\Middleware\AuthMiddleware;

class ConsultantController extends Controller {
    private $consultantModel;

    public function __construct() {
        $this->consultantModel = new ConsultantModel();
    }

    public function index() {
        AuthMiddleware::authenticate(['Super Admin', 'Manager', 'Recruiter']);
        $consultants = $this->consultantModel->getAllConsultants();
        $this->jsonResponse($consultants);
    }

    public function profile() {
        $user = AuthMiddleware::authenticate(['Consultant']);
        $profile = $this->consultantModel->getConsultantByUserId($user['id']);
        $this->jsonResponse($profile);
    }

    public function update() {
        $user = AuthMiddleware::authenticate(['Consultant', 'Super Admin', 'Recruiter']);
        // Update logic here
        $this->jsonResponse(['message' => 'Profile updated successfully']);
    }
}

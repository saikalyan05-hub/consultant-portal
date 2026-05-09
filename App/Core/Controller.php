<?php

namespace App\Core;

class Controller {
    public function model($model) {
        $modelClass = "App\\Models\\" . $model;
        return new $modelClass();
    }

    public function view($view, $data = []) {
        if (file_exists("../app/views/" . $view . ".php")) {
            require_once "../app/views/" . $view . ".php";
        } else {
            die("View does not exist");
        }
    }

    protected function jsonResponse($data, $statusCode = 200) {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }
}

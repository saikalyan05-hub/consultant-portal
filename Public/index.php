<?php

require_once __DIR__ . '/../Config/config.php';

// Autoload Classes
spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class);
    $file = __DIR__ . '/../' . $class . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

use App\Core\App;

$app = new App();

<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../helpers/system_helper.php';

spl_autoload_register(function ($class_name) {
    $file = __DIR__ . '/../libraries/' . $class_name . '.php';
    if (is_file($file)) {
        require_once $file;
    }
});

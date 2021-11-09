<?php

// Get requested action
$action = $_GET['action'] ?? 'error';
$controller = null;
$method = null;

// Basic router
switch ($action) {
    case 'login':
        $controller = 'Auth';
        $method = 'login';
        break;
    case 'error':
    default:
        $controller = 'ErrorDocument';
        $method = 'show404';
}

// Route or fail
if (is_readable("$controller.php")) {
    require_once("$controller.php");
    call_user_func([$controller, $method]);
} else {
    http_response_code(500);
    header('Content-Type: application/json');

    die("Error processing the request");
}

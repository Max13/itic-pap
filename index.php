<?php

// CORS
$headers = [
    'Access-Control-Allow-Origin'      => '*',
    'Access-Control-Allow-Methods'     => 'POST, GET, OPTIONS, PUT, DELETE',
    'Access-Control-Allow-Credentials' => 'true',
    'Access-Control-Max-Age'           => '86400',
    'Access-Control-Allow-Headers'     => 'Content-Type, Authorization, X-Requested-With',
];

foreach($headers as $key => $value) {
    header("$key: $value");
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('Content-Type: application/json');
    die('{"method":"OPTIONS"}');
}
// /CORS

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

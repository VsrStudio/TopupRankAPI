<?php
require '../includes/db.php';
require '../includes/auth.php';

$headers = apache_request_headers();

if (!isset($headers['Authorization']) || $headers['Authorization'] !== 'Bearer your_api_key') {
    http_response_code(403);
    echo json_encode(['message' => 'Forbidden']);
    exit();
}

function verifyApiKey() {
    global $headers;
    if (!isset($headers['Authorization']) || $headers['Authorization'] !== 'Bearer your_api_key') {
        http_response_code(403);
        echo json_encode(['message' => 'Forbidden']);
        exit();
    }
}
?>

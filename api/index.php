<?php
// Dispatch legacy root-level PHP endpoints through Vercel's /api function.
$requested = isset($_GET['path']) ? (string) $_GET['path'] : '';
if ($requested === '') {
    $requested = trim((string) parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH), '/');
}
$requested = basename($requested);

$allowed = [
    'index.php',
    'contacts.php',
    'add_contact.php',
    'edit_contact.php',
    'delete_contact.php',
];

if ($requested === '' || $requested === 'api' || $requested === 'index.php') {
    require dirname(__DIR__) . '/index.php';
    exit;
}

if (!in_array($requested, $allowed, true)) {
    http_response_code(404);
    echo 'Not Found';
    exit;
}

require dirname(__DIR__) . '/' . $requested;

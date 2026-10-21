<?php
require_once __DIR__ . '/core/init.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$fields = ['first_name','last_name','email','phone','address1','address2','city','state','zipcode','contact_group','notes'];
$data = [];
foreach ($fields as $field) {
    $data[$field] = trim((string)($_POST[$field] ?? ''));
}

if ($data['first_name'] === '' || $data['last_name'] === '') {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => 'First and last name are required']);
    exit;
}
if ($data['email'] !== '' && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => 'Please enter a valid email address']);
    exit;
}

$db = new Database();
$db->query('INSERT INTO contacts (first_name,last_name,email,phone,address1,address2,city,state,zipcode,contact_group,notes)
           VALUES (:first_name,:last_name,:email,:phone,:address1,:address2,:city,:state,:zipcode,:contact_group,:notes)');
foreach ($data as $field => $value) {
    $db->bind(':' . $field, $value);
}

try {
    $db->execute();
    echo json_encode(['success' => true, 'message' => 'Contact added successfully']);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Unable to save contact']);
}

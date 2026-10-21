<?php
require_once __DIR__ . '/core/init.php';
header('Content-Type: application/json; charset=utf-8');

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => 'Invalid contact']);
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
$db->query('UPDATE contacts SET first_name=:first_name,last_name=:last_name,email=:email,phone=:phone,address1=:address1,address2=:address2,city=:city,state=:state,zipcode=:zipcode,contact_group=:contact_group,notes=:notes WHERE id=:id');
foreach ($data as $field => $value) {
    $db->bind(':' . $field, $value);
}
$db->bind(':id', $id, PDO::PARAM_INT);

try {
    $db->execute();
    echo json_encode(['success' => true, 'message' => 'Contact updated successfully']);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Unable to update contact']);
}

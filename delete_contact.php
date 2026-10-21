<?php
require_once __DIR__ . '/core/init.php';
header('Content-Type: application/json; charset=utf-8');

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => 'Invalid contact']);
    exit;
}

$db = new Database();
$db->query('DELETE FROM contacts WHERE id = :id');
$db->bind(':id', $id, PDO::PARAM_INT);

try {
    $db->execute();
    $deleted = $db->rowCount() > 0;
    echo json_encode(['success' => $deleted, 'message' => $deleted ? 'Contact deleted' : 'Contact not found']);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Unable to delete contact']);
}

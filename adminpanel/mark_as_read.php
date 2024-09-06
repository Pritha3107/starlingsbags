<?php
include_once "admin_crud.php";
$classobj = new Admincrud();

$id = $_POST['id'] ?? null;

if ($id) {
    $result = $classobj->markMessageAsRead($id);
    echo json_encode(['status' => $result ? 'success' : 'error']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No ID provided']);
}
?>

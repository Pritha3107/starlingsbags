<?php
include_once "admin_crud.php";
$classobj = new Admincrud();

$unreadCount = $classobj->getUnreadMessageCount();

header('Content-Type: application/json');
echo json_encode(['newMessages' => $unreadCount]);
?>
<?php
require "../../config/db.php";
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== 'admin') {
    header("location: /gym-management-system/auth/login.php");
    exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    header('Location: index.php?msg=invalid');
    exit;
}

// Start transaction
$conn->begin_transaction();

try {
    // Delete from trainer_details
    $stmt = $conn->prepare("DELETE FROM trainer_details WHERE trainer_id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    
    $conn->commit();
    header('Location: /gym-management-system/admin/index.php?msg=trainer_deleted');
    exit;

} catch(Exception $e) {
    $conn->rollback();
    $err = urlencode($e->getMessage());
    header('Location: /gym-management-system/admin/index.php?msg=error&err=' . $err);
    exit;
}


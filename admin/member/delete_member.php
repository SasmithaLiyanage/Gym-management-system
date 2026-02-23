<?php
require "../../config/db.php";
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== 'admin') {
    header("location: /gym-management-system/auth/login.php");
    exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    header('Location: /gym-management-system/admin/index.php?msg=invalid');
    exit;
}

// Get user_id from member_details
$stmt = $conn->prepare("SELECT user_id FROM member_details WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($user_id);
if(!$stmt->fetch()){
    $stmt->close();
    header('Location: /gym-management-system/admin/index.php?msg=notfound');
    exit;
}
$stmt->close();

// Start transaction
$conn->begin_transaction();

try {
    // Delete from member_details
    $stmt1 = $conn->prepare("DELETE FROM member_details WHERE id=?");
    $stmt1->bind_param("i", $id);
    $stmt1->execute();
    $stmt1->close();

    // Delete from users
    $stmt2 = $conn->prepare("DELETE FROM users WHERE id=?");
    $stmt2->bind_param("i", $user_id);
    $stmt2->execute();
    $stmt2->close();

    $conn->commit();
    header('Location: /gym-management-system/admin/index.php?msg=deleted');
    exit;

} catch(Exception $e) {
    $conn->rollback();
    $err = urlencode($e->getMessage());
    header('Location: /gym-management-system/admin/index.php?msg=error&err=' . $err);
    exit;
}
?>

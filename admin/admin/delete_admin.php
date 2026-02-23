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

// Get user_id from member_details
$stmt = $conn->prepare("SELECT trainer_id FROM trainer_details WHERE trainer_id=?");
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


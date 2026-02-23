<?php
require "../../config/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name'] ?? '');
    $mail = trim($_POST['email'] ?? '');
    $mobile_number = trim($_POST['pnumber'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $qualification = trim($_POST['qualification'] ?? '');
   

    // Check username/email already exists
    $check = $conn->prepare("SELECT trainer_id FROM trainer_details WHERE mail=?");
    $check->bind_param("s",$mail);
    $check->execute();
    $check->store_result();

    if($check->num_rows > 0){
        echo "Username or Email already taken!";
        exit();
    }
    $check->close();

    // Start transaction
    $conn->begin_transaction();

    try{
        // Insert into member_details table
        $stmt = $conn->prepare("
            INSERT INTO trainer_details 
            (name,phone_number,address,mail,qualification)
            VALUES (?,?,?,?,?)
        ");

        $stmt->bind_param(
            "sssss",
            $name,
            $mobile_number,
            $address,
            $mail,
            $qualification
        );

        $stmt->execute();
        $stmt->close();

        // Commit
        $conn->commit();

        session_start();
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            header("Location: /gym-management-system/admin/index.php?msg=registered");
        } else {
            header("Location: /gym-management-system/auth/login.php?msg=registered");
        }
        exit();

    } catch(Exception $e){
        $conn->rollback();
        echo "Registration Failed: ".$e->getMessage();
    }
}
?>

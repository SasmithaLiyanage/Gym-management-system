<?php
require "../../config/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name'] ?? '');
    $mail = trim($_POST['email'] ?? '');
    $mobile_number = trim($_POST['pnumber'] ?? '');
    $address = trim($_POST['address'] ?? '');

    $height = $_POST['height'] ?? 0;
    $weight = $_POST['weight'] ?? 0;
    $fitness_goal = $_POST['fitness_goal'] ?? '';

    $budget = trim($_POST['budget'] ?? '');
    $experience = trim($_POST['experience'] ?? '');
    $package = trim($_POST['package'] ?? "");
    $medical_check = trim($_POST['medical_check'] ?? '');

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
   

    // Check username/email already exists
    $check = $conn->prepare("SELECT id FROM users WHERE username=? OR email=?");
    $check->bind_param("ss",$username,$mail);
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
        $role = 'member';

        //  Insert into users table
        $stmt1 = $conn->prepare("INSERT INTO users (username,password,email,role) VALUES (?,?,?,?)");
        $stmt1->bind_param("ssss",$username,$password,$mail,$role);
        $stmt1->execute();
        $user_id = $stmt1->insert_id;
        $stmt1->close();

        // Insert into member_details table
        $stmt2 = $conn->prepare("
            INSERT INTO member_details 
            (user_id,name,phone_number,package,medical_check,budget,experience,height,weight,fitness_goal,address)
            VALUES (?,?,?,?,?,?,?,?,?,?,?)
        ");

        $stmt2->bind_param(
            "issssssddss",
            $user_id,
            $name,
            $mobile_number,
            $package,
            $medical_check,
            $budget,
            $experience,
            $height,
            $weight,
            $fitness_goal,
            $address
        );

        $stmt2->execute();
        $stmt2->close();

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

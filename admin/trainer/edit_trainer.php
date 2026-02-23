<?php
require "../../config/db.php";
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== 'admin') {
    header("location: /gym-management-system/auth/login.php");
    exit;
}

// Get member ID from query string
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    die("Invalid member ID.");
}

// Fetch member data
$stmt = $conn->prepare("
    select * from trainer_details
    where trainer_id=?
");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    die("Trainer not found.");
}
$trainer = $result->fetch_assoc();
$stmt->close();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name'] ?? '');
    $mail = trim($_POST['email'] ?? '');
    $mobile_number = trim($_POST['pnumber'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $qualification = trim($_POST['qualification'] ?? '');
    

    // Start transaction
    $conn->begin_transaction();
    try {
        
        $stmt1 = $conn->prepare("UPDATE trainer_details SET name=?, mail=?, phone_number=?, address=?, qualification=? WHERE trainer_id=?");
        $stmt1->bind_param("sssssi", $name, $mail, $mobile_number, $address, $qualification, $trainer['trainer_id']);
        $stmt1->execute();
        $stmt1->close();
        $conn->commit();

        header("Location: /gym-management-system/admin/index.php?msg=updated");
        exit();

    } catch (Exception $e) {
        $conn->rollback();
        $error = "Update failed: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Trainer</title>
    <link rel="icon" type="image/png" href="/gym-management-system/asset/images/barbell.png">
    <link rel="stylesheet" href="/gym-management-system/admin/member/memberstyle.css">
</head>

<body>
    <div class="main">
        <div class="members">
            <div class="topic">
                <h1>Update trainer details</h1>
            </div>

            <?php if (!empty($error)) echo "<p style='color:red;'>" . htmlspecialchars($error) . "</p>"; ?>
            <form method="post" class="edit-form">
                <div class="inputs">
                    <label>Name: <input type="text" name="name" value="<?= htmlspecialchars($trainer['name']) ?>" required></label><br>
                    <label>Email: <input type="email" name="email" value="<?= htmlspecialchars($trainer['mail']) ?>" required></label><br>
                    <label>Phone Number : <input type="text" name="pnumber" value="<?= htmlspecialchars($trainer['phone_number']) ?>" required></label><br>
                    <label >Qulification : <input type="text" name="qualification" value="<?= htmlspecialchars($trainer['qualification']) ?>" required></label><br>
                    <label>Address: <input type="text" name="address" value="<?= htmlspecialchars($trainer['address']) ?>" required></label><br>
                </div>


                <div class="buttons">
                    <button type="submit">Update</button>
                    <a href="/gym-management-system/admin/index.php"><button type="button">Cancel</button></a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
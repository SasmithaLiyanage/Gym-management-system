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
    select * from users
    where id=?
");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    die("User not found.");
}
$users = $result->fetch_assoc();
$stmt->close();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $role = trim($_POST['role'] ?? '');


    // Start transaction
    $conn->begin_transaction();
    try {

        $stmt1 = $conn->prepare("UPDATE users SET role=? WHERE id=?");
        $stmt1->bind_param("ss", $role, $users['id']);
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
    <link rel="stylesheet" href="/gym-management-system/admin/member/memberstyle.css">
    <link rel="icon" type="image/png" href="/gym-management-system/asset/images/barbell.png">
</head>

<body>
    <div class="main">
        <div class="members">
            <div class="topic">
                <h1>Authority Selection</h1>
            </div>

            <?php if (!empty($error)) echo "<p style='color:red;'>" . htmlspecialchars($error) . "</p>"; ?>
            <form method="post" class="edit-form">
                <div class="inputs">
                    <select name="role" required>
                        <option value="admin" <?= $users['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="member" <?= $users['role'] === 'member' ? 'selected' : '' ?>>Member</option>
                    </select>
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
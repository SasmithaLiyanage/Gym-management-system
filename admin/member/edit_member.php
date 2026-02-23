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
    SELECT m.*, u.username, u.email, u.password, u.id AS user_id
    FROM member_details m
    JOIN users u ON u.id = m.user_id
    WHERE m.id=?
");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    die("Member not found.");
}
$member = $result->fetch_assoc();
$stmt->close();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name'] ?? '');
    $mail = trim($_POST['email'] ?? '');
    $mobile_number = trim($_POST['pnumber'] ?? '');
    $address = trim($_POST['address'] ?? '');

    $height = floatval($_POST['height'] ?? 0);
    $weight = floatval($_POST['weight'] ?? 0);
    $fitness_goal = $_POST['fitness_goal'] ?? '';

    $budget = trim($_POST['budget'] ?? '');
    $experience = trim($_POST['experience'] ?? '');
    $package = trim($_POST['package'] ?? '');
    $medical_check = trim($_POST['medical_check'] ?? '');

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    

    // Start transaction
    $conn->begin_transaction();
    try {
        // 1️⃣ Update users table
        $stmt1 = $conn->prepare("UPDATE users SET username=?, email=?, password=? WHERE id=?");
        $stmt1->bind_param("sssi", $username, $mail, $password, $member['user_id']);
        $stmt1->execute();
        $stmt1->close();

        // 2️⃣ Update member_details table
        $stmt2 = $conn->prepare("
            UPDATE member_details SET
                name=?,
                phone_number=?,
                package=?,
                medical_check=?,
                budget=?,
                experience=?,
                height=?,
                weight=?,
                fitness_goal=?,
                address=?
            WHERE id=?
        ");

        $stmt2->bind_param(
            "sssssssddsi",
            $name,
            $mobile_number,
            $package,
            $medical_check,
            $budget,
            $experience,
            $height,
            $weight,
            $fitness_goal,
            $address,
            $id
        );

        $stmt2->execute();
        $stmt2->close();

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
    <title>Edit Member</title>
    <link rel="icon" type="image/png" href="/gym-management-system/asset/images/barbell.png">
    <link rel="stylesheet" href="/gym-management-system/admin/member/memberstyle.css">
</head>

<body>
    <div class="main">
        <div class="members">
            <div class="topic">
                <h1>Update member details</h1>
            </div>

            <?php if (!empty($error)) echo "<p style='color:red;'>" . htmlspecialchars($error) . "</p>"; ?>
            <form method="post" class="edit-form">
                <div class="inputs">
                    <label>Name: <input type="text" name="name" value="<?= htmlspecialchars($member['name']) ?>" required></label><br>
                    <label>Username: <input type="text" name="username" value="<?= htmlspecialchars($member['username']) ?>" required></label><br>
                    <label>Email: <input type="email" name="email" value="<?= htmlspecialchars($member['email']) ?>" required></label><br>
                    <label>Password: <input type="text" name="password" value="<?= htmlspecialchars($member['password']) ?>" placeholder="Enter new password" required></label><br>

                    <label>Package:
                        <select name="package" required>
                            <option value="basic" <?= $member['package'] === 'basic' ? 'selected' : '' ?>>Basic Package</option>
                            <option value="standard" <?= $member['package'] === 'standard' ? 'selected' : '' ?>>Standard Package</option>
                            <option value="premium" <?= $member['package'] === 'premium' ? 'selected' : '' ?>>Premium Package</option>
                            <option value="elite" <?= $member['package'] === 'elite' ? 'selected' : '' ?>>Elite Package</option>
                        </select>
                    </label><br>

                    <label>Phone: <input type="text" name="pnumber" value="<?= htmlspecialchars($member['phone_number']) ?>" required></label><br>
                    <label>Medical Check: <input type="text" name="medical_check" value="<?= htmlspecialchars($member['medical_check']) ?>" required></label><br>
                    <label>Budget: <input type="text" name="budget" value="<?= htmlspecialchars($member['budget']) ?>" required></label><br>
                    <label>Experience: <input type="text" name="experience" value="<?= htmlspecialchars($member['experience']) ?>" required></label><br>
                    <label>Height: <input type="text" name="height" value="<?= htmlspecialchars($member['height']) ?>" required></label><br>
                    <label>Weight: <input type="text" name="weight" value="<?= htmlspecialchars($member['weight']) ?>" required></label><br>
                    <label>Fitness Goal:
                        <select name="fitness_goal" required>
                            <option value="muscle_gain" <?= $member['fitness_goal'] === 'muscle_gain' ? 'selected' : '' ?>>Muscle Gain</option>
                            <option value="lose_weight" <?= $member['fitness_goal'] === 'lose_weight' ? 'selected' : '' ?>>Lose Weight</option>
                            <option value="endurance" <?= $member['fitness_goal'] === 'endurance' ? 'selected' : '' ?>>Endurance</option>
                            <option value="flexibility" <?= $member['fitness_goal'] === 'flexibility' ? 'selected' : '' ?>>Flexibility</option>
                            <option value="body_shape" <?= $member['fitness_goal'] === 'body_shape' ? 'selected' : '' ?>>Body Shape</option>
                        </select>
                    </label><br>
                    <label>Address: <input type="text" name="address" value="<?= htmlspecialchars($member['address']) ?>" required></label><br>
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
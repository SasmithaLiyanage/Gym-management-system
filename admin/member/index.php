<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== 'admin'){
    header("location: /gym-management-system/auth/login.php");
    exit;
}
require "../../config/db.php";

$sql = "SELECT m.*, u.username, u.email ,u.password ,u.created_at FROM member_details m JOIN users u ON u.id = m.user_id ORDER BY m.id ASC ";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin-dashboard</title>
    <link rel="stylesheet" href="/gym-management-system/admin/member/style.css">
</head>

<body>
    <div class="main">
        <div class="members">
            <div class="first-container">
                <div class="topic">
                    <h1>Members Management</h1>
                    <p>The Members Management section of the Gym Management System
                        Admin Dashboard allows administrators to efficiently manage all
                        gym members. It provides features to add, update, view, and delete member
                        records, track membership plans, monitor payment status, manage renewals,
                        and check attendance history. This module helps streamline member
                        data organization, improve communication, and ensure smooth gym operations.</p>
                </div>
            </div>

            <div class="second-container">
                <div class="management-table">
                    <div class="panel">
                        <a href="\gym-management-system\auth\register.php">Add Member</a>
                    </div>
                    <div class="table">
                        <table class="tableManagement">
                            <tr>
                                <th>Member Id</th>
                                <th>Name</th>
                                <th>Package</th>
                                <th>Phone Number</th>
                                <th>Register date</th>
                                <th>Action</th>
                            </tr>

                            <?php if ($result->num_rows > 0): ?>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= $row['id']; ?></td>
                                        <td><?= $row['name']; ?></td>
                                        <td><?= $row['package']; ?></td>
                                        <td><?= $row['phone_number']; ?></td>
                                        <td><?= $row['created_at']; ?></td>

                                        <td class="action">

                                            <a href="#" class="details-btn"
                                                data-id="<?= $row['id']; ?>"
                                                data-name="<?= $row['name']; ?>"
                                                data-package="<?= $row['package']; ?>"
                                                data-phone="<?= $row['phone_number']; ?>"
                                                data-username="<?= $row['username']; ?>"
                                                data-mail="<?= $row['email']; ?>"
                                                data-password="<?= $row['password']; ?>"
                                                data-medical-check="<?= $row['medical_check']; ?>"
                                                data-budget="<?= $row['budget']; ?>"
                                                data-experience="<?= $row['experience']; ?>"
                                                data-height="<?= $row['height']; ?>"
                                                data-weight="<?= $row['weight']; ?>"
                                                data-fitness-goal="<?= $row['fitness_goal']; ?>"
                                                data-address="<?= $row['address']; ?>"

                                                onclick="modelopen()">
                                                Details</a>

                                            <a href="/gym-management-system/admin/member/delete_member.php?id=<?= $row['id']; ?>" class="delete-btn"
                                                id="btn delete"
                                                onclick="return confirm('Are you sure to delete this member?');">
                                                Delete
                                            </a>
                                        </td>

                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>

                                <tr>
                                    <td colspan="6">No members found</td>
                                </tr>

                            <?php endif; ?>
                        </table>
                    </div>


                    <!-- popup mocel for see memeber details -->
                    <div class="model" id="modelclass" style="display:none;">
                        <div class="model-content">
                            <div class="model-topic">
                                <h1>DETAILS</h1>
                            </div>
                            <div class="model-body">
                                <div class="content">
                                    <p><strong>Name: </strong> <span id="memberName"></span></p>
                                    <p><strong>Username: </strong> <span id="memberUsername"></span></p>
                                    <p><strong>Email: </strong> <span id="memberMail"></span></p>
                                    <p><strong>Package: </strong> <span id="memberPackage"></span></p>
                                    <p><strong>Phone: </strong> <span id="memberPhone"></span></p>
                                    <p><strong>Password: </strong> <span id="memberPassword"></span></p>
                                    <p><strong>Medical Check: </strong> <span id="memberMedicalCheck"></span></p>
                                    <p><strong>Budget: </strong> <span id="memberBudget"></span></p>
                                    <p><strong>Experience: </strong> <span id="memberExperience"></span></p>
                                    <p><strong>Height: </strong> <span id="memberHeight"></span></p>
                                    <p><strong>Weight: </strong> <span id="memberWeight"></span></p>
                                    <p><strong>Fitness Goal: </strong> <span id="memberFitnessGoal"></span></p>
                                    <p><strong>address: </strong> <span id="memberAddress"></span></p>
                                </div>
                            </div>
                            <div class="btn">
                                <a href="" class="detail-btn"
                                    id="editMemberBtn">
                                       <button type="button">Edit</button>
                                </a>
                            </div>
                            <p id="check"></p>
                            <div class="close">
                                <button id="closeBtn" onclick="modelclose()">&times;</button>
                            </div>
                        </div>
                    </div>
                </div>




            </div>
        </div>
    </div>

</body>
<script src="/gym-management-system/admin/member/details-modal.js"></script>

</html>
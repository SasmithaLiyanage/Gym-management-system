<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../auth/login.php");
    exit;
}

// Check if user is admin
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== 'admin') {
    header("location: ../index.php"); // Redirect non-admins to home
    exit;
}

// Include config file
require_once "../config/db.php";

// Define variables
$name = $_SESSION["username"];
$user_id = $_SESSION["id"];

// Prepare a select statement
$sql = "SELECT m.*, u.username, u.email , u.password FROM member_details m JOIN users u ON m.user_id = u.id WHERE u.id = ?";

if ($stmt = $conn->prepare($sql)) {
    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("i", $user_id);

    // Attempt to execute the prepared statement
    if ($stmt->execute()) {
        $result1 = $stmt->get_result();

        if ($result1->num_rows == 1) {
            /* Fetch result row as an associative array. Since the result set
            contains only one row, we don't need to use while loop */
            $row = $result1->fetch_assoc();

            $member_id = $row["id"];
            $name = $row["name"];
            $package = $row["package"];
            $phone = $row["phone_number"];
            $email = $row["email"];
            $username = $row["username"];
            $password = $row["password"];
            $budget = $row["budget"];
            $experience = $row["experience"];
            $medical_check = $row["medical_check"];
            $weight = $row["weight"];
            $height = $row["height"];
            $address = $row["address"];
            $fitness_goal = $row["fitness_goal"];

            // Add other fields as needed
        } else {
            // URL doesn't contain valid id. Redirect to error page
            // header("location: error.php");
            // exit();
            $name = $_SESSION["username"]; // Fallback if member details not found
            $package = "No Package Selected";
        }
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }

    // Close statement
    $stmt->close();
}

$sql2 = "SELECT m.*, u.username, u.email ,u.password ,u.created_at FROM member_details m JOIN users u ON u.id = m.user_id ORDER BY m.id ASC ";
$result = $conn->query($sql2);

$trainersql = "select * from trainer_details";
$trainerresult = $conn->query($trainersql);

$adminsql = "select * from users";
$adminresult = $conn->query($adminsql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Atlas Fitness Center</title>
    <link rel="stylesheet" href="/gym-management-system/asset/css/admin-dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" type="image/png" href="/gym-management-system/asset/images/barbell.png">
</head>

<body>

    <!-- MAIN -->
    <div class="main">

        <div class="container">

            <!-- TOP PROFILE AREA -->
            <div class="main-details-background">
                <div class="main-detail">

                    <div class="profile">
                        <div class="icon">
                            <!-- Maybe add user image processing later -->
                            <i class="fas fa-user-circle" style="font-size: 140px; color: #fff;"></i>
                        </div>
                    </div>

                    <div class="profile-details">
                        <h1><?php echo htmlspecialchars($name); ?></h1>
                        <p>Admin Dashboard</p>


                        <nav class="navigation">
                            <ul>

                                <a href="#addmember">
                                    <li> + Members</li>
                                </a>
                                <a href="#addtrainers">
                                    <li> + Trainers</li>
                                </a>
                                <a href="#admin">
                                    <li> + Admin authoroty</li>
                                </a>
                                <a href="../auth/logout.php">
                                    <li> <img src="\gym-management-system\asset\images\nav\logout2.svg" alt=""> Logout</li>
                                </a>

                            </ul>
                        </nav>
                    </div>

                </div>
            </div>

            <!-- DASHBOARD BODY -->
            <div class="dashboard-body">

                <section id="addmember">
                    <div class="members">
                        <div class="first-container">
                            <div class="topic-icon">
                                <img src="\gym-management-system\asset\images\management\member.svg" alt="">
                            </div>
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
                                    <a href="\gym-management-system\auth\register.php">+ Add Member</a>
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
                </section>

                <section id="addtrainers">
                    <div class="members" id="c">
                        <div class="first-container">
                            <div class="topic-icon">
                                <img src="\gym-management-system\asset\images\management\trainer.svg" alt="">
                            </div>
                            <div class="topic">
                                <h1>Trainer Management</h1>
                                <p>Trainer Management is a core module in the Gym Management System’s
                                    Admin Dashboard that allows administrators to efficiently manage all
                                    -related information in one centralized place.
                                    This module helps ensure that trainer records are organized, accurate, and easily accessible.</p>
                            </div>
                        </div>

                        <div class="second-container">
                            <div class="management-table">
                                <div class="panel">
                                    <a href="\gym-management-system\auth\trainer-registration.php">+ Add Trainer</a>
                                </div>
                                <div class="table">
                                    <table class="tableManagement">
                                        <tr>
                                            <th>trainer Id</th>
                                            <th>Name</th>
                                            <th>mail</th>
                                            <th>Phone Number</th>
                                            <th>Register date</th>
                                            <th>Action</th>
                                        </tr>

                                        <?php if ($trainerresult->num_rows > 0): ?>
                                            <?php while ($row = $trainerresult->fetch_assoc()): ?>
                                                <tr>
                                                    <td><?= $row['trainer_id']; ?></td>
                                                    <td><?= $row['name']; ?></td>
                                                    <td><?= $row['mail']; ?></td>
                                                    <td><?= $row['phone_number']; ?></td>
                                                    <td><?= $row['register_date']; ?></td>

                                                    <td class="action">

                                                        <a href="#" class="tdetails-btn"
                                                            
                                                            data-id="<?= $row['trainer_id']; ?>"
                                                            data-trainer-Name="<?= $row['name']; ?>"
                                                            data-trainer-Qualification="<?= $row['qualification']; ?>"
                                                            data-trainer-Phone="<?= $row['phone_number']; ?>"
                                                            data-trainer-Mail="<?= $row['mail']; ?>"
                                                            data-trainer-Address="<?= $row['address']; ?>"

                                                            onclick="modelopen()">
                                                            Details</a>

                                                        <a href="/gym-management-system/admin/trainer/delete_trainer.php?id=<?= $row['trainer_id']; ?>" class="delete-btn"
                                                            id="btn delete"
                                                            onclick="return confirm('Are you sure to delete this trainer?');">
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
                                <div class="model" id="modelclass2" style="display:none;">
                                    <div class="model-content">
                                        <div class="model-topic">
                                            <h1>TRAINER DETAILS</h1>
                                        </div>
                                        <div class="model-body">
                                            <div class="content">
                                                <p><strong>Name: </strong> <span id="trainerName"></span></p>
                                                <p><strong>Email: </strong> <span id="trainerMail"></span></p>
                                                <p><strong>Qualification: </strong> <span id="trainerQualification"></span></p>
                                                <p><strong>Phone: </strong> <span id="trainerPhone"></span></p>
                                                <p><strong>address: </strong> <span id="trainerAddress"></span></p>
                                            </div>
                                        </div>
                                        <div class="btn">
                                            <a href="" class="detail-btn"
                                                id="editTrainerBtn">
                                                <button type="button">Edit</button>
                                            </a>
                                        </div>
                                        <p id="check"></p>
                                        <div class="close">
                                            <button id="tcloseBtn" onclick="modelclose()">&times;</button>
                                        </div>
                                    </div>
                                </div>
                            </div>




                        </div>
                    </div>
                </section>


                <section id="admin">
                    <div class="members">
                        <div class="first-container">
                            <div class="topic-icon">
                                <img src="\gym-management-system\asset\images\management\admin.svg" alt="">
                            </div>
                            <div class="topic">
                                <h1>Admin Authority</h1>
                                <p>The Admin Authority section of the Gym Management System Admin Dashboard is a crucial module that empowers administrators with the necessary tools and permissions to effectively manage and oversee the entire gym operations.
                                </p>
                            </div>
                        </div>

                        <div class="second-container">
                            <div class="second-container">
                                <div class="management-table">
                                    <!-- <div class="panel">
                                        <a href="\gym-management-system\auth\register.php">Add Trainer</a>
                                    </div> -->
                                    <div class="table">
                                        <table class="tableManagement">
                                            <tr>
                                                <th>User Id</th>
                                                <th>UserName</th>
                                                <th>Email</th>
                                                <th>Authority</th>
                                                <th>Register date</th>
                                                <th>Action</th>
                                            </tr>

                                            <?php if ($adminresult->num_rows > 0): ?>
                                                <?php while ($row = $adminresult->fetch_assoc()): ?>
                                                    <tr>
                                                        <td><?= $row['id']; ?></td>
                                                        <td><?= $row['username']; ?></td>
                                                        <td><?= $row['email']; ?></td>
                                                        <td><?= $row['role']; ?></td>
                                                        <td><?= $row['created_at']; ?></td>

                                                        <td class="action">

                                                            <a href="#" class="adetails-btn"
                                                                data-id="<?= $row['id']; ?>"
                                                                data-admin-User-Name="<?= $row['username']; ?>"
                                                                data-admin-mail="<?= $row['email']; ?>"
                                                                data-admin-Role ="<?= $row['role']; ?>"
                                                                data-admin-registerdate="<?= $row['created_at']; ?>"

                                                                onclick="modelopen()">
                                                                Edit authority</a>
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
                                    <div class="model" id="modelclass3" style="display:none;">
                                        <div class="model-content">
                                            <div class="model-topic">
                                                <h1>Admin access</h1>
                                            </div>
                                            <div class="model-body">
                                                <div class="content">
                                                    <p><strong>Username: </strong> <span id="adminUsername"></span></p>
                                                    <p><strong>Email: </strong> <span id="adminMail"></span></p>
                                                    <p><strong>Role: </strong> <span id="adminRole"></span></p>

                                                </div>
                                            </div>
                                            <div class="btn">
                                                <a href="" class="adetail-btn"
                                                    id="editAdminBtn">
                                                    <button type="button">Give Admin Access</button>
                                                </a>
                                            </div>
                                            <p id="check"></p>
                                            <div class="close">
                                                <button id="acloseBtn" onclick="modelclose()">&times;</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                </section>
            </div>

        </div>

    </div>

    <script src="/gym-management-system/admin/member/details-modal.js"></script>
    <script src="/gym-management-system/admin/trainer/details_trainer.js"></script>
    <script src="/gym-management-system/admin/admin/details_admin.js"></script>
    

</body>

</html>
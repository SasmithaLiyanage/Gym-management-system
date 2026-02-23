<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../auth/login.php");
    exit;
}

// Include config file
require_once "../config/db.php";

// Define variables and initialize with empty values
$name = $package = $member_id = "";
$user_id = $_SESSION["id"];

// Prepare a select statement
$sql = "SELECT m.*, u.username, u.email , u.password, u.created_at FROM member_details m JOIN users u ON m.user_id = u.id WHERE u.id = ?";

$days_remaining = 0;
$expiry_date_formatted = "N/A";

if ($stmt = $conn->prepare($sql)) {
    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("i", $user_id);

    // Attempt to execute the prepared statement
    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            /* Fetch result row as an associative array. Since the result set
            contains only one row, we don't need to use while loop */
            $row = $result->fetch_assoc();

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
            $created_at = $row["created_at"];

            // Calculate Expiry Date based on package duration
            $package_durations = [
                'basic'    => '+1 month',
                'standard' => '+3 months',
                'premium'  => '+6 months',
                'elite'    => '+12 months',
            ];

            $duration = isset($package_durations[strtolower($package)]) 
                ? $package_durations[strtolower($package)] 
                : '+1 month'; // Default to 1 month if package not found

            if ($created_at) {
                $reg_date = new DateTime($created_at);
                $expiry_date = clone $reg_date;
                $expiry_date->modify($duration);
                $expiry_date_formatted = $expiry_date->format('Y-m-d');

                $current_date = new DateTime();
                $interval = $current_date->diff($expiry_date);

                // key 'r' indicates the sign ("-" if negative, empty if positive)
                // However diff returns absolute difference in days usually, but invert property tells if negative.
                // easier: compare timestamps or use %r%a

                if ($current_date > $expiry_date) {
                    $days_remaining = 0;
                } else {
                    $days_remaining = $interval->days;
                }
            }

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

// Fetch payment history
$payment_history = [];
$last_payment_amount = 0;
$sql_payment = "SELECT * FROM payments WHERE user_id = ? ORDER BY payment_date DESC";
if ($stmt_payment = $conn->prepare($sql_payment)) {
    $stmt_payment->bind_param("i", $user_id);
    if ($stmt_payment->execute()) {
        $result_payment = $stmt_payment->get_result();
        while ($row_payment = $result_payment->fetch_assoc()) {
            $payment_history[] = $row_payment;
        }

        // Get the last payment amount if available
        if (!empty($payment_history)) {
            $last_payment_amount = $payment_history[0]['amount'];
        }
    }
    $stmt_payment->close();
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard - Atlas Fitness Center</title>
    <link rel="stylesheet" href="/gym-management-system/asset/css/customer-dashboad.css">
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
                        <p><?php echo htmlspecialchars($package); ?> Package</p>


                        <nav class="navigation">
                            <ul>
                                <a href="/gym-management-system/index.php">
                                    <li><i class="fa-solid fa-house" style="font-size: 12px; color: #fff;"></i>home</li>
                                </a>
                                <a href="#dashboard">
                                    <li>Package</li>
                                </a>
                                <a href="#payment">
                                    <li>Payment</li>
                                </a>
                                <a href="#about">
                                    <li>About</li>
                                </a>
                                <a href="../auth/logout.php">
                                    <li>Logout</li>
                                </a>

                            </ul>
                        </nav>
                    </div>

                </div>
            </div>

            <!-- DASHBOARD BODY -->
            <div class="dashboard-body">

                <!-- PACKAGE -->
                <section id="dashboard">
                    <div class="image">
                        <div class="package-details">
                            <div class="active-package">
                                <!-- <div class="leftactive"></div> -->
                                <div style="text-align: center;">
                                    <h1>Active: <?php echo htmlspecialchars($package); ?> Package</h1>
                                    <h3 style="color: white; font-size: 20px; margin-top: 5px; font-family: 'Roboto';">Expires on: <?php echo $expiry_date_formatted; ?></h3>

                                </div>
                            </div>
                        </div>

                        <!-- DASHBOARD CARDS -->

                        <div class="dashboard">

                            <div class="card">
                                <div class="circle"></div>
                                <div class="circle2"></div>
                                <div class="circle3"></div>
                                <div class="circle4"></div>
                                <span><?php echo $days_remaining; ?></span> <!-- Placeholder for Remaining Days -->
                                <p>Remaining Days</p>
                            </div>

                            <div class="card">
                                <div class="circle"></div>
                                <div class="circle2"></div>
                                <div class="circle3"></div>
                                <div class="circle4"></div>
                                <span>LKR <?php echo number_format($last_payment_amount); ?></span> <!-- Display Last Payment -->
                                <p>Last Payment</p>
                            </div>
                            <div class="card">
                                <div class="circle"></div>
                                <div class="circle2"></div>
                                <div class="circle3"></div>
                                <div class="circle4"></div>
                                <?php
                                // Calculate BMI
                                if ($height > 0) {
                                    $bmi = $weight / (($height) ** 2);
                                    $value = number_format($bmi, 2);
                                } else {
                                    $value = "N/A";
                                }

                                // Calculate BMI logic
                                $category = "Unknown";
                                $color = "#ffffff";
                                $detail = "";


                                if ($value !== "N/A") {
                                    if ($value <= 18.5) {
                                        $category = "Underweight";
                                        $color = "#f7cb08";
                                        $detail = "Possible nutritional deficiency";
                                    } elseif ($value > 18.5 && $value <= 24.9) {
                                        $category = "Normal Weight";
                                        $color = "#09c10f";
                                        $detail = "Healthy weight range";
                                    } elseif ($value > 25 && $value <= 29.9) {
                                        $category = "Overweight";
                                        $color = "#dc2626";
                                        $detail = "Increased health risk";
                                    } else {
                                        $category = "Obese";
                                        $color = "#ff0000";
                                        $detail = "High health risk";
                                    }
                                }
                                ?>

                                <span style="font-size: 30px; display: block; color: <?php echo $color; ?>;"><?php echo $category; ?></span>
                                <p>BMI</p>
                            </div>

                        </div>
                    </div>


                </section>

                <section id="payment">
                    <div class="payment">
                        <div class="topic">
                            <h1>Make Payment</h1>
                        </div>
                        <div class="content">
                            <form class="payment-form" action="" method="POST">
                                <div class="form-group">
                                    <label for="amount">Payment Amount (LKR)</label>
                                    <input type="number" id="amount" name="amount" placeholder="Enter amount" required>
                                </div>

                                <div class="form-group">
                                    <label for="card_name">Cardholder Name</label>
                                    <input type="text" id="card_name" name="card_name" placeholder="Name on card" required>
                                </div>

                                <div class="form-group">
                                    <label for="card_number">Card Number</label>
                                    <input type="text" id="card_number" name="card_number" placeholder="0000 0000 0000 0000" maxlength="19" required>
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="expiry">Expiry Date</label>
                                        <input type="text" id="expiry" name="expiry" placeholder="MM/YY" maxlength="5" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="cvc">CVC</label>
                                        <input type="text" id="cvc" name="cvc" placeholder="123" maxlength="3" required>
                                    </div>
                                </div>

                                <button type="submit" class="pay-btn">Pay Now</button>
                            </form>
                        </div>

                    </div>
                </section>



                <section id="about">
                    <div class="about">
                        <div class="topic">
                            <h1>About Me</h1>
                        </div>

                        <div class="content">
                            <div class="layout">
                                <div class="data">
                                    <p>Name: <?php echo htmlspecialchars($name); ?></p>
                                    <p>Phone: <?php echo htmlspecialchars($phone); ?></p>
                                    <p>Email: <?php echo htmlspecialchars($email); ?></p>
                                    <p>Address: <?php echo htmlspecialchars($address); ?></p>
                                    <p>Weight: <?php echo htmlspecialchars($weight); ?> kg</p>
                                </div>

                                <div class="data">
                                    <p>Height: <?php echo htmlspecialchars($height); ?> cm</p>
                                    <p>Budget: <?php echo htmlspecialchars($budget); ?></p>
                                    <p>Experience: <?php echo htmlspecialchars($experience); ?></p>
                                    <p>Medical Check: <?php echo htmlspecialchars($medical_check); ?></p>
                                    <p>Fitness Goal: <?php echo htmlspecialchars($fitness_goal); ?></p>
                                </div>

                                <div class="data">
                                    <img src="/gym-management-system/asset/images/logo.jpg" alt="" srcset="">
                                </div>
                            </div>
                        </div>



                    </div>

                </section>


            </div>

        </div>

    </div>

</body>

</html>
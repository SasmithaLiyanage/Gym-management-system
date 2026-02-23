<?php
session_start();
require "../config/db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = "Please enter both username and password.";
    } else {
        // Prepare SQL to prevent SQL injection
        $sql = "SELECT id, username, password, role FROM users WHERE username = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $username);
            
            if ($stmt->execute()) {
                $stmt->store_result();
                
                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $db_username, $db_password, $role);
                    $stmt->fetch();
                    
                    // Verify password
                    // Note: The current system stores passwords as plaintext.
                    // If you upgrade to hashing, use password_verify($password, $db_password)
                    if ($password === $db_password) {
                        // Password is correct, start a new session
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["username"] = $db_username;
                        $_SESSION["role"] = $role;
                        
                        // Redirect user based on role
                        if ($role === 'admin') {
                            header("location: ../admin/index.php");
                        } elseif ($role === 'trainer') {
                            header("location: ../trainer/index.php");
                        } else {
                            header("location: /gym-management-system/index.php");
                        }
                        exit;
                    } else {
                        $error = "The password you entered was not valid.";
                    }
                } else {
                    $error = "No account found with that username.";
                }
            } else {
                $error = "Oops! Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Atlas Fitness Center</title>
    <link rel="stylesheet" href="/gym-management-system/asset/css/login.css">
    
</head>
<body>
    <div class="main">
        <div class="login-wrapper">
            <div class="login-container">
                <div class="login-header">
                    <h2> Login</h2>
                </div>
                
                <?php if(!empty($error)): ?>
                    <div class="error-message"><?php echo $error; ?></div>
                <?php endif; ?>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>">
                    </div>    
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn-submit">LOGIN</button>
                    </div>
                    <div class="register-link">
                        Don't have an account? <a href="register.php">Register here</a>
                    </div>
                    <div class="register-link">
                        <a href="../index.php">Back to Home</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
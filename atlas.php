<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GYM USER PROFILE </title>
    <link rel="stylesheet" href="style.css">
</head>

<?php


?>

<body>
    <div class="main">
        <div class="container">
            <div class="form-box" id="login-forme">
                <form action="login-database.php" method="post">
                    <h2>Login</h2>
                    <div class="label-class">
                        <label class="label">USER NAME</label>
                        <input type="text" name="uname" id="un" placeholder="please enter username" required>
                    </div>
                    <div class="label-class">
                        <label class="label">Password</label>
                        <input type="password" name="password" id="pass" placeholder="please enter password" required>
                    </div>

                    <div class="label-class">
                        <button type="submit" name="submit"><label>Login</button>
                        <p>Don't have and account ? <a href="">Register</a></p>
                    </div>
                </form>
            </div>




        </div>
    </div>




    <!-- <div class="main">
        <div class="container2">
            <div class="form-box" id="Register-form">
                <form action="">
                    <h2>Register</h2>
                    <div class="label-class">
                        <label class="label">User Name</label>
                        <input type="text" name="uname" id="un" placeholder="please enter username" required>
                    </div>
                    <div class="label-class">
                        <label class="label">Password</label>
                        <input type="password" name="password" id="pass" placeholder="please enter password" required>
                    </div>
                    <div class="label-class">
                        <label class="label">Email</label>
                        <input type="email" name="email" id="email" placeholder="please enter Email" required>
                    </div>
                    <div class="label-class">
                        <label class="label">Select a Role</label>
                        <select name="srole" id="role" required>
                            <option value="Please select a role">Please select a role</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                            <option value="guest">Guest</option>
                        </select>
                    </div>

                    <div class="label-class">
                        <button type="submit" name="Register"><label>Register</button>
                        <p>Already have an account ? <a href="">Login</a></p>
                    </div>
                </form>
            </div>




        </div>
    </div> -->

</body>

</html>
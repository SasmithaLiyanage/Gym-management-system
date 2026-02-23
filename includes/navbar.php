<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="/gym-management-system/asset/css/stylehome.css">
</head>

<body>
    <div class="navbar">
        <div class="logo">
            <h1>Atlas Fitness Center</h1>
        </div>
        <div class="list">
            <ul>
                <a href="#hero">
                    <li>Home</li>
                </a>
                <a href="#packages">
                    <li>Packages</li>
                </a>
                <a href="#FAQ">
                    <li>FAQ</li>
                </a>
                <a href="#meetour-team">
                    <li>About us</li>
                </a>
                <a href="#findBmi">
                    <li>BMI</li>
                </a>
                <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){ ?>
                   <?php if($_SESSION["role"] == 'admin'){ ?>
                       <a href="/gym-management-system/admin/index.php"><li>Dashboard</li></a>
                   <?php } else { ?>
                       <a href="/gym-management-system/customer/index.php"><li>Dashboard</li></a>
                   <?php } ?>
                   <a href="/gym-management-system/customer/index.php"> <li id="logout"><img src="/gym-management-system/asset/images/p4.svg" alt=""></li></a>
                <?php }else{ ?>
                <a href="./auth/login.php"> <li>Login</li></a>
                <?php } ?>
            </ul>
        </div>
    </div>
</body>

</html>
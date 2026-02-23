<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Management System</title>
    <link rel="stylesheet" href="./asset/css/stylehome.css">
    <link rel="icon" type="image/png" href="/gym-management-system/asset/images/barbell.png">

</head>
<body onload="countUp()">
    <div class="main">
        <div class="container">
            <?php include "./includes/navbar.php" ?>
            <?php include "./includes/hero.php" ?>
            <?php include "./includes/dashboard.php" ?>
            <?php include "./includes/dashboard2.php" ?>
            <?php include "./includes/animated-background.php" ?>
            <?php include "./includes/pacakges-section.php" ?>
            <?php include "./includes/animated-background2.php" ?>
            <?php include "./includes/faq-section.php" ?>
            <?php include "./includes/bmi-section.php" ?>
            <?php include "./includes/service-marquee.php" ?>
            <?php include "./includes/meetour-team.php" ?>
            <?php include "./includes/about.php" ?>
            <?php include "./includes/footer.php" ?>
        </div>
    </div>
    


    <script src="/gym-management-system/asset/js/script.js"></script>
</body>
</html>
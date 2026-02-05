<?php

require "databaseconnect.php";

if (!($conn)) {
    die("Connection lost");
}

if (isset($_POST["submit"])) {

    $userName = $_POST["uname"];
    $password = $_POST["password"];;

    $sql = "INSERT INTO customer_login_table (username , password)
        VALUES ('$userName' ,'$password')";
}

if (mysqli_query($conn, $sql)) {
    echo "Data inserted successfully";
} else {
    echo "Error inserting data";
}

mysqli_close($conn);
?>
<?php
    $conn = mysqli_connect("localhost" , "root", "" , "gymdatabase");

    if (!($conn)) {
        echo "Connection fail..";
    }else{
        echo "Connection Successfuly";
    }


    

?>
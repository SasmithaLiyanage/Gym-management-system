<?php
    session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enquire Today</title>
    <link rel="stylesheet" href="style-trainer.css">
</head>

<body>

    <div class="main">
        <div class="container">
            <div class="topic_head">
                <div class="oo">
                    <h2>Trainer registration</h2>
                    <h4>"Wake up with determination. Go to bed with satisfaction"</h4>
                </div>

                <div class="back-button">
                    <a href="/gym-management-system/admin/index.php">
                        <button id="button">Back</button>
                    </a>
                </div>
            </div>

            <div class="detail">
                <div class="div2">
                    <div class="img1">
                        <img src="images/man.png" alt="User Icon" width="40px" height="40px">
                    </div>
                </div>

                <div class="div1">
                    <div class="form1">
                        <form action="\gym-management-system\admin\trainer\add_trainer.php" method="post" onsubmit="return validationform();">

                            <div class="personal-details">
                                <h2>Personal Details</h2>

                                <div class="package">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" placeholder="ex: john parker">
                                </div>

                                <div class="package">
                                    <label for="email">Email Address</label>
                                    <input type="text" name="email" id="email" placeholder="ex: username@gmail.com">
                                </div>

                                <div class="package">
                                    <label for="pnumber">Phone Number</label>
                                    <input type="text" name="pnumber" id="pnumber" placeholder="07XXXXXXXX">
                                </div>

                                <div class="package">
                                    <label for="address">Address</label>
                                    <textarea name="address" id="address"></textarea>
                                </div>
                            </div>

                            <div class="package2">
                                <label for="qualification">Qualification</label>
                                <textarea name="qualification" id="qualification"></textarea>
                            </div>

                            <div class="button_div">
                                <button id="button" type="submit">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="validation2.js"></script>
</body>

</html>
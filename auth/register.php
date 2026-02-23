<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/gym-management-system/auth/style.css">
    <script src="/gym-management-system/auth/validation.js"></script>

</head>

<body>

    <div class="main">
        <div class="container"><!--- invisible back division-->
            <div class="topic_head"><!--Top divission as topic-->
                <div class="oo">
                    <h2>Member Registration</h2>
                    <h4>"Wake up with determination. Go to bed with satisfaction"</h4>
                </div>

                <div class="back-button">
                    <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <a href="/gym-management-system/admin/index.php"><button name="back" id="button">Back</button></a>
                    <?php else: ?>
                        <a href="/gym-management-system/auth/login.php"><button name="back" id="button">Back</button></a>
                    <?php endif; ?>
                </div>
                
            </div>
            <div class="detail"><!--All detailed list-->
                <div class="div2"><!--image icon divission-->

                    <div class="img1"><img src="images/man.png" alt="" width="40px" height="40px"></div>
                    <div class="img2"><img src="images/dumbbell.png" alt="" width="40px" height="40px"></div>
                    <div class="img3"><img src="images/money.svg" alt="" width="40px" height="40px"></div>
                    <div class="img4"><img src="images/medical (1).svg" alt="" width="40px" height="40px"></div>
                    <div class="img5"><img src="images/user.svg" alt="" width="40px" height="40px"></div>
                </div>
                <div class="div1"><!--invissible back divission of form-->
                    <div class="form1">
                        <form action="\gym-management-system\admin\member\addmember.php" method="post" onsubmit="return validationform()">

                            <!-- topic -->
                            <div class="personal-details">
                                <h2>Personal Details</h2>
                                <div class="package">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" placeholder="ex: john parker">
                                </div>
                                <div class="package">
                                    <label for="email">Email Address</label></td>
                                    <input type="text" name="email" id="email" placeholder="ex: username@gmail.com">
                                </div>
                                <div class="package">
                                    <label for="number">Phone Number</label></td>
                                    <input type="number" name="pnumber" id="pnumber" placeholder="07XXXXXXXX">
                                </div>
                                <div class="package">
                                    <label for="address" placeholder="Type..">Address</label>
                                    <textarea name="address" id="address"></textarea>
                                </div>
                            </div>



                            <!-- topic -->
                            <div class="fitnes-details">
                                <div class="top">
                                    <h2>Fitness Details</h2>
                                </div>
                                <div class="bottom">
                                    <div class="package2">
                                        <label>Height</label>
                                        <input type="number" name="height" id="height_and_weight" placeholder="Height (m)" step="0.01">
                                    </div>
                                    <div class="package2">
                                        <label>Weight</label>
                                        <input type="number" name="weight" id="height_and_weight" placeholder="Weight (Kg)" step="0.01">
                                    </div>
                                    <div class="package2">
                                        <label>Fitness Goal </label>
                                        <select name="fitness_goal">
                                            <option value="muscle_gain">Muscle Gain</option>
                                            <option value="lose_weight">Lose Weight</option>
                                            <option value="endurance">Improve Endurance</option>
                                            <option value="flexibility">Improve Flexibility</option>
                                            <option value="body_shape">Improve Body Shape</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <!-- topic -->
                            <div class="budget">
                                <h2>Budget</h2>
                                <div class="package2">
                                    <label for="q1">What Is Your Frnchize Budget ? </label>
                                    <select name="budget">
                                        <option value="low">(1-10)$</option>
                                        <option value="medium">(10-20)$</option>
                                        <option value="average">(20-30)$</option>
                                        <option value="good">Upto 30$</option>

                                    </select>
                                </div>
                                <div class="package2">
                                    <label for="q2">What Is Your Experience Within The Industry ? </label>
                                    <select name="experience">
                                        <option value="no">no experience</option>
                                        <option value="low">1-3 Months</option>
                                        <option value="average">3-6 Months</option>
                                        <option value="good">above 1 year</option>
                                        <option value="perfect">upto 1year</option>

                                    </select>
                                </div>
                                <div class="package2">
                                    <label for="q2">Select you package</label>
                                    <select name="package">
                                        <option value="basic">Basic Package</option>
                                        <option value="standard">Standard Package</option>
                                        <option value="premium">Premium Package</option>
                                        <option value="elite">Elite Package</option>

                                    </select>
                                </div>
                            </div>

                            <!-- topic -->
                            <div class="medical">
                                <h2>Medical safety</h2>
                                <div class="package4">
                                    <label>Are you undergoing treatment for any chronic illness ?</label>
                                    <div class="check_box">
                                        <label class="check-container">
                                            <input type="radio" name="medical_check" value="yes">
                                            <span class="checkmark"></span>
                                            yes
                                        </label>
                                        <label class="check-container">
                                            <input type="radio" name="medical_check" value="no">
                                            <span class="checkmark"></span>
                                            no
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- topic -->
                            <div class="account">
                                <h2>Create your account</h2>
                                <div class="package">
                                    <label>User name</label>
                                    <input type="text" name="username" id="username" placeholder="ex:- User@193">
                                </div>
                                <div class="package">
                                    <label>password</label>
                                    <input type="password" name="password" id="password" placeholder="Your password at least 8 charactors">
                                </div>

                                <div class="button_div">
                                    <button name="save" id="button">SUBMIT ENQUIRY</button>
                                </div>



                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>


</body>

</html>
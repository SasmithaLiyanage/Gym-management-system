<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/gym-management-system/asset/css/stylehome.css">
</head>
<body>
        <section id="packages">
          <div class="packages-section">
            <div class="package-card">
              <div class="card-head">
                <h1>Basic Package</h1>
                <p>Ideal for newcomers starting their fitness journey.</p>
              </div>
              <div class="card-detail">
                <ul>
                  <li>
                    <img
                      src="/gym-management-system/asset/images/svgs/ok-circle-filled-svgrepo-com (1).svg"
                    />Access to gym equipment
                  </li>
                  <li>
                    <img
                      src="/gym-management-system/asset/images/svgs/ok-circle-filled-svgrepo-com (1).svg"
                    />Cardio & strength training areas
                  </li>
                  <li>
                    <img
                      src="/gym-management-system/asset/images/svgs/ok-circle-filled-svgrepo-com (1).svg"
                    />Locker & shower facilities
                  </li>
                  <li>
                    <img
                      src="/gym-management-system/asset/images/svgs/ok-circle-filled-svgrepo-com (1).svg"
                    />Free fitness consultation
                  </li>
                  <li>
                    <img
                      src="/gym-management-system/asset/images/svgs/ok-circle-filled-svgrepo-com (1).svg"
                    />Flexible workout hours
                  </li>
                </ul>
              </div>
              <div class="card-button">
                  <?php 
                 if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){ ?>
                    <a href="/gym-management-system/customer/index.php/#payment"> <button> 5$ - Buy NOW</button></a>
                  <?php }else{ ?>    
                    <a href="/gym-management-system/auth/login.php"> <button> 5$ - Buy NOW</button></a>
                  <?php }; ?>
                  
                
              </div>
            </div>
            <div class="package-card">
              <div class="card-head">
                <h1>Standard Package</h1>
                <p>Perfect for consistent gym users.</p>
              </div>
              <div class="card-detail">
                <ul>
                  <li>
                    <img
                      src="/gym-management-system/asset/images/svgs/ok-circle-filled-svgrepo-com (1).svg"
                    />Full gym access
                  </li>
                  <li>
                    <img
                      src="/gym-management-system/asset/images/svgs/ok-circle-filled-svgrepo-com (1).svg"
                    />Group fitness classes (Zumba, Yoga, HIIT)
                  </li>
                  <li>
                    <img
                      src="/gym-management-system/asset/images/svgs/ok-circle-filled-svgrepo-com (1).svg"
                    />Basic meal plan guidance
                  </li>
                  <li>
                    <img
                      src="/gym-management-system/asset/images/svgs/ok-circle-filled-svgrepo-com (1).svg"
                    />Monthly fitness assessment
                  </li>
                  <li>
                    <img
                      src="/gym-management-system/asset/images/svgs/ok-circle-filled-svgrepo-com (1).svg"
                    />Trainer support during workouts
                  </li>
                </ul>
              </div>
              <div class="card-button">
                   <?php 
                 if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){ ?>
                    <a href="/gym-management-system/customer/index.php/#payment"> <button> 10$ - Buy NOW</button></a>
                  <?php }else{ ?>    
                    <a href="/gym-management-system/auth/login.php"> <button> 10$ - Buy NOW</button></a>
                  <?php }; ?>
              </div>
            </div>
            <div class="package-card">
              <div class="card-head">
                <h1>Premium Package</h1>
                <p>
                  Designed for serious fitness and body transformation goals.
                </p>
              </div>
              <div class="card-detail">
                <ul>
                  <li>
                    <img
                      src="/gym-management-system/asset/images/svgs/ok-circle-filled-svgrepo-com (1).svg"
                    />All Standard Package benefits
                  </li>
                  <li>
                    <img
                      src="/gym-management-system/asset/images/svgs/ok-circle-filled-svgrepo-com (1).svg"
                    />Personal trainer sessions
                  </li>
                  <li>
                    <img
                      src="/gym-management-system/asset/images/svgs/ok-circle-filled-svgrepo-com (1).svg"
                    />Customized workout & meal plans
                  </li>
                  <li>
                    <img
                      src="/gym-management-system/asset/images/svgs/ok-circle-filled-svgrepo-com (1).svg"
                    />Supplement guidance
                  </li>
                  <li>
                    <img
                      src="/gym-management-system/asset/images/svgs/ok-circle-filled-svgrepo-com (1).svg"
                    />Priority class booking
                  </li>
                </ul>
              </div>
              <div class="card-button">
                  <?php 
                 if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){ ?>
                    <a href="/gym-management-system/customer/index.php/#payment"> <button> 15$ - Buy NOW</button></a>
                  <?php }else{ ?>    
                    <a href="/gym-management-system/auth/login.php"> <button> 15$ - Buy NOW</button></a>
                  <?php }; ?>
              </div>
            </div>
            <div class="package-card">
              <div class="card-head">
                <h1>Elite Package</h1>
                <p>Best for athletes and high-performance training.</p>
              </div>
              <div class="card-detail">
                <ul>
                  <li>
                    <img
                      src="/gym-management-system/asset/images/svgs/ok-circle-filled-svgrepo-com (1).svg"
                    />Unlimited gym & class access
                  </li>
                  <li>
                    <img
                      src="/gym-management-system/asset/images/svgs/ok-circle-filled-svgrepo-com (1).svg"
                    />Dedicated personal trainer
                  </li>
                  <li>
                    <img
                      src="/gym-management-system/asset/images/svgs/ok-circle-filled-svgrepo-com (1).svg"
                    />Advanced nutrition & supplement plan
                  </li>
                  <li>
                    <img
                      src="/gym-management-system/asset/images/svgs/ok-circle-filled-svgrepo-com (1).svg"
                    />Body composition analysis
                  </li>
                  <li>
                    <img
                      src="/gym-management-system/asset/images/svgs/ok-circle-filled-svgrepo-com (1).svg"
                    />Free gym merchandise
                  </li>
                </ul>
              </div>
              <div class="card-button">
                  <?php 
                 if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){ ?>
                    <a href="/gym-management-system/customer/index.php/#payment"> <button> 10$ - Buy NOW</button></a>
                  <?php }else{ ?>    
                    <a href="/gym-management-system/auth/login.php"> <button> 20$ - Buy NOW</button></a>
                  <?php }; ?>
              </div>
            </div>
          </div>
        </section>
</body>
</html>
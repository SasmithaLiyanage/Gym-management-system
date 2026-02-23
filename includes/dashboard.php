
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="/demo/gym-management-system/asset/css/stylehome.css">
</head>

<body>

  <div class="dashboard">
    <!-- dashboad card componetnts -->
    <div class="card">
      <div class="card-left">
        <i class="fa-solid fa-person"></i>
        <span id="number"><?php echo ($result); ?></span>

        <div class="circle"></div>
        <div class="circle2"></div>
        <div class="circle3"></div>
        <div class="circle4"></div>
      </div>
      <div class="card-right">
        <h1>Membership Status</h1>
        <br />
        <span id="client"> </span>
      </div>
    </div>

    <!-- dashboad card componetnts -->
    <div class="card">
      <div class="card-left">
        <i class="fa-solid fa-person"></i>
        <span id="Membership"> Perfect</span>
      </div>
      <div class="card-right">
        <h1>Workout & Attendance</h1>
        <br />
        <span id="client"> </span>
      </div>
      <div class="circle"></div>
      <div class="circle2"></div>
      <div class="circle3"></div>
      <div class="circle4"></div>
    </div>

    <!-- dashboad card componetnts -->
    <div class="card">
      <div class="card-left">
        <i class="fa-solid fa-person"></i>
        <span id="number2"> 0</span>
      </div>
      <div class="card-right">
        <h1>Classes & Training</h1>
        <br />
        <span id="client"> </span>
      </div>
      <div class="circle"></div>
      <div class="circle2"></div>
      <div class="circle3"></div>
      <div class="circle4"></div>
    </div>

    <!-- dashboad card componetnts -->
    <div class="card">
      <div class="card-left">
        <i class="fa-solid fa-person"></i>
        <span id="Membership"> Average</span>
      </div>
      <div class="card-right">
        <h1>Health & Progress</h1>
        <br />
        <span id="client"> </span>
      </div>
      <div class="circle"></div>
      <div class="circle2"></div>
      <div class="circle3"></div>
      <div class="circle4"></div>
    </div>
  </div>
</body>
<script src="/demo/Gym-management-system/asset/js/script.js"></script>

</html>
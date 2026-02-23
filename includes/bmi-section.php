<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/gym-management-system/asset/css/stylehome.css">
</head>
<body>
        <section id="findBmi">
          <div class="bmi-section">
            <div class="bmi-detail">
              <h1>BMI?</h1>
              <p>
                Body Mass Index (BMI) is a widely used health indicator that
                estimates whether a person has a healthy body weight in relation
                to their height. It provides a quick and simple method to
                categorize body weight status and identify potential health
                risks related to being underweight or overweight. BMI is
                commonly used by gyms, fitness trainers, and healthcare
                professionals as an initial screening tool for body composition
                assessment.
              </p>
            </div>
            <div class="bmi-input">
              <label for="weight">Weight(Kg)</label>
              <input type="number" name="weight" id="weight" />
              <label for="height">Height(m) </label>
              <input type="number" name="height" id="height" />
              <button onclick="calculate()">Calculate</button>
            </div>
            <div class="bmi-output">
              <h1 id="Display">Your BMI?</h1>
              <p id="display-detail"></p>
            </div>
          </div>
        </section>
        
        <script src="/gym-management-system/asset/js/bmi.js"></script>
</body>
</html>
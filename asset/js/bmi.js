const weight = document.getElementById("weight");
const height = document.getElementById("height");
const display = document.getElementById("Display");
const displaydetail = document.getElementById("display-detail");


function calculate() {
  let color;
  let catageory;
  let detail;

  let bmi_weight = weight.value;
  let bmi_height = height.value ** 2;

  let bmi = bmi_weight / bmi_height;

  bmi = Math.floor(bmi, 2);

  if (bmi <= 18.5) {
    catageory = "Underweight";
    color = "#f7cb08";
    detail = "Possible nutritional deficiency"
  } else if (bmi > 18.5 && bmi <= 24.9) {
    catageory = "Normal Weight";
    color = "#09c10f";
    detail = "Healthy weight range"
  } else if (bmi > 25 && bmi <= 29.9) {
    catageory = "Overweight";
    color = "#dc2626";
    detail = "Increased health risk"
  } else {
    catageory = "Obese";
    color = "#ff0000";
    detail = "High health risk" 
  }

  display.innerHTML = catageory;
  display.style.color = color;
  displaydetail.style.color=color;
  displaydetail.innerHTML = detail;

}


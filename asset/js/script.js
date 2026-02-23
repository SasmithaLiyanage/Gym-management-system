
function countUp(id, target, duration) {
  let element = document.getElementById(id);
  let start = 0;
  let increment = target / (duration / 16);

  function update() {
    start += increment;
    if (start < target) {
      element.innerText = Math.floor(start);
      requestAnimationFrame(update);
    } else {
      element.innerText = target;
    }
  }

  update();
}

countUp("number", 15, 2000);
countUp("number2", 5, 2000);

const icon = document.getElementById("icon");


function faq(faqcard) {
  const isactive = faqcard.classList.contains("active");
  icon.style.rotate = "90deg";

  document.querySelectorAll(".faqcard").forEach((faqcard) => {
    faqcard.classList.remove("active");
    icon.style.rotate = "-90deg";
  });

  if (!isactive) {
    faqcard.classList.add("active");
  }
}

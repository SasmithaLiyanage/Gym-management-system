function validationform() {
   
    let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();
    let phone = document.getElementById("pnumber").value.trim();
    let address = document.getElementById("address").value.trim();
    let trainerid = document.getElementById("trainerid").value.trim();
    let qualification = document.getElementById("qualification").value.trim();

    // Name validation
    if (name === "") {
        alert("Name is required!");
        return false;
    }

    if (name.length < 3) {
        alert("Please check your name!");
        return false;
    }

    let namePattern = /^[A-Za-z\s]+$/;
    if (!namePattern.test(name)) {
        alert("Name must contain only letters");
        return false;
    }

    // Email validation
    let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if (!email.match(emailPattern)) {
        alert("Enter valid email address!");
        return false;
    }

    // Phone validation (Sri Lanka format 07XXXXXXXX)
    let phonePattern = /^07[0-9]{8}$/;
    if (!phone.match(phonePattern)) {
        alert("Enter valid phone number (07XXXXXXXX)");
        return false;
    }

    // Trainer ID validation (numbers only)
    let traineridPattern = /^[0-9]+$/;
    if (!traineridPattern.test(trainerid)) {
        alert("Trainer ID must contain only numbers!");
        return false;
    }

    if(trainerid ===""){
        alert("Trainer Id required!")
    }

    // Address validation
    if (address === "") {
        alert("Address is required!");
        return false;
    }

    // Qualification validation
    if (qualification === "") {
        alert("Qualification is required!");
        return false;
    }

    return true;


}


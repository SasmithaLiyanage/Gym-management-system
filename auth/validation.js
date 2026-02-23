
function validationform() {

    let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();
    let phone = document.getElementById("pnumber").value.trim();
    let address = document.getElementById("address").value.trim();
    let username = document.getElementById("username").value.trim();
    let password = document.getElementById("password").value.trim();
    let height = document.querySelector("input[name='height']").value;
    let weight = document.querySelector("input[name='weight']").value;
    let medical = document.querySelector("input[name='medical_check']:checked");

    // Name validation
    let namepattern = /^[A-Za-z\s]+$/;
    if (!namepattern.test(name)) {
        alert("Only letters are allowed!");
        return false;
    }

    if (name === "") {
        alert("Name is required!");
        return false;
    }

    if (name.length < 3) {
        alert("Please check your name!");
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
        alert("Enter valid 10 digit phone number (07XXXXXXXX)");

        return false;
    }

    // Address validation
    if (address === "") {
        alert("Address is required!");
        return false;
    }

    // Height & Weight validation
    if (height <= 0 || weight <= 0) {
        alert("Height and Weight must be positive numbers!");
        return false;
    }

    // Medical radio validation
    if (!medical) {
        alert("Please select medical condition option!");
        return false;
    }

    // Username validation
    if (username === "") {
        alert("Username is required!");
        return false;
    }

    if (username.length < 3) {
        alert("Enter proper username (Minimum 3 charactors)!")
    }

    // Password validation
    if (password.length < 8) {
        alert("Password must be at least 8 characters!");
        return false;
    }

    let passwordpattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*?&]).{8,}$/;
    if (!password.match(passwordpattern)) {
        alert("Password should be contain At least 1 lowercase letter, uppercase letter, special character(@$! %*?&)");
        return false;

    }

    return true;

}


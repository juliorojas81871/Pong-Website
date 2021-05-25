const mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
//  EMAIL VALIDATIONS
function validateEmail(email) {
    if (email == "") {
        document.getElementsByClassName("emailAlert")[0].innerHTML =
            "**email cannot be empty";
        setTimeout(function() {
            document.getElementsByClassName("emailAlert")[0].innerHTML = "";
        }, 3000);
        return false;
    }
    if (!email.match(mailformat)) {
        document.getElementsByClassName("emailAlert")[0].innerHTML =
            "**invalid email adress";
        setTimeout(function() {
            document.getElementsByClassName("emailAlert")[0].innerHTML = "";
        }, 3000);
        return false;
    }
    return true;
}

//  PASSWORD VALIDATION
function validatePassword(password) {
    if (password == "") {
        document.getElementsByClassName("passwordAlert")[0].innerHTML =
            "**password cannot be empty";
        setTimeout(function() {
            document.getElementsByClassName("passwordAlert")[0].innerHTML = "";
        }, 3000);
        return false;
    }
    if (password.length < 8) {
        document.getElementsByClassName("passwordAlert")[0].innerHTML =
            "**password length must be atleast 8 characters";
        setTimeout(function() {
            document.getElementsByClassName("passwordAlert")[0].innerHTML = "";
        }, 3000);
        return false;
    }
    return true;
}

// PASSWORDS MATCH VALIDATION
function passwordsMatch(password, cpassword) {
    if (password != cpassword) {
        document.getElementsByClassName("cpasswordAlert")[0].innerHTML =
            "**passwords are not matching";
        setTimeout(function() {
            document.getElementsByClassName("cpasswordAlert")[0].innerHTML = "";
        }, 3000);
        return false;
    }
    return true;
}

// USERNAME VALIDATION
function validateUsername(username) {
    // FIRST NAME VALIDATIONS
    if (username == "") {
        document.getElementsByClassName("usernameAlert")[0].innerHTML =
            "**Username cannot be empty";
        setTimeout(function() {
            document.getElementsByClassName("usernameAlert")[0].innerHTML = "";
        }, 3000);
        return false;
    }
    if (username.length <= 3 || username.length >= 15) {
        document.getElementsByClassName("usernameAlert")[0].innerHTML =
            "**characters length must be between 3 and 15";
        setTimeout(function() {
            document.getElementsByClassName("usernameAlert")[0].innerHTML = "";
        }, 3000);
        return false;
    }
    return true;
}

// USER ID VALIDATION
function validateUserID(userID) {
    if (userID == "") {
        document.getElementsByClassName("userIDAlert")[0].innerHTML =
            "**UserID cannot be empty";
        setTimeout(function() {
            document.getElementsByClassName("userIDAlert")[0].innerHTML = "";
        }, 3000);
        return false;
    } else if (userID.match(mailformat)) {
        if (validateEmail(userID)) {
            return true;
        }
        return false;
    } else {
        if (validateUsername(userID)) {
            return true;
        }
        return false;
    }
    return true;
}
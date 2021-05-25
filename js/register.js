$("#registerSubmit").click(function(event) {
    event.preventDefault();
    var username = $("#username").val();
    var email = $("#registerEmail").val();
    var password = $("#registerPassword").val();
    var cpassword = $("#registerCPassword").val();
    var profile_status = $("input[name='public']:checked").val();
    // console.log(validatePassword(password));
    if (validateEmail(email) && validateUsername(username) && validatePassword(password) && passwordsMatch(password, cpassword)) {
        $("#registerSubmit").prop("disabled", true);
        var fd = new FormData();
        fd.append("username", username);
        fd.append("email", email);
        fd.append("password", password);
        fd.append("cpassword", cpassword);
        fd.append("profile_status", profile_status);
        // console.log(fd);
        $.ajax({
            url: "../apis/register.php",
            data: fd,
            type: "POST",
            contentType: false,
            processData: false,
            success: function(response) {
                // console.log(response);
                var res = JSON.parse(response);
                if (res.status == "success") {
                    $("#registerSubmit").prop("disabled", true);
                    swal("Successfully Added", "", "success").then((value) => {
                        window.location = "./login.php";
                    });
                } else {
                    $("#registerSubmit").prop("disabled", false);
                    swal(res.message, "", "error");
                }
            },
        });
        return false;
    }
    $("#registerSubmit").prop("disabled", false);
    return false;
});
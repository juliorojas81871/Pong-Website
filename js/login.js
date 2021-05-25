$(document).ready(function() {
    $("#loginSubmit").click(function(event) {
    event.preventDefault();
        var userID = $("#userID").val();
        var loginPassword = $("#loginPassword").val();
        if (validateUserID(userID) && validatePassword(loginPassword)) {
            $("#loginSubmit").prop("disabled", true);
            var fd = new FormData();
            fd.append("userID", userID);
            fd.append("loginPassword", loginPassword);
            console.log(fd);
            $.ajax({
                url: "../apis/login.php",
                data: fd,
                type: "POST",
                contentType: false,
                processData: false,
                success: function(response) {
                    // console.log((response));
                    var res = JSON.parse(response);
                    if (res.status == "success") {
                        $("#loginSubmit").prop("disabled", true);
                        swal("Login Successfull!", "", "success").then((value) => {
                            window.location = "./profile.php";
                        });
                    } else {
                        $("#loginSubmit").prop("disabled", false);
                        swal(res.message, "", "error");
                    }
                },
            });
            return false;
        }
        $("#loginSubmit").prop("disabled", false);
        return false;
    });
    return false;
});
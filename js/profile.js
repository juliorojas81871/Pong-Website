$(document).ready(function() {
    fetch_complete_details();
});

function fetch_complete_details() {
    $.ajax({
        url: "../apis/fetch_profile.php",
        type: "GET",
        success: function(response) {
            var response = JSON.parse(response);
            //console.log(response.result)
            if (response.status == "success") {
                var public = response.result.profile_data["public"];
                // console.log(display);
                $("#profile_name").html(response.result.profile_data["username"]);
                $("#profile_role").html(parseInt(response.result.profile_data["admin"])?"Admin":"Player");
                $("#profile_status").html(parseInt(public) ? "Public" : "Private");
                $("#profile_email").html(response.result.profile_data["email"]);
                $("#profile_level").html(response.result.profile_data["level"]);
                $("#profile_name_modal").val(response.result.profile_data["username"]);
                if (public == 1) {
                    $("#private").hide();
                    $("#private_label").hide();
                    $("#public").hide();
                    $("#public_label").show();
                    $("#public").prop("checked", true);
                } else {
                    $("#public").hide();
                    $("#public_label").hide();
                    $("#private").hide();
                    $("#private_label").show();
                    $("#private").prop("checked", true);
                }
                $("#profile_email_modal").val(response.result.profile_data["email"]);
            }
        },
    });
}

//=============Update Profile===============
$("#submitBtn").click(function() {
    var uname = $("#profile_name_modal").val();
    var status = $("input[name='public']:checked").val();
    var email = $("#profile_email_modal").val();
    var action = "updateProfile";

    var datastring =
        "&username=" +
        uname +
        "&email=" +
        email +
        "&status=" +
        status +
        "&action=" +
        action;
    // console.log(datastring);
    $.ajax({
        url: "../apis/update_profile.php",
        type: "POST",
        data: datastring,
        success: function(response) {
            var response = JSON.parse(response);
            if (response.status == "success") {
                swal(
                    "PROFILE UPDATED",
                    "Your details have been changed successfully",
                    "success"
                ).then((value) => {
                    fetch_complete_details();
                });
            } else {
                swal("UPDATE FAILED", response.message, "error").then((value) => {
                    edit(true);
                });
            }
        },
    });
});

$("#resetBtn").click(function() {
    fetch_complete_details();
});

/*****************************PASSWORD UPDATE REQUEST******************************/
$("#submitPass").click(function() {
    var cpass = $("#CurrentPass").val();
    var npass = $("#NewPass").val();
    var ppass = $("#ConfirmPass").val();
    var action = "updatePass";
    // console.log(cpass);
    var fd =
        "&cpass=" +
        cpass +
        "&npass=" +
        npass +
        "&ppass=" +
        ppass +
        "&action=" +
        action;
    $.ajax({
        url: "../apis/update_profile.php",
        type: "POST",
        data: fd,
        success: function(response) {
            var response = JSON.parse(response);
            if (response.status == "success") {
                // console.log(response.result);
                swal(
                    "PASSWORD UPDATED",
                    "Your password has been changed successfully",
                    "success"
                ).then((value) => {
                    $("#closePass").click();
                });
            } else {
                // console.log(response.result);
                swal("UPDATE FAILED", response.message, "error");
            }
        },
    });
});

/*******FETCH USER SCORES *********/
$(document).ready(function() {
    load_data("1");

    function load_data(page) {
        $.ajax({
            url: "../apis/personal_scores.php",
            type: "POST",
            data: { page: page },
            success: function(data) {
                $("#pagination_data").html(data);
            },
        });
    }
    $(document).on("click", ".pg1", function() {
        var page = $(this).attr("id");
        load_data(page);
    });
});
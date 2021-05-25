<?php
// include('../apis/db.php');
session_start();
if ($_SESSION["logged_in"] != 1)
 	{ 
        header("location:login.php");
 	}  
    
    //  // fetch user name and game status
    // $email = $_SESSION['email'];
    // $query = mysqli_query($con,"SELECT * from users where email='$email'");
    // if($query){
    //     $query_data = mysqli_fetch_array($query);
    //  	$level = $query_data['level'];
    //  	$username=$query_data['username'];
    //     $role = $query_data['role'];
    //     $profile_status = $query_data['public']?"Public":"Private";
    //     //  echo $user_level_status.' '.$username;
    // }
    // else
    // {
    //     echo 'user not found';
    // }
?>

<!DOCTYPE html>
<html>

<head>

    <title>
        Profile | IT
    </title>

    <meta content="width=device-width, initial-scale=.0" name="viewport">
    <!-- Bootstrap CSS File -->
    <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="../lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../lib/sweetalert/sweetalert.min.css" rel="stylesheet">
    <!-- Custom css -->
    <link href="../css/styles.css" rel="stylesheet">
</head>

<body>

    <?php include 'nav.php'; ?>
    <!-- <div class="username"></div> -->
    <div class="row">
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
            <div id="profile-section-overview" class="container-fluid text-white bg-dark"
                style="margin: 5px; padding: 10px; box-shadow: 0 10px 10px 0 rgba(0, 0, 0, 0.2);">
                Name: <div id="profile_name"><?php //echo $username; ?></div>
                <br> Role: <div id="profile_role"><?php //echo $role; ?></div>
                <br> Profile Status: <div id="profile_status"><?php //echo $profile_status?"Public":"Private"; ?></div>
                <br> Email: <div id="profile_email"><?php //echo $email; ?></div>
                <br>Level: <div id="profile_level"><?php //echo $level; ?></div>
            </div>
        </div>

    </div>
    <div id="pagination_data" class="ml-5"></div>
    <div id="user-profile" class="container-fluid">
        <form>
            <div class="input-group input-group-lg profile-form">
                <span class="input-group-addon profile-form">Name: </span>
                <input type="text" class="form-control profile-form" id="profile_name_modal" value="" disabled />
            </div>
            <div class="input-group input-group-lg profile-form">
                <span class="input-group-addon profile-form">Email ID: </span>
                <input type="email" class="form-control profile-form" value="" id="profile_email_modal" disabled />
            </div>
            <div class="input-group input-group-lg profile-form">
                <div class="input-group-addon profile-form row">
                    <span class="col-form-label">Profile Status: </span>
                    <div class="form-check">
                        <input class="form-control profile-form" type="radio" name="public" id="public" value="Public"
                            disabled>
                        <label class="form-check-label" for="public1" id="public_label">
                            Public
                        </label>
                    </div>
                    <div class="form-check ml-2">
                        <input class="form-control profile-form" type="radio" name="public" id="private" value="Private"
                            disabled>
                        <label class="form-check-label" for="public2" id="private_label">
                            Private
                        </label>
                    </div>
                </div>
            </div>
            <div class="btn-group profile-form" role="group">
                <button id="editBtn" type="button" class="btn btn-default" onclick="edit(true);">
                    Edit Profile
                </button>
                <button id="resetBtn" type="reset" class="btn btn-warning" style="display: none;"
                    onclick="edit(false);">
                    Reset
                </button>
                <button id="submitBtn" type="button" class="btn btn-success" style="display: none;"
                    onclick="edit(false); //updateDetails();">
                    Submit
                </button>
                <button id="passwdBtn" type="button" class="btn btn-default" data-toggle="modal"
                    data-target="#modal-change-password">
                    Change Password
                </button>
            </div>
        </form>
    </div>
    <div class="modal fade" id="modal-change-password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog bg-dark" role="document">
            <div class="modal-content bg-dark">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title" id="modal-inventory-title">Change Password</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white;">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-dark">
                    <form>
                        <div class="input-group input-group-lg inventory-form">
                            <span class="input-group-addon inventory-form">Current Password</span>
                            <input type="password" class="form-control inventory-form" id="CurrentPass" />
                        </div>
                        <div class="input-group input-group-lg inventory-form">
                            <span class="input-group-addon inventory-form">New Password</span>
                            <input type="password" class="form-control inventory-form" id="NewPass" />
                        </div>
                        <div class="input-group input-group-lg inventory-form">
                            <span class="input-group-addon inventory-form">Confirm New Password</span>
                            <input type="password" class="form-control inventory-form" id="ConfirmPass" />
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-default" id="closePass" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="submitPass">Change</button>
                </div>
            </div>
        </div>
    </div>
    <script>
    function edit(flag) {
        if (flag) {
            $("input.profile-form").prop("disabled", false);
            $("#profilePicBtn").hide();
            $("#passwdBtn").hide();
            $("#editBtn").hide();
            $("#resetBtn").show();
            $("#submitBtn").show();
            $("#private").show();
            $("#private_label").show();
            $("#public").show();
            $("#public_label").show();
        } else {
            $("input.profile-form").prop("disabled", true);
            $("#profilePicBtn").show();
            $("#passwdBtn").show();
            $("#editBtn").show();
            $("#resetBtn").hide();
            $("#submitBtn").hide();
        }
    }
    </script>
    <script src=" ../lib/jquery/jquery.min.js">
    </script>
    <script src="../lib/jquery/jquery-migrate.min.js"></script>
    <script src="../lib/jquery/jquery.js"></script>
    <script src="../lib/popper/popper.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script> -->
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="../lib/sweetalert/sweetalert.min.js"></script>
    <script src="../js/check_login.js"></script>
    <script src="../js/logout.js"></script>

    <script src="../js/profile.js"></script>
</body>

</html>
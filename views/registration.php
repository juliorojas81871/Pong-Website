<?php
session_start();
?>

<!DOCTYPE html>
<html>

<!DOCTYPE html>
<html>

<head>

    <title>
        Register | IT
    </title>

    <meta content="width=device-width, initial-scale=.0" name="viewport">
    <!-- Bootstrap CSS File -->
    <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="../lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../lib/sweetalert/sweetalert.min.css" rel="stylesheet">
    <!-- Custom css -->
    <link href="../css/styles.css" rel="stylesheet">

<body>

    <?php include 'nav.php'; ?>
    <!--/ Nav End /-->
    <div class="box">
        <h2>Register</h2>
        <br>
        <form class="pl-5">
            <div class="form-group">
                <label for="registerEmail">Email address</label>
                <input type="email" class="form-control" id="registerEmail" placeholder="Enter email">
                <span class="text-danger font-weight-bold emailAlert">
                    <!-- alerts innerHTML goes here -->
                </span>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Enter username">
                <span class="text-danger font-weight-bold usernameAlert">
                    <!-- alerts innerHTML goes here -->
                </span>
            </div>
            <div class="form-group">
                <label for="registerPassword">Password</label>
                <input type="password" class="form-control" id="registerPassword" placeholder="Password">
                <span class="text-danger font-weight-bold passwordAlert">
                    <!-- alerts innerHTML goes here -->
                </span>
            </div>
            <div class="form-group">
                <label for="registerCPassword">Password</label>
                <input type="password" class="form-control" id="registerCPassword" placeholder="Confirm Password">
                <span class="text-danger font-weight-bold cpasswordAlert">
                    <!-- alerts innerHTML goes here -->
                </span>
            </div>
            <div class="form-group ml-3">
                <div class="row">
                    <legend class="col-form-label">Profile Status</legend>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="public" id="public" value="Public" checked>
                        <label class="form-check-label" for="public1">
                            Public
                        </label>
                    </div>
                    <div class="form-check ml-2">
                        <input class="form-check-input" type="radio" name="public" id="private" value="Private">
                        <label class="form-check-label" for="public2">
                            Private
                        </label>
                    </div>
                </div>
            </div>
            <p>Have an account? <a href="login.php">Login here!</p></a>
            <button type="submit" id="registerSubmit" class="btn btn-primary">Register</button>
        </form>
    </div>

    <script src="../lib/jquery/jquery.min.js"></script>
    <script src="../lib/jquery/jquery-migrate.min.js"></script>
    <script src="../lib/jquery/jquery.js"></script>
    <script src="../lib/popper/popper.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script> -->
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="../lib/sweetalert/sweetalert.min.js"></script>
    <script src="../js/validate.js"></script>
    <script src="../js/register.js"></script>

</body>

</html>
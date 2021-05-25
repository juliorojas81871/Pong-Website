<?php
session_start();
?>

<!DOCTYPE html>
<html>

<!DOCTYPE html>
<html>

<head>

    <title>
        Login | IT
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
        <h2>Login</h2>
        <br>
        <form class="pl-5">
            <div class="form-group">
                <label for="userID">User ID</label>
                <input type="text" class="form-control" id="userID" placeholder="Username or email">
                <span class="text-danger font-weight-bold usernameAlert emailAlert userIDAlert">
                    <!-- alerts innerHTML goes here -->
                </span>
            </div>
            <div class="form-group">
                <label for="loginPassword">Password</label>
                <input type="password" class="form-control" id="loginPassword" placeholder="Password">
                <span class="text-danger font-weight-bold passwordAlert">
                    <!-- alerts innerHTML goes here -->
                </span>
            </div>
            <p>Don't have an account? <a href="registration.php">Register now!!</p></a>
            <button type="submit" id="loginSubmit" class="btn btn-primary">Login</button>
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
    <script src="../js/login.js"></script>
</body>

</html>
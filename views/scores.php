<?php
session_start();
?>


<!DOCTYPE html>
<html>

<head>

    <title>
        Scores | IT
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
        <h2>Scores</h2>
        <div id="scoresTable" class="ml-5">
        </div>
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
        <script src="../js/scores.js"></script>
        <script>
        $.ajax({
            url: '../apis/check_admin.php',
            type: "POST",
            success: function(response) {
                if (response == "failure") {
                    // console.log(response.result);
                    window.location = "login.php";

                }
            },
        });
        </script>
</body>

</html>
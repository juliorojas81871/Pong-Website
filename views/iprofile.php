<?php
include '../apis/db.php';
$url = basename($_SERVER['REQUEST_URI']);
$url_components = parse_url($url);
parse_str($url_components['query'], $params);
$username = $params['username'];
$query = mysqli_query($con, "SELECT * FROM users WHERE username ='".$username."'");

			if (mysqli_num_rows($query) == 0) 
			{
				echo 'user ID not found';
			}

			else
			{
				$profile_data = mysqli_fetch_array($query,MYSQLI_ASSOC);
                $roletype = $profile_data['admin'];
                if ($roletype == 1)
                {
                  $role = 'Admin';
                }
                else
                {
                  $role = 'Player';
                }
                $profile_status = $profile_data['public'];
                $email = 'Email is hidden due to project requirements';
                $level = $profile_data['level'];
			}
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
                Name: <div id="profile_name"><?php echo $username; ?></div>
                <br> Role: <div id="profile_role"><?php echo $role; ?></div>
                <br> Profile Status: <div id="profile_status"><?php echo $profile_status?"Public":"Private"; ?></div>
                <br> Email: <div id="profile_email"><?php echo $email; ?></div>
                <br>Level: <div id="profile_level"><?php echo $level; ?></div>
            </div>
        </div>

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
    <script src="../js/logout.js"></script>
</body>

</html>
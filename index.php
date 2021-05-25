<?php
session_start(); 
include 'apis/db.php';
//top 10
function printTable($query_result) {
    $rank = 0;
    if(mysqli_num_rows($query_result)!=0){echo '<table class="ml-5"><tr>
        <th>Rank</th>
        <th>Username</th>
        <th>Points</th>
        <th>Level</th>
        </tr>';
              while($row = mysqli_fetch_array($query_result))
              {
                  $level = $row["level"];
                  $points = $row["score"];
                  $username =  $row["username"];
                  $email = $row["email"];
                  $rank = $rank+1;
                  echo '<tr><td>'.$rank.'</td><td>';
                  if($row["public"]==1)
                  {
                      echo '<a href="views/iprofile.php?username='.$username.'">';
                  }
                  else
                  {
                      echo '<a href="views/private.php">';
                  }
                  echo $username.'</a></td><td>'.$points.'</td><td>'.$level.'</td></tr>';

              }
              echo '</table>';
            }
            else{
                echo 'No results to be displayed';
            }
}
$week_query="SELECT * FROM `users` INNER JOIN `scores` ON users.id= scores.user_id WHERE scores.time > DATE_SUB(CURDATE(), INTERVAL 1 WEEK) ORDER BY  scores.score DESC, scores.level DESC, scores.time ASC LIMIT 10";
$week_result = mysqli_query($con, $week_query);  
$month_query="SELECT * FROM `users` INNER JOIN `scores`  ON users.id= scores.user_id WHERE scores.time > DATE_SUB(CURDATE(), INTERVAL 1 MONTH) ORDER BY  scores.score DESC, scores.level DESC, scores.time ASC LIMIT 10";
$month_result = mysqli_query($con, $month_query); 
$query="SELECT * FROM `users` INNER JOIN `scores`  ON users.id= scores.user_id  ORDER BY  scores.score DESC, scores.level DESC, scores.time ASC LIMIT 10";
$result = mysqli_query($con, $query); 
?>
<!DOCTYPE html>
<html>

<head>

    <title>
        Home | IT
    </title>

    <meta content="width=device-width, initial-scale=.0" name="viewport">
    <!-- Bootstrap CSS File -->
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="lib/sweetalert/sweetalert.min.css" rel="stylesheet">
    <!-- Custom css -->
    <link href="css/styles.css" rel="stylesheet">

<body>
    <!--/ Nav Star /-->
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
        <a class="navbar-brand" href="../index.php">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <?php 
              if(isset($_SESSION['logged_in']) && isset($_SESSION['username']) && isset($_SESSION['email'])){            
                  echo '<li class="nav-item">
                  <a class="nav-link" href="#" id="logout-btn">Logout</a>
              </li><li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="false">';
                       echo $_SESSION['username']; 
            echo '</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="views/profile.php">Profile</a>
                <a class="dropdown-item" href="views/game.php">Game</a>';
              if(isset($_SESSION['admin'])&&$_SESSION['admin']==1){echo'<a class="dropdown-item" href="views/admin.php">Admin</a>';}
            echo '</div>
            </li>';
            }
            else{
            echo '<li class="nav-item">
                <a class="nav-link" href="views/login.php">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="views/registration.php">Register</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="views/game.php">Game</a>
            </li>';
            }
            ?>
            </ul>
        </div>
    </nav>


    <!-- <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li> -->
    <!--/ Nav End /-->

    <section class="leaderboard">
        <div class="container1">
            <div class="row">
                <div class="col-sm-12">
                    <div class="title-box text-center">
                        <div class="topic">
                            <h1>
                                Leaderboard
                            </h1>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="text-center">
            <h2>Top 10 This week</h2>
            <?php
                printTable($week_result);
            ?>

        </div>

        <div class="text-center">
            <h2>Top 10 This month</h2>
            <?php
                printTable($month_result);
            ?>

        </div>

        <div class="text-center">
            <h2>Top 10 Lifetime</h2><?php
                printTable($result);
            ?>
        </div>


    </section>

    </script>
    <script src=" lib/jquery/jquery.min.js">
    </script>
    <script src="lib/jquery/jquery-migrate.min.js"></script>
    <script src="lib/jquery/jquery.js"></script>
    <script src="lib/popper/popper.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script> -->
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="lib/sweetalert/sweetalert.min.js"></script>
    <script>
    $("#logout-btn").click(() => {
        $.ajax({
            url: "apis/logout.php",
            type: "POST",
            success: (response) => {
                response = JSON.parse(response);
                swal("Logged out!", "", "success").then((value) => {
                    window.location = "views/login.php";
                });
            },
        });
    });
    </script>
</body>

</html>

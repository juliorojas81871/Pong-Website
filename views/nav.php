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
                <a class="dropdown-item" href="profile.php">Profile</a>
                <a class="dropdown-item" href="game.php">Game</a>';
              if(isset($_SESSION['admin'])&&$_SESSION['admin']==1){echo'<a class="dropdown-item" href="admin.php">Admin</a><a class="dropdown-item" href="scores.php">Scores</a>';}
            echo '</div>
            </li>';
            }
            else{
            echo '<li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="registration.php">Register</a>
            </li>';
            }
            ?>
        </ul>
    </div>
</nav>


<!-- <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li> -->
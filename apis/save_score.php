<?php
    include('db.php');
  	include('validate.php');
  	session_start();
    $_SESSION['score'] = $_POST['score'];
    $score = $_SESSION['score'];
  	$id = $_SESSION['id'];
  	if(isset($_SESSION['logged_in']) && isset($_SESSION['id']))
  	{
        if(isset($score)){
            $q = "INSERT INTO scores(user_id, score, time, level) VALUES ('$id', '$score', NOW(), 1)";
			$query = mysqli_query($con, $q);
        }
    }
    else
	  {echo(json_encode(array('status' => 'failure', 'message' => 'You must be logged in to save score')));}
?>
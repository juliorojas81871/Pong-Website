<?php

    include('db.php');
    session_start();
	

    if (isset($_SESSION['logged_in']) && isset($_SESSION['username']))
    { 
    if(($_SESSION['logged_in']==1))   
        {
                 $username = $_SESSION['username'];
                $basicInfo=[];
                //basicInfo
                $query = mysqli_query($con, "SELECT * FROM users where username ='".$username."'");
                if (mysqli_num_rows($query) == 0) {
                    return json_encode(array('status' => 'failure', 'result' => 'User ID not found'));
                } else {
                    $basicInfo = mysqli_fetch_array($query,MYSQLI_ASSOC); ;
                    echo json_encode(array('status' => 'success', 'result' => $basicInfo));          
                }
                 
        }else
        {
            echo json_encode(array('status' => 'failure', 'result' => 'Not logged in'));
        }
   }else
   {
       echo json_encode(array('status' => 'failure', 'result' => 'Not logged in'));
   }
?>
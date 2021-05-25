<?php

	include('db.php');
	
	
	
	session_start();

	if(isset($_SESSION['logged_in']) && isset($_SESSION['username']))
	{
		if($_SESSION['username'] != "")
		try
		{
			$username = $_SESSION['username'];
			$profile_data = [];

			$query = mysqli_query($con, "SELECT * FROM users WHERE username ='".$username."'");

			if (mysqli_num_rows($query) == 0) 
			{
				return json_encode(array('status' => 'failure', 'result' => 'user ID not found'));
			}

			else
			{
				$profile_data = mysqli_fetch_array($query,MYSQLI_ASSOC);
			}
			$result = (object) [
                'profile_data'=>$profile_data,
            ];
            echo json_encode(array('status' => 'success', 'result' => $result));
		}
		catch(Exception $e) 
        {
            echo json_encode(array('status' => 'failure', 'result' => $e->getMessage()));
        }
	}

?>
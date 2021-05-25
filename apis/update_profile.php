<?php

	include('db.php');
	session_start();
	include('validate.php');
	
	
	if(isset($_SESSION['logged_in']) && isset($_SESSION['id']))
	{
		
		if($_POST['action'] =="updateProfile"){
			$id = $_SESSION['id'];
			$uname = $_POST["username"];
			$email = $_POST["email"];
			$profile_status = $_POST["status"];
			$public = 0;

			if ( validateName($uname,$con) && validateEmail($email,$con)  && isset($profile_status)) 
			{
				$uname = mysqli_real_escape_string($con, $uname); 
				$email = mysqli_real_escape_string($con, $email);
				if($profile_status == "Public")
				{
					$public = 1;
				}


				$q = "UPDATE users SET username = '".$uname."', email='".$email."', public='".$public."' WHERE id='".$id."'";
				$q1 = mysqli_query($con, $q);
				$q2 = "SELECT * FROM users WHERE username = '".$uname."' AND email='".$email."'";
				$query = mysqli_query($con, $q2);
				if(mysqli_num_rows($query)==1){ 
					  $query_row = mysqli_fetch_array($query,MYSQLI_ASSOC);
					  $_SESSION['username'] = $query_row['username'];
					  $_SESSION['id'] = $query_row['id'];
					  $_SESSION['email']=$query_row['email'];
					
					echo(json_encode(array('status' => 'success', 'message' => "updated successfully")));
				}
				else
				{
				// echo("Error description: " . mysqli_error($con));
					echo(json_encode(array('status' => 'error', 'message' => mysqli_error($con))));
				}
			}
		}
		/***********************************Password update*******************************/

		if($_POST['action'] == "updatePass"){
			
			$id = $_SESSION['id'];
			$cpass = $_POST['cpass'];
			$npass = $_POST['npass'];
			$ppass = $_POST['ppass'];
			if($id != 0)
			try
			{
			$query = "SELECT * FROM users where id ='$id'";
				 $res = mysqli_query($con, $query);
		 
				 if($res){
					 $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
					 $pass = $row['password'];
					 $cpass = hash('sha512', $cpass) ;
			    	if($cpass==$pass){
					//echo 'first step';
					if(isset($npass) && isset($ppass)){

				 		if($npass==$ppass){
						//echo 'second step';
							if(validatePassword($npass)){
								$fpass = hash('sha512', $npass);
								$q="UPDATE users SET password='".$fpass."' WHERE id='".$id."'";
								$query = mysqli_query($con, $q);
								if($query)
								{
									echo json_encode(array('status' => 'success', 'message' => 'Password Updated'));
								}else{
									echo json_encode(array('status' => 'failure', 'message' => 'update failed'));
								}
						    }
				 		}else{
				
						echo json_encode(array('status' => 'failure', 'message' => 'new passwords not matching'));
				 	    }
					}else{
					
						echo json_encode(array('status' => 'failure', 'message' => 'new passwords cannot be empty'));
					}

			 }else{
				
					echo json_encode(array('status' => 'failure', 'message' => 'Current password not matching'));
				}
				}else{
				
				echo json_encode(array('status' => 'failure', 'message' => 'unable to find details'));
				}
			}catch(Exception $e) 
		{
            echo json_encode(array('status' => 'failure', 'message' => $e->getMessage()));}
		}

		

	}



?>
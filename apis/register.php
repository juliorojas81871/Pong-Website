<?php 

session_start();
include 'db.php';	
include('validate.php');					

if($_SERVER["REQUEST_METHOD"] === "POST" )
	{
		$uname = $_POST["username"];
		$email = $_POST["email"];
		$password = $_POST["password"];
		$confirmPassword=$_POST["cpassword"];
		$profile_status = $_POST["profile_status"];
		$public = 0;

		if ( isset($uname) && isset($email) && isset($password) && isset($confirmPassword) && isset($profile_status)) 
		{
			if($password==$confirmPassword){
						if( validateName($uname,$con) && validateEmail($email,$con) &&validatePassword($password)  )
						{
							if($profile_status == "Public")
							{
								$public = 1;
							}
							$name = mysqli_real_escape_string($con, $uname);
							$email = mysqli_real_escape_string($con, $email);
							$password = mysqli_real_escape_string($con, hash('sha512', $password) );

							$q = "INSERT INTO users(username, email, password, public, admin, level) VALUES ('$name', '$email','$password', '$public', 0, 1)";
							
							$query = mysqli_query($con, $q);

							if ($query) {

								$query = mysqli_query($con, 'SELECT email FROM users WHERE email="'.$email.'"');
								$email = mysqli_fetch_array($query)["email"];
								echo(json_encode(array('status'=>'success','message'=>$email)));
								
							}
						}
						// else
						// {
						// 	echo(json_encode(array('status'=>'failure','message' => 'Validation failed')));
						// }
			}
			else
			{
				echo(json_encode(array('status'=>'failure','message' => 'Passwords are not matching')));
			}
		}
		 else
		 {
		 	echo(json_encode(array('status'=>'failure','message' => 'Fill all fields')));
		 }
	}
	else{
		echo(json_encode(array('status'=>'failure','message' => 'not a post request')));
	}

?>
<?php
function validateName($name, $con){
	// echo $name;
	if($name==''){
		echo(json_encode(array('status'=>'failure','message'=>' Username required')));
		return 0;
	}
	if (strlen($name) <= 3 || strlen($name) >= 15){

		echo (json_encode(array('status' => 'failure', 'message' => 'Username needs to have length between 3 to 15')));
		return 0;
	}
	$queryName=mysqli_query($con,"SELECT * from users where username='$name'");
	$countName=mysqli_num_rows($queryName);
	if(isset($_SESSION['username'])){	
		if($name != $_SESSION['username'] && $countName !=0)
		{
			echo (json_encode(array('status' => 'failure', 'message' => 'Username is taken')));
			return 0;
		}
	}
	else if( $countName != 0)
		{
			echo (json_encode(array('status' => 'failure', 'message' => 'Username is taken')));
			return 0;
		}
	return 1;
}


function validateEmail($email, $con) {

	if ($email == '') {

		echo(json_encode(array('status' => 'failure', 'message' => 'Email is required')));
		return 0;
	} 
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {

		echo(json_encode(array('status' => 'failure', 'message' => 'Valid email is required')));
		return 0;
	} 
	$queryEmail=mysqli_query($con,"SELECT * from users where email='$email'");
	$countEmail=mysqli_num_rows($queryEmail);
	if(isset($_SESSION['email'])){
		if($email != $_SESSION['email'] && $countEmail!=0){
			echo(json_encode(array('status' => 'failure', 'message' => 'Email already registered')));
			return 0;
		}
	}
	else if( $countEmail != 0)
	{
		echo(json_encode(array('status' => 'failure', 'message' => 'Email already registered')));
		return 0;
	}
	return 1;
}

function validatePassword($password) {
	if ($password == '') {

		echo(json_encode(array('status' => 'failure', 'message' => 'Password is required')));
		return 0;
	}

	if (strlen($password) < 8) {

		echo (json_encode(array('status' => 'failure', 'message' => 'Password needs to have 8-32 characters')));
		return 0;
	}
	return 1;
}
?>
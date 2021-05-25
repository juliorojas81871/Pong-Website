<?php 

function validateEmail($email) {
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {

			echo(json_encode(array('status' => 'failure', 'message' => 'Valid email is required')));
			return 0;
	} 
	return 1;
}
function validateUsername($username) {
	if(strlen($username) < 3 || strlen($username) > 15) {

			echo(json_encode(array('status' => 'failure', 'message' => 'Username length must be between 3 and 15')));
			return 0;
	} 
	return 1;
}
function validateUserID($userID) {

	if ($userID == '') {

		echo(json_encode(array('status' => 'failure', 'message' => 'User ID is required')));
    return 0;
	} 
  else if(isEmail($userID))
  {
    validateEmail($userID);
  }
  else{
    validateUsername($userID);
  }
	return 1;
}
function isEmail($userID)
{
if(filter_var($userID, FILTER_VALIDATE_EMAIL)) {
return 1;
} else {
return 0;
}
}

function validatePassword($password) {
	if ($password == '') {

		echo(json_encode(array('status' => 'failure', 'message' => 'Password is required')));
		return 0;
	}

	if (strlen($password) < 8) {

		echo (json_encode(array('status' => 'failure', 'message' => 'Password needs to have min 8 characters')));
		return 0;
	}
	return 1;
}
?>
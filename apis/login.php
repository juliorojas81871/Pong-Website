<?php
session_start();
include 'db.php';
include 'validate2.php';

if($_SERVER["REQUEST_METHOD"] === "POST" ){
  $userID=$_POST['userID'];
  $password=$_POST['loginPassword'];

  if(validateUserID($userID) && validatePassword($password)){
    $loginPassword=hash('sha512', $password);
    if(isEmail($userID))
    {
      $query1 ="SELECT * FROM users WHERE email='".$userID."' AND password='".$loginPassword."'";
    }
    else{
      $query1 ="SELECT * FROM users WHERE username='".$userID."' AND password='".$loginPassword."'";
    }
    $query1_run=mysqli_query($con,$query1);
    if(mysqli_num_rows($query1_run)==1){ 
      $query_row = mysqli_fetch_array($query1_run,MYSQLI_ASSOC);
      $_SESSION['logged_in'] = 1;
      $_SESSION['username'] = $query_row['username'];
      $_SESSION['id'] = $query_row['id'];
      $_SESSION['level']=$query_row['level'];
      $_SESSION['email']=$query_row['email'];
      $_SESSION['admin']=$query_row['admin'];
      $basicInfo=[];
      $basicInfo = mysqli_fetch_array($query1_run,MYSQLI_ASSOC);           
   
      echo json_encode(array('status' => 'success', 'message'=> 'Login successful', 'result' => $basicInfo));    
    }else{
      echo(json_encode(array('status'=>'failure','message' => 'Wrong password  or unregistered userID')));
    }
  }else{
            echo(json_encode(array('status'=>'failure','message' => 'Please fill out all the fields'))); 	   
  }
}else{
  echo(json_encode(array('status'=>'failure','message' => 'Not a post request')));
}

mysqli_close($con);
?>
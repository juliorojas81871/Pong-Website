<?php
include('db.php');
$id=$_POST['id'];
$score=$_POST['score'];
$update_query = mysqli_query($con, "UPDATE scores SET score='".$score."' WHERE id='".$id."'");
if($update_query){
    echo 'Successfully updated';
}
else{
    echo'failure';
}

?>
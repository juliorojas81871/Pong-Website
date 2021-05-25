<?php
include('db.php');
$id=$_POST['id'];
$query = "DELETE FROM scores WHERE id='".$id."'";
$delete_query = mysqli_query($con,$query);
if($delete_query){
    echo 'record deleted';
}
else{
    echo'failure';
}
?>
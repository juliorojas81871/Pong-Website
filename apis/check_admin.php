<?php
include('db.php');
session_start();
$id = $_SESSION['id'];
$query = "SELECT * FROM users WHERE id = '$id'";
$query_run = mysqli_query($con, $query);
if(mysqli_num_rows($query_run)==1)
{
    $query_row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
    $admin = $query_row['admin'];
    if($admin == 1)
    {
        echo("success");
    }
    else
    {
        echo("failure");
    }
}

?>
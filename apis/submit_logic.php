<?php
include('db.php');
$reward = $_POST['reward'];
$speed = $_POST['speed'];
$duration = $_POST['duration'];
$difficulty = $_POST['difficulty'];
$query = mysqli_query($con,"SELECT * FROM admin_logic WHERE level='".$difficulty."'");
if(mysqli_num_rows($query) > 0)
{
    $update_query = mysqli_query($con, "UPDATE admin_logic SET reward_pts='".$reward."', speed='".$speed."', duration='".$duration."' WHERE level='".$difficulty."'");
    $q2 = "SELECT * FROM admin_logic WHERE level = '".$difficulty."'";
	$query = mysqli_query($con, $q2);
    if(mysqli_num_rows($query)==1)
                
    {
        echo(json_encode(array('status'=>'success','message'=>"successfully updated"))); 
    }
    else
    {
        echo(json_encode(array('status'=>'failure','message'=>"database problem"))); 
    }
}
else
{
    $add_query = mysqli_query($con, "INSERT INTO admin_logic(reward_pts, speed, duration, level) VALUES($reward, $speed, $duration, $difficulty)");
    if($add_query)
    {
        echo(json_encode(array('status'=>'success','message'=>"successfully updated"))); 
    }
    else
    {
        echo(json_encode(array('status'=>'failure','message'=>"database problem"))); 
    }
}
?>
<?php
include('db.php');
session_start();
$record_per_page = 10;
$page = $_POST["page"];
$output = '<table class="table-bordered">
<tr>
    <th>Sl.No</th>
    <th>Reward Points</th>
    <th>Speed</th>
    <th>Duration</th>
    <th>Level</th>
    <th></th>
</tr>'; 
$start_from = (($page - 1)*$record_per_page) ; 
$query = "SELECT * FROM admin_logic ORDER BY level ASC LIMIT $start_from,$record_per_page";
$result = mysqli_query($con, $query);  
$query_row = mysqli_fetch_array($result);
$sl_no = ($page - 1)*10;
while($row = mysqli_fetch_array($result))
{   
    $sl_no++;
    $reward = $row["reward_pts"];
    $speed = $row["speed"];
    $duration = $row["duration"];
    $level = $row["level"];
    $output.='<tr><td>'.$sl_no.'</td><td>'.$reward.'</td><td>'.$speed.'</td><td>'.$duration.'</td><td>'.$level.'</td><td><button class="btn btn-success edit_logic">Edit</button></td></tr>';
}
$output .= '</table><br><div align="center" class="row">';  
$page_query = "SELECT * FROM admin_logic";  
$page_result = mysqli_query($con, $page_query);  
$total_records = mysqli_num_rows($page_result);  
$total_pages = ceil($total_records/$record_per_page); 
$class = 'pg1';
for($i=1; $i<=$total_pages; $i++)  
{  
    $output .= '<span class="'.$class.'" style="cursor:pointer; padding:6px; border:1px solid #ccc;" id="'.$i.'";">'.$i.'</span>';  
}  
$output .= '</div><br />';  
echo $output; 
?>
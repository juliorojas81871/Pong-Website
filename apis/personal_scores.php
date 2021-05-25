<?php
include('db.php');
session_start();
$id = $_SESSION['id'];
$record_per_page = 11;
$page = $_POST["page"];
$start_from = ($page - 1)*$record_per_page; 
$query = "SELECT * FROM scores WHERE user_id='$id' ORDER BY time ASC, level DESC LIMIT $start_from,$record_per_page";
$result = mysqli_query($con, $query);  
$query_row = mysqli_fetch_array($result);
$sl_no = ($page - 1)*10;

// $row=mysqli_fetch_all($result,MYSQLI_ASSOC);
$total_rows = mysqli_num_rows($result);
if ( $total_rows > 0)
{
    $output = '<table class="table-bordered">
    <tr>
        <th>Sl.No</th>
        <th>Score</th>
        <th>Level</th>
        <th>Time</th>
    </tr>'; 
    while($row = mysqli_fetch_array($result))
    {   
        $sl_no++;
        $level = $row["level"];
        $score = $row["score"];
        $time = $row["time"];
        $output.='<tr><td>'.$sl_no.'</td><td>'.$score.'</td><td>'.$level.'</td><td>'.$time.'</td></tr>';
    }
    $output .= '</table><br><div class="row">';   
    $page_query = "SELECT * FROM scores WHERE user_id='$id'";  
    $page_result = mysqli_query($con, $page_query);  
    $total_records = mysqli_num_rows($page_result);  
    $total_pages = ceil($total_records/$record_per_page); 
    $class = 'pg1';
    for($i=1; $i<=$total_pages; $i++)  
    {  
        $output .= '<span class="'.$class.'" style="cursor:pointer; padding:6px; border:1px solid #ccc;" id="'.$i.'";">'.$i.'</span>';  
    }  
    $output .= '</div><br />';  
}
else
{
    $output = "Scores table empty: You haven't played any game yet";
}

echo $output; 
?>
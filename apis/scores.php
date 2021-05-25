<?php
include('db.php');
$record_per_page = 11;
$page = $_POST["page"];
$output = '<table class="table-bordered">
<tr>
    <th>Sl.No</th>
    <th>Username</th>
    <th>Scores</th>
    <th>ID</th>
</tr>'; 
$start_from = (($page - 1)*$record_per_page) ; 
$query="SELECT * FROM `users` INNER JOIN `scores`  ON users.id= scores.user_id  ORDER BY  scores.score DESC, scores.level DESC, scores.time ASC LIMIT $start_from, $record_per_page";
$result = mysqli_query($con, $query);
$query_row = mysqli_fetch_array($result);
$sl_no = ($page - 1)*10;
while($row = mysqli_fetch_array($result))
{   
    $sl_no++;
    $username = $row['username'];
    $scores = $row["score"];
    $id = $row['id'];
    $output.='<tr><td>'.$sl_no.'</td><td>'.$username.'</td><td><input type="text" value="'.$scores.'" class="score_row'.$sl_no.'"/>
    </td><td>'.$id.'</td><td><button class="btn btn-success edit_record">Update</button></td><td><button class="btn btn-danger delete_record">Delete</button></td></tr>';
}
$output .= '</table><br><div align="center" class="row">';  
$page_query = "SELECT * FROM `users` INNER JOIN `scores`  ON users.id= scores.user_id";  
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
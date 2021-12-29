<?php 
include "include/dbconfig.php";
$courseid=trim(isset($_POST['courseid']) ? $_POST['courseid'] : "") ;
$sql 		 ="SELECT * FROM `courses` WHERE `course_id`='$courseid'";
$res 		=mysqli_query($conn,  $sql);
if(mysqli_num_rows($res) > 0)
{
	$row = mysqli_fetch_assoc($res);
}
echo $row['course_fee']

?>


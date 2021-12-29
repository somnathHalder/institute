<?php 
	include "include/dbconfig.php" ;
	if($_POST)
	{
		$coursecode	=trim($_POST['course']);
		$sessioncode	=trim($_POST['sessionCode']);
		$sql 		="SELECT MAX(`serial_no`) AS `slno` FROM `pursuing_course` WHERE `course_code`='$coursecode' AND `session_code`='$sessioncode'";
		$res 		=mysqli_query($conn,  $sql);
		$row 		=mysqli_fetch_assoc($res);
		if($row['slno']!=null)
		{
			$regno=$coursecode.$sessioncode.sprintf('%0' . 4 . 's',($row['slno']+1));
			echo $regno;
		}
		else{
			$regno=$coursecode.$sessioncode."0001";
			echo $regno;
		}
	}

?>
<?php
session_start();
// function findSerialNo($sessioncode='02',$coursecode='PKJ-008')
// {
// 	include "include/dbconfig.php" ;
// 	$sql 		="SELECT MAX(`serial_no`) AS `slno` FROM `pursuing_course` WHERE `course_code`='$coursecode' AND `session_code`='$sessioncode'";
// 	$res 		=mysqli_query($conn,  $sql);
// 	$row 		=mysqli_fetch_assoc($res);
// 	if($row['slno']!=null)
// 	{
		
// 		return (sprintf('%0' . 4 . 's',($row['slno']+1)));
// 	}
// 	else{
// 		$slno=sprintf('%0' . 4 . 's',1);
// 		return $slno;
// 	}
// }

// echo findSerialNo();


function findStudentRegistraionNo($sessioncode='01',$coursecode='PKJ-008')
{
	include "include/dbconfig.php" ;

	$sql2="SELECT * FROM courses WHERE id='$coursecode'";
	$res2=mysqli_query($conn,$sql2);
	$row2=mysqli_fetch_assoc($res2);
	$course_code=$row2['course_id'];


	$sql3="SELECT * FROM franchises WHERE id='{$_SESSION['franchise_id']}'  ";
	$res3=mysqli_query($conn,$sql3);
	$row3=mysqli_fetch_assoc($res3);
	$institutecode =$row3['code'];
		
	$sql 		="SELECT MAX(`serial_no`) AS `slno` FROM `pursuing_course` WHERE `course_code`='$course_code' AND `session_code`='$sessioncode' AND franchises_id='{$_SESSION['franchise_id']}'";
	$res 		=mysqli_query($conn,  $sql);
	$row 		=mysqli_fetch_assoc($res);
	if($row['slno']!=null)
	{
		$regno=$institutecode.$sessioncode.$course_code.sprintf('%0' . 4 . 's',($row['slno']+1));
		return $regno;
	}
	else{
		$regno=$institutecode.$sessioncode.$course_code."0001";
		return $regno;
	}
	
}
echo findStudentRegistraionNo();
?>
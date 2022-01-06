<?php 
session_start();
include "include/dbconfig.php";
$validator = array('success' => false, 'messages' => array(),'data'=>array());
$data=array();
$course=$_POST['course'];
$subject=$_POST['subject'];
if($_POST)
{
	// foreach($_POST['course'] AS $key)
	// {
	// 	$regno=getRegno($key);
	// 	$sql="INSERT INTO `student_logininfo`(`student_id`, `regno`, `exm_id`,`course_no`) 
	// 		VALUES('$key','$regno','$_POST[examid]','$_POST[course]')";
	// 	/* echo $sql."<br/>"; */
	// 	$res = mysqli_query($conn,  $sql);
	// }
	// if($res)
	// {
	// 	$validator['success'] = true;
    //     $validator['messages'] = "Successfully Added";
	// }

    // $sql="SELECT pursuing_course.regno as reg_no,marks.*,student_info.slno,student_info.St_Name,subjects.*,courses.* FROM pursuing_course INNER JOIN marks ON marks.student_id=pursuing_course.student_id INNER JOIN student_info on student_info.slno=pursuing_course.student_id INNER JOIN subjects ON subjects.course_id=pursuing_course.course_id INNER JOIN courses ON courses.id=pursuing_course.course_id WHERE marks.franchise_id='{$_SESSION['franchise_id']}' AND marks.course_id='{$course}' AND marks.subject_id='{$subject}'";

	$sql="SELECT pursuing_course.regno as reg_no,pursuing_course.*,student_info.*,courses.* FROM `pursuing_course` INNER JOIN student_info ON student_info.slno=pursuing_course.student_id INNER JOIN courses ON courses.id=pursuing_course.course_id WHERE pursuing_course.course_id='{$course}' AND pursuing_course.franchise_id='{$_SESSION['franchise_id']}'";

	

   $res =mysqli_query($conn,$sql);
   

   if(mysqli_num_rows($res)>0)
   {
       while($row=mysqli_fetch_assoc($res))
       {
		$sql1="SELECT * FROM marks WHERE student_id='{$row['slno']}'";
		$res1=mysqli_query($conn,$sql1);
		   $row1=mysqli_fetch_assoc($res1);
		   if($row1 === null)
		   {
			   $row1=array();
		   }
       $data[]=$row+$row1;
       }
  
   }
   $validator['success'] = true;
    $validator['messages'] = "Successfully Added";
    $validator['data']=$data;
}
echo json_encode($data);
function getRegno($key)
{
	include "include/dbconfig.php";
	$sql="SELECT * FROM pursuing_course WHERE `student_id`='$key'";
	$res=mysqli_query($conn,  $sql);
	if(mysqli_num_rows($res) > 0)
	{
		$row=mysqli_fetch_assoc($res);
		return $row['regno']; 
	}
	else{
		return null;
	}
}

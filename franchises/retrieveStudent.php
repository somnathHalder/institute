<?php 
session_start();
include "include/dbconfig.php";
$output = array('data' => array());

$sql="SELECT *  FROM `student_info` where franchises_id='{$_SESSION['franchises_id']}' ";
	
	
$res=mysqli_query($conn, $sql);
$x=1;


while($row=mysqli_fetch_assoc($res))
{
	$actionButton = '
    <button class="btn btn-sm btn-primary" onclick="editMember('.$row['slno'].')"><span class="glyphicon glyphicon-edit"></span> Edit</button>


    <button class="btn btn-sm btn-primary" data-toggle="modal"  data-target="#removeMemberModal" onclick="removeMember('.$row['slno'].')"><span class="glyphicon glyphicon-trash"></span> Remove</button>
     
     ';
	
	$output['data'][]=array
	(
		$x,
		$row['St_Name'],
		$row['Fathers_Name'],
		$row['DOB'],
		$row['Gender'],
        $row['Cust'],
        $row['DOA'],
        $row['regno'],
	/* 	$label, */
		$actionButton,
	);
	$x++;
}
echo json_encode($output);

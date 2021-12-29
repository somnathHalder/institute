<?php 
include "include/dbconfig.php";
$sql="SELECT * FROM `institute_info`";
$res = mysqli_query($conn,  $sql) ;
$row=mysqli_fetch_assoc($res);
$instituteName=$row['institute_name'];
$address=$row['address'];
$description=$row['description'];
$contact=$row['contact'];




?>
<?php 
session_start();
include "include/no-cache.php";
include "include/dbconfig.php";
include "include/check-login.php";
$address=trim($_POST['address']);
$sql="SELECT * FROM `adress` WHERE `address`='$address'";
$res=mysqli_query($conn,  $sql);
$row=mysqli_fetch_assoc($res);
$arr=array(
'po'=>$row['po'],
'pin'=>$row['pin'],
'ps'=>$row['ps'],
'dist'=>$row['district']
);
echo json_encode($arr);
?>
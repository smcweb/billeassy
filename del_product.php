<?php

include('config.php');
session_start();
// echo $_SESSION['username'];

if(!isset($_SESSION['username']))
{	
	header('location:login.php');
}
else
{
	
	$uname = $_SESSION['username'];
		// echo "<script>alert('session mentain')</script>";
}


$product=$_POST['id'];
//$catid=$_GET['catid1'];

$del=mysqli_query($conn,"DELETE FROM `tblproduct` WHERE `pid`='$product'");

if($del)
{
	echo "<script>alert('Record Deleted')</script>";
	//header('Location:category.php');
}

/*$id=$_POST['id'];
$jsonData = array();
$querySelect="DELETE FROM `tblproduct` WHERE `pid`='$id' ";
$recordSelect=mysqli_query($conn,$querySelect);
while($row = mysqli_fetch_array($recordSelect,MYSQL_ASSOC)){
    array_push($jsonData,$row);
}
echo json_encode($jsonData);*/

?>
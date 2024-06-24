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


$tax=$_GET['taxid'];

$del=mysqli_query($conn,"DELETE FROM `tbltax` WHERE `taxid`='$tax'");
$up=mysqli_query($conn,"UPDATE `tblproduct` SET `taxid`='1' WHERE `taxid`='$tax''");
if($del)
{
	echo "<script>alert('Record Deleted')</script>";
	header('Location:tax.php');
}

?>
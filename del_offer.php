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

$offer=$_GET['offerid'];

$del=mysqli_query($conn,"DELETE FROM `tbloffer` WHERE `offerid`='$offer'");
$up=mysqli_query($conn,"UPDATE `tblproduct` SET `offerid`='1' WHERE `offerid`='$offer''");


if($del)
{
	echo "<script>alert('Record Deleted')</script>";
	header('Location:offer.php');
}

?>
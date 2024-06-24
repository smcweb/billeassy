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
		
}


 $id=$_GET['expid'];

$sql="DELETE FROM `tblexpences` WHERE `expid`='$id'";


 $del=mysqli_query($conn,$sql); 
if($del)
{
	echo "<script>alert('Record Deleted')</script>";
header('Location:expences.php');
}


?>
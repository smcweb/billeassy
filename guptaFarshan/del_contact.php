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


 $id=$_GET['cid'];

$sql="DELETE FROM `phonebook` WHERE `cid`='$id'";


 $del=mysqli_query($conn,$sql); 
if($del)
{
	echo "<script>alert('Record Deleted')</script>";
header('Location:phonebook.php');
}


?>
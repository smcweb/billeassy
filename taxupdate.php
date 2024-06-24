<?php
include('config.php');
session_start();
if(!isset($_SESSION['username']))
{
    header('location:login.php');
}
else
{

    $uname = $_SESSION['username'];
	$id=$_SESSION['shopidu'];
    // echo "<script>alert('session mentain')</script>";
}


$id=$_POST['id'];
$shopId=$_SESSION['shopidu'];
$taxid=$_POST['taxid'];

	$fet=mysqli_query($conn,"SELECT * FROM `tbltax` WHERE `taxName`='No Tax' AND `shopid`='$shopId'");
	while($rw=mysqli_fetch_array($fet))
	{
		$notaxid=$rw['taxid'];		
	}
$update=mysqli_query($conn,"UPDATE `tblproduct` SET `taxid`='$notaxid' WHERE `pid`='$id'");

echo json_encode('Tax removed successfully');


?>
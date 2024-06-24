<?php
session_start();


include('config.php');

/*if(!isset($_SESSION['username']))
{
    header('location:login.php');
}
else
{

    $uname = $_SESSION['username'];
	$id=$_SESSION['shopidu'];
    // echo "<script>alert('session mentain')</script>";
}*/
$shopId=$_SESSION['shopidu'];
$offerid=$_POST['offerid'];

$id=$_POST['id'];
$fet=mysqli_query($conn,"SELECT * FROM `tbloffer` WHERE `offername`='No Offer' AND `shopid`='$shopId'");
	while($rw=mysqli_fetch_array($fet))
	{
		$noofferid=$rw['offerid'];		
	}

$update=mysqli_query($conn,"UPDATE `tblproduct` SET `offerid`='$noofferid' WHERE `pid`='$id'");

echo json_encode('Offer removed successfully');

?>
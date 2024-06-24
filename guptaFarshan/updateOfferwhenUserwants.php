<?php include_once "config.php";
$offerid=$_POST['offerid'];

	$category=$_POST['catid'];
	$product=$_POST['pid'];

	$offer=mysqli_query($conn,"SELECT * FROM `tblproduct` WHERE `pid`='$product'");
	while($r=mysqli_fetch_array($offer))
	{
		$ofid=$r['offerid'];
	}
		//echo "<script>alert('$offerid')</script>";
	//echo "<script>alert('$ofid')</script>";

if($ofid==1)
	{
		$update=mysqli_query($conn,"UPDATE `tblproduct` SET `offerid`='$offerid' WHERE `pid`='$product'");
			if($update)
			{
				echo "<script>alert('offer assign ')</script>";
			}
			else
			{
				echo "<script>alert('update error ')</script>";
			}

	}
elseif($offerid==$ofid)
{
    echo json_encode('this offer is already assign');
}
else
 {
         echo json_encode('alerdy exit');
    }
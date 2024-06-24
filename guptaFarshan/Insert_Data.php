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

  
  
if($_POST['action'] == 'insert')
{
   
   $NAME =$_POST['name'];
   $price =$_POST['price'];
   $quantity =$_POST['quantity'];
   $catid=$_POST['category'];
	$shopid=$_POST['shopid'];
 $sql="SELECT count(*) FROM `tblproduct` WHERE `pname` ='$NAME' && `quantity`= '$quantity'";
  $query1=mysqli_query($conn,$sql);
$r=mysqli_fetch_row($query1);
$all=$r[0];
$querySelect="SELECT * FROM `tbltax` WHERE `shopid`='$shopid' AND `taxName`='No Tax'";
    $recordSelect=mysqli_query($conn,$querySelect);

    while($row=mysqli_fetch_array($recordSelect)) {
        $ctaxid=$row['taxid'];
    }
	$querySelect="SELECT * FROM `tbloffer` WHERE `offername`='No Offer' AND `shopid`='$shopid'";
    $recordSelect=mysqli_query($conn,$querySelect);

    while($row=mysqli_fetch_array($recordSelect)) {
        $cofferid=$row['offerid'];
    }
if($all>=1)
{
	echo "<script>alert('Product is all ready present')</script>";
	}
	else
	{
$query = "INSERT INTO `tblproduct` (`pname`,`price`,`quantity`,taxid,`catid`,`shopid`,offerid)VALUES('$NAME','$price','$quantity','$ctaxid','$catid','$shopid','$cofferid')";
         $query_run= mysqli_query($conn,$query);
		 }
        // $retval=mysql_query($query,$conn);
          if ($query_run)
          { 
                echo 'It is working';
          }
}
 
?>
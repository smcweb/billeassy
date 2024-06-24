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
    $cofferid =$_POST['offer'];
    $ctaxid =$_POST['tax'];
   $cat =$_POST['cat'];
   $priceWithoutMrpTax =$_POST['priceWithoutMrpTax'];
   $priceWithMrpTax =$_POST['priceWithMrpTax'];
   $quantity =$_POST['quantity'];
   $catid=$_POST['category'];
    $idHSNCode =$_POST['HSNCode'];
	$shopid=$_POST['shopid'];
 $sql="SELECT count(*) FROM `tblproduct` WHERE `pname` ='$NAME' && `quantity`= '$quantity'";
  $query1=mysqli_query($conn,$sql);
$r=mysqli_fetch_row($query1);
$all=$r[0];
if($all>=1)
{
	echo "<script>alert('Product is all ready present')</script>";
	}
	else
	{
$query = "INSERT INTO `tblproduct` (`pname`,`price`,mrp_with_gst,`quantity`,taxid,`catid`,`shopid`,offerid,hsncode)VALUES('$NAME','$priceWithoutMrpTax','$priceWithMrpTax','$quantity','$ctaxid','$catid','$shopid','$cofferid','$idHSNCode')";
         $query_run= mysqli_query($conn,$query);
		 }
        // $retval=mysql_query($query,$conn);
          if ($query_run)
          { 
                echo 'It is working';
          }
}
 
?>
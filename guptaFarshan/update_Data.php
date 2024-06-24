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

  $shopId=$_SESSION['shopidu'];
if($_POST['action'] == 'update')
{
   $pid=$_POST['prid'];
   $NAME =$_POST['name'];
   $price =$_POST['price'];
   $quantity =$_POST['quantity'];
   $catid=$_POST['category'];
 


$query = "UPDATE `tblproduct` SET `pname`='$NAME',`price`='$price',`quantity`='$quantity' WHERE `pid`='$pid'";
         $query_run= mysqli_query($conn,$query);
        // $retval=mysql_query($query,$conn);
          if ($query_run)
          { 
                echo 'It is working';
          }
}
 
?>
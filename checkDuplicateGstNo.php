<?php
include('config.php');
session_start();


$pgst=$_POST['pgst'];
$querySelect="SELECT * FROM `shop` WHERE `gst`='$pgst'";
$recordSelect=mysqli_query($conn,$querySelect);
$rowcount=mysqli_num_rows($recordSelect);
if($rowcount>0){
    /*echo json_encode('Gst No IS available Please Check Gst No');*/
    echo json_encode('YES');
}else{
    echo json_encode('No');
   // echo json_encode('Gst No IS Not available ');
}
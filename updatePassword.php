<?php
include('config.php');
session_start();
$shopid =$_POST['shopid'];
$password =$_POST['oldpassword'];
$newpassword =$_POST['newpassword'];
$sql="SELECT password FROM `shop`  WHERE `shopid`='$shopid' AND `password`='$password'";
$query=mysqli_query($conn,$sql);
$rowcount=mysqli_num_rows($query);
if($rowcount==0) {
    echo json_encode('Old Password Is Not Valid');
    return;
}
    $query = "UPDATE `shop` SET `password`='$newpassword' WHERE `shopid`='$shopid' AND `password`='$password' ";
    $query_run = mysqli_query($conn, $query);

// $retval=mysql_query($query,$conn)#CDDC39;
    if ($query_run) {
        echo json_encode('Password Update Sucessfull');
    }

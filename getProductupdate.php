<?php
include('config.php');
session_start();
$shopidu=$_SESSION['shopidu'];
$id=$_POST['id'];
$jsonData = array();
$querySelect="SELECT c.* ,t.* FROM `tblproduct` c JOIN tbltax t ON t.`taxid` =c.`taxid` WHERE c.`pid`='$id' AND c.`shopid`='$shopidu'";
$recordSelect=mysqli_query($conn,$querySelect);
while($row = mysqli_fetch_array($recordSelect)){
    array_push($jsonData,$row);
}

echo json_encode($jsonData);
?>
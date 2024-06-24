<?php
include('config.php');
session_start();


$pname=$_POST['pname'];
$jsonData = array();
$jsonOffer = array();

$querySelect="SELECT c.* ,t.* FROM `tblproduct` c JOIN tbltax t ON t.`taxid` =c.`taxid` WHERE c.`pname`='$pname' ";
$recordSelect=mysqli_query($conn,$querySelect);
while($row = mysqli_fetch_array($recordSelect,MYSQL_ASSOC)){
    array_push($jsonData,$row);
	
	$offerid=$row['offerid'];
}
$response[]['response']=$jsonData;
$querySelect="SELECT * FROM `tbloffer` WHERE `offerid`='$offerid'";
$recordSelect=mysqli_query($conn,$querySelect);
while($row = mysqli_fetch_array($recordSelect,MYSQL_ASSOC)){
    array_push($jsonOffer,$row);
	
	
}
$response[]['responseOffer']=$jsonOffer;
///echo json_encode($offerid);
echo  json_encode ($response);
?>
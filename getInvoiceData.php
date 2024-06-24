<?php
include('config.php');
session_start();


$pname=$_POST['pname'];
$jsonData = array();
$jsonOffer = array();
$shopidu=$_SESSION['shopidu'];
$querySelect="SELECT c.* ,t.* FROM `tblproduct` c JOIN tbltax t ON t.`taxid` =c.`taxid` WHERE c.`pname`='$pname' AND c.`shopid`='$shopidu'";
$recordSelect=mysqli_query($conn,$querySelect);
while($row = mysqli_fetch_array($recordSelect)){
    array_push($jsonData,$row);
	
	$offerid=$row['offerid'];
}
$response[]['response']=$jsonData;
$querySelect="SELECT * FROM `tbloffer` WHERE `offerid`='$offerid' AND `shopid`='$shopidu'";
$recordSelect=mysqli_query($conn,$querySelect);
while($row = mysqli_fetch_array($recordSelect)){
    array_push($jsonOffer,$row);


}
$response[]['responseOffer']=$jsonOffer;
///echo json_encode($offerid);
echo  json_encode ($response);
?>
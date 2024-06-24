<?php
include('config.php');
session_start();


 $str=$_POST['js_custid'];
$str1=$_POST['js_proId'];
$js_custid =base64_decode($str);
$js_proId =base64_decode($str1);
$shopidu=$_SESSION['shopidu'];
//echo $js_custid;
//echo $js_proId;
//echo $shopidu;
$jsonData = array();
$jsonOffer = array();
$jsonOfferId = array();

$querySelect="SELECT `tbloffer`.*,`tblitem`.* FROM `tblitem` JOIN `tbloffer` ON tbloffer.`offerid`=`tblitem`.`oid` WHERE tblitem.`tid`='$js_proId' AND tblitem.`shopid`='$shopidu' AND tblitem.`statusQT`='T'";
$recordSelect=mysqli_query($conn,$querySelect);
while($row = mysqli_fetch_array($recordSelect)){
    array_push($jsonData,$row);

}
$response[]['response']=$jsonData;
$querySelect="SELECT * FROM `phonebook` WHERE `cid`='$js_custid' AND `shopid`='$shopidu'";
$recordSelect=mysqli_query($conn,$querySelect);
while($row = mysqli_fetch_array($recordSelect)){
    array_push($jsonOffer,$row);


}
$response[]['responseOffer']=$jsonOffer;
$querySelect="SELECT * FROM `tbltransaction` WHERE `tid`='$js_proId' AND `shopid`='$shopidu'";
$recordSelect=mysqli_query($conn,$querySelect);
while($row = mysqli_fetch_array($recordSelect)){
    array_push($jsonOfferId,$row);


}
$response[]['responseOfferid']=$jsonOfferId;
//echo json_encode($response);
echo  json_encode ($response);
?>
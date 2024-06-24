<?php
include('config.php');
session_start();

$id=$_POST['id'];
$jsonData = array();
$querySelect="SELECT tblcategory.catName,tblproduct.`pid`,tblproduct.`pname`,tblproduct.`price`,tblproduct.`quantity`,tblproduct.catid from tblproduct INNER JOIN tblcategory ON tblproduct.catid=tblcategory.catID  WHERE tblproduct.`pid`='$id' ";

//$querySelect="SELECT tblcategory.catName,tblproduct.`pid`,tblproduct.`pname`,tblproduct.`price`,tblproduct.`quantity`,tblproduct.catid from tblproduct INNER JOIN tblcategory ON tblproduct.catid=tblcategory.catID INNER JOIN tbltax ON tblproduct.taxid=tbltax.taxid INNER JOIN tbloffer ON tblproduct.offerid=tbloffer.offerid WHERE tblproduct.`pid`='$id'"

$recordSelect=mysqli_query($conn,$querySelect);
while($row = mysqli_fetch_array($recordSelect,MYSQL_ASSOC)){
    array_push($jsonData,$row);
}
echo json_encode($jsonData);
?>
<?php
include('config.php');
$id=$_POST['id'];
$jsonData = array();
$querySelect="SELECT * FROM  tblcategory  WHERE `catID`='$id' ";
$recordSelect=mysqli_query($conn,$querySelect);
while($row = mysqli_fetch_array($recordSelect,MYSQL_ASSOC)){
    array_push($jsonData,$row);
}
echo json_encode($jsonData);
?>
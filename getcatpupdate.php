<?php
include('config.php');
$id=$_POST['id'];
$jsonData = array();
$querySelect="SELECT * FROM  tblproduct  WHERE `pid`='$id' ";
$recordSelect=mysqli_query($conn,$querySelect);
while($row = mysqli_fetch_array($recordSelect)){
    array_push($jsonData,$row);
}
echo json_encode($jsonData);
?>
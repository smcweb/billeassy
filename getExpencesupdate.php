<?php
include_once 'config.php';
$id=$_POST['id'];
$jsonData = array();
$querySelect="SELECT `exp_name`, `exp_amount`, `exp_desc`, `exp_by`, `exp_date` FROM  tblexpences  WHERE `expid`='$id' ";
$recordSelect=mysqli_query($conn,$querySelect);
while($row = mysqli_fetch_array($recordSelect,MYSQL_ASSOC)){
    array_push($jsonData,$row);
}
echo json_encode($jsonData);
?>
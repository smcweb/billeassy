<?php
include('config.php');
session_start();
// echo $_SESSION['username'];


$number=$_POST['number'];
$jsonData = array();
$querySelect="SELECT * FROM `phonebook` WHERE `phonenumber`='$number' ";
$recordSelect=mysqli_query($conn,$querySelect);
while($row = mysqli_fetch_array($recordSelect,MYSQL_ASSOC)){
    array_push($jsonData,$row);
}
$rowcount=mysqli_num_rows($recordSelect);
if($rowcount > 0){
	echo json_encode($jsonData);
	//echo json_encode("q23");
 
}
else{
	$response[]['status'] ='No found';
	//echo json_encode("q23");
	echo json_encode($response);
	//return;
}
?>
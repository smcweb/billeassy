<?php

include('config.php');
session_start();
// echo $_SESSION['username'];

if(!isset($_SESSION['username']))
{
    header('location:login.php');
}
else
{

    $uname = $_SESSION['username'];
    // echo "<script>alert('session mentain')</script>";
}


$product=$_POST['deleteId'];
$pitemBill=$_POST['itemBill'];
//$catid=$_GET['catid1'];
$sql="SELECT COUNT(`itemid`) as countid FROM `tblitem` WHERE `billno`='$pitemBill'";
$record=mysqli_query($conn,$sql);

while($row=mysqli_fetch_array($record)) {
    $btotal = $row["countid"];
}
if($btotal==1){
    $del1=mysqli_query($conn,"DELETE FROM `tbltransaction` WHERE `billno`='$pitemBill'");
}
$del=mysqli_query($conn,"DELETE FROM `tblitem` WHERE `itemid`='$product'");

if($del && $del1)
{
    echo "<script>alert('Record Deleted')</script>";
    //header('Location:category.php');
}

/*$id=$_POST['id'];
$jsonData = array();
$querySelect="DELETE FROM `tblproduct` WHERE `pid`='$id' ";
$recordSelect=mysqli_query($conn,$querySelect);
while($row = mysqli_fetch_array($recordSelect,MYSQL_ASSOC)){
    array_push($jsonData,$row);
}
echo json_encode($jsonData);*/

?>
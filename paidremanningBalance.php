<?php
include_once "config.php";

$noBill =$_POST["noBill"];
$custMob=$_POST["custMob"];
$custBal=$_POST["custBal"];
$jsonArraywise=array();
$sql="SELECT `billno` FROM `tbltransaction` WHERE `billno`='$noBill'";

$result=mysqli_query($conn,$sql);

    // Return the number of rows in result set
    $rowcount=mysqli_num_rows($result);
    if($rowcount<=0){
        echo json_encode('bill no is not valid');
        return;
    }else{
        $query = "SELECT `cid`,balanceAmt FROM `phonebook` WHERE `phonenumber`='$custMob'";
        $search_result = mysqli_query($conn, $query);

while( $row = mysqli_fetch_array( $search_result )) {
    $balanceAmt=$row['balanceAmt'];
    $bacidt=$row['cid'];
}$custBal1=$balanceAmt-$custBal;
        $sql1 ="UPDATE `phonebook` SET `balanceAmt`='$custBal1' WHERE `phonenumber`='$custMob'";

        $result1 = mysqli_query($conn, $sql1);
        $sql1 ="INSERT INTO `tbltransaction`( `billno`, `tdate`, `statusQT`,custid) VALUES ('$noBill',now(),'FP','$bacidt')";

        $result1 = mysqli_query($conn, $sql1);
        if($result1){
            $querySelect="SELECT `cid`,balanceAmt FROM `phonebook` WHERE `phonenumber`='$custMob'";
            $recordSelect=mysqli_query($conn,$querySelect);
            while($row = mysqli_fetch_array($recordSelect,MYSQL_ASSOC)){
                array_push($jsonArraywise,$row);


            }
            echo json_encode($jsonArraywise);
        }else{
            echo json_encode('Payment Not Done');
        }
    }

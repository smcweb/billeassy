<?php

include "config.php";
$id=$_POST['id'];
$ibankName=$_POST['bankName'];
$iAccount_No=$_POST['Account_No'];
$iifsc_code=$_POST['ifsc_code'];
$query = "UPDATE `shop` SET `BankAccountNumber`='$iAccount_No',`BankName`='$ibankName',`IFSCCode`='$iifsc_code' WHERE id='$id'";
$query_run= mysqli_query($conn,$query);
if ($query_run)
{
    echo json_encode('Bank Details sucessfully Added');
}
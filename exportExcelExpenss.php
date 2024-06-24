<?php
include "config.php";
$exp_by=$_GET['exp_by'];
$date = date('H:i:s Y-m-d');
$setSql = "SELECT  expid,exp_date,exp_name,exp_by,exp_amount  FROM tblexpences WHERE exp_by='$exp_by'";
$setRec = mysqli_query($conn, $setSql);

$columnHeader = '';
$columnHeader = "Sr NO" . "\t" . "Date" . "\t" . "Name" . "\t". "Person" . "\t". "Amount" . "\t";

$setData = '';

while ($rec = mysqli_fetch_row($setRec)) {
    $rowData = '';
    foreach ($rec as $value) {
        $value = '"' . $value . '"' . "\t";
        $rowData .= $value;
    }
    $setData .= trim($rowData) . "\n";
}


header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=$exp_by$date.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo ucwords($columnHeader) . "\n" . $setData . "\n";

?>
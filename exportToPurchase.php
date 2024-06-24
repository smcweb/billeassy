<?php
include "config.php";
$exp_by='';
$date = date('H:i:s Y-m-d');
$setSql = "SELECT `intId`,`poNo`,`supplierName`,`supplierNo`,`supplierAdd`,`grandTotal`,`cgst`,`sgst`,`igst`,`billimage`,`decProduct`,`subject`,`status` FROM `supplierpurchase` ";
$setRec = mysqli_query($conn, $setSql);

$columnHeader = '';
$columnHeader = "Sr NO" . "\t" . "PO Number" . "\t" . "Supplier Name" . "\t". "Supplier No" . "\t". "Supplier Add" . "\t". "Grand Total" . "\t". "CGST" . "\t". "SGST" . "\t". "IGST" . "\t". "Bill Image" . "\t". "DESC Product" . "\t". "Subject" . "\t". "Status" . "\t";

$setData = '';

while ($rec = mysqli_fetch_row($setRec)) {
    $rowData = '';
    foreach ($rec as $value) {
        $value = '"' . $value . '"' . "\t";
        $rowData .= $value;
    }
    $setData .= trim($rowData) . "\n";
    $exp_by=$rec['supplierName'];
}


header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=$exp_by$date.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo ucwords($columnHeader) . "\n" . $setData . "\n";

?>
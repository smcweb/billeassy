<?php
include "config.php";
$id=$_POST['myDataVar'];
$a=0;
for( $i = 0; $i<count($id); $i++ ) {
    $a =$id[$i]['Product'];
    $query = "INSERT INTO `pro`( `product`) VALUES ('$a')";
    $record = mysqli_query($conn, $query);
}

echo json_encode($a);
return;
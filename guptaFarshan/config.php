<?php

//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname = "billeasy";

$servername = "182.50.133.82:3306";
$username = "billeasy";
$password = "billeasy@123";
$dbname = "billeasy";

$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
 if (!$conn)
 {
    die("Connection failed: " . mysqli_connect_error());
 }
//echo('connected');


	
?>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "billeasy";

//$servername = "148.72.232.169:3306 ";
//$username = "billeasy";
//$password = "billeasy@123";
//$dbname = "billeasy";
//$servername = "localhost";
///$username = "root";
//$password = "";
//$dbname = "latestfurniturebill";

$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
 if (!$conn)
 {
    die("Connection failed: " . mysqli_connect_error());
 }
//echo('connected');


	
?>

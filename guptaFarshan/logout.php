<?php
include('config.php');
session_start();
// $_SESSION['username']="";
session_destroy();

header('location:login.php');
?>
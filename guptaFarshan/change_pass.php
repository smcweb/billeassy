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
	$shopid = $_SESSION['shopid'];
		// echo "<script>alert('session mentain')</script>";
}
$sql = "SELECT * FROM `shop` WHERE `shopid` = '$shopid'";
$query = mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$id=$row['id'];
   
   $shopid=$row['shopid'];
	
	
	$opassword=$row['password'];
	}
	if(isset($_POST['update']))
{
$cppassword=$_POST['cppassword'];
$ppassword=$_POST['ppassword'];
	$id=$_SESSION['shopidu'];

 $sql="UPDATE `shop` SET `password`='$cppassword' WHERE `id`='$id'"; 
	$query = mysqli_query($conn,$sql);
	if(!$query)
	{
		
		echo "<script>alert('Updation Error')</script>";
	}
	else
	{
		
		echo "<script>alert('Password changed');</script>";

	}
	
}


?>

<!DOCTYPE HTML>
<html>
<head>
<title>EasyBilling| Profile :: Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Modern Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- Graph CSS -->
<link href="css/lines.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<script src="js/jquery.min.js"></script>
<!----webfonts--->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
<!---//webfonts--->  
<!-- Nav CSS -->
<link href="css/custom.css" rel="stylesheet">
<!-- Metis Menu Plugin JavaScript -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<!-- Graph JavaScript -->
<script src="js/d3.v3.js"></script>
<script src="js/rickshaw.js"></script>
</head>
<body>
<div id="wrapper">
    <!-- Navigation -->
       <?php
           include_once "header.php";
	   ?>
	
 <div id="page-wrapper">		
<div class="content_bottom">
	 <div class="col-md-8 span_3">
		
				 <form role="form" class="form-horizontal" method="post">
  <div class="bs-example4" data-example-id="simple-responsive-table">
    <div class="table-responsive">
      <table class="table">				 
	
	    <tr><td>
	  	 <div class="form-group has-success">
		
      <input type="text" class="form-control1" placeholder="Enter Old password" name="ppassword" value="<?php if(isset($opassword)){echo $opassword;}?>" autofocus="" >
	  </div></td></tr>
	  <tr>
	  	<td> <div class="form-group has-success">
      <input type="password" class="form-control1" placeholder="New Password" name="cppassword" autofocus="">
	  </div></td></tr>
	  <tr><td colspan="2">
      <button class="btn btn-lg btn-success1 btn-block" type="submit" name="update" >Change</button>
	  </td></tr>
	    <tr>
   
	  </tr></table></div></div>
	  
  </form>
                          						
					
	 </div>
					   
						 
						<div class="clearfix"> </div>
</div>
 </div>
		<?php
	include_once "includes/footer.php"; ?>
      
      <!-- /#page-wrapper -->
   </div>
    <!-- /#wrapper -->
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
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
$shopId=$_SESSION['shopidu'];
?>
<!DOCTYPE HTML>
<html>
<head>
<title>EasyBilling| Home :: Billing</title>
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
			<?php
	         include_once "top.php";
			  ?>
       
		
    <div class="content_bottom">
     <div class="col-md-8 span_3">
	 <div class="panel-heading">
                    <h4 class="panel-title">Today's Transaction</h4>
                </div>
		  <div class="bs-example1" data-example-id="contextual-table">
		    <table class="table">
		      <thead>
		        <tr>
		          <th style="color:black;text-align:center">Sr.</th>
		          <th style="color:black;text-align:center">Customer</th>
		          <th style="color:black;text-align:center">Mobile</th>
		          <th style="color:black;text-align:center">Bill Amount</th>
		          <th style="color:black;text-align:center">Date</th>
		        </tr>
		      </thead>
		      <tbody>
			  <tr class="active">
			  <form class="navbar-form navbar-right" method="post">
			  <div class="input-group">
              <input  class="form-control1 input-search" type="text"  id="sreach" placeholder="Search By Name & Mobile No." name="search">
                <a href=""><button class="btn btn-success" type="submit" name="submit"><i class="fa fa-search"></i></button></a>
			</div>
			</form></tr>
				  <?php
				  if(isset($_POST['search']))
									{
										
                                        $search=$_POST['search'];
                                        $query="";
                                 $sql = "SELECT `name`, `phonenumber`, `atotal`,`tdate` FROM `tbltransaction`,`phonebook` WHERE  (`tbltransaction`.`custid`=`phonebook`.cid) && (`name`='$search' || `phonenumber`='$search') &&  `shopid`='$shopId'";
                                        $query = mysqli_query($conn,$sql);
$sr=0;

                                    }
									else{
			$todate=date('Y-m-d');
                                       // echo "<script>alert('$todate')</script>";
			 $query="";
  $sql="SELECT `name`, `phonenumber`, `atotal`,`tdate` FROM `tbltransaction`,`phonebook` WHERE  `tbltransaction`.`custid`=`phonebook`.cid && `tdate` LIKE '%$todate%' AND tbltransaction.`shopid`='$shopId'";
  $query=mysqli_query($conn,$sql);
$sr=0;
									}
									if($query)
									{
				  while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
			   {
				  $sr++; 
			   $name=$row['name'];
			   $phonenumber=$row['phonenumber'];
			   $amt=$row['atotal'];
			   if(isset($_POST['search']))
			   {
				   $tdate=$row['tdate'];
			   }
			  ?>
		        <tr class="danger">
		          <th scope="row"><?php echo $sr; ?></th>
		          <td><?php echo $name; ?></td>
		          <td><?php echo $phonenumber; ?></td>
		          <td><?php echo $amt; ?></td>
				  <td><?php if(isset($tdate)){ echo $tdate;} ?></td>
		        </tr>
									<?php } }?>
		      </tbody>
		    </table>
		   </div>
	   </div>
	   
		  <div class="col-md-4 span_4">
	<?php include('includes/rsidebar.php');?>
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
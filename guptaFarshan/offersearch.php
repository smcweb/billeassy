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
$shopid=$_SESSION['shopidu'];
?>
<!DOCTYPE HTML>
<html>
<head>
<title>EasyBilling| Offers :: Billing</title>
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
           include_once "header.php"
	   ?>
	
        <div id="page-wrapper">
			<?php
	         include_once "top.php"
			  ?>
       
		
    <div class="content_bottom">
     <div class="col-md-8 span_3">
		  <div class="bs-example1" data-example-id="contextual-table">
		   
			  <!--form class="navbar-form navbar-right" method="post">
			  <div class="input-group">
              <input  class="form-control1 input-search" type="text"  id="sreach" placeholder="Search By offer name" name="search">
                 <a href=""><button class="btn btn-success" type="submit" name="submit"><i class="fa fa-search"></i></button></a>
			</div>
			</form-->
			  <form method="POST">
				<div class="input-group">
				<input  class="form-control1 input-search"  type="text"  id="txt_sreach" placeholder="Search By Offer" name="txt_search">
				 <span class="input-group-btn">	
					 <button class="btn btn-success" type="hidden" name="submit"><i class="fa fa-search"></i></button></span>
				</div>
				<!--input type="hidden" name="txt_search"-->
				</form>
			  
			  <table class="table">
		      <thead>
				  <tr style="text-align:center">
					  <th style="text-align:center;color:black">Sr.No.</th>
		          <th style="text-align:center;color:black">Offer Id</th>
		          <th style="text-align:center;color:black">Offer Name</th>
		          <th style="text-align:center;color:black">Discount(%)</th>
		          <th style="text-align:center;color:black">Valid Date</th>                  
		        </tr>
		      </thead>
		      <tbody>
			  <tr class="active">
			  </tr>
				  <?php
				  if(isset($_POST['txt_search']))
									{
										
                                        $search=$_POST['txt_search'];
                                        $queryset="";
                                 		$sql = "SELECT * FROM tbloffer WHERE `offername`='$search' AND shopid='$shopid'";
                                        $queryset = mysqli_query($conn,$sql);
$sr=0;

                                    }
									else
									{
			
			 $queryset="";
   $result2 = "SELECT * FROM tbloffer WHERE  shopid='$shopid'";
                  $queryset=mysqli_query($conn,$result2);
$sr=0;
									}
				  while( $row = mysqli_fetch_array( $queryset ))
		  {
			  $sr++;
			   $id=$row['offerid'];
					  echo"<tr style='color:black;text-align:center'>";
			echo "<td style='color:black;text-align:center'>".$sr."</td>";
			   echo "<td style='color:black;text-align:center'>".$row['offerid']."</td>";
             echo "<td style='color:black;text-align:center'>".$row['offername']."</td>";
              echo"<td style='color:black;text-align:center'>".$row['offerPercent']."</td>";
              echo"<td style='color:black;text-align:center'>".$row['validDate']."</td>";
	     
		   echo"</tr>";
          }
?>
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
	include_once "footer.php" ?>
      
      <!-- /#page-wrapper -->
   </div>
    <!-- /#wrapper -->
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
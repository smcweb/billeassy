


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
	$shopid = $_SESSION['shopid'];
		// echo "<script>alert('session mentain')</script>";
}

$sql = "SELECT * FROM `shop` WHERE `shopid` = '$shopid'";
$query = mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$id=$row['id'];
    $shopname=$row['shopname'];
   $shopid=$row['shopid'];
	$address=$row['address'];
	$email=$row['email'];
	$phone=$row['phone'];
	$shoptype=$row['shoptype'];
	$location=$row['logo'];
	$gst=$row['gst'];
	$ubillTerms=$row['BillTerms'];
	$fid=$row['fid'];
	$s1="SELECT fyear from financialyear where `fid`='$fid'";
	$q1=mysqli_query($conn,$s1);
	$r1=mysqli_fetch_row($q1);
	$fyear=$r1[0];
	$opassword=$row['password'];
	}
if(isset($_POST['update']))
{

	$shopname=$_POST['shopname'];
	$address=$_POST['address'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$shoptype=$_POST['shoptype'];
	$gst=$_POST['gst'];
	 $billTerms=$_POST['BillTerms'];
	$fyear=$_POST['fyear'];
	 $sql="SELECT `fid` FROM `financialyear` WHERE `fyear`='$fyear'";
	$query = mysqli_query($conn,$sql);
	while($r=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$efid=$r['fid'];
	}
	 
	$shopid=$_POST['shopid'];
	

		$sp=0;
	$sql="SELECT `shopid` FROM `shop` WHERE `shopid`='$shopid'";
	$query = mysqli_query($conn,$sql);
	if($query)
	{
	$r=mysqli_fetch_row($query);
	}
$sp=$r[0];	
if($sp!=0)
{
	echo "<script>alert('Sorry Shop ID is allready taken, Please change shopid');</script>";
}
if(isset($_FILES["logo"]))
{
  $file=$_FILES['logo']['tmp_name'];
  $image= addslashes(file_get_contents($_FILES['logo']['tmp_name']));
  $image_name= addslashes($_FILES['logo']['name']);
  $image_size= getimagesize($_FILES['logo']['tmp_name']);

  
    if ($image_size==FALSE) 
    {
    
      echo "That's not an image!";
      
    }
    else
    {
      
     move_uploaded_file($_FILES["logo"]["tmp_name"],"img/" . $_FILES["logo"]["name"]);
      
      $location=$_FILES["logo"]["name"];
	}
}
// $uploaddir = 'img/';
// $uploadfile = $uploaddir . basename($_FILES['logo124']['name']);

// echo "<p>";

// if (move_uploaded_file($_FILES['logo124']['tmp_name'], $uploadfile)) {
  // echo "File is valid, and was successfully uploaded.\n";
// } else {
   // echo "Upload failed";
// }



 $sql="UPDATE `shop` SET `shopid`='$shopid',`shopname`='$shopname',`phone`='$phone',`email`='$email',`address`='$address',`shoptype`='$shoptype',`gst`='$gst',`logo`='$location',`BillTerms`='$billTerms',`fid`='$fid' WHERE `id`='$id'"; 
	$query = mysqli_query($conn,$sql);
	if(!$query)
	{
		
		echo "<script>alert('Updation Error')</script>";
	}
	else
	{
		
		echo "<script>alert('Details updated');</script>";
		
	
	$_SESSION['logedin'] = True;
	$_SESSION['shopid']=$shopid;
	
	$_SESSION['username']=$shopname;
	$_SESSION['fid']=$efid;
	
		echo '<script> window.location.href = "index.php";</script>';
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
		<div class="panel-heading">
			<h4 class="panel-title">Update Profile</h4><br>
		</div>
		 <form role="form" class="form-horizontal" method="post" enctype="multipart/form-data" >
      <p> <h3>Edit your Shop details below </h3></p>
	  <div class="bs-example4" data-example-id="simple-responsive-table">
    <div class="table-responsive">
      <table class="table">
	<tr><td>
								<div class="form-group has-success">
								<input type="text" class="form-control1 form-control_2 input-sm" placeholder="Shop Name" name="shopname" value="<?php if(isset($shopname)){echo $shopname;}?>" autofocus="" required>
								 </div></td>
	  <td><div class="form-group has-success">
      <input type="text" class="form-control1 form-control_2 input-sm" placeholder="Shop Id" name="shopid" value="<?php if(isset($shopid)){echo $shopid;}?>" autofocus="" required>
	  </div>
								 </td></tr>
							<tr>	<td> <div class="form-group has-success">
								
      <input type="email" class="form-control1 form-control_2 input-sm" placeholder="Email" name="email" value="<?php if(isset($email)){echo $email;}?>" autofocus="" >
	 
								 </div></td>
								<td> <div class="form-group has-success">
								
								
	   <input type="text" class="form-control1 form-control_2 input-sm" pattern="[7-9]{1}[0-9]{9}"  maxlength="10" placeholder="Mobile Number" name="phone" value="<?php if(isset($phone)){echo $phone;}?>" autofocus="">
	   </div></td></tr>
								
								 <tr><td><div class="form-group has-success">
								
								
	    <input type="text" class="form-control1 form-control_2 input-sm" placeholder="shop type" name="shoptype" value="<?php if(isset($shoptype)){echo $shoptype;}?>" autofocus="" >
		
								 </div></td>
							
							<td>	 <div class="form-group has-success">
				
								
      <input type="text" class="form-control1 form-control_2 input-sm" placeholder="GST number" name="gst" value="<?php if(isset($gst)){echo $gst;}?>" autofocus="" >

								 </div></td></tr>
								<tr> <td><div class="form-group has-success">
							
								
	    <input type="file" class="form-control1 form-control_2 input-sm" name="logo" autofocus="" value="<?php if(isset($logo)){echo $logo;}?>">
		</div></td>
								
								<td> <div class="form-group has-success">
      <input type="text" class="form-control1 form-control_2 input-sm" placeholder="Address" value="<?php if(isset($address)){echo $address;}?>" name="address" autofocus="" >
	  </div></td></tr>
							
							 <tr> <td><div class="form-group has-success">
						<h3 style="color:red;">	Select Finantial year </h3>
		</div></td>	<td colspan="2">		
		<div class="form-group has-success">
							
								
		  <select class="form-control1 form-control_2 input-sm" name="fyear" value="<?php if(isset($fyear)){echo $fyear;}?>" autofocus="" >
		   <option value="<?php if(isset($fyear)){echo $fyear;}else{ echo"Select Financial Year";}?>"> <?php if(isset($fyear)){echo $fyear;}else{ echo"Select Financial Year";}?> </option>
		  <?php 
		 
		
		 echo $sql="SELECT * FROM `financialyear`";
		  $query=mysqli_query($conn,$sql);
		  while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
		  {
			 $fid = $row['fid'];
			 $fyear = $row['fyear'];
			 // $fdate=$row['fromDate'];
			 // $tdate=$row['toDate'];
			  // $fyear=$fdate.' '.'to'.' '.$tdate;
		  ?>
		  <option>   <?php if(isset($fyear)){echo $fyear;}else{ echo"Select Financial Year";}?>   </option>
		  <?php } ?>
		  
		  </select>
		
								 </div></td></tr>
								 <tr><td colspan="2">		
							
								
		<div class="form-group has-success">
      <input type="text" class="form-control1 form-control_2 input-sm" placeholder="BillTerms" value="<?php if(isset($ubillTerms)){echo $ubillTerms;} else{echo "BillTerms";}?>"  name="BillTerms" autofocus="" >
	  </div>
								 </td></tr>
     <!-- <div class="radios">
        <label for="radio-01" class="label_radio">
            <input type="radio" checked=""> Male
        </label>
        <label for="radio-02" class="label_radio">
            <input type="radio"> Female
        </label>
	  </div>-->
	
	
	   
	
	  <tr><td colspan="2">
      <button class="btn btn-lg btn-success1 btn-block" type="submit" name="update" >Update</button>
	  </td></tr>
	  </table></div></div>
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
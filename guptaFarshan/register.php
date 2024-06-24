<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php include('config.php');
if(isset($_POST['submit']))
{
	$fid=0;
	$shopname=$_POST['shopname'];
	$address=$_POST['address'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$shoptype=$_POST['shoptype'];
	$gst=$_POST['gst'];
	$billterms=$_POST['billterms'];
	$fyear=$_POST['fyear'];
	 $sql="SELECT `fid` FROM `financialyear` WHERE `fyear`='$fyear'";
	$query = mysqli_query($conn,$sql);
	while($r=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$fid=$r['fid'];
	}
	
	
	$shopid=$_POST['shopid'];
	$password=$_POST['password'];
	$cpassword=$_POST['cpassword'];
	
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
// $uploaddir = 'img/';
// $uploadfile = $uploaddir . basename($_FILES['logo124']['name']);

// echo "<p>";

// if (move_uploaded_file($_FILES['logo124']['tmp_name'], $uploadfile)) {
  // echo "File is valid, and was successfully uploaded.\n";
// } else {
   // echo "Upload failed";
// }
if($password != $cpassword)
	{
	 echo "<script>alert('password and confirm password not match')</script>";	
	}
	else{
		
		 $sql = "SELECT `shopid`, `password` FROM `shop` WHERE `shopid` = '$shopid' && `password` = '$password' ";
 $query = mysqli_query($conn,$sql);
$c=0;

while($row=mysqli_fetch_array($query,MYSQLI_ASSOC)) 
{
	$c=1;
	$shopid=$row['shopid'];
 $password=$row['password'];
	
}
	if($c == 1)
	{
		echo "<script>alert('shop name is allready Registed')</script>";
	}	
else{	
 $sql="INSERT INTO `shop`(`id`, `shopid`, `password`, `shopname`, `phone`, `email`, `address`, `shoptype`, `gst`, `logo`, `BillTerms`, `fid`) VALUES ('','$shopid','$password','$shopname','$phone','$email','$address','$shoptype','$gst','$location','$billterms','$fid')"; 
	$query = mysqli_query($conn,$sql);
	if(!$query)
	{
		
		echo "<script>alert('Insersion Error')</script>";
	}
	else
	{
		
		echo "<script>alert('Shop is Registered successfully')</script>";
		header('location:login.php');
		echo "<script>window.open('login.php')</script>";
	}
	}
	}
}
?>


<!DOCTYPE HTML>
<html>
<head>
<title>Easy Billing | Register :: Billing</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Modern Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<script src="js/jquery.min.js"></script>
<!----webfonts--->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
<!---//webfonts--->  
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
</head>
<body id="login">
  <br>
	<br>
  <h2 class="form-heading">Register</h2>
  <form class="form-signin app-cam" method="post" enctype="multipart/form-data" action="register.php">
      <p>Enter your personal details below</p>
      <input type="text" class="form-control1" placeholder="Shop Name" name="shopname" autofocus="" required>
      <input type="text" class="form-control1" placeholder="Address" name="address" autofocus="" required>
      <input type="email" class="form-control1" placeholder="Email" name="email" autofocus="" required><br><br>
	   <input type="text" class="form-control1" pattern="[7-9]{1}[0-9]{9}"  maxlength="10" placeholder="Mobile Number" name="phone" autofocus="" required>
	    <input type="text" class="form-control1" placeholder="shop type" name="shoptype" autofocus="" required>
      <input type="text" class="form-control1" placeholder="GST number" name="gst" autofocus="" required>
	    <input type="file" class="form-control1"  name="logo" autofocus="" required><br>
		 <textarea class="form-control1" placeholder="Bill Terms" name="billterms" autofocus="" required>Bill Terms </textarea> <br><br>
		  <select class="form-control1" name="fyear" autofocus="" required>
		   <option> Select Financial Year </option>
		  <?php 
		  include('config.php');
		 echo $sql="SELECT * FROM `financialyear` WHERE 1";
		  $query=mysqli_query($conn,$sql);
		  while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
		  {
			 $fid = $row['fid'];
			 $fyear = $row['fyear'];
			 // $fdate=$row['fromDate'];
			 // $tdate=$row['toDate'];
			  // $fyear=$fdate.' '.'to'.' '.$tdate;
		  ?>
		  <option> <?php echo $fyear; ?>      </option>
		  <?php }?>
		  </select><br>
     <!-- <div class="radios">
        <label for="radio-01" class="label_radio">
            <input type="radio" checked=""> Male
        </label>
        <label for="radio-02" class="label_radio">
            <input type="radio"> Female
        </label>
	  </div>-->
	  <p> Enter your account details below</p>
      <input type="text" class="form-control1" placeholder="User Name" name="shopid" autofocus="" required>
      <input type="password" class="form-control1" placeholder="Password" name="password" required>
      <input type="password" class="form-control1" placeholder="Re-type Password" name="cpassword" required>
      <label class="checkbox-custom check-success">
          <input type="checkbox" value="agree this condition" id="checkbox1" required> <label for="checkbox1">I agree to the Terms of Service and Privacy Policy</label>
      </label>
	
      <button class="btn btn-lg btn-success1 btn-block" type="submit" name="submit" >Submit</button>
      <div class="registration">
          Already Registered.
          <a class="" href="login.php">
              Login
          </a>
      </div>
  </form>
   <div class="copy_layout login register">
      <p>Copyright &copy; 2015 Modern. All Rights Reserved | Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
   </div>
</body>
</html>

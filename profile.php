
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
	$shopidoi = $_SESSION['shopid'];
		// echo "<script>alert('session mentain')</script>";
}
$shopidu=$_SESSION['shopidu'];
$fid=$_SESSION['fid'];
//echo "<script>alert('$shopidu')</script>";
$sql = "SELECT * FROM `shop` WHERE `shopid` = '$shopidoi'";
$query = mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$id=$row['id'];
    $shopname=$row['shopname'];
   $shopid=$row['shopid'];
	$address=$row['address'];
	$address=$row['address'];
	$BankAccountNumber=$row['BankAccountNumber'];
	$BankName=$row['BankName'];
	$IFSCCode=$row['IFSCCode'];
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
	 $BankName=$_POST['BankName'];
	$BankAccountNumber=$_POST['BankAccountNumber'];
	$IFSCCode=$_POST['IFSCCode'];
	$fyear=$_POST['fyear'];
   // echo "<script> alert('$fyear');</script>";
   $querySelect="SELECT * FROM `shop` WHERE `gst`='$gst'";
    $recordSelect=mysqli_query($conn,$querySelect);
    $rowcount=mysqli_num_rows($recordSelect);
    /*if($rowcount>0 || $gst=='' ){
        echo "<script> alert('GST No is available, Please Check GST No');</script>";
        echo '<script> window.location.href = "profile.php";</script>';
        return;
    }*/if($fyear=='Select Financial Year'){
    echo "<script> alert('Select Financial Year');</script>";
    echo '<script> window.location.href = "profile.php";</script>';
    return;
}
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



 $sql="UPDATE `shop` SET `shopid`='$shopid',`shopname`='$shopname',`phone`='$phone',`email`='$email',`address`='$address',`shoptype`='$shoptype',`gst`='$gst',`logo`='$location',`BillTerms`='$billTerms',`fid`='$fyear',`BankAccountNumber`='$BankAccountNumber',`BankName`='$BankName',`IFSCCode`='$IFSCCode' WHERE `id`='$shopidu'";
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
	
		echo '<script> window.location.href = "profile.php";</script>';
	}
	}
	

?>

<!DOCTYPE HTML>
<html>
<head>
<title>EasyBilling| Profile :: Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css">
</head>
<body>
<div id="wrapper">
    <!-- Navigation -->
       <?php
           include_once "header.php";
	   ?>
    <style>
        ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable ui-resizable{
            top:55% !important;
        }
        .form-control-1 {
            background: none;
            margin: 7px 0px;
            background: none !important;
            border: 1px solid #9E9E9E !important;
            border-radius: 0px !important;
            box-shadow: none !important;
        }.ui-widget-header {

                     background: rgb(6, 217, 149) !important;
                 }
    </style>
 <div id="page-wrapper">		
<div class="content_bottom">
	 <div class="col-md-8 span_3">
		<div class="panel-heading">
			<h4 class="panel-title">Update Profile</h4><br>
		</div>
         <button type="button" class="btn btn-success" id="mybtn">Change Password</button>
         <p STYLE="FLOAT: RIGHT;
        margin: -5% 62%;"><a href="javascript:void(null);" onclick="showDialog();"  class="btn btn-success">Enter Bank Detail</a></p>
<!--         <p STYLE="FLOAT: RIGHT;
        margin: -5% 39%;"><a href="javascript:void(null);" onclick="showDialog14();"  class="btn btn-success">Enter employee Detail</a></p>
-->		 <form role="form" class="form-horizontal" method="post" enctype="multipart/form-data" >
      <p> <h3>Edit your Shop details below </h3></p>
	  <div class="bs-example4" data-example-id="simple-responsive-table">
    <div class="table-responsive">
      <table class="table">
	<tr><td>
								<div class="form-group has-success">
								<input type="text" class="form-control1 form-control_2 input-sm" placeholder="Shop Name" name="shopname" value="<?php if(isset($shopname)){echo $shopname;}?>" autofocus="" required>
								 </div></td>
	  <td><div class="form-group has-success">
      <input type="text" class="form-control1 form-control_2 input-sm" placeholder="Shop Id" name="shopid" id="shopid-1" value="<?php if(isset($shopid)){echo $shopid;}?>" autofocus="" required>
	  </div>
								 </td></tr>
							<tr>	<td> <div class="form-group has-success">
								
      <input type="email" class="form-control1 form-control_2 input-sm" placeholder="Email" name="email" value="<?php if(isset($email)){echo $email;}?>" autofocus="" >
	 
								 </div></td>
								<td> <div class="form-group has-success">
								
								
	   <input type="text" class="form-control1 form-control_2 input-sm"   maxlength="25" placeholder="Mobile Number" name="phone" value="<?php if(isset($phone)){echo $phone;}?>" autofocus="">
	   </div></td></tr>
								
								 <tr><td><div class="form-group has-success">
								
								
	    <input type="text" class="form-control1 form-control_2 input-sm" placeholder="shop type" name="shoptype" value="<?php if(isset($shoptype)){echo $shoptype;}?>" autofocus="" >
		
                                         </div></td>
							
							<td>	 <div class="form-group has-success">
				
								
      <input type="text" class="form-control1 form-control_2 input-sm" placeholder="GST number" name="gst" id='gst-id' onblur="checkGstDuplicate()" value="<?php if(isset($gst)){echo $gst;}?>" autofocus="" >

								 </div><p id="chart-id1" style="color: #ef553a;"></p> </td></tr>
								<tr> <td><div class="form-group has-success">
							
								
	    <input type="file" class="form-control1 form-control_2 input-sm" name="logo" autofocus="" value="<?php if(isset($logo)){echo $logo;}?>">
		</div></td><td><img src="img/<?php echo $location;?>" STYLE="    width: 125px;
    height: 80PX;"></td>
								
					</tr>
							
							 <tr> <td><div class="form-group has-success">
						<h3 style="color:red;">	Select Financial year </h3>
		</div></td>	<td colspan="2">		
		<div class="form-group has-success">

		  <select class="form-control1 form-control_2 input-sm" name="fyear" autofocus="" >

              <option value="Select Financial Year">Select Financial Year</option>
		  <?php
          $sql="SELECT `fid` FROM `shop` WHERE `shopid`='$shopid'";
          $query=mysqli_query($conn,$sql);
          while($row=mysqli_fetch_array($query,MYSQLI_ASSOC)) {
              $ffid= $row['fid'];
          }
		 $sql="SELECT * FROM `financialyear`";
		  $query=mysqli_query($conn,$sql);
		  while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
		  {
			 $fid = $row['fid'];
			 $fyear = $row['fyear'];
			 // $fdate=$row['fromDate'];
			 // $tdate=$row['toDate'];
			  // $fyear=$fdate.' '.'to'.' '.$tdate;
              if ($fid==$ffid){
		  ?>

              <option value="<?php echo $fid;  ?>" <?php  echo "selected"; ?>><?php   echo $fyear;  ?></option>

		  <?php }else{?>
                  <option value="<?php echo $fid;  ?>"><?php   echo $fyear;  ?></option>
		  <?php }}?>

		  </select>
		
								 </div></td></tr>
								 <tr>			<td> <div class="form-group has-success">
                                             <input type="text" class="form-control1 form-control_2 input-sm" placeholder="Address" value="<?php if(isset($address)){echo $address;}?>" name="address" autofocus="" >
                                         </div></td><td colspan="2">
							
								
		<div class="form-group has-success">
      <input type="text" class="form-control1 form-control_2 input-sm" placeholder="BillTerms" value="<?php if(isset($ubillTerms)){echo $ubillTerms;} else{echo "BillTerms";}?>"  name="BillTerms" autofocus="" >
	  </div>
								 </td></tr>
          <tr>			<td> <div class="form-group has-success">
                                             <input type="text" class="form-control1 form-control_2 input-sm" placeholder="Bank Name" value="<?php if(isset($BankName)){echo $BankName;}?>" name="BankName" autofocus="" >
                                         </div></td><td colspan="2">


		<div class="form-group has-success">
      <input type="text" class="form-control1 form-control_2 input-sm" placeholder="Bank Account Number" value="<?php if(isset($BankAccountNumber)){echo $BankAccountNumber;} else{echo "BankAccountNumber";}?>"  name="BankAccountNumber" autofocus="" >
	  </div>
								 </td></tr>
          <tr>			<td> <div class="form-group has-success">
                                             <input type="text" class="form-control1 form-control_2 input-sm" placeholder="IFSC Code" value="<?php if(isset($IFSCCode)){echo $IFSCCode;}?>" name="IFSCCode" autofocus="" >
                                         </div></td><td colspan="2">


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


    <!--<div  id="myModal">
        <input type="text" name="noBill" id="noBill" placeholder="Enter Bill Number " style=" margin: 0px 27px;
    height: 26px;
    width: 246px;">
        <input type="text"  id="custMob" name="custMob" style="    margin: 7px 27px;
    height: 26px;width: 246px;">

        <input type="text" name="custBal" id="custBal" style="    margin: 7px 27px;
    height: 26px;width: 246px;">
    </div>-->
    <div id="myModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Change Password</h2>
        </div>
        <div class="modal-body">
            <input type="text"  id="custMob" name="custMob" style="    margin: 7px 27px;
    height: 26px;width: 246px;" readonly>

            <input type="text" name="old-password" id="old-password" style="    margin: 7px 27px;
    height: 26px;width: 246px;" placeholder="Old password">
            <input type="text" name="new-password" id="new-password" style="    margin: 7px 27px;
    height: 26px;width: 246px;" placeholder="New Password">
        </div>
        <div class="modal-footer">
           <!-- <h3>Modal Footer</h3>-->
            <button type="button" class="btn btn-success" id="mybtn-id" onclick="updatePassword()">Update Password</button>
        </div>
    </div>

</div>

    <style>

        .ui-dialog.ui-widget.ui-widget-content.ui-corner-all.ui-draggable.ui-resizable {
            left: 707px !important;
            top: 7% !important;

        }
    </style>

    <div id="dialog-modal" title="Bank details" style="display: none;">


        <input type="text" class="form-control form-control-1" id="bnk-Name" placeholder="BANK NAME">
        <input type="number" class="form-control form-control-1" id="Account-No" placeholder="ACCOUNT NUMBER">
        <input type="text" class="form-control form-control-1" id="ifsc-code" placeholder="IFSC CODE">
        <button type="button" class="btn btn-success" onclick="saveinsertData()">Success</button>

    </div> <div id="dialog-modal-14" title="Employee details" style="display: none;">


        <input type="text" class="form-control form-control-1" id="emp-Name" placeholder="Emp Name">
        <input type="number" class="form-control form-control-1" id="emp-No" placeholder="Emp contact">
        <textarea rows="4" cols="50" class="form-control form-control-1" id="emp-add" placeholder="Emp Address"></textarea>
        <input type="text" class="form-control form-control-1" id="user-Nme" placeholder="User Name">
        <input type="password" class="form-control form-control-1" id="password" placeholder="password">
        <button type="button" class="btn btn-success" onclick="saveinsertData14()" >Success</button>

    </div>
    <script>
        function saveinsertData() {
            var bankName=$("#bnk-Name").val();
            var Account_No=$("#Account-No").val();
            var ifsc_code=$("#ifsc-code").val();
            var id=<?php echo json_encode("$shopidu")?>;
           // alert(id)
if(bankName =="" || Account_No =="" || ifsc_code =="" ){
    alert('Please Fill Details give input')
    return
}
            $.ajax({
                type: "post",
                url: "postBankdetails.php",
                dataType:"json",
                data: {'bankName':bankName,"Account_No":Account_No,"ifsc_code":ifsc_code,"id":id},
                async:false,
                success: function(test){
                    alert(test)
                    window.location.href='profile.php';
                },
                error: function(){
                    alert('failure');
                }
            });
        }
        function saveinsertData14() {
            var eName=$("#emp-Name").val();
            var e_No=$("#emp-No").val();
            var adde=$("#emp-add").val();
            var user_code=$("#user-Nme").val();
            var password=$("#password").val();
            var id=<?php echo json_encode("$shopidu")?>;
            var $fid=<?php echo json_encode("$fid")?>;

           // alert(id)
if(eName =="" || e_No =="" || user_code =="" || password ==""|| adde =="" ){
    alert('Please Fill Details give input')
    return
}
            $.ajax({
                type: "post",
                url: "postEmpDatils.php",
                dataType:"json",
                data: {'eName':eName,"e_No":e_No,"add":adde,"user_code":user_code,"password":password,"id":id,"fid":$fid},
                async:false,
                success: function(test){
                    if(test=='Employee Details alredy exit'){
                      alert(test)
                    }else{
                        alert(test);
                        window.location.href='profile.php';
                    }

                    //
                },
                error: function(){
                    alert('failure');
                }
            });
        }
        function showDialog()
        {
            //$("#dialog-modal").html(text);
            $("#dialog-modal").dialog(
                {
                    width: 600,
                    height: 400,
                   // modal: true,
                    position: { my: "right bottom", at: "center center", of: window }
                  //  open: function(event, ui)

                });

        }function showDialog14()
        {
            //$("#dialog-modal").html(text);
            $("#dialog-modal-14").dialog(
                {
                    width: 600,
                    //modal: true,
                    height: 400,
                    position: { my: "right bottom", at: "center center", of: window }
                  //  open: function(event, ui)

                });

        }

    </script>
		<?php
	include_once "includes/footer.php"; ?>
      
      <!-- /#page-wrapper -->
   </div>
    <!-- /#wrapper -->
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
<script src="jquery-ui.js" type="text/javascript"></script>
<link href="jquery-ui.css"
      rel="stylesheet" type="text/css" />
    <script> function checkGstDuplicate() {
            // var pgst=  $('gst-id').val();
            var pgst=  document.getElementById('gst-id').value;
            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: 'checkDuplicateGstNo.php',
                async: false,
                data: {"pgst": pgst},
                success: function (response) {
                    if(response=='YES'){

                        document.getElementById("chart-id1").innerHTML = "GST No is available ,Please Check GST No";
                    }else{
                        document.getElementById("chart-id1").innerHTML = "";

                    }

                },
                error: function (req, status, error) {
                }
            });


        }
function  updatePassword() {
 var shopid = document.getElementById('custMob').value;
    var oldpassword=  document.getElementById('old-password').value;
    var newpassword=  document.getElementById('new-password').value;

    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: 'updatePassword.php',
        async: false,
        data: {"shopid": shopid,"oldpassword":oldpassword,"newpassword":newpassword},
        success: function (response) {
alert(response)
            $('#myModal').hide();
        },
        error: function (req, status, error) {
        }
    });


}
        // Get the modal
        var modal = document.getElementById('myModal');

        // Get the button that opens the modal
        var btn = document.getElementById("mybtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
            var customer = document.getElementById("shopid-1").value;
            document.getElementById("custMob").value=customer;
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }



    </script>


<style>
    /* The Modal (background) */

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 815px;
        top: -39px;
        width: 39%;
        height: 103%;
        overflow: auto;
       /* background-color: rgb(0,0,0);
        background-color: rgba(0,0,0,0.4);*/
    }

    /* Modal Content */
    .modal-content {
        position: relative;
        background-color: #fefefe;
        margin: auto;
        padding: 0;
        border: 1px solid #888;
        width: 80%;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
        -webkit-animation-name: animatetop;
        -webkit-animation-duration: 0.4s;
        animation-name: animatetop;
        animation-duration: 0.4s
    }

    /* Add Animation */
    @-webkit-keyframes animatetop {
        from {top:-300px; opacity:0}
        to {top:0; opacity:1}
    }

    @keyframes animatetop {
        from {top:-300px; opacity:0}
        to {top:0; opacity:1}
    }

    /* The Close Button */
    .close {
        color: white;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .modal-header {
        padding: 2px 16px;
        background-color: #5cb85c;
        color: white;
    }

    .modal-body {padding: 2px 16px;}

    .modal-footer {
        padding: 2px 16px;
        background-color: #5cb85c;
        color: white;
    }
</style>
</body>
</html>
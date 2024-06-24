
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

if (!isset($_SESSION['username'])) {
    header('location:login.php');
} else {

    $uname = $_SESSION['username'];
    // echo "<script>alert('session mentain')</script>";
}
if (isset($_POST['add']))
	{
	$terms_condition=$_REQUEST['terms_condition'];
	$query="insert into `terms_condition` (`terms_condition`)values ('$terms_condition')";
     $record=mysqli_query($conn,$query);
if($record)
		{
			
			echo "<script>alert('Terms & Condition added');window.location.href='allterms_condition.php'</script>";
		}
		else
		{
			echo "<script>alert('Terms & Condition not added')</script>";
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
		 
<form role="form" class="form-horizontal" method="post" enctype="multipart/form-data" >
      <p> <h3>Terms And Condition</h3></p>
 <div class="bs-example4" data-example-id="simple-responsive-table">
    <div class="table-responsive">
      <table class="table">
	<tr>
	<td>
		<div class="form-group has-success">
			<input type="text" class="form-control1 form-control_2 input-sm" placeholder="Terms & Condition" name="terms_condition" autofocus="" required>
		</div>
	</td>
	  
	
	  <tr>
		  <td colspan="2">
			<button class="btn btn-info btn-success1 btn-block" type="submit" name="add">Add</button>
		  </td>
	  </tr>
	  </table>
	  </div>
	  </div>
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
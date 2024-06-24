<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php include('config.php');
session_start();
// echo $_SESSION['username'];

if(!isset($_SESSION['username']))
{
    header('location:login.php');
}
else
{

    $uname = $_SESSION['username'];
	
	/* foreach($_POST['colors'] as $check) 
	{
		echo "<script>alert($check)</script>"; 
   

		header('Location:sendmsg.php?numbers='.$check.'');
		
		
		
	}*/
	
    // echo "<script>alert('session mentain')</script>";
}

$number=$_GET['numbers'];

 foreach($number as $check) 
	{
	 //echo "<script>alert($check)</script>"; 
   

				
		
	}


if(isset($_POST['save']))
{
    $subject=$_REQUEST['subject'];
    $msg=$_REQUEST['msg'];



    $insert=mysqli_query($conn,"INSERT INTO `tblsendmsg`(`strSubject`, `strMsg`) VALUES ('$subject','$msg')");
    if($insert)
    {
        echo "<script>alert('Message successfully save to draft')</script>";
    }
    else
    {
        echo "<script>alert('Error')</script>";
    }
}

?>
<!DOCTYPE HTML>
<html>
<head>
    <title>BillEasy | Compose :: billeasy</title>
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

    <script>
        function rowshow(subject)
        {
            /*var subject=$(this).attr("data-id")*/
            alert(subject)

            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: 'getMsgupdate.php',
                async: false,
                data: {"id": subject},
                success: function (response) {

                    $('#subject').val(subject)
                    $('#msg').val(response[0].strMsg)

                },
                error: function (req, status, error) {
                }
            });
        }






    </script>


</head>
<body>
<div id="wrapper">
    <!-- Navigation -->
    <?php
    include_once "header.php"
    ?>
    <div id="page-wrapper">
        <div class="graphs">
            <div class="xs">
                <h3>Compose</h3>
                <div class="col-md-4 email-list1">
                    <ul class="collection">
                        <?php

                        $fetch=mysqli_query($conn,"SELECT * FROM `tblsendmsg`");
                        while($row=mysqli_fetch_array($fetch))
                        {
                            $id=$row['strSubject'];
                            ?>
                            <li class="collection-item avatar email-unread" >
                                <i class="icon_4">M</i>
                                <div class="avatar_left" >

                                    <span class="email-title" style='cursor:pointer' id='<?php echo $row['strSubject']; ?>' onclick="rowshow(this.id)"><?php echo $row['strSubject']; ?>></span>
                                    <p class="truncate grey-text ultra-small" style='cursor:pointer' id='<?php echo $row['strSubject']; ?>' onclick="rowshow(this.id)"><?php echo $row['strMsg']; ?>></p>



                                </div>
                                <a href="#!" class="secondary-content"><span class="blue-text ultra-small">2:15 pm</span></a>
                                <div class="clearfix"> </div>
                            </li>
                            <?php
                        }

                        ?>


                    </ul>
                    <div class="content-box  mrg15B">
                        <div class="content-box-wrapper text-center">
                            <h4 class="content-box-header">
                                Chat
                                <small>(Online friends)</small>
                            </h4>
                            <div class="status-badge mrg10A">
                                <img class="img-circle" width="40" src="images/1.png" alt="">
                                <div class="small-badge bg-red"></div>
                            </div>
                            <div class="status-badge mrg10A">
                                <img class="img-circle" width="40" src="images/2.png" alt="">
                                <div class="small-badge bg-orange"></div>
                            </div>
                            <div class="status-badge mrg10A">
                                <img class="img-circle" width="40" src="images/3.png" alt="">
                                <div class="small-badge bg-red"></div>
                            </div>
                            <div class="status-badge mrg10A">
                                <img class="img-circle" width="40" src="images/4.png" alt="">
                                <div class="small-badge bg-green1"></div>
                            </div>
                            <div class="status-badge mrg10A">
                                <img class="img-circle" width="40" src="images/5.png" alt="">
                                <div class="small-badge bg-orange"></div>
                            </div>
                            <div class="status-badge mrg10A">
                                <img class="img-circle" width="40" src="images/1.png" alt="">
                                <div class="small-badge bg-red"></div>
                            </div>
                            <div class="status-badge mrg10A">
                                <img class="img-circle" width="40" src="images/2.png" alt="">
                                <div class="small-badge bg-green1"></div>
                            </div>
                            <div class="status-badge mrg10A">
                                <img class="img-circle" width="40" src="images/3.png" alt="">
                                <div class="small-badge bg-orange"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 inbox_right">
                    <div class="Compose-Message">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Compose New Message
                            </div>
                            <div class="panel-body">
                                <div class="alert alert-info">
                                    Please fill details to send a new message
                                </div>
                                <hr>
                                <form method="POST">
                                    <label>Enter Recipient Number : </label>
									
                                    <input type="text" class="form-control1 control3" value="">
                                    <label>Enter Subject :  </label>
                                    <input type="text" class="form-control1 control3" name="subject" id="subject">
                                    <label>Enter Message : </label>
                                    <textarea rows="6" class="form-control1 control2" name="msg" id="msg"></textarea>
                                    <hr>
                                    <input type="submit" class="btn btn-warning btn-warng1" value="Send Message" name="send" > &nbsp;<input type="submit" class="btn btn-success btn-warng1" value="Save To Drafts" name="save">




                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
            <?php
            include_once "footer.php"
            ?>
        </div>
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- Nav CSS -->
<link href="css/custom.css" rel="stylesheet">
<!-- Metis Menu Plugin JavaScript -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>

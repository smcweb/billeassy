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
?>

<?php

$shopid=$_SESSION['shopidu'];
if(isset($_POST['save']))
{
    $subject=$_REQUEST['sub'];
    $msg=$_REQUEST['msg'];

    // echo "<script>alert('$subject')</script>";
    //echo "<script>alert('$msg')</script>";


    $insert=mysqli_query($conn,"INSERT INTO `tblsendmsg`(`strSubject`, `strMsg`, `shopid`) VALUES ('$subject','$msg','$shopid')");
    if($insert)
    {
        echo "<script>alert('Message successfully saved to draft')</script>";
    }
    else
    {
        echo "<script>alert('Please Change Subject')</script>";
    }
}




if(isset($_POST['Updatesave']))
{

    $subject=$_REQUEST['sub'];
    $msg=$_REQUEST['msg'];

    // echo "<script>alert('$subject')</script>";
    //echo "<script>alert('$msg')</script>";


    $update=mysqli_query($conn,"UPDATE `tblsendmsg` SET `strSubject`='$subject',`strMsg`='$msg' WHERE `strSubject`='$subject' AND `shopid`='$shopid'");
    if($update)
    {
        echo "<script>alert('Message Updated Successfully ')</script>";
    }
    else
    {
        echo "<script>alert('Please Change Subject')</script>";
    }
}

/*sms gateway*/

if(isset($_POST['sendm']))
{


    $quer=$_REQUEST['smessage'];
   
	//echo "<script>alert($quer)</script>";

    $fetch=mysqli_query($conn,"SELECT * FROM `tblsendmsg` WHERE `sId`=$quer");
    while($row=mysqli_fetch_array($fetch))
    {
        $s=$row['strSubject'];
        $m=$row['strMsg'];
    }
	// echo "<script>alert('$s')</script>";
	//echo "<script>alert('$m')</script>";

    foreach($_POST['colors'] as $check)
    {

		echo "<script>alert($check)</script>";

        $username = "broad";

        $password = "broad@123";

        $message = "Dear $s \n $m";
        //$message = "Hi!-----------------------";

        $sender = "BRNDWL"; //ex:INVITE

        $mobile_number = $check;


        $url = "bulksms.myospaz.in/sendmessage.php?user=" . urlencode($username) . "&password=" . urlencode($password) . "&mobile=" . urlencode($mobile_number) .  "&message=" . urlencode($message) ."&sender=" . urlencode($sender) . "&type=" . urlencode('3');

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $curl_scraped_page = curl_exec($ch);

        curl_close($ch);



    }

}




?>




<!DOCTYPE HTML>
<html>
<head>
    <title>EasyBilling| Phonebook :: Billing</title>
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
    <!--for Add Contact popup-->

    <script src="Contactjs/c.js"></script>
    <script src="Contactjs/j.js"></script>
    <!--for add contact popup--->

    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js" ></script>

    <script language="JavaScript">

        var abc='';
        function selectAll(source) {
            checkboxes = document.getElementsByName('colors[]');
            for(var i in checkboxes)
                checkboxes[i].checked = source.checked;
        }
    </script>
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

                    abc = response[0].strMsg;
                    $('#subject').val(subject)
                    $('#msg').val(response[0].strMsg)
                },
                error: function (req, status, error) {
                }
            });
        }





    </script>

    <script>
        function rshow(id)
        {

            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: 'getPhonebookupdate.php',
                async: false,
                data: {"id": id},
                success: function (response) {
                    $('#cid1').val(id)
                    $('#name1').val(response[0].name)
                    $('#phonenumber1').val(response[0].phonenumber)
                    $('#email1').val(response[0].email)
                    $('#address1').val(response[0].address)
                    $('#vender1').val(response[0].venders)
                    $('#edit').dialog("open")
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
    include_once "header.php" ?>
    <!-- Navigation -->
    <div id="page-wrapper">
        <?php
        include_once "top.php"
        ?>
        <?php
        $maxval=mysqli_query($conn,"SELECT MAX(`cid`) AS Maxid FROM `phonebook`");
        while($row=mysqli_fetch_array($maxval))
        {
            $max=$row['Maxid'];
        }
        $max=$max+1;
        ?>
        <div class="content_bottom">
            <div class="col-md-12 span_3">
                <div class="col-md-6 stats-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">Compose New Message</h4>
                    </div>
                    <div class="panel-body">
                        <form method="POST">

                            <label>Enter Subject :  </label>
                            <input type="text" class="form-control1 control3" name="sub" id="subject" required>
                            <label>Enter Message : </label>
                            <textarea  name="msg" class="form-control1"  id="msg" required></textarea>

                            <input type="submit" class="btn btn-success btn-warng1" value="Save To Drafts" name="save">&nbsp; <input type="submit" class="btn btn-success btn-warng1" value="Update" name="Updatesave">

                        </form>
                        <br/>

                        <div style="height: 300px; width: 100%;overflow: auto;">
                            <ul class="collection">
                                <?php

                                $fetch=mysqli_query($conn,"SELECT * FROM `tblsendmsg` WHERE `shopid`='$shopid'");
                                while($row=mysqli_fetch_array($fetch))
                                {
                                    $id=$row['strSubject'];
                                    ?>
                                    <li class="collection-item avatar email-unread">
                                        <i class="icon_4">M</i>
                                        <div class="avatar_left">

                                            <span class="email-title" style="cursor:pointer" id="<?php echo $row['strSubject']; ?>" onclick="rowshow(this.id)" ><?php echo $row['strSubject']; ?></span>
                                            <p class="truncate grey-text ultra-small" style="cursor:pointer" id="<?php echo $row['strSubject']; ?>" onclick="rowshow(this.id)"><?php echo $row['strMsg']; ?></p>



                                        </div>
                                        <a class='confirmation' href="tblmsgdelete.php?id= <?php echo $row['sId'];?>" class="secondary-content"><span class="blue-text ultra-small"> <i class='fa fa-trash-o iconsize' aria-hidden='true'></i></span></a>
                                        <div class="clearfix"> </div>
                                    </li>
                                    <?php
                                }

                                ?>


                            </ul>

                        </div>

                    </div>
                </div>
<!--confirm-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="jquery-3.2.1.min.js"></script>
    <script type="text/javascript">
        $('.confirmation').on('click', function () {
            return confirm('Are you confirm to delete a messege');
        });
		
    </script>
    <!--confirm -->
                <div class="col-md-6 stats-info">

                    <div class="panel-heading">
                        <h4 class="panel-title">Phonebook</h4>
                    </div>

                    <div class="panel-body">
                        <div class="bs-example1" data-example-id="contextual-table">


                            <form method="POST">
                                <div class="input-group">
                                    <input  class="form-control1 input-search"  type="text"  id="txt_sreach" placeholder="Search By Phone No Or Name Or Group" name="txt_search">
                                    <span class="input-group-btn">
					 <button class="btn btn-success" type="hidden" name="submit"><i class="fa fa-search"></i></button></span>
                                </div>
                                <!--input type="hidden" name="txt_search"-->
                            </form>





                            <form action="phonebook.php" method="POST">

                                <select name="smessage" class="form-control1 control3" required>
                                    <option value="">Select</option>
                                    <?php
                                    $fetch=mysqli_query($conn,"SELECT * FROM `tblsendmsg` WHERE `shopid`='$shopid'");
                                    while($row=mysqli_fetch_array($fetch))
                                    {

                                        ?>
                                        <option value="<?php  echo $row['sId'];?>"><?php echo $row['strSubject']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <input type="submit" value="Send Message" name="sendm" class="btn btn-success">&nbsp;<button type="button"  class="btn btn-warning btn-warng1"  data-toggle="modal" data-target="#addcontact"><i class="fa fa-phone" aria-hidden="true"></i></button> 


                                <div style="height: 300px; width: 100%;overflow: auto;">
                                    <table class="table">


                                        <thead>
                                        <tr>
                                            <th style="color:black;text-align:center"><input type="checkbox" class="checkbox" id="selectall" onClick="selectAll(this)"> </th>

                                            <th style="color:black;text-align:center">Name</th>
                                            <th style="color:black;text-align:center">Contact</th>

                                            <th style="color:black;text-align:center">Group</th>
                                            <th style="color:black;text-align:center">Manage</th>
                                        </tr>
                                        </thead>
                                        <tbody>



                                        <?php

                                        if(isset($_POST['txt_search']))
                                        {

                                            $search=$_POST['txt_search'];
                                            $search_result="";
                                            $query = "SELECT * FROM phonebook WHERE `name` LIKE '%$search%' || `phonenumber` LIKE '%$search%' || `venders` LIKE '%$search%'";
                                            $search_result = mysqli_query($conn, $query);

                                        }
                                        else
                                        {
                                            $search_result="";
                                            $query = "SELECT * FROM phonebook WHERE `shopid`='$shopid'";

                                            $search_result = mysqli_query($conn, $query);

                                        }
                                        $sr=0;
                                        while( $row = mysqli_fetch_array( $search_result ))
                                        {
                                            $cid=$row['cid'];
                                            $sr++;
                                            echo"<tr  style='color:black;text-align:center'>";
                                            ?><td >
                                            <input type="checkbox" class="checkbox" name="colors[]" value="<?php echo $row['phonenumber']; ?>"></td>

                                            <?php


                                            echo"<td style='color:black'>".$row['name']."</td>";
                                            echo"<td style='color:black'>".$row['phonenumber']."</td>";

                                            echo"<td style='color:black'>".$row['venders']."</td>";
                                            echo"<td style='color:black' onclick='rshow($cid)'><a class='delete' href='del_contact.php?cid=".$row['cid']."'> <i class='fa fa-trash-o iconsize' aria-hidden='true'></i></a>&nbsp;<button type='button' data-toggle='modal' data-target='#edit'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></td>";

                                            ?>
                                            <?php


                                            echo"</tr>";
                                        }

                                        ?>
                                       




                                        </tbody>
                                    </table>
                                </div>



                            </form>
                        </div>
                    </div>
					<!--confirm contact delete-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="jquery-3.2.1.min.js"></script>
    <script type="text/javascript">
        $('.delete').on('click', function () {
            return confirm('Are you confirm to delete a contact');
        });
		
    </script>
    <!--confirm -->
					
					     <!--add contact Popup-->
                                <div class="modal fade" id="addcontact" role="dialog">

                                    <!--add contact submit form-->
                                    <?php
                                    if(isset($_POST['Sub']))
                                    {

                                        $name=$_REQUEST['name'];
                                        $cid=$_REQUEST['cid'];
                                        $phonenumber=$_REQUEST['phonenumber'];
                                        $email=$_REQUEST['email'];
                                        $address=$_REQUEST['address'];
                                        $select=$_REQUEST['vender'];

                                        $shopid=$_SESSION['shopidu'];
                                        $pgroup="";
                                        $sql="SELECT count(*) FROM `phonebook` WHERE `phonenumber` ='$phonenumber' AND `shopid`='$shopid'";
                                        $query1=mysqli_query($conn,$sql);
                                        $r=mysqli_fetch_row($query1);
                                        $all=$r[0];
                                        if (empty($_POST["name"])) {
                                            echo "<script> alert(' Name is required');</script>";

                                        }

                                        elseif (empty($_POST["phonenumber"])) {
                                            echo "<script> alert(' Phonenumber is required');</script>";

                                        }
                                        elseif(empty($_POST["email"])) {
                                            echo "<script> alert(' Email is required');</script>";
                                        }
                                        elseif(empty($_POST["address"])) {
                                            echo "<script> alert(' Address is required');</script>"; }
                                        elseif($all>=1) {
                                            echo "<script> alert(' Contact is already registered');</script>"; }

                                        else
                                        {


                                            $sql="INSERT INTO `phonebook`(`cid`, `name`, `phonenumber`, `email`, `address`, `pgroup`, `venders`, `shopid`) VALUES ('','$name','$phonenumber','$email','$address','$pgroup', '$select' ,'$shopid')";

                                            $query=mysqli_query($conn,$sql);
                                            if(!$query)
                                            {

                                                echo "<script>alert('Insersion Error')</script>";

                                            }
                                            else
                                            {

                                                echo "<script>alert('contact Added')</script>";
                                                echo '<script> window.location.href = "phonebook.php";</script>';
                                            }
                                        }
                                    }
                                    ?>
                                    <!--add contact submit form-->


                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Add Contact</h4>
                                            </div>
                                            <div class="modal-body">

                                                <!--contact form-->
                                                <form action="" method="POST">

                                                    <input type="hidden" class="form-control1" id="cid" name="cid">
                                                    <div class="form-group ">
                                                        <label  style="width: 90%;color:black" style="width: 90%;" for="inputWarning1">Name</label>
                                                        <input type="text" class="form-control1" id="name" name="name" required>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label  style="width: 90%;color:black" style="width: 90%;" for="inputWarning1">Mobile</label>
                                                        <input type="text" pattern="[7-9]{1}[0-9]{9}"  maxlength="10" class="form-control1" id="phonenumber" name="phonenumber">
                                                    </div>
                                                    <div class="form-group ">
                                                        <label  style="width: 90%;color:black" style="width: 90%;" for="inputWarning1">Email</label>
                                                        <input type="email" class="form-control1" id="email" name="email">
                                                    </div>
                                                    <div class="form-group ">
                                                        <label  style="width: 90%;color:black" style="width: 90%;" for="inputWarning1">Address</label>
                                                        <input type="text" class="form-control1" id="address" name="address">
                                                    </div>

                                                    <div class="form-group ">

                                                        <select class="form-control1" name="vender" id="vender" required>
                                                            <option>Select</option>
                                                            <option value="Customer">Customer</option>
                                                            <option value="Supplier">Supplier</option>
                                                            <option value="Employee">Employee</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                    </div>
                                                    <input type="submit" class="btn btn-success" name="Sub" value="Add" />


                                                </form>

                                                <!--contact form-->




                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
					
					 <!--update form open-->
                                <div class="modal fade" id="edit" role="dialog">
									
									<?php
						if(isset($_POST['update'])) {
						
							$name = $_REQUEST['name'];
							$cid = $_REQUEST['cid'];
							$phonenumber = $_REQUEST['phonenumber'];
							$email = $_REQUEST['email'];
							$address = $_REQUEST['address'];
							$select = $_REQUEST['vender'];
							$sql = "UPDATE `phonebook` SET `name`='$name',`phonenumber`='$phonenumber',`email`='$email',`address`='$address',`venders`='$select' WHERE `cid`='$cid' AND `shopid`='$shopid'";
						
							$query = mysqli_query($conn, $sql);
						
							if(!$query)
							{
						
								echo "<script>alert('Insersion Error')</script>";
						
							}
							else
							{
						
								echo "<script>alert('Contact Updated')</script>";
								echo '<script> window.location.href = "phonebook.php";</script>';
							}
						}

?>
									
									
									
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Modal Header</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="POST">

                                                    <input type="hidden" class="form-control1" id="cid1" name="cid">
                                                    <div class="form-group ">
                                                        <label  style="width: 90%;color:black" style="width: 90%;" for="inputWarning1">Name</label>
                                                        <input type="text" class="form-control1" id="name1" name="name" required>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label  style="width: 90%;color:black" style="width: 90%;" for="inputWarning1">Mobile</label>
                                                        <input type="text" pattern="[7-9]{1}[0-9]{9}"  maxlength="10" class="form-control1" id="phonenumber1" name="phonenumber">
                                                    </div>
                                                    <div class="form-group ">
                                                        <label  style="width: 90%;color:black" style="width: 90%;" for="inputWarning1">Email</label>
                                                        <input type="email" class="form-control1" id="email1" name="email">
                                                    </div>
                                                    <div class="form-group ">
                                                        <label  style="width: 90%;color:black" style="width: 90%;" for="inputWarning1">Address</label>
                                                        <input type="text" class="form-control1" id="address1" name="address">
                                                    </div>

                                                    <div class="form-group ">

                                                        <select class="form-control1" name="vender" id="vender1" required>
                                                            <option>Select</option>
                                                            <option value="Customer">Customer</option>
                                                            <option value="Supplier">Supplier</option>
                                                            <option value="Employee">Employee</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                    </div>
                                                    <input type="submit" class="btn btn-success" name="update" value="Update" />


                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!--update Form close-->
					
					
					
                </div>
            </div>


            <div class="clearfix"> </div>
        </div>
    </div>

</div>




<!-- footer -->
<?php
include_once "footer.php" ?>
<!-- footer -->
</div>
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>

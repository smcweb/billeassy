<?php
include('config.php');
if(isset($_POST['submit']))
{


    $email=$_POST['email'];
    $pass=$_POST['password'];
    $sql = "SELECT `shopid`,`shopname`, `password`,`email`,`id`,`fid`,logo FROM `shop` WHERE `shopid` = '$email' && `password` = '$pass' ";
    $query = mysqli_query($conn,$sql);
    $c=0;
    while($row=mysqli_fetch_array($query))
    {
        $c=1;
        $shopidu=$row['id'];
        $shologo=$row['logo'];
        $shopid=$row['shopid'];
        $password=$row['password'];
        $shopname=$row['shopname'];
        $email=$row['email'];
        $efid=$row['fid'];

    }
    $f=0;
    if($c)
    {
        session_start();
        error_reporting(1);
        $_SESSION['logedin'] = True;
        $_SESSION['shologo'] = $shologo;
        $_SESSION['shopid']=$shopid;
        $_SESSION['shopidu']=$shopidu;
        $_SESSION['username']=$shopname;
        $_SESSION['fid']=$efid;
        header('location:index.php');
        $f=1;
    }

    if($f == 0)
    {
        echo "<script>alert('Enter Shop Id and Password')</script>";
        echo "<script>windows.location.href='login.php'</script>";
    }
    else
    {

        echo "<script>alert('welcome')</script>";
    }
}
?>

    <!DOCTYPE HTML>
    <html>
    <head>
        <title>EasyBilling | Login :: Admin</title>
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

        <script type="text/javascript">

            function Validate() {
               var image='img/if_Accept_105257.png'
               var imageq='img/if_Delete_132192.png'

                var password = document.getElementById("txtPassword").value;
                var confirmPassword = document.getElementById("txtConfirmPassword").value;
                if (password != confirmPassword) {
                    //alert("Passwords do not match.");
                   $('#chart-img').css('background', 'url(' + imageq  + ') no-repeat 0px 0px');
                    //$('#txtConfirmPassword').css('background-image', 'url(' +image+ ')no-repeat');
                    //$("#txtConfirmPassword").css({background : "url(img/correct-symbol.png)", background-repeat: 'no-repeat'});
                    return false;
                }else{
                    $('#chart-img').css('background', 'url(' + image  + ') no-repeat 0px 0px');
                    return true;
                }

            }
        </script>
    </head>
    <body id="login">
    <div class="login-logo">
        <h2>Bill Easy</h2>
    </div>
    <h2 class="form-heading">login</h2>
    <div class="xs">
        <div class="app-cam">
            <form method="POST" role="form" class="form-horizontal">
                <div class="form-group has-success">
                    <div class="input-group input-icon right">
									<span class="input-group-addon">
										<i class="fa fa-envelope-o"></i>
									</span>
                        <input type="text" id="email" name="email" class="form-control1 form-control_2 input-sm"  placeholder="Shop Id">
                    </div>
                </div>
                <div class="form-group has-success">
                    <div class="input-group input-icon right">
									<span class="input-group-addon">
										<i class="fa fa-key"></i>
									</span>
                        <input type="password" name="password" class="form-control1 form-control_2 input-sm" placeholder="Password">
                    </div>
                </div>







                <!--	<input type="email" name="email" id="email" class="form-control1" placeholder="Email Address"/>
                    <input type="password" name="password" placeholder="Password" autocomplete="off" />-->
                <div class="submit"><input type="submit"  class="btn btn-primary btn-lg" name="submit" value="Login"></div>
                <br>
                <ul class="new">

                    <li class="new_right"><p class="sign">New User ?<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                                Register
                            </button></p></li>
            </form>
        </div>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h2 class="modal-title">New User "Welcome"</h2>
                </div>


                <div class="modal-body">
                    <h2 class="form-heading">Register</h2>

                    <form role="form" class="form-horizontal" method="post" enctype="multipart/form-data" >
                        <p>Enter your personal details below</p>
                        <div class="bs-example4" data-example-id="simple-responsive-table">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr><td>
                                            <div class="form-group has-success">
                                                <input type="text" class="form-control1 form-control_2 input-sm" placeholder="Shop Name" name="shopname" autofocus="" required>
                                            </div></td>
                                        <td><div class="form-group has-success">
                                                <input type="text" class="form-control1 form-control_2 input-sm" placeholder="Shop Id" name="shopid" autofocus="" required>
                                            </div>
                                        </td></tr>
                                    <tr>	<td> <div class="form-group has-success">

                                                <input type="email" class="form-control1 form-control_2 input-sm" placeholder="Email" name="email" autofocus="" required>

                                            </div></td>
                                        <td> <div class="form-group has-success">


                                                <input type="text" class="form-control1 form-control_2 input-sm" pattern="[7-9]{1}[0-9]{9}"  maxlength="10" placeholder="Mobile Number" name="phone" autofocus="" required>
                                            </div></td></tr>

                                    <tr><td><div class="form-group has-success">


                                                <input type="text" class="form-control1 form-control_2 input-sm" placeholder="shop type" name="shoptype" autofocus="" required>

                                            </div></td>
                                        <td> <div class="form-group has-success">
                                                <input type="text" class="form-control1 form-control_2 input-sm" placeholder="Address" name="address" autofocus="" >
                                            </div></td>
                                        <!--<td>	 <div class="form-group has-success">


                                                <input type="text" class="form-control1 form-control_2 input-sm" placeholder="GST number" name="gst" id='gst-id' onblur="checkGstDuplicate()" autofocus="" required>

                                            </div><p id="chart-id1" style="color: #ef553a;"></p> id='gst-id'</td>--></tr>
                                    <!--<tr>--> <!--<td><div class="form-group has-success">


                                                <input type="file" class="form-control1 form-control_2 input-sm" name="logo" autofocus="" required>
                                            </div></td>-->

                                        <!--<td> <div class="form-group has-success">
                                                <input type="text" class="form-control1 form-control_2 input-sm" placeholder="Address" name="address" autofocus="" >
                                            </div></td>--><!--</tr>-->

                                    <!--<tr><td colspan="2">		 <div class="form-group has-success">


                                                <select class="form-control1 form-control_2 input-sm" name="fyear" autofocus="" required>
                                                    <option value="F-year"> Select Financial Year </option>
                                                    <?php
/*                                                    include('config.php');
                                                    echo $sql="SELECT * FROM `financialyear`";
                                                    $query=mysqli_query($conn,$sql);
                                                    while($row=mysqli_fetch_array($query))
                                                    {
                                                        $fid = $row['fid'];
                                                        $fyear = $row['fyear'];
                                                        // $fdate=$row['fromDate'];
                                                        // $tdate=$row['toDate'];
                                                        // $fyear=$fdate.' '.'to'.' '.$tdate;
                                                        */?>
                                                        <option> <?php /*echo $fyear; */?>      </option>
                                                    <?php /*}*/?>

                                                </select>

                                            </div></td></tr>-->
                                    <!-- <div class="radios">
                                       <label for="radio-01" class="label_radio">
                                           <input type="radio" checked=""> Male
                                       </label>
                                       <label for="radio-02" class="label_radio">
                                           <input type="radio"> Female
                                       </label>
                                     </div>-->
                                    <tr><td colspan="2">
                                            <p> Enter your account details below</p></td></tr>

                                    <tr><td>
                                            <div class="form-group has-success">

                                                <input type="password" class="form-control1" placeholder="Password" name="password" id="txtPassword" required>
                                            </div></td>
                                        <td> <div class="form-group has-success">

                                                <input type="password" class="form-control1" placeholder="Re-type Password" name="cpassword" id="txtConfirmPassword" onblur="Validate()" required>
                                            <span id="chart-img" style="    padding: 40px;
    position: absolute;
        margin: -34px 173px;"></span></div></td></tr>
                                    <tr><td colspan="2">
                                            <button class="btn btn-lg btn-success1 btn-block" type="submit" name="register" >Submit</button>
                                        </td></tr>
                                    <tr>
                                        <div class="registration">
                                            <td>
                                                Already Registered.</td>
                                            <td> <a class="" href="login.php">
                                                    Login
                                                </a>
                                            </td>
                                        </div>
                                    </tr></table></div></div>
                    </form>


                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <div class="clearfix"></div>
        </ul>
        </form>


    </div>
    <div class="copy_layout login">
        <p>Copyright &copy; 2017 myospaz. All Rights Reserved | Design by <a href="http://myospaz.in/" target="_blank">Myospaz</a></p>
    </div>
    </body>
    </html>
<?php include('config.php');
if(isset($_POST['register']))
{
    $fid=0;
    $shopname=$_POST['shopname'];
    $address=$_POST['address'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $shoptype=$_POST['shoptype'];
   /* $gst=$_POST['gst'];*/

    $fyear=$_POST['fyear'];
    if($fyear=='F-year'){
        echo "<script> alert('Please Select Fincial Years');</script>";
    }else{
    $sql="SELECT `fid` FROM `financialyear` WHERE `fyear`='$fyear'";
    $query = mysqli_query($conn,$sql);
    while($r=mysqli_fetch_array($query))
    {
        $fid=$r['fid'];
    }
    $sql="SELECT max(`id`) FROM `shop`";
    $query = mysqli_query($conn,$sql);
    $row=mysqli_fetch_row($query);
    $sp=$row[0];
    $sp++;
    $shopid=$_POST['shopid'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];
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
/*
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
    }*/
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

        while($row=mysqli_fetch_array($query))
        {
            $c=1;
            $shopid=$row['shopid'];
            $password=$row['password'];

        }
        if($c == 1)
        {
            echo "<script>alert('shop name is allready Registed')</script>";
        }
        else {
            $sql = "INSERT INTO `shop`(`shopid`, `password`, `shopname`, `phone`, `email`, `address`, `shoptype`, `gst`, `logo`, `BillTerms`, `fid`) VALUES ('$shopid','$password','$shopname','$phone','$email','$address','$shoptype','$gst','$location','','$fid')";
            $query = mysqli_query($conn, $sql);
            ///$last_id = mysqli_insert_id($conn);
            $last_id = mysqli_insert_id($conn);

            $sql = "INSERT INTO `tbltax`(`taxName`, `taxPercent`, `shopid`) VALUES ('No Tax',0,'$last_id')";
            $query = mysqli_query($conn, $sql);
            $sql = "INSERT INTO `tbloffer`( `offername`, `offerPercent`, `validDate`, `shopid`) VALUES ('No Offer',0,00,'$last_id')";
            $query = mysqli_query($conn, $sql);
            if (!$query) {

                echo "<script>alert('Insersion Error')</script>";
            } else {

                echo "<script>alert('Shop is Registered successfully')</script>";

                echo '<script> window.location.href = "login.php";</script>';
                //echo "<script>window.open('login.php')</script>";
            }
        }
        }
    }
}
?>
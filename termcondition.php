<?php
session_start();
//session_destroy();
session_start();
$_SESSION['login_expire'] = time();

if(!isset($_SESSION['expire']))
{
    $_SESSION['expire'] = $_SESSION['login_expire'] + (300 * 60) ;
}
$now = time();

if($now > $_SESSION['expire'])
{
    session_destroy();

    echo"<script>window.location.href='http://broadbandwale.in/admin/index.php'</script>";
    $msgExpire='Your session has expire';
}else{
    //$_SESSION['expire']=
    $nameBp= $_SESSION['login_user'];
    $cmpname=$_SESSION['cmp_name'];
}
?>
<?php

$db = $_SESSION['bpname'];

include_once $db;
$id1 = $_GET['id'];
$id = base64_decode($id1);
//unset($_SESSION["login_strUserId"]);
//$id=$_SESSION['login_strUserId'];
$id1 = $_GET['id'];
//$id = SHA1($_GET['id']);
//echo "<script type='text/javascript'>alert('{$id}');</script>";
$query = "SELECT tu.`strUserId`,tu.`stradvpaid`,tu.`strAdd`,tu.`strPhone`,tu.`strName`,tu.`intId`,tz.`intZoneId`,tz.`strZoneName`,tu.`strBPId` FROM `tblusers` tu JOIN `tblzone` tz  ON tu.`intZoneId` =tz.`intZoneId` WHERE tu.`strUserId`='$id'";
$record = mysqli_query($conn, $query);
$planId = null;
$ZoneId = null;
$userstrAdd = null;
$uintId = null;
while ($row = mysqli_fetch_array($record)) {

    $username = $row['strUserId'];
    $ustradvpaidu= $row['stradvpaid'];
    $userstrAdd = $row['strAdd'];
    $ZoneId = $row['intZoneId'];
    $planId = $row['intPlanId'];
    $uintId = $row['intId'];
    $ustrBPId = $row['strBPId'];
    $ustrName = $row['strName'];
    $strZoneNameVal1 = $row['strZoneName'];
    $strPhone = $row['strPhone'];


}

$query = "SELECT strZoneArea FROM `tblzone` WHERE `intZoneId`='$ZoneId'";
$record = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($record)) {

    $strZoneAreaVal1 = $row['strZoneArea'];

}
$query = "SELECT `strPlanName`,`dblPrice`,`strValidity`,`intPlanId`,`strType` FROM `tblplan` WHERE `intPlanId`='$planId'";
$record = mysqli_query($conn, $query);
$planName = null;
$price = null;
$validity = null;
while ($row = mysqli_fetch_array($record)) {

    $planName = $row['strPlanName'];
    $strType = $row['strType'];
    $price = $row['dblPrice'];
    $validity = $row['strValidity'];


}
$priceadv= $price + $ustradvpaidu;
//echo "<script type='text/javascript'>alert('$priceadv');</script>";
//}

if (isset($_POST["submit"]))
{
    include_once $db;
    $validity = null;
    $username1 = $_REQUEST['txt_id'];
    $uintId = $_REQUEST['row_id'];
    $userstrAdd = $_REQUEST['add_id'];
    $ucustName = $_REQUEST['custName'];
    $drpdwn_payment = $_REQUEST['drpdwn_payment'];
    $drpdwn_zone_area = $_REQUEST['zone_area'];
    $drpdwn_zone = $_REQUEST['drpdwn_zone'];
    $drpdwn_plan = $_REQUEST['drpdwn_plan'];
    $price1 = $_REQUEST['txt_Planrate'];
    $discount = $_REQUEST['discount'];
    $pricePaid = $_REQUEST['txt_paid'];
    $txt_ramt = $_REQUEST['txt_ramt'];
    //$txt_ramt = $REQUEST['t'];
    $uchequeNo = $_REQUEST['chequeNo'];
    $ubankName = $_REQUEST['bankName'];
    $utranjectionid = $_REQUEST['tranjectionid'];
    $urenew_CurDate = $_REQUEST['renew_CurDate'];
    $umyselect_empId = $_REQUEST['myselect_empId'];




    $query = "SELECT strValidity,strPlanName FROM `tblplan` WHERE `intPlanId`='$drpdwn_plan'";
    $record = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($record)) {

        $validity = $row['strValidity'];
        $vstrPlanName = $row['strPlanName'];

    }
    //echo "<script type='text/javascript'>alert('{$id}');</script>";
    $d = date("Y-m-d", strtotime($urenew_CurDate));
    $query1 = "SELECT DATE_FORMAT(DATE_ADD('$d', INTERVAL '$validity' DAY),'%Y-%m-%d') as expdate";
    $rec1 = mysqli_query($conn, $query1);
    $endate = null;
    while ($r1 = mysqli_fetch_array($rec1)) {
        $endate = $r1['expdate'];
    }
    $query = "SELECT  tu.strBPId FROM `tblusers` tu WHERE tu.`strUserId`='$id'";
    $record = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($record)) {


        $ustrBPId = $row['strBPId'];


    }
    // echo "<script type='text/javascript'>alert('{$ustrBPId}');</script>";

    $query = "SELECT `intZoneId` FROM `tblplan` WHERE `intPlanId`='$planId'  ";
    $rec = mysqli_query($conn, $query);
    //$endate = null;
    while ($r = mysqli_fetch_array($rec)) {
        $intZoneId = $r['intZoneId'];
    }
    //echo "<script> alert($intZoneId)</script>";
    if ($urenew_CurDate=='') {
        echo "<script type='text/javascript'>alert('Please select Recharge Date');</script>";
    }
    elseif ($drpdwn_payment == "modeofpayment") {
        echo "<script type='text/javascript'>alert('Please select payment mode');</script>";
        echo "<script type='text/javascript'>window.location.href ='renewplan.php';</script>";
    }

    elseif ($drpdwn_zone_area=='zone_area') {
        echo "<script type='text/javascript'>alert('Please select zone area');</script>";
    }
    elseif (empty($drpdwn_plan)) {
        echo "<script type='text/javascript'>alert('Please select plan');</script>";
    }

    elseif ($pricePaid=='') {
        echo "<script type='text/javascript'>alert('Please enter paid price');</script>";
    }
    elseif ($txt_ramt=='') {
        echo "<script type='text/javascript'>alert('Please  remaining amount');</script>";
    }elseif ($umyselect_empId=='') {
        echo "<script type='text/javascript'>alert('Please  Select Employee');</script>";
    }



    else {
        $query = "SELECT `stradvpaid` FROM `tblusers` WHERE strUserId='$id'";
        $rec = mysqli_query($conn, $query);
        //$endate = null;
        while ($r = mysqli_fetch_array($rec)) {
            $uustradvpaid= $r['stradvpaid'];
        }
        // echo "<script>alert('$uustradvpaid')</script>";
        if($uustradvpaid < 0){

            $usrstradvpaid=$uustradvpaid+$price1-$pricePaid-$discount;
            //echo "<script>alert('$usrstradvpaid')</script>";
        }else{
            $usrstradvpaid=$uustradvpaid+$price1-$pricePaid-$discount;
        }if($uchequeNo && $ubankName){

            $sql3 = "INSERT INTO `tbltransactiondata`(`fltAmount`, `Tdate`, `strUserId`,`strStatus`,`remaining_Amt`, `strModPayment`,strPackageId,strBPId,chequeNo,strBankName) VALUES ('$pricePaid','$urenew_CurDate','$id','renewed','$usrstradvpaid','$drpdwn_payment','$vstrPlanName','$ustrBPId','$uchequeNo','$ubankName')";
            $record3 = mysqli_query($conn, $sql3);
        }elseif($utranjectionid){
            $sql3 = "INSERT INTO `tbltransactiondata`(`fltAmount`, `Tdate`, `strUserId`,`strStatus`,`remaining_Amt`, `strModPayment`,strPackageId,strBPId,intOnlineId) VALUES ('$pricePaid','$urenew_CurDate','$username1','renewed','$usrstradvpaid','$drpdwn_payment','$vstrPlanName','$ustrBPId','$utranjectionid')";
            $record3 = mysqli_query($conn, $sql3);
        }else{
            $sql3 = "INSERT INTO `tbltransactiondata`(`fltAmount`, `Tdate`, `strUserId`,`strStatus`,`remaining_Amt`, `strModPayment`,strPackageId,strBPId) VALUES ('$pricePaid','$urenew_CurDate','$id','renewed','$usrstradvpaid','$drpdwn_payment','$vstrPlanName','$ustrBPId')";
            $record3 = mysqli_query($conn, $sql3);

        }

        /*echo "<script type='text/javascript'>alert('{$endate}');</script>";*/
        $sql13 = "UPDATE `tblconnection` SET `StartDate`='$urenew_CurDate',`EndDate`='$endate' WHERE strUserId='$id'";

        $record33 = mysqli_query($conn, $sql13);

        $sql4 = "UPDATE `tblusers` SET `intPlanId`='$drpdwn_plan',intZoneId='$intZoneId',`stradvpaid`='$usrstradvpaid' WHERE `strUserId`='$id' ";
        $record4 = mysqli_query($conn, $sql4);
        $sql4 = "UPDATE `tblconnection` SET intPlanId='$drpdwn_plan' WHERE`strUserId`='$id'";
        $record4 = mysqli_query($conn, $sql4);
        $query = "SELECT tu.strEmail FROM `tblusers` tu WHERE tu.`strUserId`='$id'";
        $record = mysqli_query($conn, $query);
        $email = null;
        while ($row = mysqli_fetch_array($record)) {

            $email = $row['strEmail'];

        }

        include_once "config.php";
        $query1 = "SELECT * FROM `tblapi` WHERE `BP_ID`='$ustrBPId'";
        $record11 = mysqli_query($con, $query1);
        //$zoneid=null;
        while ($row = mysqli_fetch_array($record11)) {
            $strSenderID = $row['strSenderID'];
            $strUserstrUser = $row['strUser'];
            $strPassword= $row['strPassword'];
        }
        if($uchequeNo && $ubankName) {
            $sql3 = "INSERT INTO `tbltransaction`(`fltAmount`,`intDiscount` ,`Tdate`, `strUserId`,`strStatus`,`fltRemainingAmount`,   `strModPayment`,`strPlanName`,strBPId,`strUserName`,chequeNo,strBankName,strPaymentBy,emp_id) VALUES  ('$pricePaid','$discount','$urenew_CurDate','$id','renewed','$txt_ramt','$drpdwn_payment','$vstrPlanName','$ustrBPId','$email','$uchequeNo ','$ubankName','admin','$umyselect_empId')";

            $record13 = mysqli_query($con, $sql3);
            $intid=mysqli_insert_id($con);
        }elseif($utranjectionid) {
            $sql3 = "INSERT INTO `tbltransaction`(`fltAmount`,`intDiscount` , `Tdate`, `strUserId`,`strStatus`,`fltRemainingAmount`, `strModPayment`,`strPlanName`,strBPId,`strUserName`,intOnlineId,strPaymentBy,emp_id) VALUES ('$pricePaid','$discount','$urenew_CurDate','$id','renewed','$txt_ramt','$drpdwn_payment','$vstrPlanName','$ustrBPId','$email','$utranjectionid','admin','$umyselect_empId')";
            $record13 = mysqli_query($con, $sql3);
            $intid=mysqli_insert_id($con);
        }else{
            $sql3 = "INSERT INTO `tbltransaction`(`fltAmount`,`intDiscount` , `Tdate`, `strUserId`,`strStatus`,`fltRemainingAmount`, `strModPayment`,`strPlanName`,strBPId,`strUserName`,strPaymentBy,emp_id) VALUES ('$pricePaid','$discount','$urenew_CurDate','$id','renewed','$txt_ramt','$drpdwn_payment','$vstrPlanName','$ustrBPId','$email','admin','$umyselect_empId')";
            $record13 = mysqli_query($con, $sql3);
            $intid=mysqli_insert_id($con);
        }
        $query = "SELECT * FROM `tbltransaction` WHERE `intTId`  ='$intid'";
        $record = mysqli_query($con, $query);
        // $email = null;
        while ($row = mysqli_fetch_array($record))
        {

            $sdate = $row['TDate'];

        }
        $date1=date('Y-m-d',strtotime($sdate));

        if ($record33) {
            $subject = "Please Click Below line";
            $link1 = "http://broadbandwale.in/admin/invoicebroadband.php?&startdate=" . $date1 .'&counter=' . $intid .'&ID=' . $id . '&paid=' . $pricePaid.'&adminId=' . $ustrBPId.'&remaining=' . $txt_ramt;
            //echo "<script>alert('Plan is updated')</script>";

            if ($email) {
                mail($email, $subject, $link1);
                echo "<script>alert('Email is  sent please check your E-mail')</script>";
                //echo "<script type='text/javascript'>alert('{$d}');</script>";


                echo "<script type='text/javascript'>window.location.href ='registeruser.php';</script>";
            } else {
                echo "<script>alert('Email is not sent Due some technical problem')</script>";
                echo "<script type='text/javascript'>window.location.href ='registeruser.php';</script>";
            }


            date_default_timezone_set('Asia/Kolkata');



            $curdateTime = date("Y-m-d h:i:sa");
            if(isset($_REQUEST['smscheck']))
            {
                $username = $strUserstrUser;

                $password = $strPassword;

                // $message = "Name of provider:$nameBp Customer Name:$ustrName  Recharge  done on  $curdateTime Plan Amount:$pricePaid Plan Name: $vstrPlanName Recharge successful";
                $message = "Dear $ustrName \n Recharge of Rs. $pricePaid for Plan $vstrPlanName is done on $urenew_CurDate and will expire on $endate\nRegards\n$cmpname";
                $sender = $strSenderID; //ex:INVITE


                //$mobile_number1 = $adminstrPhoneNo;

                $url = "bulksms.myospaz.in/sendmessage.php?user=" . urlencode($username) . "&password=" . urlencode($password) . "&mobile=" . urlencode($strPhone) . "&message=" . urlencode($message) . "&sender=" . urlencode($sender) . "&type=" . urlencode('3');

                $ch = curl_init($url);

                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                $curl_scraped_page = curl_exec($ch);

                curl_close($ch);
            }

        }
    }
    if (!$record3) {

        echo "<script>alert('Plan is not updated')</script>";
        echo "<script type='text/javascript'>window.location.href ='registeruser.php';</script>";
    }
}


?>


<?php
$bp=$_SESSION['bpname'];
include_once 'config.php';
include_once $bp;
$sql="SELECT * FROM `tblbrodbandprovider` WHERE `strConfigName`='$bp'";
$record=mysqli_query($con,$sql);

while($row=mysqli_fetch_array($record))
{

    //logo of bp
    $image=$row['logo'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BroadbandWale!</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- For popup css start-->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="popup/B.css" rel="stylesheet" type="text/css">
    <script src="popup/m.js"></script>
    <script src="popup/h.js"></script>
    <!-- For popup css end-->
    <style>

        .register-box {
            width: 675px;
            margin: 7% auto;
        }
        #right-side {
            float: right;
            width: 60%;
            padding: 3px 0px;
            position: relative;
            top: -37px;}
        #left-side {
            width: 39%;
            /* float: left; */
            height: 93%;
            position: relative;
            padding: 4px 0px;
        }#hideShowBankDetails{
             display:none;
         }#hideShowBankDetails{
              display:none;
          }
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a class="logo">

            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b><?php echo $_SESSION['login_user'];  ?></b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?php echo $image ?>" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?php echo $_SESSION['login_user'];  ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="<?php echo $image ?>" class="img-circle" alt="User Image">

                                <!--p>
                  <?php echo $_SESSION['login_user'];  ?> - Web Developer
                  <small>Member since Nov. 2012</small>
                </p-->
                                <br/>
                                <div class="pull-right">
                                    <a href="lagout.php" class="btn btn-danger btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->

                </ul>
            </div>
        </nav>
        <script type="text/javascript">

            function sayHelloWorld() {
                alert('hello');
            }

            function getPlan(plan) {

                var strURL = "findplan.php?planname=" + plan;

                var req = getXMLHTTP();

                if (req) {
                    req.onreadystatechange = function () {
                        if (req.readyState == 4) {
                            if (req.status == 200) {

                                document.getElementById('pricediv').innerHTML = req.responseText;

                            }
                            else {
                                alert("Problem while using XMLHTTP:\n" + req.statusText);
                            }
                        }
                    }
                    req.open("GET", strURL, true);
                    req.send(null);
                }


            }

            function getplanAcorddingZone(planZone) {



                var select = document.getElementById("zone_areaId");
                var zone_areaId = select.options[select.selectedIndex].value;
                //alert(zone_areaId,select)

                var strURL = "planZoneIdLoad.php?planZone=" + planZone +"&zone_areaId="+zone_areaId;


                var req = getXMLHTTP();

                if (req) {
                    req.onreadystatechange = function () {
                        if (req.readyState == 4) {
                            if (req.status == 200) {

                                document.getElementById('plandiv3').innerHTML = req.responseText;

                            }
                            else {
                                alert("Problem while using XMLHTTP:\n" + req.statusText);
                            }
                        }
                    }
                    req.open("GET", strURL, true);
                    req.send(null);
                }


            }
            function findTotal() {
                var arr = document.getElementById('qty1').value;
                var ar2 = document.getElementById('qty2').value;
                var ar= document.getElementById('disc').value;

                var tot = 0;
                var tot1=0;
                tot1 = arr - ar2;
                tot = tot1 - ar;
                //alert(tot1);
                //alert(tot);
                //for(var i=0;i<arr.length;i++){
                //  if(parseInt(arr[i].value))
                // tot = parseInt(arr[0].value)-parseInt(arr[1].value);
                //}
                document.getElementById('txt_ramt').value = tot;
                //alert(tot);
            }

            function detailsAdd(changeHide) {
                if(changeHide == 'cheque'){
                    $('#hideShowBankDetails').show();
                    $('#hideonlineShowBankDetails').hide();

                }
                else if(changeHide == 'cash'){
                    $('#hideShowBankDetails').hide();
                    $('#hideonlineShowBankDetails').hide();
                    //alert(changeHide);
                }else if(changeHide == 'online'){
                    // alert(changeHide)
                    $('#hideonlineShowBankDetails').show();
                    $('#hideShowBankDetails').hide();
                }
                else if(changeHide == 'card'){
                    // alert(changeHide)
                    $('#hideonlineShowBankDetails').show();
                    $('#hideShowBankDetails').hide();
                }
            }
        </script>

    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <?php
    include_once 'header.php';
    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">


        </section>

        <!-- Main content -->
        <section class="content">


            <div class="register-box"  >

                <div class="register-box-body" style="    height: 765px;">
                    <p class="login-box-msg" style="font-size:30px" >Renew Plan & Payment</p>
                    <p class="login-box-msg" style="font-size: 18px;"><a  href="payRemmeningBalance.php?id=<?php echo base64_encode($id)?>&remaine=<?php echo base64_encode($ustradvpaidu) ?>&bpid=<?php echo base64_encode($ustrBPId) ?>">Remaining Balance
                            is:<?php echo "<b style='color: red;'>". $ustradvpaidu ."</b>"?> </a></p>

                    <div style='height: 496px; position: relative;'>
                        <form action="" name="myform" method="post">


                            <div class="form-group has-feedback">
                                <div id="left-side">  <b>Username</b></div>
                                <div id="right-side"><input disabled type="text" style="width: 100%; height: 36px;" name="txt_user1" value="<?php echo $id; ?>"</div>
                            </div>

                    </div>
                    <div class="form-group has-feedback">
                        <div id="left-side"> <b>Zone Name:</b></div>

                        <div id="right-side">  <select class="form-control" name="drpdwn_zone" onclick="getvalueZone1(this.value)">

                                <?php
                                $db = $_SESSION['bpname'];
                                include_once $db;
                                $query = "SELECT DISTINCT strZoneName from tblzone";
                                $record = mysqli_query($conn, $query);
                                //echo "select a zone";
                                ?>

                                <?php while ($row = mysqli_fetch_array($record)) {
                                    if ($row['strZoneName'] == $strZoneNameVal1) {
                                        ?>
                                        <option selected value="<?php echo $row['strZoneName'] ?>"><?php echo $row['strZoneName'] ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $row['strZoneName'] ?>"><?php echo $row['strZoneName'] ?></option>
                                    <?php }
                                } ?>


                            </select></div>
                    </div>
                    <div class="form-group has-feedback">
                        <div id="left-side"><b>Zone Area:&nbsp;</b></div>
                        <div id="right-side"><div id="pricediv3">
                                <select class="form-control" name="zone_area" id="zone_areaId">
                                    <option value="<?php echo $ZoneId ?>" readonly style="width:100%;border-radius:10px 10px"><?php echo $strZoneAreaVal1 ?>
                                    </option>
                                </select>
                            </div></div>
                    </div>
                    <div class="form-group has-feedback">
                        <div id="left-side">  <b>Type:&nbsp;</b></div>
                        <div id="right-side">
                            <?php ?>
                            <select class="form-control"    name="drpdwn_type" onchange="getplanAcorddingZone(this.value)">
                                <!--  <?//php if($strType){ ?> <option value="<?php// echo $strType ?>" selected><?php//echo $strType ?></option>-->
                                <option>Select</option>
                                <!-- <option value="">Select Type</option>-->
                                <option value="LIMITED">LIMITED</option>
                                <option value="UNLIMITED">UNLIMITED</option>
                                <option value="FUP">FUP</option>
                            </select></div>
                    </div>
                    <div class="form-group has-feedback">
                        <div id="left-side">  <b>Plan:</b></div>
                        <div id="right-side">  <div id="plandiv3"><select class="form-control" name="drpdwn_plan" onclick="getPlan(this.value)">
                                    <option value=""selected>Select Plan</option>
                                    <option selected value='<?php echo $planId?>'><?php echo  $planName ?></option>

                                </select>
                            </div></div>
                    </div>
                    <div class="form-group has-feedback">
                        <div id="left-side"><b>Price:&nbsp;</b></div>
                        <div id="right-side"><div id="pricediv">
                                <input id="qty1" type="text" class="form-control" name="txt_Planrate"
                                       value=<?php echo $price ?>  readonly>
                            </div></div>
                    </div>


                    <div class="form-group has-feedback">
                        <div id="left-side"><b>Discount:&nbsp;</b></div>
                        <div id="right-side"><div id="discdiv">
                                <input id="disc"  type="text" name="discount"
                                       placeholder="discount in rupees" style="width:100%;height:36px">
                            </div></div>
                    </div>

                    <?php  $date= date('Y-m-d');?>

                    <div class="form-group has-feedback">
                        <div id="left-side">  <b>Date</b></div>
                        <div id="right-side"><input  type="date" style="width: 100%; height: 36px;" name="renew_CurDate" value="<?php echo $date; ?>"</div>
                    </div>
                    <div class="form-group has-feedback">
                        <div id="left-side"><b>Mode Payment:&nbsp;</b></div>
                        <div id="right-side"><select name="drpdwn_payment"  onchange="detailsAdd(this.value)" style="width: 100%;height: 31px;">
                                <option value="modeofpayment"> Select mode of payment</option>
                                <option  value="cash">Cash</option>
                                <option  value="online">Online</option>
                                <option value="cheque">Cheque</option>
                                <option value="card">Card</option>

                            </select></div>
                    </div>
                    <div id='hideShowBankDetails' style="margin: 37px 0px;">
                        <div class="form-group has-feedback">
                            <div id="left-side"></div>
                            <div id="right-side"><input  type="text" style="width: 100%; height: 36px;" placeholder="Please Enter Cheque No" name="chequeNo"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <div id="left-side"></div>
                            <div id="right-side"><input  type="text" style="width: 100%; height: 36px;" placeholder="Please Enter Your Bank Name" name="bankName">
                            </div>
                        </div>
                    </div>
                    <div id='hideonlineShowBankDetails' style="margin: 37px 0px;">
                        <div class="form-group has-feedback">
                            <div id="left-side"></div>
                            <div id="right-side"><input  type="text" style="width: 100%; height: 36px;" placeholder="Please Enter Transaction id" name="tranjectionid"></div>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <div id="left-side"><b>Paid:&nbsp;</b></div>
                        <?php if($priceadv< 0){?>
                            <div id="right-side">
                                <input type="number"  id="qty2"  name="txt_paid"
                                       style="width:100%;height: 36px" ></div>
                        <?php }else{ ?>
                            <div id="right-side">
                                <input type="number" onblur="findTotal()" id="qty2" name="txt_paid"
                                       style="width:100%;height: 36px" ></div>
                        <?php }?>
                    </div>

                    <?php if($priceadv< 0){?>
                        <div class="form-group has-feedback">
                            <div id="left-side">    <b>Balance:</b></div>
                            <div id="right-side">  <input type="number" name="txt_ramt" id="txt_ramt" style="width: 100%;height: 36px;" value=<?php echo $ustradvpaidu ?>></div>
                        </div>
                    <?php }else{ ?>
                        <div class="form-group has-feedback">
                            <div id="left-side">  <b>Remaining Amount:</b></div>
                            <div id="right-side">   <input type="number" name="txt_ramt" style="width: 100%;height: 36px;" id="txt_ramt"></div>
                        </div>
                    <?php }?>
                    <div class="form-group has-feedback">
                        <div id="left-side">  <b>BY Whom:</b></div>
                        <div id="right-side">
                            <select name="myselect_empId" class="form-control">
                                <option value="">all Employee</option>
                                <?php include_once 'config.php';
                                $bpidAll= $_SESSION['validUser'];
                                $sql="SELECT * FROM `tblemployee` WHERE `strBpid`='$bpidAll'";
                                $record=mysqli_query($con,$sql);

                                while($row=mysqli_fetch_array($record))
                                {

                                    //logo of bp
                                    $istrEmpId=$row['strEmpId'];
                                    $istrEmpName=$row['strEmpName'];
                                    ?>

                                    <option value="<?php echo $istrEmpId?>" ><?php echo $istrEmpName?></option>

                                    <?php
                                }
                                ?>
                            </select>
                        </div>


                        <input type="checkbox" name="smscheck" style="zoom: 1.3;" checked>
                        <i style="color:#000000;font-size:10px">*If you don`t want to send the sms then please uncheck the checkbox before submit.</i>


                        <div class="form-group has-feedback"> <button style="width:29%;margin: 8px 254px;position: absolute;" type="submit" class="btn btn-primary btn-block btn-flat" name="submit">Submit</button></div>

                        <input type="hidden" name="txt_id" value="<?php echo $username; ?>">

                        <input type="hidden" name="row_id" value="<?php echo $uintId; ?>">

                        <input type="hidden" name="add_id" value="<?php echo $userstrAdd; ?>"
                        <input type="hidden" name="custName" value="<?php echo $ustrName; ?>"
                        <br/>


                        <!-- /.col -->
                    </div>

                    </form>



                </div>
                <!-- /.form-box -->
            </div>



        </section>
        <!-- /.content -->
    </div>

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!--/.Page Content -->





<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="findZoneFunAllfile.js"></script>
</body>
</html>

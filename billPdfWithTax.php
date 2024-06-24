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
$shopidBn = $_SESSION['shopidu'];
$uname2=substr($uname,4,5);

$custid1=$_GET['custid'];
$proid1=$_GET['proId'];
$custid=base64_decode($custid1);
$proid=base64_decode($proid1);
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>EasyBilling| Product:: Billing</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="Modern Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design"/>
    <script type="application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        } </script>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css'/>
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css'/>
    <!-- Graph CSS -->
    <link href="css/lines.css" rel='stylesheet' type='text/css'/>
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
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
    <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>-->

    <script src="mainScript.js"></script>
    <!--del_Product-->
    <!--update product-->
    <link rel="stylesheet" href="css/clndr.css" type="text/css"/>
    <script src="js/underscore-min.js" type="text/javascript"></script>
    <script src="js/moment-2.2.1.js" type="text/javascript"></script>
    <script src="js/clndr.js" type="text/javascript"></script>
    <script src="js/site.js" type="text/javascript">
    </script>
    <!--update Product-->
</head>
<body style="background: floralwhite;" >
<!--<div id="wrapper" style="border:1px solid">-->
    <!-- Navigation -->
    <!--<div id="page-wrapper">-->

       <!-- <form  method='post'>-->
            <div class="content_bottom" style="background: floralwhite;border:1px solid">
                <div class="col-md-12 ">
                    <div class="col-md-8 " style="    margin: 8px 14%;">
                        <?php


                        include_once 'config.php';
                        $querySelect = "SELECT * FROM `shop` WHERE `id`='$shopidBn'";
                        $recordSelect = mysqli_query($conn, $querySelect);


                        echo "<table class='table table-bordered'>";
                        while ($row = mysqli_fetch_array($recordSelect)) {
                            $logoImage = $row["logo"];
                            $Admingst = $row["gst"];
                            $logoImage = $row["logo"];
                            $pgst = $row["gst"];
                            $pBillTerms = $row["BillTerms"];
                            $pIFSCCode = $row["IFSCCode"];
                            $pBankAccountNumber = $row["BankAccountNumber"];
                            $pBankName = $row["BankName"];
                            ?>
                            <?php
                            echo "<tr  style='cursor:pointer;color:black;text-align:center'>";

                            echo "<td  style='color:black;padding: 4px !important;width: 2px;'><img src='img/$logoImage' style='width: 130px;height: 69px;'></td><td><h3 style='top: 31%;right: 3%;position: absolute;'>INVOICE</h3><h4>" . $row['shopname'] ."\n". "</h4> <h6 style='width: 46% ;margin: 0px 31%;'>" . $row['address'] . "<br> </h6 ><img src='img/Untitled.png' style='width: 4%;margin: 1px 2%;'>&#160;&#160;&#160;&#160;&#160;&#160;&#160;" . $row['phone'] . "<br><i class='fa fa-envelope-o' style='margin: 1px 2%;    width: 5%;    position: relative;text-align: right'></i>&#160;&#160;&#160;&#160;&#160;&#160;&#160; " . $row['email'] . "<br><img src='img/gst.png' style='width: 3%;    margin: 1px -38px;position: absolute;'> &#160;&#160;" . $row['gst'] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                        ?>
                        <style>  .form-control-1 {
                                width: 100%;
                                height: 36px;
                            }

                            .th-id {
                                width: 27%;
                            }
                        </style>
                    </div>



                </div>
                <div class="col-md-12">
                    <div class="col-md-8 " style="margin: 0px 14%;">

                        <table class="table table-condensed" border="1">
                            <?php

                            $querySelect="SELECT * FROM `phonebook` WHERE `cid`='$custid'";
                            $recordSelect=mysqli_query($conn,$querySelect);

                            while($row=mysqli_fetch_array($recordSelect)) {
                                $phonenumber=  $row["phonenumber"] ;
                                $pname=  $row["name"] ;
                                $paddress=  $row["address"] ;
                                $pemail=  $row["email"] ;
                                $pegst=  $row["gst"] ;
                                $pstate=  $row["states"] ;
                                $pstateCode=  $row["statesCode"] ;

                            }
                            $querySelect="SELECT * FROM `tbltransaction` WHERE `custid`='$custid' and tid='$proid'";
                            $recordSelect=mysqli_query($conn,$querySelect);

                            while($row=mysqli_fetch_array($recordSelect)) {
                                $billno=  $row["billno"] ;
                                $ptdate=  $row["tdate"] ;
                                $ptoword=  $row["inwords"] ;
                                // $paddress=  $row["address"];

                            }
                            $invoiceDate = date("d-m-Y", strtotime($ptdate));
                            ?>
                            <thead>
                            <tr>
                            <th>Details Of Customer</th>
                            <th>Details Of Bill</th>
                            <tr>
                                <th class="th-id">Customer Name:<?php echo "\t". "\t"."\t". "\t". $pname?></th> <th class="th-id">Bill No:<?php echo "\t". "\t"."\t". "\t". $billno?></th></tr>
                            <tr><th class="th-id"><i class="fa fa-phone" aria-hidden="true"></i><?php echo "\t". "\t"."\t". "\t". $phonenumber?>&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;<i class="fa fa-envelope" aria-hidden="true"></i><?php echo "\t". "\t"."\t". "\t". $pemail?></th><th class="th-id">Invoice Date:<?php echo "\t". "\t"."\t". "\t". $invoiceDate?></tr>
                            <tr> <th class="th-id"><i class="fa fa-taxi" aria-hidden="true"></i>&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;<?php echo  "\t". "\t"."\t". "\t".$paddress  ?><br><img src='img/gst.png' style='width: 19px;position: absolute;margin: 1% 0%;'>&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;<h6 style="margin:-3% 12%;"><?php echo $pegst;?></h6> </th><th><h6>States:&#160;&#160;&#160;&#160;&#160;<?php echo $pstate ?></h6><img src='img/gst.png' style='width: 19px;position: absolute;margin: 1% 0%;'>&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;<h6 style="margin:-3% 12%;"><?php echo $Admingst;?></h6> </th></tr>
                            </tr>
                            </thead>
                        </table>
                    </div>


                </div>
                <div class="col-md-12">
                    <div class="col-md-8" style= " margin: 0% 14%">
                        <?php
                        echo "<table class='table table-condensed' border='1' >
                            <thead>
                            <tr >
                                <th style='text-align: center;''>Total</th>
                                <th style='text-align: center;''>Paid</th>
                                <th style='text-align: center;''>Remaining</th>
                                <th style='text-align: center;''>Mode Of Payment</th>
                            </tr></thead>";
                        $sql="SELECT * FROM `tbltransaction` WHERE `custid`='$custid' and tid='$proid'";
                        $record=mysqli_query($conn,$sql);

                        while($row=mysqli_fetch_array($record)) {
                            $btotal = $row["btotal"];
                            $bpaid = $row["paid"];
                            $bdiscount = $row["discount"];
                            $bremaining= $row["remaining"];
                            $bmodeOfPayment = $row["modeOfPayment"];
                            $batotal = $row["atotal"];
                            $tdate = $row["tdate"];
                        }
                        echo"<tbody>";
                        echo"<tr>";
                        echo "<td style='text-align: center;''>" . $btotal . "</td>";
                        echo "<td style='text-align: center;'>" . $bpaid . "</td>";
                        echo "<td style='text-align: center;'>" . $bremaining . "</td>";
                        echo "<td style='text-align: center;'>" . $bmodeOfPayment . "</td>";
                        echo "</tr>";
                        ?>
                        </table>
                    </div>
                                    </div>

                        <div class="col-md-12" >
                        <div class="col-md-8" style="margin: 0% 14%" >



                            <table class='table table-condensed' border='1' >
                                <tr>
                                    <th>#</th>
                                    <th class="SNo">HSN-CODE</th>
                                    <th class="SNo">Product</th>
                                    <th class="SNo">MRP</th>
                                    <th class="SNo">MRP With Tax</th>
                                    <th class="SNo">Quantity</th>
                                    <th class="SNo">Total</th>
                                    <th class="SNo"> C-GST</th>
                                    <th class="SNo"> C-GST Amt</th>
                                    <th class="SNo"> S-GST</th>
                                    <th class="SNo"> S-GST Amt</th>
                                    <th class="SNo"> Net Amt</th>
                                    <th class="SNo">Offer Amt</th>
                                    <th class="SNo">Final Amt</th>

                                </tr>


<?php $sql="SELECT * FROM `tbltransaction` WHERE `custid`='$custid' AND shopid ='$shopidBn' and tid='$proid'";
$record=mysqli_query($conn,$sql);

while($row=mysqli_fetch_array($record)) {
    $btotal = $row["btotal"];
    $bpaid = $row["paid"];
    $bdiscount = $row["discount"];
    $bremaining = $row["remaining"];
    $bmodeOfPayment = $row["modeOfPayment"];
    $batotal = $row["atotal"];
    $tdate = $row["tdate"];
}

$sql="SELECT t.* FROM `tblitem` t   WHERE t.`tid`='$proid' AND   t.`statusQT`='T' AND t.shopid ='$shopidBn'";
$record=mysqli_query($conn,$sql);

$countTot='';
$countTot1='``';
$countCgst='';
$countSgst='';
$zen=1;
while($row=mysqli_fetch_array($record)) {

    echo "<tr >";
    echo "<td  style='min-height: 453px;flot:left;text-align: center;word-break: break-all;white-space: normal;height: auto;overflow: hidden;word-wrap: break-word;line-height: 11PX;'>" . $zen . "</td>";
    echo "<td  style='min-height: 453px;flot:left;text-align: center;word-break: break-all;white-space: normal;height: auto;overflow: hidden;word-wrap: break-word;line-height: 11PX;'>" . $row["hsncode"] . "</td>";
    echo "<td  style='min-height: 453px;flot:left;text-align: center;word-break: break-all;white-space: normal;height: auto;overflow: hidden;word-wrap: break-word;line-height: 11PX;'>" . $row["pname"] . "</td>";
    echo "<td  style='min-height: 453px;flot:left;text-align: center;word-break: break-all;white-space: normal;height: auto;overflow: hidden;word-wrap: break-word;line-height: 11PX;'>" . $row["unitprice"] . "</td>";
    echo "<td  style='min-height: 453px;flot:left;text-align: center;word-break: break-all;white-space: normal;height: auto;overflow: hidden;word-wrap: break-word;line-height: 11PX;'>" . $row["with_mrp_tax_price"] . "</td>";
    echo "<td  style='min-height: 453px;flot:left;text-align: center;word-break: break-all;white-space: normal;height: auto;overflow: hidden;word-wrap: break-word;line-height: 11PX;'>" . $row["quantity"] . "</td>";
    echo "<td  style='min-height: 453px;flot:left;text-align: center;word-break: break-all;white-space: normal;height: auto;overflow: hidden;word-wrap: break-word;line-height: 11PX;'>" . $row["total"] . "</td>";
    echo "<td  style='min-height: 453px;flot:left;text-align: center;word-break: break-all;white-space: normal;height: auto;overflow: hidden;word-wrap: break-word;line-height: 11PX;'>" . $row["taxNameCgst"] . "</td>";
    echo "<td  style='min-height: 453px;flot:left;text-align: center;word-break: break-all;white-space: normal;height: auto;overflow: hidden;word-wrap: break-word;line-height: 11PX;'>" . $row["taxAmtCgst"] . "</td>";
    echo "<td  style='min-height: 453px;flot:left;text-align: center;word-break: break-all;white-space: normal;height: auto;overflow: hidden;word-wrap: break-word;line-height: 11PX;'>" . $row["taxname"] . "</td>";
    echo "<td  style='min-height: 453px;flot:left;text-align: center;word-break: break-all;white-space: normal;height: auto;overflow: hidden;word-wrap: break-word;line-height: 11PX;'>" . $row["taxAmtSgst"] . "</td>";
    echo "<td  style='min-height: 453px;flot:left;text-align: center;word-break: break-all;white-space: normal;height: auto;overflow: hidden;word-wrap: break-word;line-height: 11PX;'>" . $row["taxtotal"] . "</td>";
    echo "<td  style='min-height: 453px;flot:left;text-align: center;word-break: break-all;white-space: normal;height: auto;overflow: hidden;word-wrap: break-word;line-height: 11PX;'>" . $row["discount_price"] . "</td>";
    echo "<td  style='min-height: 453px;flot:left;text-align: center;word-break: break-all;white-space: normal;height: auto;overflow: hidden;word-wrap: break-word;line-height: 11PX;'>" . $row["finaltotal"] . "</td>";
    echo "</tr >";
    $countTot +=$row["taxtotal"];
    $countCgst +=$row["taxAmtCgst"];
    $countSgst +=$row["taxAmtSgst"];
    $zen++;
    $addcgstAndSgst=$countCgst+$countSgst;
    $addTotalGSt=$countTot+$addcgstAndSgst;
}
?>
                            </table>
                    </div>
                    </div>


                <div class="col-md-12">
                    <div class="col-lg-2" style="margin: 0px 14%">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                Bank Details
                                <th class="th-id">Bank Name:<?php echo $pBankName?></th>


                                <th class="th-id">Bank Account No:<?php echo $pBankAccountNumber?></th>


                                <th class="th-id">IFSC Code:<?php echo $pIFSCCode?></th>



                            </tr>
                            <tr><th class="th-id">Biil Terms <br>Notice:<?php echo $pBillTerms?></th></tr>
                            </thead>
                        </table>
                    </div>
                    <div class="col-lg-4" style="margin: -20px -6%;">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="th-id">Total Amt Before Tax</th>

                                <th style="text-align: right">
                                    <?php echo $batotal?>

                                </th>

                            </tr>
                            <tr>
                                <th class="th-id">Add CGST</th>

                                <th style="text-align: right">
                                    <?php echo $countCgst?>
                                </th>

                            </tr>
                            <tr>
                                <th class="th-id">Add CGST</th>

                                <th style="text-align: right">
                                    <?php echo $countCgst?>
                                </th>

                            </tr><tr>
                                <th class="th-id">Total GST AMT</th>

                                <th style="text-align: right">
                                    <?php echo $addcgstAndSgst?>
                                </th>

                            </tr><tr>
                                <th class="th-id">Discount</th>

                                <th style="text-align: right">
                                    <?php echo $bdiscount?>
                                </th>

                            </tr>
                            <tr>
                                <th class="th-id">GRAND TOTAL</th>

                                <th style="text-align: right">
                                    <?php echo $addTotalGSt?>
                                </th>

                            </tr>
                            <tr>
                                <th>
                                </th>
                                <th style="text-align: right">
                                    <?php echo $ptoword?>
                                </th>


                            </tr>
                            <tr><th><button  class="btn btn-success" onclick="myFunction()" id="print" style="width: 195px;background-color: #5cb85c;border-color: #4cae4c;">Print</button></th></tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
<script>

    document.getElementById('print').style.display = 'block';
    function myFunction() {
        document.getElementById('print').style.display = 'none';
        window.print();
    }
</script>
     <!--   </form>-->
<!-- </div>-->
<!--</div>-->

<!-- /#page-wrapper -->

<!-- /#wrapper -->
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script src="mainScript.js"></script>
</body>
</html>
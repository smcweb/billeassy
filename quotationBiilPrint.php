<!DOCTYPE html>
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
    // echo "<script>alert('session mentain')</script>";
}
$shopidval=$_SESSION['shopidu'];
$custid1=$_GET['custid'];
$proid1=$_GET['proId'];
$custid=base64_decode($custid1);
$proid=base64_decode($proid1);
$querySelect="SELECT * FROM `shop` WHERE `id`='$shopidval'";
$recordSelect=mysqli_query($conn,$querySelect);

while($row=mysqli_fetch_array($recordSelect)) {
    $phpshopname=  $row["shopname"] ;
}
$sql="SELECT * FROM `tblquotation` WHERE `custid`='$custid' and qid='$proid'";
$record=mysqli_query($conn,$sql);

while($row=mysqli_fetch_array($record)) {
    $bmodeOfPayment = $row["modeOfPayment"];

}
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $phpshopname;?></title>
    <link rel="stylesheet" href="style.css" media="all" />
    <link
            href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css"
            rel="stylesheet"  type='text/css'>
    <script src="jquery1.js"></script>
    <link src="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

 -->

    <style>
        b{
            margin-right: 2cm;
        }
        p{
            margin-right: -1cm;
        }
        div{
            margin-right: 1cm;
        }
        .button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;

        }
        .button1 {
            background-color: dodgerblue; /* Green */
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            width: 5%;

        }
    </style>
    <style>
        .dropbtn {
            background-color: darkgreen;
            color: white;
            padding: 10px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            width: 50%;
        }

        .dropdown {
            position: relative;

        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 200px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        #cheque{
            display: none;
        } #online{
              display: none;
          }
        table tr:nth-child(2n-1) td {
            background: #ffffff;
        }#project1{
             float: left;
             margin: 0px 3px;

             width: 65%;
         }


    </style>
    <style type="text/css" media="print">
        @media print {
            a {
                display:none;
            }
        }

        @media screen and projection {
            a {
                display:inline;
            }
        }
    </style>

</head>


<body>
<legend name="legend" id="legend" style="width: 100%;
MARGIN: 0PX -4PX;
height: 107%;
border: 1px solid">
    <div class="clearfix">
        <?php
        $querySelect="SELECT * FROM `tblquotation` WHERE `custid`='$custid' and qid='$proid'";
        $recordSelect=mysqli_query($conn,$querySelect);

        while($row=mysqli_fetch_array($recordSelect)) {
            $billno=  $row["billno"] ;

        }
        $querySelect="SELECT * FROM `shop` WHERE `id`='$shopidval'";
        $recordSelect=mysqli_query($conn,$querySelect);

        while($row=mysqli_fetch_array($recordSelect)) {
            $logoImage = $row["logo"];
            $pgstshop = $row["gst"];
            $pBillTerms = $row["BillTerms"];
            $pIFSCCode = $row["IFSCCode"];
            $pBankAccountNumber = $row["BankAccountNumber"];
            $pBankName = $row["BankName"];
            ?>
            <?php
            echo "<h1 style='border-top: 0px solid #5D6975;text-transform: uppercase;height: 15px;
border-bottom: 0px solid #5D6975;'>Quotation Invoice <p style='margin: -27px 27px;;
font-size: 15px;
float: left;
text-transform: uppercase;
position: absolute;
right: 356px;
color: rgb(61, 0, 255);'></p></h1> ";
            echo "<div id='project' style='    float: left;
    width: 100%;
    border: 1px solid;
    height: 132px;
    position: initial;  margin: 5px 11px;'>";
            echo "<div style='padding: 4px 0px;font-size: 20px;font-weight: bold;margin-left: 30%;'>" . $row["shopname"] . "</div>";
            echo "<div style='padding: 2px 0px;margin-left: 30%;font-size: 12px;font-weight: 100'>" . $row["address"] . "</div>";
            echo "<div style='padding: 2px 0px;margin-left: 30%;font-size: 12px;font-weight: 100 '>" . $row["email"] . "</div>";
            echo "<div style='padding: 2px 0px;margin-left: 30%;font-size: 12px;font-weight: 100'>" . $row["phone"] . "</div>";
            echo "<div style='padding: 2px 0px;margin-left:30%;font-size: 12px;font-weight: 100'>" . $row["shoptype"] . "</div>";
            echo "<div style='padding: 2px 0px;margin-left: 30%;font-size: 12px;font-weight: 100'>" . $pgstshop . "</div> ";

            echo "</div>";
        }
        ?>
        <div id="logo1" style="float: left;width:22%;">
            <img src="<?php echo "img/".$logoImage?>" style="position: absolute;
  width: 166px;
    top: 42px;
    left: 13px
    height: 116px;">
        </div>
        <!--div style="float: right;
    text-align: center;
    position: relative;
    right: 148px;
    top: -10px; font-size: 15px; font-weight: bold"> Invoice No: <?php /*echo $billno; */?></div>-->
        <div style="border: 1px solid;float: left;
    width: 100%;
    border: 1px solid;
    height: 160px;
    position: initial;    margin: 5px 11px;" >
            <!-- <h1 style="width:100%">MEGA SCAFFOLDING</h1>-->
            <?php


            ?>

            <?php /*if (!isset($_POST['submit_val'])) { */?>
            <?php

            $querySelect="SELECT * FROM `phonebook` WHERE `cid`='$custid'";
            $recordSelect=mysqli_query($conn,$querySelect);

            while($row=mysqli_fetch_array($recordSelect)) {
                $phonenumber=  $row["phonenumber"] ;
                $pname=  $row["name"] ;
                $paddress=  $row["address"] ;
                $pemail=  $row["email"] ;
                $pstate=  $row["states"] ;
                $pgst=  $row["gst"] ;
                $pstateCode=  $row["statesCode"] ;

            }
            $querySelect="SELECT * FROM `tblquotation` WHERE `custid`='$custid' and qid='$proid'";
            $recordSelect=mysqli_query($conn,$querySelect);

            while($row=mysqli_fetch_array($recordSelect)) {
                $billno=  $row["billno"] ;
                $ptdate=  $row["tdate"] ;
                $ptoword=  $row["inwords"] ;
                // $paddress=  $row["address"];


            }

            $invoiceDate = date("d-m-Y", strtotime($ptdate));
            ?>

            <div id="company1" style="    float: left;
    width: 47%;
border-right: 1px solid;
height: 160px;
position: relative;
top: -5px;margin: 5px 11px;">


                <span style="float: left;    margin: 3px 16px;font-weight: bold;"> </span><?php echo "<div style='font-size: 15px;font-weight: bold;margin: 6px -18px;
float: left'>Details Of Customer</div>";?><br>

                <div style="border-bottom: 1px solid;
margin: 0px -12px;
width: 103%;
float: left;"></div>
                <span style="float: left;    margin: 5px 16px;font-weight: bold;"> Customer Name:&nbsp;&nbsp;</span><?php echo "<div style='margin: 22px 0px;text-transform: uppercase;font-weight: bold;'>" .  $pname . "</div>";?><br>


                &nbsp;<span style="float: left;margin: -33px 19px;font-weight: bold;">Adress:&nbsp;&nbsp;</span><?php echo "<div style='float: left;
margin: -47px 133px;
width: 288px;
word-wrap: break-word;
white-space: -moz-pre-wrap;
white-space: -hp-pre-wrap;
white-space: -o-pre-wrap;
white-space: -pre-wrap;
white-space: pre-wrap;
white-space: pre-line;
word-wrap: break-word;
word-break: break-all;'> " . $paddress  . "</div>";?><br><br>


                <span style="float: left;margin: -38px 16px;font-weight: bold;">Phone NO:&nbsp;&nbsp;</span><?php echo "<div style='float: left;margin: -40px 129px;'>" . $phonenumber . "</div>";?><br><br>

                <span style="float: left;margin: -45px 16px;font-weight: bold;"> Email:&nbsp;&nbsp;</span><?php echo "<div style='float: left;margin: -47px 123px;'>" . $pemail . "</div>";?><br><br>
                <span style="float: left;margin: -50px 16px;font-weight: bold;"> GST NO:&nbsp;&nbsp;</span><?php echo "<div style='float: left;margin: -51px 123px;font-weight: bold;'>" . $pgst . "</div>";?><br>
                <span style="float: left;margin: -45px 16px;font-weight: bold;"> State:&nbsp;&nbsp;</span><?php echo "<div style='float: left;margin: -47px 123px;'>" . $pstate . "  <p style='position: absolute;
    top: 114px;
    right: 71px;
    width: 92px;
    border-top: 1px solid;
    border-left: 1px solid;
    height: 33px;
    border-right: 1px solid;
    margin: 12px -48px;
    line-height: 34px;
    text-align: center;
    font-weight: bold;'>State Code: " . $pstateCode . "</p></div>";?><br><br>
            </div>
            <div id="company123" style="   float: left;
    width: 47%;
/*border-right: 1px solid;*/
height: 160px;
position: relative;
top: -5px;margin: 5px 11px;">


                <span style="float: left;    margin: 3px 16px;font-weight: bold;"> </span><?php echo "<div style='font-size: 15px;font-weight: bold;margin: 6px -18px;
float: left'>Details Of Bill</div>";?><br>

                <div style="border-bottom: 1px solid;
margin: 0px -22px;
width: 110%;
float: left;"></div>
                <span style="float: left;    margin: 5px 30px;font-weight: bold;"> Invoice NO:&nbsp;&nbsp;</span><?php echo "<div style='margin: 22px 0px;font-size: 12px;font-weight: bold;'>" .  $billno . "</div>";?><br>


                &nbsp;<span style="float: left;margin: -33px 19px;font-weight: bold;">Invoice Date:&nbsp;&nbsp;</span><?php echo "<div style='float: left;margin: -34px 133px;font-size: 12px;font-weight: bold;'> " . $invoiceDate  . "</div>";?><br><br>


                <span style="float: left;margin: -38px 41px;font-weight: bold;">GST NO:&nbsp;&nbsp;</span><?php echo "<div style='float: left;margin: -40px 129px;font-weight:bold'>" . $pgstshop . "</div>";?><br><br>

                <span style="float: left;margin: -45px 56px;font-weight: bold;"> State:&nbsp;&nbsp;</span><?php echo "<div style='float: left;margin: -47px 123px;font-weight:bold'>Maharastra <p style='position: absolute;
top: 114px;
right: 49px;
width: 92px;
border-top: 1px solid;
border-left: 1px solid;
height: 33px;
border-right: 1px solid;
margin: 12px -48px;
line-height: 35px;
text-align: center;'>State Code: 27</p></div>";?><br><br>
            </div>
        </div>
        <?php

        $sql="SELECT * FROM `tblquotation` WHERE `custid`='$custid' AND shopid ='$shopidval' and qid='$proid'";
        $record=mysqli_query($conn,$sql);
        $bremaining= 0;
        $bpaid = 0;
        while($row=mysqli_fetch_array($record)) {
            $btotal = $row["btotal"];

            $bdiscount = $row["discount"];

            $bmodeOfPayment = $row["modeOfPayment"];
            $batotal = $row["atotal"];
            $tdate = $row["tdate"];
            $ptoword=  $row["inwords"] ;
        }

        ?>
        <div style="    width: 96%;
    float: left;
    top: 348px;
    position: absolute;
    margin: 0px 12px;">
            <?php
            echo "<table id='tot-header'  class='table' style='border: 1px solid black;border-collapse: collapse;'>
         <thead>
                                                    <tr style='background-color:#d3d5d6;'>
                                                       <th style='color:black; width:10%;border: 1px solid black;'>Total</th>
                                                       <th style='color:black;width:10%;border: 1px solid black;'>Paid</th>
                                                       <th style='color:black;width:10%;border: 1px solid black;'>Remaining</th>
                                                       <th style='color:black;width:10%;border: 1px solid black;'>Mode Of Payment</th>
                                                    </tr></thead>";
            $sql="SELECT * FROM `tblquotation` WHERE `custid`='$custid' and qid='$proid'";
            $record=mysqli_query($conn,$sql);

            while($row=mysqli_fetch_array($record)) {
                $btotal = $row["btotal"];
                $bpaid = 0;
                $bdiscount = $row["discount"];
                $bremaining=0;
                $bmodeOfPayment = $row["modeOfPayment"];
                $batotal = $row["atotal"];
                $tdate = $row["tdate"];
            }
            echo"<tbody>";
            echo"<tr>";
            echo "<td style='color:black;border: 1px solid black;padding: 9px;text-align: center;'>" . $btotal . "</td>";
            echo "<td style='color:black;border: 1px solid black;padding: 9px;text-align: center;'>" . $bpaid . "</td>";
            echo "<td style='color:black;border: 1px solid black;padding: 9px;text-align: center;'>" . $bremaining . "</td>";
            echo "<td style='color:black;border: 1px solid black;padding: 9px;text-align: center;'>" . $bmodeOfPayment . "</td>";
            echo "</tr>";

            $sql="SELECT * FROM `tblquotation` WHERE `custid`='$custid' AND shopid ='$shopidval' and qid='$proid'";
            $record=mysqli_query($conn,$sql);

            while($row=mysqli_fetch_array($record)) {
                $btotal = $row["btotal"];
                $bpaid = 0;
                $bdiscount = $row["discount"];
                $bremaining = 0;
                $bmodeOfPayment = $row["modeOfPayment"];
                $batotal = $row["atotal"];
                $tdate = $row["tdate"];
            }
            ?>
            </table>
        </div>
        <div style="width:100%;position: absolute;  top: 408px;height:50%; overflow: hidden;border: 1px solid">
            <?php

            echo "<table  class='table' style='border: 1px solid black;border-collapse: collapse;position: absolute;height: 100%;'>
<tbody>
                                            <tr style='background-color:#d3d5d6;height: 34px;width: 953px;float: left;'>
                                               <th style='color:black;;width:31px; border: 1px solid black;padding: 9px;text-align: center;float: left;'>Sr.No</th>
                                               <th style='color:black;;width:163px; border: 1px solid black;padding: 9px;text-align: center;float: left;'>Item Name</th>
											    <th style='color:black;;width:50px; border: 1px solid black;padding: 9px;text-align: center;float: left;'>HSN Code</th>                                          
                                               <th style='color:black;;width: 42px; border: 1px solid black;padding: 9px;text-align: center;float: left;'>UOM</th> 
                                               <th style='color:black;;width:86px; border: 1px solid black;padding: 9px;text-align: center;float: left;'>Qty</th>
                                               <th style='color:black;;width:89px; border: 1px solid black;padding: 9px;text-align: center;float: left;'>Unit Price</th>
                                               <th style='color:black;;width:51px; border: 1px solid black;padding: 9px;text-align: center;float: left;'>Total</th>  
                                                <th style='color:black;;width:76px; border: 1px solid black;padding: 9px;text-align: center;float: left;'> Offer %</th> 
                                               <th style='color:black;;width:85px; border: 1px solid black;padding: 9px;text-align: center;float: left;'>Discount Price</th>                                          
                                                                                       
                                               <th style='color:black;width: 79px; border: 1px solid black;padding: 9px;text-align: center;float: left;'>Final Total</th>                                          
                                            </tr>";

            $sql="SELECT t.*, tt.`offerPercent`FROM `tblitem` t JOIN tbloffer tt ON t.`oid`=tt.`offerid`  WHERE t.`tid`='$proid' AND t.`statusQT`='Q' AND t.shopid ='$shopidval'";
            $record=mysqli_query($conn,$sql);

            $zen=1;
            while($row=mysqli_fetch_array($record)) {

                echo "<tr style='background-color:white;height: 31px;position: relative;width: 953px;float: left;border-right: 1px solid black;'>";
                echo "<td style='min-height: 564px;width: calc(100%/10);border-bottom: 1px solid black;color:black;width:31px;border-right: 1px solid black;padding: 9px;text-align: center;float: left; word-wrap:break-word; height: 60%;'>" . $zen . "</td>";
                echo "<td style='min-height: 564px;width: calc(100%/10);border-bottom: 1px solid black;color:black;width:167px;border-right: 1px solid black;padding: 9px;text-align: center;float: left; word-wrap:break-word; height: 60%;line-height: 11px;'>" . $row["pname"] . "</td>";
                echo "<td style='min-height: 564px;width: calc(100%/9);border-bottom: 1px solid black;color:black;width:50px;border-right: 1px solid black;padding: 9px;text-align: center;float: left;'>" . $row["hsncode"] . "</td>";
                echo "<td style='min-height: 564px;width: calc(100%/9);border-bottom: 1px solid black;color:black;width:42px;border-right: 1px solid black;padding: 9px;text-align: center;float: left;'></td>";

                echo "<td style='min-height: 564px;width: calc(100%/9);border-bottom: 1px solid black;color:black;width:86px;border-right: 1px solid black;padding: 9px;text-align: center;float: left;'>" . $row["quantity"] . "</td>";
                echo "<td style='min-height: 564px;width: calc(100%/9);border-bottom: 1px solid black;color:black;width:90px;border-right: 1px solid black;padding: 9px;text-align: center;float: left;'>" . $row["unitprice"] . "</td>";
                echo "<td style='min-height: 564px;width: calc(100%/9);border-bottom: 1px solid black;color:black;width:53px;border-right: 1px solid black;padding: 9px;text-align: center;float: left;'>" . $row["total"] . "</td>";
                echo "<td style='min-height: 564px;width: calc(100%/9);border-bottom: 1px solid black;color:black;width:76px;border-right: 1px solid black;padding: 9px;text-align: center;float: left;'>" . $row["offerPercent"] . "</td>";
                echo "<td style='min-height: 564px;width: calc(100%/9);border-bottom: 1px solid black;color:black;width:87px;border-right: 1px solid black;padding: 9px;text-align: center;float: left;'>" . $row["discount_price"] . "</td>";

                echo "<td style='min-height: 564px;width: calc(100%/9);border-bottom: 1px solid black;color:black;width:79px;border-right: 1px solid black;padding: 9px;text-align: center;float: left;'>" . $row["taxtotal"] . "</td>";

                echo "</tr >";
                $zen++;
            }

            echo"</tbody>";
            echo"</table>";

            ?>

        </div>

        <div style="     right: 136px;
    width: 20%;
    position: absolute;
    bottom: 151px;">
            <table  class='table' style='border: 1px solid black;border-collapse: collapse;position: absolute;height: 100%;'>


                <tr style='background-color:white;height: 31px;position: relative;float: left;    border: 1px solid black;border-bottom: 0px solid #C1CED9;'>
                    <th  style='padding: 5px 20px;color: black;white-space: nowrap;font-weight: normal;'></th>
                    <th  style='padding: 5px 20px;color:black;white-space: nowrap;font-weight: normal;'></th>
                    <th colspan='5' style='padding: 5px 20px;color: black;white-space: nowrap;font-weight: normal;'></th>
                    <th colspan='1' style='padding: 5px 20px;color: black;white-space: nowrap;font-weight: normal;width: 287px;height: 26px;border-right: 1px solid black;'>SubTotal</th>
                    <th colspan='1' style='padding: 5px 21px;color: black;white-space: nowrap;font-weight: normal;width: 37px;'> <?php echo $btotal?> </th>
                </tr>
                <tr style='background-color:white;height: 31px;position: relative;float: left;    border: 1px solid black;border-bottom: 0px solid #C1CED9;'>
                    <th  style='padding: 5px 20px;color: black;white-space: nowrap;font-weight: normal;border-top: 1px solid black;'></th>
                    <th  style='padding: 5px 20px;color: black;white-space: nowrap;font-weight: normal;border-top: 1px solid black;'></th>
                    <th colspan='5' style='padding: 5px 20px;color: black;white-space: nowrap;font-weight: normal;border-top: 1px solid black;'></th>
                    <th rowspan='1' style='padding: 5px 41px;color: black;white-space: nowrap;font-weight: normal;border-top: 1px solid black;border-right: 1px solid black;    height: 23px;width: 88px;'>Discount</th>
                    <th rowspan='1' style='padding: 5px 27px;color: black;white-space: nowrap;font-weight: normal;border-top: 1px solid black;width: 55px;'> <?php echo $bdiscount ?> </th>

                </tr>
                <tr style='background-color:white;height: 26px;position: relative;float: left;    border: 1px solid black;border-bottom: 0px solid #C1CED9;'>
                    <th  style='padding: 5px 40px;color:black;white-space: nowrap;font-weight: normal;border-top: 1px solid black;'></th>
                    <th  style='padding: 5px 13px;color: black;white-space: nowrap;font-weight: normal;border-top: 1px solid black;'></th>
                    <th colspan='5' style='padding: 5px 20px;color: black;white-space: nowrap;font-weight: normal;border-top: 1px solid black;'></th>
                    <th rowspan='1' style='padding: 5px 25px;color: black;white-space: nowrap;font-weight: normal;border-top: 1px solid black;border-right: 1px solid black;'>Grand Total</th>
                    <th rowspan='2' style='padding: 5px 21px;color: black;white-space: nowrap;font-weight: normal;border-top: 1px solid black;'> <?php echo $batotal?> </th>

                </tr>
            </table>
        </div>
        <div style="float: left;
position: absolute;
          bottom: 131px;
    left: 5px;
    line-height: 15px;
font-weight: bold;"><?php echo  $ptoword?></div>
        <?php
        echo "<div id='project1'>";
        echo "<div style='padding: 1px 8px 3px;    bottom:13px;
    position: absolute;
    border: 1px solid #151514;
    width: 45%;
    height: 104px;'><div style='float: left;
margin: 0px 123px;
padding: 5px;
font-size: 15px;
font-weight: bold'>Bank Details</div>
<div style='float: left;width: 152px;
padding: 3px;'>Bank Name</div>
    <div style='float: left;width: 152px;
padding: 3px;'>$pBankName</div><div style='float: left;width: 152px;
padding: 3px;'>Bank Account Number</div>
    <div style='float: left;width: 152px;
padding: 3px;'>$pBankAccountNumber</div>
    <div style='float: left;width: 152px;
padding: 3px;'>IFSC Code</div><div style='float: left;width: 152px;
padding: 3px;'> $pIFSCCode</div></div>";

        ?>
        <div style="margin: 0px 81%;
		position: absolute;
		bottom: 0px;
		width: 150px;">
            <b style='    float: left;
   margin: 11px -96px;
    width: 28px;'>For</b><b style='    float: left;
      margin: 11px -64px;
    width: 234px;'><?php echo $uname;?></b>
            Authorised Sign & Stamp
        </div>
        <div style="margin: -17px 51%;
    position: absolute;
    bottom: 1px;">
            <button name="print" id="print" onclick="myFunction()"  class="button" style="margin-left: 5%">Print</button>
        </div>

        </span>
    </div>


    </div>
    <!-- </form>-->
    </header>
</legend>

<?php /*} */?>
<style>
    #legend {
        border-style: solid;
        border-width: medium;
    }
    #words{
        width:200px;
    }
</style>
<script>
    document.getElementById('print').style.display = 'block';
    function myFunction() {
        document.getElementById('print').style.display = 'none';
        window.print();
    }
</script>

<script type="text/javascript">

    function getXMLHTTP()
    { //fuction to return the xml http object
        var xmlhttp=false;
        try
        {
            xmlhttp=new XMLHttpRequest();
        }
        catch(e)
        {
            try
            {
                xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch(e)
            {
                try
                {
                    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                }
                catch(e1)
                {
                    xmlhttp=false;
                }
            }
        }
        return xmlhttp;

    }


</script>
</main>

</body>
</html>
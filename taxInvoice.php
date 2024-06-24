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
$sql="SELECT * FROM `tbltransaction` WHERE `custid`='$custid' AND tid='$proid'";
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
MARGIN: 0PX -3PX;
height: 105%;
border: 1px solid">
    <div class="clearfix">
        <?php
        $querySelect="SELECT * FROM `tbltransaction` WHERE `custid`='$custid' AND tid='$proid'";
        $recordSelect=mysqli_query($conn,$querySelect);

        while($row=mysqli_fetch_array($recordSelect)) {
            $billno=  $row["billno"] ;

        }
        $querySelect="SELECT * FROM `shop` WHERE `id`='$shopidval'";
        $recordSelect=mysqli_query($conn,$querySelect);

        while($row=mysqli_fetch_array($recordSelect)) {
            $logoImage = $row["logo"];
            $pgst = $row["gst"];
            $pBillTerms = $row["BillTerms"];
            $pIFSCCode = $row["IFSCCode"];
            $pBankAccountNumber = $row["BankAccountNumber"];
            $pBankName = $row["BillTerms"];
            ?>
            <?php
            echo "<h1 style='border-top: 0px solid #5D6975;text-transform: uppercase;height: 15px;
border-bottom: 0px solid #5D6975;'>Tax Invoice <p style='margin: -27px 27px;;
font-size: 15px;
float: left;
text-transform: uppercase;
position: absolute;
right: 356px;
color: rgb(61, 0, 255);'></p></h1> ";
            echo "<div id='project' style='    float: left;
    width: 101%;
    border: 1px solid;
    height: 152px;
    position: initial;  margin: 5px 11px;'>";
            echo "<div style='padding: 4px 0px;font-size: 20px;font-weight: bold;margin-left: 20%;'>" . $row["shopname"] . "</div>";
            echo "<div style='padding: 2px 0px;margin-left: 20%;font-size: 12px;font-weight: 100'>" . $row["address"] . "</div>";
            echo "<div style='padding: 2px 0px;margin-left: 20%;font-size: 12px;font-weight: 100 '>" . $row["email"] . "</div>";
            echo "<div style='padding: 2px 0px;margin-left: 20%;font-size: 12px;font-weight: 100'>" . $row["phone"] . "</div>";
            echo "<div style='padding: 2px 0px;margin-left: 20%;font-size: 12px;font-weight: 100'>" . $row["shoptype"] . "</div>";
            echo "<div style='padding: 2px 0px;margin-left: 20%;font-size: 12px;font-weight: 100'>" . $pgst . "</div> ";

            echo "</div>";
        }
        ?>
        <div id="logo1" style="float: left;width:22%;">
            <img src="<?php echo "img/".$logoImage?>" style="position: absolute;
    width: 106px;
    top: 61px;
left: 21px;">
        </div>

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
            /*$newname=  $row["newname"] ;*/

        }
        $querySelect="SELECT * FROM `tbltransaction` WHERE `custid`='$custid' AND tid='$proid'";
        $recordSelect=mysqli_query($conn,$querySelect);

        while($row=mysqli_fetch_array($recordSelect)) {
            $billno=  $row["billno"] ;
            $ptdate=  $row["tdate"] ;
            $ptoword=  $row["inwords"] ;
            // $paddress=  $row["address"];

        }

        $invoiceDate = date("d-m-Y", strtotime($ptdate));
        ?>
        <div id="company1" style="border: 1px solid black;float: left;width: 56%;height:20%;position: initial;top: -5px;margin:-4px 11px;">
            <div style="font-size: 15px;font-weight: bold;float: left;margin-left:3%;">Details Of Customer</div>
            <div id="company17" style="border-top: 1px solid black;margin: 22px 0px;text-transform:uppercase;">
                <div style="margin-left:3%;"><b style="margin-right: 0cm;">User Name:- </b>&nbsp;<?php echo $pname; ?></div><br>
               <!-- <div style="margin-left:3%;"><b style="margin-right: 0cm;">Customer Name::- </b>&nbsp;<?php /*echo $newname; */?></div><br>-->
                <div style="margin-left:3%;"><b style="margin-right: 0cm;">Address:-</b>&nbsp;<?php echo $paddress;?></div><br>
                <div style="margin-left:3%;"><b style="margin-right: 0cm;">Phone NO:-</b>&nbsp;<?php echo $phonenumber;?></div><br>
                <div style="margin-left:3%;"><b style="margin-right: 0cm;">Email:-</b>&nbsp;<?php echo $pemail;?></div><br>
            </div>
        </div>
        <div id="company123" style="width: 38%;height: 34%;position: absolute;top: 196px;float: right; margin-left: 55%;text-align: left;">
            <div style='font-size: 15px;font-weight: bold;float: left;width: 111%;border-top: 1px solid black;height: 10px;    padding: 6px;border-right: 1px solid black;'><b style="    margin: -4px 1px;
    position: absolute;">Details Of Bill</b></div>
            <div id="company1237"  style="text-transform: uppercase; font-size: 12px;position:initial;top: 1%;width: 114%;border-right: 1px solid black;border-top: 1px solid black;height: 40%; float:left;">
                <br><div><b style="margin-right: 0cm;margin: 1px 7px;">Invoice NO:-</b> &nbsp;<?php echo $billno;?></div><br>
                <div><b style="margin-right: 0cm;margin: 1px 7px;">Invoice Date:-</b>&nbsp;<?php echo $invoiceDate;?></div><br>
                <div><b style="margin-right: 0cm;margin: 1px 7px;">GST NO:-</b><?php echo $pgst;?></div><br>
                <br><br><br><br><br>
            </div>
        </div>

        <div style="    width: 98%;
    float: left;
    top: 369px;
    position: absolute;
    margin: 0px 6px;">
            <?php
            echo "<table id='tot-header'  class='table' style='border: 1px solid black;border-collapse: collapse;'>
         <thead>
                                                    <tr style='background-color:#e6ecef;'>
                                                       <th style='color:black; width:10%;border: 1px solid black;'>Total</th>
                                                       <th style='color:black;width:10%;border: 1px solid black;'>Paid</th>
                                                       <th style='color:black;width:10%;border: 1px solid black;'>Remaining</th>
                                                       <th style='color:black;width:10%;border: 1px solid black;'>Mode Of Payment</th>
                                                    </tr></thead>";
            $sql="SELECT * FROM `tbltransaction` WHERE `custid`='$custid' AND tid='$proid'";
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
            echo "<td style='color:black;border: 1px solid black;padding: 9px;text-align: center;'>" . $btotal . "</td>";
            echo "<td style='color:black;border: 1px solid black;padding: 9px;text-align: center;'>" . $bpaid . "</td>";
            echo "<td style='color:black;border: 1px solid black;padding: 9px;text-align: center;'>" . $bremaining . "</td>";
            echo "<td style='color:black;border: 1px solid black;padding: 9px;text-align: center;'>" . $bmodeOfPayment . "</td>";
            echo "</tr>";

            $sql="SELECT * FROM `tbltransaction` WHERE `custid`='$custid' AND shopid ='$shopidval' AND tid='$proid'";
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
            ?>
            </table>
        </div>
        <div style="width:98%;position: absolute;  top: 428px;height:43%;border: 1px solid;overflow: hidden;margin: 0px 3px">
            <?php

            echo "<table  class='table' style='border-collapse: collapse;position: absolute;height: 100%;'>
<tbody>
                                            <tr style='font-weight: bold;font-size: 12px;background-color:#e6ecef;height: 34px;width: 945px;float: left;'>
                                               <th style='color:black;;width:21px; border-top: 1px solid black;border-left: 1PX SOLID;border-left: 1PX SOLID;padding: 9px;text-align: center;float: left;'>Sr.No</th>
                                               <th style='color:black;;width:131px; border-top: 1px solid black;border-left: 1PX SOLID;border-left: 1PX SOLID;padding: 9px;text-align: center;float: left;'>Item Name</th>
                                               <th style='color:black;;width:44px; border-top: 1px solid black;border-right: 1PX SOLID;border-left: 1PX SOLID;padding: 9px;text-align: center;float: left;'>HSN </th>
                                               <th style='color:black;;width:18px; border-top: 1px solid black;border-right: 1PX SOLID;padding: 9px;text-align: center;float: left;'>Qty</th>
                                               
                                               <th style='color:black;;width:52px; border-top: 1px solid black;border-right: 1PX SOLID;padding: 9px;text-align: center;float: left;'>Rate</th>
                                               <th style='color:black;;width:39px; border-top: 1px solid black;border-right: 1PX SOLID;padding: 9px;text-align: center;float: left;'>MRP</th>
                                               <th style='color:black;;width:42px; border-top: 1px solid black;border-right: 1PX SOLID;padding: 9px;text-align: center;float: left;'>Amount</th>  
                                               <th style='word-wrap: break-word;color:black;;width:39px; border-top: 1px solid black;border-right: 1PX SOLID;padding: 9px;text-align: center;float: left;'>CGST%</th> 
                                               <th style='color:black;;width:50px;border-top: 1px solid black;border-right: 1PX SOLID;padding: 9px;text-align: center;float: left;'>CGST Amt</th> 
                                               <th style='color:black;;width:41px; border-top: 1px solid black;border-right: 1PX SOLID;padding: 9px;text-align: center;float: left;'>SGST %</th> 
                                               <th style='color:black;;width:50px;border-top: 1px solid black;border-right: 1PX SOLID;padding: 9px;text-align: center;float: left;'>SGST Amt</th> 
                                               <th style='color:black;;width:38px;border-top: 1px solid black;border-right: 1PX SOLID;padding: 9px;text-align: center;float: left;'>Net Amt</th> 
                                               <th style='color:black;;width:45px;border-top: 1px solid black;border-right: 1PX SOLID;padding: 9px;text-align: center;float: left;'>Disc Amt</th>                         
                                               <th style='color:black;;width:59px; border-right: 1PX SOLID;border-top: 1px solid black;padding: 9px;text-align: center;float: left;'>Final Total</th>                                          
                                                                                   
                                            </tr>";

            $sql="SELECT t.* FROM `tblitem` t   WHERE t.`tid`='$proid' AND   t.`statusQT`='T' AND t.shopid ='$shopidval'";
            $record=mysqli_query($conn,$sql);

            $countTot='';
            $countTot1='``';
            $countCgst='';
            $countSgst='';
            $zen=1;
            while($row=mysqli_fetch_array($record)) {

                echo "  <tr style='background-color:white;height: 31px;position: relative;width: 945px;float: left;border-right: 0px solid black;'>";

                echo "<td  style='min-height: 453px;width: calc(100%/9);color:black;width:21px;border-left: 1px solid black;padding: 9px;text-align: center;float: left;word-break: break-all;white-space: normal;height: auto;overflow: hidden;float: left;word-wrap: break-word;line-height: 11PX;'>" . $zen . "</td>";
                echo "<td  style='min-height: 453px;width: calc(100%/9);color:black;width:131px;border-left: 1px solid black;border-right: 1px solid black;padding: 9px;text-align: center;float: left;word-break: break-all;white-space: normal;height: auto;overflow: hidden;float: left;word-wrap: break-word;line-height: 11PX;'>" . $row["pname"] . "</td>";
                echo "<td style='min-height: 453px;width: calc(100%/9);color:black;width:44px;border-right: 1px solid black;padding: 9px;text-align: center;float: left;word-break: break-all;white-space: normal;height: auto;overflow: hidden;float: left;word-wrap: break-word;line-height: 13PX;'>".$row["hsncode"]." </td>";
                echo "<td style='min-height: 453px;width: calc(100%/9);color:black;width:18px;border-right: 1px solid black;padding: 9px;text-align: center;float: left;word-break: break-all;white-space: normal;height: auto;overflow: hidden;float: left;word-wrap: break-word;line-height: 13PX;'>" . $row["quantity"] . "</td>";
                echo "<td style='min-height: 453px;width: calc(100%/9);color:black;width:52px;border-right: 1px solid black;padding: 9px;text-align: center;float: left;word-break: break-all;white-space: normal;height: auto;overflow: hidden;float: left;word-wrap: break-word;line-height: 13PX;'>" . $row["unitprice"] . "</td>";
                echo "<td style='min-height: 453px;width: calc(100%/9);color:black;width:39px;border-right: 1px solid black;padding: 9px;text-align: center;float: left;word-break: break-all;white-space: normal;height: auto;overflow: hidden;float: left;word-wrap: break-word;line-height: 13PX;'>" . $row["with_mrp_tax_price"] . "</td>";
                echo "<td style='min-height: 453px;width: calc(100%/9);color:black;width:42px;border-right: 1px solid black;padding: 9px;text-align: center;float: left;word-break: break-all;white-space: normal;height: auto;overflow: hidden;float: left;word-wrap: break-word;line-height: 13PX;'>" . $row["total"] . "</td>";
                echo "<td style='min-height: 453px;width: calc(100%/9);color:black;width:39px;border-right: 1px solid black;padding: 9px;text-align: center;float: left;word-break: break-all;white-space: normal;height: auto;overflow: hidden;float: left;word-wrap: break-word;line-height: 13PX;'>" . $row["taxNameCgst"] . "</td>";
                echo "<td style='min-height: 453px;width: calc(100%/9);color:black;width:50px;border-right: 1px solid black;padding: 9px;text-align: center;float: left;word-break: break-all;white-space: normal;height: auto;overflow: hidden;float: left;word-wrap: break-word;line-height: 13PX;'>" . $row["taxAmtCgst"] . "</td>";
                echo "<td style='min-height: 453px;width: calc(100%/9);color:black;width:41px;border-right: 1px solid black;padding: 9px;text-align: center;float: left;word-break: break-all;white-space: normal;height: auto;overflow: hidden;float: left;word-wrap: break-word;line-height: 13PX;'>" . $row["taxname"] . "</td>";
                echo "<td style='min-height: 453px;width: calc(100%/9);color:black;width:50px;border-right: 1px solid black;padding: 9px;text-align: center;float: left;word-break: break-all;white-space: normal;height: auto;overflow: hidden;float: left;word-wrap: break-word;line-height: 13PX;'>" . $row["taxAmtSgst"] . "</td>";
                echo "<td style='min-height: 453px;width: calc(100%/9);color:black;width:38px;border-right: 1px solid black;padding: 9px;text-align: center;float: left;word-break: break-all;white-space: normal;height: auto;overflow: hidden;float: left;word-wrap: break-word;line-height: 13PX;'>" . $row["taxtotal"] . "</td>";
                echo "<td style='min-height: 453px;width: calc(100%/9);color:black;width:45px;border-right: 1px solid black;padding: 9px;text-align: center;float: left;word-break: break-all;white-space: normal;height: auto;overflow: hidden;float: left;word-wrap: break-word;line-height: 13PX;'>" . $row["discount_price"] . "</td>";
                echo "<td style='min-height: 453px;width: calc(100%/9);color:black;width:60px;border-right: 1px solid black;padding: 9px;text-align: center;float: left;word-break: break-all;white-space: normal;height: auto;overflow: hidden;float: left;word-wrap: break-word;line-height: 13PX;'>" . $row["finaltotal"] . "</td>";

                echo "</tr >";
                $countTot1 +=$row["taxtotal"];
                $countCgst +=$row["taxAmtCgst"];
                $countSgst +=$row["taxAmtSgst"];
                $zen++;
            }
            $addcgstAndSgst=$countCgst+$countSgst;
            $countTot=$countTot1-$addcgstAndSgst;
            echo"</tbody>";
            echo"</table>";

            ?>

        </div>

        <div style="right:230px;
    width: 18%;
    position: absolute;
    bottom: 207px;">
            <table  class='table' style='border: 1px solid black;border-collapse: collapse;position: absolute;height: 100%;'>


                <tr style='background-color:white;height: 31px;position: relative;float: left;    border: 1px solid black;border-bottom: 0px solid #C1CED9;'>
                    <th  style='padding: 5px 20px;color: black;white-space: nowrap;font-weight: normal;'></th>
                    <th  style='padding: 5px 20px;color:black;white-space: nowrap;font-weight: normal;'></th>
                    <th colspan='5' style='padding: 5px 20px;color: black;white-space: nowrap;font-weight: normal;'></th>
                    <th colspan='1' style='padding: 5px 47px;color: black;white-space: nowrap;font-weight: normal;width: 287px;height: 26px;border-right: 1px solid black;'>Total Amt Before Tax</th>
                    <th colspan='1' style='padding: 5px 37px;color: black;white-space: nowrap;font-weight: normal;width: 37px;'> <?php echo $countTot?> </th>
                </tr>
                <tr style='background-color:white;height: 31px;position: relative;float: left;    border: 1px solid black;border-bottom: 0px solid #C1CED9;'>
                    <th  style='padding: 5px 20px;color: black;white-space: nowrap;font-weight: normal;'></th>
                    <th  style='padding: 5px 20px;color:black;white-space: nowrap;font-weight: normal;'></th>
                    <th colspan='5' style='padding: 5px 20px;color: black;white-space: nowrap;font-weight: normal;'></th>

                    <th colspan='1' style='padding: 5px 16px;color: black;white-space: nowrap;font-weight: normal;width: 287px;height: 26px;border-right: 1px solid black;'>Add CGST 9%</th>
                    <th colspan='1' style='padding: 5px 42px;color: black;white-space: nowrap;font-weight: normal;width: 37px;'> <?php echo $countCgst?> </th>
                </tr>
                <tr style='background-color:white;height: 31px;position: relative;float: left;    border: 1px solid black;border-bottom: 0px solid #C1CED9;'>
                    <th  style='padding: 5px 20px;color: black;white-space: nowrap;font-weight: normal;'></th>
                    <th  style='padding: 5px 20px;color:black;white-space: nowrap;font-weight: normal;'></th>
                    <th colspan='5' style='padding: 5px 20px;color: black;white-space: nowrap;font-weight: normal;'></th>
                    <th colspan='1' style='padding: 5px 20px;color: black;white-space: nowrap;font-weight: normal;width: 287px;height: 26px;border-right: 1px solid black;'>Add SGST 9%</th>
                    <th colspan='1' style='padding: 5px 42px;color: black;white-space: nowrap;font-weight: normal;width: 37px;'> <?php echo $countSgst?> </th>
                </tr>


                <tr style='background-color:white;height: 31px;position: relative;float: left;    border: 1px solid black;border-bottom: 0px solid #C1CED9;'>
                    <th  style='padding: 5px 20px;color: black;white-space: nowrap;font-weight: normal;border-top: 1px solid black;'>  </th>
                    <th  style='padding: 5px 20px;color: black;white-space: nowrap;font-weight: normal;border-top: 1px solid black;'> </th>
                    <th colspan='5' style='padding: 5px 6px;color: black;white-space: nowrap;font-weight: normal;border-top: 1px solid black;'> </th>
                    <th rowspan='1' style='padding: 5px 41px;color: black;white-space: nowrap;font-weight: normal;border-top: 1px solid black;border-right: 1px solid black;    height: 23px;width: 267px;'>Total GST AMT</th>
                    <th rowspan='1' style='padding: 5px 39px;color: black;white-space: nowrap;font-weight: normal;border-top: 1px solid black;width: 55px;'> <?php echo $addcgstAndSgst ?> </th>

                </tr>
                <tr style='background-color:white;height: 31px;position: relative;float: left;    border: 1px solid black;border-bottom: 0px solid #C1CED9;'>
                    <th  style='padding: 5px 20px;color: black;white-space: nowrap;font-weight: normal;border-top: 1px solid black;'>  </th>
                    <th  style='padding: 5px 20px;color: black;white-space: nowrap;font-weight: normal;border-top: 1px solid black;'> </th>
                    <th colspan='5' style='padding: 5px 6px;color: black;white-space: nowrap;font-weight: normal;border-top: 1px solid black;'> </th>
                    <th rowspan='1' style='padding: 5px 41px;color: black;white-space: nowrap;font-weight: normal;border-top: 1px solid black;border-right: 1px solid black;    height: 23px;width: 267px;'>Discount</th>
                    <th rowspan='1' style='padding: 5px 39px;color: black;white-space: nowrap;font-weight: normal;border-top: 1px solid black;width: 55px;'> <?php echo $bdiscount ?> </th>

                </tr>
                <tr style='background-color:white;height: 27px;position: relative;float: left;    border: 1px solid black;border-bottom: 0px solid #C1CED9;'>
                    <th  style='padding: 5px 20px;color:black;white-space: nowrap;font-weight: normal;border-top: 1px solid black;'></th>
                    <th  style='padding: 5px 20px;color: black;white-space: nowrap;font-weight: normal;border-top: 1px solid black;'></th>
                    <th colspan='5' style='padding: 5px 20px;color: black;white-space: nowrap;font-weight: normal;border-top: 1px solid black;'></th>
                    <th rowspan='1' style='width: 200px;padding: 5px 19px;color: black;white-space: nowrap;font-weight: normal;border-top: 1px solid black;border-right: 1px solid black;'>Total Amt After Tax</th>
                    <th rowspan='2' style='padding: 5px 32px;color: black;white-space: nowrap;font-weight: normal;border-top: 1px solid black;'> <?php echo $batotal?> </th>

                </tr>
            </table>

        </div>
        <div style="float: left;
position: absolute;
    bottom: 186px;
    left: 5px;

line-height: 10px;
font-weight: bold;"><?php echo  $ptoword?></div>
        <?php
        /* echo "<div id='project1'>";
         echo "<div style='padding: 1px 8px 3px;    bottom:69px;
     position: absolute;
     border: 1px solid #151514;
     width: 45%;
     height: 104px;'><div style='float: left;
 margin: 0px 123px;
 padding: 5px;
 font-size: 15px;
 font-weight: bold'></div>
 <div style='float: left;width: 152px;
 padding: 3px;'></div>
     <div style='float: left;width: 152px;
 padding: 3px;'>$pBankName</div></div>";*/

        ?>

        <?php
        echo "<div id='project1'>";
        echo "<div style='padding: 1px 8px 3px;        bottom: -48px;
    position: absolute;
   
    width: 45%;
    height: 93px;'><br/></div>";2

        ?>
        <div style="margin: 0px 4%;
    position: absolute;
    bottom: -40px;
    width: 150px;">


            <p style="width: 298px;
    font-size: 15px;
    font-weight: bold;
    position: absolute;
    bottom: 0px;">For <?php echo $phpshopname?></p>
            <p style="    width: 261px;
    font-size: 15px;
    font-weight: bold;
    position: absolute;
    bottom: -24px;;">

                </p>
        </div>
        <div style="margin: 0px 45%;position: absolute; bottom: -6px;">
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
    function myFunction() {
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
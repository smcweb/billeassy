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

$custid=$_GET['ID'];
$proid=$_GET['proId'];
/*$proid=base64_decode($custid1);
$proid=base64_decode($proid1);*/
$querySelect="SELECT * FROM `shop` WHERE `id`=1";
$recordSelect=mysqli_query($conn,$querySelect);

while($row=mysqli_fetch_array($recordSelect)) {
    $phpshopname=  $row["shopname"] ;
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
             border: 1px solid #151514;
             width: 65%;
         }
    </style>


</head>


<body>
<legend name="legend" id="legend" style="width: 101%;MARGIN: 0PX -9PX;height: 100%">
    <header class="clearfix">
        <?php

        $querySelect="SELECT * FROM `shop` WHERE `id`=1";
        $recordSelect=mysqli_query($conn,$querySelect);

        while($row=mysqli_fetch_array($recordSelect)) {
            $logoImage= $row["logo"];
            $pgst=  $row["gst"] ;
            $pBillTerms=  $row["BillTerms"] ;
            ?>
            <?php
            echo "<h1>Invoice </h1>";
            ?>
            <!-- <h1 style="width:100%">MEGA SCAFFOLDING</h1>-->
            <?php
            echo "<div id='project' style='float: left;width: 35%;'>";
            echo "<div style='margin-left: 30%;font-size: 18px;font-weight: bold;'>" . $row["shopname"] . "</div><br/>";
            echo "<div style='margin-left: 30%'>" . $row["address"] . "</div><br/>";
            echo "<div style='margin-left: 30%'>" . $row["email"] . "</div><br/>";
            echo "<div style='margin-left: 30%'>" . $row["phone"] . "</div><br/>";
            echo "<div style='margin-left: 30%'>" . $row["shoptype"] . "</div><br/>";

            echo "</div>";
        }
        ?>
        <div id="logo1" style="float: left;width:22%;">
            <img src="<?php echo "images/".$logoImage?>">
        </div>
        <?php /*if (!isset($_POST['submit_val'])) { */?>
        <?php

        $querySelect="SELECT * FROM `phonebook` WHERE `cid`='$custid'";
        $recordSelect=mysqli_query($conn,$querySelect);

        while($row=mysqli_fetch_array($recordSelect)) {
            $phonenumber=  $row["phonenumber"] ;
            $pname=  $row["name"] ;
            $paddress=  $row["address"] ;
            $pemail=  $row["email"] ;

        }
        ?>
        <!--<form action="" method="post">-->
        <div id="company1" style="float: left; width: 31%;">


            <span style="float: left;"> Customer Name:&nbsp;&nbsp;</span><?php echo "<div>" .  $pname . "</div>";?><br>


            &nbsp;<span style="float: left;">Adress:&nbsp;&nbsp;</span><?php echo "<div style='float: left;'> " . $paddress  . "</div>";?><br><br>


            <span style="float: left;">Phone NO:&nbsp;&nbsp;</span><?php echo "<div style='float: left;'>" . $phonenumber . "</div>";?><br><br>

            <span style="float: left;"> Email-ID:&nbsp;&nbsp;</span><?php echo "<div style='float: left;'>" . $pemail . "</div>";?><br><br>
        </div>
        <div style="width:100%;float: left; top: 221px;position: absolute;">
            <?php
            echo "<table id='tot-header'  class='table' style='border: 1px solid black;border-collapse: collapse;'>
 <thead>
                                            <tr style='background-color:#d3d5d6;'>
                                               <th style='color:black; width:10%;border: 1px solid black;'>Total</th>
                                               <th style='color:black;width:10%;border: 1px solid black;'>Paid</th>
                                               <th style='color:black;width:10%;border: 1px solid black;'>Remaining</th>
                                               <th style='color:black;width:10%;border: 1px solid black;'>Mode Of Payment</th>                                          
                                            </tr></thead>";
            $sql="SELECT * FROM `tbltransaction` WHERE `custid`='$custid'";
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




            ?>
            </table>
        </div>
        <div style="width:100%;position: absolute;  top: 284px;height:55%">
            <?php

            echo "<table  class='table' style='border: 1px solid black;border-collapse: collapse;position: absolute;height: 100%;'>
<tbody>
                                            <tr style='background-color:#d3d5d6;height: 34px;width: 953px;float: left;'>
                                               <th style='color:black;;width:108px; border: 1px solid black;padding: 9px;text-align: center;float: left;'>Item Name</th>
                                               <th style='color:black;;width:91px; border: 1px solid black;padding: 9px;text-align: center;float: left;'>Qty</th>
                                               <th style='color:black;;width:89px; border: 1px solid black;padding: 9px;text-align: center;float: left;'>Unit Price</th>
                                               <th style='color:black;;width:51px; border: 1px solid black;padding: 9px;text-align: center;float: left;'>Total</th>  
                                                <th style='color:black;;width:76px; border: 1px solid black;padding: 9px;text-align: center;float: left;'> Offer %</th> 
                                               <th style='color:black;;width:85px; border: 1px solid black;padding: 9px;text-align: center;float: left;'>Discount Price</th>                                          
                                               <th style='color:black;;width:45px; border: 1px solid black;padding: 9px;text-align: center;float: left;'>Tax %</th>                                          
                                               <th style='color:black;;width: 149px; border: 1px solid black;padding: 9px;text-align: center;float: left;'>Tax Name(GST)</th>                                          
                                               <th style='color:black;width: 79px; border: 1px solid black;padding: 9px;text-align: center;float: left;'>Final Total</th>                                          
                                            </tr>";

            $sql="SELECT t.*, tt.`offerPercent` FROM `tblitem` t JOIN  tbloffer tt ON t.`oid`=tt.`offerid`  WHERE t.`tid`='$proid' AND   t.`statusQT`='T'";
            $record=mysqli_query($conn,$sql);


            while($row=mysqli_fetch_array($record)) {

                echo "  <tr style='background-color:white;height: 31px;position: relative;width: 953px;float: left;border-right: 1px solid black;'>";

                echo "<td style='width: calc(100%/9);border-bottom: 1px solid black;color:black;width:109px;border-right: 1px solid black;padding: 9px;text-align: center;float: left;'>" . $row["pname"] . "</td>";
                echo "<td style='width: calc(100%/9);border-bottom: 1px solid black;color:black;width:92px;border-right: 1px solid black;padding: 9px;text-align: center;float: left;'>" . $row["quantity"] . "</td>";
                echo "<td style='width: calc(100%/9);border-bottom: 1px solid black;color:black;width:90px;border-right: 1px solid black;padding: 9px;text-align: center;float: left;'>" . $row["unitprice"] . "</td>";
                echo "<td style='width: calc(100%/9);border-bottom: 1px solid black;color:black;width:53px;border-right: 1px solid black;padding: 9px;text-align: center;float: left;'>" . $row["total"] . "</td>";
                echo "<td style='width: calc(100%/9);border-bottom: 1px solid black;color:black;width:76px;border-right: 1px solid black;padding: 9px;text-align: center;float: left;'>" . $row["offerPercent"] . "</td>";
                echo "<td style='width: calc(100%/9);border-bottom: 1px solid black;color:black;width:87px;border-right: 1px solid black;padding: 9px;text-align: center;float: left;'>" . $row["discount_price"] . "</td>";
                echo "<td style='width: calc(100%/9);border-bottom: 1px solid black;color:black;width:45px;border-right: 1px solid black;padding: 9px;text-align: center;float: left;'>" . $row["tax"] . "</td>";
                echo "<td style='width: calc(100%/9);border-bottom: 1px solid black;color:black;width:149px;border-right: 1px solid black;padding: 9px;text-align: center;float: left;'>" . $row["taxname"] . "</td>";
                echo "<td style='width: calc(100%/9);border-bottom: 1px solid black;color:black;width:79px;border-right: 1px solid black;padding: 9px;text-align: center;float: left;'>" . $row["taxtotal"] . "</td>";

                echo "</tr >";
            }

            echo"</tbody>";
            echo"</table>";

            ?>

        </div>

        <div style="right: 104px; width: 34%;position: absolute;bottom: 211px;">
            <table  class='table' style='border: 1px solid black;border-collapse: collapse;position: absolute;height: 100%;'>


                <tr style='background-color:white;height: 31px;position: relative;float: left;    border: 1px solid black;border-bottom: 0px solid #C1CED9;'>
                    <th  style='padding: 5px 20px;color: black;white-space: nowrap;font-weight: normal;'></th>
                    <th  style='padding: 5px 20px;color:black;white-space: nowrap;font-weight: normal;'></th>
                    <th colspan='5' style='padding: 5px 20px;color: black;white-space: nowrap;font-weight: normal;'></th>
                    <th colspan='1' style='padding: 5px 20px;color: black;white-space: nowrap;font-weight: normal;width: 287px;height: 26px;border-right: 1px solid black;'>SubTotal</th>
                    <th colspan='1' style='padding: 5px 20px;color: black;white-space: nowrap;font-weight: normal;width: 37px;'> <?php echo $btotal?> </th>
                </tr>
                <tr style='background-color:white;height: 31px;position: relative;float: left;    border: 1px solid black;border-bottom: 0px solid #C1CED9;'>
                    <th  style='padding: 5px 20px;color: black;white-space: nowrap;font-weight: normal;border-top: 1px solid black;'>GST NUMBER:</th>
                    <th  style='padding: 5px 20px;color: black;white-space: nowrap;font-weight: normal;border-top: 1px solid black;'><?php echo $pgst?></th>
                    <th colspan='5' style='padding: 5px 20px;color: black;white-space: nowrap;font-weight: normal;border-top: 1px solid black;'></th>
                    <th rowspan='1' style='padding: 5px 20px;color: black;white-space: nowrap;font-weight: normal;border-top: 1px solid black;border-right: 1px solid black;    height: 23px;width: 88px;'>Discount</th>
                    <th rowspan='1' style='padding: 5px 20px;color: black;white-space: nowrap;font-weight: normal;border-top: 1px solid black;width: 55px;'> <?php echo $bdiscount ?> </th>

                </tr>
                <tr style='background-color:white;height: 31px;position: relative;float: left;    border: 1px solid black;border-bottom: 0px solid #C1CED9;'>
                    <th  style='padding: 5px 20px;color:black;white-space: nowrap;font-weight: normal;border-top: 1px solid black;'>Date Of Purchase:</th>
                    <th  style='padding: 5px 20px;color: black;white-space: nowrap;font-weight: normal;border-top: 1px solid black;'><?php echo $tdate?></th>
                    <th colspan='5' style='padding: 5px 20px;color: black;white-space: nowrap;font-weight: normal;border-top: 1px solid black;'></th>
                    <th rowspan='1' style='padding: 5px 20px;color: black;white-space: nowrap;font-weight: normal;border-top: 1px solid black;border-right: 1px solid black;'>Grand Total</th>
                    <th rowspan='2' style='padding: 5px 20px;color: black;white-space: nowrap;font-weight: normal;border-top: 1px solid black;'> <?php echo $batotal?> </th>

                </tr>
            </table>
        </div>
        <?php
        echo "<div id='project1'>";
        echo "<div style='padding: 1px 8px 3px;    bottom: 112px;
    position: absolute;
    border: 1px solid #151514;
    width: 49%;
    height: 93px;'><br/>$pBillTerms</div>";
        echo "</div>";

        ?>
        <div style="margin: 0px 81%;
    position: absolute;
    bottom: 75px;
    width: 150px;">
            Authorised Sign & Stamp
        </div>
        <div style="margin: 0px 45%;position: absolute; bottom: 0px;">
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
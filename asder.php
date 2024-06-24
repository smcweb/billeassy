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




<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>A simple, clean, and responsive HTML invoice template</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
           /* text-align: right;*/
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td{
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
<div class="invoice-box">
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
       $padd= $row['address'];
       $pshopname= $row['shopname'];
       $pphone= $row['phone'];
       $ppemail= $row['email'];
       $ppshoptype= $row['shoptype'];
    }

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
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td class="title">
                            <img src='img/<?php echo $logoImage?>' style='width: 158px;height: 113px;'>
                        </td>

                        <td>
                            Invoice #: <?php echo $billno?><br>
                            Invoice Date: <?php echo $invoiceDate?><br>

                        </td>
                    </tr>
                </table>
            </td>
        </tr>
<?php $string = substr($padd,0,34);?>
<?php $string1 = substr($padd,34,198);?>
        <tr class="information">
            <td colspan="2">
                <table>
                    <tr>
                        <td>
                            <?php echo $pshopname?>.<br>
                            <?php echo $string?><br>
                            <?php echo $string1?><br>
                            <?php echo $pphone?><br>
                            <?php echo $ppemail?><br>
                            <?php echo $ppshoptype?><br>
                            <?php echo $pgst?>

                        </td>

                        <td>
                            <?php $custstring = substr($paddress,0,34);?>
                            <?php $custstring1 = substr($paddress,34,198);?>
                            <?php echo $pname?><br>
                            <?php echo $phonenumber?><br>
                            <?php echo $custstring?><br>
                            <?php echo $custstring1?><br>
                            <?php echo $pemail?><br>
                            <?php echo $pstate?><br>
                            <?php echo $pstateCode?><br>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading">
            <td>
                Payment Method
            </td>
            <td>
                Payment Method
            </td>
            <td>
                Payment Method
            </td>

            <td>
                Amount #
            </td>
        </tr>

        <tr class="details">
            <td>
                Check
            </td>

            <td>
                1000
            </td>
        </tr>

        <tr class="heading">
            <td style="width: 107px;">
                HSN-CODE
            </td>
              <td style="    width: 185px">
                Item
            </td>
       <td style="width: 107px;">
        MRP
       </td>
              <td style="width: 107px;">
                  MRP With Tax
            </td>
<td style="width: 107px;">
    Quantity
            </td>
<td style="width: 107px;">
    Total
            </td>
<td>
    C-GST S-GST %
            </td>

            <td>
                C-GST S-GST AMT
            </td><td>
                NET AMT
            </td>
            <td>
                Offer AMT
            </td>
            <td>
                Final AMT
            </td>
        </tr>

        <tr class="item">
            <td>
                Website design
            </td>

            <td>
                $300.00
            </td>
        </tr>

        <tr class="item">
            <td>
                Hosting (3 months)
            </td>

            <td>
                $75.00
            </td>
        </tr>

        <tr class="item last">
            <td>
                Domain name (1 year)
            </td>

            <td>
                $10.00
            </td>
        </tr>

        <tr class="total">
            <td></td>

            <td>
                Total: $385.00
            </td>
        </tr>
    </table>
</div>
</body>
</html>
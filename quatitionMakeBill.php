<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
include('config.php');
ini_set('error_reporting', E_ALL);
session_start();
// echo $_SESSION['username'];

if (!isset($_SESSION['username'])) {
    header('location:login.php');
} else {

    $uname = $_SESSION['username'];
    // echo "<script>alert('session mentain')</script>";
}
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
    <script>
        function getXMLHTTP() { //fuction to return the xml http object
            var xmlhttp = false;
            try {
                xmlhttp = new XMLHttpRequest();
            }
            catch (e) {
                try {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                catch (e) {
                    try {
                        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                    }
                    catch (e1) {
                        xmlhttp = false;
                    }
                }
            }
            return xmlhttp;

        }

        function getCatAcorddingProduct(productId) {
            var strURL = "catLoad.php?catName=" + productId;


            var req = getXMLHTTP();

            if (req) {
                req.onreadystatechange = function () {
                    if (req.readyState == 4) {
                        if (req.status == 200) {

                            document.getElementById('proName-id').innerHTML = req.responseText;

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

        function rowshow(id) {

            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: 'getProductupdate.php',
                async: false,
                data: {"id": id},
                success: function (response) {
                    $('#productid').val(id)
                    $('#addproductName').val(response[0].pname)
                    $('#addWithoutMrpTax').val(response[0].price)
                    $('#addWithMrpTax').val(response[0].mrp_with_gst)
                    $('#addCGST').val(response[0].taxPercent)
                    $('#addSGST').val(response[0].taxPercents)
                    $('#addquantity').val(response[0].quantity)
                    $('#cat').val(response[0].catid)
                    $('#HSN-Code').val(response[0].hsncode)
                    // $('#tax').val(response[0].taxName)


                },
                error: function (req, status, error) {
                }
            });
        }

    </script>
    <link rel="stylesheet" href="css/clndr.css" type="text/css"/>
    <script src="js/underscore-min.js" type="text/javascript"></script>
    <script src="js/moment-2.2.1.js" type="text/javascript"></script>
    <script src="js/clndr.js" type="text/javascript"></script>
    <script src="js/site.js" type="text/javascript">
    </script>
    <link href="sweetalert.css" type="text/css" rel="stylesheet">
    <link href="facebook.css" type="text/css" rel="stylesheet">
    <script src="jquery-3.0.0.js" type="text/javascript"></script>
    <script src="sweetalert.min.js" type="text/javascript"></script>
    <!--update Product-->
</head>
<body style="background: white">
<?php

$shopidBn = $_SESSION['shopidu'];
$uname2=substr($uname,4,5);
$fid=$_SESSION['fid'];
//echo "<script>alert('$shopidBn')</script>";
if (isset($_POST['insert'])) {
    $subject=$_REQUEST['subject'];
    $custname = $_REQUEST['custname'];
    $custnumber = $_REQUEST['number'];
    $custAddr = $_REQUEST['addr'];
    $custEmail = $_REQUEST['email'];
    $custGSTNo = $_REQUEST['GSTNo'];
    $custStCode = $_REQUEST['stCode'];
    $custState = $_REQUEST['state'];
    $invoiceDate = $_REQUEST['invoiceDate'];
    $txt_samt1 = $_REQUEST['txt_samt1'];
    $txt_disc = $_REQUEST['disc'];
    $txt_gamt1 = $_REQUEST['txt_gamt1'];
    $txt_words = $_REQUEST['words'];
    $txt_modeOfPayment = 'CASH';
    $txt_cashid ='cash';
    /*$txt_paiding=$_REQUEST['txt_paiding'];
    $txt_remeingBal=$_REQUEST['remeingBal'];*/
    $txt_paiding = 0;
    $txt_remeingBal = 0;
    $txt_addHsncode = $_REQUEST['addHsncode'];
    $txt_addProName = $_REQUEST['addProName1'];
    $txt_MRP = $_REQUEST['unitPrice'];
    $txt_qty = $_REQUEST['qty'];
    $txt_totalAmt = $_REQUEST['totalAmt'];
    $txt_discountPrice = $_REQUEST['discountPrice'];
    $txt_offerid = $_REQUEST['offerid'];
    $txt_finalTotalAmt = $_REQUEST['finalTotalAmt'];
    $txt_offeridval = $_REQUEST['offeridval'];
    $custnumberBill = substr($custnumber, 6);
    $querySelect = "SELECT * FROM `phonebook` WHERE `phonenumber`='$custnumber' AND shopid='$shopidBn'";
    $recordSelect = mysqli_query($conn, $querySelect);
    $numphonenumber=0;
    while ($row = mysqli_fetch_array($recordSelect)) {
        $numphonenumber = $row['phonenumber'];
        $cid = $row['cid'];
    }

    $querySelect = "SELECT * FROM `financialyear` WHERE `fid`='$fid'";
    $recordSelect = mysqli_query($conn, $querySelect);

    while ($row = mysqli_fetch_array($recordSelect)) {
        $nfyear = $row['fyear'];
    }
    $querySelect = "SELECT max(`qid`)as id2 FROM `tblquotation` ";
    $recordSelect = mysqli_query($conn, $querySelect);

    while ($row = mysqli_fetch_array($recordSelect)) {
        $nid2 = $row['id2'];
    }
    $nid2 += 1;
//$finalamt= $gtxt_balance+$txt_gamt-$nremaining;
    if ($custnumber != $numphonenumber) {
        $query = "INSERT INTO `phonebook`(`subject`,`name`, `phonenumber`, `email`,gst, `address`, `pgroup`, `shopid`,venders,statesCode,states) VALUES ('$subject','$custname','$custnumber','$custEmail','$custGSTNo','$custAddr','$fid','$shopidBn','customer','$custStCode','$custState')";
        $record = mysqli_query($conn, $query);


        $cid = mysqli_insert_id($conn);

    }
    $query11 = "UPDATE `phonebook` SET `name`='$custname',`phonenumber`='$custnumber',`email`='$custEmail',`address`='$custAddr',`states`='$custState',`gst`='$custGSTNo',`statesCode`='$custStCode',`balanceAmt`='0' WHERE `cid`='$cid'";
    $record = mysqli_query($conn, $query11);
    $nfyear1 = substr("$nfyear", 27);
    $nfyear21 = substr("$nfyear", 10, 3);
    $fidd3 = $nfyear21 . '-' . $nfyear1;
    $billNo = $fidd3 . '/' . '00' . $nid2;
    $query = "INSERT INTO `tblquotation`( `custid`, `billno`, `tdate`, `btotal`, `discount`, `atotal`, `inwords`, `shopid`, `fid`, `statesCode`, `modeOfPayment`, `remark`, `statusQT`, `trnjType`) VALUES ('$cid','$billNo','$invoiceDate','$txt_samt1','$txt_disc','$txt_gamt1','$txt_words','$shopidBn','$fid','$custStCode','$txt_modeOfPayment','$txt_cashid','Q','withoutTax')";
    $record = mysqli_query($conn, $query);
    $last_row = mysqli_insert_id($conn);

    foreach ($txt_addProName as $key => $valuein) {

        $query = "INSERT INTO `tblitem`(`pname`, `unitprice`,`quantity`, `total`, `finaltotal`, `billno`, `shopid`, `fid`, `oid`, `tid`, `statusQT`, `hsncode`,discount_price) 
VALUES ('$txt_addProName[$key]','$txt_MRP[$key]','$txt_qty[$key]','$txt_totalAmt[$key]','$txt_finalTotalAmt[$key]','$billNo','$shopidBn','$fid','$txt_offeridval[$key]','$last_row','Q','$txt_addHsncode[$key]','$txt_discountPrice[$key]')";
        $record = mysqli_query($conn, $query);
    }

    if($record) {
        $pid= base64_encode($last_row);
        $cdid=base64_encode($cid);
        echo "<script>
    setTimeout(function() {
        swal({
            title: 'Successfully !',
            text: 'Wait For Print !',
            type: 'success'
        }, function() {
            window.location = 'withOutQutationInvoice.php?custid=$cdid&proId=$pid';
        });
    }, 500);
</script>";

    }else{
        echo "<script>alert('Not  Successfully Printed ');</script>";
    }
}
//echo "<script>alert('$shopidBn')</script>";
?>

<div id="wrapper">
    <!-- Navigation -->
    <?php
    /*include_once "header.php";*/ ?>
    <!-- Navigation -->
    <div id="page-wrapper-1" style="auto">

        <form id='students' method='post' name='students' action=''>
            <div class="content_bottom">
                <div class="col-md-12 ">
                    <div class="col-md-4" style="    margin: 8px 1px;">
                        <?php
                        include_once 'config.php';
                        $querySelect = "SELECT * FROM `shop` WHERE `id`='$shopidBn'";
                        $recordSelect = mysqli_query($conn, $querySelect);


                        echo "<table class='table table-bordered'>";
                        while ($row = mysqli_fetch_array($recordSelect)) {
                            $logoImage = $row["logo"];

                            ?>
                            <?php
                            echo "<tr  style='cursor:pointer;color:black;text-align:center'>";
                            echo "<td  style='color:black;text-align: left'><p style='float: left;'><img src='img/$logoImage' style='width: 90px;height:118px;top: -14px;    position: relative;    left: -15px;'><br></p>" . $row['shopname'] ."<br>".$row['address']."<br>".$row['phone']."<br>".$row['email']."<br>".$row['gst']."</td>";
                            echo "</tr>";



                        }
                        echo "</table>";
                        ?>
                        <style>  .form-control-1-1 {
                                width: 186px;
                                height: 22px;
                            }
                            .form-control-1 {
                                width: 100%;
                                height: 22px;
                            }
                            .form-control-1-1-1 {
                                width: 146px;
                                height: 22px;
                            }form-control-1-1-1 {
                                 width: 146px;
                                 height: 22px;
                             }

                            .th-id {
                                width: 27%;
                            }
                            
                        </style>
                    </div>
                    <div class="col-md-2 " style=" margin: 52px 1px;">
                        <table class="table table-bordered" style="    background: #39693b">
                            <thead>

                            <tr>
                                <th>
                                    <div style=""><span><select
                                                    onchange="getCatAcorddingProduct(this.value);"
                                                    style="width: 135px;height: 34px;" required id="txt_product1"
                                                    name="txt_category">
                 <option class="dropdown-content">Select Category</option>
                                                <?php
                                                include_once 'config.php';
                                                $querySelect = "SELECT * FROM `tblcategory` WHERE `shopId`='$shopidBn'";
                                                $recordSelect = mysqli_query($conn, $querySelect);

                                                while ($row = mysqli_fetch_array($recordSelect)) { ?>
                                                    <option value=<?php echo $row['catID']; ?>><?php echo $row['catName']; ?></option>
                                                <?php } ?>
                        </select></span>
                                    </div>
                                </th>
                                <th>


                                    <div id="proName-id">
                                        <select required id="txt_productName" name="txt_product"
                                                style="width: 135px;height: 36px;">
                                            <option class="dropdown-content">Select Product</option>
                                        </select>
                                    </div>
                                </th>
                            </tr>
                            </thead>
                        </table>
                    </div>


                    <div class="col-md-4 " style="    margin: 1px 111px;">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <!--<th class="th-id"></th>
                                <th class="th-id">Enter Mobile No</th>
                                <th class="th-id">Address</th>-->
                                <!-- <th class="th-id">Enter Email-Id</th>-->
                            </tr>
                            </thead>
                            <tr>
							<th><input type="text" name="subject" id="subject" style='' placeholder="Enter Subject"></th>
                                <th class="th-id"><input type="text" name="custname" id="cname" style='' placeholder="Enter Cust Name"
                                                         class='form-control-1-1'  onblur="giveData()"></th>
                                <div style="z-index: 1233223;position: absolute;" id="suggesstion-box"></div>
                                <th class="th-id"><input type="text" name="number" class='form-control-1-1-1'
                                                         onKeyPress="if(this.value.length==10) return false;" id="number"
                                                         style=''  placeholder="Enter Mobile No"
                                                         pattern="\d*">
                                </th>
                                
                            </tr>
                            <tr>
								<th><input type="date" name="invoiceDate" id="invoiceDate" style=""
                                           value="<?php echo date('Y-m-d') ?>" required="" class='form-control-1' placeholder="Enter Cust Name">
                                </th>
                                <th>

                                <textarea rows="8" cols="50" name="addr" id="addr" style="    height: 28px;" required="" value="NA"
                                          class='form-control-1'  placeholder="Enter Address" ></textarea></th>
                                <th><input type="email" name="email" id="email" class='form-control-1-1-1' placeholder="Enter Email-Id"></th>
                                <th>
                                </th>
                            </tr>
                            <tr>
							                                <th><input type="text" name="GSTNo" id="GSTNo" value="" class='form-control-1' placeholder="Enter GST No"></th>

                                <th><input type="text" name="state" id="state" style="" required="" class='form-control-1' placeholder="Enter State">
                                </th>
                                <th><input type="text" name="stCode" id="stCode" style="" required=""
                                           class='form-control-1' placeholder="Enter State Code" ></th>

                            </tr>
                            </thead>

                        </table>
                    </div>

                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-8" style="    margin: 0px 172px;">




                            <table id='withoutTax-id-1' class="table table-bordered c">
                                <tr>
                                    <!--<th>S. No</th>-->
                                    <th>HSN-CODE</th>
                                    <th>Product</th>
                                    <th>MRP</th>

                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Offer Amt</th>
                                    <th>Offer %</th>
                                    <th>Final Amt</th>
                                    <th>Modify</th>
                                </tr>

                            </table>
                            <!--<button type="button" class='delete'>- Delete</button>
                            <button type="button" class='addmore-1'>+ Add More</button>
                            <p>
                                <input type='submit' name='submit' value='submit' class='but'/></p>-->


                        </div>
                    </div>

                </div>
                <div class="col-md-12">

                    <div class="col-md-6 " style="">
                        <!--<table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="th-id">Mode Of Payment</th>

                                <th>

                                    <select name="modeOfPayment" onchange="displayidchequeon(this.value)" style="width: 240px;
    height: 39px;">
                                        <option value="cash">Cash</option>
                                        <option value="cheque">Cheque</option>
                                        <option value="online">Online</option>
                                        <option value="finance">Finance</option>-->
                                        <!-- <option value="audi">Audi</option>-->
                                   <!-- </select>
                                </th>

                            </tr>

                            <tr id="cash">
                                <td></td>
                                <td><input type="text" name="cashid" id="cheque1" style="
       width: 240px;
    float: left;
    padding: 0px 0px 13px;" placeholder="description">
                                </td>
                            </tr>
                            <tr id="cheque-1">
                                <td></td>
                                <td><input type="text" name="chequeid" id="onlineCashCheque" style="
        width: 240px;
    float: left;
    padding: 0px 0px 13px;" placeholder="fill  Cheque And Bank Name Details">

                                </td>
                            </tr>
                            <tr id="online">
                                <td></td>
                                <td><input type="text" name="onlineid" id="cheque1" style=";
        width: 240px;
    float: left;
    padding: 0px 0px 13px;" placeholder="fill NFT No"></td>
                            </tr>
                            <tr id="finance-1">
                                <td></td>
                                <td><input type="text" name="onlineid" id="cheque1" style="
        width: 240px;
    float: left;
    padding: 0px 0px 13px;" placeholder="finance"></td>
                            </tr>
                            <tr>
                                <th class="th-id">Paid Amt</th>
                                <th><input type="text" name="txt_paiding" id="txt_paiding" style="padding: 6px;float: left;width: 240px;" onblur="caluTotalpaidAmt()"></th>
                            </tr>
                            <tr>
                                <th class="th-id">Remaining Balance</th>
                                <th><input type="text" name="remeingBal" id="remeingBal" onkeyup="//remeningCalculate()" style="padding: 6px;width: 240px;"></th></tr>
                        </table>-->

                </div>
                    <div class="col-md-3" style="margin: 0px 95px;">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="th-id">SubTotal</th>

                                <th>
                                    <input type="text" name="txt_samt1" id="txt_samt" style="border-left:none;border-right:none;border-top:none; float: left;" readonly="">
                                </th>

                            </tr>
                            <tr>
                                <th class="th-id">Discount</th>

                                <th>
                                    <input type="text" name="disc" placeholder="In Rupees" onblur="discountCalulate()" id="discount-tot" style="float: left; z-index:111111111111111111">
                                </th>

                            </tr>
                            <tr>
                                <th class="th-id">GRAND TOTAL</th>

                                <th>
                                    <input type="text" name="txt_gamt1" id="txt_gamt" style="border-left:none;border-right:none;border-top:none;float: left;" readonly="">
                                </th>

                            </tr>
                            <tr >
                                <th style="display: none">
                                    <input type="text"  id="words-id" name="words">
                                    <input type="text" name="txt_gamt2" id="txt_gamt22"style="border-left:none;border-right:none;border-top:none;float: left;
    margin: -23px 146px;" readonly/>
                                </th>
                                <th>
                                </th>
                                <th name="words" id="words">
                                </th>
                            </tr>
                            <tr><th><button  class="btn btn-success" name="insert" style="width: 195px;background-color: #5cb85c;border-color: #4cae4c;">Print</button></th></tr>

                            </thead>
                        </table>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>


<?php
/*include_once*/ /*"includes/footer.php";*/ ?>
<style>
    .table-bordered > tbody > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > thead > tr > th {
       /* border: 1px solid #00BB64;*/
    }

    .table-bordered > #withoutTax-id-1, #withoutTax-id-1 > tbody > th {
        /*border: 1px solid #00BB64;
    }*/
    }

    .form-control-2 {
        width: 80px;
    }

    #cheque-1 {
        display: none;
    }

    #online {
        display: none;
    }

    #finance-1 {
        display: none;
    }
    #country-list{float:left;list-style:none;margin-top: 104px;padding:0;width:190px;position: absolute;text-align: left;}
    #country-list li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;text-align: left;}
    #country-list li:hover{background:#ece3d2;cursor: pointer;text-align: left;}
</style>

<script>
    $(".delete").on('click', function () {
        $('.case:checkbox:checked').parents("tr").remove();
        $('.check_all').prop("checked", false);
        check();

    });
    var i = 2;

    /*$(".addmore-1").on('click',function(){
        count=$('#withoutTax-id').length;

    });*/
    var msg_id=''
    function addProductDaynmicFun() {
        var proName = document.getElementsByName("txt_product")[0].value

        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: 'getInvoiceData.php',
            async: false,
            data: {"pname": proName},
            success: function (response) {

                var response1 = response[0].response;
                var responseOffer1 = response[1].responseOffer;

                var FieldCount = response1[0].pid;
                var pnameCount = response1[0].pname;
                var same = $('#proName' + FieldCount).val();
                var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth() + 1; //January is 0!

                var yyyy = today.getFullYear();
                if (dd < 10) {
                    dd = '0' + dd;
                }
                if (mm < 10) {
                    mm = "0" + mm;
                }
                today = yyyy + '-' + mm + '-' + dd;

                if (pnameCount == same) {
                    alert('Product Already Selected Duplicate Product Not Allowed')
                }
                else {
                    var data = "<tr id='remove-id-if-user"+FieldCount+"'>";
                    data += "<td><input type='text' id='prohsn" + FieldCount + "' name='addHsncode[]' class='form-control-2'/></td> <td><input type='text' id='proName" + FieldCount + "' name='addProName1[]' /></td><td><input type='text' id='unitp" + FieldCount + "' name='unitPrice[]' class='form-control-2'/></td></td><td><input type='text' id='qtyUp" + FieldCount + "' name='qty[]' class='form-control-2' onblur='qtyCalculate(this.id)'/></td><td><input type='text' id='nod-Total" + FieldCount + "' name='totalAmt[]' class='form-control-2' readonly/></td><td><input type='text' id='discountPrice" + FieldCount + "' name='discountPrice[]' class='form-control-2' readonly/></td><td><input type='text' id='offerName" + FieldCount + "' name='offerid[]' class='form-control-2' onblur='calcuOfferAmt(this.id)'/></td><td><input type='text' id='total" + FieldCount + "' name='finalTotalAmt[]' class='form-control-2' readonly/></td><input type='hidden' id='offerval" + FieldCount + "' class='form-control'  name='offeridval[]' ><td><a href='javascript:void(0)'  class='remCF' id='" + FieldCount + "' ><i class='fa fa-trash-o' style='font-size: 26px;color: red;'></i></a></td></tr>";
                    $('#withoutTax-id-1').append(data);

                }
                $('#proName' + FieldCount).val(proName);
                $('#unitp' + FieldCount).val(response1[0].price);
                $('#unitpwith' + FieldCount).val(response1[0].mrp_with_gst);
                $('#prohsn' + FieldCount).val(response1[0].hsncode);
                // $('#gstName'+FieldCount).val(response1[0].taxName);
                //$('#taxper'+FieldCount).val(response1[0].taxPercent);

                var validoffer = responseOffer1[0].validDate
                if (today <= validoffer) {
                    $('#offerName' + FieldCount).val(responseOffer1[0].offerPercent);
                    $('#offerval' + FieldCount).val(responseOffer1[0].offerid);
                } else {
                    $('#offerName' + FieldCount).val(0);
                    $('#offerval' + FieldCount).val(responseOffer1[0].offerid);
                }
            },
            error: function (req, status, error) {
            }
        });
    }

    function displayidchequeon(id) {

        if (id == 'cheque') {
            $('#cheque-1').show();
            $('#cash').hide();
            $('#online').hide();
            $('#finance-1').hide();
        } else if (id == 'online') {
            $('#online').show();
            $('#cash').hide();
            $('#cheque-1').hide();
            $('#finance-1').hide();
        }
        else if (id == 'cash') {
            $('#cash').show();
            $('#online').hide();
            $('#cheque-1').hide();
            $('#finance-1').hide();
        }
        else if (id == 'finance') {
            $('#finance-1').show();
            $('#cash').hide();
            $('#online').hide();
            $('#cheque-1').hide();
        }

    }
    function qtyCalculate(str) {

        var pId = str.substr(5, 4);
        var  unitPrice= $('#unitp'+pId).val();
        var totalqty=  $('#qtyUp'+pId).val();
        if(!totalqty){
            alert('Please Enter Quantity')
            return;
        }
        var gstper= $('#taxper'+pId).val();
        var offerper= $('#offerName'+pId).val();
        //var amtTotal1=unitPrice * totalqty
        var totad = $('#total' + pId).val();
        var prevBal = document.getElementById('txt_samt').value;
        var prevBal1 = document.getElementById('txt_gamt').value
        var storeBal = prevBal - totad
        var storeBal1 = prevBal1 - totad
        if(offerper > 0){
            var amtTotal1=unitPrice * totalqty
            var amtTotal2=(amtTotal1*offerper)/100;
            var amtTotal=(amtTotal1-amtTotal2).toFixed(2);
            $('#discountPrice'+pId).val(amtTotal2);
            $('#nod-Total'+pId).val(amtTotal1);
            var amtTotalgst= $('#discountPrice'+pId).val();
            var amtTotalgst= $('#total'+pId).val();
            // var caluwithGstamt= (amtTotal * gstper)/100;
            var amtTotalGstamt=amtTotal
            $('#total'+pId).val(amtTotalGstamt);
        }else{
            var amtTotal=unitPrice * totalqty
            $('#discountPrice'+pId).val(0);
            $('#nod-Total'+pId).val(amtTotal);
            var amtTotalgst= $('#discountPrice'+pId).val();
            var amtTotalgst= $('#total'+pId).val();
            //var caluwithGstamt= (amtTotal * gstper)/100;
            var amtTotalGstamt=amtTotal
            $('#total'+pId).val(amtTotalGstamt);
        }
        var sutota1 = parseFloat((storeBal)) + parseFloat((amtTotalGstamt));
        var sutota12 =parseFloat((storeBal)) + parseFloat((amtTotalGstamt));
        document.getElementById('txt_samt').value = sutota1;
        document.getElementById('txt_gamt').value = sutota12;
        var totasd=Math.round(sutota12)
        document.getElementById('txt_gamt22').value = totasd;
        var gprint = 'txt_gamt22';
        var printdata =  convertNumberToWords(totasd)
        document.getElementById('words').innerHTML = printdata + ' ' + ' Rupees Only';
        $('#words-id').val(printdata + ' ' + ' Rupees Only');
    }


</script>
<!-- /#page-wrapper -->

<!-- /#wrapper -->
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script src="mainScript.js"></script>
</body>
</html>
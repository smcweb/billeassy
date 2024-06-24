<!DOCTYPE html>
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
$shopidval=$_SESSION['shopidu'];
//echo "<script>alert('$shopidval')</script>";
$fid=$_SESSION['fid'];
//$todate=date('y:m:d');
//echo "<script>alert('$fid')</script>";
if(isset($_POST['submit_val'])) {
    $addProName=$_REQUEST['addProName1'];
    $unitPrice=$_REQUEST['unitPrice'];
    $addHsncode=$_REQUEST['addHsncode'];
    $finalTotalAmt=$_REQUEST['finalTotalAmt'];
    $fgstt=$_REQUEST['gst'];
    $fstatesCode=$_REQUEST['statesCode'];
    $fstates=$_REQUEST['states'];
    $totalAmt=$_REQUEST['totalAmt'];
    $qty=$_REQUEST['qty'];
    $taxPer=$_REQUEST['taxPer2'];
    $gstName=$_REQUEST['gstName'];
    $custname=$_REQUEST['custname'];
    $addr=$_REQUEST['addr'];
    $gemaile=$_REQUEST['email'];
    $gtxt_balance=$_REQUEST['txt_balance'];
    $todate=$_REQUEST['dateInvoice'];


    $modeOfPayment=$_REQUEST['modeOfPayment'];
    if($modeOfPayment=='cash'){
        $onlineCashCheque=$_REQUEST['cashid'];
    }elseif($modeOfPayment=='online'){
        $onlineCashCheque=$_REQUEST['chequeid'];
    }elseif($modeOfPayment=='cheque'){
        $onlineCashCheque=$_REQUEST['onlineid'];
    }elseif($modeOfPayment=='finance'){
        $onlineCashCheque=$_REQUEST['finance'];
    }

    $gsnumber=$_REQUEST['number'];
    $gwords=$_REQUEST['words'];
    $txt_gamt=$_REQUEST['txt_gamt1'];
    $txt_samt1=$_REQUEST['txt_samt1'];
    $txt_discount=$_REQUEST['disc'];
    $txt_offerval=$_REQUEST['offeridval'];
    $txt_discountPrice =$_REQUEST['discountPrice'];
    $txt_paiding =$_REQUEST['txt_paiding'];
    $remaining =$_REQUEST['remeingBal'];
    $currentDateTime = date('Y-m-d H:i:s');
    $tuimewise=substr($currentDateTime,15);
    $gsnumberBill=substr($gsnumber,6);
    $querySelect="SELECT * FROM `phonebook` WHERE `phonenumber`='$gsnumber'  AND shopid='$shopidval'";
    $recordSelect=mysqli_query($conn,$querySelect);

    while($row=mysqli_fetch_array($recordSelect)) {
        $numphonenumber=$row['phonenumber'];
        $cid=$row['cid'];
    }

    $querySelect="SELECT * FROM `financialyear` WHERE `fid`='$fid'";
    $recordSelect=mysqli_query($conn,$querySelect);

    while($row=mysqli_fetch_array($recordSelect)) {
        $nfyear=$row['fyear'];
    }
    $querySelect="SELECT max(`tid`)as id2 FROM `tbltransaction` ";
    $recordSelect=mysqli_query($conn,$querySelect);

    while($row=mysqli_fetch_array($recordSelect)) {
        $nid2=$row['id2'];
    }
    $nid2+=1;
    //$finalamt= $gtxt_balance+$txt_gamt-$nremaining;
    if($numphonenumber!=$gsnumber){
        $query="INSERT INTO `phonebook`( `name`, `phonenumber`, `email`, `address`, `pgroup`, `shopid`,venders,gst,statesCode,states) VALUES ('$custname','$gsnumber','$gemaile','$addr','$fid','$shopidval','customer','$fgstt','$fstatesCode','$fstates')";
        $record=mysqli_query($conn,$query);

        $cid =  mysqli_insert_id($conn);

    }
    $query="UPDATE `phonebook` SET `balanceAmt`='$gtxt_balance' WHERE `phonenumber`='$gsnumber'";
    $record=mysqli_query($conn,$query);
    $nfyear1=substr("$nfyear",27);
    $nfyear21=substr("$nfyear",10,3);
    $fidd3=$nfyear21.'-'. $nfyear1;
    $billNo=$fidd3.'/'.'00'.$nid2;
    //$uname2=substr($uname,4,5);
    $query="INSERT INTO `tblquotation`( `billno`, `tdate`, `btotal`, atotal, `shopid`, `fid`, `modeOfPayment`,custid,remark,statusQT,inwords,`trnjType`) VALUES ('$billNo','$todate','$txt_samt1','$txt_gamt','$shopidval','$fid','$modeOfPayment','$cid','$onlineCashCheque','Q','$gwords','withoutTax')";
    $record=mysqli_query($conn,$query);
    $last_row =  mysqli_insert_id($conn);
    foreach ($qty as $key => $valuein) {

        //echo "<script>alert('$unitPrice[$key]')</script>";
        //echo "<script>alert('$totalAmt[$key]')</script>";
        $query="INSERT INTO `tblitem`( `pname`,hsncode, `unitprice`, `quantity`, `total`, `tax`, `taxtotal`, `taxname`, `billno`, `shopid`, `fid`, `oid`, `tid`,discount_price,statusQT) 
VALUES ('$addProName[$key]','$addHsncode[$key]','$unitPrice[$key]','$qty[$key]','$totalAmt[$key]','$taxPer[$key]','$finalTotalAmt[$key]','$gstName[$key]','$billNo','$shopidval','$fid','$txt_offerval[$key]','$last_row','$txt_discountPrice[$key]','Q')";
        $record=mysqli_query($conn,$query);
        $query="UPDATE `tblproduct` SET `quantity`=`quantity`-$qty[$key] WHERE `pname`='$addProName[$key]'";
        $record=mysqli_query($conn,$query);
    }
    $query="UPDATE `phonebook` SET `balanceAmt`='$gtxt_balance' WHERE `cid`='$cid'";
    $record=mysqli_query($conn,$query);
    if($record) {
        $pid= base64_encode($last_row);
        $cdid=base64_encode($cid);
        echo "<script>alert('Added Successfully');</script>";
        echo "<script>window.location.href='quotationBiilPrint.php?custid=$cdid&proId=$pid;'</script>";

    }else{
        echo "<script>alert('Added Not  Successfully');</script>";
    }


}/* echo "<script>alert('$cname')</script>";
    echo "<script>alert('$addProName')</script>";
    echo "<script>alert('$addQuantity')</script>";*/


?>


<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src="jquery.min.js"></script>

    <script type="text/javascript" src="jquery.min1.js"></script>
    <script src="jquery-ui.js" type="text/javascript"></script>
    <link href="jquery-ui.css"
          rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="style.css" media="all" />

    <script src="moment.min.js"></script>
    <style>
        b{
            margin-right: 1cm;
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
            background-color: #59a759;
            border: none;
            color: #001028;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            width: 5%;

        }
    </style>
    <style>
        .dropbtn {
            background-color: #59a759;
            color: #040404;
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
            background-color:  #040404;
            min-width: 200px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        #cheque{
            display: none;
        } #online{
              display: none;
          }
        #finance{
            display: none;
        }
        div#logo {
            position: absolute;
            width: 633px;
            top: 28px;
            right: 192px;
        }
        #company12> h1 {
            font-size: 3em;
            color: limegreen;
            border-top: 0px solid #5D6975;
            border-bottom: 0px solid #5D6975;
            width: 67%;
            /* height: 100%;*/
            margin: 0;
            line-height: 50px;
            text-align: center;
            /* Starting position */
            -moz-transform:translateX(100%);
            -webkit-transform:translateX(100%);
            transform:translateX(100%);
            /* Apply animation to this element */
            -moz-animation: example1 15s linear infinite;
            -webkit-animation: example1 15s linear infinite;
            animation: example1 15s linear infinite;
        }
        /* Move it (define the animation) */
        /*@-moz-keyframes example1 {
            0%   { -moz-transform: translateX(100%); }
            100% { -moz-transform: translateX(-100%); }
        }
        @-webkit-keyframes example1 {
            0%   { -webkit-transform: translateX(100%); }
            100% { -webkit-transform: translateX(-100%); }
        }
        @keyframes example1 {
            0%   {
                -moz-transform: translateX(100%); !* Firefox bug fix *!
                -webkit-transform: translateX(100%); !* Firefox bug fix *!
                transform: translateX(100%);
            }
            100% {
                -moz-transform: translateX(-100%); !* Firefox bug fix *!
                -webkit-transform: translateX(-100%); !* Firefox bug fix *!
                transform: translateX(-100%);
            }
        }*/
        .ui-draggable .ui-dialog-titlebar {
            cursor: move;
            width: 374px;
        }#dilouage-id{
             display: none;
         }
    </style>

</head>
<script>

    $(document).ready(function () {
        $("#btn").on('click', function(e) {
            var fromDate = $('#fromDate').val(),
                toDate = $('#toDate').val(),
                from, to, druation;

            from = moment(fromDate, 'YYYY-MM-DD');
            to = moment(toDate, 'YYYY-MM-DD');

            /* using diff */
            duration = to.diff(from, 'days')

            /* show the result */
            $('#result').text(duration + ' days');
        });

        $("#create").on('click','.remCF',function(){
            var Id = $(this).attr('id');
            var amtTotalgst= $('#total'+Id).val();
            $(this).parent().parent().children('#remove-id-if-user'+Id).remove();

            var prevBal = document.getElementById('txt_samt').value;
            var prevBal1 = document.getElementById('txt_gamt').value

            var storeBal = prevBal - amtTotalgst
            var storeBal1 = prevBal1 - amtTotalgst
            document.getElementById('txt_samt').value=storeBal;
            document.getElementById('txt_gamt').value=storeBal1;

            var totasd=Math.round(storeBal1)
            document.getElementById('txt_gamt22').value = totasd;
            var gprint = 'txt_gamt22';
            var printdata = convertNumberToWords(totasd);
            document.getElementById('words').innerHTML = printdata + ' ' + ' Rupees Only';
            $('#words-id').val(printdata + ' ' + ' Rupees Only');
        });
    });
    //   var FieldCount='';
    function newFun() {
        var proName= document.getElementsByName("txt_product")[0].value

        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: 'getInvoiceData.php',
            async: false,
            data: {"pname": proName},
            success: function (response) {
                var wrapper = $("#create"); //Fields wrapper
                //var add_button = $(".add_field_button"); //Add button ID
                var  response1=response[0].response;
                var  responseOffer1=response[1].responseOffer;

                var FieldCount = response1[0].pid;
                var pnameCount = response1[0].pname;
                var same=$('#proName'+FieldCount).val();
                var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth()+1; //January is 0!

                var yyyy = today.getFullYear();
                if(dd < 10){
                    dd='0'+dd;
                }
                if(mm < 10){
                    mm="0"+mm;
                }
                today = yyyy+'-'+mm+'-'+dd;
                console.log(today);
                if(pnameCount==same){
                    alert('Product Already Selected Duplicate Product Not Allowed')
                }
                else{
                    $(wrapper).append('<div id="remove-id-if-user'+FieldCount+'"><input type="text" id="prohsn'+FieldCount+'"  class="form-control" style="margin-top: 8px;margin-left: 1%;width: 10%;"size="15%" name="addHsncode[]"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="proName'+FieldCount+'"  class="form-control" style="margin-top: 8px;margin-left: 1%;width: 19%;"size="15%" name="addProName1[]"   />&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="unitp'+FieldCount+'"  class="form-control" style="margin-top: 8px;width:12%;" name="unitPrice[]"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="qtyUp'+FieldCount+'" class="form-control" style="margin-top: 8px;width: 6%;" onblur="qtyCalculate(this.id)" name="qty[]"  data-id='+FieldCount+' />&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="nod-Total'+FieldCount+'"  class="form-control" style="margin-top: 8px;width: 11%;" onblur="//findTotal(this.id,x)" name="totalAmt[]" readonly/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="discountPrice'+FieldCount+'" class="form-control" style="margin-top: 8px;width: 9%;"  name="discountPrice[]" readonly/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="total'+FieldCount+'" class="form-control" style="margin-top: 8px;width: 10%"  name="finalTotalAmt[]" readonly>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="offerName'+FieldCount+'" class="form-control" style="margin-top: 8px;width: 5%;"  name="offerid[]" readonly />&nbsp;&nbsp;&nbsp;&nbsp;<input type="hidden" id="offerval'+FieldCount+'" class="form-control" style="margin-top: 8px;width: 6%;"  name="offeridval[]" readonly /><a href="javascript:void(0);" class="remCF" id='+FieldCount+' style="position: absolute;color: red;padding: 5px 4px;font-size: 20px;"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>'); //add input box
                }

                // }
                $('#proName'+FieldCount).val(proName);
                $('#unitp'+FieldCount).val(response1[0].price);
                $('#prohsn'+FieldCount).val(response1[0].hsncode);
                // $('#gstName'+FieldCount).val(response1[0].taxName);
                //$('#taxper'+FieldCount).val(response1[0].taxPercent);

                var validoffer= responseOffer1[0].validDate
                if(today<=validoffer) {
                    $('#offerName'+FieldCount).val(responseOffer1[0].offerPercent);
                    $('#offerval'+FieldCount).val(responseOffer1[0].offerid);
                }else{
                    $('#offerName' + FieldCount).val(0);
                    $('#offerval'+FieldCount).val(responseOffer1[0].offerid);
                }

            },
            error: function (req, status, error) {
            }
        });




//                });
//
//                $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
//                    e.preventDefault();
//                    $(this).parent('div').remove();
//                    x--;
//                })
    }

    //        });

</script>
<style>
    body {
        position: relative;
        width: 25cm;
    }
</style>
<body>
<a href="invoiceHistory.php" class="btn btn-success" style="border-left:none;border-right:none;border-top:none;border-bottom: none;margin: 31px -103px;
    float: left;
    font-size: 20px;
    color: #529e52"><i class="fa fa-arrow-left" aria-hidden="true"></i>BACK</a>
<legend name="legend" id="legend" style="width: 100%;/*MARGIN: 0PX -162PX;*/">
    <header class="clearfix">
        <?php
        include_once 'config.php';
        $querySelect="SELECT * FROM `shop` WHERE `id`='$shopidval'";
        $recordSelect=mysqli_query($conn,$querySelect);

        while($row=mysqli_fetch_array($recordSelect)) {
            $logoImage= $row["logo"];
            ?>
            <div id="logo">
                <img src="<?php echo "img/".$logoImage?>" style="position: absolute;
    width: 141px;
    top: -9px;
    left: -57px;
;">
            </div>
            <div id="company12">
                <?php
                //  echo "<h1>" . $row["shopname"] . "</h1>";
                ?>
            </div>
            <!-- <h1 style="width:100%">MEGA SCAFFOLDING</h1>-->
            <?php
            echo "<div id='project' style='    float: left;
    margin: 2PX 72PX;
'>";
            echo "<div style='margin-left: 30%;font-size: 26PX;font-weight: bold;LINE-HEIGHT: 27PX;'>" . $row["shopname"] . "<br/></div>";
            echo "<div style='margin-left: 30%;font-size: 12px;font-weight: bold;LINE-HEIGHT: 19PX;'>" . $row["email"] . "<br/></div>";
            echo "<div style='margin-left: 30%;font-size: 12px;font-weight: bold;LINE-HEIGHT: 24PX;'>" . $row["phone"] . "<br/></div>";
            echo "<div style='margin-left: 30%;font-size: 12px;font-weight: bold;LINE-HEIGHT: 3PX;'>" . $row["address"] . "<br/></div>";
            echo "<div style='margin-left: 30%;font-size: 12px;font-weight: bold;LINE-HEIGHT: 31PX;'>" . $row["gst"] . "<br/></div>";

            echo "</div>";
        }
        ?>
        <?php if (!isset($_POST['submit_val'])) { ?>

        <form action="" method="post">
            <div id="company" style='margin: 0px -38px'>
                <div>

                    <span><span>Moblie No.&nbsp;&nbsp;&nbsp;&nbsp;<input type="text"  name="number" onKeyPress="if(this.value.length==10) return false;"  id="number" style='' onblur="getDataNumberWise()" value="1234567890" pattern="\d*" > </span></span>
                </div><br/>
                <div>

                    <span>Customer Name&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="custname" id="cname" style='' value="NA"></span>
                </div><br/>
                <div>
                    <span>Address&nbsp;&nbsp;&nbsp;<input type="text" name="addr" id="addr" style='' value="NA" ></span>
                </div><br/>
                <div>
                    <span>Email&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="email" id="email" style='' value="NA"></span>
                </div> </br>
                <div>
                    <span>GST NO&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="gst" id="gstNo" style='' value="NA"></span>
                </div><br/> <div>
                    <span>State &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="states" id="states" style='' value="NA"></span>
                </div>
                <br/> <div>
                    <span>State Code&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="statesCode" id="statesCode" style='' value="NA"></span>
                </div>
                <br/>
                <div>
                    <span ><p style='margin: 1px 63px;
    position: absolute;'>Date</p>&nbsp;&nbsp;&nbsp;&nbsp;<input type="date" name="dateInvoice" id="dateInvoice" style='margin: -62px 0px;
    /* float: left; */
    width: 169px;' value="<?php echo date('Y-m-d')?>"></span>
                </div>
                <br/>
            </div>

            <div>
                <div>
                    <div style="margin-left: 3%;position: relative; width: 370px;
        top: 81px;float: left;"><span><h3><b> </b><b class="dropdown"><select onchange="getCatAcorddingProduct(this.value);" class="dropbtn" required id="txt_product1" name="txt_category">
                 <option class="dropdown-content">Select Category</option>
                                        <?php
                                        include_once 'config.php';
                                        $querySelect="SELECT * FROM `tblcategory` WHERE `shopId`='$shopidval'";
                                        $recordSelect=mysqli_query($conn,$querySelect);

                                        while($row=mysqli_fetch_array($recordSelect))
                                        { ?>
                                            <option value=<?php echo $row['catID'];?>><?php echo $row['catName'];?></option>
                                        <?php } ?>
                        </select></b></h3></span></div>&nbsp;
                    <div id="proName-id">


                        <select class="dropbtn" required id="txt_productName"  name="txt_product" style="width: 22%;position: absolute;     top: 214px;
    right: 431px;">
                            <option class="dropdown-content">Select Product</option>
                        </select>
                    </div>
                </div>


                <!--
              <!--        <div><button class="button" id="add_button" style="margin: 23px 1px;float:right" name="addpickpointName[]">Add(+)</button></div>-->

                <div>
                    <div style="    float: left;
    width: 109%;
    border-top: 1px solid #6bb16b;">
          <span><h3>
                  <b style="margin-left:1%">HSN-CODE</b>
                  <b style="margin-left:1%">Product</b>
                  <b style="margin-left:10%">Unit Price</b>
                  <b style="margin-left: 3%">Qty</b>
                  <b style="margin-left: 0%">Total</b>
                  <b style="margin-left: 5%">Offer Amt</b>

                  <b style="margin-left: 0%">Final Amt</b>

                        <b style="margin-left:-1%">Offer %</b></span>
                    </div>
                    <div id="create" style="float: left; width: 110%;"></div>
                    <br/>
                    <br/>
                    <br/>

                    <div style="float: left;width: 70%;margin: 21px 9px;">
                        <div style="float: left;width: 50%;">
                            <b style="float: left;margin: 3px 27px;">Mode Of Payment</b>
                            <select name="modeOfPayment" style="width: 184px;padding: 9px 1px 6px;margin: -6px 168px;float: left;" onchange="displayidchequeon(this.value)">
                                <option value="cash">Cash</option>
                                <option value="cheque">Cheque</option>
                                <option value="online">Online</option>
                                <option value="finance">Finance</option>
                                <!-- <option value="audi">Audi</option>-->
                            </select>
                            <div id="cash"> <input type="text" name="cashid" id="cheque1" style="margin: 13px 168px;
    width: 180px;
    float: left;
    padding: 0px 0px 13px;" placeholder="description">
                            </div>
                            <div id="cheque"> <input type="text" name="chequeid" id="onlineCashCheque" style="margin: 13px 168px;
    width: 180px;
    float: left;
    padding: 0px 0px 13px;" placeholder="fill  Cheque And Bank Name Details">

                            </div>
                            <div id="online"> <input type="text" name="onlineid" id="cheque1" style="margin: 13px 168px;
    width: 180px;
    float: left;
    padding: 0px 0px 13px;" placeholder="fill NFT No"></div>
                        </div>
                        <div id="finance"> <input type="text" name="finance" id="cheque1" style="margin: 13px 168px;
    width: 180px;
    float: left;
    padding: 0px 0px 13px;" placeholder="Finance Name"></div>
                        <div style="width: 37%;padding: 2px 2px;margin: 0px 1px 1px 6px;display:none" id="tata23">  <b style="float: left; margin: 10px 27px">Balance Amt</b><input type="text" name="txt_balance" id="txt_balance" style="margin: -30px 159px;padding: 6px;float: left;" readonly/>
                            <i class="fa fa-clock-o" title="Paid Reaming Balance " style="    float: right;
    position: absolute;
    top: 488px;
    left: 369px;
    font-size: 25px;
    color: green;cursor: pointer;" id="btnShow-id" onclick="javascript:openDialog()"></i>
                        </div>
                        <div style="width: 37%;padding: 2px 2px;margin: 0px 1px 1px 6px;">  <b style="float: left; margin: 10px 27px">Paid Amt</b><input type="text" name="txt_paiding" id="txt_paiding" style="margin: -30px 159px;padding: 6px;float: left;" onblur="caluTotalpaidAmt()"/>

                        </div>

                        <div style="float: left;width: 59%;padding: 8px 3px;"> <b style="float: left;margin: 7px 27px;">Remaining Balance</b><input type="text" name="remeingBal" id="remeingBal" onkeyup="//remeningCalculate()" style="padding: 6px;"/>
                        </div>

                    </div>
                    <div>

                        <div style="float: right;width: 24%;margin: 21px 0px;">


                <span >
                    <h3><b style="float: left">SubTotal</b>
                        <input type="text" name="txt_samt1" id="txt_samt" style="border-left:none;border-right:none;border-top:none; float: left;
    margin: -16px 89px;" readonly/>
                        <!--<span style="border-left:none;border-right:none;border-top:none;" name="txt_samt" id="txt_samt">-->
                  </span >
                            <span style="float: right;width: 211px;padding: 14px">
                    <b >Discount &nbsp;&nbsp;<input type="text" name="disc" placeholder="In Rupees" onblur='discountCalulate()' id="discount-tot" style="float: left;
    /* width: 43px; */
    margin: -19px 88px; z-index:111111111111111111"></b>
                                </h3>

                        </span>

                            <span>
               <h2>
                   <b style="float: left">GRAND TOTAL</b>
                   <!-- <b name="txt_gamt" id="txt_gamt" style="margin: -21px 162px;color: green;">-->
                        <input type="text" name="txt_gamt1" id="txt_gamt"style="border-left:none;border-right:none;border-top:none;float: left;
    margin: -23px 146px;" readonly/>

                       </h2>
                                <div name="words" id="words" ></div>
            </span>
                        </div>
                        <div style="    float: right;
   width: 93%;
    margin: 8px 0px;">
                <span>
                    <!--<a id="print" href="invoiceinsert.php?id=<?php /*echo  $a*/?>" class="button" style="margin-right: -170%"> Print & save</a>-->

                    <!--<button >Submit</button>-->

                    <div style="display: none"> <input type="text"  id="words-id" name="words">

                            <input type="text" name="txt_gamt2" id="txt_gamt22"style="border-left:none;border-right:none;border-top:none;float: left;
    margin: -23px 146px;" readonly/>
                        </div>
                    <input type="submit" name="submit_val" id="submit_val"  value="Save & Print" class="button1" style="margin-left: 40%;width: 18%;">


                </span>
                        </div>

                    </div>
                </div>
        </form>
    </header>
</legend>
<div  id="dilouage-id">
    <input type="text" name="noBill" id="noBill" placeholder="Enter Bill Number " style=" margin: 0px 27px;
    height: 26px;
    width: 246px;">
    <input type="text"  id="custMob" name="custMob" style="    margin: 7px 27px;
    height: 26px;width: 246px;">

    <input type="text" name="custBal" id="custBal" style="    margin: 7px 27px;
    height: 26px;width: 246px;">
</div>
<?php } ?>
<style>
    #legend {
        border-style: solid;
        border-width: medium;
    }
    #words{
        width: 624px;
        float: left;
        margin: 29px -75px;
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
    var sutota=0;
    function qtyCalculate(str) {

        var pId = str.substr(5, 4);
        var  unitPrice= $('#unitp'+pId).val();
        var totalqty=  $('#qtyUp'+pId).val();
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
            var amtTotal=amtTotal1-amtTotal2;
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


        //var temp=document.getElementById('txt_samt').innerText;
        // sutota=+amtTotalGstamt;

        //sutota=(sutota)+(amtTotalGstamt);
        //document.getElementById('txt_samt').value=sutota;
        //document.getElementById('txt_gamt').value=sutota;
        var sutota1 = (storeBal) + (amtTotalGstamt);
        var sutota12 = (storeBal1) + (amtTotalGstamt);
        document.getElementById('txt_samt').value = sutota1;
        document.getElementById('txt_gamt').value = sutota12;
        var totasd=Math.round(sutota12)
        document.getElementById('txt_gamt22').value = totasd;
        var gprint = 'txt_gamt22';
        var printdata = convertNumberToWords(totasd);
        document.getElementById('words').innerHTML = printdata + ' ' + ' Rupees Only';
        $('#words-id').val(printdata + ' ' + ' Rupees Only');

    }

    function caluTotalpaidAmt() {
        var txt_balance = document.getElementById('txt_balance').value;
        var txt_gamt = document.getElementById('txt_gamt').value;
        var txt_paiding = document.getElementById('txt_paiding').value;

        var ftxt_balance=txt_gamt-txt_paiding;
        if(txt_balance<=0){
            $('#txt_balance').val(ftxt_balance);
            $('#remeingBal').val(ftxt_balance);
        }else{
            var finalRemBal=parseFloat(txt_balance) + parseFloat(ftxt_balance);
            $('#remeingBal').val(ftxt_balance);
            $('#txt_balance').val(finalRemBal);
        }




    }
    function discountCalulate() {
        var num = document.getElementById('discount-tot').value;
        var sutota=document.getElementById('txt_samt').value
        if(num) {
            var no = parseFloat(sutota) - parseFloat(num);

            document.getElementById('txt_gamt').value = parseInt(no);
            //document.getElementById('txt_samt').value = parseInt(no);
            var totasd=Math.round(no)
            document.getElementById('txt_gamt22').value = totasd;
            var gprint = 'txt_gamt22';
            var printdata = convertNumberToWords(totasd);
            document.getElementById('words').innerHTML = printdata + ' ' + ' Rupees Only';
            $('#words-id').val(printdata + ' ' + ' Rupees Only');


        }else{
            document.getElementById('txt_gamt').value = parseInt(sutota);
            document.getElementById('txt_samt').value = parseInt(sutota);
            var totasd=Math.round(sutota)
            document.getElementById('txt_gamt22').value = totasd;
            var gprint = 'txt_gamt22';
            var printdata = convertNumberToWords(totasd);
            document.getElementById('words').innerHTML = printdata + ' ' + ' Rupees Only';
            $('#words-id').val(printdata + ' ' + ' Rupees Only');

        }

    }
    function openDialog() {
        var custNo= document.getElementById("number").value;
        var custtxt_balance= document.getElementById("txt_balance").value;
        document.getElementById("custMob").value=custNo;
        document.getElementById("custBal").value=custtxt_balance;
        $('#dilouage-id').dialog('open');
        $('#dilouage-id').dialog({
            modal: true,
            autoOpen: false,
            title: "Paid Reamming Balance",
            position: ['center', 0],
            width: 400,
            height: 250,
            buttons: {
                'Paid Balance': function () {
                    PaidRemaningBalance();
                } ,
                'Cancel': function () {
                    $(this).dialog('close');
                }
            }
        });

    }
    function PaidRemaningBalance() {
        var noBill= document.getElementById("noBill").value;
        var custMob= document.getElementById("custMob").value;
        var custBal= document.getElementById("custBal").value;
        if(!noBill){
            alert('Bill number is compulsory')
            return;
        }
        $.ajax({
            type: "POST",
            url: 'paidremanningBalance.php',
            dataType:"json",
            async:"false",
            data:{"noBill":noBill,"custMob":custMob,"custBal":custBal},
            success: function(response){
                alert(response);
                $('#dilouage-id').dialog('close');
                document.getElementById("txt_balance").value=response[0].balanceAmt;

            }
        });
    }
    function getDataNumberWise() {
        var number1= document.getElementById('number').value ;
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: 'numberWiseData.php',
            async: false,
            data: {"number": number1},
            success: function (response) {

                if(response){
                    $('#tata23').show();
                    $('#number').val(number1);
                    $('#cname').val(response[0].name);
                    $('#addr').val(response[0].address);
                    $('#email').val(response[0].email);
                    $('#txt_balance').val(response[0].balanceAmt);
                    $('#states').val(response[0].states);
                    $('#gstNo').val(response[0].gst);
                    $('#statesCode').val(response[0].statesCode);
                }if(response.objects.length == 0){
                    alert(response)
                    $('#number').val('');
                    $('#cname').val('');
                    $('#addr').val('');
                    $('#email').val('');
                }
            },
            error: function (req, status, error) {
            }
        });


    }
    function displayidchequeon(id) {
        if(id=='cheque'){
            $('#cheque').show();
            $('#cash').hide();
            $('#online').hide();
        } else if(id=='online'){
            $('#online').show();
            $('#cash').hide();
            $('#cheque').hide();}
        else if(id=='cash'){
            $('#cash').show();
            $('#online').hide();
            $('#cheque').hide();}
        else if(id=='finance'){
            $('#finance').show();
            $('#cash').hide();
            $('#online').hide();
            $('#cheque').hide();}

    }
    /* $(function () {

     $('form').on('#submit_val', function (e) {

     e.preventDefault();

     $.ajax({
     type: 'post',
     url: 'insertDataUserManualInvoice.php',
     data: $('form').serialize(),
     success: function () {
     alert('form was submitted');
     }
     });

     });

     });*/
    /* $("form").submit(function(){
     var str = $(this).serialize();
     $.ajax('insertDataUserManualInvoice.php', str, function(result){
     alert(result); // the result variable will contain any text echoed by getResult.php
     });return(false);
     });*/
    var total=0;
    /*function findTotal(str,findTotal1){

     var tot = 0;
     var tot1 = 0;
     var strSubCutter = str.substr(3, 4);
     if(strSubCutter==findTotal1) {
     var arr = document.getElementById('qty' + findTotal1).value;
     var arr1 = document.getElementById('rpp' + findTotal1).value;
     var ar2 = document.getElementById('nod' + findTotal1).value;
     var temp_val=document.getElementById('total'+findTotal1).value;
     tot = arr * arr1 * ar2;
     tot1=$('#total' + findTotal1).val(tot);
     total=(total)+(tot)-temp_val;

     }else{
     var arr = document.getElementById('qty' + strSubCutter).value;
     var arr1 = document.getElementById('rpp' + strSubCutter).value;
     var ar2 = document.getElementById('nod' + strSubCutter).value;
     var temp_val=document.getElementById('total'+findTotal1).value;

     tot = arr * arr1 * ar2;
     tot1=$('#total' + strSubCutter).val(tot);
     total=(total)+(tot)-temp_val;

     }
     var gprint = 'txt_samt';
     document.getElementById('txt_samt').innerHTML=parseFloat(total);
     document.getElementById('txt_gamt').innerHTML=parseInt(total).toFixed(2);
     var printdata =  convertNumberToWords(totasd);
     document.getElementById('words').innerHTML = printdata+' '+ ' Rupees Only';
     */        //var abc=document.getElementById('txt_ramt'+findTotal1).value;
    /*if(temp==tot)
     {
     // total=parseFloat(abc)+parseFloat(total);
     document.getElementById('txt_samt').innerHTML=parseFloat(total);
     document.getElementById('txt_gamt').innerHTML=parseInt(total).toFixed(2);
     var gprint = 'txt_samt';
     var printdata =  convertNumberToWords(totasd);
     document.getElementById('words').innerHTML = printdata+' '+ ' Rupees Only';

     }
     else
     {
     // total=0;
     var n14= total-temp
     total=parseFloat(abc)+parseFloat(total)-temp;
     document.getElementById('txt_samt').innerHTML=parseInt(total);
     document.getElementById('txt_gamt').innerHTML=parseInt(total);
     var gprint = 'txt_samt';
     var printdata =  convertNumberToWords(totasd);
     document.getElementById('words').innerHTML = printdata+' '+ ' Rupees Only';
     }*/
    //insertData(qty,intId,orderid,tot,total,idintId)
    /*qtyfunction (intId);*/
    //}

    /* function qtyfunction(intId)
     {
     var sname= document.getElementById('pname'+intId).value;
     var qty = document.getElementById('qty'+intId).value;
     $.ajax({
     type: "POST",
     dataType: "JSON",
     url: 'stockupdate.php',
     async: false,
     data: {"pname": sname,"qty": qty},
     success: function (response) {
     //alert(response);
     },
     error: function (req, status, error) {
     }
     });
     }*/

    /*    function insertData(qty,intId,orderid,tot,printdata,idintId)
     {


     var rentPrice = document.getElementById('qty1'+intId).value;
     var noOfdays = document.getElementById('qty2'+intId).value;
     var sname= document.getElementById('pname'+intId).value;
     var qty= document.getElementById('qty'+intId).value;
     $.ajax({
     type: "POST",
     dataType: "JSON",
     url: 'invoiceinsert.php',
     async: false,
     data: {"pname": sname,"qty": qty,"rentPrice": rentPrice,"noOfdays": noOfdays,"total": tot,"orderid": orderid,"gtot":printdata,"idintId":idintId},
     success: function (response) {
     //alert(response);
     },
     error: function (req, status, error) {
     }
     });
     }*/

    function discounttotal() {
        var gtot = document.getElementById('txt_samt').innerText;
        // alert(gtot);
        var num = document.getElementById('qty3').value;
        no=parseFloat(gtot)-parseFloat(num);
        document.getElementById('txt_gamt').innerHTML=parseInt(no);
        var gprint = 'txt_gamt';
        var printdata =  convertNumberToWords(no);
        document.getElementById('words').innerHTML = printdata+' '+ ' Rupees Only';
    }

    // American Numbering System
    function convertNumberToWords(amount) {
        var words = new Array();
        words[0] = '';
        words[1] = 'One';
        words[2] = 'Two';
        words[3] = 'Three';
        words[4] = 'Four';
        words[5] = 'Five';
        words[6] = 'Six';
        words[7] = 'Seven';
        words[8] = 'Eight';
        words[9] = 'Nine';
        words[10] = 'Ten';
        words[11] = 'Eleven';
        words[12] = 'Twelve';
        words[13] = 'Thirteen';
        words[14] = 'Fourteen';
        words[15] = 'Fifteen';
        words[16] = 'Sixteen';
        words[17] = 'Seventeen';
        words[18] = 'Eighteen';
        words[19] = 'Nineteen';
        words[20] = 'Twenty';
        words[30] = 'Thirty';
        words[40] = 'Forty';
        words[50] = 'Fifty';
        words[60] = 'Sixty';
        words[70] = 'Seventy';
        words[80] = 'Eighty';
        words[90] = 'Ninety';
        amount = amount.toString();
        var atemp = amount.split(".");
        var number = atemp[0].split(",").join("");
        var n_length = number.length;
        var words_string = "";
        if (n_length <= 9) {
            var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
            var received_n_array = new Array();
            for (var i = 0; i < n_length; i++) {
                received_n_array[i] = number.substr(i, 1);
            }
            for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
                n_array[i] = received_n_array[j];
            }
            for (var i = 0, j = 1; i < 9; i++, j++) {
                if (i == 0 || i == 2 || i == 4 || i == 7) {
                    if (n_array[i] == 1) {
                        n_array[j] = 10 + parseInt(n_array[j]);
                        n_array[i] = 0;
                    }
                }
            }
            value = "";
            for (var i = 0; i < 9; i++) {
                if (i == 0 || i == 2 || i == 4 || i == 7) {
                    value = n_array[i] * 10;
                } else {
                    value = n_array[i];
                }
                if (value != 0) {
                    words_string += words[value] + " ";
                }
                if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
                    words_string += "Crores ";
                }
                if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
                    words_string += "Lakhs ";
                }
                if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
                    words_string += "Thousand ";
                }
                if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
                    words_string += "Hundred and ";
                } else if (i == 6 && value != 0) {
                    words_string += "Hundred ";
                }
            }
            words_string = words_string.split("  ").join(" ");
        }
        return words_string;
    }
</script>
</main>

</body>
</html>
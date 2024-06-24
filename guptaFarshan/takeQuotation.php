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
$shopid=$_SESSION['shopidu'];
$fid=$_SESSION['fid'];
?>


<?php
if(isset($_POST['submit_val'])) {
    $addProName=$_REQUEST['addProName1'];
    $unitPrice=$_REQUEST['unitPrice'];
    $finalTotalAmt=$_REQUEST['finalTotalAmt'];
    $totalAmt=$_REQUEST['totalAmt'];
    $qty=$_REQUEST['qty'];
    $taxPer=$_REQUEST['taxPer'];
    $gstName=$_REQUEST['gstName'];
    $custname=$_REQUEST['custname'];
    $addr=$_REQUEST['addr'];
    $gemaile=$_REQUEST['email'];


    $modeOfPayment=$_REQUEST['modeOfPayment'];
    if($modeOfPayment=='cash'){
        $onlineCashCheque=$_REQUEST['cashid'];
    }elseif($modeOfPayment=='online'){
        $onlineCashCheque=$_REQUEST['chequeid'];
    }elseif($modeOfPayment=='cheque'){
        $onlineCashCheque=$_REQUEST['onlineid'];
    }
    ///echo "<script>alert('$onlineCashCheque');</script>";
    $gsnumber=$_REQUEST['number'];
    $txt_gamt=$_REQUEST['txt_gamt1'];
    $txt_samt1=$_REQUEST['txt_samt1'];
    $txt_words=$_REQUEST['words'];
    $txt_discount=$_REQUEST['disc'];
    $txt_offerval=$_REQUEST['offeridval'];
    $txt_states=$_REQUEST['states'];
    $txt_discountPrice =$_REQUEST['discountPrice'];
    $txt_gst =$_REQUEST['gst'];
    $txt_statesCode =$_REQUEST['statesCode'];
   // $billNo='shop_id001';
    //$modeOfPayment='Cash';
    $remaining=0;

    $querySelect="SELECT * FROM `phonebook` WHERE `phonenumber`='$gsnumber'";
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
    $querySelect="SELECT max(`qid`)as id2 FROM `tblquotation` ";
    $recordSelect=mysqli_query($conn,$querySelect);

    while($row=mysqli_fetch_array($recordSelect)) {
        $nid2=$row['id2'];
    }
    $nid2+=1;
    if($numphonenumber!=$gsnumber){
        $query="INSERT INTO `phonebook`( `name`, `phonenumber`, `email`, `address`, `pgroup`, `shopid`,venders,states,gst,statesCode) VALUES ('$custname','$gsnumber','$gemaile','$addr','$fid','$shopid','customer','$txt_states','$txt_gst','$txt_statesCode')";
        $record=mysqli_query($conn,$query);

        $cid =  mysqli_insert_id($conn);

    }
    $nfyear1=substr("$nfyear",27);
    $nfyear21=substr("$nfyear",10,3);
    $fidd3=$nfyear21.'-'. $nfyear1;
    $billNo=$fidd3.'/'.'00'.$nid2;
    $query="INSERT INTO `tblquotation`( `billno`, `tdate`, `btotal`, atotal, `shopid`, `fid`,custid,statusQT,inwords,discount) VALUES ('$billNo',now(),'$txt_samt1','$txt_gamt','$shopid','$fid','$cid','Q','$txt_words','$txt_discount')";
    $record=mysqli_query($conn,$query);
    $last_row =  mysqli_insert_id($conn);
    foreach ($qty as $key => $valuein) {
        $query="INSERT INTO `tblitem`( `pname`, `unitprice`, `quantity`, `total`, `tax`, `taxtotal`, `taxname`, `billno`, `shopid`, `fid`, `oid`, `tid`,discount_price,statusQT) 
VALUES ('$addProName[$key]','$unitPrice[$key]','$qty[$key]','$totalAmt[$key]','$taxPer[$key]','$finalTotalAmt[$key]','$gstName[$key]','$billNo','$shopid','$fid','$txt_offerval[$key]','$last_row','$txt_discountPrice[$key]','Q')";
        $record=mysqli_query($conn,$query);
        $query="UPDATE `tblproduct` SET `quantity`=`quantity`-$qty[$key] WHERE `pname`='$addProName[$key]'";
        $record=mysqli_query($conn,$query);
    }
    if($record) {
        $pid= base64_encode($last_row);
        $cdid=base64_encode($cid);
        echo "<script>alert('Wait For Printing');</script>";
        echo "<script>window.location.href='quotationBiilPrint.php?custid=$cdid&proId=$pid;'</script>";

    }else{
        echo "<script>alert('Print Not  Successfully');</script>";
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
    <link rel="stylesheet" href="style.css" media="all" />


    <script src="jquery.min.js"></script>

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
            var tota= document.getElementById('txt_samt').value
            sutota=tota-amtTotalgst;
            document.getElementById('txt_samt').value=sutota;
            document.getElementById('txt_gamt').value=sutota;
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
                //alert(same)
                // x++;
                if(pnameCount==same){
                    alert('Product Already Selected Duplicate Product Not Allowed')
                }
                else{
                    $(wrapper).append('<div id="remove-id-if-user'+FieldCount+'"><input type="text" id="proName'+FieldCount+'"  class="form-control" style="margin-top: 8px;margin-left: 1%;width: 19%;"size="15%" name="addProName1[]"   />&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="unitp'+FieldCount+'"  class="form-control" style="margin-top: 8px;width:17%;" name="unitPrice[]"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="qtyUp'+FieldCount+'" class="form-control" style="margin-top: 8px;width: 6%;" onblur="qtyCalculate(this.id)" name="qty[]"  data-id='+FieldCount+' />&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="nod-Total'+FieldCount+'"  class="form-control" style="margin-top: 8px;width: 15%;" onblur="//findTotal(this.id,x)" name="totalAmt[]" readonly/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="discountPrice'+FieldCount+'" class="form-control" style="margin-top: 8px;width: 9%;"  name="discountPrice[]" readonly/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="total'+FieldCount+'" class="form-control" style="margin-top: 8px;width: 10%"  name="finalTotalAmt[]" readonly>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="offerName'+FieldCount+'" class="form-control" style="margin-top: 8px;width: 5%;"  name="offerid[]" readonly />&nbsp;&nbsp;&nbsp;&nbsp;<input type="hidden" id="offerval'+FieldCount+'" class="form-control" style="margin-top: 8px;width: 6%;"  name="offeridval[]" readonly /><a href="javascript:void(0);" class="remCF" id='+FieldCount+' style="position: absolute;color: red;padding: 5px 4px;font-size: 20px;"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>'); //add input box
                }

                // }
                $('#proName'+FieldCount).val(proName);
                $('#unitp'+FieldCount).val(response1[0].price);
               // $('#gstName'+FieldCount).val(response1[0].taxName);
                //$('#taxper'+FieldCount).val(response1[0].taxPercent);
                $('#offerName'+FieldCount).val(responseOffer1[0].offerPercent);
                $('#offerval'+FieldCount).val(responseOffer1[0].offerid);
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
        $querySelect="SELECT * FROM `shop` WHERE `id`='$shopid'";
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

                    <span><span>Moblie No.&nbsp;&nbsp;&nbsp;&nbsp;<input type="number" name="number" onKeyPress="if(this.value.length==10) return false;" id="number" style='' onblur="getDataNumberWise()" value="980000XXXX"> </span></span>
                </div><br/>
                <div>

                    <span>Customer Name&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="custname" id="cname" style='' value="NA"></span>
                </div><br/>
                <div>
                    <span>Address&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="addr" id="addr" style='' value="NA" ></span>
                </div><br/>
                <div>
                    <span>Email&nbsp;&nbsp;&nbsp;&nbsp;<input type="email" name="email" id="email" style='' value="NA"></span>
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
                                        $querySelect="SELECT * FROM `tblcategory` WHERE `shopId`='$shopid'";
                                        $recordSelect=mysqli_query($conn,$querySelect);

                                        while($row=mysqli_fetch_array($recordSelect))
                                        { ?>
                                            <option value=<?php echo $row['catID'];?>><?php echo $row['catName'];?></option>
                                        <?php } ?>
                        </select></b></h3></span></div>&nbsp;
                    <div id="proName-id">


                        <select class="dropbtn" required id="txt_productName"  name="txt_product" style="width: 22%;position: absolute;     top: 212px;
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
                  <b style="margin-left:1%">Product</b>
                  <b style="margin-left:11%">Unit Price</b>
                  <b style="margin-left: 7%">Qty</b>
                  <b style="margin-left: 2%">Total</b>
                  <b style="margin-left: 7%">Offer Amt</b>

                  <b style="margin-left: 1%">Final Amt</b>

                        <b style="margin-left:-1%">Offer %</b></span>
                    </div>
                    <div id="create" style="float: left; width: 110%;"></div>
                    <br/>
                    <br/>
                    <br/>

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
        var printdata = toWords(gprint);
        document.getElementById('words').innerHTML = printdata + ' ' + ' Rupees Only';
        $('#words-id').val(printdata + ' ' + ' Rupees Only');

    }
    function caluTotalpaidAmt() {
        var txt_balance = document.getElementById('txt_balance').value;
        var txt_gamt = document.getElementById('txt_gamt').value;
        var txt_paiding = document.getElementById('txt_paiding').value;

        var ftxt_balance=parseFloat(txt_balance)+parseFloat(txt_gamt)-parseFloat(txt_paiding);
        $('#txt_balance').val(ftxt_balance);


        var rem=parseFloat(txt_balance)+parseFloat(txt_gamt)-parseFloat(txt_paiding);
        $('#remeingBal').val(rem);
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
            var printdata = toWords(gprint);
            document.getElementById('words').innerHTML = printdata + ' ' + ' Rupees Only';
            $('#words-id').val(printdata + ' ' + ' Rupees Only');


        }else{
            document.getElementById('txt_gamt').value = parseInt(sutota);
            document.getElementById('txt_samt').value = parseInt(sutota);
            var totasd=Math.round(sutota)
            document.getElementById('txt_gamt22').value = totasd;
            var gprint = 'txt_gamt22';
            var printdata = toWords(gprint);
            document.getElementById('words').innerHTML = printdata + ' ' + ' Rupees Only';
            $('#words-id').val(printdata + ' ' + ' Rupees Only');

        }

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

                if(response[0].status=='No found'){
                   //$('#number').val('');
                    $('#cname').val('');
                    $('#addr').val('');
                    $('#email').val('');
                    //$('#txt_balance').val('');
					$('#gstNo').val('');
					$('#statesCode').val('');
					$('#states').val('');
                }else{
                   $('#tata23').show();
                    $('#number').val(number1);
                    $('#cname').val(response[0].name);
                    $('#addr').val(response[0].address);
                    $('#email').val(response[0].email);
                   // $('#txt_balance').val(response[0].balanceAmt);
					$('#gstNo').val(response[0].gst);
					$('#statesCode').val(response[0].statesCode);
					$('#states').val(response[0].states);
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
     var printdata =  toWords(gprint);
     document.getElementById('words').innerHTML = printdata+' '+ ' Rupees Only';
     */        //var abc=document.getElementById('txt_ramt'+findTotal1).value;
    /*if(temp==tot)
     {
     // total=parseFloat(abc)+parseFloat(total);
     document.getElementById('txt_samt').innerHTML=parseFloat(total);
     document.getElementById('txt_gamt').innerHTML=parseInt(total).toFixed(2);
     var gprint = 'txt_samt';
     var printdata =  toWords(gprint);
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
     var printdata =  toWords(gprint);
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
        var printdata =  toWords(gprint);
        document.getElementById('words').innerHTML = printdata+' '+ ' Rupees Only';
    }

    // American Numbering System
    var th = ['', 'Thousand', 'Lacs', 'Crore'];

    var dg = ['Zero', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'];

    var tn = ['Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];

    var tw = ['Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

    function toWords(gprint) {
        var s=$('#'+ gprint).val();
        s = s.toString();
        s = s.replace(/[\, ]/g, '');
        if (s != parseFloat(s)) return 'not a number';
        var x = s.indexOf('.');
        if (x == -1) x = s.length;
        if (x > 15) return 'too big';
        var n = s.split('');
        var str = '';
        var sk = 0;
        for (var i = 0; i < x; i++) {
            if ((x - i) % 3 == 2) {
                if (n[i] == '1') {
                    str += tn[Number(n[i + 1])] + ' ';
                    i++;
                    sk = 1;
                } else if (n[i] != 0) {
                    str += tw[n[i] - 2] + ' ';
                    sk = 1;
                }
            } else if (n[i] != 0) {
                str += dg[n[i]] + ' ';
                if ((x - i) % 3 == 0) str += 'hundred ';
                sk = 1;
            }
            if ((x - i) % 3 == 1) {
                if (sk) str += th[(x - i - 1) / 3] + ' ';
                sk = 0;
            }
        }
        if (x != s.length) {
            var y = s.length;
            str += 'point ';
            for (var i = x + 1; i < y; i++) str += dg[n[i]] + ' ';
        }
        return str.replace(/\s+/g, ' ');

    }
</script>
</main>

</body>
</html>
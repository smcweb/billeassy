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
$str=$_GET['custid'];
$str1=$_GET['proId'];

$custid = base64_decode($str);
$proId = base64_decode($str1);
if(isset($_POST['submit_val-1'])) {
    $gsnuupdate = $_REQUEST['update'];
    $statesCode=$_REQUEST['statesCode'];


    $txt_samt1=$_REQUEST['txt_samt1'];

    $disc=$_REQUEST['disc'];

    $txt_gamt=$_REQUEST['txt_gamt1'];
    $cwords=$_REQUEST['words'];
    $addr=$_REQUEST['addr'];
    $fstates=$_REQUEST['states'];
    $custname=$_REQUEST['custname'];
    $custgst=$_REQUEST['gst'];

    $gemaile=$_REQUEST['email'];
    $gtxt_balance=$_REQUEST['txt_balance'];
    $todate=$_REQUEST['dateInvoice'];
    $toitemid=$_REQUEST['itemid'];
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
    $querySelect="SELECT max(`qid`)as id2 FROM `tblquotation` ";
    $recordSelect=mysqli_query($conn,$querySelect);

    while($row=mysqli_fetch_array($recordSelect)) {
        $nid2=$row['id2'];
    }
    $nid2+=1;
    //$finalamt= $gtxt_balance+$txt_gamt-$nremaining;

    $query="UPDATE `phonebook` SET `name`='$custname',`phonenumber`='$gsnumber',`email`='$gemaile',`address`='$addr',`states`='$fstates',`gst`='$custgst',`pgroup`='$fid',`statesCode`='$statesCode' WHERE `cid` ='$custid' AND `shopid`='$shopidval'";
    $record=mysqli_query($conn,$query);





    $query="UPDATE `phonebook` SET `balanceAmt`='$gtxt_balance' WHERE `cid` ='$custid'";
    $record=mysqli_query($conn,$query);
    $nfyear1=substr("$nfyear",27);
    $nfyear21=substr("$nfyear",10,3);
    $fidd3=$nfyear21.'-'. $nfyear1;
    $billNo=$fidd3.'/'.'00'.$nid2;
    //$uname2=substr($uname,4,5);
    $query="UPDATE `tblquotation` SET `tdate`='$todate',`btotal`='$txt_samt1',`discount`='$txt_discount',`atotal`='$txt_gamt',`inwords`='$cwords',`fid`='$fid',`modeOfPayment`='$onlineCashCheque',`statusQT`='Q' WHERE `qid` ='$proId' AND shopid='$shopidval' ";
    $record=mysqli_query($conn,$query);
    $last_row =  mysqli_insert_id($conn);
    $insert_id = $_REQUEST['insert-id'];
    $statesCode = $_REQUEST['statesCode'];
    if ($insert_id == 'insert') {
        $addProName1 = $_REQUEST['productname11'];
        $qHSNNo1 = $_REQUEST['HSNNo1'];
        $quantity = $_REQUEST['quantity-1'];
        $quofferidval1 = $_REQUEST['offeridval1'];
        $unitprice = $_REQUEST['unitprice-11'];

        $total = $_REQUEST['total1'];

        $offerPercent = $_REQUEST['offerPercent1'];


        $discount_price = $_REQUEST['discount_price1'];

        $finaltotal = $_REQUEST['finaltotal1'];
        foreach ($quantity as $key => $valuein) {

            $query = "INSERT INTO tblitem (pname, unitprice, quantity,total,taxtotal,discount_price,billno,fid,statusQT,tid,hsncode,shopid,oid)
VALUES('$addProName1[$key]','$unitprice[$key]','$quantity[$key]','$total[$key]','$finaltotal[$key]','$discount_price[$key]','$billNo','$fid','Q','$proId','$qHSNNo1[$key]','$shopidval','$quofferidval1[$key]')
";
            $record = mysqli_query($conn, $query);

        }


    }
if($gsnuupdate == 'update') {
    $addProName = $_REQUEST['productname1'];

    $quantity = $_REQUEST['quantity'];

    $unitprice = $_REQUEST['unitprice-1'];

    $total = $_REQUEST['total'];

    $discount_price = $_REQUEST['discount_price'];

    $finaltotal = $_REQUEST['finaltotal'];
    $offerPercent = $_REQUEST['offerPercent'];
    foreach ($quantity as $key => $valuein) {
        $query = "UPDATE `tblitem` SET `pname`='$addProName[$key]',`unitprice`='$unitprice[$key]',`quantity`='$quantity[$key]',`total`='$total[$key]',`finaltotal`='$finaltotal[$key]',`taxtotal`='$finaltotal[$key]',`discount_price`='$discount_price[$key]',`billno`='$billNo',`fid`='$fid',`statusQT`='Q' WHERE `itemid`='$toitemid[$key]' AND shopid='$shopidval'";
        $record = mysqli_query($conn, $query);
    }
}
    $query="UPDATE `phonebook` SET `balanceAmt`='$gtxt_balance' WHERE `cid`='$custid'";
    $record=mysqli_query($conn,$query);
    if($record) {
        $pid= base64_encode($last_row);
        $cdid=base64_encode($cid);
        echo "<script>alert('Added Successfully');</script>";
        echo "<script>window.location.href='quotationBiilPrint.php?custid=$str&proId=$str1;'</script>";

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
        getDataPrintData()
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

        $("#create-1").on('click','.remCF',function(){
            var Id = $(this).attr('id');
            var amtTotalgst= $('#finaltotal'+Id).val();
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

        function getDataPrintData() {
            // alert('searchItem.length12');
            var js_custid = <?php echo json_encode($str); ?>;
            var js_proId = <?php echo json_encode($str1); ?>;
            var request = $.ajax({
                url: "getEditQuattionData.php",
                type: "POST",
                data: {'js_proId' : js_proId,'js_custid':js_custid},
                dataType: "json"
            });

            request.done(function(msg) {
                var msg2=msg[0].response
                var msg21=msg[1].responseOffer
                var msg212=msg[2].responseOfferid
                /* var offid=msg2[0].offerid;
                 alert(offid)*/
                fillDataInTable(msg2)
                fillDataInCustWise(msg21)
                fillDataInCustWiseTranj(msg212)
            });

            request.fail(function(jqXHR, textStatus) {
                alert( "Request failed: " + textStatus );
            });
        }
        function fillDataInCustWise(custid) {
            $("#number").val(custid[0].phonenumber);
            $("#cname").val(custid[0].name);
            $("#addr").val(custid[0].address);
            $("#email").val(custid[0].email);
            $("#email").val(custid[0].email);
            $("#gstNo").val(custid[0].gst);
            $("#states").val(custid[0].states);
            $("#statesCode").val(custid[0].statesCode);
            /*$("#statesCode").val(custid[0].statesCode);*/
            // $("#number").val("Dolly Duck");
            //number

        }
        function fillDataInCustWiseTranj(custid) {
            $("#txt_samt").val(custid[0].atotal);
            $("#discount-tot").val(custid[0].discount);
            $("#txt_gamt").val(custid[0].btotal);
            $("#words").text(custid[0].inwords);
            $("#dateInvoice").val(custid[0].tdate);

        }
        function fillDataInTable(searchItem) {
            //   alert(searchItem.length);
            var itemTable = $('#create');
            var foodTable = "";
            foodTable += "<table class='table table-bordered'>";
            foodTable += "<tr>"+
                "<th style='text-align: left;'>Item Name</th><th>HSN No. </th><th>Qty</th><th>Unit Price </th></th>" +
                "<th> Total </th><th> Offer %</th>" +
                "<th> Discount Price </th><th> Final Total </th><th>Modify </th></tr>";

            for (var i = 0; i < searchItem.length; i++) {
                foodTable += "<tr class='highlight-row' id='remove-id-if-user"+searchItem[i].itemid+"' >";
                foodTable += "<td>" +'<input  type="text"  name="productname1[]"  id="pname'+searchItem[i].itemid+'" class="form-control"  style=" float: left; margin: 1px -19px ;width: 110px;"  value="' + searchItem[i].pname + '" readonly >' + "</td>";
                foodTable += "<td>" +'<input  type="text"  name="HSNNo[]"  id="HSNNo'+searchItem[i].itemid+'" class="form-control" style=" float: left;width: 62px;" value="' + searchItem[i].hsncode + '"  >' + "</td>";
                foodTable += "<td>" +'<input  type="text"  name="quantity[]" onblur="accordingQtyCalulate(this.id)"  id="quantity'+searchItem[i].itemid+'"  value="' + searchItem[i].quantity + '"   style="float: left;width:62px;"  >' + "</td>";
                foodTable += "<td>" +'<input  type="text"  name="unitprice-1[]"  onblur="accordingQtyCalulate(this.id)" id="unitpric'+searchItem[i].itemid+'"  value="' + searchItem[i].unitprice + '"  style="float: left;width: 75px;" >' + "</td>";
                foodTable += "<td>" +'<input  type="text"  name="total[]"  id="total'+searchItem[i].itemid+'"  value="' + searchItem[i].total + '"  style="float: left;width: 75px;" readonly>' + "</td>";
                foodTable += "<td>" +'<input  type="text"  name="offerPercent[]"  id="offerPercent'+searchItem[i].itemid+'"  value="' + searchItem[i].offerPercent + '"  style="float: left;width: 75px;" >' + "</td>";
                foodTable += "<td>" +'<input  type="text"  name="discount_price[]"  id="discount_price'+searchItem[i].itemid+'"  value="' + searchItem[i].discount_price + '"  style="float: left;width: 75px;" >' + "</td>";
                foodTable += "<td>" +'<input  type="text"  name="finaltotal[]"  id="finaltotal'+searchItem[i].itemid+'"  value="' + searchItem[i].taxtotal + '"  style="float: left;width: 75px;" readonly >' + "</td>";
                foodTable += "<td><i id='"+searchItem[i].itemid+"' style='margin: 0px 35px;' title='Delete' class='fa fa-trash-o admin_rowControls admindeleteItem'></i></td> </tr>";
                foodTable += '<input  type="hidden"  name="itemid[]"  id="itemid'+searchItem[i].itemid+'"  value="' + searchItem[i].itemid + '"  style="float: left;width: 75px;" >';
                foodTable += '<input  type="hidden"  name="itemBill[]"  id="itemBill'+searchItem[i].itemid+'"  value="' + searchItem[i].billno + '"  style="float: left;width: 75px;" >';

            }
            foodTable += "<input type='hidden' id='update' class='form-control' style='width: 62px;margin: 0px 13px;' name='update'>";
            foodTable += "</table>";
            itemTable.empty();
            itemTable.append(foodTable);
        }






        $("#create").on('click','.admindeleteItem',function() {
            var Id = $(this).attr('id');
            var amtTotalgst= $('#finaltotal'+Id).val();
            var itemBill= $('#itemBill'+Id).val();
            $(this).parents('tr').remove();
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
            deleteId (Id,itemBill);

        });
        function deleteId (id,itemBill) {
            // $(this).parent()/*.children('#remove-id-if-user'+id)*/.remove();
            $(this).closest("tr").remove()
            var request = $.ajax({
                url: "deleteRow.php",
                type: "POST",
                data: { "deleteId":id,"itemBill":itemBill},
                dataType: "html"
            });

            request.done(function(msg) {
            });



            request.fail(function(jqXHR, textStatus) {
                alert( "Request failed: " + textStatus );
            });
        }
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
                  var wrapper = $("#create-1"); //Fields wrapper
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
                      $(wrapper).append('<div id="remove-id-if-user'+FieldCount+'"><input type="text" id="proName'+FieldCount+'"  class="form-control" style="margin: 1px 2px;width: 110px;"size="15%" name="productname11[]"   />&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="HSNNo'+FieldCount+'"  class="form-control" style="width: 62px;margin: 0px 13px;" name="HSNNo1[]"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="quantity'+FieldCount+'" class="form-control" style="margin-top: 8px;width: 7%;    margin: 1px 17px;" onblur="accordingQtyCalulate(this.id)" name="quantity-1[]"  data-id='+FieldCount+' />&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="unitpric'+FieldCount+'"  class="form-control" onblur="accordingQtyCalulate(this.id)" style="width: 84px;margin:     margin: 1px 4px;" name="unitprice-11[]"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="total'+FieldCount+'"  class="form-control" style="margin-top: 8px;width: 8%;margin: 0px 21px;" onblur="//findTotal(this.id,x)" name="total1[]" readonly/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="offerPercent'+FieldCount+'" class="form-control" style="margin-top: 8px;width: 8%;    margin: 1px 7px;"  name="offerPercent1[]" readonly/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="discount_price'+FieldCount+'" class="form-control" style="margin-top: 8px;width: 8%;    margin: 1px 29px;"  name="discount_price1[]" readonly>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="finaltotal'+FieldCount+'" class="form-control" style="margin-top: 6px;width: 7%;    margin: -13px -8px;"  name="finaltotal1[]" readonly />&nbsp;&nbsp;&nbsp;&nbsp;<input type="hidden" id="offerval'+FieldCount+'" class="form-control" style="margin-top: 8px;width: 6%;"  name="offeridval1[]" readonly ><input id="projectSocietySelect" type="hidden" placeholder="Name Of Project/Society" name="insert-id" class="form-control"><a href="javascript:void(0);" class="remCF" id='+FieldCount+' style="position: absolute;color: red;padding: 5px 4px;font-size: 20px;    margin: -6px 90px;"><input type="hidden" class="form-control" name="insert-id" value="insert"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>'); //add input box

                  }
                  $(wrapper).insertAfter('#create');
                  // }
                  $('#proName'+FieldCount).val(proName);
                  $('#unitpric'+FieldCount).val(response1[0].price);
                  $('#HSNNo'+FieldCount).val(response1[0].hsncode);
                  // $('#gstName'+FieldCount).val(response1[0].taxName);
                  //$('#taxper'+FieldCount).val(response1[0].taxPercent);

                  var validoffer= responseOffer1[0].validDate
                  if(today<=validoffer) {
                      $('#offerPercent'+FieldCount).val(responseOffer1[0].offerPercent);
                      $('#offerval'+FieldCount).val(responseOffer1[0].offerid);
                  }else{
                      $('#offerPercent' + FieldCount).val(0);
                      $('#offerval'+FieldCount).val(responseOffer1[0].offerid);
                  }

              },
              error: function (req, status, error) {
              }
          });


      }
    function accordingQtyCalulate(str) {
        var res = str.substr(8, 8);
        var amtunitprice= $('#unitpric'+res).val()
        var amtquantity1= $('#quantity'+res).val()
        var amtTotal= $('#total'+res).val()
        var offerPercent= $('#offerPercent'+res).val()
        var discount_price= $('#discount_price'+res).val()
        var finaltotal= $('#finaltotal'+res).val()
        var prevBal = document.getElementById('txt_samt').value;
        var prevBal1 = document.getElementById('txt_gamt').value

        var storeBal = prevBal - finaltotal
        var storeBal1 = prevBal1 - finaltotal
        var tot=amtunitprice * amtquantity1;
        var amtTotal2=(tot*offerPercent)/100;
        var caluwithGstamt= (tot * discount_price)/100;
        var finalaMt=parseFloat(tot)+parseFloat(amtTotal2)+ parseFloat(caluwithGstamt)
        $('#finaltotal'+res).val(finalaMt);
        $('#total'+res).val(tot);
        var amtTotal1=$('#finaltotal'+res).val();
        var storeBalFirst=parseFloat(storeBal)+parseFloat(amtTotal1);
        var storeBalSecond=parseFloat(storeBal1)+parseFloat(amtTotal1);
        document.getElementById('txt_samt').value=storeBalFirst;
        document.getElementById('txt_gamt').value=storeBalSecond;
        var totasd = Math.round(storeBalSecond)
        document.getElementById('txt_gamt22').value = totasd;
        var gprint = 'txt_gamt22';
        var printdata = convertNumberToWords(totasd);
        document.getElementById('words').innerHTML = printdata + ' ' + ' Rupees Only';
        $('#words-id').val(printdata + ' ' + ' Rupees Only');
        $('#update').val('update');
    }
    /*
    function accordingUnitPriceCalulate() {
        var res = str.substring(9,8);
        var amtunitprice= $('#unitprice'+res).val()
        var amtquantity1= $('#quantity'+res).val()
        var amtTotal= $('#total'+res).val()
        var offerPercent= $('#offerPercent'+res).val()
        var discount_price= $('#discount_price'+res).val()
        var finaltotal= $('#finaltotal'+res).val()
        var prevBal = document.getElementById('txt_samt').value;
        var prevBal1 = document.getElementById('txt_gamt').value

        var storeBal = prevBal - finaltotal
        var storeBal1 = prevBal1 - finaltotal
        var tot=amtunitprice * amtquantity1;
        var amtTotal2=(tot*offerPercent)/100;
        var caluwithGstamt= (tot * discount_price)/100;
        var finalaMt=parseFloat(tot)+parseFloat(amtTotal2)+ parseFloat(caluwithGstamt)
        $('#finaltotal'+res).val(finalaMt);
        var amtTotal1=$('#finaltotal'+res).val();
        var storeBalFirst=parseFloat(storeBal)+parseFloat(amtTotal1);
        var storeBalSecond=parseFloat(storeBal1)+parseFloat(amtTotal1);
        document.getElementById('txt_samt').value=storeBalFirst;
        document.getElementById('txt_gamt').value=storeBalSecond;
        var totasd = Math.round(storeBalSecond)
        document.getElementById('txt_gamt22').value = totasd;
        var gprint = 'txt_gamt22';
        var printdata = convertNumberToWords(totasd);
        document.getElementById('words').innerHTML = printdata + ' ' + ' Rupees Only';
        $('#words-id').val(printdata + ' ' + ' Rupees Only');

    }
    */

</script>
<style>
    body {
        position: relative;
        width: 25cm;
    }
</style>
<body>
<a href="invoiceHistory.php" class="btn btn-success" style="border-left:none;border-right:none;border-top:none;border-bottom: none;margin: 31px -230px;
    float: left;
    font-size: 20px;
    color: #529e52"><i class="fa fa-arrow-left" aria-hidden="true"></i>BACK</a>
<legend name="legend" id="legend" style="    width: 118%;
    MARGIN: 0PX -131PX;">
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
       top: -18px;
    left: -179px;
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
        <?php /*if (!isset($_POST['submit_val-1'])) { */?>

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

-->
                    <!--
                  <!--        <div><button class="button" id="add_button" style="margin: 23px 1px;float:right" name="addpickpointName[]">Add(+)</button></div>-->

                    <!--<div>
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
                        </div>-->
                    <div id="create" style="float: left; width: 107%;"></div>

                    <br/>
                    <br/>
                    <br/>
                <div id="create-1" style="float: left; width: 107%;"></div>
                <br/>
                <br/>
                <br/>

                    <!--<div style="float: left;width: 70%;margin: 21px 9px;">
                        <div style="float: left;width: 50%;">
                            <b style="float: left;margin: 3px 27px;">Mode Of Payment</b>
                            <select name="modeOfPayment" style="width: 184px;padding: 9px 1px 6px;margin: -6px 168px;float: left;" onchange="displayidchequeon(this.value)">
                                <option value="cash">Cash</option>
                                <option value="cheque">Cheque</option>
                                <option value="online">Online</option>
                                <option value="finance">Finance</option>
                                <!-- <option value="audi">Audi</option>-->
                           <!-- </select>
                            <div id="cash"> <input type="text" name="cashid" id="cheque1" style="margin: 13px 168px;
    width: 180px;
    float: left;
    padding: 0px 0px 13px;" placeholder="description">
                            </div>-->

                           <!-- <div id="online"> <input type="text" name="onlineid" id="cheque1" style="margin: 13px 168px;
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

                        </div> <div id="cheque"> <input type="text" name="chequeid" id="onlineCashCheque" style="margin: 13px 168px;
    width: 180px;
    float: left;
    padding: 0px 0px 13px;" placeholder="fill  Cheque And Bank Name Details">

                </div>

                        <div style="float: left;width: 59%;padding: 8px 3px;"> <b style="float: left;margin: 7px 27px;">Remaining Balance</b><input type="text" name="remeingBal" id="remeingBal" onkeyup="//remeningCalculate()" style="padding: 6px;"/>
                        </div>

                    </div>-->
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
                        <input type="text" name="txt_gamt1" id="txt_gamt" style="border-left:none;border-right:none;border-top:none;float: left;
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
                    <input type="submit" name="submit_val-1" id="submit_val"  value="Save & Print" class="button1" style="margin-left: 40%;width: 18%;">


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
<?php /*} */?>
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
    /* $('form').submit(function(e) {
         e.preventDefault();
         var postdata = $(this).serializeArray();
         alert(postdata)
     });*/
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

        var pId = str.substr(8, 4);
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
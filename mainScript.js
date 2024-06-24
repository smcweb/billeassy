function taxUpdateInput(id) {
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: 'getTaxUP.php',
        async: false,
        data: {"id": id},
        success: function (response) {

            $('#addCGST').val(response[0].taxPercent)
            $('#addSGST').val(response[0].taxPercents)

        },
        error: function (req, status, error) {
        }
    });
}
/*$('.remCF').click(function() {
    var Id = $(this).attr('id');
    alert(Id)
});*/

$("#withoutTax-id-1").on('click','.remCF',function(){
    var Id = $(this).attr('id');

    var res = confirm('Are you sure you want to removed this item?');
    if(!res) {
        return false;
    }
    var amtTotalgst= $('#total'+Id).val();
    $(this).parent().parent().parent().children('#remove-id-if-user'+Id).remove();
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

$( document ).ready(function() {


    $("#addWithoutMrpTax").keypress(function(event){
        var ew = event.which;
        if (ew  == 46) {
            $("#bar-id").hide();
            return true;
        }
        if(48 <= ew && ew <= 57){
            $("#bar-id").hide();
            return true;
        }
else {
            $("#bar-id").show();
            $("#bar-id").html("only Number are allowed");
            return false;
        }
    });
    $("#addWithMrpTax").keypress(function(event){
        var ew = event.which;
        if (ew  == 46) {
            $("#bar-id").hide();
            return true;
        }
        if(48 <= ew && ew <= 57){
            $("#bar-id").hide();
            return true;
        }

else{
            $("#bar-id").show();
            $("#bar-id").html("only Number are allowed");
            return false;
        }

    });

});
function calculateWithoutGst() {
    var selecttax=  $('#tax').val()
    if(selecttax=='No'){

        alert('Please Select TaX')
        return
    }
    var addCGST=  $('#addCGST').val()
    var addSGST= $('#addSGST').val()
    var addprice= $('#addWithoutMrpTax').val()
if(addprice==''){

    alert('only Number are allowed')
        return
}
    var withaddCGST = (addprice * addCGST) / 100;
    var withaddSGST = (addprice * addSGST) / 100;
    var withMRPTAX = (parseFloat(withaddCGST)) + (parseFloat(withaddSGST)) + (parseFloat(addprice))

    $('#addWithMrpTax').val(withMRPTAX)


}
function calculateWIthGst() {
    var selecttax=  $('#tax').val()
    if(selecttax=='No'){

        alert('Please Select TaX')
        return
    }
    var addCGST=  $('#addCGST').val()
    var addSGST= $('#addSGST').val()
    var addWithMrpTax= $('#addWithMrpTax').val()
    if(addWithMrpTax==''){
        alert('only Number are allowed')
        return
    }
        var withaddCGST = (addWithMrpTax * addCGST) / 100;
        var withaddSGST = (addWithMrpTax * addSGST) / 100;
   var tax= (parseFloat(withaddCGST)) + (parseFloat(withaddSGST))
        var withMRPTAX = (parseFloat(addWithMrpTax))-(parseFloat(tax));
    $('#addWithoutMrpTax').val(withMRPTAX)


}
function restValue() {
    $('#addWithoutMrpTax').val('')
    $('#addWithMrpTax').val('')
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
function convertNumberToWords(amount) {
    //alert(amount)
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
function giveData() {
    var custNameAndId = document.getElementById('cname').value;

    var strURL = "numberWiseData.php?custNameAndId=" + custNameAndId;

    var req = getXMLHTTP();
    if (req) {
        req.onreadystatechange = function () {
            if (req.readyState == 4) {
                if (req.status == 200) {

                    document.getElementById('txt_customername').innerHTML = req.responseText;

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

$(document).ready(function(){
    $("#cname").keyup(function(){
        $.ajax({
            type: "POST",
            url: "readuserDetails.php",
            data:'keyword='+$(this).val(),
            beforeSend: function(){
                $("#cname").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
            },
            success: function(data){
                $("#suggesstion-box").show();
                $("#suggesstion-box").html(data);
                $("#cname").css("background","#FFF");

            }
        });
    });
});
function selectCountry(val) {
    $("#cname").val(val);
    $("#suggesstion-box").hide();
    getDataNumberWise();
}

function getDataNumberWise() {
    var number1= document.getElementById('cname').value ;
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: 'numberWiseData.php',
        async: false,
        data: {"number": number1},
        success: function (response) {

            if(response){
                $('#tata23').show();
                $('#number').val(response[0].phonenumber);
                $('#cname').val(number1);
                $('#addr').val(response[0].address);
                $('#email').val(response[0].email);
                $('#txt_balance').val(response[0].balanceAmt);
                $('#state').val(response[0].states);
                $('#GSTNo').val(response[0].gst);
                $('#stCode').val(response[0].statesCode);
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
function mrpCalculatePrice(strId) {
    var pId = strId.substr(5, 4);
    var  mrp= $('#unitp'+pId).val();
    var  cgst= $('#cgst'+pId).val();
    var  sgst= $('#sgst'+pId).val();
    var cgstTotal=(mrp*cgst)/100;
    var sgstTotal=(mrp*sgst)/100;
    var toalCgstSgts=parseFloat(cgstTotal) + parseFloat(cgstTotal) +  parseFloat(mrp)
     $('#unitpwith'+pId).val(toalCgstSgts);

}
function mrpWithTaxCalculatePrice(strId) {
    var pId = strId.substr(9, 3);
    var  mrpWithTax= $('#unitpwith'+pId).val();
    var  cgst= $('#cgst'+pId).val();
    var  sgst= $('#sgst'+pId).val();
    var cgstTotal=(mrpWithTax*cgst)/100;
    var sgstTotal=(mrpWithTax*sgst)/100;
    var toalCgstSgts=parseFloat(cgstTotal) + parseFloat(cgstTotal) +  parseFloat(mrpWithTax)
     $('#unitp'+pId).val(toalCgstSgts);

}
function calculateOffer(str) {
    var pId  = str.substr(9, 4);
    var  unitPrice= $('#unitp'+pId).val();
    var totalqty=  $('#qtyUp'+pId).val();
    if(!totalqty){
        alert('Please Enter Quantity')
        return;
    }
    var unitpwithTAXMRP=  $('#unitpwith'+pId).val();
    var cgstper= $('#cgst'+pId).val();
    var sgstper= $('#sgst'+pId).val();
    //var gstper= $('#taxper'+pId).val();
    var offerper= $('#offerName'+pId).val();
    //var amtTotal1=unitPrice * totalqty
    var totad = $('#total' + pId).val();
    var prevBal = document.getElementById('txt_samt').value;
    var prevBal1 = document.getElementById('txt_gamt').value
    var storeBal = prevBal - totad
    var storeBal1 = prevBal1 - totad
    if(offerper > 0){
        var amtTAXOffer=unitpwithTAXMRP * totalqty
        var amtTotalout=unitPrice * totalqty
        var offerAmt=((amtTAXOffer*offerper)/100);
        var amtTotal=(amtTAXOffer - offerAmt).toFixed(2);
        $('#discountPrice'+pId).val(offerAmt);
        $('#nod-Total'+pId).val(amtTotalout);
        var amtTotalgst= $('#discountPrice'+pId).val();
        var amtTotalgst= $('#total'+pId).val();
        var amtTotalGstamt=amtTotal
        $('#total'+pId).val(amtTotalGstamt);
        var caluwithCgstperAmt= ((amtTotalout * cgstper)/100).toFixed(2);
        var caluwithSgstperAmt= ((amtTotalout * sgstper)/100).toFixed(2);
        $('#totlgstcgst'+pId).val(amtTAXOffer);
        $('#cgsttotal'+pId).val(caluwithCgstperAmt);
        $('#sgstTotal'+pId).val(caluwithSgstperAmt);
    }else{
        var amtTotal=unitPrice * totalqty
        var amtWithTAXMRP=unitpwithTAXMRP * totalqty
        $('#totlgstcgst'+pId).val(amtWithTAXMRP);
        $('#discountPrice'+pId).val(0);
        $('#nod-Total'+pId).val(amtTotal);
        var amtTotalgst= $('#discountPrice'+pId).val();
        var amtTotalgst= $('#total'+pId).val();
        var caluwithCgstperAmt= ((amtTotal * cgstper)/100).toFixed(2);
        var caluwithSgstperAmt= ((amtTotal * sgstper)/100).toFixed(2);
        var amtTotalGstamt=$('#totlgstcgst'+pId).val();
        $('#cgsttotal'+pId).val(caluwithCgstperAmt);
        $('#sgstTotal'+pId).val(caluwithSgstperAmt);
        $('#total'+pId).val(amtTotalGstamt);
    }
    var sutota1 =parseFloat((storeBal)) + (parseFloat(amtTotalGstamt));
    var sutota12 =parseFloat((storeBal)) + (parseFloat(amtTotalGstamt));
    document.getElementById('txt_samt').value = sutota1;
    document.getElementById('txt_gamt').value = sutota12;
    var totasd=Math.round(sutota12)
    document.getElementById('txt_gamt22').value = totasd;
    var gprint = 'txt_gamt22';
    var printdata =  convertNumberToWords(totasd)
    document.getElementById('words').innerHTML = printdata + ' ' + ' Rupees Only';
    $('#words-id').val(printdata + ' ' + ' Rupees Only');
}function calculateCGSTSGST(str) {
    var pId  = str.substr(4, 4);
    var  unitPrice= $('#unitp'+pId).val();
    var totalqty=  $('#qtyUp'+pId).val();
    if(!totalqty){
        alert('Please Enter Quantity')
        return;
    }
    var unitpwithTAXMRP=  $('#unitpwith'+pId).val();
    var cgstper= $('#cgst'+pId).val();
    var sgstper= $('#sgst'+pId).val();
    //var gstper= $('#taxper'+pId).val();
    var offerper= $('#offerName'+pId).val();
    //var amtTotal1=unitPrice * totalqty
    var totad = $('#total' + pId).val();
    var prevBal = document.getElementById('txt_samt').value;
    var prevBal1 = document.getElementById('txt_gamt').value
    var storeBal = prevBal - totad
    var storeBal1 = prevBal1 - totad
    if(offerper > 0){
        var amtTAXOffer=unitpwithTAXMRP * totalqty
        var amtTotalout=unitPrice * totalqty
        var offerAmt=((amtTAXOffer*offerper)/100);
        var amtTotal=(amtTAXOffer - offerAmt).toFixed(2);
        $('#discountPrice'+pId).val(offerAmt);
        $('#nod-Total'+pId).val(amtTotalout);
        var amtTotalgst= $('#discountPrice'+pId).val();
        var amtTotalgst= $('#total'+pId).val();
        var amtTotalGstamt=amtTotal
        $('#total'+pId).val(amtTotalGstamt);
        var caluwithCgstperAmt= ((amtTotalout * cgstper)/100).toFixed(2);
        var caluwithSgstperAmt= ((amtTotalout * sgstper)/100).toFixed(2);
        $('#totlgstcgst'+pId).val(amtTAXOffer);
        $('#cgsttotal'+pId).val(caluwithCgstperAmt);
        $('#sgstTotal'+pId).val(caluwithSgstperAmt);
    }else{
        var amtTotal=unitPrice * totalqty
        var amtWithTAXMRP=unitpwithTAXMRP * totalqty
        $('#totlgstcgst'+pId).val(amtWithTAXMRP);
        $('#discountPrice'+pId).val(0);
        $('#nod-Total'+pId).val(amtTotal);
        var amtTotalgst= $('#discountPrice'+pId).val();
        var amtTotalgst= $('#total'+pId).val();
        var caluwithCgstperAmt= ((amtTotal * cgstper)/100).toFixed(2);
        var caluwithSgstperAmt= ((amtTotal * sgstper)/100).toFixed(2);
        var amtTotalGstamt=$('#totlgstcgst'+pId).val();
        $('#cgsttotal'+pId).val(caluwithCgstperAmt);
        $('#sgstTotal'+pId).val(caluwithSgstperAmt);
        $('#total'+pId).val(amtTotalGstamt);
    }
    var sutota1 =parseFloat((storeBal)) + (parseFloat(amtTotalGstamt));
    var sutota12 =parseFloat((storeBal)) + (parseFloat(amtTotalGstamt));
    document.getElementById('txt_samt').value = sutota1;
    document.getElementById('txt_gamt').value = sutota12;
    var totasd=Math.round(sutota12)
    document.getElementById('txt_gamt22').value = totasd;
    var gprint = 'txt_gamt22';
    var printdata =  convertNumberToWords(totasd)
    document.getElementById('words').innerHTML = printdata + ' ' + ' Rupees Only';
    $('#words-id').val(printdata + ' ' + ' Rupees Only');
}
function calcuOfferAmt(str) {
    var pId = str.substr(9, 4);
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
    var sutota12 = parseFloat((storeBal)) + parseFloat((amtTotalGstamt));
    document.getElementById('txt_samt').value = sutota1;
    document.getElementById('txt_gamt').value = sutota12;
    var totasd=Math.round(sutota12)
    document.getElementById('txt_gamt22').value = totasd;
    var gprint = 'txt_gamt22';
    var printdata =  convertNumberToWords(totasd)
    document.getElementById('words').innerHTML = printdata + ' ' + ' Rupees Only';
    $('#words-id').val(printdata + ' ' + ' Rupees Only');
}

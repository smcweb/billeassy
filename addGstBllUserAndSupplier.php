<?php

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
$shopid =$_SESSION['shopidu'];
?>
<?php
include_once "config.php";
if(isset($_POST['Submit']))
{

//include "config.php";
$gtid= $_POST['tid'];
$gsname= $_POST['sname'];
$gcNumber= $_POST['cNumber'];
$gaddname= $_POST['addname'];
$grandTotal= $_POST['grandTotal'];
$gtpercent= $_POST['tpercent'];
$gtsgstname= $_POST['tsgstname'];
$gtsgstpercente= $_POST['tsgstpercent'];
$gtname= $_POST['tname'];
$gsubject_id= $_POST['subject-id'];
    if(isset($_FILES["gimageid"])) {
        $file = $_FILES['gimageid']['tmp_name'];
        $image = addslashes(file_get_contents($_FILES['gimageid']['tmp_name']));
        $image_name = addslashes($_FILES['gimageid']['name']);
        $image_size = getimagesize($_FILES['gimageid']['tmp_name']);


        if ($image_size == FALSE) {

            echo "That's not an image!";

        } else {

            move_uploaded_file($_FILES["gimageid"]["tmp_name"], "img/" . $_FILES["gimageid"]["name"]);

            $location = $_FILES["gimageid"]["name"];
        }


        $query = "INSERT INTO `supplierpurchase`(poNo,`supplierName`, `supplierNo`, `supplierAdd`, `grandTotal`, `cgst`, `sgst`, `igst`, `billimage`,status,`decProduct` ,`subject`)
 VALUES ('$gtid','$gsname','$gcNumber','$gaddname','$grandTotal','$gtpercent','$gtsgstname','$gtsgstpercente','$location','sTranj','$gtname','$gsubject_id')";
        $record = mysqli_query($conn, $query);
        $last_row = mysqli_insert_id($conn);
        if($record){
            echo "<script>alert('Recorder Upload Successfully')</script>";
        }
    }else{
        echo "<script>alert('Recorder Not Upload Successfully')</script>";
    }

}
if(isset($_POST['update']))
{
    $Taxname=$_REQUEST['tname'];
    $Taxpercent=$_REQUEST['tpercent'];
    $Tid=$_REQUEST['tid'];
    /*$tsgstname=$_REQUEST['tsgstname'];*/
    $tsgstpercent=$_REQUEST['tsgstpercent'];
    //$shopid=$_REQUEST['shopid'];

    if (empty($_POST["tname"])) {
        echo "<script> alert('Taxname is required');</script>";

    }
    /*if (empty($_POST["tsgstname"])) {
        echo "<script> alert('Taxname is required');</script>";

    }*/

    elseif (empty($_POST["tpercent"])) {
        echo "<script> alert('Taxpercent  is required');</script>";

    }
    elseif (empty($_POST["tsgstpercent"])) {
        echo "<script> alert('Taxpercent  is required');</script>";

    }
    elseif($Taxpercent<=0)
    {
        echo "<script> alert('Please enter percent greater than zero');</script>";
    }

    else
    {

        $sql1 ="UPDATE tbltax SET taxPercent='$Taxpercent',taxName='$Taxname' ,taxPercents='$tsgstpercent'  WHERE taxid='$Tid' AND shopid='$shopid'";

        $result1 = mysqli_query($conn, $sql1);

        if ($result1)
        {
            echo "<script>alert('Tax is updated');</script>";
            echo '<script> window.location.href = "tax.php";</script>';
        }
        else
        {
            echo "<script>alert('Tax is not updated');</script>";

            echo '<script> window.location.href = "tax.php";</script>';
        }

    }

}

?>
<!DOCTYPE HTML>
<html>
<head>
    <title>EasyBilling| Tax:: Billing</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="keywords" content="Modern Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <!-- Graph CSS -->
    <link href="css/lines.css" rel='stylesheet' type='text/css' />
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
    <script>
        function rowshow(id)
        {

            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: 'getTaxupdate.php',
                async: false,
                data: {"id": id},
                success: function (response) {
                    $('#tid').val(id)
                    $('#tname').val(response[0].taxName)
                    $('#tpercent').val(response[0].taxPercent)
                    $('#tsgstname').val(response[0].taxNames)
                    $('#tsgstpercent').val(response[0].taxPercents)

                },
                error: function (req, status, error) {
                }
            });
        }
    </script>


</head>
<body>
<div id="wrapper">
    <!-- Navigation -->
    <?php
    include_once "header.php" ?>
    <!-- Navigation -->
    <div id="page-wrapper">

        <?php
        include_once "top.php"
        ?>
        <?php
        $maxval=mysqli_query($conn,"SELECT MAX(`intId`) AS Maxid FROM `supplierpurchase` ");
        while($row=mysqli_fetch_array($maxval))
        {
            $max=$row['Maxid'];
        }
        $max=$max+1;
        ?>
        <div class="content_bottom">
            <div class="col-md-12 span_3">
                <div class="col-md-6 stats-info">
                    <div class="panel-heading">

                    </div>
                    <div class="panel-body">

                        <form method="POST" action="" enctype="multipart/form-data">
                           <div class="form-group ">
                            <label  style="width: 90%;color:black" for="inputSuccess1">PO No</label>
                            <input type="text" class="form-control1" id="tid" name="tid" value="<?php echo $max; ?>">
                           <!-- <input type="hidden" class="form-control1" id="tid" name="tid" value="<?php /*echo $max; */?>">-->
                             </div>
                            <h4 class="panel-title">Supplier Information</h4>
                            <div class="form-group ">

                                <input type="text" class="form-control1" id="sname" name="sname" placeholder="Supplier Name ">
                            </div>
                            <div class="form-group ">

                                <input type="text" class="form-control1" id="cNumber" name="cNumber" placeholder="contact Number ">
                            </div>
                            <div class="form-group ">

                                <input type="text" class="form-control1" id="addname" name="addname" placeholder="Supplier Address">
                            </div>


                    </div>
                </div>
                <div class="col-md-6 stats-info">
                    <div class="panel-heading">

                    </div>
                    <div class="panel-body">


                            <div class="form-group ">
                         <label  style="width: 90%;color:black" for="inputSuccess1">Subject Name</label>
                        <input type="text" class="form-control1" id="subject-id" name="subject-id" placeholder="Subject Name">
                            <input type="hidden" class="form-control1" id="tid" name="tid" value="<?php echo $max; ?>">
                         </div>
                        <h4 class="panel-title">Product Information</h4>
                            <div class="form-group ">
                                <textarea rows="4" cols="50" class="form-control1" id="tname" name="tname" placeholder="Description" style="height: 168px;"></textarea>

                            </div>
                            <!--<div class="form-group ">
                                <label style="width: 90%;color:black" for="inputWarning1">Tax Percent CGST</label>
                                <input type="text" class="form-control1" id="tpercent" name="tpercent">
                            </div>-->
                            <!-- <div class="form-group ">
                                 <label  style="width: 90%;color:black" for="inputSuccess1">Tax Name SGST</label>
                                 <input type="text" class="form-control1" id="tsgstname" name="tsgstname" value="SGST">
                             </div>-->
                           <!-- <div class="form-group ">
                                <label style="width: 90%;color:black" for="inputWarning1">Tax Percent SGST</label>
                                <input type="text" class="form-control1" id="tsgstpercent" name="tsgstpercent">
                            </div>-->

                    </div>
                </div>

            <div class="col-md-6 stats-info">
                    <div class="panel-body">


                            <!--<div class="form-group ">-->
                            <!-- <label  style="width: 90%;color:black" for="inputSuccess1">Tax Id</label>-->
                            <input type="hidden" class="form-control1" id="tid" name="tid" value="<?php echo $max; ?>">
                            <!-- </div>-->
                            <div class="form-group ">
                                <label  style="width: 90%;color:black" for="inputSuccess1">Grand Total </label>
                                <input type="number" class="form-control1" id="grandTotal" name="grandTotal" placeholder="Grand Total ">
                                <input type="hidden" class="form-control1" id="tidgrandTotal" name="tidgrandTotal">

                            </div>
                            <div class="form-group ">
                                <label style="width: 90%;color:black" for="inputWarning1">CGST</label>
                                <input type="number" class="form-control1" id="tpercent" name="tpercent" onblur="//calculateCGst()">
                            </div>
                           <div class="form-group ">
                                 <label  style="width: 90%;color:black" for="inputSuccess1"> SGST</label>
                                 <input type="number" class="form-control1" id="tsgstname" name="tsgstname" value="SGST" onblur="///calculateSGst()">
                             </div>
                            <div class="form-group ">
                                <label style="width: 90%;color:black" for="inputWarning1">IGST</label>
                                <input type="number" class="form-control1" id="tsgstpercent" name="tsgstpercent" onblur="//calculateIGst()">
                            </div>
                            <input type="submit" class="btn btn-success" name="Submit" value="Add" id="Submit-id">
                            <input type="submit" name="update" class="btn btn-warning" value="Update" style="margin-left:5%">

                    </div>
                </div><div class="col-md-6 stats-info">
                    <div class="panel-body">


                            <div>
                                <label>Upload Image File:</label>
                                <input type="file"   onchange="showMyImage(this)"  id="image-id" name="gimageid">
                                <br/>
                                <img id="thumbnil" style="width: 100%;margin-top: 36px;height: 83%;"  src="" alt="Upload Image"/>
                            </div>

                    </div>
                </div>
            </form>
            </div>
            </div>



            <div class="clearfix"> </div>
        </div>
    </div>

</div>
<!-- footer -->
<?php
include_once "footer.php" ?>
<!-- footer -->
</div>
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
    $('.confirmation').on('click', function () {
        return confirm(' If you delete tax then all product belongs to this tax will be deleted');
    });
</script>
<script type="text/javascript">
    /*function calculateIGst() {
        var grandTotal = $('#grandTotal').val();
        var gtsgstpercent = $('#tsgstpercent').val();
            var caluwithGstamtIGst = (grandTotal * gtsgstpercent) / 100;
            $('#tsgstpercent').val(caluwithGstamtIGst);
            // $('#tidgrandTotal').val(grandTotal);
        }



    function calculateCGst() {
        var grandTotal = $('#grandTotal').val();
        var tidgrandTotal = $('#tidgrandTotal').val();
        var gtpercent = $('#tpercent').val();
        var caluwithGstamtCGst = (grandTotal * gtpercent) / 100;
        $('#tpercent').val(caluwithGstamtCGst);

    }
    function calculateSGst() {
        var grandTotal = $('#grandTotal').val();
        var gtsgstname = $('#tsgstname').val();
            var caluwithGstamtSGst = (grandTotal * gtsgstname) / 100;
            $('#tsgstname').val(caluwithGstamtSGst);
             $('#tidgrandTotal').val(grandTotal);
        }


*/
    /*$('#Submit-id').click(function() {
        alert('insertDataGet')
        insertDataGet()
    });
    function insertDataGet() {
        var gtid = $('#tid').val();
        var grandTotal = $('#grandTotal').val();
        var gsname = $('#sname').val();
        var gcNumber = $('#cNumber').val();
        var gaddname= $('#addname').val();
        var gsubject_id = $('#subject-id').val();
        var gtname = $('#tname').val();
        var gimageid = $('#image-id').val();
        alert(gimageid)
        //var gimageid = $('#grandTotal').val();
        var gtpercent = $('#tpercent').val();
        var gtsgstname = $('#tsgstname').val();
        var gtsgstpercent = $('#tsgstpercent').val();

        $.ajax({

            url : 'insertSupplierPurchaseData.php',
            type : 'Post',
            data : {'gtid' : gtid,"gsname":gsname,"gcNumber":gcNumber,"gaddname":gaddname,"grandTotal":grandTotal,"gtpercent":gtpercent,"gtsgstname":gtsgstname,"gtsgstpercent":gtsgstpercent,"gimageid":gimageid,"gtname":gtname,"gsubject_id":gsubject_id},
            dataType:'json',
            success : function(data) {
                alert('Data: '+data);
            },
            error : function(request,error)
            {
                alert("Request: "+JSON.stringify(request));
            }
        });
    }*/
    function showMyImage(fileInput) {
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var imageType = /image/;
            if (!file.type.match(imageType)) {
                continue;
            }
            var img=document.getElementById("thumbnil");
            img.file = file;
            var reader = new FileReader();
            reader.onload = (function(aImg) {
                return function(e) {
                    aImg.src = e.target.result;
                };
            })(img);
            reader.readAsDataURL(file);
        }
    }

</script>
</body>
</html>

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
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
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>EasyBilling| Sales Report :: Billing</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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

    <!--	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>-->
    <script>
        $(function() {
            $("#txtdate-id").datepicker({
                minDate: 0,
                dateFormat: 'yy-mm-dd'
            });
        });

    </script>


</head>
<body>
<div id="wrapper">
    <!-- Navigation -->
    <?php
    include_once "header.php"
    ?>

    <div id="page-wrapper">
        <?php
        include_once "top.php"
        ?>


        <div class="content_bottom">
            <div class="col-md-8 span_3">
                <a href="exportToPurchase.php" class="btn btn-info" role="button">Export To Excel</a>
                <div class="panel-heading">
                    <h4 class="panel-title">Sales Report</h4>
                </div>
                <div class="bs-example1" data-example-id="contextual-table">
                    <table class="table">
                        <thead>
                        <tr>
                            <th style="color:black;text-align:center">Sr.</th>
                            <th style="color:black;text-align:center">PO No.</th>
                            <th style="color:black;text-align:center">Supplier Name</th>
                            <th style="color:black;text-align:center">Supplier Mobile</th>
                            <th style="color:black;text-align:center">CGST</th>
                            <th style="color:black;text-align:center">SGST</th>
                            <th style="color:black;text-align:center">IGST</th>
                            <th style="color:black;text-align:center">Grand Total</th>
                            <th style="color:black;text-align:center">Bill Image</th>
                            <th style="color:black;text-align:center">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="active">
                            <form class="navbar-form navbar-right" method="post">
                                <div class="input-group">
                                    <input  class="form-control1 input-search" type="text"  id="sreach" placeholder="Search By Name & Mobile No." name="search">
                                    <a href=""><button class="btn btn-success" type="submit" name="Submit"><i class="fa fa-search"></i></button></a>
                                </div>

                                <!-- <div class="input-group">
                                     <input  class="form-control1" id="txtdate"  type="date"  name="txtdate">
                                     <a href=""><button class="btn btn-success" type="submit" name="datesearch"><i class="fa fa-search"></i></button></a>
                                 </div>-->

                            </form></tr>
                        <?php
                        if(isset($_POST['Submit']))
                        {

                            $search=$_POST['search'];
                            $query="";
                            $sql = "SELECT * FROM `supplierpurchase` WHERE supplierName ='$search' OR supplierNo='$search' AND  `shopid`='$shopid'";
                            $query = mysqli_query($conn,$sql);
                            $sr=0;

                        }
                        /*elseif(isset($_POST['datesearch']))
                        {
                            $sea1=$_POST['txtdate'];
                            //$query="";
                            $sql = "SELECT * FROM `supplierpurchase` WHERE  `shopid`=$shopid";
                            $query = mysqli_query($conn,$sql);
                        }*/
                        else{
                            $todate=date('Y-m-d');
                            $query="";
                            $sql="SELECT * FROM `supplierpurchase` WHERE  `shopid`='$shopid'";

                            $query=mysqli_query($conn,$sql);
                            $sr=0;
                        }
                        while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
                        {
                            $sr++;
                            $npoNo=$row['poNo'];
                            $name=$row['supplierName'];
                            //$billno=$row['billno'];
                            $phonenumber=$row['supplierNo'];
                            $amt=$row['grandTotal'];
                            $amtcgst=$row['cgst'];
                            $amtsgst=$row['sgst'];
                            $amtigst=$row['igst'];
                            $billimageigst=$row['billimage'];
                            $bistatus=$row['status'];

                            //$tdate=$row['tdate'];

                            ?>
                            <tr>
                                <th scope="row"><?php echo $sr; ?></th>
                                <th scope="row"><?php echo $npoNo; ?></th>
                                <!--<td><?php /*if(isset($tdate)){ echo $tdate;} */?></td>-->
                                <td contenteditable="true" onblur="updateSuppDeatils(this,'supplierName',<?php echo $row['intId']; ?>)"><?php echo $name; ?></td>
                                <td contenteditable="true"><?php echo $phonenumber; ?></td>
                                <td contenteditable="true"><?php echo $amtcgst; ?></td>
                                <td contenteditable="true"><?php echo $amtsgst; ?></td>
                                <td contenteditable="true"><?php echo $amtigst; ?></td>
                                <td contenteditable="true"><?php echo $amt; ?></td>
                                <td class="transition"><img src="img/<?php echo $billimageigst; ?>" alt="Smiley face" height="42" width="42" class="image"></td>
                                <td contenteditable="true"><?php echo $bistatus; ?></td>

                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-4 span_4">
                <?php include('includes/rsidebar.php');?>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <?php
    include_once "footer.php" ?>

    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        $('.image').hover(function() {
            $(this).addClass('transition');

        }, function() {
            $(this).removeClass('transition');
        });
    });
    function updateSuppDeatils(id,colum,valueid){
        alert(id);
        var request = $.ajax({
            url: "updateScript.php",
            type: "POST",
            data: {id : id,colom:colum,valueid:valueid},
            dataType: "json",
            async: false,
        });

        request.done(function(msg) {
          //  $("#log").html( msg );
        });

        request.fail(function(jqXHR, textStatus) {
            alert( "Request failed: " + textStatus );
        });
    }
</script>
<style>
    .image img {
        width: 100px;
        -webkit-transition: all .2s ease-in-out;
        -moz-transition: all .2s ease-in-out;
        -o-transition: all .2s ease-in-out;
        -ms-transition: all .2s ease-in-out;
    }

    .transition {
        -webkit-transform: scale(2);
        -moz-transform: scale(2);
        -o-transform: scale(2);
        transform: scale(2);
    }
</style>
</body>
</html>

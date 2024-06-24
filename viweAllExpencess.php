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



if(isset($_POST['Submit']))
{

    $shopid=$_SESSION['shopidu'];
    $exp_name=$_REQUEST['exp_name'];
    $exp_amount=$_REQUEST['exp_amount'];
    $exp_by=$_REQUEST['exp_by'];
    $exp_date=$_REQUEST['exp_date'];
    $exp_desc=$_REQUEST['exp_desc'];
    $shopid="";
    $fid="";
    $sql="SELECT * FROM `tblexpences` WHERE `exp_name` ='$exp_name' && `exp_amount` ='$exp_amount' && `exp_by` ='$exp_by' && `exp_date` ='$exp_date' && `exp_desc` ='$exp_desc'";
    $query1=mysqli_query($conn,$sql);
    $r=mysqli_fetch_row($query1);
    $all=$r[0];
    if (empty($_POST["exp_name"])) {
        echo "<script> alert('Expense name is required');</script>";

    }

    elseif (empty($_POST["exp_amount"])) {
        echo "<script> alert(' Expense amount is required');</script>";

    }
    elseif(empty($_POST["exp_by"])) {
        echo "<script> alert(' Percent is required');</script>";
    }
    elseif(empty($_POST["exp_date"])) {
        echo "<script> alert(' Percent is required');</script>"; }
    elseif($all>=1) {
        echo "<script> alert('Expense is already present');</script>"; }
    else
    {
        $shopid=$_SESSION['shopidu'];


        $sql="INSERT INTO `tblexpences`(`expid`, `exp_name`, `exp_amount`, `exp_desc`, `exp_by`, `exp_date`, `shopid`, `fid`) VALUES ('','$exp_name','$exp_amount','$exp_desc','$exp_by','$exp_date','$shopid','$fid')";

        $query=mysqli_query($conn,$sql);
        if(!$query)
        {

            echo "<script>alert('Insersion Error')</script>";

        }
        else
        {

            echo "<script>alert('Expense Added')</script>";
            echo '<script> window.location.href = "expences.php";</script>';
        }
    }
}
if(isset($_POST['update']))
{
    $expid=$_REQUEST['expid'];
    $exp_name=$_REQUEST['exp_name'];
    $exp_amount=$_REQUEST['exp_amount'];
    $exp_by=$_REQUEST['exp_by'];
    $exp_date=$_REQUEST['exp_date'];
    $exp_desc=$_REQUEST['exp_desc'];

    $fid="";
    if (empty($_POST["exp_name"])) {
        echo "<script> alert('Expense name is required');</script>";

    }

    elseif (empty($_POST["exp_amount"])) {
        echo "<script> alert(' Expense amount is required');</script>";

    }
    elseif(empty($_POST["exp_by"])) {
        echo "<script> alert(' Percent is required');</script>";
    }
    elseif(empty($_POST["exp_date"])) {
        echo "<script> alert(' Percent is required');</script>"; }

    else
    {

        $sql="UPDATE `tblexpences` SET `exp_name`='$exp_name',`exp_amount`='$exp_amount',`exp_desc`='$exp_desc',`exp_by`='$exp_by',`exp_date`='$exp_date' WHERE `expid`='$expid'";
        $query=mysqli_query($conn,$sql);
        if($query){
            echo "<script> alert('Update Successfully');</script>";
        }else{
            echo "<script> alert('Not Update ');</script>";
        }
    }
}
if(isset($_POST['Delete']))
{
    $pid=$_POST['pid'];
    $sql="DELETE  FROM `tblexpences` WHERE `expid`='$expid'";
    $query=mysqli_query($conn,$sql);
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>EasyBilling| Expenses:: Billing</title>
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
    <script>
        function rowshow(id)
        {

            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: 'getExpencesupdate.php',
                async: false,
                data: {"id": id},
                success: function (response) {
                    $('#expid').val(id)
                    $('#exp_name').val(response[0].exp_name)
                    $('#exp_amount').val(response[0].exp_amount)
                    $('#exp_desc').val(response[0].exp_desc)
                    $('#exp_by').val(response[0].exp_by)
                    $('#exp_date').val(response[0].exp_date)
                    $('#dadd').prop('disabled',true);

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

        <div class="content_bottom">
            <div class="col-md-12 span_3">


                <div class="col-md-12 stats-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">Expenses Report</h4>
                    </div>
                    <div class="panel-body">
                        <div class="bs-example1" data-example-id="contextual-table">
                            <div style="float: right;
    margin: -2px 16px;">
                                <a  onclick="PrintElem('#yourdiv')" id="bar-1" class="btn btn-info"><i class="fa fa-print" aria-hidden="true"></i></a>
                            <?php

                            $exp_by=$_GET['exp_by'];?>
                            <a href="exportExcelExpenss.php?exp_by=<?php echo $exp_by ?>" class="btn btn-info"><i class="fa fa-download" aria-hidden="true"></i></a>
                            </div>
                            <div style="height: 300px; width: 100%;overflow: auto;" id="yourdiv">

                                <table class="table" >
                                    <thead>
                                    <tr>
                                        <th style="color:black;text-align:left">No.</th>
                                        <th style="color:black;text-align:left"> Date</th>
                                        <th style="color:black;text-align:left"> Name</th>
                                        <th style="color:black;text-align:left"> Person</th>
                                        <th style="color:black;text-align:left"> Amount</th>

                                    </tr>
                                    </thead>
                                    <tbody>



                                    <?php

$exp_by=$_GET['exp_by'];

                                        $search_result="";
                                        $query = "SELECT * FROM tblexpences WHERE shopid='$shopid' AND exp_by='$exp_by'";

                                        $search_result = mysqli_query($conn, $query);


                                    $sr=0;
                                    while( $row = mysqli_fetch_array( $search_result ))
                                    {
                                        $id=$row['expid'];
                                        $sr++;
                                        echo"<tr onclick='rowshow($id)' style='cursor:pointer'>";
                                        echo"<td>".$sr."</td>";

                                        echo"<td>".$row['exp_date']."</td>";
                                        echo"<td>".$row['exp_name']."</td>";
                                        echo"<td>".$row['exp_by']."</td>";
                                        echo"<td>".$row['exp_amount']."</td>";

                                        ?>

                                        <!--<td>
                                            <a onClick="javascript: return confirm('Are You Sure');" href="delete_exp.php?expid=<?php /*echo $row['expid'] */?>"><i class="fa fa-trash-o iconsize" aria-hidden="true"></i></a>
                                            <a  href="viweAllExpencess.php?expid=<?php /*echo $row['expid'] */?>"><i class="fa fa-eye iconsize" aria-hidden="true"></i></a>
                                        </td>-->
                                        <?php

                                        echo"</tr>";
                                    }
                                    ?>



                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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

function PrintElem(elem)
{
Popup($(elem).html());
}

function Popup(data)
{

var mywindow = window.open('', 'LATEST FURNITURE', 'height=400,width=600');
mywindow.document.write('<html><head><title>LATEST FURNITURE</title>');
    /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
    mywindow.document.write('</head><body >');
mywindow.document.write(data);
mywindow.document.write('</body></html>');
mywindow.print();
mywindow.close();
return true;
}
</script>
</body>
</html>

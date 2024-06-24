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
    <title>EasyBilling| Invoice History :: Billing</title>
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
                <div class="bs-example1" data-example-id="contextual-table">


                    <form method="POST">
                        <div style="width: 100%;
    border: aliceblue;
    float: left;    margin: 8px 0px;"> From Date<input  class="form-control1 input-search" type="date"  name="txt_from" placeholder="" style="    border-radius: 00px !important;
    border: 1px solid !important;" value="<?php
                            $currentDateTime = date('Y-m-d');
                            echo $currentDateTime;
                            ?>">
                            To Date    <input  class="form-control1 input-search" type="date"  name="txt_todate" placeholder="" style="    border-radius: 00px !important;
    border: 1px solid !important;" value="<?php
                            $currentDateTime = date('Y-m-d');
                            echo $currentDateTime;
                            ?>"></div>
                        <div style="   float: right;
    width: 18%;
    margin: 2px 0px;"><button class="btn btn-success" type="submit" name="search-date" style="width: 55%;
    margin: 3px 64px;"><i class="fa fa-search"></i></button></div>
                        <div class="input-group">

                            <input  class="form-control1 input-search" type="text"  id="txt_sreach" placeholder="Search By  Category Or Product" 				name="txt_search">
                            <!--a href="#" style="color:white;margin-left:3%;"><button class="btn btn-success" type="submit" name="txt_search">Search</button></a-->
                            <span class="input-group-btn">
							<!--input type="submit" name="search" class="fa fa-search"-->
							  <button class="btn btn-success" type="submit" name="search"><i class="fa fa-search"></i></button>
						 </span>
                        </div>
                    </form>

                    <div style="height: 300px; width: 100%;overflow: auto;">

                        <table class="table">
                            <thead>
                            <tr>
                                <th style="color:black;align:center">Id</th>
                                <th style="color:black;align:center">Order Date</th>
                                <th style="color:black;align:center">Total Amount</th>
                                <th style="color:black;align:center">Mode Of Payment</th>
                                <th style="color:black;align:center">Customer Name</th>
                                <th style="color:black;align:center">Phone Number</th>
                                <th style="color:black;align:center">Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="active">
                            </tr>

                            <?php
                            // $catid1=$_GET['catid'];
                            if(isset($_POST['search']))
                            {

                                $search=$_POST['txt_search'];
                                $search_result="";
                                $query = "SELECT t.*,p.* FROM `tbltransaction` t JOIN phonebook p on t.`custid` = p.`cid`   JOIN shop s ON p.`shopid`=s.`id`
WHERE p.name LIKE '%$search%'  OR p.phonenumber LIKE '%$search%' OR s.shopname like '%$search%' AND t.`statusQT`='T' AND t.`shopid`='$shopid'";
                                $search_result = mysqli_query($conn, $query);

                            } elseif(isset($_POST['search-date']))
                            {

                                $txt_from=$_POST['txt_from'];
                                $txt_todate=$_POST['txt_todate'];
                                $search_result="";
                                $query = "SELECT t.*,p.* FROM `tbltransaction` t JOIN phonebook p on t.`custid` = p.`cid`  WHERE (tdate BETWEEN '$txt_from' AND '$txt_todate') AND t.`statusQT`='T' AND t.`shopid`='$shopid'";
                                $search_result = mysqli_query($conn, $query);

                            }
                            else
                            {
                                $search_result="";
                                $query = "SELECT t.*,p.* FROM `tbltransaction` t JOIN phonebook p on t.`custid` = p.`cid` AND t.`statusQT`='T' AND t.`shopid`='$shopid'";

                                $search_result = mysqli_query($conn, $query);

                            }

                            while( $row = mysqli_fetch_array($search_result))
                            {
                                /*$id=$row['custid'];*/
                                echo"<tr style='color:black;align:center'>";
                                echo "<td  style='color:black'>".$row['tid']."</td>";
                                echo "<td style='color:black'>".$row['tdate']."</td>";
                                echo "<td style='color:black'>".$row['atotal']."</td>";
                                echo "<td style='color:black'>".$row['modeOfPayment']."</td>";
                                echo "<td style='color:black'>".$row['name']."</td>";
                                echo"<td style='color:black'>".$row['phonenumber']."</td>";
          $pid= base64_encode($row['tid']);
        $cdid=base64_encode($row['custid'] );
                                ?>
                                <td> <a  href="billInvoiceGenerated.php?custid=<?php echo $cdid ?>&proId=<?php echo $pid ?>"<i class="fa fa-print" aria-hidden="true" style="font-size: 24px;
    margin: 0px 4px;"></i></a></td>
                                <?php
                                echo"</tr>";
                            }

                            ?>

                            </tbody>
                        </table>
                    </div>
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
    </div>
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>

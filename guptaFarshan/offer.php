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
    $offername=$_REQUEST['offername'];
    $offerPercent=$_REQUEST['offerPercent'];
    $validDate=$_REQUEST['validDate'];

    $sql="SELECT * FROM `tbloffer` WHERE `offername` ='$offername' AND shopid='$shopid'";
    $query1=mysqli_query($conn,$sql);
    $r=mysqli_fetch_row($query1);
    $all=$r[0];
    if (empty($_POST["offername"])) {
        echo "<script> alert('Offername is required');</script>";

    }

    elseif (empty($_POST["offerPercent"])) {
        echo "<script> alert('Percent is required');</script>";

    }
    elseif (empty($_POST["validDate"])) {
        echo "<script> alert('Validity Date is required');</script>";

    }
    elseif($all>=1) {
        echo "<script> alert(' Offer is already present');</script>";
    }
    elseif($offerPercent<0)
    {
        echo "<script> alert(' Please enter percent greater than zero');</script>";
    }

    else
    {

        $sql = "insert into tbloffer(offername,offerPercent,validDate,shopid)values('$offername','$offerPercent','$validDate','$shopid')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "<script>alert('Offer is Added');</script>";
            echo '<script> window.location.href = "offer.php";</script>';
        } else {
            echo "<script>alert('Offer is not Added');</script>";

            echo '<script> window.location.href = "offer.php";</script>';
        }

    }

}
if(isset($_POST['Update']))
{
    $offerid=$_REQUEST['offerid'];
    $offername=$_REQUEST['offername'];
    $offerPercent=$_REQUEST['offerPercent'];
    $validDate=$_REQUEST['validDate'];


    if (empty($_POST["offername"])) {
        echo "<script> alert('offername is required');</script>";

    }

    elseif (empty($_POST["offerPercent"])) {
        echo "<script> alert('Percent is required');</script>";

    }
    elseif (empty($_POST["validDate"])) {
        echo "<script> alert('Validity Date is required');</script>";

    }
    elseif($offerPercent<0)
    {
        echo "<script> alert(' Please enter percent greater than zero');</script>";
    }
    else
    {

        $sql1 ="UPDATE tbloffer SET offername='$offername' ,offerPercent='$offerPercent',validDate='$validDate'  WHERE   offerid='$offerid' AND shopid='$shopid'";

        $result1 = mysqli_query($conn, $sql1);

        if ($result1) {
            echo "<script>alert('Offer Updated');</script>";
            echo '<script> window.location.href = "offer.php";</script>';
        } else {
            echo "<script>alert('Offer is not Updating');</script>";

            echo '<script> window.location.href = "offer.php";</script>';
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
    <style>
        .iconsize {
            font-size: 23px;
        }
    </style>

    <script>

        function rowshow(id)
        {

            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: 'getOfferupdate.php',
                async: false,
                data: {"id": id},
                success: function (response) {
                    $('#oid').val(id)
                    $('#oname').val(response[0].offername)
                    $('#opercent').val(response[0].offerPercent)
                    $('#oexpdate').val(response[0].validDate)

                },
                error: function (req, status, error) {
                }
            });
        }
    </script>

	
	
	
		<!--jquery date picker-->
		
		
		<link href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="Stylesheet"
        type="text/css" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script language="javascript">
        $(document).ready(function () {
            $("#oexpdate").datepicker({
                minDate: 0,
				dateFormat: 'yy-mm-dd'
            });
        });
    </script>
		
		<!--jquery date picker-->
		
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
        $maxval=mysqli_query($conn,"SELECT MAX(`offerid`) AS Maxid FROM `tbloffer` ");
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
                        <h4 class="panel-title">Add Offer</h4>
                    </div>


                    <div class="panel-body">
                        <form method="post">

                            <div class="form-group ">
                                <label  style="width: 90%;color:black" for="inputSuccess1" style="width: 90%;">Offer ID</label>           <!---- autogenerated  -------->
                                <input type="text" class="form-control1" id="oid" name="offerid" value="<?php  echo $max; ?>">
                            </div>
                            <div class="form-group ">
                                <label  style="width: 90%;color:black" for="inputWarning1" style="width: 90%;">Offer Name</label>
                                <input type="text" class="form-control1" id="oname" name="offername">
                            </div>
                            <div class="form-group ">
                                <label  style="width: 90%;color:black" for="inputWarning1" style="width: 90%;">Offer Percent</label>
                                <input type="text" class="form-control1" id="opercent" name="offerPercent">
                            </div>
                            <div class="form-group ">
                                <label  style="width: 90%;color:black" for="inputWarning1" style="width: 90%;">Valid Till</label>
                                <input type="text" class="form-control1" id="oexpdate" name="validDate">
                            </div>
                            <input type="submit" class="btn btn-success" name="Submit" value="Add" />
                            <input type="submit" class="btn btn-warning" name="Update" value="Update"  style="margin-left:5%"/>

                        </form>
                    </div>
                    <hr>

                    <br>

                </div>
                <div class="col-md-6 stats-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">Offer Report</h4>
                    </div>
                    <div class="panel-body">
                        <div class="bs-example1" data-example-id="contextual-table">

                            <form method="POST">
                                <div class="input-group">
                                    <input  class="form-control1 input-search"  type="text"  id="txt_sreach" placeholder="Search By Offer Name" name="txt_search">
                                    <span class="input-group-btn">	
					 <button class="btn btn-success" type="hidden" name="submit"><i class="fa fa-search"></i></button></span>
                                </div>
                                <!--input type="hidden" name="txt_search"-->
                            </form>


                            <div style="height: 300px; width: 100%;overflow: auto;">
                                <table class="table">

                                    <thead>
                                    <tr>

                                        <th style="color:black;text-align:center">Offer Name</th>
                                        <th style="color:black;text-align:center">Discount(%)</th>
                                        <th style="color:black;text-align:center">Valid Date</th>
                                        <th style="color:black;text-align:center">Manage</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(isset($_POST['txt_search']))
                                    {

                                        $search=$_POST['txt_search'];
                                        $search_result="";
                                        $query = "SELECT * FROM tbloffer WHERE offername LIKE '%$search%' AND shopid='$shopid' ";
                                        $search_result = mysqli_query($conn, $query);

                                    }
                                    else
                                    {
                                        $search_result="";
                                        $query = "SELECT * FROM tbloffer WHERE shopid='$shopid'";

                                        $search_result = mysqli_query($conn, $query);

                                    }

                                    while( $row = mysqli_fetch_array( $search_result ))
                                    {
                                        $id=$row['offerid'];
										$offername=$row['offername'];
                                        echo"<tr onclick='rowshow($id)' style='cursor:pointer;text-align:center;color:black'>";

                                        echo "<td style='color:black'>".$row['offername']."</td>";
                                        echo"<td style='color:black'>".$row['offerPercent']."</td>";
                                        echo"<td style='color:black'>".$row['validDate']."</td>";

                                        if($offername=="No Offer")
                                        {

                                            ?>
                                            <td style="display:none"><a href="view_offer.php?offerid=<?php echo $row['offerid']; ?>" ><i class="fa fa-eye iconsize" aria-hidden="true"></i></a>
                                                <a href="del_offer.php?offerid=<?php echo $row['offerid'];?>"> <i class="fa fa-trash-o iconsize" aria-hidden="true"></i></a>
                                            </td>
                                        <?php }
                                        else{

                                            ?>
                                            <td> <a href="view_offer.php?offerid=<?php echo $row['offerid']; ?>" ><i class="fa fa-eye iconsize" aria-hidden="true"></i></a>
                                                <a href="del_offer.php?offerid=<?php echo $row['offerid'];?>"> <i class="fa fa-trash-o iconsize" aria-hidden="true"></i></a>
                                            </td>
                                        <?php }
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
</body>
</html>

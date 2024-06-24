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


<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
include_once "config.php";

if(isset($_POST['Submit']))
{
    $Taxname=$_REQUEST['tname'];

    $Taxpercent=$_REQUEST['tpercent'];
   /* $tsgstname=$_REQUEST['tsgstname'];*/
    $tsgstpercent=$_REQUEST['tsgstpercent'];
    //$shopid=$_REQUEST['shopid'];

    $sql="SELECT * FROM `tbltax` WHERE `taxName` ='$Taxname' AND shopid='$shopid' ";
    $query1=mysqli_query($conn,$sql);
    $r=mysqli_fetch_row($query1);
    $all=$r[0];
    if (empty($_POST["tname"])) {
        echo "<script> alert('name is required');</script>";

    }/* elseif (empty($_POST["tsgstname"])) {
        echo "<script> alert('name is required');</script>";

    }*/

    elseif ($Taxpercent=='') {
        echo "<script> alert(' Percent is required');</script>";

    }
    elseif ($tsgstpercent=='') {
        echo "<script> alert(' Percent is required');</script>";

    }
    elseif($all>=1) {
        echo "<script> alert(' Tax is already Define');</script>";
    }
    elseif($Taxpercent<0)
    {
        echo "<script> alert('Please enter percent greater than zero');</script>";
    }
    else
    {

        $sql = "insert into tbltax(taxName,taxPercent,shopid,taxPercents)values('$Taxname','$Taxpercent','$shopid','$tsgstpercent')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "<script>alert('Tax is Added');</script>";
            echo '<script> window.location.href = "tax.php";</script>';
        } else {
            echo "<script>alert('Tax is not Added');</script>";

            echo '<script> window.location.href = "tax.php";</script>';
        }

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
        $maxval=mysqli_query($conn,"SELECT MAX(`taxid`) AS Maxid FROM `tbltax` ");
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
                        <h4 class="panel-title">Tax Policy</h4>
                    </div>
                    <div class="panel-body">

                        <form method="POST">
                            <!--<div class="form-group ">-->
                               <!-- <label  style="width: 90%;color:black" for="inputSuccess1">Tax Id</label>-->
                                <input type="hidden" class="form-control1" id="tid" name="tid" value="<?php echo $max; ?>">
                           <!-- </div>-->
                            <div class="form-group ">
                                <label  style="width: 90%;color:black" for="inputSuccess1">Tax Name </label>
                                <input type="text" class="form-control1" id="tname" name="tname" placeholder="TAX Name ">
                            </div>
                            <div class="form-group ">
                                <label style="width: 90%;color:black" for="inputWarning1">Tax Percent CGST</label>
                                <input type="text" class="form-control1" id="tpercent" name="tpercent">
                            </div>
                           <!-- <div class="form-group ">
                                <label  style="width: 90%;color:black" for="inputSuccess1">Tax Name SGST</label>
                                <input type="text" class="form-control1" id="tsgstname" name="tsgstname" value="SGST">
                            </div>-->
                            <div class="form-group ">
                                <label style="width: 90%;color:black" for="inputWarning1">Tax Percent SGST</label>
                                <input type="text" class="form-control1" id="tsgstpercent" name="tsgstpercent">
                            </div>
                            <input type="submit" class="btn btn-success" name="Submit" value="Add">
                            <input type="submit" name="update" class="btn btn-warning" value="Update" style="margin-left:5%">
                        </form>
                    </div>
                    <hr>

                    <br>
                    <p><i style="font-size:12px">You can add your Tax Policy here and update as per changes.We tried to make similarity with GST,thats why have already some tax policy,you can update when it will be changed.</i></p>

                    <p><i style="font-size:12px">Software is feasible with these changes.</i><p>
                    <hr/>
                </div>
                <div class="col-md-6 stats-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">Tax Report</h4>
                    </div>
                    <div class="panel-body">
                        <div class="bs-example1" data-example-id="contextual-table">
                            <div style="height: 300px; width: 100%;overflow: auto;">
                                <table class="table">
                                    <form method="POST">
                                        <div class="input-group">
                                            <input  class="form-control1" type="text"  id="txt_sreach" placeholder="Search By Tax" name="txt_search">
                                            <span class="input-group-btn">
							   <button class="btn btn-success" type="submit" name="submit"><i class="fa fa-search"></i></button></span>
                                        </div>
                                    </form>

                                    <thead>
                                    <tr >

                                        <th style="color:black;text-align:center">Tax Name</th>
                                        <th style="color:black;text-align:center">CGST Percent</th>
                                      <!--  <th style="color:black;text-align:center">Tax Name</th>-->
                                        <th style="color:black;text-align:center">SGST Percent</th>
                                        <th style="color:black;text-align:center">Manage </th>
                                    </tr>
                                    </thead>
                                    <tbody>



                                    <?php
                                    if(isset($_POST['txt_search']))
                                    {

                                        $search=$_POST['txt_search'];
                                        $search_result="";
                                        $query = "SELECT * FROM tbltax WHERE taxName LIKE '%$search%' AND shopid='$shopid'";
                                        $search_result = mysqli_query($conn, $query);

                                    }
                                    else
                                    {
                                        $search_result="";
                                        $query = "SELECT * FROM tbltax WHERE shopid='$shopid'";

                                        $search_result = mysqli_query($conn, $query);

                                    }

                                    while( $row = mysqli_fetch_array( $search_result ))
                                    {
                                        $id=$row['taxid'];
										$taxnm=$row['taxName'];
                                        echo"<tr onclick='rowshow($id)' style='cursor:pointer;color:black;text-align:center;'>";
                                        echo"<td style='color:black'>".$row['taxName']."</td>";
                                        echo"<td style='color:black'>".$row['taxPercent']."</td>";
                                       /* echo"<td style='color:black'>".$row['taxNames']."</td>";*/
                                        echo"<td style='color:black'>".$row['taxPercents']."</td>";


                                        if($taxnm=="No Tax")
                                        {

                                            ?>
                                            <td style="display:none"><a href="view_tax.php?taxid=<?php echo $row['taxid']; ?>" ><i class="fa fa-eye iconsize" aria-hidden="true"></i></a>
                                                <a href="del_Tax.php?taxid=<?php echo $row['taxid'] ?>"> <i class="fa fa-trash-o iconsize" aria-hidden="true"></i></a>
                                            </td>
                                        <?php }
                                        else{

                                            ?>


                                            <td><a href="view_tax.php?taxid=<?php echo $row['taxid']; ?>" ><i class="fa fa-eye iconsize" aria-hidden="true"></i></a>
                                                <a class='confirmation' href="del_Tax.php?taxid=<?php echo $row['taxid'] ?>"> <i class="fa fa-trash-o iconsize" aria-hidden="true"></i></a>
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
<script type="text/javascript">
    $('.confirmation').on('click', function () {
        return confirm(' If you delete tax then all product belongs to this tax will be deleted');
    });
</script>
</body>
</html>

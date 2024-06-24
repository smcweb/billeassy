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

$shopId=$_SESSION['shopidu'];
//echo "<script> alert('$shopId');</script>";
if(isset($_POST['submit2']))
{
    $catid=$_REQUEST['catid'];
    $cname=$_REQUEST['cname'];
    //$shopId=$_REQUEST['shopId'];

    if (empty($_POST["catid"])) {
        echo "<script> alert('Catid is required');</script>";

    }

    elseif (empty($_POST["cname"])) {
        echo "<script> alert('Category name is required');</script>";

    }

    else
    {

        $sql = "insert into tblcategory(catID,catName,shopId)values('$catid','$cname','$shopId')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "<script>alert('Category is Added');</script>";
            echo '<script> window.location.href = "category.php";</script>';
        } else {
            echo "<script>alert('Category is not Added');</script>";

            echo '<script> window.location.href = "category.php";</script>';
        }

    }

}
if(isset($_POST['update']))
{
    $catid=$_REQUEST['catid'];
    $cname=$_REQUEST['cname'];
    //$shopId=$_REQUEST['shopId'];

    if (empty($_POST["catid"])) {
        echo "<script> alert('Catid is required');</script>";

    }

    elseif (empty($_POST["cname"])) {
        echo "<script> alert('Category name is required');</script>";

    }

    else
    {

        $sql1 ="UPDATE tblcategory SET catName='$cname' WHERE catID='$catid' AND shopId='$shopId'";

        $result1 = mysqli_query($conn, $sql1);

        if ($result1) {
            echo "<script>alert('category Updated');</script>";
            echo '<script> window.location.href = "category.php";</script>';
        } else {
            echo "<script>alert('Category is not Updating');</script>";

            echo '<script> window.location.href = "category.php";</script>';
        }

    }

}

?>

<!DOCTYPE HTML>
<html>
<head>
    <title>EasyBilling| Home :: Billing</title>
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
                url: 'getCategoryupdate.php',
                async: false,
                data: {"id": id},
                success: function (response) {
                    $('#catid').val(id)
                    $('#cname').val(response[0].catName)


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
    include_once "header.php"
    ?>

    <div id="page-wrapper">
        <?php
        include_once "top.php"
        ?>
        <?php
        $maxval=mysqli_query($conn,"SELECT MAX(`catID`) AS Maxid FROM `tblcategory`");
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
                        <h4 class="panel-title">Add Category</h4>
                    </div>
                    <div class="panel-body">
                        <form action="" method="POST" >
                            <!--<form class="navbar-form navbar-right">
                    <input type="text" class="form-control" value="Search and Update" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search...';}">
                  </form>-->
                            <div class="form-group ">
                                <label style="color:black" >Category ID</label>  <!----autogenerated-------->
                                <input type="text" class="form-control1" id="catid" name="catid" value="<?php echo $max; ?>">
                            </div>
                            <div class="form-group ">
                                <label style="color:black" >Category Name</label>
                                <input type="text" class="form-control1" id="cname" name="cname">
                            </div>
                            <input type="submit" class="btn btn-success" name="submit2" value="Add " />
                            <input type="submit" class="btn btn-warning" id="btn_cat_update" name="update" value="Update"  style="margin-left:5%"/>
                            <!--input type="submit" class="btn btn-danger" id="btn_cat_delete" name="delete" value="Delete Category" /-->
                        </form>
                    </div>
                    <hr/>

                    <p><i style="font-size:12px">You can add your categories as per nature of your business here and update as per changes.We tried to make similarity with GST,thats why have already some categories,you can update when it will be changed.</i></p>

                    <p><i style="font-size:12px">Software is feasible with these changes.</i><p>

                    <hr/>
                </div>
                <div class="col-md-6 stats-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">Category List</h4>
                    </div>

                    <div class="panel-body">
                        <div class="bs-example1" data-example-id="contextual-table">



                            <form method="POST">
                                <div class="input-group">
                                    <input  class="form-control1 input-search"  type="text"  id="txt_sreach" placeholder="Search By Category" name="txt_search">
                                    <span class="input-group-btn">
					 <button class="btn btn-success" type="hidden" name="submit"><i class="fa fa-search"></i></button></span>
                                </div>
                                <!--input type="hidden" name="txt_search"-->
                            </form>





                            <div style="height: 300px; width: 100%;overflow: auto;">
                                <table class="table">

                                    <thead >
                                    <tr style="align:center">

                                        <th style="color:black;text-align:center"> Category Name</th>

                                        <th style="color:black;text-align:center">Manage</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    <!--<tr class="active">
                                    <form class="navbar-form navbar-right">
                                    <input type="text" class="form-control" value="Search..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search...';}">
                                  </form></tr>
                                      <tr class="active">-->



                                    <?php
                                    if(isset($_POST['txt_search']))
                                    {

                                        $search=$_POST['txt_search'];
                                        $search_result="";
                                        $query = "SELECT * FROM tblcategory WHERE catName LIKE '%$search%' AND shopId='$shopId' ";
                                        $search_result = mysqli_query($conn, $query);

                                    }
                                    else
                                    {
                                        $search_result="";
                                        $query = "SELECT * FROM tblcategory WHERE shopId='$shopId' ";

                                        $search_result = mysqli_query($conn, $query);

                                    }
                                    $sr=0;

                                    while( $row = mysqli_fetch_array( $search_result ))
                                    {

                                        $id=$row['catID'];
                                        echo"<tr onclick='rowshow($id)' style='cursor:pointer;text-align:center;color:black'>";

                                        echo"<td style='color:black'>".$row['catName']."</td>";

                                        echo"<td><a href='Add_Product.php?catid=".$row['catID']."'><i class='fa fa-eye iconsize' aria-hidden='true'></i></a><a class='confirmation' href='del_category.php?catid=".$row['catID']."'> <i class='fa fa-trash-o iconsize ' aria-hidden='true'></i></a></td>";

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
    <!--confirm-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="jquery-3.2.1.min.js"></script>
    <script type="text/javascript">
        $('.confirmation').on('click', function () {
            return confirm('Are you sure?');
        });
    </script>
    <!--confirm -->
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

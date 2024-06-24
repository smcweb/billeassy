<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
    <title>EasyBilling| Product:: Billing</title>
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
    <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>-->

    <script src="mainScript.js"></script>
    <!--del_Product-->
    <!--update product-->
    <script>
        function rowshow(id)
        {

            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: 'getProductupdate.php',
                async: false,
                data: {"id": id},
                success: function (response) {
                    $('#productid').val(id)
                    $('#addproductName').val(response[0].pname)
                    $('#addWithoutMrpTax').val(response[0].price)
                    $('#addWithMrpTax').val(response[0].mrp_with_gst)
                    $('#addCGST').val(response[0].taxPercent)
                    $('#addSGST').val(response[0].taxPercents)
                    $('#addquantity').val(response[0].quantity)
                    $('#cat').val(response[0].catid)
                    $('#HSN-Code').val(response[0].hsncode)
                    // $('#tax').val(response[0].taxName)


                },
                error: function (req, status, error) {
                }
            });
        }

    </script>
    <link rel="stylesheet" href="css/clndr.css" type="text/css" />
    <script src="js/underscore-min.js" type="text/javascript"></script>
    <script src= "js/moment-2.2.1.js" type="text/javascript"></script>
    <script src="js/clndr.js" type="text/javascript"></script>
    <script src="js/site.js" type="text/javascript">
    </script>
    <!--update Product-->
    <link href="sweetalert.css" type="text/css" rel="stylesheet">
    <link href="facebook.css" type="text/css" rel="stylesheet">
    <script src="jquery-3.0.0.js" type="text/javascript"></script>
    <script src="sweetalert.min.js" type="text/javascript"></script>
</head>
<body>

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
$shopid = $_SESSION['shopidu'];


if(isset($_POST['sub']))
{
    $catid=$_REQUEST['cat'];
    $offer=$_REQUEST['offer'];
    $tax=$_REQUEST['tax'];

    $Productname=$_REQUEST['addproductName'];
    $Productprice=$_REQUEST['addWithoutMrpTax'];
    $addWithMrpTax=$_REQUEST['addWithMrpTax'];
    $Productquantity=$_REQUEST['addquantity'];
    $ProductHSN_Code=$_REQUEST['HSN-Code'];
    //$shopid=$_REQUEST['shopid'];
	//echo "<script> alert('$catid');</script>";
	    $sql="SELECT * FROM `tblproduct` WHERE `pname` ='$Productname'";
    $query1=mysqli_query($conn,$sql);
    $r=mysqli_fetch_row($query1);
    $all=$r[0];
    if ($catid=='Select Category') {
        echo "<script> alert('category is required');</script>";
       // return;

    }elseif (empty($_POST["addproductName"])) {
        echo "<script> alert('Name is required');</script>";

    }

    elseif (empty($_POST["addWithoutMrpTax"])) {
        echo "<script> alert(' Price is required');</script>";

    }
    elseif ($Productprice<=0)
    {
        echo "<script> alert(' Price must be  greater than zero ');</script>";

    }
    elseif ($Productquantity<=0)
    {
        echo "<script> alert(' Quantity must be  greater than zero ');</script>";

    }
	    elseif($all>=1) {
        echo "<script> alert(' Product is present');</script>";
    }

    else
    {

        $sql = "INSERT INTO `tblproduct`(`pname`, `price`, `quantity`, `taxid`, `catid`, `offerid`,shopid,hsncode,mrp_with_gst) VALUES ('$Productname','$Productprice','$Productquantity','$tax','$catid','$offer','$shopid','$ProductHSN_Code','$addWithMrpTax');";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo '<script>sweetAlert("Good job!", "Product is Added", "success");</script>';
            return;
            echo '<script> window.location.href = "product.php";</script>';
        } else {
            echo "<script>alert('Product is not Added');</script>";

            echo '<script> window.location.href = "product.php";</script>';
        }

    }

}
if(isset($_POST['update']))
{
    $pid=$_REQUEST['pid'];
    $Productname=$_REQUEST['addproductName'];
    $Productprice=$_REQUEST['addWithoutMrpTax'];
    $addWithMrpTax=$_REQUEST['addWithMrpTax'];
    $Productquantity=$_REQUEST['addquantity'];
    //$shopid=$_REQUEST['shopid'];
    $catid=$_REQUEST['cat'];
    $offer=$_REQUEST['offer'];
    $tax=$_REQUEST['tax'];
    $taxHSN_Code=$_REQUEST['HSN-Code'];
if($tax=='No'){
    echo "<script> alert('Tax is required');</script>";

}
    if (empty($_POST["addproductName"])) {
        echo "<script> alert('Product is required');</script>";

    }

    elseif (empty($_POST["addWithoutMrpTax"])) {
        echo "<script> alert('Price  is required');</script>";

    }
    elseif ($Productprice<=0) {
        echo "<script> alert(' Price must be  greater than zero ');</script>";

    }
    elseif ($Productquantity<=0) {
        echo "<script> alert(' Quantity must be  greater than zero ');</script>";

    }

    else
    {

        $sql1 ="UPDATE `tblproduct` SET `pname`='$Productname',`price`='$Productprice',`quantity`='$Productquantity',`taxid`='$tax',`catid`='$catid',`offerid`='$offer',hsncode='$taxHSN_Code',mrp_with_gst='$addWithMrpTax' WHERE `pid`='$pid' and shopid='$shopid'";

        $result1 = mysqli_query($conn, $sql1);

        if ($result1)
        {
            echo "<script>alert('Product is updated');</script>";
            echo '<script> window.location.href = "product.php";</script>';
        }
        else
        {
            echo "<script>alert('Product is not updated');</script>";

            echo '<script> window.location.href = "product.php";</script>';
        }

    }

}
if(isset($_POST['delete']))
{
    $pid=$_REQUEST['pid'];
    $delete=mysqli_query($conn,"DELETE FROM `tblproduct` WHERE `pid`='$pid'");
    if($delete)
    {
        echo "<script>alert('Product is deleted');</script>";
        echo '<script> window.location.href = "product.php";</script>';
    }
    else
    {
        echo "<script>alert('Product not deleted');</script>";
        echo '<script> window.location.href = "product.php";</script>';
    }
}
?>


<div id="wrapper">
    <!-- Navigation -->
    <?php
     include_once "header.php"; ?>
    <!-- Navigation -->
    <div id="page-wrapper">
<?php   include_once "top.php";
?>

           
        
        <div class="content_bottom">
            <div class="col-md-12 span_3">
                <div class="col-md-6 stats-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">Add Product </h4>
                    </div>
                    <div class="panel-body">


                        <form method="POST">

                            <div class="form-group ">
                                <div id="status_text">
                     <!--label style="width: 90%;color:black" for="inputSuccess1" style="width: 90%;">Product Id</label-->
					 <?php
        $maxval=mysqli_query($conn,"SELECT MAX(`pid`) AS Maxid FROM `tblproduct` ");
        while($row=mysqli_fetch_array($maxval))
        {
            $max=$row['Maxid'];
        }
        $max=$max+1;
        ?>
               
                                    <input type="hidden" placeholder="" class="form-control1" style="margin-left:;color:black"  id="productid" name="pid" value="<?php echo $max;  ?>">

                                    <label style="width: 90%;color:black" for="inputSuccess1" style="width: 90%;">Category</label>
                                    <select class="form-control1" name="cat" id="cat">
                                        <option>Select Category</option>
                                        <?php
										
                                        $cat=mysqli_query($conn,"SELECT * FROM `tblcategory` WHERE `shopid` ='$shopid'");
                                        while($row=mysqli_fetch_array($cat))
                                        {
                                            ?>
                                            <option value=<?php echo $row['catID']; ?>><?php echo $row['catName'];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <label style="width: 90%;color:black" for="inputSuccess1" style="width: 90%;">Tax</label>
                                    <select class="form-control1" name="tax" id="tax" onchange="taxUpdateInput(this.value)">
                                        <option value="No">Select Tax</option>
                                        <?php
                                        $cat=mysqli_query($conn,"SELECT * FROM `tbltax` WHERE `shopid` ='$shopid'");
                                        while($row=mysqli_fetch_array($cat))
                                        {
                                            ?>
                                            <option value=<?php echo $row['taxid']; ?>><?php echo $row['taxName'];?></option>
                                            <?php
                                        }
                                        ?>

                                    </select>
                                    <style>.form-control1{
                                            width: 90%;
                                        }</style>
                                    <input type="text" placeholder=" CGST" class="form-control1" style="margin-left:;color:black" id="addCGST" name="addCGST">
                                    <input type="text" placeholder=" SGST" class="form-control1" style="margin-left:;color:black" id="addSGST" name="addSGST">
                                    <label style="width: 90%;color:black" for="inputSuccess1" style="width: 90%;">Product Name</label>
                                    <input type="text" placeholder="" class="form-control1" style="margin-left:;width: 90%;color:black"  id="addproductName" name="addproductName">
                                    <label style="width: 90%;color:black" for="inputSuccess1">MRP Without Tax</label>
                                        <input type="text" placeholder="MRP Without Tax" class="form-control1" style="margin-left:;color:black" id="addWithoutMrpTax" name="addWithoutMrpTax" onblur="calculateWithoutGst()">
                                        <label style="width: 90%;color:black" for="inputSuccess1">MRP With Tax</label>
                                        <input type="text" placeholder=" MRP With Tax" class="form-control1" style="margin-left:;color:black" id="addWithMrpTax" name="addWithMrpTax" onblur="calculateWIthGst()"><h3 id="bar-id" style="display: none;font-size: 16px;color: red;margin: 4px;"></h3><i class="fa fa-refresh" style="    font-size: 19px; position: relative;margin: 0% 95%;color: skyblue;font-weight: bold;" onclick="restValue()"></i>

                                        <label style="width: 90%;color:black" for="inputSuccess1">Product Quantity</label>
                                    <input type="text" placeholder="" class="form-control1" style="margin-left:;width: 90%;color:black" id="addquantity" name="addquantity">

                                          <label style="width: 90%;color:black" for="inputSuccess1">Product HSN Code</label>
                                    <input type="text" placeholder="" class="form-control1" style="margin-left:;width: 90%;color:black" id="HSN-Code" name="HSN-Code">

                                    </select>
                                    <label style="width: 90%;color:black" for="inputSuccess1" style="width: 90%;">Offer</label>
                                    <select class="form-control1" name="offer" id="offer">
                                        <option value="1">Select Offer</option>
                                        <?php
                                        $cat=mysqli_query($conn,"SELECT * FROM `tbloffer`WHERE `shopid` ='$shopid'");
                                        while($row=mysqli_fetch_array($cat))
                                        {
                                            ?>
                                            <option value=<?php echo $row['offerid']; ?>><?php echo $row['offername'];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>

                                    <!--a class=" btn btn-info btn-fill"  id="btn_submit" >Add More Product</a-->

                                    <br/>
                                    <br/>
                                    <input type="submit" class="btn btn-warning" name="sub"  id="insert" value="Insert">
                                    <input type="submit" class="btn btn-success" name="update"  id="update" value="Update" style="margin-left:3%">
                                    <input type="submit" class="btn btn-danger"  name="delete"  id="delete" value="Delete" style="margin-left:3%">

                                </div>
                            </div>
                        </form>



                    </div>
                    <hr>

                    <br>
                    <p><i style="font-size:12px">You can add your Product Policy here and update as per changes.We tried to make similarity with GST,thats why have already some Product policy,you can update when it will be changed.</i></p>

                    <p><i style="font-size:12px">Software is feasible with these changes.</i><p>
                    <hr/>
                </div>
                <div class="col-md-6 stats-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">Product Report</h4>
                    </div>
                    <div class="panel-body">
                        <div class="bs-example1" data-example-id="contextual-table">
                            <form method="POST">
                                <div class="input-group">
                                    <input  class="form-control1 input-search" type="text"  id="txt_sreach" placeholder="Search By  Category Or Product" name="txt_search">
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

                                        <th style="color:black;text-align:center">Category</th>
                                        <th style="color:black;text-align:center">Product</th>
                                        <th style="color:black;text-align:center">Rs</th>
                                        <th style="color:black;text-align:center">Qty</th>
                                        <!--th style="color:black;text-align:center">Offer</th>
                                        <th style="color:black;text-align:center">Tax</th-->

                                    </tr>
                                    </thead>
                                    <tbody>


                                    <?php
                                    // $catid1=$_GET['catid'];
                                    if(isset($_POST['search']))
                                    {

                                        $search=$_POST['txt_search'];
                                        $search_result="";
										$sql="select catid from tblcategory where catName='$search'";
										$q=mysqli_query($conn,$sql);
										$res=mysqli_fetch_row($q);
										$catid=$res[0];
										$shopid=$_SESSION['shopidu'];
										//$query ="SELECT tbloffer.offername,tbltax.taxName,tblcategory.catName,tblproduct.`pid`,tblproduct.`pname`,tblproduct.`price`,tblproduct.`quantity`,tblproduct.catid from tblproduct, tblcategory, tbloffer, tbltax where tblproduct.catid = '$catid' && tblproduct.offerid=tbloffer.offerid && tblproduct.taxid=tbltax.taxid && tblproduct.shopid='$shopid'";
                                       $query = "SELECT tblcategory.catName,tblproduct.`pid`,tblproduct.`pname`,tblproduct.`price`,tblproduct.`quantity`,tblproduct.catid from tblproduct INNER JOIN tblcategory ON tblproduct.catid=tblcategory.catID WHERE tblproduct.shopid='$shopid'";
                                        $search_result = mysqli_query($conn, $query);

                                    }
                                    else
                                    {
                                        $search_result="";
										$shopid=$_SESSION['shopidu'];
										//$query ="SELECT tbloffer.offername,tbltax.taxName,tblcategory.catName,tblproduct.`pid`,tblproduct.`pname`,tblproduct.`price`,tblproduct.`quantity`,tblproduct.catid from tblproduct, tblcategory, tbloffer, tbltax where tblproduct.catid = tblcategory.catid && tblproduct.offerid=tbloffer.offerid && tblproduct.taxid=tbltax.taxid && tblproduct.shopid='$shopid'";
                                        $query = "SELECT tblcategory.catName,tblproduct.`pid`,tblproduct.`pname`,tblproduct.`price`,tblproduct.`quantity`,tblproduct.catid from tblproduct INNER JOIN tblcategory ON tblproduct.catid=tblcategory.catID WHERE tblproduct.shopid='$shopid'";

                                        $search_result = mysqli_query($conn, $query);

                                    }

                                    while( $row = mysqli_fetch_array($search_result,MYSQLI_ASSOC))
                                    {
                                        $id=$row['pid'];
                                        echo"<tr onclick='rowshow($id)' style='cursor:pointer;color:black;text-align:center'>";

                                        echo "<td  style='color:black'>".$row['catName']."</td>";

                                        echo "<td  style='color:black'>".$row['pname']."</td>";
                                        echo"<td  style='color:black'>".$row['price']."</td>";
                                        echo"<td  style='color:black'>".$row['quantity']."</td>";
										
                                        ?>


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
		<?php
	include_once "includes/footer.php"; ?>
      
      <!-- /#page-wrapper -->
   </div>
    <!-- /#wrapper -->
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
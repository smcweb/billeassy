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
$catid1=$_GET['catid'];

?>

<!DOCTYPE HTML>
<html>
<head>
<title>EasyBilling| Product:: Billing</title>
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

<!--Add Product-->
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
	 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	 <script type="text/javascript" src="mainScript.js"></script>

 <script>
 $(function(){
		//insert record
		$('#insert').click(function(){
			var jname = $('#addproductName').val();
			if(jname==''){
                alert('Please enter Product Name');
                return;
            }
			var jpriceaddWithoutMrpTax = $('#addWithoutMrpTax').val();
			var jpriceaddWithMrpTax = $('#addWithMrpTax').val();
			var jaddHSNCode = $('#addHSNCode').val();
			var jtax = $('#tax').val();
			var joffer = $('#offer').val();
			var jquantity=$('#addquantity').val();
			var catid= <?php echo $catid1 ; ?>;
			var shop=<?php echo $shopId; ?>;
			if(jquantity<=0)
			{
				alert('Please enter quantity greater than zero');
				return;
			}
			if(jpriceaddWithoutMrpTax<=0 || jpriceaddWithMrpTax<=0 )
			{
				alert('Please enter price greater than zero');
				return;
			}
			/* alert(catid); */
			//syntax - $.post('filename', {data}, function(response){});
			$.post('Insert_Data.php',{action: "insert", name:jname, priceWithoutMrpTax:jpriceaddWithoutMrpTax,priceWithMrpTax:jpriceaddWithMrpTax, quantity:jquantity,HSNCode:jaddHSNCode,category:catid,shopid:shop,offer:joffer,tax:jtax},function(res){
				 window.location.href='Add_Product.php?catid='+catid;
				alert('product is added');
			});		
		});
			
		/*for update product*/

		$('#update').click(function(){
			var jid = $('#productid').val();
            var jtax = $('#tax').val();
            var joffer = $('#offer').val();
			var jname = $('#addproductName').val();
            var jpriceaddWithoutMrpTax = $('#addWithoutMrpTax').val();
            var jpriceaddWithMrpTax = $('#addWithMrpTax').val();
            var jaddHSNCode = $('#addHSNCode').val();
            var jtax = $('#tax').val();
			var jquantity=$('#addquantity').val();
			var catid= <?php echo $catid1 ; ?>;
			if(jquantity<=0)
			{
				alert('Please enter quantity greater than zero');
				return;
			}
			if(jpriceaddWithoutMrpTax<=0)
			{
				alert('Please enter price greater than zero');
				return;
			}
			//alert(catid);
			//syntax - $.post('filename', {data}, function(response){});
            $.post('update_Data.php',{action: "update", name:jname, priceWithoutMrpTax:jpriceaddWithoutMrpTax,priceWithMrpTax:jpriceaddWithMrpTax, quantity:jquantity,HSNCode:jaddHSNCode,category:catid,offer:joffer,tax:jtax,prid:jid},function(res){

				 window.location.href='Add_Product.php?catid='+catid;
				alert('product is update');
			});		
		});
		
	});

    </script>
<!--Add Product-->
<!--dele_product-->
	<script src="jquery.js"></script>
<script type="text/javascript">
		$(function() 
		  {
			
		$(".delete").click(function(){
		var element = $(this);
		var del_id = element.attr("id");
			var catid=  element.attr("data-cat");
			//alert(catid)
	var info = 'id=' + del_id;
			//var catid=$catid1;
	if(confirm("Are you sure you want to delete this?"))
	{
		 $.ajax({
		   type: "POST",
		   url: "del_product.php",
		   data: info,
		   success: function(){
			   window.location.href='Add_Product.php?catid='+catid;
		 }
	});
	  $(this).parents(".show").animate({ backgroundColor: "#003" }, "slow")
	  .animate({ opacity: "hide" }, "slow");
	 }
return false;
});
});
</script>
	
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
         $('#addHSNCode').val(response[0].hsncode)
     
     },
     error: function (req, status, error) {
     }
     });
		}
	
	
</script>
<!--update Product-->
</head>
<body>
<div id="wrapper">
    <!-- Navigation -->
       <?php
           include_once "header.php";
	   ?>
	
        <div id="page-wrapper">
			<?php
	         include_once "top.php";
			  ?>
		<?php
		$maxval=mysqli_query($conn,"SELECT MAX(`pid`) AS Maxid FROM `tblproduct`");
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
                    <h4 class="panel-title">Add Product </h4>
                </div>
                <div class="panel-body">
                     
					 
             
            
						  <div class="form-group ">
							<div id="status_text">
                                <!--<label style="width: 90%;color:black" for="inputSuccess1" style="width: 90%;">Category</label>-->
                                <!--<label style="width: 90%;color:black" for="inputSuccess1" style="width: 90%;">Tax</label>-->
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
                                <!--<label style="width: 90%;color:black" for="inputSuccess1" style="width: 90%;">Offer</label>-->

                                <input type="text" placeholder=" CGST" class="form-control1" style="margin-left:;color:black" id="addCGST" name="addCGST">
                                <input type="text" placeholder=" SGST" class="form-control1" style="margin-left:;color:black" id="addSGST" name="addSGST">
                                <input type="hidden" placeholder=" Product Id" class="form-control1" style="margin-left:;color:black"  id="productid" name="pid" value="<?php echo $max;  ?>">
								<input type="text" placeholder=" Product Name" class="form-control1" style="margin-left:;color:black"  id="addproductName" onblur="pname()" name="addproductName" required>
<!--								<input type="text" placeholder=" Product Price" class="form-control1" style="margin-left:;color:black" id="addprice" name="addprice" >
-->								<input type="text" placeholder="MRP Without Tax" class="form-control1" style="margin-left:;color:black" id="addWithoutMrpTax" name="addWithoutMrpTax" onblur="calculateWithoutGst()">
                                <input type="text" placeholder=" MRP With Tax" class="form-control1" style="margin-left:;color:black" id="addWithMrpTax" name="addWithMrpTax" onblur="calculateWIthGst()"><h3 id="bar-id" style="display: none;font-size: 16px;color: red;margin: 4px;"></h3><i class="fa fa-refresh" style="    font-size: 19px; position: relative;margin: 0% 95%;color: skyblue;font-weight: bold;" onclick="restValue()"></i>
								<input type="text" placeholder=" Product Quantity" class="form-control1" style="margin-left:;color:black" id="addquantity" name="addquantity">
								<input type="text" placeholder=" Product HSN CODE" class="form-control1" style="margin-left:;color:black" id="addHSNCode" name="addHSNCode">

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
								  <input type="submit" class="btn btn-warning" name="submit"  id="insert" value="Add">
								   <input type="submit" class="btn btn-success" name="update"  id="update" value="Update">
						</div>
						</div>
	
	  

					
                </div>
				<hr>
				
				<br>
				<p><i style="font-size:12px">You can add your Product Policy here and update as per changes.We tried to make similarity with GST,thats why have already some Product policy,you can update when it will be changed.</i></p>
               
				<p><i style="font-size:12px">Software is feasible with these changes.</i><p>
<hr/>
			</div>
			<div class="col-md-6 stats-info">
                <div class="panel-heading">
                    <h4 class="panel-title">Product Report &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="category.php" style="float:right; color:red;">Back to Category </a> </h4>
                </div>
                <div class="panel-body">
                   <div class="bs-example1" data-example-id="contextual-table">
					   
					   
					     <div style="height: 300px; width: 100%;overflow: auto;">
					   
		    <table class="table">
				<form method="POST">
					 <div class="input-group">
					<input  class="form-control1 input-search" type="text"  id="txt_sreach" placeholder="Search By Product" name="txt_search">
					   <span class="input-group-btn"><button class="btn btn-success" type="submit" 	name="submit"><i class="fa fa-search"></i></button></span>
					</div>
				</form>
		      <thead>
		       <tr>
		        
		          <th style="color:black;text-align:center">Product Name</th>
		          <th style="color:black;text-align:center">Product Price</th>
				  <th style="color:black;text-align:center">Product Quantity</th>
		         
		        </tr>
		      </thead>
		      <tbody>
			 
		     
				  <?php
		  		 $catid1=$_GET['catid'];
								if(isset($_POST['txt_search']))
									{

                                        $search=$_POST['txt_search'];
                                        $search_result="";
                                        $query = "SELECT * FROM tblproduct WHERE pname LIKE '%$search%' AND catid='$catid1'";
                                        $search_result = mysqli_query($conn, $query);

                                    }
									 else
                                    {
                                        $search_result="";
                                        $query = "SELECT * FROM tblproduct WHERE  catid='$catid1'";
										
                                        $search_result = mysqli_query($conn, $query);

                                    }
									$sr=0;
 
								  while( $row = mysqli_fetch_array($search_result))
								  {
									  $sr++;
									  $id=$row['pid'];
									echo "<tr onclick='rowshow($id)' style='cursor:pointer;text-align:center;color:black'>";
									
									  echo "<td style='color:black'>".$row['pname']."</td>";
									echo"<td style='color:black'>".$row['price']."</td>";
									echo"<td style='color:black'>".$row['quantity']."</td>"; 
									?>
				  
				   <td>
					   <!--a href="#" id="<?php echo $row['pid']; ?>" class="trash">Del</a-->
					   <span class="action"> <a href="#" id="<?php echo $row['pid']; ?>" data-cat="<?php echo $catid1; ?>" class="delete"><i class="fa fa-trash-o iconsize" aria-hidden="true"></i></a></span>
				   </td>
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
</body>
</html>

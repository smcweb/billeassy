<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
include('config.php');
session_start();
$taxid=$_GET['taxid'];
// echo $_SESSION['username'];

if(!isset($_SESSION['username']))
{
    header('location:login.php');
}
else
{

    $uname = $_SESSION['username'];
	$id=$_SESSION['shopidu'];
    // echo "<script>alert('session mentain')</script>";
}

$shopId=$_SESSION['shopidu'];
//echo "<script> alert('$shopId');</script>";



if(isset($_POST['sub']))
{
	$category=$_POST['cat'];
    echo "<script>alert('$category')</script>";
	$product=$_POST['poductpoint'];
	if($category=='category'){
        echo "<script>alert('Select category')</script>";
    }elseif ($product=='poductpoint'){
        echo "<script>alert('Select Product')</script>";
    }else{
	$update=mysqli_query($conn,"UPDATE `tblproduct` SET `taxid`='$taxid' WHERE `pid`='$product'");
	if($update)
	{
		echo "<script>alert('Tax applied ')</script>";	
	}
	else{
		echo "<script>alert('update error ')</script>";	
	}
}
}


?>

<!DOCTYPE HTML>
<html>
<head>
    <title>EasyBilling| View Tax :: Billing</title>
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

	 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
   
 <script>
 
        function rowshow(id)
        {  
				
		   var taxid1 = <?php echo $taxid?>;
 localStorage.setItem("taxid", taxid1);
   
            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: 'taxupdate.php',
                async: false,
                data: {"id": id, "taxid": taxid1},
                success: function (response) {
					
					if(response=='Tax removed successfully')
                {
                    alert(response);  
				
                    var taxid=localStorage.getItem("taxid");
				alert(taxid);
                    window.location='view_Tax.php?taxid='+taxid;
                }
				else {
                        var taxid=localStorage.getItem("taxid");
                        window.location='view_Tax.php?taxid='+taxid;
					//alert('Tax removed successfully');
                    }
                },
                error: function (req, status, error) {
                }
            });
        }
   
 </script>
	
	
	
   <script>
	function getXMLHTTP() 
	   { //fuction to return the xml http object
		 var xmlhttp=false;	
		 try
		 {
		  xmlhttp=new XMLHttpRequest();
		 }
		catch(e)	
		{		
			try
			{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e)
			{
				try
				{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1)
				{
					xmlhttp=false;
				}
			}
		}
		return xmlhttp;
	   
	 }
		     function getpoduct(poduct)
        {
            // alert(zonename)
            //zonename is send findCatagory in the form of query string
            var strURL="productLoad.php?poduct="+poduct;

            var req = getXMLHTTP();

            if(req)
            {
                req.onreadystatechange = function()
                {
                    if (req.readyState == 4)
                    {
                        if (req.status == 200)
                        {

                            document.getElementById('poductpoint').innerHTML=req.responseText;
                            //document.getElementById('newprice').innerHTML=req.responseText;

                        }
                        else
                        {
                            alert("Problem while using XMLHTTP:\n" + req.statusText);
                        }
                    }
                }
                req.open("GET", strURL, true);
                req.send(null);
            }
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
                        <h4 class="panel-title">Assign Tax</h4>
                    </div>
                    <div class="panel-body">
                        <form action="" method="POST" >
							<div class="form-group ">                           
								  <select  class="form-control1" name="cat" id='cat' onchange='getpoduct(this.value)'>
                                    <option value="category">Select category</option>
                                    <?php

                                    $sql="SELECT  * FROM `tblcategory` where shopId='$id';";
                                    $query=mysqli_query($conn,$sql);
                                    while($row=mysqli_fetch_array($query))
                                    {
                                        $cat=$row['catName'];
                                        $catid=$row['catID'];
                                        ?>
                                        <option value="<?php echo $catid; ?>">
                                            <?php echo $cat; ?>
                                        </option>
                                    <?php } ?>
                                </select>
							<br/>
							
									   
							</div>
							<div class="form-group ">   
										<div id="poductpoint">

											<select class="form-control1" name="poductpoint">
												<option value="poductpoint">select Product</option>
											</select>
										</div>
							</div>
							 <input type="submit" class="btn btn-success" name="sub" value="Assign Tax"  />
							
                          
                           
                        </form>
                    </div>
                    <hr/>

                    <p><i style="font-size:12px"></i></p>

                    <p><i style="font-size:12px"></i><p>

                    <hr/>
                </div>
                <div class="col-md-6 stats-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">Product List&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="tax.php" style="float:right; color:red;">Back to tax </a> </h4>
                    </div>

                    <div class="panel-body">
                        <div class="bs-example1" data-example-id="contextual-table">



                            <form method="POST">
                                <div class="input-group">
                                    <input  class="form-control1 input-search"  type="text"  id="txt_sreach" placeholder="Search By Product" name="txt_search">
                                    <span class="input-group-btn">
					 <button class="btn btn-success" type="hidden" name="submit"><i class="fa fa-search"></i></button></span>
                                </div>
                                <!--input type="hidden" name="txt_search"-->
                            </form>





                            <div style="height: 300px; width: 100%;overflow: auto;">
                                <table class="table">

                                    <thead>
                                     <tr>
											
											<th style="color:black;text-align:center">Product Name</th>
											<th style="color:black;text-align:center">Product Price</th>
											
											<th style="color:black;text-align:center">Tax</th>
											<th style="color:black;text-align:center">Manage</th>
									</tr>
                                    </thead>

                                    <tbody>
                            <?php
							
								if(isset($_POST['txt_search']))
									{

                                        $search=$_POST['txt_search'];
                                        $search_result="";
                                        $query = "SELECT * FROM tblproduct WHERE pname LIKE '%$search%' ";
                                        $search_result = mysqli_query($conn, $query);

                                    }
									 else
                                    {
                                        $search_result="";
                                        $query = "SELECT tbltax.taxName,tblproduct.pid,tblproduct.pname,tblproduct.price,tblproduct.quantity,tblproduct.taxid,tblproduct.catid,tblproduct.offerid,tblproduct.shopid FROM `tblproduct` INNER JOIN tbltax ON tblproduct.taxid=tbltax.taxid WHERE tbltax.taxid='$taxid' ";
										
                                        $search_result = mysqli_query($conn, $query);

                                    }
                                    $sr=0;
								  while( $row = mysqli_fetch_array($search_result))
								  {
									  $sr++;
									  $id=$row['pid']; 
                                      
									echo "<tr style='text-align:center'>";
									 
									echo "<td style='color:black'>".$row['pname']."</td>";
									echo "<td style='color:black'>".$row['price']."</td>";

									echo "<td style='color:black'>".$row['taxName']."</td>";
									echo"<td onclick='rowshow($id)' style='cursor:pointer;'><i class='fa fa-trash-o iconsize' aria-hidden='true'></i></a></td>";
                                      				 
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
   <!--tax update script-->


   <!--tax update script-->
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

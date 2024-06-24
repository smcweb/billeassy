<?php 
include('config.php');

// echo $_SESSION['username'];

if(!isset($_SESSION['username']))
{	
	header('location:login.php');
}
else
{
	
	$uname = $_SESSION['username'];
	$shopid = $_SESSION['shopid'];
		// echo "<script>alert('session mentain')</script>";
}
$sql = "SELECT * FROM `shop` WHERE `shopid` = '$shopid'";
$query = mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$id=$row['id'];
   
   $shopid=$row['shopid'];
	
	
	$opassword=$row['password'];
	}
	if(isset($_POST['update']))
{
$cppassword=$_POST['cppassword'];
$ppassword=$_POST['ppassword'];
$id=$_SESSION['shopidu'];

 $sql="UPDATE `shop` SET `password`='$cppassword' WHERE `id`='$id'"; 
	$query = mysqli_query($conn,$sql);
	if(!$query)
	{
		echo "<script>alert('Updation Error')</script>";
	}
	else
	{
		
		echo "<script>alert('Password changed');</script>";
echo "<script>window.location.href('login.php');</script>";
	}
	
}

?>


<nav class="top1 navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Bill Easy</a>
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-nav navbar-right">
				
			    <li class="dropdown">
	        		<a href="#" class="dropdown-toggle avatar" data-toggle="dropdown"><img src="images/1.png"><span class="badge"></span></a>
					<li class="m_2"><a href="logout.php"><i class="fa fa-lock"></i> Logout</a></li>	
	        		<ul class="dropdown-menu">
						<!--li class="dropdown-menu-header text-center">
							<strong>Master</strong>
						</li>
						<li class="m_2"><a href="product.php"><i class="fa fa-bell-o"></i>Product<span class="label label-info">*</span></a></li>
						<li class="m_2"><a href="tax.php"><i class="fa fa-envelope-o"></i>Taxes  <span class="label label-success">*</span></a></li>
						
						<li><a href="offer.php"><i class="fa fa-comments"></i> Offer <span class="label label-warning">4*</span></a></li>
						<li class="dropdown-menu-header text-center">
							<strong>Settings</strong>
						</li>
						<li class="m_2"><a href="profile.php"><i class="fa fa-user"></i> Profile</a></li>
						<li class="m_2"><a href="#myModal"  data-toggle="modal" data-target="#myModal"><i class="fa fa-wrench"></i> Change Password</a></li-->						
						<li class="m_2"><a href="logout.php"><i class="fa fa-lock"></i> Logout</a></li>	
	        		</ul>
	      		</li>
			</ul>
			
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw nav_icon"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-laptop nav_icon"></i>Master<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
							 <li>
                                    <a href="category.php">Add Category</a>
                                </li>
                                
								 <li>
                                    <a href="tax.php">Add Tax</a>
                                </li>
								 <li>
                                    <a href="offer.php">Add Offer</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-indent nav_icon"></i>Our Product<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="product.php">Add Product</a>
                                </li>
                                <li>
                                    <a href="stock.php">Stock</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="offersearch.php"><i class="fa fa-envelope nav_icon"></i>Our Offers</a>
                            
                           
                        </li>
                        <li>
                            <a href="qutationHistory.php"><i class="fa fa-flask nav_icon"></i>Quotation</a>
                        </li>
                         
                        <li>
                            <a href="invoiceHistory.php"><i class="fa fa-table nav_icon"></i>Invoice</a>
                                                 
                        </li>
						 <li>
                            <a href="#"><i class="fa fa-table nav_icon"></i>Sales Report<span class="fa arrow"></span></a>
							 <ul class="nav nav-second-level">
                                <li>
                                    <a href="salesreport.php">Customer wise</a>
                                </li>
                                <li>
                                    <a href="salesreport_day.php">Day wise</a>
                                </li>
                            </ul>
                                                 
                        </li>
						<li>
                            <a href="phonebook.php"><i class="fa fa-table nav_icon"></i>Phonebook</a>
                                                 
                        </li>
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
		
		<!-- model start ---->
		   <!--div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								<h2 class="modal-title">Change Password</h2>
							</div>
							
				 <form role="form" class="form-horizontal" method="post">
  <div class="bs-example4" data-example-id="simple-responsive-table">
    <div class="table-responsive">
      <table class="table">				 
	
	    <tr><td>
	  	 <div class="form-group has-success">
		
      <input type="text" class="form-control1" value="<?php if(isset($opassword)){echo $opassword;}?>" placeholder="Enter password" name="ppassword" >
	  </div></td>
	  	<td> <div class="form-group has-success">
		 
      <input type="password" class="form-control1" placeholder="New Password" name="cppassword">
	  </div></td></tr>
	  <tr><td colspan="2">
      <button class="btn btn-lg btn-success1 btn-block" type="submit" name="update" >Change</button>
	  </td></tr>
	    <tr>
   
	  </tr></table></div></div>
	  
  </form>
                          
							
						</div>
					</div>
				</div-->
			<div class="clearfix"></div>
		</ul>
	</form>
	

  </div>
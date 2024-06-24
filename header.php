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
	$logo = $_SESSION['shologo'];
		// echo "<script>alert('session mentain')</script>";
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
                <a class="navbar-brand" href="index.php">Bill Easy</a>
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-nav navbar-right">
				
			    <li class="dropdown">
	        		<a href="#" class="dropdown-toggle avatar" data-toggle="dropdown"><img src="img/<?php echo $logo;?>"><span class="badge"></span></a>
					<li class="m_2" style="    margin: 11px 1px;"><a href="logout.php"><i class="fa fa-lock"></i> Logout</a></li>
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
                                    <a href="profile.php">Profile</a>
                                </li>
							 <li>
                                    <a href="category.php">Add Category</a>
                                </li>
                                
								 <li>
                                    <a href="tax.php">Add Tax</a>
                                </li>
								 <li>
                                    <a href="offer.php">Add Offer</a>
                                </li>
								 <li>
                                    <a href="allterms_condition.php">Add Terms & Condition</a>
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
                        <li>
                            <a href="#"><i class="fa fa-first-order"></i>Purchase Recorder<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="addGstBllUserAndSupplier.php">Add Purchase</a>
                                </li>
                                <li>
                                    <a href="salesreport.php">Customer wise</a>
                                </li>

                            </ul>

                        </li>
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
		
		
			<div class="clearfix"></div>
		</ul>
	</form>
	

  </div>
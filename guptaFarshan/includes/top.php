<div class="graphs">
     	<div class="col_3">
        	<div class="col-md-3 widget widget1">
        		<div class="r3_counter_box">
                   <a href="createInvoice.php"> <i class="pull-left fa fa-thumbs-up icon-rounded"></i></a>
                    <div class="stats">
                      <h5><strong>Billing </strong></h5>
                      <span><a href="createInvoice.php">Make Bill</a></span>
                    </div>
                </div>
        	</div>
        	<div class="col-md-3 widget widget1">
        		<div class="r3_counter_box">
                    <a href="phonebook.php">  <i class="pull-left fa fa-users user1 icon-rounded"></i></a>
                    <div class="stats">
                      <h5><strong>Phonebook</strong></h5>
						<?php 
						
				$shopid=$_SESSION['shopidu'];
$tdate=date('Y-m-d');
		$c=0;				
						$sql="SELECT count(`cid`) FROM `phonebook` && shopid='$shopid'";
$query=mysqli_query($conn,$sql);
if($query==True)
{
$row=mysqli_fetch_row($query);
$c=$row[0];
}						
						?>
                      <span><a href="phonebook.php">Count(<?php echo $c; ?>)</a></span>
                    </div>
                </div>
        	</div>
        	<div class="col-md-3 widget widget1">
        		<div class="r3_counter_box">
                  <a href="expences.php">    <i class="pull-left fa fa-comment user2 icon-rounded"></i></a>
                    <div class="stats">
                      <h5><strong>Expenses</strong></h5>
						<?php 
$tdate=date('Y-m-d');
$shopid=$_SESSION['shopidu'];
$e=0;
						$sql="SELECT sum(`exp_amount`) FROM tblexpences WHERE `exp_date`='$tdate' && shopid='$shopid'";
$query=mysqli_query($conn,$sql);
if($query==True)
{
$row=mysqli_fetch_row($query);
$e=$row[0];
}
						
						?>
                      <span><a href="expences.php">Today <?php echo $e; ?></span>
                    </div>
                </div>
        	</div>
        	<div class="col-md-3 widget">
        		<div class="r3_counter_box">
                   <a href="payment.php">  <i class="pull-left fa fa-dollar dollar1 icon-rounded"></i></a>
                    <div class="stats">
                      <h5><strong>Collection</strong></h5>
						<?php 
$tdate=date('Y-m-d');
$shopid=$_SESSION['shopidu'];
$co=0;
						$sql="SELECT sum(`paid`)  FROM  tbltransaction WHERE `tdate`='$tdate' && shopid='$shopid'";
$query=mysqli_query($conn,$sql);
if($query==True)
{
$row=mysqli_fetch_row($query);
$co=$row[0];
}				
						?>
                      <span><a href="payment.php">Today <?php echo $co; ?></a></span>
                    </div>
                </div>
        	 </div>
        	<div class="clearfix"> </div>
      </div>
     
	<!--  <div class="span_11">
		<div class="col-md-6 col_4">
		  <div class="map_container"><div id="vmap" style="width: 100%; height: 400px;"></div></div>
		  <!----Calender -------->
			<link rel="stylesheet" href="css/clndr.css" type="text/css" />
			<script src="js/underscore-min.js" type="text/javascript"></script>
			<script src= "js/moment-2.2.1.js" type="text/javascript"></script>
			<script src="js/clndr.js" type="text/javascript"></script>
			<script src="js/site.js" type="text/javascript"></script>
			<!----End Calender -------->
		</div>
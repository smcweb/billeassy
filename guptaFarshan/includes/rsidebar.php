   <?php  
				$shopid=$_SESSION['shopidu'];?>
		 <div class="col_2">
		  <div class="box_1">
		   <div class="col-md-6 col_1_of_2 span_1_of_2">
             <a class="tiles_info">
			    <div class="tiles-head red1">
			        <div class="text-center">Invoice</div>
			    </div>
				 <?php 
$tdate=date('Y-m-d');
$shopid=$_SESSION['shopidu'];
						$sql="SELECT count(`tid`) FROM  tbltransaction WHERE `tdate`='$tdate' && shopid='$shopid'";
$query=mysqli_query($conn,$sql);
$row=mysqli_fetch_row($query);
$i=$row[0]; ?>
			    <div class="tiles-body red"><?php echo $i; ?></div>
			 </a>
		   </div>

		   <div class="col-md-6 col_1_of_2 span_1_of_2">
              <a class="tiles_info tiles_blue">
			    <div class="tiles-head tiles_blue1">
			        <div class="text-center">Quotation</div>
			    </div>
				  <?php 
$tdate=date('Y-m-d');
$shopid=$_SESSION['shopidu'];
						$sql="SELECT count(`qid`) FROM  tblquotation WHERE `tdate`='$tdate' && shopid='$shopid'";
$query=mysqli_query($conn,$sql);
$row=mysqli_fetch_row($query);
$q=$row[0]; ?>
			    <div class="tiles-body blue1"><?php echo $q; ?></div>
			  </a>
		   </div>
		   <div class="clearfix"> </div>
		 </div>
		 <div class="box_1">
		   <div class="col-md-6 col_1_of_2 span_1_of_2">
             <a class="tiles_info">
			    <div class="tiles-head fb1">
			        <div class="text-center">Offers</div>
			    </div>
				 <?php
$tdate=date('Y-m-d');
$shopid=$_SESSION['shopidu'];
$sql="SELECT count(`offerid`) FROM   tbloffer WHERE `validDate`>='$tdate' && shopid='$shopid'";
$query=mysqli_query($conn,$sql);
$row=mysqli_fetch_row($query);
if($row)
{
$ofr=$row[0];
}?>
			    <div class="tiles-body fb2"><?php echo $ofr; ?></div>
			 </a>
		   </div>
		   <div class="col-md-6 col_1_of_2 span_1_of_2">
              <a class="tiles_info tiles_blue">
			    <div class="tiles-head tw1">
			        <div class="text-center">Profit</div>
			    </div>
				   <?php 
$tdate=date('Y-m-d');
$i=0; 
$shopid=$_SESSION['shopidu'];
$e=0;
					$sql="SELECT sum(`exp_amount`) FROM tblexpences WHERE `exp_date`='$tdate'";
$query=mysqli_query($conn,$sql);
if($query)
{
$row=mysqli_fetch_row($query);
$e=$row[0];
}
$tdate=date('Y-m-d');
						$sql="SELECT sum(`paid`) FROM  tbltransaction WHERE `tdate`='$tdate'";
$query=mysqli_query($conn,$sql);
if($query)
{
$row=mysqli_fetch_row($query);
$i=$row[0]; 
}
		$p=$i-$e;		  ?>
			    <div class="tiles-body tw2"><?php echo $p; ?></div>
			  </a>
		   </div>
		   <div class="clearfix"> </div>
		   </div>
		  </div>
		  <div class="cloud">
			<div class="grid-date">
				<div class="date">
					<p class="date-in"></p>
					<span class="date-on">°F °C </span>
					<div class="clearfix"> </div>							
				</div>
				<h4>30°<i class="fa fa-cloud-upload"> </i></h4>
			</div>
			   <?php 
$tdate=date('Y-m-d'); 
			  $tday=date('l')?>
			<p class="monday"><?php echo $tday." "; echo $tdate;?></p>
		  </div>
		     <div class="clearfix"> </div>
		
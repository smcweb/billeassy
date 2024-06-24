<?php session_start(); 

//$db=$_SESSION['bpname'];
 include_once 'config.php';

 $strcat= $_GET['poduct']; ?>
      <select  class="form-control1"  name="poductpoint" id="pname-id">		
			         <?php  
 echo $sql="SELECT `pid`,`pname` FROM `tblproduct` WHERE `catid`='$strcat'";
        $query=mysqli_query($conn,$sql);
    
while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
{
  $pid=$row['pid'];
$pname=$row['pname'];
 ?>
							<option value="<?php echo $pid; ?>">
			                    <?php echo $pname; ?>
			                 </option>
			                <?php } ?>
							</select>


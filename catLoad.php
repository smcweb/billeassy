<?php session_start(); ?>
<?php
//$db=$_SESSION['bpname'];
 include_once 'config.php';

$strProName= $_GET['catName'];

?>
<style>
    .ak{
        margin-left:5%;
        width:90%;
    }
</style>

	<select  name="txt_product" id="txt_productName" class="dropbtn"  onchange="addProductDaynmicFun();" style="width: 135px;
    height: 36px;">
		<option value="">select Product</option>
        <?php
         include_once 'config.php';
        $query="SELECT * FROM `tblproduct` WHERE `catid`='$strProName'";
        $record=mysqli_query($conn,$query);
    
        ?>

        <?php while ($row=mysqli_fetch_array($record))
        {      $productName=$row['pname'];
 echo "<script>alert('$productName')</script>"; ?>
            <option value="<?php echo $productName ?>"><?php echo $row['pname']?></option>
        <?php } ?>


    </select>




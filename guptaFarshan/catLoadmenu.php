<?php
//$db=$_SESSION['bpname'];
include('config.php');
session_start();
// echo $_SESSION['username'];

// echo $_SESSION['username'];
/*
if(!isset($_SESSION['username']))
{
    header('location:login.php');
}
else
{

    $uname = $_SESSION['username'];
    // echo "<script>alert('session mentain')</script>";
}
*/

$strProName= $_GET['catName'];

?>
<style>
    .ak{
        margin-left:5%;
        width:90%;
    }
</style>
<div >
    <select class="dropbtn" id="txt_productName1"  name="txt_product" style="width: 18%;position: absolute;top: 482px;right: 389px;height: 42px;border: 1px solid #fff !important;border-radius: 0px !important;box-shadow: none;" onchange="newFunChangeProduct()" required >
        <?php
        include_once 'config.php';
        $query="SELECT * FROM `tblproduct` WHERE `catid`='$strProName'";
        $record=mysqli_query($conn,$query);

        ?>

        <?php while ($row=mysqli_fetch_array($record))
        {      $productName=$row['pname'];
		 ///echo "<script>alert('$productName')</script>"; ?>
            <option value="<?php echo $productName ?>"><?php echo $row['pname']?></option>
        <?php } ?>


    </select>
</div>



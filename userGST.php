<?php session_start();
if(!isset($_SESSION['login_user'])){
    header("Location:index.php");
    exit();
}

$_SESSION['login_expire'] = time();

if(!isset($_SESSION['expire']))
{
    $_SESSION['expire'] = $_SESSION['login_expire'] + (30 * 60) ;
}
$now = time();

if($now > $_SESSION['expire'])
{
    session_destroy();

    echo"<script>window.location.href='http://broadbandwale.in/admin/index.php'</script>";
    $msgExpire='Your session has expire';
}else{
    //$_SESSION['expire']=
    $_SESSION['login_user'];
}

include_once "config.php";
if(isset($_POST['ADD-GST'])){
    $userName = $_POST['txt_id'];
    $usertxt_GSTNum = $_POST['txt_GSTNum'];
    $usertxt_CGST = $_POST['txt_CGST'];
    $usertxt_SGST = $_POST['txt_SGST'];
    $usertxt_statusid = $_POST['status-id'];

   $query = "UPDATE `tblbrodbandprovider` SET `cgst`='$usertxt_CGST',`sgst`='$usertxt_SGST',`gstNumber`='$usertxt_GSTNum',taxstatus='$usertxt_statusid' WHERE `strBPId`='$userName'";

    $query_run = mysqli_query($con, $query);

// $retval=mysql_query($query,$conn)#CDDC39;
    if ($query_run) {
        echo "<script>alert('record updated ')</script>";
        echo "<script>window.location.href='profile.php'</script>";
    } else {
        echo "<script>alert('record NOt updated ')</script>";
        echo "<script>window.location.href='profile.php'</script>";
    }
}
?>
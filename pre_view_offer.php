<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php include_once "config.php";
$offerid=$_GET['offerid'];
/*if(isset($_POST['sub']))
{
	$category=$_POST['cat'];
	$product=$_POST['poductpoint'];
	$offer=mysqli_query($conn,"SELECT * FROM `tblproduct` WHERE `pid`='$product'");
	while($r=mysqli_fetch_array($offer))
	{
		$ofid=$r['offerid'];
	}
		//echo "<script>alert('$offerid')</script>";	
	//echo "<script>alert('$ofid')</script>";	
			
	if($ofid==1)
	{
		$update=mysqli_query($conn,"UPDATE `tblproduct` SET `offerid`='$offerid' WHERE `pid`='$product'");
			if($update)
			{
				echo "<script>alert('offer assign ')</script>";	
			}
			else
			{
				echo "<script>alert('update error ')</script>";	
			}
		
	}
	else	
	{
		
			
			
			
	}	
}*/



?>
<!DOCTYPE HTML>
<html>
<head>
    <title>BillEasy | Phonebook :: Bill Easy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Modern Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>
    <!----webfonts--->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
    <!---//webfonts--->
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
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
    include('header.php');?>
    <!-- Navigation -->
    <div id="page-wrapper">
        <?php
       include('top.php');
        ?>
  
 <div class="xs">
 <h3>offers</h3>	</div>
            <div class="col-md-4 email-list1">
                <div class="mailbox-content">
                    <div class="mail-toolbar clearfix">
                        <div class="float-left">

                            <!--  <form method="post" action="">--->
                            <div class="dropdown">
                                <select  class="form-control1" name="cat" id='cat' onchange='getpoduct(this.value)'>
                                    <option>Select category</option>
                                    <?php

                                    $sql="SELECT  * FROM `tblcategory` ;";
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
                                <br><br><br>

                                <div id="poductpoint">

                                    <select class="form-control1" name="poductpoint">
                                        <option value="poductpoint">select Product</option>
                                    </select>
                                </div>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                        <div class="float-right">


                            <br> <br>

                            <div class="btn-group">
                                <input type="submit" class="btn btn-success name" name="sub" value="Add Offer" onclick="updateOfferWhenUserConfirm()" >

                            </div>
                        </div>



                    </div>
                </div>
	</div>
	
   
     
  <div class="col-md-8 inbox_right">
                <!--</form>-->
                <table class="table">
                    <form method="POST" >
                        <div class="input-group">
                            <input  name="search" class="form-control1 input-search" type="text"  id="txt_sreach" placeholder="Search By Product" name="txt_search">
    
              <button class="btn btn-success" type="submit" name="submit"><i class="fa fa-search"></i></button>
                   </div>
				   </form>


                    <thead>
                    <tr>
                        <th>Sr. No.</th>
                        <th>Id</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Product Quantity</th>
                        <th>Offer</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>

                    <form method="POST">
                        <?php
                        if(isset($_POST['txt_search']))
                        {

                            $search=$_POST['txt_search'];
                            $search_result="";
                            $query = "SELECT * FROM `tblproduct` WHERE pname LIKE '%$search%' ";
                            $search_result = mysqli_query($conn, $query);

                        }
                        else
                        {
                            $search_result="";
                            $query = "SELECT `pid`,`pname`,`price`,`quantity`,`offername` FROM `tbloffer`,`tblproduct` where `tbloffer`.`offerid`='$offerid' && `tblproduct`.`offerid`='$offerid'";
                            $search_result = mysqli_query($conn, $query);

                        }
                        $sr=0;
                        while( $row = mysqli_fetch_array($search_result))
                        {$sr++;
                            if(isset($row['offername'])) {
                                $offername = $row['offername'];
                            }else{$offername="no offer";}
                            echo"<tr>";
                            echo "<td>".$sr."</td>";

                            echo "<td>".$row['pid']."</td>";
                            echo "<td>".$row['pname']."</td>";
                            echo"<td>".$row['price']."</td>";
                            echo"<td>".$row['quantity']."</td>"; ?>
                            <td> <?php if(isset($offername)){ echo $offername;}?></td>

                            <td>
                            <a href="offer_cancel.php?pid=<?php echo $row['pid'] ?>"> <i class="fa fa-trash-o iconsize" aria-hidden="true"></i></a>
                            </td><?php
                            echo"</tr>";
                        }
                        ?>

                    </form>

                    </tbody>
                </table>

	</div>
	  </div>
        <div class="clearfix"> </div>

</div>
    <?php
    include('includes/footer.php');
    ?>
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- Nav CSS -->

<script>
    function updateOfferWhenUserConfirm(){
        var catid = document.getElementById('cat').value
        var pid = document.getElementById('pname-id').value
        var offerid1 = <?php echo $offerid?>;
        localStorage.setItem("offerid", offerid1);
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: 'updateOfferwhenUserwants.php',
            async: false,
            data: {"catid": catid,"pid": pid,"offerid":offerid1},
            success: function (response) {
                if(response=='this offer is already assign')
                {
                    alert(response);
                    //  localStorage.("offerid", offerid1);
                    var offerid=localStorage.getItem("offerid");
                    window.location.href='view_offer.php?offerid='+offerid;
                }
                if (response == 'alerdy exit') {
                    var row = confirm('are you sure to change offer')
                    if (row == true) {
                        var catid = document.getElementById('cat').value
                        var pid = document.getElementById('pname-id').value
                        var offerid1 = <?php echo $offerid?>;
                        $.ajax({
                            type: "POST",
                            dataType: "JSON",
                            url: 'updatechangeOffer.php',
                            async: false,
                            data: {"catid": catid, "pid": pid, "offerid": offerid1},
                            success: function (response) {
                                var offerid=localStorage.getItem("offerid");
                                window.location.href='view_offer.php?offerid='+offerid;
                            },
                            error: function (req, status, error) {
                            }
                        });
                    }
                    else {
                        var offerid=localStorage.getItem("offerid");
                        window.location.href='view_offer.php?offerid='+offerid;
                    }
                }

            },
            error: function (req, status, error) {
                //alert(req);

            }
        });


    }
</script>
<link href="css/custom.css" rel="stylesheet">
<!-- Metis Menu Plugin JavaScript -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
include('config.php');
session_start();
// echo $_SESSION['username'];

if(!isset($_SESSION['username']))
{
    header('location:login.php');
}
else
{

    $uname = $_SESSION['username'];
    // echo "<script>alert('session mentain')</script>";
}
$shopid=$_SESSION['shopidu'];
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>EasyBilling| Quotation History :: Billing</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
</head>
<body>
<div id="wrapper">
    <!-- Navigation -->
    <?php
    include_once "header.php"
    ?>

    <div id="page-wrapper">
        <?php
        include_once "top.php"
        ?>


        <div class="content_bottom">
            <div class="col-md-12 span_3">
                <div class="bs-example1" data-example-id="contextual-table">


                    <form method="POST">
			  <a href="terms_condition.php" class="btn btn-info" style="float: right;margin-right: 169px;">Add Terms & Condition</a>  

                    </form>

                    <div style="height: 300px; width: 100%;overflow: auto;">

                        <table class="table">
                            <thead>
                            <tr>
                                <th style="color:black;align:center;width: 340px;">Terms & Condition</th>
                                
                                <th style="color:black;align:center;width: 340px;">Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="active">
                            </tr>

                            <?php
                           $sql="SELECT * FROM `terms_condition`";
						
					   $record = mysqli_query($conn,$sql);
					  
					   
			while ($row = mysqli_fetch_array($record)) 
			{
				 $id=$row['id'];
			 $terms_condition=$row['terms_condition'];
                          
                                echo"<tr style='color:black;align:center'>";
                                echo "<td  style='color:black'>".$row['terms_condition']."</td>";
                               
                                ?>
        <td><a class="confirmationn" href="edit_terms_condition.php?id=<?php echo $id;?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
		<a class="confirmationn" href="delete_terms_condition.php?id=<?php echo $id;?>"><i class='fa fa-trash-o iconsize ' aria-hidden='true'></i></a>
		</td>
     <?php
          echo"</tr>";
           }
          ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
	   
		  <!--<div class="col-md-4 span_4">
	<?php include('includes/rsidebar.php');?>
	 	</div>-->
            <div class="clearfix"> </div>
        </div>
		</div>
        <?php
        include_once "footer.php" ?>
    </div>
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript">

        $('.confirmation').on('click', function () {

            return confirm('Are you confirm to delete a Record');

        });

		

    </script>
</body>
</html>

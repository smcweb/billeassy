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
$shopId=$_SESSION['shopidu'];
$catid1=$_GET['catid'];
 
if(isset($_POST['but_upload'])){
   $maxsize = 524288000; // 5MB
    ini_set('upload_max_filesize', '400M');
    ini_set('post_max_size', '40M');
    ini_set('max_input_time', 300);
    ini_set('max_execution_time', 300);
   if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ''){
       $name = $_FILES['file']['name'];
       $target_dir = "videos/";
       $target_file = $target_dir . $_FILES["file"]["name"];

       // Select file type
       $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

       // Valid file extensions
       $extensions_arr = array("mp4","avi","3gp","mov","mpeg");

       // Check extension
       if( in_array($extension,$extensions_arr) ){
 
          // Check file size
          if(($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {
             $_SESSION['message'] = "File too large. File must be less than 5MB.";
          }else{
             // Upload
             if(move_uploaded_file($_FILES['file']['tmp_name'],$target_file)){
               // Insert record
               $query = "INSERT INTO videos(name,location) VALUES('".$name."','".$target_file."')";
                  //echo $query ;
				  //exit();
               mysqli_query($conn,$query);
               $_SESSION['message'] = "Upload successfully.";
             }
          }

       }else{
          $_SESSION['message'] = "Invalid file extension.";
       }
   }else{
       $_SESSION['message'] = "Please select a file.";
   }
   header('location: index.php');
   exit;
} 
?>
<!doctype html> 
<!doctype html>
<html>
  <head>
    <title>Upload and Store video to MySQL Database with PHP</title>

  </head>
  <body>
    <div>
 
     <?php
     $fetchVideos = mysqli_query($conn, "SELECT * FROM videos ORDER BY id DESC");
     while($row = mysqli_fetch_assoc($fetchVideos)){
       $location = $row['location'];
       $name = $row['name'];
      

     }
     ?>
 
    </div>
 <video controls controlsList="nodownload">
        <source src="<?php echo $location;?>" type="video/mp4">
    </video>
  </body>
</html>
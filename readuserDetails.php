<?php
include_once 'config.php';
if(!empty($_POST["keyword"])) {

    $search=$_POST["keyword"];
$query ="SELECT * FROM `phonebook` WHERE `name`  LIKE '%$search%' or `phonenumber` LIKE '%$search%'";
 $recordSelect=mysqli_query($conn,$query);
if(!empty($recordSelect)) {
    ?>
    <ul id="country-list">
        <?php
        foreach($recordSelect as $usr_registration) {
            ?>
            <li onClick="selectCountry('<?php echo $usr_registration["name"]; ?>');"><?php echo $usr_registration["name"]; ?></li>
        <?php } ?>
    </ul>
<?php } } ?>
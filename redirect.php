<?php 
$random_str = $_GET['key'];
require_once('models/database.php');
$db = db_connect();
//$query = ;
$select = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM short WHERE random_str='".$random_str."'"));
echo $select['url'];
header("Location: ".$select['url']);
?>
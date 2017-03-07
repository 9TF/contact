<?php
require_once '../includes/secure.inc.php';
$user_name = $_SESSION['user_name'];
if(isset($_POST['add'])){
$name = $_POST['name'];
$number = $_POST['number'];
$email = $_POST['email'];
$query = "insert into contacts values('$user_name','$name','$number','$email','','','','','')";
require_once '../includes/db.inc.php';
@mysql_query($query) or die('query not run') ;
}
header('location:index.php');

?>

<?php
require_once '../includes/secure.inc.php';
$user_name = $_SESSION['user_name'];
If(isset($_POST['groups']))
{
  $group_name = $_POST['group_name'];
  $query = "insert into groups values('$group_name','$user_name')";
  require_once '../includes/db.inc.php';
  mysql_query($query);
  header('location:index.php');
}

?>


<?php
require_once '../includes/secure.inc.php';
$number = $_GET['number'];
$group = $_GET['group'];
$user_name = $_SESSION['user_name'];
$query = "delete from contacts where number=$number and user_name='$user_name'";
require_once '../includes/db.inc.php';
mysql_query($query);
if(!empty($group)){
    
 header('location:show_group.php?group=echo $group;');   
}else{
header('location:index.php');
}
         ?>
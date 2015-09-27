<?php
// Connect to Mongo 
$mongo = new Mongo();
//select database
$db = $mongo->myfiles;
     
$collection = $db->userlist;

$request = $_GET['id'];
$del=$collection->remove(array('_id'=>new MongoID ($request) ));;

header('Location: adminpanel.php');    
?>

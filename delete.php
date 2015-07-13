<?php
// Connect to Mongo 
$mongo = new Mongo();
//select database
$db = $mongo->myfiles;
     
// GridFS
$gridFS = $db->getGridFS();     


$request = $_GET['id'];
$del=$gridFS->remove(array('_id'=>new MongoID ($request) ));

header('Location: userWS.php');    
?>

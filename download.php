<?php
// Connect to Mongo 
$mongo = new Mongo();
//select database
$db = $mongo->myfiles;
     
// GridFS
$gridFS = $db->getGridFS();     


$request = $_GET['id'];
$file=$gridFS->findOne(array('_id' => new MongoID ($request) ));

$filename=$file->getFilename();


    header('Content-Type: image/bmp');
    header('Content-Disposition: attachment; filename='.$filename);




ob_clean(); 
   echo $file->getBytes(); 
?>

<?php
// Connect to Mongo 
$mongo = new Mongo();
//select database
$db = $mongo->myfiles;
     
// GridFS
$gridFS = $db->getGridFS();     


$request = $_GET['file'];
$file=$gridFS->findOne($request);

//header ("Content-type: octet/stream");
//header ("Content-disposition: attachment; filename=".$file.";");
//header("Content-Length: ".filesize($file));
    header('Content-Type: image/bmp');
    header('Content-Disposition: attachment; filename='.$request);
//readfile($file);
//exit;



ob_clean(); 
   echo $file->getBytes(); 
?>

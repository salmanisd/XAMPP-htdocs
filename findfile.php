<?php


$request=$_POST['filename'];
echo "Searched for ".$request;

// Connect to Mongo 
$mongo = new Mongo();

//select database
$db = $mongo->myfiles;


//select connection
//$collection=$db->hiwicollection;     

// GridFS
$gridFS = $db->getGridFS();     


$file=$gridFS->findOne($request);
print_r ($file);

if ($file!=NULL)
{

  
    header('Content-Type: image/bmp');
    header('Content-Disposition: attachment; filename='.$request);
  //  header('Content-Transfer-Encoding: binary');
 ob_clean(); 
   echo $file->getBytes(); 

}

else
{
echo "No file Found";

}
?>

<?php
// Connect to Mongo and set DB and Collection
$mongo = new Mongo();
$db = $mongo->myfiles;     

// GridFS
$gridFS = $db->getGridFS();     

// Find image to stream
$image = $gridFS->findOne('Becker_Die Grundsätze ordnungsmäßiger Modellierung und ihre Einbettung in ein Vorgehensmodell zur Erstellung betrieblicher Informationsmodelle.pdf');

// Stream image to browser
header('Content-type: image/jpeg');
echo $image->getBytes();

?>

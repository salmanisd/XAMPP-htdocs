<?php

// Connect to Mongo and set DB and Collection
$mongo = new Mongo();
$db = $mongo->myfiles;

// GridFS
$grid = $db->getGridFS();

// The file's location in the File System
$path = 'C:/xampp/htdocs/';

$filename = 'Becker_Die Grundsätze ordnungsmäßiger Modellierung und ihre Einbettung in ein Vorgehensmodell zur Erstellung betrieblicher Informationsmodelle.pdf';

// Note metadata field & filename field
$storedfile = $grid->storeFile($path . $filename,
             array("metadata" => array("filename" => $filename),
             "filename" => $filename));


// Return newly stored file's Document ID
echo $storedfile;

?>

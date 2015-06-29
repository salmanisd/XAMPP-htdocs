<?php 

echo "Testing Mongodb";

//select database
$connection = new Mongo();

//
$dbname = $connection->selectDB('testdatabase');


//select collection in db "testdatabase"
$collection = $dbname->selectCollection('Test Collection');


// add a record
$document = array( "title" => "Experimenting", "author" => "Salman Ahmed" );
$collection->insert($document);


// find everything in the collection
$cursor = $collection->find();

// iterate through the results
foreach ($cursor as $document) {
    echo $document["title"] . "\n";
}
?>

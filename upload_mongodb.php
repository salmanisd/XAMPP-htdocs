<?php
session_start();
$target_dir = "user_uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


// Connect to Mongo 
$mongo = new Mongo();

//select database
$db = $mongo->myfiles;


//select connection
//$collection=$db->hiwicollection;     

// GridFS
$gridFS = $db->getGridFS();     
$id=$gridFS->storeUpload('fileToUpload', array('username' => $_SESSION["username"]));

 echo $id;





// Check if image file is a actual image or fake image

/*if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}*/
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
/*
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}}*/


?>


<html>
<head>

<title>Uploading Complete</title>
</head>
<body>
<h2>Uploaded File Info:</h2>
<ul>
<li>Sent file: <?php echo $_FILES['fileToUpload']['name'];  ?>
<li>File size: <?php echo $_FILES['fileToUpload']['size'];  ?> bytes
<li>File type: <?php echo $_FILES['fileToUpload']['type'];  ?>
<h2>List of Files in Database:</h2>
<?php
 $cursor = $gridFS->find(); 
$SerialNumber=1;
    foreach ($cursor as $obj)// iterate through the results
 {                   
	
        echo $SerialNumber.') '.'Filename: '.$obj->getFilename().' Size: '.$obj->getSize().'<br/>';
	$SerialNumber++;
    }





?>




</ul>
</body>
</html>

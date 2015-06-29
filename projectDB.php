

<?php 

session_start();
$username = $_SESSION["username"];
$password = $_SESSION["password"];

// Connect to Mongo 
$mongo = new Mongo();

//select database
$db = $mongo->myfiles;


//select connection
$collection=$db->userlist;  

$user = $collection->findOne(array('user'=> $username, 'password'=> $password));

?>

<!DOCTYPE html>
<html>
<body>

<head>
<style>
#header {
    background-color:black;
    color:white;
    text-align:center;
    padding:5px;
}
#nav {
    line-height:30px;
    background-color:#eeeeee;
    height:300px;
    width:150px;
    float:left;
    padding:5px;	      
}
#section {
    width:350px;
    float:left;
    padding:10px;	 	 
}
#footer {
    background-color:black;
    color:white;
    clear:both;
    text-align:center;
   padding:5px;	 	 
}
</style>
</head>


<div id="header">
<h1>

<?php


if ($user)
//print_r($user);
//var_dump($user["user"]);
echo "Welcome ".$user['user'];
else
exit("Invalid username/password");
?></h1>
</div>

<div id="nav">
<a href="index.php">Project Workspace</a><br><br>
<a href="login.php">User Workspace</a><br><br>
Logout<br><br>
</div>

<div id="section">
<h2>Project Database</h2>

<?php
//select database
$db = $mongo->myfiles;
// GridFS
$gridFS = $db->getGridFS();   
 $cursor = $gridFS->find(); 
$SerialNumber=1;
    foreach ($cursor as $obj)// iterate through the results
 {                   
	
        echo $SerialNumber.') '.'Filename: '.$obj->getFilename().' Size: '.$obj->getSize().'<br/>';
	$SerialNumber++;
    }





?>

<form action="upload_mongodb.php" method="post" enctype="multipart/form-data">
    Select file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload File" name="submit">
</form>

<form action="findfile.php" method="post" enctype="multipart/form-data">
  Search Database:
    <input type="text" name="filename" id="filename"><br> 
    <input type="submit" value="Search" name="submit">
</form>

<a href="findfile.php">Download</a>

<p>

</p>

</div>

<div id="footer">

</div>






</body>
</html>

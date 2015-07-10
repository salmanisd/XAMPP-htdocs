
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
<a href="projectDB.php">Project Workspace</a><br><br>
<a href="userWS.php">User Workspace</a><br><br>
Logout<br><br>
</div>
<a href='download.php'>(Test.pdf)</a>
<div id="section">
<h2>User Workspace</h2>

<?php
//select database
$db = $mongo->myfiles;

// search for user files
$userfiles = array('username' => $_SESSION["username"]);
// GridFS
$gridFS = $db->getGridFS();  
$collection = $db->fs->files; 
$cursor = $gridFS->find($userfiles);

$SerialNumber=1;

    foreach ($cursor as $obj)// iterate through the results
 {                   

$idd=$obj->file['_id'] ;
//echo $idd;

 //var_dump($obj);
echo "<a href=download.php?id=".$idd.">Download</a> ";

        echo $SerialNumber.') '.'Filename: '.$obj->getFilename().' Size: '.$obj->getSize().'<br/>';
	$SerialNumber++;
    }



?>



<p>

</p>

</div>

<div id="footer">

</div>






</body>
</html>

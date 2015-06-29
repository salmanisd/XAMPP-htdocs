<?php 


$username = $_POST['user_name'];
$password = $_POST['user_password'];

// Connect to Mongo 
$mongo = new Mongo();

//select database
$db = $mongo->myfiles;


//select connection
$collection=$db->userlist;  

$user = $collection->findOne(array('user'=> $username, 'password'=> $password));
if ($user)
//print_r($user);
//var_dump($user["user"]);
echo "Welcome ".$user['user'];
else
exit("Invalid username/password");
?>

<!DOCTYPE html>
<html>
<body>

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

</body>
</html>

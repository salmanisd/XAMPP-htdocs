

<?php 

session_start();
$_SESSION["username"] =$_POST['user_name'];
$_SESSION["password"] = $_POST['user_password'];

// Connect to Mongo 
$mongo = new Mongo();

//select database
$db = $mongo->myfiles;


//select connection
$collection=$db->userlist;  

$user = $collection->findOne(array('user'=> $_SESSION["username"], 'password'=> $_SESSION["password"]));

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

<div id="section">
<h2>Project Database</h2>


<div id="footer">

</div>






</body>
</html>
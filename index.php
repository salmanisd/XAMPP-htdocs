<?php

session_start();
$_SESSION["username"] =$_POST['user_name'];
$_SESSION["password"] = $_POST['user_password'];

if (!$_SESSION["username"])
exit ("Please Login");

// Connect to Mongo 
$mongo = new Mongo();//
//select database
$db = $mongo->myfiles;
//select connection
$collection=$db->userlist;  
$user = $collection->findOne(array('user'=> $_SESSION["username"], 'password'=> $_SESSION["password"]));
if ($user==0)
//print_r($user);
//var_dump($user["user"]);

exit("Invalid username/password");
?>

<!doctype html>

<html>
<head>
   <meta charset="UTF-8">
   <link rel="shortcut icon" href="./.favicon.ico">
   <title>Database</title>

   <link rel="stylesheet" href="./.style.css">
   <script src="./.sorttable.js"></script>
</head>

<?php echo '<div style="Color:red">'.$_SESSION["username"].'->User Workspace'.'</div>';
header('Location: projectDB.php'); 

?>


<body>

<div id="container">


	<div id="nav">

<head>
<style type="text/css">

   a:hover {color:#B00}
   a:link  {color:blue}
li {
    display: inline;
}
</style>
</head>
<body>

<ul>

   <li><a href="projectDB.php">Project Workspace |</a></li>
  <li><a href="userWS.php">User Workspace |</a></li>
  <li><a href="/js/default.asp">Logout |</a></li>
</ul>

</body>


</div>
	

	<table class="sortable">
	    <thead>
		<tr>
			<th>Filename</th>
			<th>Type</th>
			<th>Size</th>
			<th>Date Modified</th>
			<th>Owner</th>
		</tr>
	    </thead>
	    <tbody>



	    </tbody>
	</table>


</div>
</body>
</html>

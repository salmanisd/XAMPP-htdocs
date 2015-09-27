<?php
// Connect to Mongo 
$mongo = new Mongo();
//select database
$db = $mongo->myfiles;
     
$collection = $db->userlist;

if ( isset($_GET['id']))
{
	$request = $_GET['id'];
$del=$collection->remove(array('_id'=>new MongoID ($request) ));;

header('Location: adminpanel.php'); 
	
}

$arr_wg = $_POST["workinggroup"];

if ( !empty($_POST["username"]) && !empty($_POST["pwd"]) && !empty($_POST["confpwd"]) )
{
	if ($_POST["pwd"]==$_POST["confpwd"])
	{	
			$document = array( 
			"user" => $_POST["username"], 
			"password" => $_POST["pwd"], 
			"workinggroup"=>$arr_wg
			);
			
			$collection->insert($document);
			header('Location: adminpanel.php');  
			
	}
	else
	{
			echo "Password Fields Dont Match.Please Try Again"." <a href=adminpanel.php>Back to User Configuration</a>";
			
	}

}

else
{
	echo "No Data Entered"." <a href=adminpanel.php>Back to User Configuration</a>";
			
}


   
?>

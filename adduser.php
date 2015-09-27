<?php

$arr_wg = $_POST["workinggroup"];

if ( !empty($_POST["username"]) && !empty($_POST["pwd"]) && !empty($_POST["confpwd"]) )
{
	if ($_POST["pwd"]==$_POST["confpwd"])
	{	
			$m = new MongoClient(); 			 // connect to mongodb
			$db = $m->myfiles;					// select a database
			$collection = $db->userlist;
			
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


   // connect to mongodb
   $m = new MongoClient();
   // select a database
   $db = $m->myfiles;
   $collection = $db->userlist;



/*
   $document = array( 
      "user" => "admin", 
      "password" => "admin123", 
   
   );
   $collection->insert($document);*/
   
?>

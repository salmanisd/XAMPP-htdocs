 
<html>
    <head>
        <style type="text/css">
 
            body {font-family:Arial, Sans-Serif;}
 
            //#container {width:300px; margin:0 auto;}
 
            /* Nicely lines up the labels. */
            form label {display:inline-block; width:140px;}
 
            /* You could add a class to all the input boxes instead, if you like. That would be safer, and more backwards-compatible */
            form input[type="text"],
            form input[type="password"],
            form input[type="email"] {width:160px;}
 
            form .line {clear:both;}
            form .line.submit {  margin-left: 170px; margin-top: 19px;}
 
        </style>
    </head>
    <body>
        <div id="container">
            <form action="adduser.php" method="post">
                <h1>Create Account</h1>
                <div class="line"><label for="username">Username *: </label><input type="text" name="username" /></div>
                <div class="line"><label for="pwd">Password *: </label><input type="password" name="pwd" /></div>
				<div class="line"><label for="confpwd">Confirm Password *: </label><input type="password" name="confpwd" /></div>
                
<BR>  </BR>  
<i>Make Member of</i> 
<BR>  </BR> 
 
<div class="line">	Working Group 1 <input type="checkbox" name="workinggroup[]" value="WG1" />
<div class="line">	Working Group 2 <input type="checkbox" name="workinggroup[]" value="WG2" />
<div class="line">	Working Group 3 <input type="checkbox" name="workinggroup[]" value="WG3" />
<div class="line">	Working Group 4 <input type="checkbox" name="workinggroup[]" value="WG4" />
<BR>  </BR>  			
				<div class="line submit"><input type="submit" value="Create Account" /></div>
            </form>
        </div>
    </body>
</html>

<meta charset="UTF-8">
   <link rel="shortcut icon" href="./.favicon.ico">
   <title>Database</title>

   <link rel="stylesheet" href="./.style.css">
   <script src="./.sorttable.js"></script>



 Current Users <br>
 
 
 


 
<?php 
  // connect to mongodb
   $m = new MongoClient();
   // select a database
   $db = $m->myfiles;
   $collection = $db->userlist;
 
$cursor = $collection->find();
   
echo "<table border='1'>"; 
   echo "<tr>"; 
   echo "<td>"."Unique MongoDB ID"."</td>";
   echo "<td>"."User Name"."</td>";
   echo "<td>"."Member of Groups"."</td>";
   echo "<td>"."Delete Account"."</td>";
   echo "</tr>"; 
foreach ($cursor as $obj){ 
$objID=$obj["_id"] ;
$objUSER=$obj["user"];
$objWGarray=$obj["workinggroup"];
$objWG=implode(",",(array)$objWGarray);

      echo("
		<tr >
			<td>$objID</a></td>
			<td>$objUSER</a></td>
			<td>$objWG</a></td>
			<td><a href=ap_deluser.php?id=".$objID."><img src=del_icon.png width=16 height=16 align=top></a></td>
			
		</tr>");
  
} 
 
echo "</table>"; 


?>
 
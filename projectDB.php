<?php

session_start();
if (!$_SESSION["username"])
exit ("Please Login");

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


<?php echo '<div style="Color:red">'.$_SESSION["username"].'->Project Workspace'.'</div>';?>

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
  <li><a href="wg1.php">Working Group 1 |</a></li>
  <li><a href="wg2.php">Working Group 2 |</a></li>
  <li><a href="wg3.php">Working Group 3 |</a></li>
  <li><a href="wg4.php">Working Group 4 |</a></li>
  <li><a href="logout.php">Logout |</a></li>

<div>
<br>
<form style="float: left;" action="upload_mongodb.php" method="post" enctype="multipart/form-data">
    Select file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload File" name="submit"><br>
	<i>Share file with</i>   
	WorkingGroup 1 <input type="checkbox" name="workinggroup[]" value="WG1" />
	WorkingGroup 2 <input type="checkbox" name="workinggroup[]" value="WG2" />
	WorkingGroup 3 <input type="checkbox" name="workinggroup[]" value="WG3" />
	WorkingGroup 4 <input type="checkbox" name="workinggroup[]" value="WG4" /><br>
</form>
<form action="search.php" method="post" enctype="multipart/form-data" align=right>
  Search Database:
    <input type="text" name="filename" id="filename">
    <input type="submit" value="Search" name="submit" align="right">
</form>

</div>
<div>

</div>
</ul>

</body>


</div>
	<br><br><br><br><br><br><br><br>

	<table class="sortable">
	    <thead>

			
			<th>Filename</th>			
			<th>Type</th>
			<th>Size</th>
			<th>Date Modified</th>
			<th>Shared in</th>
			<th>Owner</th>
			
		</tr>
	    </thead>
	    <tbody>
<?php

// Connect to Mongo 
$mongo = new Mongo();

//select database
$db = $mongo->myfiles;


// GridFS
// GridFS
$gridFS = $db->getGridFS();   
 $cursor = $gridFS->find(); 




	// Adds pretty filesizes
	function pretty_filesize($size) {
	
		if($size<1024){$size=$size." Bytes";}
		elseif(($size<1048576)&&($size>1023)){$size=round($size/1024, 1)." KB";}
		elseif(($size<1073741824)&&($size>1048575)){$size=round($size/1048576, 1)." MB";}
		else{$size=round($size/1073741824, 1)." GB";}
		return $size;
	}

 	// Checks to see if veiwing hidden files is enabled
	if($_SERVER['QUERY_STRING']=="hidden")
	{$hide="";
	 $ahref="./";
	 $atext="Hide";}
	else
	{$hide=".";
	 $ahref="./?hidden";
	 $atext="Show";}

	

	

	//// iterate through the results
	foreach ($cursor as $obj) {

	$objID=$obj->file['_id'] ;
	$objUSER=$obj->file['username'];
	$objWGarray=$obj->file['workinggroup'];
	$objWG=implode(",",(array)$objWGarray);

	//Get Upload Date	
	$uploadDate=date('H:i:s d/m/y', $obj->file['uploadDate']->sec);
	$uploadDatekey=date("YmdHis", $obj->file['uploadDate']->sec);

	// Resets Variables
		$favicon="";
		$class="file";

	// Gets File Names
		$name=$obj->getFilename();
		


	

	// File-only operations
		{
			// Gets file extension
			$objEXT=$obj->file['extension'];

			// Prettifies file type
			switch ($objEXT){
				case "png": $objEXT="PNG Image"; break;
				case "jpg": $objEXT="JPEG Image"; break;
				case "jpeg": $objEXT="JPEG Image"; break;
				case "svg": $objEXT="SVG Image"; break;
				case "gif": $objEXT="GIF Image"; break;
				case "ico": $objEXT="Windows Icon"; break;
				case "bmp": $objEXT="BMP Image"; break;
				case "txt": $objEXT="Text File"; break;
				case "log": $objEXT="Log File"; break;
				case "htm": $objEXT="HTML File"; break;
				case "html": $objEXT="HTML File"; break;
				case "xml": $objEXT="XML Document"; break;
				case "m": $objEXT="MATLAB File"; break;
				case "php": $objEXT="PHP Script"; break;
				case "vsdx": $objEXT="Microsoft Visio Document"; break;
				case "css": $objEXT="Stylesheet"; break;

				case "pdf": $objEXT="PDF Document"; break;
				case "xls": $objEXT="Spreadsheet"; break;
				case "xlsx": $objEXT="Spreadsheet"; break;
				case "doc": $objEXT="Microsoft Word Document"; break;
				case "docx": $objEXT="Microsoft Word Document"; break;

				case "zip": $objEXT="ZIP Archive"; break;
				case "htaccess": $objEXT="Apache Config File"; break;
				case "exe": $objEXT="Windows Executable"; break;

				default: if($objEXT!=""){$objEXT=strtoupper($objEXT)." File";} else{$objEXT="Unknown";} break;
			}

			// Gets and cleans up file size
				$filesize=$obj->getSize();
				$size=pretty_filesize($filesize);
				$sizekey=$obj->getSize();
		

	 echo("
		<tr class='$class'>
		
			<td><a href=download.php?id=".$objID.">$name</a></td>
			<td><a href=download.php?id=".$objID.">$objEXT</a></td>
			<td sorttable_customkey='$sizekey'><a href=download.php?id=".$objID.">$size</a></td>
			<td sorttable_customkey='$uploadDatekey'><a href=download.php?id=".$objID.">$uploadDate</a></td>
			<td><a href=download.php?id=".$objID.">$objWG</a></td>
			<td><a href=download.php?id=".$objID.">$objUSER</a></td>
		</tr> ");

	   }
	}
	?>

	    </tbody>
	</table>


</div>
</body>
</html>


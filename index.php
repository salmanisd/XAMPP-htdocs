<!doctype html>

<html>
<head>
   <meta charset="UTF-8">
   <link rel="shortcut icon" href="./.favicon.ico">
   <title>Directory Contents</title>

   <link rel="stylesheet" href="./.style.css">
   <script src="./.sorttable.js"></script>
</head>




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
		</tr>
	    </thead>
	    <tbody><?php

// Connect to Mongo 
$mongo = new Mongo();

//select database
$db = $mongo->myfiles;

// search for user files
$userfiles = array('username' => 'salman');
// GridFS
$gridFS = $db->getGridFS();  
$collection = $db->fs->files; 
$cursor = $gridFS->find($userfiles);

    


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

	//Get Upload Date	
	$uploadDate=date('h:i:s m/d/y', $obj->file['uploadDate']->sec);
	$uploadDatekey=date("YmdHis", $obj->file['uploadDate']->sec);

	// Resets Variables
		$favicon="";
		$class="file";

	// Gets File Names
		$name=$obj->getFilename();
		


	

	// File-only operations
		{
			// Gets file extension
			$extn='png';

			// Prettifies file type
			switch ($extn){
				case "png": $extn="PNG Image"; break;
				case "jpg": $extn="JPEG Image"; break;
				case "jpeg": $extn="JPEG Image"; break;
				case "svg": $extn="SVG Image"; break;
				case "gif": $extn="GIF Image"; break;
				case "ico": $extn="Windows Icon"; break;

				case "txt": $extn="Text File"; break;
				case "log": $extn="Log File"; break;
				case "htm": $extn="HTML File"; break;
				case "html": $extn="HTML File"; break;
				case "xhtml": $extn="HTML File"; break;
				case "shtml": $extn="HTML File"; break;
				case "php": $extn="PHP Script"; break;
				case "js": $extn="Javascript File"; break;
				case "css": $extn="Stylesheet"; break;

				case "pdf": $extn="PDF Document"; break;
				case "xls": $extn="Spreadsheet"; break;
				case "xlsx": $extn="Spreadsheet"; break;
				case "doc": $extn="Microsoft Word Document"; break;
				case "docx": $extn="Microsoft Word Document"; break;

				case "zip": $extn="ZIP Archive"; break;
				case "htaccess": $extn="Apache Config File"; break;
				case "exe": $extn="Windows Executable"; break;

				default: if($extn!=""){$extn=strtoupper($extn)." File";} else{$extn="Unknown";} break;
			}

			// Gets and cleans up file size
				$filesize=$obj->getSize();
				$size=pretty_filesize($filesize);
				$sizekey=$obj->getSize();
		

	// Output
	 echo("
		<tr class='$class'>
			<td><a href=download.php?id=".$objID.">$name</a></td>
			<td><a href=download.php?id=".$objID.">$extn</a></td>
			<td sorttable_customkey='$sizekey'><a href=download.php?id=".$objID.">$size</a></td>
			<td sorttable_customkey='$uploadDatekey'><a href=download.php?id=".$objID.">$uploadDate</a></td>
		</tr>");
	   }
	}
	?>

	    </tbody>
	</table>


</div>
</body>
</html>

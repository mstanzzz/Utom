<?php
if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){ 
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/solvitware';
}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/designitpro'; 
}elseif(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
}else{
	$real_root = $_SERVER['DOCUMENT_ROOT']; 	
}

require_once($real_root.'/includes/class.dbcustom.php');
$dbCustom = new DbCustom();

require_once($real_root.'/includes/config.php');
require_once($real_root.'/manage/admin-includes/manage-includes.php');



$module = new Module;

$page_title = "Add SVG";
$page_group = "svg";

$msg = '';
require_once($real_root.'/manage/admin-includes/doc_header.php'); 
?>
</head>
<body>

<div style="margin:6%;">

<a class="btn btn-large" href="svg.php">Cancel</a>

<h2>ADD SVG</h2>

<form name="form" action="svg.php" method="post">

<input type="hidden" name="add_svg" value="1">

<label>Name</label>
<br />
<input style="width:60%;" type="text" name="name">
<br />
<br />
<label>Description</label>

<textarea style="width:100%; height:200px;" name="description"></textarea>
<br />
<br />

<label>SVG Code</label>
<br />
<textarea style="width:100%; height:400px;"  
	name="svg_code" ></textarea>
<br />

<input type="submit" name="submit" value="Save">

</form>

</div>

</body>
</html>




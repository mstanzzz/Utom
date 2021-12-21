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

$page_title = "Edit SVG";
$page_group = "svg";

$msg = '';

$svg_id = isset($_GET['svg_id'])? $_GET['svg_id'] : 0;
if(!is_numeric($svg_id)) $svg_id = 0;

$db = $dbCustom->getDbConnect(CART_DATABASE);
$sql = "SELECT name, svg_code, description 
		FROM svg 
		WHERE svg_id = '".$svg_id."'";
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$svg_code = $object->svg_code;
	$name = $object->name;
	$description = $object->description;
	 	
}else{
	$svg_code = "none";
	$name = "none";	
	$description = '';
}



require_once($real_root.'/manage/admin-includes/doc_header.php'); 
?>
</head>
<body>

<div style="margin:6%;">

<a class="btn btn-large" href="svg.php">Cancel</a>

<h2>Edit SVG</h2>

<form name="form" action="svg.php" method="post">


<input type="hidden" name="svg_id" value="<?php echo $svg_id; ?>">
<input type="hidden" name="update_svg" value="1">
		  
<label>Name</label>
<br />
<input style="width:60%;" type="text" name="name" value="<?php echo stripslashes($name); ?>">
<br />
<br />
<label>Description</label>

<textarea style="width:100%; height:200px;" name="description"><?php echo stripslashes($description); ?></textarea>
<br />
<br />

<label>SVG Code</label>
<br />
<textarea style="width:100%; height:400px;"  
	name="svg_code" ><?php echo stripslashes($svg_code); ?></textarea>
<br />
<input type="submit" name="submit" value="Save">

	
</form>

</div>


</body>
</html>




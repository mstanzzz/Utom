<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$module = new Module;

$page_title = "Edit SVG";
$page_group = "svg";

$msg = '';

$svg_id = isset($_GET['svg_id'])? $_GET['svg_id'] : 0;
if(!is_numeric($svg_id)) $svg_id = 0;

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$sql = "SELECT name, svg_code 
		FROM svg 
		WHERE svg_id = '".$svg_id."'";
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$svg_code = $object->svg_code;
	$name = $object->name;
 	
}else{
	$svg_code = "none";
	$name = "none";	
}



require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 
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




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

require_once($real_root.'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$attribute_id =  (isset($_GET['attribute_id'])) ? $_GET['attribute_id'] : 0;
$is_color =  (isset($_GET['is_color'])) ? $_GET['is_color'] : 0;

$db = $dbCustom->getDbConnect(CART_DATABASE);

require_once($real_root.'/manage/admin-includes/doc_header.php'); 


?>
</head>
<body>

		<form name="add_opt" action="option.php?attribute_id=<?php echo $attribute_id; ?>" method="post">
			<fieldset class="colcontainer">
				<label>Option Name</label>
				<input type="text" name="opt_name">
				
				<?php
				if($is_color){
				?>
				<label>Color Value</label>
				<input type="color"name="color_val">
				<?php
				}
				?>
				
			</fieldset>
			<a href="option.php?attribute_id=<?php echo $attribute_id; ?>" class="btn btn-large dismiss"> Cancel </a>
			<button name="add_opt" type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Add </button>
		</form>


</body>
</html>




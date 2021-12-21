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

$db = $dbCustom->getDbConnect(CART_DATABASE);

$attribute_id =  (isset($_GET['attribute_id'])) ? $_GET['attribute_id'] : 0;
$opt_id =  (isset($_GET['opt_id'])) ? $_GET['opt_id'] : 0;
$is_color =  (isset($_GET['is_color'])) ? $_GET['is_color'] : 0;

$sql = sprintf("SELECT * FROM opt WHERE opt_id = '%u'", $opt_id);
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$opt_name = $object->opt_name;
	$color_val = $object->color_val;
	
}else{
	$opt_name = '';
	$color_val = '';
}



require_once($real_root.'/manage/admin-includes/doc_header.php'); 
?>
</head>
<body>
Editing

		<form name="edit_opt" action="option.php" method="post">
		
			<input type="hidden" name="attribute_id" value="<?php echo $attribute_id; ?>" />
			<input type="hidden" name="opt_id" value="<?php echo $opt_id; ?>" />
		
			<fieldset class="colcontainer">
				<label>Option Name</label>
				<input type="text" name="opt_name" value="<?php echo $opt_name; ?>">
				
				<?php
				if($is_color){
				?>
				<label>Color Value</label>
				<input type="color" name="color_val" value="<?php echo $color_val; ?>">
				<?php
				}
				?>				
				
			</fieldset>
			<a href="option.php?attribute_id=<?php echo $attribute_id; ?>" class="btn btn-large dismiss"> Cancel </a>
			<button name="edit_opt" type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Update </button>
		</form>

</body>
</html>




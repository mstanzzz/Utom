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

$progress = new SetupProgress;
$module = new Module;

$page_title = "SVG";
$page_group = "SVG";
	
$db = $dbCustom->getDbConnect(CART_DATABASE);

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

if(isset($_POST['add_svg'])){
	
	$svg_code = isset($_POST['svg_code']) ? trim(addslashes($_POST['svg_code'])) : '';
	$name = isset($_POST['name']) ? trim(addslashes($_POST['name'])) : '';
	
	$description = isset($_POST['description']) ? trim(addslashes($_POST['description'])) : '';
	
	
	
	
	$sql = "INSERT INTO svg 
			(name, svg_code, description, profile_account_id) 
			VALUES 
			('".$name."','".$svg_code."','".$description."','".$_SESSION['profile_account_id']."')";
	
	$result = $dbCustom->getResult($db,$sql);
	$msg = "Your change is now pending approval.";


}

if(isset($_POST['update_svg'])){
	
	$svg_id = isset($_POST['svg_id']) ? $_POST['svg_id'] : 0;
	if(!is_numeric($svg_id)) $svg_id = 0;

	$svg_code = isset($_POST['svg_code']) ? trim(addslashes($_POST['svg_code'])) : '';
	$name = isset($_POST['name']) ? trim(addslashes($_POST['name'])) : '';
	
	$description = isset($_POST['description']) ? trim(addslashes($_POST['description'])) : '';

	$sql = "UPDATE svg 
			SET name = '".$name."'
			,svg_code = '".$svg_code."' 
			,description = '".$description."' 
			WHERE svg_id = '".$svg_id."'"; 			
	$result = $dbCustom->getResult($db,$sql);
	$msg = "Your change is now pending approval.";
		
}




if(isset($_GET["del_svg_id"])){

	//$svg_id = isset($_POST['del_svg_id']) ? $_POST['del_svg_id'] : 0;
	$svg_id = isset($_GET['del_svg_id']) ? $_GET['del_svg_id'] : 0;
	
	if(!is_numeric($svg_id)) $svg_id = 0;
			
	$sql = sprintf("DELETE FROM svg WHERE svg_id = '%u'", $svg_id);
	$result = $dbCustom->getResult($db,$sql);
	
	$msg = 'svg deleted.';

}

if(isset($_POST['set_active'])){
	
	$svg_ids = (isset($_POST['svg_id']))? $_POST['svg_id'] : array();	
	$ts = time();
	
	$sql = "UPDATE svg SET active = '0' WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);


	foreach($svg_ids as $val){
		
		$sql = "UPDATE svg SET active = '1' WHERE svg_id = '".$val."'";
		$result = $dbCustom->getResult($db,$sql);
		
	}

		
	$msg = 'Your change is now live.';


}

require_once($real_root.'/manage/admin-includes/doc_header.php'); 
?>
<script>


function regularSubmit() {
  document.form.action = '<?php echo $current_page; ?>';
  document.form.target = '_self';
  document.form.submit(); 
}	

</script>
</head>
<body>
<?php
	require_once($real_root.'/manage/admin-includes/manage-header.php');
	require_once($real_root.'/manage/admin-includes/manage-top-nav.php');
?>
<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php 
        require_once($real_root.'/manage/admin-includes/manage-side-nav.php');
        ?>
	</div>
	<div class="manage_main">
	

		<h1>SVG Icons</h1>

		
		<form name="form" action="svg.php" method="post">
<input type="submit" >
			<input type="hidden" name="set_active" value="1"> 
            
			
			<div class="page_actions"> 
	<a class='btn' href="add-svg.php">ADD SVG ICON</a>

            </div>
            
			<div class="data_table">
			<table border="0" cellpadding="10" cellspacing="0">
			<thead>
			<tr>
			<th width="30%">Preview</th>
			<th width="50%">Icon Name</th>
			<th width="10%">Active</th>			
			<th width="10%">Edit</th>
			<th>Delete</th>
			</tr>
			</thead>
			<?php

	$db = $dbCustom->getDbConnect(CART_DATABASE);

	$sql = "SELECT svg_id, name, svg_code, active 
    FROM svg 
	WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);
	
	$block = '';
	while($img_row = $result->fetch_object()){
		//echo $img_row->logo_id;
    	$block .= "<tr>";
			 
		$block .= "<td>";
		$block .= stripslashes($img_row->svg_code);
		$block .= '</td>';
				
		$block .= "<td valign='middle'>".$img_row->name."</td>";
  		
		
		$checked = ($img_row->active)? "checked" : '';
		
		//$checked = '';
		
		$disabled = '';
		
		$block .= "<td valign='middle' class='center'>
			<div class='checkboxtoggle on ".$disabled." '> 
			<span class='ontext'>ON</span>
			<a class='switch on' href='#'></a>
			<span class='offtext'>OFF</span>
			<input type='checkbox' class='checkboxinput' name='svg_id[]' value='".$img_row->svg_id."' $checked /></div></td>";		


		$block .= "<td><a class='btn btn-primary' 
		href='edit-svg.php?svg_id=".$img_row->svg_id."'> Edit <a/></td>";


		$block .= "<td>
			<a href='svg.php?del_svg_id=".$img_row->svg_id."' class='btn btn-danger'>
			DELETE</a></td>";


		/*
		$block .= "<td valign='middle' class='center'>
			<a class='btn btn-danger confirm logo-delete ".$disabled." '>
			<input type='hidden' id=".$img_row->svg_id."' class='imgId'  
			value='".$img_row->svg_id."'/>
			<i class='icon-remove icon-white'></i></a></td>";
		*/
		
		$block .= "</tr>";
		
	}
	echo $block;
    ?>
		</table>
		</div>
		
		<input type="submit" >
		</form>

		
	</div>
	
	

	
	<p class="clear"></p>
	<div id="logo-delete" class="confirm-content">
		<h3>Are you sure you want to delete this svg icon?</h3>
		<div class="imgPlaceholder"></div>
		<form name="del_svg" action="svg.php" method="post" target="_top">
			<input id="del_svg_id" type="hidden" name="del_svg_id" value='' />
			<a class="btn btn-large dismiss">No, Cancel</a>
			<button class="btn btn-danger btn-large" name="del_svg" type="submit" >Yes, Delete</button>
		</form>
	</div>
</div>
</body>
</html>

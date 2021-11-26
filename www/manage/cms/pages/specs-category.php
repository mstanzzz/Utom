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

$page_title = "Specs";
$page_group = "specs";
$page = "specs";

$db = $dbCustom->getDbConnect(CART_DATABASE);

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

$ts = time();

if(!isset($_SESSION['specs_content_id'])) $_SESSION['specs_content_id'] = 0;
$specs_content_id = (isset($_GET['specs_content_id'])) ? $_GET['specs_content_id'] : '';
if($specs_content_id > 0) $_SESSION['specs_content_id'] = $specs_content_id;

if($_SESSION['specs_content_id'] == 0){
	$_SESSION['specs_content_id'] = get_max_specs_content_id($dbCustom);
}


function get_svg_icon_spec($dbCustom, $svg_id){

	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$ret_array['name']='';
	$ret_array['svg_code']='';	
	
	$sql = "SELECT svg_code, name
			FROM svg
			WHERE svg_id = '".$svg_id."'";
	$re = $dbCustom->getResult($db,$sql);
	if($re->num_rows > 0){
		$object = $re->fetch_object();
		$ret_array['name'] = $object->name;
		$ret_array['svg_code'] = $object->svg_code;		
		
	}
	return  $ret_array;
}

if(isset($_POST['update_spec_cat'])){
	$category_name = (isset($_POST['category_name']))? addslashes(trim($_POST['category_name'])):''; 	
	$svg_id = (isset($_POST['svg_id']))?$_POST['svg_id']:0;
	$spec_cat_id = (isset($_POST['spec_cat_id']))?$_POST['spec_cat_id']:0;
	if(!is_numeric($svg_id))$svg_id=0;
	if(!is_numeric($spec_cat_id))$spec_cat_id=0;
	
	
	$sql = "UPDATE spec_category
			SET svg_id='".$svg_id."'
		WHERE spec_cat_id='".$spec_cat_id."'"; 
		$re = $dbCustom->getResult($db,$sql);
		
		
	echo $sql;
}

if(isset($_POST['add_spec_cat'])){
	$category_name = (isset($_POST['category_name']))? addslashes(trim($_POST['category_name'])):''; 	
	$svg_id = (isset($_POST['svg_id']))?$_POST['svg_id']:0;
	if(!is_numeric($svg_id))$svg_id=0;
	$sql = "INSERT INTO spec_category
			(svg_id, profile_account_id, category_name)
			VALUES
			('".$svg_id."',  '".$_SESSION['profile_account_id']."', '".$category_name."')";
	$re = $dbCustom->getResult($db,$sql);
}

if(isset($_POST['del_spec_cat_id'])){
	
	$del_spec_cat_id = (isset($_POST['del_spec_cat_id']))?$_POST['del_spec_cat_id']:0;
	if(!is_numeric($del_spec_cat_id))$del_spec_cat_id=0;
	
	$sql = "DELETE FROM spec_category
			WHERE spec_cat_id = '".$del_spec_cat_id."'";
	$re = $dbCustom->getResult($db,$sql);
	
}

require_once($real_root.'/manage/admin-includes/doc_header.php'); 

?>
<script>

function regularSubmit() {
  document.form.action = 'specs.php';
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
<?php 
require_once($real_root."/manage/admin-includes/specs-section-tabs.php");
?>
		<div class="page_actions"> 
            
            <!--  fancybox fancybox.iframe -->
            	<a class="btn btn-large btn-primary" 
				href="add-spec-cat.php?firstload=1">
				<i class="icon-plus icon-white"></i> Add a New Spec Cat </a> 
            	<a href="<?php echo SITEROOT;?>/manage/cms/pages/page.php" class="btn btn-large">
            	<i class="icon-arrow-left"></i> Cancel &amp; Go Back</a> 

			</div>
<?php
	$db = $dbCustom->getDbConnect(CART_DATABASE);
			$sql = "SELECT category_name
						,svg_id
						,spec_cat_id
					FROM spec_category
					WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";		
			
			//echo $sql; 

			$sql = "SELECT *
					FROM spec_category
					WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";		

			
			$result = $dbCustom->getResult($db,$sql);			


			
			?>
			<br />

			<div class="data_table">
				<table cellpadding="10" cellspacing="0">
					<tr>
						<td width="20%">SVG Cat Icon</td>
						<td>Spec Cat Name</td>		
						<td width="10%">Edit</td>
						<td width="10%">Delete</td>
					</tr>
					<?php
					while($row = $result->fetch_object()) {
						$block = "<tr>";
					
					
					$svg = get_svg_icon_spec($dbCustom,$row->svg_id);
										
						$block .= "<td>";		
						
						$block .= $svg['svg_code']; 

						$block .= "</td>";
						
						$block .= "<td>".stripslashes($row->category_name)."</td>";

				$url_str = 'edit-spec-cat.php';
				$url_str .= '?spec_cat_id='.$row->spec_cat_id;
				
						$block .= "<td><a href='".$url_str."' >Edit</a></td>";

						$block .= "<td><a class='btn btn-danger  confirm' href='#'>Delete
						<input type='hidden' class='itemId' value='".$row->spec_cat_id."' id='".$row->spec_cat_id."' /></a></td>";
						
						
						echo $block;
					}
				?>


				</table>
			</div>
	</div>
	<p class="clear"></p>
	<?php 
	require_once($real_root.'/manage/admin-includes/manage-footer.php');
	?>
</div>

<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this spec?</h3>
	<form name="del_spec_form" action="specs-category.php" method="post" target="_top">
		<input id="del_spec_cat_id" class="itemId" type="hidden" name="del_spec_cat_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_spec_cat" type="submit" >Yes, Delete</button>
	</form>
</div>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>


</body>
</html>


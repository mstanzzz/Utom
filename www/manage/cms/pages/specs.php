<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Specs";
$page_group = "specs";
$page = "specs";

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

$ts = time();

if(!isset($_SESSION['specs_content_id'])) $_SESSION['specs_content_id'] = 0;
$specs_content_id = (isset($_GET['specs_content_id'])) ? $_GET['specs_content_id'] : '';
if($specs_content_id > 0) $_SESSION['specs_content_id'] = $specs_content_id;

if($_SESSION['specs_content_id'] == 0){
	$_SESSION['specs_content_id'] = get_max_specs_content_id();
}


if(isset($_POST["specs_content_id"])){
	$specs_content_id = (isset($_POST['specs_content_id']))? $_POST['specs_content_id'] : 0;
	if($specs_content_id > 0) $_SESSION['specs_content_id'] = $specs_content_id;
	if($_SESSION['specs_content_id'] == 0){
		$_SESSION['specs_content_id'] = get_max_specs_content_id();
	}

	$p_1_text = (isset($_POST['p_1_text']))? trim(addslashes($_POST['p_1_text'])) : '';
	$p_2_text = (isset($_POST['p_2_text']))? trim(addslashes($_POST['p_2_text'])) : '';

	//$img_id = (isset($_POST['img_id']))? $_POST['img_id'] : 0;
	//if(!is_numeric($img_id)) $img_id = 0;
	
	$svg_id = (isset($_POST['svg_id']))? $_POST['svg_id'] : 0;
	if(!is_numeric($svg_id)) $svg_id = 0;
	
	
	
	$sql = sprintf("UPDATE specs_content 
					SET p_1_text = '%s'
						,p_2_text = '%s'
						,svg_id = '%u'
					WHERE specs_content_id = '%u'", 
	$p_1_text, $p_2_text, $img_id, $_SESSION['specs_content_id']);
	$result = $dbCustom->getResult($db,$sql);
		

	//require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/insert_page_breadcrumb.php");

	$msg = "Your change is now live.";

	
}





if(isset($_POST['add_spec'])){

	$name = (isset($_POST['name']))? trim(addslashes($_POST['name'])) : '';
	$description = (isset($_POST['description']))? trim(addslashes($_POST['description'])) : '';
	$spec_details = (isset($_POST['spec_details']))? trim(addslashes($_POST['spec_details'])) : '';

	$svg_id = (isset($_POST['svg_id']))? $_POST['svg_id'] : 0;
	if(!is_numeric($svg_id)) $svg_id = 0;
	
	//$spec_cat_id = (isset($_POST['img_id']))? $_POST['spec_cat_id'] : 0;	
	//$img_id = (isset($_POST['img_id']))? $_POST['img_id'] : 0;
	//if(!is_numeric($spec_cat_id)) $spec_cat_id = 0;	
	
	$sql = sprintf("INSERT INTO spec 
					(name, description, spec_details, svg_id, profile_account_id) 
					VALUES ('%s','%s','%s','%u','%u')", 
	$name, $description, $spec_details, $svg_id, $_SESSION['profile_account_id']);
	$result = $dbCustom->getResult($db,$sql);	

	$msg = "Your change is live.";
		
}



if(isset($_POST['update_spec'])){
	
	$name = isset($_POST['name']) ? trim(addslashes($_POST['name'])) : '';
	$description = isset($_POST['description']) ? trim(addslashes($_POST['description'])) : '';
	$spec_details = (isset($_POST['spec_details']))? trim(addslashes($_POST['spec_details'])) : '';
	$spec_id = (isset($_POST['spec_id']))? $_POST['spec_id'] : 0;
	$svg_id = (isset($_POST['svg_id']))? $_POST['svg_id'] : 0;

	//$spec_cat_id = (isset($_POST['img_id']))? $_POST['spec_cat_id'] : 0;
	//$img_id = (isset($_POST['img_id']))? $_POST['img_id'] : 0;
	//if(!is_numeric($spec_cat_id)) $spec_cat_id = 0;
	//if(!is_numeric($img_id)) $img_id = 0;
	
	if(!is_numeric($spec_id)) $spec_id = 0;	
	if(!is_numeric($svg_id)) $svg_id = 0;

	$sql = "UPDATE spec 
			SET name = '".$name."'
				,description = '".$description."'
				,spec_details = '".$spec_details."'			
				,svg_id = '".$svg_id."'
			WHERE spec_id = '".$spec_id."'";
	$result = $dbCustom->getResult($db,$sql);

	$msg = "Your change is live.";

}


if(isset($_POST["del_spec"])){
	
	$spec_id = $_POST["del_spec_id"];
	$sql = sprintf("DELETE FROM spec 
					WHERE spec_id = '%u'", $spec_id);
	$result = $dbCustom->getResult($db,$sql);

	$msg = "Item Deleted.";
}

unset($_SESSION['temp_page_fields']);
unset($_SESSION['spec_id']);

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

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
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');
?>
<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php');
        ?>
	</div>
	<div class="manage_main">
		<?php 
        require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/specs-section-tabs.php");


		?>
			<div class="page_actions"> 
            
            <!--  fancybox fancybox.iframe -->
            	<a class="btn btn-large btn-primary" href="add-spec.php?firstload=1">
				<i class="icon-plus icon-white"></i> Add a New Spec </a> 
			 	<a href="<?php echo $ste_root; ?>/manage/cms/navigation/navbar.php?strip=1" class="btn btn-primary btn-large fancybox fancybox.iframe">
                <i class="icon-eye-open icon-white"></i> Edit Navigation </a>

            	<!--<a onClick="previewSubmit();" href="#" class="btn btn-primary btn-large"><i class="icon-eye-open icon-white"></i> Preview </a>-->

            	<a href="<?php echo $ste_root;?>/manage/cms/pages/page.php" class="btn btn-large">
            	<i class="icon-arrow-left"></i> Cancel &amp; Go Back</a> 

			</div>


<?php
			$db = $dbCustom->getDbConnect(SITE_N_DATABASE);        

			$sortby = (isset($_GET['sortby'])) ? trim(mysql_escape_string($_GET['sortby'])) : '';
			$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
			
			$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;

			$truncate = (isset($_GET['truncate'])) ? addslashes($_GET['truncate']) : 1;
			
			// get total number of rows
			$sql = "SELECT spec.name
						,spec.description 
						,spec.spec_details
						,spec.svg_id
						,spec.spec_id
					FROM spec
					WHERE spec.profile_account_id = '".$_SESSION['profile_account_id']."'";		
			if(isset($_POST["product_search"])){
				$search_str = trim(addslashes($_POST["product_search"]));
				$sql .= " AND (name like '%".$search_str."%' || name like '%".$search_str."%')";
			}
							
			$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
			$nmx_res = $dbCustom->getResult($db,$sql);
			
			$total_rows = $nmx_res->num_rows;
			$rows_per_page = 10;
			$last = ceil($total_rows/$rows_per_page); 
			
			if ($pagenum < 1){ 
				$pagenum = 1; 
			}elseif ($pagenum > $last){ 
				$pagenum = $last; 
			} 
		
			$limit = ' limit ' .($pagenum - 1) * $rows_per_page.','.$rows_per_page;
			
			if($sortby != ''){
				if($sortby == 'name'){
					if($a_d == 'd'){
						$sql .= " ORDER BY page_name DESC".$limit;
					}else{
						$sql .= " ORDER BY page_name".$limit;	
					}
				}
				if($sortby == 'description'){
					if($a_d == 'd'){
						$sql .= " ORDER BY description DESC".$limit;
					}else{
						$sql .= " ORDER BY description".$limit;		
					}
				}
				
			}else{
				$sql .= " ORDER BY name".$limit;					
			}
				
			$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
			$result = $dbCustom->getResult($db,$sql);			
			
			if($total_rows > $rows_per_page){
                echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "cms/pages/specs.php", $sortby, $a_d);
			}


			?>
			<br />

			<div class="data_table">
				<table cellpadding="10" cellspacing="0">
					<tr>
						<td width="10%">SVG Icon</td>
						<td width="20%">Spec Name</td>		
						<td width="30%">Description </td>
						<td width="20%">spec_details</td>
						<td width="15%">Edit</td>
						<td width="5%">Delete</td>
					</tr>
					<?php
					while($row = $result->fetch_object()) {
						$block = "<tr>";
					
						$sql = "SELECT svg_code FROM svg WHERE svg_id = '".$row->svg_id."'";
						$img_res = $dbCustom->getResult($db,$sql);
										
						$block .= "<td>";		
						if($img_res->num_rows){
							$img_obj = $img_res->fetch_object();						
							$block .= stripslashes($img_obj->svg_code); 
						}
						$block .= "</td>";
						
						$block .= "<td>".stripslashes($row->name)."</td>";

						$block .= "<td>".stripslashes($row->description)."</td>";

						$block .= "<td>".stripslashes($row->spec_details)."</td>";

					
						$block .= "<td>
						<a class='btn btn-primary' href='edit-spec.php?firstload=1&spec_id=".$row->spec_id."'>
						<i class='icon-cog icon-white'></i> Edit</a></td>";
						
						$block .= "<td><a class='btn btn-danger  confirm' href='#'>Delete
						<input type='hidden' class='itemId' value='".$row->spec_id."' id='".$row->spec_id."' /></a></td>";
						
						
						echo $block;
					}
				?>


				</table>
			</div>
	</div>
	<p class="clear"></p>
	<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
	?>
</div>

<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this spec?</h3>
	<form name="del_spec_form" action="specs.php" method="post" target="_top">
		<input id="del_spec_id" class="itemId" type="hidden" name="del_spec_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_spec" type="submit" >Yes, Delete</button>
	</form>
</div>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>


</body>
</html>

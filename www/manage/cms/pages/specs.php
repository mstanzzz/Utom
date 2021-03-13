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

// add if not exist
$sql = "SELECT specs_content_id FROM specs_content WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows == 0){
	$sql = "INSERT INTO specs_content 
		(content, last_update, profile_account_id) 
		VALUES ('Add Content', '".$ts."', '".$_SESSION['profile_account_id']."')"; 
	$result = $dbCustom->getResult($db,$sql);
}

if(isset($_POST["specs_content_id"])){
	
	$specs_content_id = $_POST["specs_content_id"];
	
	$content = trim(addslashes($_POST["content"])); 
	$sidebar_heading = trim(addslashes($_POST["sidebar_heading"])); 
	$sidebar_content = trim(addslashes($_POST["sidebar_content"]));
	$img_id = $_POST['img_id'];


	$content = (isset($_POST['content']))? trim(addslashes($_POST['content'])) : '';


	$sidebar_heading = (isset($_POST['sidebar_heading']))? trim(addslashes($_POST['sidebar_heading'])) : '';



	$mssl = (isset($_POST['mssl']))? 1 : 0;
	$seo_name = trim(addslashes($_POST['seo_name']));
	$seo_name = str_replace (" ", "-" , $seo_name);
	$title = trim(addslashes($_POST['title']));
	$keywords = trim(addslashes($_POST['keywords']));
	$description = trim(addslashes($_POST['description']));
	$page_heading = trim(addslashes($_POST["page_heading"]));

	require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/insert_page_seo.php");
	
	$sql = sprintf("UPDATE specs_content 
					SET content = '%s'
						,sidebar_heading = '%s'
						,sidebar_content = '%s'
						,img_id = '%u'
						,last_update = '%u' 						
						WHERE specs_content_id = '%u'", 
	$content, $sidebar_heading, $sidebar_content, $img_id, time(), $specs_content_id);
	$result = $dbCustom->getResult($db,$sql);
		

	require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/insert_page_breadcrumb.php");

	$msg = "Your change is now live.";
	
}



if(isset($_POST['add_spec'])){

	$name = trim(addslashes($_POST['name']));
	$description = trim(addslashes($_POST['description'])); 
	$spec_cat_id = $_POST['spec_cat_id']; 
	$img_id = $_POST['img_id']; 
	
	
	$spec_details = trim(addslashes($_POST['spec_details']));
	
	
	$sql = sprintf("INSERT INTO spec 
					(name, description, spec_cat_id, img_id, profile_account_id) 
					VALUES ('%s','%s','%u','%u','%u')", 
	$name, $description, $spec_cat_id, $img_id, $_SESSION['profile_account_id']);
	$result = $dbCustom->getResult($db,$sql);
	

	$msg = "Your change is live.";
	
	
}




if(isset($_POST['edit_spec'])){
	
	
	
	$name = isset($_POST['name']) ? trim(addslashes($_POST['name'])) : '';
	$description = isset($_POST['description']) ? trim(addslashes($_POST['description'])) : '';
	
	$spec_cat_id = isset($_POST['spec_cat_id']) ? $_POST['spec_cat_id'] : 0;
	$spec_id = isset($_POST['spec_id']) ? $_POST['spec_id'] : 0;
	$img_id = isset($_POST['img_id']) ? $_POST['img_id'] : 0;


	$sql = sprintf("UPDATE spec 
					SET name = '%s'
					,description = '%s' 
					,spec_cat_id = '%u'
					,img_id = '%u'
					WHERE spec_id = '%u'", 
	$name, $description, $spec_cat_id, $img_id, $spec_id);
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





unset($_SESSION['img_id']);
unset($_SESSION['new_img_id']);
unset($_SESSION['temp_page_fields']);
unset($_SESSION['spec_id']);
unset($_SESSION['specs_content_id']);


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

?>
<script>

$(document).ready(function() {
	$('.fancybox').fancybox({
		autoSize : false,
		height : 800,
		width : 900	
	});
});


function previewSubmit() {
  document.form.action = '<?php echo $ste_root; ?>/pages/preview/preview.php';
  document.form.target = '_blank'; 
  document.form.submit();
}	

function regularSubmit() {
  document.form.action = '<?php echo $current_page; ?>';
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
        
        
   		require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		$bread_crumb->add("CMS", $ste_root."manage/cms/cms-landing.php");
		$bread_crumb->add("Pages", $ste_root."manage/cms/pages/page.php");
		$bread_crumb->add("Specs", '');
        echo $bread_crumb->output();
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
        
		//specs section tabbed sub-navigation
        require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/specs-section-tabs.php");
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);        
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
			$sortby = (isset($_GET['sortby'])) ? trim(mysql_escape_string($_GET['sortby'])) : '';
			$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
			
			$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;

			$truncate = (isset($_GET['truncate'])) ? addslashes($_GET['truncate']) : 1;
			
			// get total number of rows
			$sql = "SELECT spec.name
						,spec.description 
						,spec_category.category_name
						,spec.img_id
						,spec.spec_id
					FROM spec, spec_category
					WHERE spec.spec_cat_id = spec_category.spec_cat_id 
					AND spec.profile_account_id = '".$_SESSION['profile_account_id']."'
					";		

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
				$sql .= " ORDER BY category_name, name".$limit;					
			}
				
			$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$result = $dbCustom->getResult($db,$sql);			
			
			if($total_rows > $rows_per_page){
                echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "cms/pages/specs.php", $sortby, $a_d);
			}
			?>
			<br />

			<div class="data_table">
				<?php require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/tablesort.php"); ?>
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
							<th width="10%">Image</th>
							<th width="20%" <?php addSortAttr('name',true); ?>>Title <i <?php addSortAttr('name',false); ?>></i></th>
							<th width="30%" <?php addSortAttr('description',true); ?>>Content <i <?php addSortAttr('description',false); ?>></i> </th>
							<th width="20%">Category</th>
							<th width="15%">Edit</th>
							<th width="5%">Delete</th>
						</tr>
					</thead>
					<tbody>
					<?php
					while($row = $result->fetch_object()) {
						$block = "<tr>";
					
						$sql = "SELECT file_name FROM image WHERE img_id = '".$row->img_id."'";
						$img_res = $dbCustom->getResult($db,$sql);
						;
						$block .= "<td valign='middle'>";
						if($img_res->num_rows){
						$img_obj = $img_res->fetch_object();
						$block .= "<a href='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$img_obj->file_name."'>
						<img  src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$img_obj->file_name."'></a>";							
						}
						$block .= "</td>";
						
						$block .= "<td>".stripslashes($row->name)."</td>";

						$block .= "<td>".stripslashes($row->description)."</td>";

						$block .= "<td>".stripslashes($row->category_name)."</td>";

						// fancybox fancybox.iframe
						$block .= "<td valign='top'>
						<a class='btn btn-primary' href='edit-spec.php?firstload=1&spec_id=".$row->spec_id."'>
						<i class='icon-cog icon-white'></i> Edit</a></td>";
						
						$block .= "<td valign='top'><a class='btn btn-danger  confirm' href='#'><i class='icon-remove icon-white'></i>
						<input type='hidden' class='itemId' value='".$row->spec_id."' id='".$row->spec_id."' /></a></td>";
						
						
						echo $block;
					}
				?>


				
                <!--



						<tr>
							<td><img src="<?php echo $ste_root;?>/images/drawer-openings.jpg" /></td>
							<td>Drawer Openings</td>
							<td><ul>
									<li>30" with full ext. slides</li>
									<li>39" on hutches</li>
								</ul></td>
							<td>Drawer Specifications</td>
							<td><a class='btn btn-primary  fancybox fancybox.iframe' href='edit-spec-item.php?guide_tip_id=1&ret_page=specs'><i class='icon-cog icon-white'></i> Edit</a></td>
								</td>
							<td><a class='btn btn-danger  confirm' href='#delete'><i class='icon-remove icon-white'></i>
								<input class='itemId' id='1' value='1' type='hidden' />
								</a></td>
						
                        
                        </tr>
						<tr>
							<td><img src="<?php echo $ste_root;?>/images/drawer-widths.jpg" /></td>
							<td>Drawer Widths</td>
							<td><ul>
									<li>21" - 24" - 27"</li>
									<li>30" - 32"</li>
								</ul></td>
							<td>Drawer Specifications</td>
							<td><a class='btn btn-primary  fancybox fancybox.iframe' href='edit-spec-item.php?guide_tip_id=2&ret_page=specs'><i class='icon-cog icon-white'></i> Edit</a></td>
								</td>
							<td><a class='btn btn-danger  confirm' href='#delete'><i class='icon-remove icon-white'></i>
								<input class='itemId' id='2' value='2' type='hidden' />
								</a></td>
						</tr>
						<tr>
							<td><img src="<?php echo $ste_root;?>/images/drawer-faceheight.jpg" /></td>
							<td>Drawer Face Heights</td>
							<td><ul>
									<li>5" - 7.5" - 10"</li>
								</ul></td>
							<td>Drawer Specifications</td>
							<td><a class='btn btn-primary  fancybox fancybox.iframe' href='edit-spec-item.php?guide_tip_id=3&ret_page=specs'><i class='icon-cog icon-white'></i> Edit</a></td>
								</td>
							<td><a class='btn btn-danger  confirm' href='#delete'><i class='icon-remove icon-white'></i>
								<input class='itemId' id='3' value='3' type='hidden' />
								</a></td>
						</tr>
						<tr>
							<td><img src="<?php echo $ste_root;?>/images/basket-width.jpg" /></td>
							<td>Basket Width</td>
							<td><ul>
									<li>9.25" - 21" - 24"</li>
								</ul></td>
							<td>Basket Specifications</td>
							<td><a class='btn btn-primary  fancybox fancybox.iframe' href='edit-spec-item.php?guide_tip_id=4&ret_page=specs'><i class='icon-cog icon-white'></i> Edit</a></td>
								</td>
							<td><a class='btn btn-danger  confirm' href='#delete'><i class='icon-remove icon-white'></i>
								<input class='itemId' id='4' value='4' type='hidden' />
								</a></td>
						</tr>
						<tr>
							<td><img src="<?php echo $ste_root;?>/images/basket-height.jpg" /></td>
							<td>Basket Height</td>
							<td><ul>
									<li>6" - 10" - 17"</li>
								</ul></td>
							<td>Basket Specifications</td>
							<td><a class='btn btn-primary  fancybox fancybox.iframe' href='edit-spec-item.php?guide_tip_id=5&ret_page=specs'><i class='icon-cog icon-white'></i> Edit</a></td>
								</td>
							<td><a class='btn btn-danger  confirm' href='#delete'><i class='icon-remove icon-white'></i>
								<input class='itemId' id='5' value='5' type='hidden' />
								</a></td>
						</tr>
						<tr>
							<td><img src="<?php echo $ste_root;?>/images/basket-depth.jpg" /></td>
							<td>Basket Depth</td>
							<td><ul>
									<li>12" - 15"</li>
								</ul></td>
							<td>Basket Specifications</td>
							<td><a class='btn btn-primary  fancybox fancybox.iframe' href='edit-spec-item.php?guide_tip_id=6&ret_page=specs'><i class='icon-cog icon-white'></i> Edit</a></td>
								</td>
							<td><a class='btn btn-danger  confirm' href='#delete'><i class='icon-remove icon-white'></i>
								<input class='itemId' id='6' value='6' type='hidden' />
								</a></td>
						</tr>
						<tr>
							<td><img src="<?php echo $ste_root;?>/images/shelfrod-width.jpg" /></td>
							<td>Shelf/Rod Widths</td>
							<td><ul>
									<li>12" - 16" - 18"</li>
									<li>21" - 24" - 27"</li>
									<li>30" - 32" - 36"</li>
								</ul></td>
							<td>Shelf/Rod Specifications</td>
							<td><a class='btn btn-primary  fancybox fancybox.iframe' href='edit-spec-item.php?guide_tip_id=6&ret_page=specs'><i class='icon-cog icon-white'></i> Edit</a></td>
								</td>
							<td><a class='btn btn-danger  confirm' href='#delete'><i class='icon-remove icon-white'></i>
								<input class='itemId' id='6' value='6' type='hidden' />
								</a></td>
						</tr>
                        -->
					</tbody>
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

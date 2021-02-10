<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.nav.php');
$nav = new Nav;

$progress = new SetupProgress;
$module = new Module;
$page_title = "nav bar";
$page_group = "nav";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

if(isset($_POST['edit_navbar_label'])){	
	
	$navbar_label_id = $_POST['navbar_label_id']; 
	//echo $navbar_label_id; exit;
	if($navbar_label_id > 0){
			
		$label = trim(addslashes($_POST['label'])); 
		$custom_url = (isset($_POST['custom_url'])) ? trim(addslashes($_POST['custom_url'])) : ''; 
		$first_char = substr($custom_url,0,1); 
		if($first_char == '/'){
			 $custom_url = substr($custom_url, 1); 
		}

		$page_seo_id = (isset($_POST['page_seo_id'])) ? $_POST['page_seo_id'] : 0;
		//$page_seo_id = 0;
		
		$cat_id = (isset($_POST['cat_id'])) ? $_POST['cat_id'] : 0; 
		
		$keyword_landing_id = (isset($_POST['keyword_landing_id'])) ? $_POST['keyword_landing_id'] : 0;
		
		$display_order = (isset($_POST["display_order"]) && is_numeric($_POST["display_order"]))? trim(addslashes($_POST["display_order"])) : 0;
		$active = (isset($_POST['active'])) ? $_POST['active'] : 1;
		$submenu_content_type = (isset($_POST["submenu_content_type"]))? $_POST["submenu_content_type"] : 3;
		
		if($stmt = $db->prepare("UPDATE navbar_label
								SET label = ?, url = ?, page_seo_id = ?, display_order = ?, active = ?, submenu_content_type = ?, cat_id = ?, keyword_landing_id = ?
								WHERE navbar_label_id = ? ")){
			
				$stmt->bind_param('ssiiiiiii', $label, $custom_url, $page_seo_id, $display_order, $active, $submenu_content_type, $cat_id, $keyword_landing_id  ,$navbar_label_id);
				
				$stmt->execute();
				$stmt->close();
		
			$msg = "Changes Saved.";
		}else{
			$msg = "Failed";
		}
	}
}


if(isset($_POST["add_navbar_label"])){
	
	$label = trim(addslashes($_POST["label"])); 
	$submenu_content_type = (isset($_POST["submenu_content_type"]))? $_POST["submenu_content_type"] : 3;
	
	$page_seo_id = (isset($_POST["page_seo_id"])) ? $_POST["page_seo_id"] : 0; 
		
	$cat_id = (isset($_POST['cat_id'])) ? $_POST['cat_id'] : 0; 	
	
	$keyword_landing_id = (isset($_POST['keyword_landing_id'])) ? $_POST['keyword_landing_id'] : 0;	

	$custom_url = (isset($_POST['custom_url'])) ? trim(addslashes($_POST['custom_url'])) : ''; 
		
	$sql="SELECT navbar_label_id
		  FROM navbar_label
		  WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
	$result = $dbCustom->getResult($db,$sql);
		
	$display_order = 1 + $result->num_rows;
			
	if($stmt = $db->prepare("INSERT INTO navbar_label 
							(label, url, page_seo_id, display_order, submenu_content_type, profile_account_id, cat_id, keyword_landing_id)
							VALUES (?,?,?, ?,  ?, ?, ?, ?)")){
		$stmt->bind_param('ssiiiiii', $label, $custom_url, $page_seo_id, $display_order, $submenu_content_type, $_SESSION['profile_account_id'], $cat_id, $keyword_landing_id);
				
		$stmt->execute();
		$stmt->close();
		$msg = 'Your change is now live.';
	}else{
		$msg = "Failed";
	}
	
}


if(isset($_POST["del_navbar_label"])){
		
	$navbar_label_id = $_POST["del_navbar_label_id"];
		
	$sql = sprintf("DELETE FROM navbar_label WHERE navbar_label_id = '%u'", $navbar_label_id);
	$result = $dbCustom->getResult($db,$sql);
	
	
	$sql = sprintf("DELETE FROM navbar_submenu_label WHERE navbar_label_id = '%u'", $navbar_label_id);
	$result = $dbCustom->getResult($db,$sql);

}


if(isset($_POST["set_active_and_display_order"])){
	
	$show_search_box = (isset($_POST["show_search_box"])) ? $_POST["show_search_box"] : 0;;
	
	$navbar_label_ids = $_POST["navbar_label_id"];
	$display_orders = $_POST["display_order"];

	$sql = "UPDATE main_nav_bar SET show_search_box = '".$show_search_box."' WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);
	
	$actives = (isset($_POST["active"]))? $_POST["active"] : array();
	$sql = "UPDATE navbar_label SET active = '0' WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);
	
	if(is_array($actives)){	
		foreach($actives as $key => $value){
			$sql = "UPDATE navbar_label SET active = '1' WHERE navbar_label_id = '".$value."'";
			$result = $dbCustom->getResult($db,$sql);
		}
	}
	if(is_array($display_orders)){
		for($i = 0; $i < count($display_orders); $i++){
			
			$sql = sprintf("UPDATE navbar_label 
				SET display_order = '%u'  
				WHERE navbar_label_id = '%u'",
				$display_orders[$i], $navbar_label_ids[$i]);
			$result = $dbCustom->getResult($db,$sql);
		}
	}
	$msg = "Changes Saved.";

}

// for customer facing
unset($_SESSION['nav_bar_cats']);
unset($_SESSION['navbar_labels']);
unset($_SESSION['nav_bar_brands']);
unset($_SESSION['footer_nav_cats']);
unset($_SESSION['footer_nav_brands']);
unset($_SESSION['pages']);

unset($_SESSION['footer_nav_submenu_labels']);
unset($_SESSION['footer_nav_cats']); // frontend class.nav

unset($_SESSION['temp_cats']);
unset($_SESSION['parent_cat_id']);
unset($_SESSION['cat_id']);

unset($_SESSION['home_cats']); // frontend class.nav

unset($_SESSION['has_search_box']);

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>
<script>

function regularSubmit() {
  document.form.submit(); 
}	



</script>
</head>
<body>
<?php 
$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;
$fancy = (!$strip) ? 'fancybox fancybox.iframe' : ''; 
$qs_strip = ($strip) ? 'strip=1' : ''; 

if(!$strip){
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');
}
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$sql = "SELECT show_search_box
		FROM main_nav_bar
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows > 0){
	$object = $result->fetch_object();
	$show_search_box = $object->show_search_box;
}else{
	$show_search_box = 1;
}
?>
<div class="manage_page_container">
	
		<?php 
		if(!$strip){
			echo "<div class='manage_side_nav'>";
        	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php');
			echo "</div>";
		}
		?>
	
	<div class="manage_main">
		<?php
		if(!$strip){
			require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
			$bread_crumb = new AdminBreadCrumb;
			$bread_crumb->reSet();
			$bread_crumb->add("CMS", $ste_root."manage/cms/cms-landing.php");		
			$bread_crumb->add("Nav Bar", '');
			echo $bread_crumb->output();
		}
		echo "<h1>Navigation</h1>";		
		//navigation section tabbed sub-navigation
        require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/navigation-section-tabs.php");
		
		//display success & error messages on the page instead of a JS alert
		if($msg != ''){ ?>
		<div class="alert alert-success">
			<h4><?php echo $msg; ?></h4>
		</div>
		<?php } ?>
		<form name="form" action="navbar.php?<?php echo $qs_strip; ?>" method="post" enctype="multipart/form-data">
        
        <input type="hidden" name="set_active_and_display_order" value="1">
			<?php 
			if($admin_access->cms_level > 1){ 
				if(!$strip) echo "<div class='page_actions'>";		
			?>
                    <a class="btn btn-large btn-primary <?php echo $fancy; ?>" 
                    href="add-navbar-label.php?ret_page=navbar&<?php echo $qs_strip; ?>"><i class="icon-plus icon-white"></i> Add New Nav Item </a>

            		<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </a>


					<?php $checked = ($show_search_box) ? "checked='checked'" : ''; ?> 
                    <div style='float:right; padding-right:20%; padding-left:10px;'>
                        <div class='checkboxtoggle on '> 
                        <span class='ontext'>ON</span>
                        <a class='switch on' href='#'></a>
                        <span class='offtext'>OFF</span>
                        <input type='checkbox' class='checkboxinput' name='show_search_box' value='1' <?php echo $checked; ?> />
                        </div>
                    </div>	
					<div style='float:right;'> Search Box</div>
					<div style='clear:both'></div>



            <?php         
                if(!$strip) echo "</div>";
				
				$destination = '';
            } 
			?>

			<div class="data_table">
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
							<th width="15%">Nav Label</th>
							<th width="25%">Nav Destination</th>
							<th width="11%">Order</th>
							<th width="22%">Subnavigation</th>
							<th width="12%">Edit</th>
							<th width="10%">Active</th>
							<th width="5%">Delete</th>
						</tr>
					</thead>
					<?php
				$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
			
				$sql = "SELECT * 
					FROM navbar_label
					WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
					ORDER BY display_order";
				$result = $dbCustom->getResult($db,$sql);				
				$block = '';
				while($row = $result->fetch_object()){
					
					$block .= "<tr>";
					
					$block .= "<td>".stripAllSlashes($row->label)."</td>";	
					
					
					
					if($row->keyword_landing_id > 0){
					
						$destination = $nav->getKeywordLandingURL($row->keyword_landing_id);
					
					}elseif($row->cat_id > 0){
						
						$db = $dbCustom->getDbConnect(CART_DATABASE);
						$sql = "SELECT show_in_cart
									,show_in_showroom
									,seo_url
									,profile_cat_id
								FROM category
								WHERE cat_id = '".$row->cat_id."'";
						$res = $dbCustom->getResult($db,$sql);
						
						if($res->num_rows > 0){
							$object = $res->fetch_object();
							if($object->show_in_cart){
								$destination = $_SESSION['global_url_word'].$object->seo_url.'/category.html?prodCatId='.$object->profile_cat_id;
							}else{
								$destination = $_SESSION['global_url_word'].$object->seo_url.'/showroom.html?prodCatId='.$object->profile_cat_id;														
							}
						
						}else{
							$_SESSION['navbar_labels'][$i]['url'] = $ste_root.'/'.$_SESSION['global_url_word'].'category.html';
						}
		
					
					}elseif(trim($row->url) != ''){
						$destination = $row->url;
					}else{
						$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
						$sql = "SELECT page_name, seo_name
							FROM page_seo
							WHERE page_seo_id = '".$row->page_seo_id."'
							";
						$res = $dbCustom->getResult($db,$sql);
						if($res->num_rows > 0){
							$d_obj = $res->fetch_object();
							if($_SESSION["seo"]){
								$destination = $d_obj->seo_name;
							}else{
								$destination = $d_obj->page_name;
							}
						}else{
							$destination = '';
						}
					}
					$block .= "<td>".$destination."</td>";
					//display order
					$block .= "<td valign='middle' align='center' >
					<input type='text' name='display_order[]' value='".$row->display_order."'/>
					<input type='hidden' name='navbar_label_id[]' value='".$row->navbar_label_id."' /></td>";
					
					//subnavigation					
					if($row->submenu_content_type == 3){
						$block .= "<td valign='middle'><a class='btn btn-primary' href='navbar-submenu.php?ret_page=navbar&navbar_label_id=".$row->navbar_label_id."&".$qs_strip."'>
						<i class='icon-cog icon-white'></i> Subnavigation</a></td>";   
					}else{
						$block .= "<td></td />";
					}
					
					
					//edit button
					$block .= "<td valign='middle'><a class='btn btn-primary ".$fancy."' 
					href='edit-navbar-label.php?navbar_label_id=".$row->navbar_label_id."&ret_page=navbar&".$qs_strip."'>
					<i class='icon-cog icon-white'></i> Edit</a></td>";

					$disabled = ($admin_access->cms_level < 2)? "disabled" : '';
					
					//active (on/off)
					$checked = ($row->active)? "checked='checked'" : ''; 
					$block	.= "<td align='center' valign='middle' >
					<div class='checkboxtoggle on ".$disabled." '> 
					<span class='ontext'>ON</span>
					<a class='switch on' href='#'></a>
					<span class='offtext'>OFF</span>
					<input type='checkbox' class='checkboxinput' name='active[]' value='".$row->navbar_label_id."' ".$checked." /></div></td>";	
					
					//delete button
					$block .= "<td valign='middle'>
					<a class='btn btn-danger confirm ".$disabled." '>
					<i class='icon-remove icon-white'></i>
					<input type='hidden' id='".$row->navbar_label_id."' class='itemId' value='".$row->navbar_label_id."' /></a></td>";

	
					$block .= "</tr>";	
				}
				echo $block;	

?>
				</table>
			</div>
		</form>
       	<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </a>

	</div>
	<p class="clear"></p>
	<?php 
	if(!$strip){
		require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
	}
	?>
</div>
<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this nav bar link?</h3>
	<form name="del_nbl" action="navbar.php?<?php echo $qs_strip; ?>" method="post" >
		<input id="del_navbar_label_id" class="itemId" type="hidden" name="del_navbar_label_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_navbar_label" type="submit" >Yes, Delete</button>
	</form>
</div>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>
</body>
</html>

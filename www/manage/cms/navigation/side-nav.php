<?php



if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$pages = new Pages;
$pages->setSeoPageNames($_SESSION['profile_account_id']);

$page_title = 'Side Navigation';
$page_group = 'nav';

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

if(isset($_POST['edit_side_nav_label'])){	

	$side_nav_label_id = (isset($_POST['side_nav_label_id'])) ? $_POST['side_nav_label_id'] : 0;

	if($side_nav_label_id > 0){
			
		$label = trim(addslashes($_POST['label'])); 

		$page_seo_id = $_POST['page_seo_id']; 	 
		$display_order = (isset($_POST['display_order']) && is_numeric($_POST['display_order']))? trim(addslashes($_POST['display_order'])) : 0;
		$active = (isset($_POST['active'])) ? 1 : 0;
		$cat_ids = (isset($_POST['chosen_categories']))? $_POST['chosen_categories'] : array();
		$custom_url = $_POST['custom_url']; 
	
		$cat_id = (count($cat_ids) > 0)? $cat_ids[0] : 0; 	
		
		$sql = sprintf("UPDATE side_nav_label 
			SET label = '%s', page_seo_id = '%u', display_order = '%u', active = '%u',  cat_id = '%u', custom_url = '%s' 
			WHERE side_nav_label_id = '%u'",
			$label, $page_seo_id, $display_order, $active, $cat_id, $custom_url, $side_nav_label_id);
		 
		$result = $dbCustom->getResult($db,$sql);
	}
}

if(isset($_POST['del_side_nav_label'])){
	
	$del_side_nav_label_id = (isset($_POST['del_side_nav_label_id'])) ? $_POST['del_side_nav_label_id'] : 0;
				
	$sql = sprintf("DELETE FROM side_nav_label WHERE side_nav_label_id = '%u'", $del_side_nav_label_id);
	$result = $dbCustom->getResult($db,$sql);
}

if(isset($_POST['add_side_nav_label'])){
	
	$label = trim(addslashes($_POST['label']));
	 
	$page_seo_id = (isset($_POST['page_seo_id'])) ? $_POST['page_seo_id'] : 0; 
	$active = (isset($_POST['active'])) ? 1 : 0;
	$custom_url = $_POST['custom_url'];
	$cat_ids = (isset($_POST['chosen_categories']))? $_POST['chosen_categories'] : array(); 
	
	$cat_id = (count($cat_ids) > 0)? $cat_ids[0] : 0; 	

		//if(in_array(2,$user_functions_array)){
			
			$sql="SELECT side_nav_label_id
				  FROM side_nav_label
				  WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
			$result = $dbCustom->getResult($db,$sql);
			
			$display_order = 1 + $result->num_rows;
			
			if($stmt = $db->prepare("INSERT INTO side_nav_label (label, page_seo_id, display_order, profile_account_id, cat_id, custom_url)
									VALUES (?, ?, ?, ?, ?, ?)")){
										
				$stmt->bind_param('siiiis', $label, $page_seo_id, $display_order, $_SESSION['profile_account_id'], $cat_id, $custom_url);						
				$stmt->execute();
				$stmt->close();
				$msg = 'Your change is now live.';
			}
	
		//}else{
			/*
			$sql = sprintf("INSERT INTO review (content_table, when_submitted, submitted_by_login_id, slug, content1, content2, cat_id, action) 
			VALUES ('%s','%u','%u','%s','%s','%s','%u','%s')", 
			"faq", $ts, $user_id, "faq", $question, $answere, $faq_cat_id, "add");
			$msg = "Your change is now pending approval.";
			*/
		//}
	
		//clear this so, site will load new data
		//unset($_SESSION["header_support_menu_labels"]);

}



if(isset($_POST["set_active_and_display_order"])){
	
	$side_nav_label_ids  = (isset($_POST['side_nav_label_id'])) ? $_POST['side_nav_label_id'] : array();
	$display_orders = (isset($_POST['display_order'])) ? $_POST['display_order'] : array();
	$submenu_content_type = (isset($_POST['submenu_content_type'])) ? $_POST['submenu_content_type'] : 4;
	$actives = (isset($_POST['active'])) ? $_POST['active'] : array();
	$heading = $_POST['heading'];
	
	$sql = sprintf("UPDATE side_nav 
				SET submenu_content_type = '%u'
				,heading = '%s' 
				WHERE profile_account_id = '%u'",
				$submenu_content_type, $heading, $_SESSION['profile_account_id']);
	$result = $dbCustom->getResult($db,$sql);
	
	$sql = "UPDATE side_nav_label SET active = '0' WHERE active = '1' AND profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);
	
		
	foreach($actives as $key => $value){
		$sql = "UPDATE side_nav_label SET active = '1' WHERE side_nav_label_id = '".$value."'";
		$result = $dbCustom->getResult($db,$sql);
	}

	if(is_array($display_orders)){
		for($i = 0; $i < count($display_orders); $i++){
			
			$sql = sprintf("UPDATE side_nav_label 
				SET display_order = '%u' 
				WHERE side_nav_label_id = '%u'",
				$display_orders[$i], $side_nav_label_ids[$i]);

			$result = $dbCustom->getResult($db,$sql);
			
		}
	}
	
	$msg = "Your changes have been saved.";

}


$sql = "SELECT * FROM side_nav WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows > 0){
	$object = $result->fetch_object();
	$heading = $object->heading;
    $submenu_content_type = $object->submenu_content_type;
}else{
	$heading = '';
    $submenu_content_type = 4;
}

unset($_SESSION['temp_cats']);
unset($_SESSION['parent_cat_id']);
unset($_SESSION['cat_id']);

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
$fancy = (!$strip) ? "fancybox fancybox.iframe" : ''; 
$qs_strip = ($strip) ? "strip=1" : ''; 
if(!$strip){
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');
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
			$bread_crumb->add("Nav Bar", $ste_root."manage/cms/navigation/navbar.php");
			$bread_crumb->add("Side Nav", '');
			echo $bread_crumb->output();
		}
		echo "<h1>".$page_title."</h1>";		
		
		//navigation section tabbed sub-navigation
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/navigation-section-tabs.php');
		
		//display success & error messages on the page instead of a JS alert
		if($msg != ''){ ?>
		<div class="alert alert-success">
			<h4><?php echo $msg; ?></h4>
		</div>
		<?php } else {} ?>
		<form name="form" action="side-nav.php?<?php echo $qs_strip;?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="set_active_and_display_order" value="1">
			<?php 
			if($admin_access->cms_level > 1){ 
				if(!$strip) echo "<div class='page_actions'>";		
			?>
				<a class="btn btn-large btn-primary <?php echo $fancy; ?>" 
                href='add-side-nav-label.php?<?php echo $qs_strip;?>'><i class="icon-plus icon-white"></i> Add New Side Nav Item </a>
         		<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </a>
            <?php         
                if(!$strip) echo "</div>";
            } 
			?>

			
            
            
       		<fieldset class="colcontainer">
				<legend>Side Nav Type</legend>  
                <p>Select a navigation type.</p>
				<div style="float:left;">
				<label>Use Shop by Category List</label>
				<div class="radiotoggle off"> 
                <span class="ontext">ON</span>
                <a class="switch on" href="#"></a>
                <span class="offtext">OFF</span>
                <input type="radio" class="radioinput" name="submenu_content_type" value="1"  <?php if($submenu_content_type == 1) echo "checked";?> /></div>
				</div>

				<div style="float:left; padding-left:160px;">                
				<label>Use Home Page Category List</label>
				<div class="radiotoggle off"> 
                <span class="ontext">ON</span>
                <a class="switch on" href="#"></a>
                <span class="offtext">OFF</span>
                <input type="radio" class="radioinput" name="submenu_content_type" value="4"  <?php if($submenu_content_type == 4) echo "checked";?> /></div>
				</div>


				<div style="clear:both"></div>
                
                
				<div style="float:left;">
				<label>Use Shop by Brand List </label>
				<div class="radiotoggle off"> 
                <span class="ontext">ON</span>
                <a class="switch on" href="#"></a>
                <span class="offtext">OFF</span>
                <input type="radio" class="radioinput" name="submenu_content_type" value="2"  <?php if($submenu_content_type == 2) echo "checked";?> /></div>
				</div>

				<div style="float:left; padding-left:160px;">
				<label>Use Editable Subnavigation </label>
				<div class="radiotoggle off"> 
                <span class="ontext">ON</span>
                <a class="switch on" href="#"></a>
                <span class="offtext">OFF</span>
                <input type="radio" class="radioinput" name="submenu_content_type" value="3"  <?php if($submenu_content_type == 3) echo "checked";?> /></div>
				</div>
                
                <div style="clear:both"></div>
                <br /><br />
                <label>Heading</label>
                <input type="text" name="heading" value="<?php echo prepFormInputStr($heading); ?>">
                
                
                
       </fieldset> 
            <div class="data_table">
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
							<th>Side Nav Label</th>
							<th>Destination</th>
							<th>Order</th>
							<th>Active</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
				
					<?php
					$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
						$sql = "SELECT * 
							FROM side_nav_label
							WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
							ORDER BY display_order";
						$result = $dbCustom->getResult($db,$sql);						
						$block = '';
						while($row = $result->fetch_object()){
							$block .= "<tr>";
							//nav label
							$block .= '<td>'.stripAllSlashes($row->label).'</td>';	
							//nav url
							if($row->cat_id > 0){
							
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
								}
								
						
							}elseif(trim($row->custom_url) != ''){
						
								$destination = $row->custom_url;
						
							}elseif($row->page_seo_id > 0){
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
								}
						
							}else{
								$destination = '';
							}
							$block .= "<td>".$destination."</td>";
							

							$disabled = ($admin_access->cms_level < 2)? "disabled" : '';

							// order
							$block .= "<td valign='middle'><input type='text' name='display_order[]' value='".$row->display_order."' style='width:20px' />
							<input type='hidden' name='side_nav_label_id[]' value='".$row->side_nav_label_id."' /></td>";

							//active (on/off)
							$checked = ($row->active)? "checked='checked'" : ''; 
							$block	.= "<td align='center' valign='middle' >
							<div class='checkboxtoggle on ".$disabled." '> 
							<span class='ontext'>ON</span>
							<a class='switch on' href='#'></a>
							<span class='offtext'>OFF</span>
							<input type='checkbox' class='checkboxinput' name='active[]' value='".$row->side_nav_label_id."' ".$checked." /></div></td>";	
							

							$disabled = ($admin_access->cms_level < 2)? "disabled" : '';
							
							// edit
							$block .= "<td valign='middle'><a class='btn btn-primary ".$fancy."' 
							href='edit-side-nav-label.php?side_nav_label_id=".$row->side_nav_label_id."&ret_page=header_support_menu&".$qs_strip."'>
							<i class='icon-cog icon-white'></i> Edit</a></td>";
							// delete
							$block .= "<td valign='middle'>
							<a class='btn btn-danger confirm ".$disabled." '>
							<i class='icon-remove icon-white'></i>
							<input type='hidden' id='".$row->side_nav_label_id."' class='itemId' value='".$row->side_nav_label_id."' /></a></td>";
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
	<h3>Are you sure you want to delete this nav link?</h3>
	<form name="del_nbl" action="side-nav.php?<?php echo $qs_strip; ?>" method="post">
		<input id="del_side_nav_label_id" class="itemId" type="hidden" name="del_side_nav_label_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_side_nav_label" type="submit" >Yes, Delete</button>
	</form>
	</div>

    
    
</body>
</html>




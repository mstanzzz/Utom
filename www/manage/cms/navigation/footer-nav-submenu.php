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
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.nav.php');
$nav = new Nav;
$progress = new SetupProgress;
$module = new Module;

$pages = new Pages;
$pages->setSeoPageNames($_SESSION['profile_account_id']);

$page_title = 'Nav Sub Menu';
$page_group = 'nav';

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

$footer_nav_label_id = (isset($_REQUEST['footer_nav_label_id'])) ? $_REQUEST['footer_nav_label_id'] : 0;

if(isset($_POST['edit_footer_nav_submenu_label'])){	
	
	$footer_nav_submenu_label_id = $_POST['footer_nav_submenu_label_id'];

	if($footer_nav_submenu_label_id > 0){
			
		$cat_ids = (isset($_POST['chosen_categories']))? $_POST['chosen_categories'] : array(); 
		$cat_id = (count($cat_ids) > 0)? $cat_ids[0] : 0; 	
			
		$label = trim(addslashes($_POST['label'])); 
		$custom_url = trim(addslashes($_POST['custom_url'])); 
		
		$page_seo_id = $_POST['page_seo_id']; 	
		$display_order = (isset($_POST['display_order']) && is_numeric($_POST['display_order']))? trim(addslashes($_POST['display_order'])) : 0;
		$active = isset($_POST['active"']) ? $_POST['active'] : 1;	
		
		$keyword_landing_id = (isset($_POST['keyword_landing_id']))? $_POST['keyword_landing_id'] : 0;	
		
		if($stmt = $db->prepare("UPDATE footer_nav_submenu_label 
								SET label = ?, page_seo_id = ?, display_order = ?, active = ?, cat_id = ?, custom_url = ?, keyword_landing_id = ?
								WHERE footer_nav_submenu_label_id = ? ")){
										
			$stmt->bind_param('siiiisii', $label, $page_seo_id, $display_order, $active, $cat_id, $custom_url, $keyword_landing_id, $footer_nav_submenu_label_id);						
			$stmt->execute();
			$stmt->close();
			$msg = 'Your change is now live.';
		}else{
			$msg = "Failed";
		}
	}
}

if(isset($_POST["del_footer_nav_submenu_label"])){
	
	$footer_nav_submenu_label_id = $_POST["del_footer_nav_submenu_label_id"];
	$sql = sprintf("DELETE FROM footer_nav_submenu_label WHERE footer_nav_submenu_label_id = '%u'", $footer_nav_submenu_label_id);
	$result = $dbCustom->getResult($db,$sql);
}


if(isset($_POST["add_footer_nav_submenu_label"])){
	
	$footer_nav_label_id = $_POST["footer_nav_label_id"];
	
	$label = trim(addslashes($_POST["label"])); 
	$page_seo_id = (isset($_POST["page_seo_id"])) ? $_POST["page_seo_id"] : 0; 
	$cat_ids = (isset($_POST['chosen_categories']))? $_POST['chosen_categories'] : array(); 
	$cat_id = (count($cat_ids) > 0)? $cat_ids[0] : 0; 	
	$custom_url = trim(addslashes($_POST["custom_url"])); 	
	$keyword_landing_id = (isset($_POST['keyword_landing_id']))? $_POST['keyword_landing_id'] : 0;
			
	$sql="SELECT footer_nav_submenu_label_id
				  FROM footer_nav_submenu_label
				  WHERE footer_nav_label_id = '".$footer_nav_label_id."' 
				  AND profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);
	
	$display_order = 1 + $result->num_rows;
			
			
	if($stmt = $db->prepare("INSERT INTO footer_nav_submenu_label 
							(label, page_seo_id, footer_nav_label_id, display_order, cat_id, custom_url, keyword_landing_id, profile_account_id)
							VALUES
							(?,?,?,?,?,?,?,?)")){
																		
		$stmt->bind_param('siiiisii', $label, $page_seo_id, $footer_nav_label_id, $display_order, $cat_id, $custom_url, $keyword_landing_id,  $_SESSION['profile_account_id']);						
		$stmt->execute();
		$stmt->close();
		$msg = 'Your change is now live.';
	}else{
		$msg = "Failed";
	}


}

if(isset($_POST["set_active_and_display_order"])){
	
	
	
	$footer_nav_label_id = $_POST["footer_nav_label_id"];
	$footer_nav_submenu_label_ids  = $_POST["footer_nav_submenu_label_id"];
	$display_orders = $_POST["display_order"];
	
	
	$actives = (isset($_POST["active"]))? $_POST["active"] : array();
	
	//print_r($actives);
	
	$sql = "UPDATE footer_nav_submenu_label SET active = '0' 
			WHERE active = '1'
			AND footer_nav_label_id = '".$footer_nav_label_id."' 
			AND profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);
	
		

	if(is_array($actives)){
		foreach($actives as $key => $value){
			//echo $value;
			$sql = "UPDATE footer_nav_submenu_label SET active = '1' WHERE footer_nav_submenu_label_id = '".$value."'";
			$result = $dbCustom->getResult($db,$sql);
			
			//echo "key: ".$key."   value: ".$value."<br />"; 
		}
	}
	if(is_array($display_orders)){
		for($i = 0; $i < count($display_orders); $i++){
			$sql = sprintf("UPDATE footer_nav_submenu_label 
				SET display_order = '%u' 
				WHERE footer_nav_submenu_label_id = '%u'",
				$display_orders[$i], $footer_nav_submenu_label_ids[$i]);
			$result = $dbCustom->getResult($db,$sql);
			
		}
	}
	$msg = "Your changes have been saved.";

	//clear this so, site will load new data
	unset($_SESSION["footer_nav_submenu_labels"]);

}

unset($_SESSION['temp_cat']);
unset($_SESSION['cat_id']);
unset($_SESSION["footer_nav_brands"]);
unset($_SESSION["footer_nav_cats"]);
unset($_SESSION["footer_nav_home_cats"]);
unset($_SESSION['footer_nav_labels']);

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
		//select database   
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		if(!$strip){
			require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
			$bread_crumb = new AdminBreadCrumb;
			$bread_crumb->reSet();
			$bread_crumb->add("CMS", $ste_root."manage/cms/cms-landing.php");		
			$bread_crumb->add("Nav Bar", $ste_root."manage/cms/navigation/navbar.php");
			$bread_crumb->add("Subnavigation", '');
			echo $bread_crumb->output();
		}
		//get the right item, output page header
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);		
		$sql = "SELECT label 
				FROM footer_nav_label
				WHERE footer_nav_label_id = '".$footer_nav_label_id."'
				AND profile_account_id = '".$_SESSION['profile_account_id']."'";
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$nbl_obj = $result->fetch_object();
			$current_subnav = $nbl_obj->label;
			echo "<h1>Footer Subnavigation for: ".$current_subnav."</h1>";
				
		}else{
			$current_subnav = '';	
		}
		//navigation section tabbed sub-navigation
        require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/navigation-section-tabs.php");
		
		//tell the user again where they are:
		echo "<div class='alert alert-info'>
		<span class='fltlft'>
		<a class='btn btn-info' href='footer-nav.php'>
		<i class='icon-arrow-left icon-white'></i> Back</a></span> 
		You're Editing the Subnavigation for <strong>".$current_subnav."</strong>. 
		Save your changes when you're done, and click <a href='footer-nav.php'>Back</a> to return to the footer navigation options. </div>";
		
		//display success & error messages on the page instead of a JS alert
		if($msg != ''){ ?>
		<div class="alert alert-success">
			<h4><?php echo $msg; ?></h4>
		</div>
		<?php } ?>
		<form name="form" action="footer-nav-submenu.php?<?php echo $qs_strip;?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="footer_nav_label_id" value="<?php echo $footer_nav_label_id; ?>" />
            <input type="hidden" name="set_active_and_display_order" value="1">
			<?php 
			
			if($admin_access->cms_level > 1){ 
				if(!$strip) echo "<div class='page_actions'>";		
			?>
				<a class="btn btn-large btn-primary fancybox <?php echo $fancy; ?> " 
                href='add-footer-nav-submenu-label.php?ret_page=footer-nav-submenu&<?php echo "footer_nav_label_id=".$footer_nav_label_id."&".$qs_strip; ?>'>
                <i class="icon-plus icon-white"></i> Add New <?php echo $current_subnav ?> Subnavigation Item</a>
				<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </a>
            <?php         
                if(!$strip) echo "</div>";
            } 
			
			?>
			
            <div class="data_table">
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
							<th>Footer Subnavigation Label</th>
							<th>Subnavigation Destination</th>
							<th>Display Order</th>
							<th>Active</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
					<?php
						$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
						$sql = "SELECT footer_nav_submenu_label.footer_nav_submenu_label_id
									   ,footer_nav_submenu_label.active
									   ,footer_nav_submenu_label.display_order
									   ,footer_nav_submenu_label.label
									   ,footer_nav_submenu_label.cat_id
									   ,footer_nav_submenu_label.custom_url
									   ,footer_nav_submenu_label.page_seo_id
									   ,footer_nav_submenu_label.keyword_landing_id
							FROM footer_nav_submenu_label
							WHERE footer_nav_submenu_label.footer_nav_label_id = '".$footer_nav_label_id."'
							AND footer_nav_submenu_label.profile_account_id = '".$_SESSION['profile_account_id']."'
							ORDER BY footer_nav_submenu_label.display_order";
						$result = $dbCustom->getResult($db,$sql);						
						
						$block = '';
						while($row = $result->fetch_object()){
							$block .= "<tr>";	
							//label
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
									if($_SESSION['seo']){
										$destination = $d_obj->seo_name;
									}else{
										$destination = $d_obj->page_name;
									}
								}
						
							}else{
								$destination = '';
							}

							//url	
							$block .= "<td>$destination</td>";
							//display order + hidden field
							$block .= "<td valign='middle' align='center'>
							<input type='text' name='display_order[]' value='".$row->display_order."' style='width:20px' />
							<input type='hidden' name='footer_nav_submenu_label_id[]' value='".$row->footer_nav_submenu_label_id."' /></td>";
							
							$disabled = ($admin_access->cms_level < 2)? "disabled" : '';
							
							//active (on/off)
							$checked = ($row->active)? "checked='checked'" : ''; 
							$block	.= "<td align='center' valign='middle' >
							<div class='checkboxtoggle on ".$disabled." '> 
							<span class='ontext'>ON</span>
							<a class='switch on' href='#'></a>
							<span class='offtext'>OFF</span>
							<input type='checkbox' class='checkboxinput' name='active[]' value='".$row->footer_nav_submenu_label_id."' ".$checked." /></div></td>";	

							//edit
							$block .= "<td valign='middle'><a class='btn btn-primary ".$fancy."' 
							href='edit-footer-nav-submenu-label.php?footer_nav_label_id=".$footer_nav_label_id."&footer_nav_submenu_label_id=".$row->footer_nav_submenu_label_id."&".$qs_strip."'>
							<i class='icon-cog icon-white'></i> Edit</a></td>";
														
							//delete button
							$block .= "<td valign='middle'>
							<a class='btn btn-danger confirm ".$disabled." '>
							<i class='icon-remove icon-white'></i>
							<input type='hidden' id='".$row->footer_nav_submenu_label_id."' class='itemId' value='".$row->footer_nav_submenu_label_id."' /></a></td>";

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
	<form name="del_navbar_label" action="footer-nav-submenu.php?footer_nav_label_id=<?php echo $footer_nav_label_id."&".$qs_strip; ?>" method="post">
		<input id="del_footer_nav_submenu_label_id" class="itemId" type="hidden" name="del_footer_nav_submenu_label_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_footer_nav_submenu_label" type="submit" >Yes, Delete</button>
	</form>
</div>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>
    
</body>
</html>







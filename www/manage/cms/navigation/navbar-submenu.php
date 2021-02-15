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
$msg = '';
$pages = new Pages;
$pages->setSeoPageNames($_SESSION['profile_account_id']);
$page_title = "Nav Sub Menu";
$page_group = "nav";
	
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';
$navbar_label_id = (isset($_REQUEST["navbar_label_id"])) ? $_REQUEST["navbar_label_id"] : 0;
$parent_submenu_id = (isset($_REQUEST["parent_submenu_id"])) ? $_REQUEST["parent_submenu_id"] : 0;
//$navbar_submenu_label_id = (isset($_REQUEST["navbar_submenu_label_id"])) ? $_REQUEST["navbar_submenu_label_id"] : 0;
$ret_page = (isset($_REQUEST['ret_page'])) ? $_REQUEST['ret_page'] : 'navbar';
//echo "ret_page:  ".$ret_page;
//echo "<br />";
//echo "navbar_label_id:  ".$navbar_label_id;
//echo "<br />";
//echo "parent_submenu_id:  ".$parent_submenu_id;
//echo "<br />";
if(isset($_POST['edit_navbar_submenu_label'])){	
	$navbar_submenu_label_id = (isset($_POST['navbar_submenu_label_id'])) ? $_POST['navbar_submenu_label_id'] : 0;
//echo "navbar_submenu_label_id  ".$navbar_submenu_label_id;
//echo "<br />";
	if($navbar_submenu_label_id > 0){
		$cat_ids = (isset($_POST['chosen_categories']))? $_POST['chosen_categories'] : array(); 
		$cat_id = (count($cat_ids) > 0)? $cat_ids[0] : 0; 	
			
		$label = trim(addslashes($_POST["label"])); 
		$custom_url = trim(addslashes($_POST["custom_url"])); 
		
		$first_char = substr($custom_url,0,1); 
		if($first_char == '/'){
			 $custom_url = substr($custom_url, 1); 
		}
		$page_seo_id = $_POST["page_seo_id"];
		 	
		$display_order = $_POST["display_order"];
		$active = (isset($_POST["active"]))? $_POST["active"] : 1;
		
		if($stmt = $db->prepare("UPDATE navbar_submenu_label
		 						SET label = ?, page_seo_id = ?, display_order = ?, active = ?, custom_url = ?, cat_id = ?
								WHERE navbar_submenu_label_id = ? ")){
			
			
			$stmt->bind_param('siiisii', $label, $page_seo_id, $display_order, $active, $custom_url, $cat_id, $navbar_submenu_label_id);
			$stmt->execute();
			$stmt->close();
	
		}
	}
}
if(isset($_POST["add_navbar_submenu_label"])){
	
	$cat_ids = (isset($_POST['chosen_categories']))? $_POST['chosen_categories'] : array(); 
	
	$cat_id = (count($cat_ids) > 0)? $cat_ids[0] : 0; 	
	
	$label = trim(addslashes($_POST["label"])); 
	$custom_url = trim(addslashes($_POST["custom_url"])); 
	$first_char = substr($custom_url,0,1); 
	if($first_char == '/'){
		 $custom_url = substr($custom_url, 1); 
	}
	$page_seo_id = (isset($_POST["page_seo_id"])) ? $_POST["page_seo_id"] : 0; 
	
	//if($custom_url != '') $page_seo_id = 0;
	
	$continue = 1;
	/*
	if($page_seo_id == 0){	
		$msg = "You did not select a page for your link ";
		$continue = 0;
	}
	*/
	
	if($label == ''){	
		$msg = "You did not enter a name for your label";
		$continue = 0;
	}
	
	
	
	if($continue){
	//if(in_array(2,$user_functions_array)){
		
		//ADD cat_id to table. In front end, pull the cat_id and build url
		$sql = "SELECT navbar_submenu_label_id
			  FROM navbar_submenu_label
			  WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
		if($navbar_label_id > 0){
			$sql .= " AND navbar_label_id = '".$navbar_label_id."'"; 
		}else{
			$sql .= " AND parent_submenu_id = '".$parent_submenu_id."'"; 		
		}
		$result = $dbCustom->getResult($db,$sql);
		
		$display_order = 1 + $result->num_rows;
		
		$sql = sprintf("INSERT INTO navbar_submenu_label 
						(label
						,custom_url
						,page_seo_id
						,navbar_label_id
						,parent_submenu_id
						,display_order
						,profile_account_id
						,cat_id)
		 				VALUES 
						('%s','%s','%u','%u', '%u', '%u', '%u', '%u')", 
						$label, $custom_url, $page_seo_id, $navbar_label_id, $parent_submenu_id, $display_order, $_SESSION['profile_account_id'], $cat_id);
		
		$result = $dbCustom->getResult($db,$sql);
		
		/*
		
		if($stmt = $db->prepare("INSERT INTO navbar_submenu_label
								(label, custom_url, page_seo_id, navbar_label_id, parent_submenu_id, display_order, profile_account_id, cat_id)
								VALUES
								(?,?,?,?,?,?,?,?)",
								$label, $custom_url, $page_seo_id, $navbar_label_id, $parent_submenu_id, $display_order, $_SESSION['profile_account_id'], $cat_id)){
						
			$stmt->bind_param('siiisii', $label, $page_seo_id, $display_order, $active, $custom_url, $cat_id, $navbar_submenu_label_id);
			$stmt->execute();
			$stmt->close();
	
		}
		*/
		
		
		
		$msg = "Your change is now live.";
	//}else{
		/*
		$sql = sprintf("INSERT INTO review (content_table, when_submitted, submitted_by_login_id, slug, content1, content2, cat_id, action) 
		VALUES ('%s','%u','%u','%s','%s','%s','%u','%s')", 
		"faq", $ts, $user_id, "faq", $question, $answere, $faq_cat_id, "add");
		$msg = "Your change is now pending approval.";
		*/
	//}
	}
}
if(isset($_POST["del_navbar_submenu_label"])){
	
	$navbar_submenu_label_id = (isset($_POST["del_navbar_submenu_label_id"])) ? $_POST["del_navbar_submenu_label_id"] : 0;
				
	$sql = sprintf("DELETE FROM navbar_submenu_label WHERE navbar_submenu_label_id = '%u'", $navbar_submenu_label_id);
	$result = $dbCustom->getResult($db,$sql);
	
}
if(isset($_POST['set_active_and_display_order'])){
	
	//$navbar_label_id  = $_POST['navbar_label_id'];	
	//$parent_submenu_id  = $_POST['parent_submenu_id'];
	
	$navbar_submenu_label_ids  = $_POST['navbar_submenu_label_id'];
	$display_orders = $_POST['display_order'];
	
	$actives = (isset($_POST['active']))? $_POST['active'] : array();
	
	
	if($parent_submenu_id > 0){
		$sql = "UPDATE navbar_submenu_label SET active = '0' 
				WHERE active = '1' 
				AND parent_submenu_id = '".$parent_submenu_id."'
				AND profile_account_id = '".$_SESSION['profile_account_id']."'";
			
	}else{
		$sql = "UPDATE navbar_submenu_label SET active = '0' 
				WHERE active = '1' 
				AND navbar_label_id = '".$navbar_label_id."'
				AND profile_account_id = '".$_SESSION['profile_account_id']."'";
		
	}
	
	$result = $dbCustom->getResult($db,$sql);
	
	
		
	if(is_array($actives)){
		foreach($actives as $key => $value){
			$sql = "UPDATE navbar_submenu_label SET active = '1' WHERE navbar_submenu_label_id = '".$value."'";
			$result = $dbCustom->getResult($db,$sql);
			
			//echo "key: ".$key."   value: ".$value."<br />"; 
		}
	}
	if(is_array($display_orders)){
		for($i = 0; $i < count($display_orders); $i++){
			$sql = sprintf("UPDATE navbar_submenu_label 
				SET display_order = '%u' 
				WHERE navbar_submenu_label_id = '%u'",
				$display_orders[$i], $navbar_submenu_label_ids[$i]);
			$result = $dbCustom->getResult($db,$sql);
			
		}
	}
	
	$msg = "Your changes have been saved.";
	
}
unset($_SESSION['nav_bar_cats']);
unset($_SESSION['navbar_labels']);
unset($_SESSION['nav_bar_brands']);
unset($_SESSION['footer_nav_cats']);
unset($_SESSION['footer_nav_brands']);
unset($_SESSION['navbar_submenu_labels']);
unset($_SESSION['footer_nav_submenu_labels']);
unset($_SESSION['footer_nav_cats']); // frontend class.nav
unset($_SESSION['pages']);
unset($_SESSION['temp_cat']);
unset($_SESSION['cat_id']);
unset($_SESSION['home_cats']); // frontend class.nav
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
	if($msg != ''){ 
		echo "<div style='color:red;'>".$msg."</div>";
	}
	
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
		if($navbar_label_id > 0){
			$sql = "SELECT label 
				FROM navbar_label
				WHERE navbar_label_id = '".$navbar_label_id."'
				AND profile_account_id = '".$_SESSION['profile_account_id']."'";
		}else{
			$sql = "SELECT label 
				FROM navbar_submenu_label
				WHERE navbar_submenu_label_id = '".$parent_submenu_id."'
				AND profile_account_id = '".$_SESSION['profile_account_id']."'";
		}
					
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$nbl_obj = $result->fetch_object();
			$current_subnav_line = "You're Editing the Subnavigation for <strong>".stripslashes($nbl_obj->label)."</strong>.";			 
			$current_subnav = stripslashes($nbl_obj->label);
		}else{
			$current_subnav_line = '';
			$current_subnav = '';	
		}
		//navigation section tabbed sub-navigation
        require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/navigation-section-tabs.php");
		
		//tell the user again where they are:
		
		echo "<div class='alert alert-info'><span class='fltlft'>
		<a class='btn btn-info' href='navbar.php'>
		<i class='icon-arrow-left icon-white'></i> Back</a></span> 
		".$current_subnav_line." 
		Save your changes when you're done, and click <a href='navbar.php'>Back</a> to return to the main navigation options. </div>";
		
		//display success & error messages on the page instead of a JS alert
		if($msg != ''){ ?>
		<div class="alert alert-success">
			<h4><?php echo $msg; ?></h4>
		</div>
		<?php } ?>
		<form name="form" action="navbar-submenu.php?<?php echo $qs_strip; ?>" method="post">
        
        	<input type="hidden" name="navbar_label_id" value="<?php echo $navbar_label_id; ?>" />
			<input type="hidden" name="parent_submenu_id" value="<?php echo $parent_submenu_id; ?>" />
            <input type="hidden" name="set_active_and_display_order" value="1">
            <input type="hidden" name="ret_page" value="<?php echo $ret_page; ?>">
			
			
		
			<?php 
			if($admin_access->cms_level > 1){ 
				if(!$strip) echo "<div class='page_actions'>";
				
				$url_str = '?ret_page=navbar-submenu';
				$url_str .= '&parent_submenu_id='.$parent_submenu_id;
				$url_str .= '&navbar_label_id='.$navbar_label_id;
				$url_str .= '&'.$qs_strip;;
				
			?>
 				<a class="btn btn-large btn-primary <?php echo $fancy; ?>" href='add-navbar-submenu-label.php<?php echo $url_str; ?>'>
                <i class="icon-plus icon-white"></i> Add New <?php echo $current_subnav ?> Navigation Item </a>
          		<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </a>
           <?php         
                if(!$strip) echo "</div>";
            } 
			?>
            <div class="data_table">
				
                <table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
							<th>Nav Label</th>
							<th>Nav Destination</th>
							<th>Order</th>
							<th>Subnavigation</th>
                            <th>Active</th>
                            <th width="12%">Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
				<?php
					$sql = "SELECT navbar_submenu_label_id
								   ,active
								   ,display_order
								   ,label
								   ,page_seo_id
								   ,custom_url
								   ,cat_id
					FROM navbar_submenu_label
					WHERE navbar_submenu_label.profile_account_id = '".$_SESSION['profile_account_id']."'";
					
					if($navbar_label_id > 0){
						$sql .= " AND navbar_submenu_label.navbar_label_id = '".$navbar_label_id."'";	
								
					}else{
						$sql .= " AND navbar_submenu_label.parent_submenu_id = '".$parent_submenu_id."'";	
					}
					$sql .= " ORDER BY navbar_submenu_label.display_order";	
					
					$result = $dbCustom->getResult($db,$sql);					
					$block = '';
					while($row = $result->fetch_object()){
							$block .= '<tr>';
							//nav label
							$block .= '<td>'.stripslashes($row->label).'</td>';	
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
							//display order + hidden field
							$block .= "<td valign='middle' align='center' ><input type='text' name='display_order[]' 
							value='".$row->display_order."' style='width:20px' /><input type='hidden' name='navbar_submenu_label_id[]' value='".$row->navbar_submenu_label_id."' /></td>";
							//active (on/off)
								
							// sub nav button
							
					if($row->cat_id == 0){
						$block .= "<td valign='middle'><a class='btn btn-primary' href='navbar-submenu.php?ret_page=navbar-submenu&parent_submenu_id=".$row->navbar_submenu_label_id."&".$qs_strip."'>
						<i class='icon-cog icon-white'></i> Subnavigation</a></td>";   
					}else{
						$block .= "<td></td />";
					}
								
							$disabled = ($admin_access->cms_level < 2)? "disabled" : '';
							
							//active (on/off)
							$checked = ($row->active)? "checked='checked'" : ''; 
							$block	.= "<td align='center' valign='middle' >
							<div class='checkboxtoggle on ".$disabled." '> 
							<span class='ontext'>ON</span>
							<a class='switch on' href='#'></a>
							<span class='offtext'>OFF</span>
							<input type='checkbox' class='checkboxinput' name='active[]' value='".$row->navbar_submenu_label_id."' ".$checked." /></div></td>";	
						//edit
							$block .= "<td valign='middle'><a class='btn btn-primary ".$fancy."' 
							href='edit-navbar-submenu-label.php?ret_page=".$ret_page."&navbar_label_id=".$navbar_label_id."&parent_submenu_id=".$parent_submenu_id."&navbar_submenu_label_id=".$row->navbar_submenu_label_id."&".$qs_strip."'>
							<i class='icon-cog icon-white'></i> Edit</a></td>";
							//delete button
							$block .= "<td valign='middle'>
							<a class='btn btn-danger confirm ".$disabled." '>
							<i class='icon-remove icon-white'></i>
							<input type='hidden' id='".$row->navbar_submenu_label_id."' class='itemId' value='".$row->navbar_submenu_label_id."' /></a></td>";
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
	<form name="del_nbl" action="navbar-submenu.php" method="post" >
        <input type="hidden" name="navbar_label_id" value="<?php echo $navbar_label_id; ?>" >
        <input type="hidden" name="parent_submenu_id" value="<?php echo $parent_submenu_id; ?>" >
        <input type="hidden" name="ret_page" value="<?php echo $ret_page; ?>" >
		<input id="del_navbar_submenu_label_id" class="itemId" type="hidden" name="del_navbar_submenu_label_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_navbar_submenu_label" type="submit" >Yes, Delete</button>
	</form>
</div>

</body>
</html>
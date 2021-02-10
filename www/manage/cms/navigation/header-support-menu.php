<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;
$pages = new Pages;
$pages->setSeoPageNames($_SESSION['profile_account_id']);
$page_title = "Header Support Menu";
$page_group = "nav";
	
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

if(isset($_POST["edit_header_support_menu_label"])){	

	$header_support_menu_label_id = (isset($_POST["header_support_menu_label_id"])) ? $_POST["header_support_menu_label_id"] : 0;

	if($header_support_menu_label_id > 0){
			
		$label = trim(addslashes($_POST['label'])); 
		$page_seo_id = $_POST['page_seo_id']; 	 
		$display_order = (isset($_POST['display_order']) && is_numeric($_POST['display_order']))? trim(addslashes($_POST['display_order'])) : 0;
		$active = (isset($_POST["active"])) ? 1 : 0;
	
		if($stmt = $db->prepare("UPDATE header_support_menu_label
							SET label = ?, page_seo_id = ?, display_order = ?, active = ? 
							WHERE header_support_menu_label_id = ? ")){
								
			$stmt->bind_param('siiii', $label, $page_seo_id, $display_order, $active, $header_support_menu_label_id);				
			$stmt->execute();
			$stmt->close();
	
			$msg = "Your change is now live.";
		}
	
		unset($_SESSION['header_support_menu_labels']);
	}
	
}



if(isset($_POST['del_header_support_menu_label'])){
	
	$header_support_menu_label_id = (isset($_POST["del_header_support_menu_label_id"])) ? $_POST["del_header_support_menu_label_id"] : 0;
				
	$sql = sprintf("DELETE FROM header_support_menu_label WHERE header_support_menu_label_id = '%u'", $header_support_menu_label_id);
	$result = $dbCustom->getResult($db,$sql);
	//clear this so, site will load new data
	unset($_SESSION["header_support_menu_labels"]);

}



if(isset($_POST["add_header_support_menu_label"])){
	
	//$header_support_menu_label_id = (isset($_POST["header_support_menu_label_id"])) ? $_POST["header_support_menu_label_id"] : 0;
	
	$label = trim(addslashes($_POST['label'])); 
	$page_seo_id = (isset($_POST['page_seo_id'])) ? $_POST['page_seo_id'] : 0; 
		
	if($page_seo_id > 0){

		//if(in_array(2,$user_functions_array)){
			
			$sql="SELECT header_support_menu_label_id
				  FROM header_support_menu_label
				  WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
			$result = $dbCustom->getResult($db,$sql);
			
			$display_order = 1 + $result->num_rows;
			
			if($stmt = $db->prepare("INSERT INTO header_support_menu_label (label, page_seo_id, display_order, profile_account_id)
			 						VALUES (?,?, ?, ?)")){
				$stmt->bind_param('siii', $label, $page_seo_id, $display_order, $_SESSION['profile_account_id']);
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
		unset($_SESSION["header_support_menu_labels"]);
	}

}



if(isset($_POST["set_active_and_display_order"])){
	
	$header_support_menu_label_ids  = $_POST["header_support_menu_label_id"];
	$display_orders = $_POST["display_order"];
	
	$actives = $_POST["active"];
	
	$sql = "UPDATE header_support_menu_label SET active = '0' WHERE active = '1' AND profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);
		
	foreach($actives as $key => $value){
		$sql = "UPDATE header_support_menu_label SET active = '1' WHERE header_support_menu_label_id = '".$value."'";
		$result = $dbCustom->getResult($db,$sql);
		
		//echo "key: ".$key."   value: ".$value."<br />"; 
	}

	if(is_array($display_orders)){
		for($i = 0; $i < count($display_orders); $i++){
			$sql = sprintf("UPDATE header_support_menu_label 
				SET display_order = '%u' 
				WHERE header_support_menu_label_id = '%u'",
				$display_orders[$i], $header_support_menu_label_ids[$i]);

			$result = $dbCustom->getResult($db,$sql);
			
		}
	}
	$msg = "Your changes have been saved.";

	//clear this so, site will load new data
	unset($_SESSION['footer_nav_labels']);

}

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
			$bread_crumb->add("Header Nav", '');
			echo $bread_crumb->output();
		}
		echo "<h1>".$page_title."</h1>";		
		
		//navigation section tabbed sub-navigation
        require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/navigation-section-tabs.php");
		
		//display success & error messages on the page instead of a JS alert
		if($msg != ''){ ?>
		<div class="alert alert-success">
			<h4><?php echo $msg; ?></h4>
		</div>
		<?php } else {} ?>
		<form name="form" action="header-support-menu.php?<?php echo $qs_strip;?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="set_active_and_display_order" value="1">
			<?php 
			if($admin_access->cms_level > 1){ 
				if(!$strip) echo "<div class='page_actions'>";		
			?>
				<a class="btn btn-large btn-primary <?php echo $fancy; ?>" 
                href='add-header_support_menu_label.php?<?php echo $qs_strip;?>'><i class="icon-plus icon-white"></i> Add New Nav Item </a>
         		<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </a>
            <?php         
                if(!$strip) echo "</div>";
            } 
			?>

			<div class="data_table">
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
							<th>Nav Item Label</th>
							<th>Nav Item Destination</th>
							<th>Order</th>
							<th>Active</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
				
					<?php
						$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
						$sql = "SELECT * 
							FROM header_support_menu_label
							WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
							ORDER BY display_order";
						$result = $dbCustom->getResult($db,$sql);						
						$block = '';
						while($row = $result->fetch_object()){
							$block .= "<tr>";	
							// name
							$block .= "<td>".stripslashes($row->label)."</td>";
							// url (todo)	
							$sql = "SELECT page_name, seo_name
								FROM page_seo
								WHERE page_seo_id = '".$row->page_seo_id."'";
							$res = $dbCustom->getResult($db,$sql);	
							if($res->num_rows > 0){
								$d_obj = $res->fetch_object();
								if($_SESSION['seo']){
									$destination = $d_obj->seo_name;
								}else{
									$destination = $d_obj->page_name;
								}
							}else{
								$destination = '';
							}
							$block .= '<td>'.$destination.'</td>';
							// order
							$block .= "<td valign='middle'><input type='text' name='display_order[]' value='".$row->display_order."' style='width:20px' /></td>";

							$disabled = ($admin_access->cms_level < 2)? "disabled" : '';

							//active (on/off)
							$checked = ($row->active)? "checked='checked'" : ''; 
							$block	.= "<td align='center' valign='middle' >
							<div class='checkboxtoggle on ".$disabled." '> 
							<span class='ontext'>ON</span>
							<a class='switch on' href='#'></a>
							<span class='offtext'>OFF</span>
							<input type='checkbox' class='checkboxinput' name='active[]' value='".$row->header_support_menu_label_id."' ".$checked." /></div></td>";	
							
							//hidden field
							$block .= "<input type='hidden' name='header_support_menu_label_id[]' value='".$row->header_support_menu_label_id."' />";
							// edit
							$block .= "<td valign='middle'><a class='btn btn-primary ".$fancy."' 
							href='edit-header-support-menu-label.php?header_support_menu_label_id=".$row->header_support_menu_label_id."&ret_page=header_support_menu&".$qs_strip."'>
							<i class='icon-cog icon-white'></i> Edit</a></td>";
							// delete
							$block .= "<td valign='middle'>
							<a class='btn btn-danger confirm ".$disabled." '>
							<i class='icon-remove icon-white'></i>
							<input type='hidden' id='".$row->header_support_menu_label_id."' class='itemId' value='".$row->header_support_menu_label_id."' /></a></td>";
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
	<form name="del_nbl" action="header-support-menu.php?<?php echo $qs_strip; ?>" method="post">
		<input id="del_header_support_menu_label_id" class="itemId" type="hidden" name="del_header_support_menu_label_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_header_support_menu_label" type="submit" >Yes, Delete</button>
	</form>
	</div>

    
    
</body>
</html>




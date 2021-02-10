<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
//$module = new Module;
//module is instantiated in included script restrict_redirect.php  
$pages = new Pages;


$page_title = "Design Services";
$page_group = "page";

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

if(isset($_POST['set_active'])){
	
	$actives = (isset($_POST["active"])) ? $_POST["active"] : array();  
	 
	//print_r($actives);
	 	
	$sql = "UPDATE page_seo SET active = '0' WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);
	
		
	foreach($actives as $value){
		
		
		$sql = "UPDATE page_seo SET active = '1' WHERE page_seo_id = '".$value."'";
		$result = $dbCustom->getResult($db,$sql);
		
	}

	$optionals = (isset($_POST["optional"])) ? $_POST["optional"] : array();  
	
	//print_r($optionals);

	$sql = "UPDATE page_seo SET optional = '0'";
	$result = $dbCustom->getResult($db,$sql);
	
	
	foreach($optionals as $value){
		$sql = "UPDATE page_seo SET optional = '1' WHERE page_name = '".$value."'";
		$result = $dbCustom->getResult($db,$sql);
		
	}


	$ssls = (isset($_POST["ssl"])) ? $_POST["ssl"] : array();  

 	//print_r($ssls);


	$sql = "UPDATE page_seo SET mssl = '0'";
	$result = $dbCustom->getResult($db,$sql);
	

	foreach($ssls as $value){
		$sql = "UPDATE page_seo SET mssl = '1' WHERE page_seo_id = '".$value."'";
		$result = $dbCustom->getResult($db,$sql);
		

	}



	$msg = "Changes Saved.";

}

unset($_SESSION["temp_page_fields"]);
unset($_SESSION['page_bc_array']);
unset($_SESSION['bc_page_title']);
unset($_SESSION["temp_home_fields"]);
unset($_SESSION["installation_id"]);
unset($_SESSION["home_id"]);
unset($_SESSION['new_img_id']);
unset($_SESSION['img_id']);

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
		
		echo "<h1>".$page_title."</h1>"; 
		
		// select database
    	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		
		require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		$bread_crumb->add("CMS", $ste_root."manage/cms/cms-landing.php");
		$bread_crumb->add($page_title, '');
        echo $bread_crumb->output();

		
		// breadcrumbs
		// put success/error messages on the page instead of a JS alertbox
		if($msg != ''){ ?>
		<div class="alert alert-success">
			<h4><?php echo $msg; ?></h4>
		</div>
		<?php } ?>
		<form name="form" action="../pages/page.php" method="post">
        	<input type="hidden" name="set_active_design_services" value="1">
			<div class="alert alert-info"> <em><strong>Note:</strong> Added pages are <strong>inactive (off)</strong> until set to <strong>show</strong> by an Admin user.</em> </div>
			<?php if($admin_access->cms_level > 1){ ?>
				<div class="page_actions">
					<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </a>
				</div>
            <?php } ?>

			<div class="data_table">
				<table cellpadding="15" cellspacing="0">
					<thead>
						<tr>
							<th width="30%">Page Name</th>
							<th>Page URL</th>
							<?php if(getProfileType() == "master"){ ?>
                            <th width="13%">Optional</th>
                            <?php } ?>
							<th width="13%">Is SSL</th>
                            <th width="13%">Edit</th>
							<th width="13%">Active</th>
						</tr>
					</thead>
                
                <?php
				
					$page_list_array = $pages->getPageDesignListArray($_SESSION['profile_account_id']);

					//print_r($page_list_array);

					$block = '';				
					foreach($page_list_array as $page_v){
				?>

					<tr> 
						<!-- Page Name -->
						<td><?php echo ucwords($page_v['page_name']); ?></td>
						<!-- Page URL (front end)-->
						<td><?php echo $page_v['url']; ?></td>
						
                        <?php 
						$disabled = ($admin_access->cms_level < 2)? "disabled" : '';
						
						if(getProfileType() == "master"){ 
							
							if($page_v['page_name'] != 'home'){
							
							$status = ($page_v['optional'])? "checked='checked'" : '';							
							echo "<td valign='middle'><div class='checkboxtoggle on ".$disabled." '> 
							<span class='ontext'>ON</span>
							<a class='switch on' href='#'></a>
							<span class='offtext'>OFF</span>
							<input type='checkbox' class='checkboxinput' name='optional[]' value='".$page_v['page_name']."' $status /></div></td>";
							
							}else{
								echo "<td>&nbsp;</td>";
							}
						}
						?>
                        
                        </td>
                		<!-- Is SSL -->
						<td valign="middle">
						<?php
							$is_ssl = ($page_v['mssl'])? "checked='checked'" : '';
							echo "<div class='checkboxtoggle on ".$disabled." '> 
							<span class='ontext'>ON</span>
							<a class='switch on' href='#'></a>
							<span class='offtext'>OFF</span>
							<input type='checkbox' class='checkboxinput' name='ssl[]' value='".$page_v['page_seo_id']."' $is_ssl /></div>";
						?>                
						</td>                
                        <!-- Edit Button -->
						<td valign="middle">
 						<?php  
						if($page_v['page_id'] != 0){ 			
echo "<a class='btn btn-primary ".$disabled." '";
echo " href='".$page_v['page_manage_path']."'> <i class='icon-cog icon-white'></i>Edit</a>";
						}
						?>
                        </td>
						<td valign="middle">
						<?php 
						
						
						
						if($page_v['available']){
						
							
							if($page_v['page_name'] == 'design'){
							
								$status = "checked='checked'";	
								
							}else{
							 
								$status = ($page_v['active'])? "checked='checked'" : '';
							}
							echo "<div class='checkboxtoggle on ".$disabled." '> 
							<span class='ontext'>ON</span>
							<a class='switch on' href='#'></a>
							<span class='offtext'>OFF</span>
							<input type='checkbox' class='checkboxinput' name='active[]' value='".$page_v['page_seo_id']."' $status /></div>";
						 }
						 
						 if(!$page_v['available']){
						  	echo "Page not available";
						 }
						 
						 
						 ?>
						</td>
						
					</tr>
						
				<?php } ?>
				
                </table>
			</div>
		</form>
        <a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </a>
	</div>
	<p class="clear"></p>
	<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
?>
</div>
<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this page?</h3>
	<form name="del_page_form" action="page.php" method="post" target="_top">
		<input id="del_page_id" class="itemId" type="hidden" name="del_page_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_page" type="submit" >Yes, Delete</button>
	</form>
</div>
<div class="disabledMsg">
	<p>Sorry, function is disabled.</p>
</div>
</body>
</html>

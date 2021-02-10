<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Showroom Banner";
$page_group = '';

	

$action = (isset($_GET["action"])) ? $_GET["action"] : '';

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$banner_id =  (isset($_GET['banner_id'])) ? $_GET['banner_id'] : 0;

if(isset($_POST["add_banner"])){
	
	//$title = trim(addslashes($_POST['title'])); 
	$url = trim(addslashes($_POST['url']));
	$img_alt_text = trim(addslashes($_POST['img_alt_text']));
	
	//$description = trim(addslashes($_POST['description']));
	$img_id = $_POST['img_id'];
	$ts = time();

	//if(in_array(2,$user_functions_array)){

		$sql = sprintf("INSERT INTO banner (url, img_id, slug, img_alt_text, profile_account_id) VALUES ('%s','%u', '%s', '%s','%u')", 
		$url, $img_id, 'showroom', $img_alt_text, $_SESSION['profile_account_id']);
		//$msg = "Your change is now live.";


	//}else{
		//echo "You do not have permission to add a banner";
	//}
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$result = $dbCustom->getResult($db,$sql);
	
	//$progress->completeStep("banner" ,$_SESSION['profile_account_id']);


}

if(isset($_POST["edit_banner"])){
	
	//$title = trim(addslashes($_POST['title'])); 
	$url = trim(addslashes($_POST['url']));
	$img_alt_text = trim(addslashes($_POST['img_alt_text']));
	//$description = trim(addslashes($_POST['description']));
	$img_id = $_POST['img_id'];
	$banner_id = $_POST["banner_id"];

	
	$ts = time();


	//if(in_array(2,$user_functions_array)){
		
		$sql = sprintf("UPDATE banner 
					   SET url = '%s'
						,img_id = '%u'
						,img_alt_text = '%s'
					   WHERE banner_id = '%u'",
					   $url, $img_id, $img_alt_text, $banner_id);
		$msg = "Your change is now live.";

	//}else{
		//echo "You do not have permission to edit a banner";
	//}
	
	//echo $sql;
	
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$result = $dbCustom->getResult($db,$sql);
	

	//$progress->completeStep("banner" ,$_SESSION['profile_account_id']);


}

if(isset($_POST["del_banner"])){

	$banner_id = $_POST["del_banner_id"];

	//echo $banner_id;

	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

	$sql = "SELECT img_id FROM banner WHERE banner_id = '".$banner_id."'";
	$result = $dbCustom->getResult($db,$sql);
	
	if($result->num_rows > 0){
		$img_obj = $result->fetch_object();
		
		$sql = "SELECT file_name FROM image WHERE img_id = '".$img_obj->img_id."'";
		$result = $dbCustom->getResult($db,$sql);
		
		if($result->num_rows > 0){
			$fn_obj = $result->fetch_object();
			$myFile = $ste_root."/ul_cms/".$domain."/".$fn_obj->file_name;
			if(file_exists($myFile)) unlink($myFile);
		}		
		
		$sql = "DELETE FROM image WHERE img_id = '".$img_obj->img_id."'";
		$result = $dbCustom->getResult($db,$sql);
		
	}

	$sql = sprintf("DELETE FROM banner WHERE banner_id = '%u'", $banner_id);
	$result = $dbCustom->getResult($db,$sql);
	

}

if(isset($_POST['set_active'])){

	$actives = (isset($_POST["active"]))? $_POST["active"] : array();
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = "UPDATE banner SET hide = '1' WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);
			

	if(is_array($actives)){	
		foreach($actives as $key => $value){
			$sql = "UPDATE banner SET hide = '0' WHERE banner_id = '".$value."'";
			$result = $dbCustom->getResult($db,$sql);
			
			//echo "key: ".$key."   value: ".$value."<br />"; 
		}
	}
}


unset($_SESSION['temp_banner_fields']);
unset($_SESSION['img_id']);


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>
<script>

$(document).ready(function() {
	$('.fancybox').fancybox({
		autoSize : false,
		height : 800,
		width : 940
	});
	
});

function regularSubmit() {
  document.form.submit(); 
}	

</script>


</head>

<body>
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
		$bread_crumb->add("Ecommerce", $ste_root."manage/ecomsettings/ecommerce-landing.php");
		$bread_crumb->add("Showroom banner", '');
		echo $bread_crumb->output();

        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
		?>
		<form name="form" action="showroom-banner.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="set_active" value="1">
			<?php if($admin_access->ecommerce_level > 1){ ?>	
				<div class="page_actions">
					<a class="btn btn-large btn-primary fancybox fancybox.iframe" href="add-showroom-banner.php?ret_page=showroom-banner.php"><i class="icon-plus icon-white"></i> Add a New Showroom Banner </a>
                	<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </a>  	       
                </div>
			<?php } 
		
			$sortby = (isset($_GET['sortby'])) ? trim(mysql_escape_string($_GET['sortby'])) : '';
			$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
			
			$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;
			
			$truncate = (isset($_GET['truncate'])) ? addslashes($_GET['truncate']) : 1;
			
			$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
				
			$sql = "SELECT *  
					FROM banner
					WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
					AND slug = 'showroom'";
			$nmx_res = $dbCustom->getResult($db,$sql);
			
			
			$total_rows = $nmx_res->num_rows;
			$rows_per_page = 16;
			$last = ceil($total_rows/$rows_per_page); 
						
			if ($pagenum < 1){ 
				$pagenum = 1; 
			}elseif ($pagenum > $last){ 
				$pagenum = $last; 
			} 
						
			$limit = ' limit ' .($pagenum - 1) * $rows_per_page.','.$rows_per_page;
				
			if($sortby != ''){
				if($sortby == 'hide'){
					if($a_d == 'd'){
						$sql .= " ORDER BY hide DESC".$limit;
					}else{
						$sql .= " ORDER BY hide".$limit;	
					}
				}
			}else{
				$sql .= " ORDER BY banner_id".$limit;					
			}
							
	$result = $dbCustom->getResult($db,$sql);			
						
			if($total_rows > $rows_per_page){
				echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "ecomsettings/showroom-banner.php", $sortby, $a_d);
				echo "<br /><br /><br />";
			}
	
		
		
		?>


			<div class="data_table">
            	<?php require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/tablesort.php"); ?>
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
							<th>Image</th>
                            <th  width="15%"<?php addSortAttr('hide',true); ?>>
                            	Active
                            	<i <?php addSortAttr('hide',false); ?>></i>
                       		</th>
							<th width="12%">Edit</th>
							<th width="5%">Delete</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
						$block = "<tr>"; 
						while($row = $result->fetch_object()) {
							
							$sql = "SELECT file_name  
									FROM image
									WHERE img_id = ".$row->img_id.'';
						
							$img_res = $dbCustom->getResult($db,$sql);
							
							if($img_res->num_rows > 0){
								$img_obj = $img_res->fetch_object(); 
								$block .= "<td valign='top'>
								<img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cms/banner/small/".$img_obj->file_name."' width='200px;' /></td>";								
							}else{
								$block .= "<td valign='top'>&nbsp;</td>";								
								
							}
							//active
							if($row->hide){
								$show_hide = '';
							}else{
								$show_hide = "checked='checked'";	
							}
							
							$disabled = ($admin_access->ecommerce_level < 2)? "disabled" : '';
							
							$block .= "<td valign='top'><div class='radiotoggle on ".$disabled."'> 
							<span class='ontext'>ON</span>
							<a class='switch on' href='#'></a>
							<span class='offtext'>OFF</span>
							<input type='radio' class='radioinput' name='active[]' value='".$row->banner_id."' ".$show_hide." /></div></td>";

							//edit
							$block .= "<td valign='top'><a href='edit-showroom-banner.php?firstload=1&banner_id=".$row->banner_id."&ret_page=showroom-banner' class='btn btn-primary btn-small fancybox fancybox.iframe'><i class='icon-cog icon-white'></i> Edit</a></td>";

							//delete
							//$block .= "<td valign='top'><div class='manage_blue_button'><a class='inline' href='#delete'>Delete</div><div class='e_sub' id='".$row->banner_id."' style='display:none'></div><div class='i_sub' id='".$row->file_name."' style='display:none'></div> </a></td>";
//$block .= "<td valign='middle' class='center'><a class='btn btn-danger btn-small confirm' href='#'><input type='hidden' id=".$row->banner_id."' class='itemId'  value='".$row->banner_id."'/><i class='icon-remove icon-white'></i></a></td>";
$block .= "<td valign='middle'><a class='btn btn-danger btn-small confirm'><i class='icon-remove icon-white'></i><input type='hidden' id='".$row->banner_id."' class='itemId' value='".$row->banner_id."' /></a></td>";		




							$block .= "</tr>";
						}
						echo $block;
					?>
				</tbody>
			</table>
		</div>
	</form>
</div>
<p class="clear"></p>
<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
?>  

</div>

<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this banner?</h3>
	<form name="del_banner" action="showroom-banner.php" method="post" target="_top">
		<input id="del_banner_id" class="itemId" type="hidden" name="del_banner_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_banner" type="submit" >Yes, Delete</button>
	</form>
</div>

</body>
</html>




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

$page_title = "Keyword Landing Pages";
$page_group = "keyword-landing";
$msg = '';

$ts = time();

	
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$strip = '';

if(isset($_POST['add_keyword_landing'])){
	
	//$intro = trim(addslashes($_POST['intro']));	
	$intro = '';
	//$mssl = (isset($_POST['mssl']))? 1 : 0;
	$url_name = trim(getUrlText($_POST['url_name']));
	$meta_title = trim(addslashes($_POST['meta_title']));
	$meta_keywords = trim(addslashes($_POST['meta_keywords']));
	$meta_description = trim(addslashes($_POST['meta_description']));

	$videos_btn_text = trim(addslashes($_POST['videos_btn_text']));
	$design_btn_text = trim(addslashes($_POST['design_btn_text']));
	$specs_btn_text = trim(addslashes($_POST['specs_btn_text']));
	$cat_1_btn_text = trim(addslashes($_POST['cat_1_btn_text']));
	$cat_2_btn_text = trim(addslashes($_POST['cat_2_btn_text']));
	$cat_3_btn_text = trim(addslashes($_POST['cat_3_btn_text']));
	$cat_4_btn_text = trim(addslashes($_POST['cat_4_btn_text']));
	$heading = trim(addslashes($_POST['heading']));
	$sub_heading = trim(addslashes($_POST['sub_heading']));
	
	$description_tab_content = trim(addslashes($_POST['description_tab_content']));
	$doc_tab_content = trim(addslashes($_POST['doc_tab_content']));
	
	$show_on_home_page = (isset($_POST['show_on_home_page'])) ? 1 : 0;

	$stmt = $db->prepare("INSERT INTO keyword_landing
						(intro
						,url_name
						,meta_title
						,meta_keywords						
						,meta_description
						,videos_btn_text
						,design_btn_text
						,specs_btn_text
						,cat_1_btn_text
						,cat_2_btn_text
						,cat_3_btn_text
						,cat_4_btn_text
						,heading
						,sub_heading
						,description_tab_content
						,doc_tab_content
						,main_img_id
						,video_img_id 
						,start_design_img_id
						,specs_img_id
						,cat_1_id
						,cat_2_id
						,cat_3_id
						,cat_4_id						
						,last_update
						,show_on_home_page
						,profile_account_id)
						VALUES
						(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");	
						
						//print_r($stmt);						
						//echo 'Error '.$db->error;						
	
	if(!$stmt->bind_param('ssssssssssssssssiiiiiiiiiii'
					,$intro
					,$url_name
					,$meta_title
					,$meta_keywords						
					,$meta_description
					,$videos_btn_text
					,$design_btn_text
					,$specs_btn_text
					,$cat_1_btn_text
					,$cat_2_btn_text
					,$cat_3_btn_text
					,$cat_4_btn_text
					,$heading
					,$sub_heading
					,$description_tab_content
					,$doc_tab_content
					,$_SESSION['temp_page_fields']['main_img_id']
					,$_SESSION['temp_page_fields']['video_img_id']
					,$_SESSION['temp_page_fields']['start_design_img_id']
					,$_SESSION['temp_page_fields']['specs_img_id']
					,$_SESSION['temp_page_fields']['cat_1_id']
					,$_SESSION['temp_page_fields']['cat_2_id']
					,$_SESSION['temp_page_fields']['cat_3_id']
					,$_SESSION['temp_page_fields']['cat_4_id']
					,$ts
					,$show_on_home_page	
					,$_SESSION['profile_account_id'])){
			
				echo 'Error-2 '.$db->error;
					
	}else{
		$stmt->execute();
		$stmt->close();
		
		$keyword_landing_id = $db->insert_id;
		
		foreach($_SESSION['temp_page_fields']['temp_gallery'] as $val){
			$sql = "INSERT INTO keyword_landing_gallery
					(keyword_landing_id
					,img_id)
					VALUES
					('".$keyword_landing_id."','".$val."')"; 
			$res = $dbCustom->getResult($db,$sql);							
		}
		
		
		foreach($_SESSION['temp_page_fields']['temp_tabs'] as $val){
			$sql = "INSERT INTO keyword_landing_tab
					(keyword_landing_id
					,tab_text
					,content
					,active
					,display_order)
					VALUES
					('".$keyword_landing_id."'
					,'".$val['tab_text']."'
					,'".$val['content']."'
					,'".$val['active']."'
					,'".$val['display_order']."')"; 
			$res = $dbCustom->getResult($db,$sql);				
		}
		
		
		foreach($_SESSION['temp_page_fields']['temp_docs'] as $val){
			$sql = "INSERT INTO keyword_landing_to_doc
					(keyword_landing_id
					,doc_id)
					VALUES
					('".$keyword_landing_id."'
					,'".$val['doc_id']."')"; 
			$res = $dbCustom->getResult($db,$sql);				
		}

		foreach($_SESSION['temp_page_fields']['temp_videos'] as $val){
			$sql = "INSERT INTO keyword_landing_to_video
					(keyword_landing_id
					,video_id)
					VALUES
					('".$keyword_landing_id."'
					,'".$val['video_id']."')"; 
			$res = $dbCustom->getResult($db,$sql);				
		}
		
	
		

		$msg = 'added';		
	}
	
}



if(isset($_POST['edit_keyword_landing'])){
	

	//$intro = trim(addslashes($_POST['intro']));	
	$intro = '';
	//$mssl = (isset($_POST['mssl']))? 1 : 0;
	$url_name = trim(getUrlText($_POST['url_name']));
	$meta_title = trim(addslashes($_POST['meta_title']));
	$meta_keywords = trim(addslashes($_POST['meta_keywords']));
	$meta_description = trim(addslashes($_POST['meta_description']));
	$videos_btn_text = trim(addslashes($_POST['videos_btn_text']));
	$design_btn_text = trim(addslashes($_POST['design_btn_text']));
	$specs_btn_text = trim(addslashes($_POST['specs_btn_text']));
	$cat_1_btn_text = trim(addslashes($_POST['cat_1_btn_text']));
	$cat_2_btn_text = trim(addslashes($_POST['cat_2_btn_text']));
	$cat_3_btn_text = trim(addslashes($_POST['cat_3_btn_text']));
	$cat_4_btn_text = trim(addslashes($_POST['cat_4_btn_text']));
	$heading = trim(addslashes($_POST['heading']));
	$sub_heading = trim(addslashes($_POST['sub_heading']));
	
	$description_tab_content = trim(addslashes($_POST['description_tab_content']));
	$doc_tab_content = trim(addslashes($_POST['doc_tab_content']));

	$show_on_home_page = (isset($_POST['show_on_home_page'])) ? 1 : 0;
	
	$keyword_landing_id = $_POST['keyword_landing_id'];
	
	$stmt = $db->prepare("UPDATE keyword_landing
						SET intro = ?
						,url_name = ?
						,meta_title = ?
						,meta_keywords = ?						
						,meta_description = ?
						,videos_btn_text = ?
						,design_btn_text = ?
						,specs_btn_text = ?
						,cat_1_btn_text = ?
						,cat_2_btn_text = ?
						,cat_3_btn_text = ?
						,cat_4_btn_text = ?
						,heading = ?
						,sub_heading = ?
						,description_tab_content = ?
						,doc_tab_content = ?
						,main_img_id = ?
						,video_img_id = ? 
						,start_design_img_id = ?
						,specs_img_id = ?
						,cat_1_id = ?
						,cat_2_id = ?
						,cat_3_id = ?
						,cat_4_id = ?						
						,last_update = ?
						,show_on_home_page = ?
						WHERE keyword_landing_id = ?");
						
			//echo 'Error '.$db->error;	
													
	if(!$stmt->bind_param('ssssssssssssssssiiiiiiiiiii'
						,$intro
						,$url_name
						,$meta_title
						,$meta_keywords						
						,$meta_description
						,$videos_btn_text
						,$design_btn_text
						,$specs_btn_text
						,$cat_1_btn_text
						,$cat_2_btn_text
						,$cat_3_btn_text
						,$cat_4_btn_text
						,$heading
						,$sub_heading
						,$description_tab_content
						,$doc_tab_content
						,$_SESSION['temp_page_fields']['main_img_id']
						,$_SESSION['temp_page_fields']['video_img_id']
						,$_SESSION['temp_page_fields']['start_design_img_id']
						,$_SESSION['temp_page_fields']['specs_img_id']
						,$_SESSION['temp_page_fields']['cat_1_id']
						,$_SESSION['temp_page_fields']['cat_2_id']
						,$_SESSION['temp_page_fields']['cat_3_id']
						,$_SESSION['temp_page_fields']['cat_4_id']					
						,$ts
						,$show_on_home_page
						,$keyword_landing_id)){
			
			echo 'Error-2 '.$db->error;
					
	}else{
	
		$stmt->execute();
		$stmt->close();		
		
		$sql = "DELETE FROM keyword_landing_gallery 
				WHERE keyword_landing_id = '".$keyword_landing_id."'";
		$result = $dbCustom->getResult($db,$sql);
		foreach($_SESSION['temp_page_fields']['temp_gallery'] as $val){
			$sql = "INSERT INTO keyword_landing_gallery
					(keyword_landing_id
					,img_id)
					VALUES
					('".$keyword_landing_id."','".$val."')"; 
			$res = $dbCustom->getResult($db,$sql);							
		}


		$sql = "DELETE FROM keyword_landing_tab 
				WHERE keyword_landing_id = '".$keyword_landing_id."'";
		$result = $dbCustom->getResult($db,$sql);

		foreach($_SESSION['temp_page_fields']['temp_tabs'] as $val){
			$sql = "INSERT INTO keyword_landing_tab
					(keyword_landing_id
					,tab_text
					,content
					,active
					,display_order)
					VALUES
					('".$keyword_landing_id."'
					,'".$val['tab_text']."'
					,'".$val['content']."'
					,'".$val['active']."'
					,'".$val['display_order']."')"; 
			$res = $dbCustom->getResult($db,$sql);				
		}

		$sql = "DELETE FROM keyword_landing_to_doc 
				WHERE keyword_landing_id = '".$keyword_landing_id."'";
		$result = $dbCustom->getResult($db,$sql);


		foreach($_SESSION['temp_page_fields']['temp_docs'] as $val){
			$sql = "INSERT INTO keyword_landing_to_doc
					(keyword_landing_id
					,doc_id)
					VALUES
					('".$keyword_landing_id."'
					,'".$val['doc_id']."')"; 
			$res = $dbCustom->getResult($db,$sql);				
		}

		$sql = "DELETE FROM keyword_landing_to_video 
				WHERE keyword_landing_id = '".$keyword_landing_id."'";
		$result = $dbCustom->getResult($db,$sql);

		foreach($_SESSION['temp_page_fields']['temp_videos'] as $val){
			$sql = "INSERT INTO keyword_landing_to_video
					(keyword_landing_id
					,video_id)
					VALUES
					('".$keyword_landing_id."'
					,'".$val['video_id']."')"; 
			$res = $dbCustom->getResult($db,$sql);				
		}


		$msg = 'success';

	
	}
	
		
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);


	
	
}


/*
$sql = "DELETE 
		FROM navbar_label
		WHERE keyword_landing_id > 0";
$result = $dbCustom->getResult($db,$sql);

$sql = "DELETE 
		FROM navbar_submenu_label
		WHERE keyword_landing_id > 0";
$result = $dbCustom->getResult($db,$sql);

$sql = "DELETE 
		FROM footer_nav_label
		WHERE keyword_landing_id > 0";
$result = $dbCustom->getResult($db,$sql);


$sql = "DELETE 
		FROM footer_nav_submenu_label
		WHERE keyword_landing_id > 0";
$result = $dbCustom->getResult($db,$sql);
*/


if(isset($_POST['del_keyword_landing'])){

	$keyword_landing_id = $_POST['del_keyword_landing_id'];

	$sql = sprintf("DELETE FROM keyword_landing WHERE keyword_landing_id = '%u'", $keyword_landing_id);
	$result = $dbCustom->getResult($db,$sql);
	
	$sql = sprintf("DELETE FROM navbar_label WHERE keyword_landing_id = '%u'", $keyword_landing_id);
	$result = $dbCustom->getResult($db,$sql);
	
	$sql = sprintf("DELETE FROM navbar_submenu_label WHERE keyword_landing_id = '%u'", $keyword_landing_id);
	$result = $dbCustom->getResult($db,$sql);
	
	$sql = sprintf("DELETE FROM footer_nav_label WHERE keyword_landing_id = '%u'", $keyword_landing_id);
	$result = $dbCustom->getResult($db,$sql);

	$sql = sprintf("DELETE FROM footer_nav_submenu_label WHERE keyword_landing_id = '%u'", $keyword_landing_id);
	$result = $dbCustom->getResult($db,$sql);

	$sql = "SELECT file_name 
			FROM image, keyword_landing
			WHERE image.img_id = keyword_landing.main_img_id 
			AND keyword_landing.keyword_landing_id = '".$keyword_landing_id."'";
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){
		$object = $result->fetch_object();		
		$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$object->file_name;		
		if(file_exists($p)) unlink($p);
	}	

	$sql = "SELECT file_name 
			FROM image, keyword_landing
			WHERE image.img_id = keyword_landing.video_img_id 
			AND keyword_landing.keyword_landing_id = '".$keyword_landing_id."'";
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){
		$object = $result->fetch_object();		
		$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$object->file_name;		
		if(file_exists($p)) unlink($p);
	}	

	$sql = "SELECT file_name 
			FROM image, keyword_landing
			WHERE image.img_id = keyword_landing.start_design_img_id 
			AND keyword_landing.keyword_landing_id = '".$keyword_landing_id."'";
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){
		$object = $result->fetch_object();		
		$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$object->file_name;		
		if(file_exists($p)) unlink($p);
	}	

	$sql = "SELECT file_name 
			FROM image, keyword_landing
			WHERE image.img_id = keyword_landing.specs_img_id 
			AND keyword_landing.keyword_landing_id = '".$keyword_landing_id."'";
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){
		$object = $result->fetch_object();		
		$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$object->file_name;		
		if(file_exists($p)) unlink($p);
	}	


	$sql = "SELECT file_name 
			FROM image, keyword_landing_gallery
			WHERE image.img_id = keyword_landing_gallery.img_id 
			AND keyword_landing_gallery.keyword_landing_id = '".$keyword_landing_id."'";
	$result = $dbCustom->getResult($db,$sql);
	while($row = $result->fetch_object()){
		$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$row->file_name;		
		if(file_exists($p)) unlink($p);
		$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cms/large/".$row->file_name;		
		if(file_exists($p)) unlink($p);
	}

	$sql = "DELETE FROM keyword_landing_gallery 
			WHERE keyword_landing_id = '".$keyword_landing_id."'";
	$result = $dbCustom->getResult($db,$sql);

	
	$msg = "Your change is now live.";
}

unset($_SESSION['temp_page_fields']);
unset($_SESSION['gal_img_id']);

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>
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
		//$bread_crumb->add("Keyword Landing Pages", $ste_root."manage/cms/keyword-landing/keyword-landing-page-list.php");
		$bread_crumb->add("Keyword Landing Pages", '');
        echo $bread_crumb->output();
		
		
		
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
        
		$sortby = (isset($_GET['sortby'])) ? trim($_GET['sortby']) : '';
		$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
		
				
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		$sql = "SELECT * 
				FROM keyword_landing 
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
		
		$result = $dbCustom->getResult($db,$sql);		
		
		
		
		?>
			<div class="page_actions">
				<a class="btn btn-large btn-primary" href="add-keyword-landing.php"><i class="icon-plus icon-white"></i> Add a Page </a>
            </div>
                
			
            <div class="clear"></div>

			<div class="data_table">
			
            	<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
          					<th>URL</th>

							<th width="10%">&nbsp;</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<?php
					
					$block = ''; 
					while($row = $result->fetch_object()) {
						$block .= "<tr>";
						$block .= "<td><a href='".$ste_root."/".$_SESSION['global_url_word'].$row->url_name.".html?k=".$row->keyword_landing_id."' target='_blank'>";
						
						$block .= $ste_root."/".$_SESSION['global_url_word'].$row->url_name.".html?k=".$row->keyword_landing_id."</a></td>";
						
						$url_str = "edit-keyword-landing.php";						
						$url_str .= "?strip=".$strip;
						$url_str .= "&keyword_landing_id=".$row->keyword_landing_id;
						$url_str .= "&sortby=".$sortby;
						$url_str .= "&a_d=".$a_d;
						$block .= "<td><a href='".$url_str."' class='btn btn-primary'><i class='icon-cog icon-white'></i> Edit</a></td>";

						$disabled = '';

						$block .= "<td><a class='btn btn-danger btn-small confirm ".$disabled." '>
						<i class='icon-remove icon-white'></i>
						<input type='hidden' id='".$row->keyword_landing_id."' class='itemId' value='".$row->keyword_landing_id."' /></a></td>";	
	
						$block .= "</tr>";
					}
					echo $block;
					?>
				</table>
				                
			</div>
		
	</div>
	<p class="clear"></p>
	<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
	
	
	$url_str = "keyword-landing-page-list.php";
	$url_str .= "?pagenum=0";
	$url_str .= "&sortby=".$sortby;
	$url_str .= "&a_d=".$a_d;
	
	?>
</div>
<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this page?</h3>
	<form name="del_keyword_landing" action="<?php echo $url_str; ?>" method="post" target="_top">
		<input id="del_keyword_landing_id" class="itemId" type="hidden" name="del_keyword_landing_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_keyword_landing" type="submit" >Yes, Delete</button>
	</form>
</div>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>

</body>
</html>

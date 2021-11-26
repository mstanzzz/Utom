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


require_once($real_root.'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Documents";
$page_group = "documents";
$msg = '';

	
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$strip = '';



if(isset($_POST['edit_doc_name'])){
	
	$name = addslashes($_POST['name']); 
	$doc_id = $_POST['doc_id'];

	$sql = sprintf("UPDATE document SET name = '%s' WHERE doc_id = '%u'", 
	$name, $doc_id);
	$result = $dbCustom->getResult($db,$sql);
	

	$msg = "Document Name Successfully Edited.";
	
}

if(isset($_POST['del_doc'])){

	$doc_id = $_POST['del_doc_id'];


	$sql = "SELECT file_name 
			FROM document
			WHERE doc_id = '".$doc_id."'";
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){
		$object = $result->fetch_object();		
		$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cms/doc/".$object->file_name;		
		if(file_exists($p)) unlink($p);
	}	

	$sql = sprintf("DELETE FROM document WHERE doc_id = '%u'", $doc_id);
	$result = $dbCustom->getResult($db,$sql);

	$msg = "Document Deleted.";
}


require_once($real_root.'/manage/admin-includes/doc_header.php'); 


?>
<script>

function select_this_doc(doc_id){
	
	//alert(doc_id);
	
	document.getElementById("r"+doc_id).checked = true;
	
}

</script>
</head>
<body>
<?php
	require_once($real_root.'/manage/admin-includes/manage-header.php');
	require_once($real_root.'/manage/admin-includes/manage-top-nav.php');
?>
<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php 
        require_once($real_root.'/manage/admin-includes/manage-side-nav.php');
        ?>
	</div>
	<div class="manage_main">
		<?php 
		if(!isset($_SESSION['ret_page'])) $_SESSION['ret_page'] = (isset($_GET['ret_page'])) ? $_GET['ret_page'] : '';		
		if(!isset($_SESSION['ret_dir'])) $_SESSION['ret_dir'] = (isset($_GET['ret_dir'])) ? $_GET['ret_dir'] : '';
		if(!isset($_SESSION['ret_path'])) $_SESSION['ret_path'] = (isset($_GET['ret_path'])) ? $_GET['ret_path'] : '';
		

		require_once($real_root."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();

		echo $bread_crumb->output();
		
        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');
        
		$sortby = (isset($_GET['sortby'])) ? trim(mysql_escape_string($_GET['sortby'])) : '';
		$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
		
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		$sql = "SELECT * 
				FROM document 
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
		
		$result = $dbCustom->getResult($db,$sql);		
		
		$url_str = SITEROOT."/manage/cms/upload-doc.php";		
		
		?>
			<div class="page_actions">
                <a href="<?php echo $url_str;?>" 
                 class="btn btn-primary btn-large"><i class="icon-plus icon-white"></i> Add New File </a>
                 
                <a href="<?php echo SITEROOT."/manage/".$_SESSION['ret_path']."/".$_SESSION['ret_page'].".php"; ?>" target='_top'
                class="btn btn-large">Cancel</a>

            </div>
            <div class="clear"></div>
			<div class="data_table">
				<form name="form" action="<?php echo SITEROOT."/manage/".$_SESSION['ret_path']."/".$_SESSION['ret_page'].".php"; ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="add_doc" value="1">
            	<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
          					<th>Document Name</th>
          					<th>File Name</th>
							<th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
						</tr>
					</thead>
					<?php
					$disabled = '';
					$block = ''; 
					while($row = $result->fetch_object()) {
						$block .= "<tr>";
						$block .= "<td><a onClick='select_this_doc(".$row->doc_id.")' href='#' style='text-decoration:none'>".htmlentities($row->name)."</a>
						<input type='hidden' name='name_".$row->doc_id."' value='".$row->name."' /></td>";
						
						$block .= "<td valign='middle'><a onClick='select_this_doc(".$row->doc_id.")' 
							href='".SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/cms/doc/".$row->file_name."' 
							target='_blank' style='text-decoration:none'>".$row->file_name."</a>
							<input type='hidden' name='file_name_".$row->doc_id."' value='".$row->file_name."' /></td>";
							
							
							//public_html/saascustuploads/1/cms/doc
						
						$block .= "<td><input id='r".$row->doc_id."' type='radio' name='doc_id' value='".$row->doc_id."' />".$row->doc_id."</td>";
						
						
						$block .= "<td><a class='btn btn-primary confirm confirm-edit ".$disabled."' ><i class='icon-cog icon-white'></i> 
								Edit<input type='hidden' class='itemId' name='itemId' id='e".$row->doc_id."' value='".$row->doc_id."' />
								<input type='hidden' class='contentToEdit' id='ce".$row->doc_id."' value='".htmlentities($row->name)."' /></a></td>";								

						
						$block .= "<td><a class='btn btn-danger btn-small confirm ".$disabled." '>
						<i class='icon-remove icon-white'></i>
						<input type='hidden' id='d".$row->doc_id."' class='itemId' value='".$row->doc_id."' /></a></td>";	
	
						$block .= "</tr>";
					}
					echo $block;
					?>
				</table>
                	<input class="btn btn-success btn-large" type="submit" name="submit" value="Submit">	
                </form>
				                
			</div>
		
	</div>
	<p class="clear"></p>
	<?php 
	require_once($real_root.'/manage/admin-includes/manage-footer.php');
	
	
	$url_str = "select-doc.php";
	$url_str .= "?pagenum=0";
	$url_str .= "&sortby=".$sortby;
	$url_str .= "&a_d=".$a_d;
	
	?>
</div>


<div id="content-edit" class="confirm-content">
	<form name="edit_doc_name" action="<?php echo $url_str; ?>" method="post" target="_top">
		<input id="doc_id" type="hidden" class="itemId" name="doc_id" value='' />
		<fieldset class="colcontainer">
			<label>Edit Document Name</label>
			<input type="text" class="contentToEdit"  name="name" value=''>
		</fieldset>
		<a class="btn btn-large dismiss"> Cancel </a>
		<button name="edit_doc_name" type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Save </button>
	</form>
</div>


<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this document?</h3>
	<form name="del_doc" action="<?php echo $url_str; ?>" method="post" target="_top">
		<input id="del_doc_id" class="itemId" type="hidden" name="del_doc_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_doc" type="submit" >Yes, Delete</button>
	</form>
</div>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>

</body>
</html>

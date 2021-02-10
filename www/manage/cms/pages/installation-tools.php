<?php



if(strpos($_SERVER['REQUEST_URI'], 'onlinecl/' )){
$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek';
}elseif(strpos($_SERVER['REQUEST_URI'], "designitpro" )){
$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro';
}elseif(strpos($_SERVER['REQUEST_URI'], 'otg-site' )){
$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/otg-site';
}else{
$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'];
}

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Installation Tools";
$page_group = "installation";
$page = "installation";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';



if(isset($_POST["add_installation_tool"])){
	
	$name = trim(addslashes($_POST['name']));
	$description = trim(addslashes($_POST['description']));
	$img_alt_text = trim(addslashes($_POST['img_alt_text']));
	
	
	$img_id = $_POST['img_id'];
	
	$sql = sprintf("INSERT INTO installation_tool
					(name, description, img_id, img_alt_text, installation_id)
					VALUES
					('%s','%s','%u','%s','%u')", 				
					$name, $description, $img_id, $img_alt_text, $_SESSION['installation_id']);
	$result = $dbCustom->getResult($db,$sql);
	
}

if(isset($_POST["edit_installation_tool"])){
	
	$name = trim(addslashes($_POST['name']));
	$description = trim(addslashes($_POST['description']));
	$img_alt_text = trim(addslashes($_POST['img_alt_text']));
	$img_id = $_POST['img_id'];
	$installation_tool_id = $_POST["installation_tool_id"];
	
	$sql = sprintf("UPDATE installation_tool
					SET name = '%s'
					,description = '%s'
					,img_id = '%u'
					,img_alt_text = '%s'
					WHERE installation_tool_id = '%u'", 				
					$name, $description, $img_id, $img_alt_text, $installation_tool_id);
	$result = $dbCustom->getResult($db,$sql);
	

}



if(isset($_POST["del_installation_tool"])){
	
	$installation_tool_id = $_POST["del_installation_tool_id"];

	$sql = "SELECT installation_tool.img_id, image.file_name 
			FROM installation_tool, image 
			WHERE installation_tool.img_id = image.img_id 
			AND installation_tool_id = '".$installation_tool_id."'";
	$result = $dbCustom->getResult($db,$sql);
	
	if($result->num_rows > 0){
		$img_obj = $result->fetch_object();
		$sql = "DELETE FROM image WHERE img_id = '".$img_obj->img_id."'";
		$result = $dbCustom->getResult($db,$sql);
				
		$myFile = "../ul_cms/".$domain."/".$img_obj->file_name;
		if(file_exists($myFile)) unlink($myFile);
	}


	$sql = sprintf("DELETE FROM installation_tool WHERE installation_tool_id = '%u'", $installation_tool_id);
	$result = $dbCustom->getResult($db,$sql);
	
	
}


unset($_SESSION["installation_tool_id"]);
unset($_SESSION["temp_page_fields"]);
unset($_SESSION['img_id']);
unset($_SESSION['new_img_id']);

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
	
	tinyMCE.init({
		// General options
		mode : "specific_textareas",
		editor_selector : "wysiwyg",
		theme : "advanced",
		skin : "o2k7",
		plugins : "table,advhr,advlink,emotions,inlinepopups,insertdatetime,searchreplace,paste,style",
		// Theme options
		theme_advanced_buttons1 :"bold,italic,underline,strikethrough,|,styleselect,formatselect,fontsizeselect,|,forecolor,backcolor",
		theme_advanced_buttons2 : "justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,outdent,indent,blockquote,|,cut,copy,paste,pastetext,pasteword,|,undo,redo,|,link,unlink,",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : false,
		forced_root_block : false
	});


/*
function msslSubmit(){
document.set_ssl.submit();
}
*/

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
        $bread_crumb->add("Installation Tools", '');
        echo $bread_crumb->output();

        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
		//installation section tabbed sub-navigation
        require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/installation-section-tabs.php");
        ?>

 
	<div class="page_actions">
		
		<a href="<?php echo $ste_root;?>/manage/cms/pages/add-installation-tool.php" class="btn btn-primary btn-large fancybox fancybox.iframe"><i class="icon-plus icon-white"></i> Add Installation Tool </a>

		<a href="<?php echo $ste_root; ?>/manage/cms/navigation/navbar.php?strip=1" class="btn btn-primary btn-large fancybox fancybox.iframe">
        <i class="icon-eye-open icon-white"></i> Edit Navigation </a>

    	<a href="<?php echo $ste_root;?>/manage/cms/pages/page.php" class="btn"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>
    </div>
	<div class="data_table">

    <table cellpadding="10" cellspacing="0">
    <thead>
    <th width="10%">Image</th>
    <th width="22%">Name</th>
    <th>Tooltip</th>
    <th width="13%">Edit</th>
    <th width="7%">Delete</th>
    </thead>
    <tbody>

			<?php 
			$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
			$sql = "SELECT * 
					FROM installation_tool
					WHERE installation_id = '".$_SESSION["installation_id"]."'";
			$result = $dbCustom->getResult($db,$sql);
			
			$block = '';
			while($row = $result->fetch_object()){
							
				$block .= "<tr>"; 
				
				$sql = "SELECT file_name FROM image WHERE img_id = '".$row->img_id."'";
				$img_res = $dbCustom->getResult($db,$sql);
				;
				if($img_res->num_rows > 0){
					$img_obj = $img_res->fetch_object();
					$pic =  "<img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$img_obj->file_name."'>";	
				}else{
					$pic = '';
				}
				
				$block .= "<td>".$pic."</td>";
				$block .= "<td>".stripslashes($row->name)."</td>";
				$block .= "<td>".stripslashes($row->description)."</td>";

				$block .= "<td><a href='edit-installation-tool.php?firstload=1&installation_tool_id=".$row->installation_tool_id."' 
				class='btn btn-primary fancybox fancybox.iframe'><i class='icon-cog icon-white'></i> Edit</a>
				</td>";

				$block .= "<td valign='middle'><a class='btn btn-danger confirm'>
				<i class='icon-remove icon-white'></i>
				<input type='hidden' id='".$row->installation_tool_id."' class='itemId' value='".$row->installation_tool_id."' /></a>
				</td>";

			}
			echo $block;
			?>

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
	<h3>Are you sure you want to delete this step?</h3>
	<form name="del_installation_tool_form" action="installation-tools.php" method="post" target="_top">
		<input id="del_installation_tool_id" class="itemId" type="hidden" name="del_installation_tool_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_installation_tool" type="submit" >Yes, Delete</button>
	</form>
</div>

</body>
</html>




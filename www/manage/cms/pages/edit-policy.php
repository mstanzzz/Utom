<?php
if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){ 
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/solvitware';
}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/designitpro'; 
}elseif(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
}else{
	$real_root = $_SERVER['DOCUMENT_ROOT']; 	
}
require_once($real_root.'/includes/class.dbcustom.php');
$dbCustom = new DbCustom();

require_once($real_root.'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;


$page_title = "Edit Policy";
$page_group = "policy";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$parent_cat_id =  (isset($_GET['parent_cat_id'])) ? $_GET['parent_cat_id'] : 0;

$msg = '';
require_once($real_root.'/manage/admin-includes/doc_header.php'); 


?>
<script>

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

function select_img(img_id){
	document.getElementById(img_id).checked = true;	
}

</script>
</head>
<div class="lightboxholder">
	<?php if($msg != ''){ ?>
	<div class="alert">
		<p><?php echo $msg ?></p>
	</div>
	<?php 
		} 
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		$policy_id = (isset($_GET['policy_id'])) ? $_GET['policy_id'] : 0;
		$sql = sprintf("SELECT content, policy_cat_id, img_id, img_alt_text 
			FROM policy 
			WHERE policy_id = '%u'", $policy_id);
$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			$img_id = $object->img_id;
			$policy_cat_id = $object->policy_cat_id;
			$content = $object->content;
			$img_alt_text = $object->img_alt_text;
		}else{
			$img_id = 0;
			$policy_cat_id = 0;
			$content = '';
			$img_alt_text = '';			
		}
	?>
	<form name="edit_policy_form" action="policy.php" method="post" enctype="multipart/form-data" target="_top">
       	<input id="policy_id" type="hidden" name="policy_id" value="<?php echo $policy_id;  ?>" />
		<div class="lightboxcontent">
			<h2>Edit Policy</h2>
			<fieldset class="edit_images">    
				<div class="colcontainer">
					<?php
						$sql = "SELECT * FROM image WHERE slug = 'policy' AND profile_account_id = '".$_SESSION['profile_account_id']."'";
						$img_res = $dbCustom->getResult($db,$sql);
						;
						if($img_res->num_rows > 1){
							echo "<label>Select an Image</label>";	
						}
						$block = ''; 
						$i = 1;
						while($img_row = $img_res->fetch_object()) {
							$block .= "<div class='threecols'>";
							
							$block .= "<img src='".SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$img_row->file_name."' 
							width='120px' onClick='select_img(".$img_row->img_id.")' />";
	
							if($img_id == $img_row->img_id){
								$sel = "checked";
							}else{
								$sel = '';
							}
	
							/*
							$block .= "<div class='radiotoggle off'> 
							<span class='ontext'>ON</span><a class='switch on' href='#'></a>
							<span class='offtext'>OFF</span>						
							<input id='".$img_row->img_id."' type='radio' name='img_id' value='".$img_row->img_id."' ".$sel." /></div>";
							*/
							
							$block .= "<input id='".$img_row->img_id."' type='radio' name='img_id' value='".$img_row->img_id."' ".$sel." />";
							
							//$block .= "<input id='img_id' type='hidden' name='img_id' value='".$img_row->img_id."' />";						
							
							
							$block .= "</div>";
							if($i % 3 == 0) {
								$block .= "</div><div class='colcontainer'>";
							}
							else if ($i % 2 == 0 && $i == $img_res->num_rows) {
								$block .= "<div class='threecols'></div>";
							}
							else if ($i % 1 == 0 && $i == $img_res->num_rows) {
								$block .= "<div class='threecols'></div><div class='threecols'></div>";
							}
							$i++;
						}
						echo $block;
					?>
				</div>
                
               <div class="colcontainer formcols">
                   	<div class="twocols">
                       	<label>Image Alt Tag Text</label>
                    </div>
                    <div class="twocols">
                       	<input id="img_alt_text" type="text" name="img_alt_text" value="<?php echo stripslashes($img_alt_text); ?>" />
                    </div>
				</div>

                
                
			</fieldset> 
			<fieldset class="colcontainer formcols">
				<div class="twocols">
					<label>Policy Category</label>
				</div>
				<div class="twocols">
					<?php
						$sql = "SELECT * FROM policy_category WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
						$result = $dbCustom->getResult($db,$sql);
						$block = '';  
						$block .= "<select name='policy_cat_id'>";
						while($row = $result->fetch_object()) {
							$sel = '';
							if($policy_cat_id == $row->policy_cat_id) $sel = "selected";
							$block .= "<option value='".$row->policy_cat_id."'".$sel.">".stripslashes($row->category_name)."</option>";
						}
						$block .= "</select>";			
						echo $block;
					?>
				</div>
			</fieldset>
			<fieldset class="colcontainer">
				<legend>Policy Content</legend>
				<textarea  name="content" class="wysiwyg" id="wysiwyg" ><?php echo stripslashes($content); ?></textarea>
			</fieldset>
		</div>
		<div class="savebar">
			<button class="btn btn-large btn-success" name="edit_policy" type="submit"><i class="icon-ok icon-white"></i> Save Changes </button>
		</div>
	</form>
</div>
</body>
</html>

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

$page_title = "Add Policy";
$page_group = "policy";
	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$parent_cat_id =  (isset($_GET['parent_cat_id'])) ? $_GET['parent_cat_id'] : 0;

$msg = '';


require_once($real_root.'/manage/admin-includes/doc_header.php'); 

?>
<script>

function validate(theform){	


	var imgIdFailed = true;
	var imgs = theform.elements['img_id'].length; 
	if(!imgs){
		imgs = 0;
		imgIdFailed = false;
	}
	for(var i=0; i<imgs; i++){			
		var radio = theform.elements['img_id'][i];
		if(radio.checked){
			imgIdFailed = false;
		}
	}
	if(imgIdFailed){
		alert("Please click on the image that goes with this entry");
		return false;				
	}

}

function select_img(img_id){	
	document.getElementById("r"+img_id).checked = true;		
}

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

</script>
</head>
<body class="lightbox">
<div class="lightboxholder">
	<?php if($msg != ''){ ?>
	<div class="alert">
		<p><?php echo $msg ?></p>
	</div>
	<?php 
		} 
    $db = $dbCustom->getDbConnect(SITE_N_DATABASE);        
	?>
	<form name="add_policy" action="policy.php" method="post" enctype="multipart/form-data" onSubmit="return validate(this)" target="_top">
		<input type="hidden" name="type_0" value="Policy" id="copy_item_type" />
		<div class="lightboxcontent accordion">
			<h2>Add a New Policy</h2>
			<fieldset class="copy">
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
							$block .= "<div class='twocols'>";
							if($img_res->num_rows > 1){
								$block .= "<input id='".$img_row->img_id."' type='radio' name='img_id' value='".$img_row->img_id."' />";
							}
							$block .= "<img src='".SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$img_row->file_name."' 
							width='120px' onClick='select_img(".$img_row->img_id.")' />";
							$block .= "</div>";
							if($i % 2 == 0) $block .= "</div><div class='colcontainer'>";
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
                       	<input id="img_alt_text" type="text" name="img_alt_text" />
                    </div>
				</div>

            </fieldset> 
			<fieldset class="colcontainer copy">
				<label>Policy Category</label>
				<?php
					$sql = "SELECT * FROM policy_category WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
					$result = $dbCustom->getResult($db,$sql);
					$block = '';  
					$block .= "<select name='policy_cat_id'>";
					while($row = $result->fetch_object()) {
						
						$block .= "<option value='".$row->policy_cat_id."'>".stripslashes($row->category_name)."</option>";
					}
					$block .= "</select>";			
					echo $block;
				?>
			</fieldset>
			<fieldset class="colcontainer copy">
				<label>Policy Content</label>
				<textarea  name="content" class="wysiwyg small" id="wysiwyg">&nbsp;</textarea>
			</fieldset>
			<hr />
			<a class="btn add-one"><i class="icon-plus"></i> Add 1 New Policy Field</a>
			<a class="btn add-five"><i class="icon-plus"></i> Add 5 New Policy Fields</a>
			<hr />
		</div>
		<div class="savebar">
			<button class="btn btn-large btn-success" name="add_policy" type="submit"><i class="icon-ok icon-white"></i> Add Policy </button>
		</div>
	</form>
</div>
</body>
</html>



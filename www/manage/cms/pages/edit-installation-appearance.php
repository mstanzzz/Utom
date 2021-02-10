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


$page_title = "Edit Installation Steps Appearance";
$page_group = "installation";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = '';


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php');


?>
<script type="text/javascript">
$(document).ready(function(){
$("select").each(function(index, element) {
var newcolorval = $(this).find(":selected").val();
$(this).closest(".colcontainer").find(".color_preview").css("background-color",newcolorval);
});
$("select").change(function(){
var newcolorval = $(this).find(":selected").val();
$(this).closest(".colcontainer").find(".color_preview").css("background-color",newcolorval);
});
});
</script>





</head>
<body>
<div class="lightboxholder">
	<?php if($msg != ''){ ?>
	<div class="alert">
		<p><?php echo $msg ?></p>
	</div>
	<?php
}
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$sql = "SELECT * FROM installation_appearance WHERE installation_id = '".$_SESSION['installation_id']."'";
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows > 0){
	$object = $result->fetch_object();
	$background_color = $object->background_color;
	$menu_color = $object->menu_color;
	$header_background_color = $object->header_background_color;
	$header_text_color = $object->header_text_color;
	$description_text_color = $object->description_text_color;	   
}else{
	$background_color = "#eeeeee";
	$menu_color = "#c6c6c6";
	$header_background_color = "#9ddef3";
	$header_text_color = "#2e6c81";
	$description_text_color = "#525e63";	   
	
}

?>
	<form name="edit_installation_appearance" action="installation-steps.php" method="post" target="_top">
		<div class="lightboxcontent">
			<h2>Edit Installation Steps Appearance</h2>
			<fieldset>
				<legend>Colors</legend>
				<div class="colcontainer">
					<div class="threecols">
						<label>Background Color</label>
					</div>
					<div class="threecols">
						<select name="background_color">
							<option value="#eeeeee" <?php if($background_color == "#eeeeee") echo "selected"; ?>>Light Gray</option>
							<option value="#c6c6c6" <?php if($background_color == "#c6c6c6") echo "selected"; ?>>Medium Gray</option>
							<option value="#dce9f0" <?php if($background_color == "#dce9f0") echo "selected"; ?>>Light Blue</option>
							<option value="#9ddef3" <?php if($background_color == "#9ddef3") echo "selected"; ?>>Medium Blue</option>
							<option value="#ffffff" <?php if($background_color == "#ffffff") echo "selected"; ?>>White</option>
						</select>
					</div>
                    	

                    
					<div class="threecols">
						<div class="color_preview">
							<p><strong>Color Preview</strong></p>
						</div>
					</div>
				</div>
				<div class="colcontainer ">
					<div class="threecols">
						<label>Menu Background Color</label>
					</div>
					<div class="threecols">
						<select name="menu_color">
							<option value="#eeeeee" <?php if($menu_color == "#eeeeee") echo "selected"; ?>>Light Gray</option>
							<option value="#c6c6c6" <?php if($menu_color == "#c6c6c6") echo "selected"; ?>>Medium Gray</option>
							<option value="#dce9f0" <?php if($menu_color == "#dce9f0") echo "selected"; ?>>Light Blue</option>
							<option value="#9ddef3" <?php if($menu_color == "#9ddef3") echo "selected"; ?>>Medium Blue</option>
							<option value="#ffffff" <?php if($menu_color == "#ffffff") echo "selected"; ?>>White</option>
						</select>
					</div>
					<div class="threecols">
						<div class="color_preview">
							<p><strong>Color Preview</strong></p>
						</div>
					</div>
				</div>
				<div class="colcontainer ">
					<div class="threecols">
						<label>Header Background Color</label>
					</div>
					<div class="threecols">
						<select name="header_background_color">
							<option value="#eeeeee" <?php if($header_background_color == "#eeeeee") echo "selected"; ?>>Light Gray</option>
							<option value="#c6c6c6" <?php if($header_background_color == "#c6c6c6") echo "selected"; ?>>Medium Gray</option>
							<option value="#dce9f0" <?php if($header_background_color == "#dce9f0") echo "selected"; ?>>Light Blue</option>
							<option value="#9ddef3" <?php if($header_background_color == "#9ddef3") echo "selected"; ?>>Medium Blue</option>
							<option value="#ffffff" <?php if($header_background_color == "#ffffff") echo "selected"; ?>>White</option>
						</select>
					</div>
					<div class="threecols">
						<div class="color_preview">
							<p><strong>Color Preview</strong></p>
						</div>
					</div>
				</div>
				<div class="colcontainer ">
					<div class="threecols">
						<label>Header Text Color</label>
					</div>
					<div class="threecols">
						<select name="header_text_color">
							<option value="#000000" <?php if($header_text_color == "#000000") echo "selected"; ?>>Black</option>
							<option value="#525e63" <?php if($header_text_color == "#525e63") echo "selected"; ?>>Dark Gray</option>
							<option value="#2e6c81" <?php if($header_text_color == "#2e6c81") echo "selected"; ?>>Dark Blue</option>
						</select>
					</div>
					<div class="threecols">
						<div class="color_preview">
							<p><strong>Color Preview</strong></p>
						</div>
					</div>
				</div>
				<div class="colcontainer ">
					<div class="threecols">
						<label>Description Text Color</label>
					</div>
					<div class="threecols">
						<select name="description_text_color">
							<option value="#000000" <?php if($description_text_color == "#000000") echo "selected"; ?>>Black</option>
							<option value="#525e63" <?php if($description_text_color == "#525e63") echo "selected"; ?>>Dark Gray</option>
							<option value="#2e6c81" <?php if($description_text_color == "#2e6c81") echo "selected"; ?>>Dark Blue</option>
						</select>
					</div>
					<div class="threecols">
						<div class="color_preview">
							<p><strong>Color Preview</strong></p>
						</div>
					</div>
				</div>
			</fieldset>
		</div>
		<div class="savebar">
			<button class="btn btn-large btn-success" name="edit_installation_appearance" type="submit"><i class="icon-ok icon-white"></i> Save Changes </button>
		</div>
	</form>
</div>
</body>
</html>
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


$page_title = "Process";
$page_group = "process";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = '';


require_once($real_root.'/manage/admin-includes/doc_header.php'); 

?>
<script>
//$(document).ready(function() {	});


function trim(str) {  return str.replace(/^\s+|\s+$/g, '');  } 

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

function validate(theform){	
	
	var pageName = trim(theform.page_name.value);
		
	if(pageName == ''){
		alert("Please enter a page name");
		return false;				
	}
	
	if(pageName.indexOf("_") > -1){
		alert("Please use hyphens. No underscores");
		return false;				
	}
	
	if(pageName.indexOf(" ") > -1){
		alert("Please use hyphens. No spaces");
		return false;				
	}
	
	return true;
}


</script>
</head>

<body>

<div class="page_title_top_spacer"></div>
<div class="page_title">
	Add Special
</div>
<div class="horizontal_bar"></div>
<div class="horizontal_bar_bottom_spacer"></div>
<div class="page_container">
<form name="add_special_form" action="special.php" method="post" onSubmit="return validate(this)">
<span class="head">Special Name</span><br />    
<input type="text" name="special_name" maxlength="60" style="width:260px;" />
<div style="padding-bottom:10px; padding-top:15px;">
<span class="head">Description</span><br />    
<textarea name="description" cols="60" rows="2"></textarea>    
</div>

<div style="padding-bottom:10px; padding-top:15px;">
<span class="head">Apply To Accessory</span><br />    

<select name="accessory_id">
<option value=''>None</option>
<?php
	$sql = "SELECT name, accessory_item_id  
			FROM accessory_item";
$result = $dbCustom->getResult($db,$sql);	while($row = $result->fetch_object()) {
		$block .= "<option value='".$row->accessory_item_id."'>".$cat_row->name."</option>";
	}
?>
</select> 

</div>
<p class="clear"></p>


<div style="float:left; padding-top:15px;">
<input name="add_special" type="submit" value="Submit" />  
</div>
<div style="float:left; padding-right:100px; padding-top:15px;">
<input type="button" value="Cancel" onClick="location.href = 'special.php'" />
</div>  
</form>  
<br /><br /><br /><br /><br /><br /><br /><br />    


</div>
</body>
</html>




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

$page_title = "Add Installation Page Intro Link";
$page_group = "installation";

	


$installation_link_id = (isset($_GET['installation_link_id'])) ? $_GET['installation_link_id'] : 0;
if(!isset($_SESSION["installation_link_id"])) $_SESSION["installation_link_id"] = $installation_link_id; 

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

$new_uploaded_file_id = (isset($_GET["new_uploaded_file_id"])) ? $_GET["new_uploaded_file_id"] : 0;

if($new_uploaded_file_id > 0){
	$_SESSION['uploaded_file_id'] = $new_uploaded_file_id; 
}


$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$sql = "SELECT button_text, page_seo_id, color, uploaded_file_id, local_url
	    FROM installation_link 
 		WHERE installation_link_id = '".$_SESSION["installation_link_id"]."'";
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$button_text = $object->button_text;
	$page_seo_id = $object->page_seo_id;
	$color =  $object->color;
	$uploaded_file_id = $object->uploaded_file_id;
	$local_url = $object->local_url;
}else{
	$button_text = '';
	$page_seo_id = 0;
	$color = "blue";
	$uploaded_file_id = 0;
	$local_url = '';
}



if(!isset($_SESSION['uploaded_file_id'])) $_SESSION['uploaded_file_id'] = $uploaded_file_id;
if(!isset($_SESSION['temp_istallation_link_fields']['button_text'])) $_SESSION['temp_istallation_link_fields']['button_text'] = $button_text;
if(!isset($_SESSION['temp_istallation_link_fields']['page_seo_id'])) $_SESSION['temp_istallation_link_fields']['page_seo_id'] = $page_seo_id;
if(!isset($_SESSION['temp_istallation_link_fields']['color'])) $_SESSION['temp_istallation_link_fields']['color'] = $color;

if(!isset($_SESSION['temp_istallation_link_fields']['local_url'])) $_SESSION['temp_istallation_link_fields']['local_url'] = $local_url;



require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php');
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


function goto_isfancybox(url, save_session){
	if (window.top.location != window.location) {
		url+="&fromfancybox=1";
	}

	if(save_session){
		
		var q_str = "?page=add-installation-link"+get_query_str();
		
		$.ajaxSetup({ cache: false}); 
		$.ajax({
		  url: 'ajax_set_page_session.php'+q_str,
		  success: function(data) {
			location.href = url;
		  }
		});
	}else{
		location.href = url;		
	}

}


function get_query_str(){
	
	var query_str = '';
	query_str += "&button_text="+$("#button_text").val(); 
	query_str += "&page_seo_id="+$("#page_seo_id").val(); 
	query_str += "&color="+$("#color").val(); 
	
	query_str += "&local_url="+$("#local_url").val(); 	
	

	return query_str;
}

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

?>
<form name="form" action="installation.php" method="post" target="_top">

<input type="hidden" name="uploaded_file_id" value="<?php echo $_SESSION['uploaded_file_id'] ?>">
<input type="hidden" name="installation_link_id" value="<?php echo $_SESSION['installation_link_id'] ?>">

<div class="lightboxcontent">
	
    If you upload a file, that will be the link, otherwise it will be the page selected.
    <br />
    
    <h2>Edit Installation Link</h2>
	<fieldset>
    <legend>Link Properties</legend>
    <div class="colcontainer formcols">
        <div class="twocols">
        <label>Button Text</label>
        </div>
        <div class="twocols">
        <input id="button_text" type="text" name="button_text" value="<?php echo prepFormInputStr($_SESSION['temp_istallation_link_fields']['button_text']); ?>" />
        </div>
    </div>
    
   <div class="colcontainer formcols">
        <div class="twocols">
        <label>Button Color</label>
        </div>
        <div class="twocols">
        <select id="color" name="color">
        	<option value="blue" <?php if($_SESSION['temp_istallation_link_fields']['color'] == "blue") echo "selected" ?>>Blue</option>
            <option value="green" <?php if($_SESSION['temp_istallation_link_fields']['color'] == "green") echo "selected" ?>>Green</option>
        </select>
        </div>
    </div>

    
	<div class="colcontainer formcols">
		<div class="twocols">
		<label>Link to Page</label>
		</div>
		<div class="twocols">
        
        <select id='page_seo_id'  name='page_seo_id'>
        	<option value='0' >None</option>
            <?php
            $block = '';			
        
            $sql = "SELECT * FROM page_seo 
                    WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
                    AND page_name != 'checkout'
                    AND page_name != 'default'
                    AND page_name != 'blog-more'
                    ";
            if(!$module->hasAskModule($_SESSION['profile_account_id'])){
                $sql .= " AND page_name != 'blog'";
                $sql .= " AND page_name != 'social-network'";			
            }		
            $sql .= " ORDER BY page_name";
			
   			$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$result = $dbCustom->getResult($db,$sql);            
            while($row = $result->fetch_object()){
            $selected = ($_SESSION['temp_istallation_link_fields']['page_seo_id'] == $row->page_seo_id)? "selected" : '';										
            $block .= "<option value='".$row->page_seo_id."' $selected >$row->page_name</option>";
            }

            echo $block;
            ?>
        
        </select>	
        </div>
        
	<div class="colcontainer formcols">
		<div class="twocols">
		<label>Link to local URL</label>
		</div>
		<div class="twocols">
        
        <span><?php echo $ste_root."/"; ?></span>
        <span>
        <input type="text" id="local_url" name="local_url" value="<?php echo $_SESSION['temp_istallation_link_fields']['local_url']; ?>">
        </span>


        </div>
        
	</div>
        
        
        
	<div class="colcontainer formcols">
		<div class="twocols">
		<label>Link to File Upload</label>
		</div>
		<div class="twocols">
        
			<?php 

			if($_SESSION['uploaded_file_id'] > 0){
				$sql = "SELECT uploaded_file_name FROM uploaded_file WHERE uploaded_file_id = '".$_SESSION['uploaded_file_id']."'";
		$result = $dbCustom->getResult($db,$sql);				
				if($result->num_rows > 0){
					$object = $result->fetch_object();
					$uploaded_file_name = $object->uploaded_file_name; 	
				}else{
					$uploaded_file_name = '';
				}

				echo "The current file for this link is: ".$uploaded_file_name;	
			}
				
            $url_str = $ste_root."manage/cms/upload.php";
            $url_str .= "?ret_page=edit-installation-link";
            $url_str .= "&ret_dir=pages";
            
            ?>
            <a onClick="goto_isfancybox('<?php echo $url_str; ?>', '1')" class="btn btn-primary"><i class="icon-plus icon-white"></i>Upload File</a>

                

			
        
        </div>
        
        
        
        

        
        
	</div>
	</fieldset>
</div>

<div class="savebar">
    <div style="float:left; margin-right:10px;">
    	<a href="<?php echo $ste_root;?>/manage/cms/pages/installation.php" class="btn btn-large" style="width:100px;" target="_top"><i class="icon-arrow-left"></i> Cancel</a>
    </div>
    <div style="float:left;">
    	<button class="btn btn-large btn-success" name="edit_installation_link" type="submit"><i class="icon-ok icon-white"></i> Save Changes </button>
	</div>
    <div class="clear"></div>
	

</div>
</form>
</div>
</body>
</html>


<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Add Showroom Banner";
$page_group = '';

	

//$new_img_id = (isset($_GET['new_img_id'])) ? $_GET['new_img_id'] : 0;
$new_img_id =  (isset($_SESSION['new_img_id'])) ? $_SESSION['new_img_id'] : 0;

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

if(!isset($_SESSION['img_id'])) $_SESSION['img_id'] = 0;
if(!isset($_SESSION['temp_banner_fields']['img_alt_text']))	$_SESSION['temp_banner_fields']['img_alt_text'] = '';
if(!isset($_SESSION['temp_banner_fields']['url']))	$_SESSION['temp_banner_fields']['url'] = '';

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 
?>
<script>

function validate(theform){	

/*
	var title = jQuery.trim(theform.title.value);
	if(title == ''){
		alert("Please enter a title");
		return false;				
	}

	return true;
*/
}

function get_query_str(){
	
	var query_str = '';
	query_str += "&img_alt_text="+$("#img_alt_text").val(); 
	query_str += "&url="+$("#url").val(); 
	
	return query_str;
}

function goto_isfancybox(url){
	
	var q_str = "?page=banner"+get_query_str();
		
	if (window.top.location != window.location) {
		url+="&fromfancybox=1";
	}

	$.ajaxSetup({ cache: false}); 
	$.ajax({
	  url: 'ajax_set_banner_session.php'+q_str,
	  success: function(data) {
		//alert(data);
	  	location.href = url;
		  
	  }
	});

}

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
		
		echo $_SESSION['img_id'];
    $db = $dbCustom->getDbConnect(SITE_N_DATABASE);        
	?>
	<form name="add_banner" action="showroom-banner.php" method="post" target="_top" onSubmit="return validate(this)"  enctype="multipart/form-data">
		<div class="lightboxcontent">
			<h2>Add a New Showroom Banner</h2>
			<fieldset class="colcontainer">
				<legend>Select an Image Source:</legend>
				<input type="hidden" name="img_id" value="<?php echo $_SESSION['img_id']; ?>" />
				<div class="twocols">
					<label>URL</label>
					<input id="url" type="text"  name="url" value="<?php echo $_SESSION['temp_banner_fields']['url'] ?>">
					<span class="input_note">(type http:// for outside URLs, otherwise do not include the domain)</span> 
                </div>
			
            
            	
                <div class="twocols">
					<label>Upload an Image</label>
					<?php
						$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
						$sql = "SELECT file_name FROM image WHERE img_id = '".$_SESSION['img_id']."'";
						$img_res = $dbCustom->getResult($db,$sql);
						;
						
						if($img_res->num_rows){
							$img_obj = $img_res->fetch_object();
							echo "<img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cms/banner/small/".$img_obj->file_name."' style='width:80%;' />";
						}
					
						$url_str = $ste_root."manage/upload-pre-crop.php";
						$url_str .= "?ret_page=add-showroom-banner";
						$url_str .= "&ret_dir=ecomsettings";
					?>
       				<a onClick="goto_isfancybox('<?php echo $url_str; ?>')" class="btn btn-primary"><i class="icon-plus icon-white"></i>Upload new Image</a>
            </div>

				<div class="twocols">
                    <label>Image Alt Tag Text</label>
                    <input id="img_alt_text" type="text" name="img_alt_text" value="<?php echo prepFormInputStr($_SESSION['temp_banner_fields']['img_alt_text']);; ?>" />
                </div>


            </fieldset>
		</div>


		<div class="savebar">
			<button class="btn btn-success btn-large" name="add_banner" type="submit" value="Save"><i class="icon-ok icon-white"></i> Save Changes</button>
		</div>
	</form>
</div>
</body>
</html>

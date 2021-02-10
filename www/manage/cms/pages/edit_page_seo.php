<?php

if(!isset($page)) $page = '';
if(!isset($from_added_page)) $from_added_page = 0;
if(!isset($is_dynamic)) $is_dynamic = 0;


if($page == "showroom"){
	$is_dynamic = 1;	
}else{
	$is_dynamic = 0;
}

//if($module->hasSeoModule($_SESSION['profile_account_id'])){

	if(!isset($_SESSION['temp_page_fields']['seo_name'])) $_SESSION['temp_page_fields']['seo_name'] = $seo_name;		
	if(!isset($_SESSION['temp_page_fields']['title'])) $_SESSION['temp_page_fields']['title'] = '';	
	if(!isset($_SESSION['temp_page_fields']['keywords'])) $_SESSION['temp_page_fields']['keywords'] = '';	
	if(!isset($_SESSION['temp_page_fields']['description'])) $_SESSION['temp_page_fields']['description'] = '';
?>

		<fieldset>
			<legend>Page SEO Settings <i class="icon-minus-sign icon-white"></i></legend>
			<?php if((!$from_added_page) && ($page != "home") && (!$is_dynamic)){ ?>
            <div class="colcontainer formcols">
				<div class="twocols">
					<label>Page URL</label>
				</div>
				<div class="twocols"> <?php echo $ste_root."/"; ?>
					<input id="seo_name" class="url_fragment" name="seo_name" type="text" value="<?php echo $_SESSION['temp_page_fields']['seo_name']; ?>" />
					.html </div>
			</div>
            <?php }else{
				echo "<input type='hidden' name='seo_name' value='".$_SESSION['temp_page_fields']['seo_name']."'>"; 
			} ?>
			<div class="colcontainer formcols">
				<div class="twocols">
					<label>META Title</label>
				</div>
				<div class="twocols">
					<input id="title" name="title" type="text" value="<?php echo stripslashes($_SESSION['temp_page_fields']['title']); ?>" />
				</div>
			</div>
            
            
            
			<div class="colcontainer formcols">
				<div class="twocols">
					<label>META Keywords</label>
				</div>
				<div class="twocols">
					<textarea rows="5" id="keywords" name="keywords"><?php echo stripslashes($_SESSION['temp_page_fields']['keywords']); ?></textarea>
				</div>
			</div>

			<div class="colcontainer formcols">
				<div class="twocols">
					<label>Description</label>
				</div>
				<div class="twocols">
					<textarea  rows="5" id="description" name="description"><?php echo stripslashes($_SESSION['temp_page_fields']['description']); ?></textarea>
				</div>
			</div>
		</fieldset>
        

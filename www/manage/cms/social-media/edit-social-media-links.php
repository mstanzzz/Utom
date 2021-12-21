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

$page_title = "Edit Social medi Links";
$page_group = "cms";
$msg = '';

	

if(isset($_POST['facebook'])){

	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		
	$facebook = trim(addslashes($_POST["facebook"])); 
	$twitter = trim(addslashes($_POST["twitter"])); 
	$youtube = trim(addslashes($_POST["youtube"])); 
	$pinterest = trim(addslashes($_POST["pinterest"])); 
	$houzz = trim(addslashes($_POST["houzz"])); 
	$google_plus = trim(addslashes($_POST["google_plus"])); 
	$linkedin = trim(addslashes($_POST["linkedin"])); 
	$instagram = trim(addslashes($_POST["instagram"])); 
	$facebook_active = isset($_POST["facebook_active"]) ? 1 : 0; 
	$twitter_active = isset($_POST["twitter_active"]) ? 1 : 0; 
	$youtube_active = isset($_POST["youtube_active"]) ? 1 : 0; 
	$pinterest_active = isset($_POST["pinterest_active"]) ? 1 : 0; 
	$houzz_active = isset($_POST["houzz_active"]) ? 1 : 0; 
	$google_plus_active = isset($_POST["google_plus_active"]) ? 1 : 0; 
	$linkedin_active = isset($_POST["linkedin_active"]) ? 1 : 0; 
	$instagram_active = isset($_POST["instagram_active"]) ? 1 : 0; 
	
	$sql = sprintf("UPDATE company_info 
				SET facebook = '%s'
				,twitter = '%s'
				,youtube = '%s'
				,pinterest = '%s'
				,houzz = '%s'
				,google_plus = '%s'
				,linkedin = '%s'
				,instagram = '%s'
				,facebook_active = '%u'
				,twitter_active = '%u'
				,youtube_active = '%u'
				,pinterest_active = '%u'
				,houzz_active = '%u'
				,google_plus_active = '%u'
				,linkedin_active = '%u'
				,instagram_active = '%u'
				
			WHERE profile_account_id = '%u'", 
				$facebook
				,$twitter
				,$youtube
				,$pinterest
				,$houzz
				,$google_plus
				,$linkedin 
				,$instagram				
				,$facebook_active
				,$twitter_active
				,$youtube_active
				,$pinterest_active
				,$houzz_active
				,$google_plus_active
				,$linkedin_active
				,$instagram_active
				,$_SESSION['profile_account_id']
				);

	$result = $dbCustom->getResult($db,$sql);
	

	$msg = "Changes Saved";
}


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
        require_once($real_root."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		$bread_crumb->add("CMS", SITEROOT."/manage/cms/cms-landing.php");
		$bread_crumb->add("Social Media", '');
        echo $bread_crumb->output();
		
    
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		$sql = "SELECT facebook
				,twitter
				,youtube
				,pinterest
				,houzz
				,google_plus
				,linkedin
				,instagram
				,linkedin_active
				,instagram_active
				,facebook_active	
				,twitter_active	
				,youtube_active
				,pinterest_active
				,houzz_active
				,google_plus_active				
				FROM company_info
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);				
		if($result->num_rows){
			$company_obj = $result->fetch_object();	
			$facebook = $company_obj->facebook;	
			$twitter = $company_obj->twitter;	
			$youtube = $company_obj->youtube;
			$pinterest = $company_obj->pinterest;
			$houzz = $company_obj->houzz;	
			$google_plus = $company_obj->google_plus;
			$linkedin = $company_obj->linkedin;	
			$instagram = $company_obj->instagram;	
			$facebook_active = $company_obj->facebook_active;	
			$twitter_active = $company_obj->twitter_active;	
			$youtube_active = $company_obj->youtube_active;
			$pinterest_active = $company_obj->pinterest_active;	
			$houzz_active = $company_obj->houzz_active;
			$google_plus_active = $company_obj->google_plus_active;
			$linkedin_active = $company_obj->linkedin_active;
			$instagram_active = $company_obj->instagram_active;
		
		}else{
			$facebook = '';	
			$twitter = '';	
			$youtube = '';
			$pinterest = '';
			$houzz = '';	
			$google_plus = '';
			$linkedin = '';	
			$instagram = '';	
			$facebook_active = 0;	
			$twitter_active = 0;	
			$youtube_active = 0;
			$pinterest_active = 0;	
			$houzz_active = 0;
			$google_plus_active = 0;
			$linkedin_active = 0;
			$instagram_active = 0;

		}
        ?>
		<form name="form" action="edit-social-media-links.php " method="post" onSubmit="return validate(this)">
           <div class="page_actions edit_page">
			<?php if($admin_access->cms_level > 1){ ?>
				<button name="form" type="submit" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </button>
				<hr />
             <?php }else{ ?>
            	<div class="alert">
                	<i class="icon-warning-sign"></i>         
                    Sorry, you don't have the permissions to edit this information.
                </div>            
			<?php } ?>
			</div>

			<div class="page_content edit_page">
				<fieldset class="edit_content">

				<div class="colcontainer">
					<label>Facebook URL </label>

                    <div style="float:left; position:relative; top:8px;">
                            <?php
                            $status = ($facebook_active)? "checked='checked'" : '';
							echo "<div class='checkboxtoggle on'> 
							<span class='ontext'>ON</span>
							<a class='switch on' href='#'></a>
							<span class='offtext'>OFF</span>
							<input type='checkbox' class='checkboxinput' name='facebook_active' value='1' $status /></div>";
							?>
					</div>
                    <div style="float:left;">            
						<input type="text" name="facebook" style="width:440px;"  value="<?php echo $facebook;  ?>" />
                    </div>
                            
                    <div style="clear:both"></div>        
                            
				</div>


				<div class="colcontainer">
					<label>Twitter URL</label>

                    <div style="float:left; position:relative; top:8px;">
                            <?php
                            $status = ($twitter_active)? "checked='checked'" : '';
							echo "<div class='checkboxtoggle on'> 
							<span class='ontext'>ON</span>
							<a class='switch on' href='#'></a>
							<span class='offtext'>OFF</span>
							<input type='checkbox' class='checkboxinput' name='twitter_active' value='1' $status /></div>";
							?>
					</div>
                    <div style="float:left;">            
							<input type="text" name="twitter" style="width:440px;"  value="<?php echo $twitter;  ?>" />
                    </div>
                            
                    <div style="clear:both"></div>        

				</div>
                    
                    
				<div class="colcontainer">
					<label>Youtube URL</label>
                    <div style="float:left; position:relative; top:8px;">
                            <?php
                            $status = ($youtube_active)? "checked='checked'" : '';
							echo "<div class='checkboxtoggle on'> 
							<span class='ontext'>ON</span>
							<a class='switch on' href='#'></a>
							<span class='offtext'>OFF</span>
							<input type='checkbox' class='checkboxinput' name='youtube_active' value='1' $status /></div>";
							?>
					</div>
                    <div style="float:left;">            
							<input type="text" name="youtube" style="width:440px;"  value="<?php echo $youtube;  ?>" />
                    </div>
                            
                    <div style="clear:both"></div>        

				</div>

				<div class="colcontainer">
					<label>Pinterest URL</label>
                    <div style="float:left; position:relative; top:8px;">
                            <?php
                            $status = ($pinterest_active)? "checked='checked'" : '';
							echo "<div class='checkboxtoggle on'> 
							<span class='ontext'>ON</span>
							<a class='switch on' href='#'></a>
							<span class='offtext'>OFF</span>
							<input type='checkbox' class='checkboxinput' name='pinterest_active' value='1' $status /></div>";
							?>
					</div>
                    <div style="float:left;">            
						<input type="text" name="pinterest" style="width:440px;" value="<?php echo $pinterest;  ?>" />
                    </div>
                            
                    <div style="clear:both"></div>        

				</div>


				<div class="colcontainer">
					<label>Houzz Link</label>
                    <div style="float:left; position:relative; top:8px;">
                            <?php
                            $status = ($houzz_active)? "checked='checked'" : '';
							echo "<div class='checkboxtoggle on'> 
							<span class='ontext'>ON</span>
							<a class='switch on' href='#'></a>
							<span class='offtext'>OFF</span>
							<input type='checkbox' class='checkboxinput' name='houzz_active' value='1' $status /></div>";
							?>
					</div>
                    <div style="float:left;">            
	                    <textarea name="houzz" style="width:440px;"><?php echo stripslashes($houzz);  ?></textarea>
                    </div>
                            
                    <div style="clear:both"></div>        

 				</div>

				<div class="colcontainer">
					<label>Google Plus Link</label>
                    <div style="float:left; position:relative; top:8px;">
                            <?php
                            $status = ($google_plus_active)? "checked='checked'" : '';
							echo "<div class='checkboxtoggle on'> 
							<span class='ontext'>ON</span>
							<a class='switch on' href='#'></a>
							<span class='offtext'>OFF</span>
							<input type='checkbox' class='checkboxinput' name='google_plus_active' value='1' $status /></div>";
							?>
					</div>
                    <div style="float:left;">            
	                    <input type="text" name="google_plus" style="width:440px;" value="<?php echo $google_plus; ?>">
                    </div>
                    <div style="clear:both"></div>        

 				</div>
				
				
				<div class="colcontainer">
					<label>Linkedin</label>
                    <div style="float:left; position:relative; top:8px;">
                            <?php
                            $status = ($linkedin_active)? "checked='checked'" : '';
							echo "<div class='checkboxtoggle on'> 
							<span class='ontext'>ON</span>
							<a class='switch on' href='#'></a>
							<span class='offtext'>OFF</span>
							<input type='checkbox' class='checkboxinput' name='linkedin_active' value='1' $status /></div>";
							?>
					</div>
                    <div style="float:left;">            
	                    <input type="text" name="linkedin" style="width:440px;" value="<?php echo $linkedin; ?>">
                    </div>
                    <div style="clear:both"></div>        

 				</div>
				
				
				
				<div class="colcontainer">
					<label>Instagram</label>
                    <div style="float:left; position:relative; top:8px;">
                            <?php
                            $status = ($instagram_active)? "checked='checked'" : '';
							echo "<div class='checkboxtoggle on'> 
							<span class='ontext'>ON</span>
							<a class='switch on' href='#'></a>
							<span class='offtext'>OFF</span>
							<input type='checkbox' class='checkboxinput' name='instagram_active' value='1' $status /></div>";
							?>
					</div>
                    <div style="float:left;">            
	                    <input type="text" name="instagram" style="width:440px;" value="<?php echo $instagram; ?>">
                    </div>
                    <div style="clear:both"></div>        

 				</div>
				


				</fieldset>
			</div>
		</form>
	</div>
	<p class="clear"></p>
	<?php 
	
require_once($real_root.'/manage/admin-includes/manage-footer.php');
?>
</div>
</body>
</html>

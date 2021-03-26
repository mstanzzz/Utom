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


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Testimonial Page";
$page_group = "testimonial-page";
$page = "testimonials";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$testimonial_page_id = (isset($_REQUEST['testimonial_page_id'])) ? $_REQUEST['testimonial_page_id'] : 0;



$ts = time();
// add if not exist
$sql = "SELECT testimonial_page_id FROM testimonial_page WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows == 0){
	$sql = "INSERT INTO testimonial_page 
		(content, last_update, profile_account_id) 
		VALUES ('Add Content', '".$ts."', '".$_SESSION['profile_account_id']."')"; 
	$result = $dbCustom->getResult($db,$sql);
	
	
	$testimonial_page_id = $db->insert_id;
}

if(!isset($_SESSION['testimonial_page_id'])) $_SESSION['testimonial_page_id'] = $testimonial_page_id;

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

if(isset($_POST["edit_testimonial_page"])){
	
	$content = trim(addslashes($_POST["content"])); 
	$testimonial_page_id = $_POST["testimonial_page_id"];
	$img_id = (isset($_POST['img_id'])) ? $_POST['img_id'] : 0;
	$img_alt_text = trim(addslashes($_POST['img_alt_text'])); 
	
	$mssl = (isset($_POST['mssl']))? 1 : 0;
	$seo_name = trim(addslashes($_POST['seo_name']));
	$seo_name = str_replace (" ", "-" , $seo_name);
	$title = trim(addslashes($_POST['title']));
	$keywords = trim(addslashes($_POST['keywords']));
	$description = trim(addslashes($_POST['description']));
	$page_heading = trim(addslashes($_POST['page_heading']));
	

	require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/insert_page_seo.php");

	//if(in_array(2,$user_functions_array)){
		// create a back up
		//$backup = new Backup;
		//$dbu = $backup->doBackup($testimonial_page_id,$user_id,"testimonial_page");	

		$sql = sprintf("UPDATE testimonial_page 
						SET content = '%s'
						,img_id = '%u'
						,img_alt_text = '%s' 
						WHERE testimonial_page_id = '%u'", 
		$content, $img_id, $img_alt_text, $testimonial_page_id);

		$msg = "Your change is now live.";
	/*
	}else{
		
		$sql = sprintf("INSERT INTO review (content_table, when_submitted, submitted_by_login_id, slug, content1, img_id, content_record_id) 
			VALUES ('%s','%u','%u','%s','%s','%u','%u')", 
			"testimonial_page", $ts, $user_id, "testimonial-page", $content, $img_id, $testimonial_page_id);

		$msg = "Your change is now pending approval.";
	
	}
	*/
	$result = $dbCustom->getResult($db,$sql);
		
	
	require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/insert_page_breadcrumb.php");

	
}


/* this has been moved to general adin testimonial-list.php 
if(isset($_POST["edit_testimonial"])){

	$name = trim(addslashes($_POST['name'])); 
	$email = trim(addslashes($_POST["email"])); 
	$city_state = trim(addslashes($_POST["city_state"])); 
	$content = trim(addslashes($_POST["content"])); 
	$list_order = trim(addslashes($_POST["list_order"])); 
	$hide = (isset($_POST["hide"]))? trim(addslashes($_POST["hide"])) : 0;
	$testimonial_id = $_POST["testimonial_id"];
	$ts = time();

		$sql = sprintf("UPDATE testimonial 
		SET name = '%s', email = '%s', city_state = '%s', content = '%s', list_order = '%u', hide = '%u'  WHERE testimonial_id = '%u'", 
		$name, $email, $city_state, $content, $list_order, $hide, $testimonial_id);
		
		$msg = "Your change is now live.";
	
	$result = $dbCustom->getResult($db,$sql);
		

}

*/


if(isset($_POST["set_display_order"])){
	
	$display_order = $_POST["display_order"];
	$testimonial_id  = $_POST["testimonial_id"];
	
	//print_r($display_orders);
	//echo "<br />";
	//print_r($navbar_label_ids);
	//exit;
	
	if(is_array($display_order)){

		for($i = 0; $i < count($display_order); $i++){
			
			//echo "display_orders".$display_orders[$i];
			//echo "<br />";
			//echo "navbar_label_id".$navbar_label_ids[$i];
			//echo "-----------------------<br />";
			
			$sql = sprintf("UPDATE testimonial 
				SET list_order = '%u' 
				WHERE testimonial_id = '%u'",
				$display_order[$i], $testimonial_id[$i]);

			$result = $dbCustom->getResult($db,$sql);
			


		}
	}

	
}

 	
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = "SELECT content, img_id, heading, img_alt_text 
    FROM testimonial_page 
 	WHERE testimonial_page_id = '".$_SESSION['testimonial_page_id']."'";
    $result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		$content = $object->content;
		$img_id = $object->img_id;
		$heading = $object->heading;
		$img_alt_text = $object->img_alt_text;
	}else{
		$content = '';
		$img_id = 0; 
		$heading = '';
		$img_alt_text = '';
	}
	

if(!isset($_SESSION['img_id'])) $_SESSION['img_id'] = $img_id;
if(!isset($_SESSION['temp_page_fields']['content'])) $_SESSION['temp_page_fields']['content'] = $content;
if(!isset($_SESSION['temp_page_fields']['img_alt_text'])) $_SESSION['temp_page_fields']['img_alt_text'] = $img_alt_text;

require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/get_seo_variables.php");

if(!isset($_SESSION['temp_page_fields']['page_heading'])) $_SESSION['temp_page_fields']['page_heading'] = $page_heading;
if(!isset($_SESSION['temp_page_fields']['seo_name'])) $_SESSION['temp_page_fields']['seo_name'] = $seo_name;
if(!isset($_SESSION['temp_page_fields']['title'])) $_SESSION['temp_page_fields']['title'] = $title;
if(!isset($_SESSION['temp_page_fields']['keywords'])) $_SESSION['temp_page_fields']['keywords'] = $keywords;
if(!isset($_SESSION['temp_page_fields']['description'])) $_SESSION['temp_page_fields']['description'] = $description;


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>
<script>

$(document).ready(function() {

	$('.fancybox').click(function(){		
		
		ajax_set_page_session();
	
	});

});




function ajax_set_page_session(){
	
	var q_str = "?page=testimonial-page"+get_query_str();
		
	$.ajaxSetup({ cache: false}); 
	$.ajax({
	  url: 'ajax_set_page_session.php'+q_str,
	  success: function(data) {
			//alert(data);
	  }
	});
}

function get_query_str(){
	
	var query_str = '';
	query_str += "&page_heading="+$("#page_heading").val().replace('&', '%26');
	query_str += "&img_alt_text="+$("#img_alt_text").val().replace('&', '%26'); 
	query_str += "&content="+escape(tinyMCE.get('content').getContent());
	
	query_str += "&seo_name="+document.form.seo_name.value; 
	query_str += "&title="+document.form.title.value.replace('&', '%26'); 
	query_str += "&keywords="+document.form.keywords.value.replace('&', '%26'); 
	query_str += "&description="+document.form.description.value.replace('&', '%26'); 
	return query_str;
}


function select_img(img_id){
	document.getElementById(img_id).checked = true;	
}
/*
function msslSubmit(){
	document.set_ssl.submit();
}
*/
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
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,code",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : false,
		forced_root_block : false

	});


function previewSubmit() {
  document.form.action = '<?php echo $ste_root; ?>/pages/preview/preview.php';
  document.form.target = '_blank'; 
  document.form.submit();
}	


function regularSubmit() {
  document.form.action = '<?php echo $current_page; ?>';
  document.form.target = '_self';
  document.form.submit(); 
}	

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
		$bread_crumb->add("Pages", $ste_root."manage/cms/pages/page.php");
		$bread_crumb->add("Testimonials Page", '');
        echo $bread_crumb->output();

        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
		//testimonial section tabbed sub-navigation
        require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/testimonial-section-tabs.php");
        ?>
		<form name="form" action="testimonial-page.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="edit_testimonial_page" value="1">        
            <input type="hidden" name="testimonial_page_id" value="<?php echo $_SESSION['testimonial_page_id']; ?>">
			<input type="hidden" name="page" value="<?php echo $page; ?>">             
            <input type="hidden" name="ret_page" value="testimonial-page">
            <input type="hidden" name="ret_dir" value="manage/cms/pages">
            <input type="hidden" name="content_table" value="testimonial_page"> 

			<div class="page_actions edit_page"> 
	           <a onClick="previewSubmit();" href="#" class="btn btn-primary btn-large"><i class="icon-eye-open icon-white"></i> Preview </a>
				<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </a>
                <a href="<?php echo $ste_root; ?>/manage/cms/navigation/navbar.php?strip=1" class="btn btn-primary btn-large fancybox fancybox.iframe">
                <i class="icon-eye-open icon-white"></i> Edit Navigation </a>

                <hr />
				<a href="<?php echo $ste_root;?>/manage/cms/pages/page.php" class="btn"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>
				<?php 
				if($_SESSION['is_ssl']){ 
					$checked = ($mssl)? "checked=checked" : ''; 		
				?>
				<label>Set Page as SSL</label>
				<div class="checkboxtoggle on"> <span class="ontext">ON</span><a class="switch on" href="#"></a><span class="offtext">OFF</span>
					<input type="checkbox" class="checkboxinput" name="mssl" value="1" <?php echo $checked; ?> />
				</div>
				<?php } ?>
				</div>
			<div class="page_content edit_page">
            <fieldset class="edit_content">
                <legend>Page Content <i class="icon-minus-sign icon-white"></i></legend>
                
                        <div class="colcontainer formcols">
                            <div class="twocols">
                                <label>Page Name</label>
                            </div>
                            <div class="twocols">
                                <input id="page_heading" type="text" name="page_heading" value="<?php echo stripslashes($_SESSION['temp_page_fields']['page_heading']); ?>" />
                            </div>
                        </div>
                <div class="colcontainer"> 
                	<label>Main Content</label>
                    <textarea id="content" class="wysiwyg" name="content"><?php echo stripslashes($_SESSION['temp_page_fields']['content']); ?></textarea>
                </div>
            </fieldset>

				<fieldset class="edit_images">
					<legend>Page Images <i class="icon-minus-sign icon-white"></i></legend>
                    			<div class="colcontainer">
				<?php
				$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
                $sql = "SELECT * 
						FROM image 
						WHERE slug = 'testimonial-page'
						AND profile_account_id = '".$_SESSION['profile_account_id']."'";
                $img_res = $dbCustom->getResult($db,$sql);
                ;
				
                $i = 1;
                while($img_row = $img_res->fetch_object()) {
					?>
				<div class="threecols">
					<?php 
						echo "<img src='".$ste_root."/ul_cms/".$domain."/".$img_row->file_name."' width='120px' onClick='select_img(".$img_row->img_id.")' />"; 
						if($img_id == $img_row->img_id){
							$checked = "checked=checked";
							echo "<div class='radiotoggle on'>";
						}else{
							$checked = '';
							echo "<div class='radiotoggle off'>";
						}
						?>
					<span class="ontext">ON</span><a class="switch on" href="#"></a><span class="offtext">OFF</span>
					<input type="radio" class="radioinput" name="img_id" value="<?php echo $img_row->img_id; ?>" <?php echo $checked ?>/>
				</div>
			</div>
			<?php					
					
					//echo $i;
					
					if($i % 2 == 0) echo "<div class='clear'></div>";
                	$i++;
					
				}
				
                ?>
			<div class="threecols"> 
            <a class="btn btn-large btn-primary fancybox fancybox.iframe" 
            href="<?php echo $ste_root;?>/manage/cms/upload.php?ret_page=testimonial-page&ret_dir=pages&img_max_width=450">
            	<i class="icon-plus icon-white"></i> Add New Image</a> </div>
			</div>
            
                        
            <div class="colcontainer formcols">
                <div class="twocols">
	                <label>Image Alt Tag Text</label>
                </div>
                <div class="twocols">
    	            <input id="img_alt_text" type="text" name="img_alt_text" value="<?php echo stripslashes($_SESSION['temp_page_fields']['img_alt_text']); ?>" />
                </div>
            </div>

            
			</fieldset>

	        <?php 
			$page_heading = $_SESSION['temp_page_fields']['page_heading'];
			$seo_name = $_SESSION['temp_page_fields']['seo_name'];
			$title = $_SESSION['temp_page_fields']['title'];
			$keywords = $_SESSION['temp_page_fields']['keywords'];	
			$description = $_SESSION['temp_page_fields']['description'];
			require_once("edit_page_seo.php"); 
    	    require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/edit_page_breadcrumb.php"); 
			?>
			
		</div>	
		</form>

 </div>   
<p class="clear"></p>
<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
?>
 
 </div>   
       
    




    <div style="display:none">
        <div id="edt_page" style="width:700px; height:660px;">
        </div>
    </div>

    <div style="display:none">
        <div id="edit" style="width:800px; height:660px;">
        </div>
    </div>

    
   <div style="display:none">
        <div id="upload" style="width:280px; height:200px;">
        </div>
    </div>
    
 <div style="display:none">
        <div id="delete_bc" style="width:250px; height:100px;">
        	<br />
            Are you sure you want to delete this bread crumb?
            <form name="del_bc" action="policy.php" method="post">
                <input id="del_bc_id" type="hidden" name="del_bc_id" />
                <input name="del_bc" type="submit" value="DELETE" />
            </form>
        </div>
    </div>
        
  
</body>
</html>




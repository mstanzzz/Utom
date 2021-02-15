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


$page_title = "Edit Testimonial";
$page_group = "edit-testimonial";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = '';

		$sortby = (isset($_GET['sortby'])) ? trim($_GET['sortby']) : '';
		$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
		
		$pagenum = (isset($_GET['pagenum'])) ? $_GET['pagenum'] : 0;
		$truncate = (isset($_GET['truncate'])) ? $_GET['truncate'] : 1;
		
		$search_str = isset($_REQUEST['search_str']) ? trim(addslashes($_REQUEST['search_str'])) : '';


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>

<script type="text/javascript" language="javascript">
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
	
	
$(document).ready(function () {
	
    $("#datepicker1").datepicker();
    
	//$('#clear_dates').click(function () {
        //$('#datepicker1').val("");
    //});

});
	

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
		$testimonial_id = (isset($_GET['testimonial_id'])) ? $_GET['testimonial_id'] : 0;
		$type = (isset($_GET['type'])) ? $_GET['type'] : 'testimonial';
		$sql = sprintf("SELECT * FROM testimonial 
		WHERE testimonial_id = '%u'
		AND type = '".$type."' 
		AND profile_account_id = '%u'", $testimonial_id, $_SESSION['profile_account_id']);
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			$name = $object->name;
			$email = $object->email;
			$city_state = $object->city_state;
			$list_order = $object->list_order;
			$content = $object->content;
			$hide = $object->hide;	
			$last_update = $object->last_update;
			$rating = $object->rating;
			$is_local = $object->is_local;
		}else{
			$name = '';
			$email = '';
			$city_state = '';
			$list_order = '';
			$content = '';
			$hide = '';
			$last_update = '';
			$rating = 5;	
			$is_local = 1;	
		}
		
		
		if($type == 'feedback'){
			$url_str = "feedback.php";	
		}else{
			$url_str = "testimonial-list.php";
		}
		
		
		
				$url_str .= "?pagenum=".$pagenum;
				$url_str .= "&sortby=".$sortby;
				$url_str .= "&a_d=".$a_d;
				$url_str .= "&truncate=".$truncate;
				$url_str .= "&search_str=".$search_str;
		
		
	?>
        <form name="edit_testimonial" action="<?php echo $url_str; ?>" method="post" target="_top">
			<input id="testimonial_id" type="hidden" name="testimonial_id" value="<?php echo $testimonial_id;  ?>" />
            
            <input type="hidden" name="edit_testimonial" value="1" />
            
            
			<div class="lightboxcontent">
				<h2>Edit Testimonial</h2>
				<fieldset class="colcontainer">
					<div class="threecols">
						<label>Name</label>
						<input type="text" name="name" value="<?php echo prepFormInputStr($name); ?>" maxlength="160" size="30" />
					</div>
					<div class="threecols">
						<label>Email Address</label>
						<input type="text" name="email" value="<?php echo $email; ?>" maxlength="160" size="30"  />
					</div>
					<div class="threecols">
						<label>City State</label>
						<input type="text" name="city_state" value="<?php echo prepFormInputStr($city_state); ?>" maxlength="160" size="30" />
					</div>
				
   					<div class="threecols">
						<label>Star Rating</label>
                        
                        <select name="rating">
                        <option value="1" <?php if($rating == 1) echo "selected"; ?>>1</option>
                        <option value="2" <?php if($rating == 2) echo "selected"; ?>>2</option>
                        <option value="3" <?php if($rating == 3) echo "selected"; ?>>3</option>     
                        <option value="4" <?php if($rating == 4) echo "selected"; ?>>4</option>
                        <option value="5" <?php if($rating == 5) echo "selected"; ?>>5</option>
                        </select>
						
					</div>

                
                
                </fieldset>
                
                
                
                
                
				<fieldset class="colcontainer"> 
					<div class="twocols">
					</div>
					<div class="twocols">
						<label>Date</label>
						<?php $w_d =  ($last_update > 0) ? date('m/d/Y',$last_update) : ''; ?>
                        <input type="text" name="last_update" id="datepicker1" value="<?php echo $w_d; ?>" />
                        
					</div>
				</fieldset>
                
                
                
                
                
				<fieldset class="colcontainer"> 
					<div class="twocols">
						<label>Show On Site?</label>
						<div class="radiotoggle on"> 
                        <span class="ontext">ON</span>
                        <a class="switch on" href="#"></a>
                        <span class="offtext">OFF</span>
                        <input type="radio" class="radioinput" name="hide" value="0" <?php if(!$hide) echo "checked='checked'"; ?> /></div>
					</div>
					<div class="twocols">
						<label>Display Order</label>
						<input name="list_order" type="text"  value="<?php echo $list_order; ?>"/> 
					</div>
				</fieldset>
                
                
                
                
                <fieldset class="colcontainer"> 
					<div class="twocols">
						<label>Is Local?</label>
						<div class="radiotoggle on"> 
                        <span class="ontext">Yes</span>
                        <a class="switch on" href="#"></a>
                        <span class="offtext">No</span>
                        <input type="radio" class="radioinput" name="is_local" value="1" <?php if($is_local) echo "checked='checked'"; ?> /></div>
					</div>
					<div class="twocols">
						 
					</div>
				</fieldset>
                
                
                
                
                
				<fieldset class="colcontainer">
					<label>Testimonial</label>
					<textarea  name="content" class="wysiwyg" id="wysiwyg"><?php echo stripslashes($content); ?></textarea>
				</fieldset>
                
                
                <fieldset class="colcontainer">
                
                <?php
                $sql = "SELECT file_name, testimonial_img_id, active 
			FROM testimonial_image 
			WHERE testimonial_id = '".$testimonial_id."'";
			
			$res = $dbCustom->getResult($db,$sql);
            
			while($row = $res->fetch_object()){
				
			$checked = ($row->active)? "checked='checked'" : '';	
				
				
			echo "<div class='radiotoggle off '>
							<span class='ontext'>ON</span>
							<a class='switch on' href='#'></a>
							<span class='offtext'>OFF</span>
							<input type='radio' class='radioinput' name='active' value='".$row->testimonial_img_id."' $checked /></div>";	
							//edit	
				
				
				
			echo "<a href='".$ste_root."/user_uploads/".$_SESSION['profile_account_id']."/".$row->file_name."' class='fancybox'>
				<img src='".$ste_root."/user_uploads/".$_SESSION['profile_account_id']."/".$row->file_name."' style='margin: 10px;' /></a>";
			
				
			}
			
			
			?>
            </fieldset>
                
                
			</div>
			<div class="savebar">
				<button class="btn btn-large btn-success" type="submit" name="edit_testimonial"><i class="icon-ok icon-white"></i> Save Changes </button>
			</div>
        </form>

</div>

</div>
</body>
</html>




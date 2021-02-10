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


$page_title = "Add Testimonial";
$page_group = "testimonial";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = '';

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>

<link rel="stylesheet" href="<?php echo $ste_root; ?>/plupload-2.1.8/js/jquery.plupload.queue/css/jquery.plupload.queue.css" type="text/css" media="screen" />

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
		<p><?php echo $msg; ?></p>
    
        <form name="add_testimonial" action="testimonial-list.php" method="post" target="_top">
			
            <input type="hidden" name="add_testimonial" value="1" />
            
            
			<div class="lightboxcontent">
				<h2>Edit Testimonial</h2>
				<fieldset class="colcontainer">
					<div class="threecols">
						<label>Name</label>
						<input type="text" name="name" maxlength="160" size="30" />
					</div>
					<div class="threecols">
						<label>Email Address</label>
						<input type="text" name="email" maxlength="160" size="30"  />
					</div>
					<div class="threecols">
						<label>City State</label>
						<input type="text" name="city_state" maxlength="160" size="30" />
					</div>

					<div class="threecols">
						<label>Star Rating</label>
                        
                        <select name="rating">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>     
                        <option value="4">4</option>
                        <option value="5">5</option>
                        </select>
						
					</div>
				
                
                </fieldset>
                
                
				<fieldset class="colcontainer"> 
					<div class="twocols">
					</div>
					<div class="twocols">
						<label>Date</label>
						<input type="text" name="last_update" id="datepicker1" />
                        
					</div>
				</fieldset>
                
                
                
                
				<fieldset class="colcontainer"> 
					<div class="twocols">
						<label>Show On Site?</label>
						<div class="radiotoggle on"> 
                        <span class="ontext">ON</span>
                        <a class="switch on" href="#"></a>
                        <span class="offtext">OFF</span>
                        <input type="radio" class="radioinput" name="hide" value="0" /></div>
					</div>
					<div class="twocols">
						<label>Display Order</label>
						<input name="list_order" type="text" /> 
					</div>
				</fieldset>
                
                
                <fieldset class="colcontainer"> 
					<div class="twocols">
						<label>Is Local?</label>
						<div class="radiotoggle on"> 
                        <span class="ontext">Yes</span>
                        <a class="switch on" href="#"></a>
                        <span class="offtext">No</span>
                        <input type="radio" class="radioinput" name="is_local" value="1" /></div>
					</div>
					<div class="twocols">
						 
					</div>
				</fieldset>
                
                
                
                
				<fieldset class="colcontainer">
					<label>Testimonial</label>
					<textarea  name="content" class="wysiwyg" id="wysiwyg"></textarea>
				</fieldset>


	<div id="uploader">
		<p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
	</div>


			</div>
			<div class="savebar">
				<button class="btn btn-large btn-success" type="submit" name="add_testimonial"><i class="icon-ok icon-white"></i> Save Changes </button>
			</div>
        </form>
                

<script type="text/javascript" src="<?php echo $ste_root; ?>/plupload-2.1.8/js/plupload.full.min.js"></script>
<script type="text/javascript" src="<?php echo $ste_root; ?>/plupload-2.1.8/js/jquery.plupload.queue/jquery.plupload.queue.js"></script>

<script type="text/javascript">
$(function() {
	
	// Setup html5 version
	$("#uploader").pluploadQueue({
		// General settings
		runtimes : 'html5,flash,silverlight,html4',
		url : '<?php echo $ste_root; ?>/plupload-2.1.8/otg/upload.php',
		chunk_size: '1mb',
		rename : true,
		dragdrop: true,
		
		filters : {
			// Maximum file size
			max_file_size : '10mb',
			// Specify what files to browse for
			mime_types: [
				{title : "Image files", extensions : "jpg,jpeg,gif,png,pdf"},
				{title : "Zip files", extensions : "zip"}
			]
		},

		// Resize images on clientside if we can
		resize : {width : 680, quality : 90},

		flash_swf_url : '<?php echo $ste_root; ?>/plupload-2.1.8/js/Moxie.swf',
		silverlight_xap_url : '<?php echo $ste_root; ?>/plupload-2.1.8/js/Moxie.xap'
	});
	
	var uploader = $('#uploader').pluploadQueue();

	uploader.bind('FileUploaded', function() {
		if (uploader.files.length == (uploader.total.uploaded + uploader.total.failed)) {
			$("#submit_sendto").show();
        }else{
			$("#submit_sendto").hide();
		}
	});
	
	uploader.bind('UploadProgress', function(up, file) {
    
        if(file.percent < 100 && file.percent >= 1){
			$("#submit_sendto").hide();
        }else{
			//$("#submit_sendto").show();
        }                               
    });

});
</script>

                
                

</div>

</div>
</body>
</html>




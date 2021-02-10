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

$page_title = "Add Location";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = '';


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
</script>
</head>
<body>

<div class="lightboxholder">
	<?php if($msg != ''){ ?>
	<div class="alert">
		<p><?php echo $msg ?></p>
	</div>
	<?php } ?>
	<form name="form" action="contact-us.php" method="post" target="_top">
		<div class="lightboxcontent">
			<h2>Add a New Location</h2>
			<fieldset class="colcontainer">
					<div class="location_container">
                        <div class="colcontainer formcols">
							<div class="twocols">
								<label>Location Name</label>
							</div>
							<div class="twocols">
								<input type="text" name="name"  />
							</div>
						</div>
						<div class="colcontainer formcols">
							<div class="twocols">
								<label>Street Address</label>
							</div>
							<div class="twocols">
								<input type="text" name="street_addr"  />
							</div>
						</div> 

						<div class="colcontainer formcols">
							<div class="twocols">
								<label>City</label>
							</div>
							<div class="twocols">
								<input type="text" name="city"  />

							</div>
						</div>
						<div class="colcontainer formcols">
							<div class="twocols">
								<label>State</label>
							</div>
							<div class="twocols">
  							<select name="state" style="width:120px;">
							<?php 
							$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
							$sql = "SELECT state, state_abr 
									FROM states 
									WHERE hide = '0'
									AND profile_account_id = '1' 
									ORDER BY country DESC, state"; 
					$result = $dbCustom->getResult($db,$sql);							
							 $block = '';		 
							 while($row = $result->fetch_object()) {
								$block .= "<option value='".$row->state_abr."' $sel >$row->state</option>";
							 }
							echo $block;
							?>
							</select>

							</div>
						</div>
						<div class="colcontainer formcols">
							<div class="twocols">
								<label>Zip Code</label>
							</div>
							<div class="twocols">
								<input type="text" name="zip" />
							</div>
						</div>
  						<div class="colcontainer formcols">
							<div class="twocols">
								<label>Location Phone</label>
							</div>
							<div class="twocols">
								<input type="text" name="phone" />
							</div>
						</div>
  						<div class="colcontainer formcols">
							<div class="twocols">
								<label>Location Email Address</label>
							</div>
							<div class="twocols">
								<input type="text" name="email"  />
							</div>
						</div>
						<div class="colcontainer formcols">
							<div class="twocols">
								<label>Location Hours</label>
							</div>
							<div class="twocols">
								<textarea class="wysiwyg small" name="hours"></textarea>
							</div>
						</div>

            		</div>
				</fieldset>
			</div>
		<div class="savebar">
            <button class="btn btn-large btn-success" name="add_location" type="submit" ><i class="icon-ok icon-white"></i> Add New Location </button>
		</div>
	</form>
</div>
</body>
</html> 





















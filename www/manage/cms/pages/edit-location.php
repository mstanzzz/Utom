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

$page_title = "Edit Location";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = '';

$location_id = (isset($_GET['location_id']))? $_GET['location_id'] : 0;

$sql = "SELECT *	
	FROM location
	WHERE location_id = '".$location_id."'";
$result = $dbCustom->getResult($db,$sql);		
if($result->num_rows>0){
	$object = $result->fetch_object();
	$name = $object->name;
	$street_addr = $object->street_addr;
	$city = $object->city;
	$state = $object->state;
	$zip = $object->zip;
	$phone = $object->phone;
	$email = $object->email;
	$hours = $object->hours;
}else{
	$name = '';
	$street_addr = '';
	$city = '';
	$state = '';
	$zip = '';
	$phone = '';
	$email = '';
	$hours = '';
}


require_once($real_root.'/manage/admin-includes/doc_header.php'); 

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
    	<input type="hidden" name="location_id" value="<?php echo $location_id; ?>"  />
		<div class="lightboxcontent">
			<h2>Add a New Location</h2>
			<fieldset class="colcontainer">
					<div class="location_container">
                        <div class="colcontainer formcols">
							<div class="twocols">
								<label>Location Name</label>
							</div>
							<div class="twocols">
								<input type="text" name="name" value="<?php echo $name; ?>"  />
							</div>
						</div>
						<div class="colcontainer formcols">
							<div class="twocols">
								<label>Street Address</label>
							</div>
							<div class="twocols">
								<input type="text" name="street_addr" value="<?php echo $street_addr; ?>" />
							</div>
						</div> 

						<div class="colcontainer formcols">
							<div class="twocols">
								<label>City</label>
							</div>
							<div class="twocols">
								<input type="text" name="city" value="<?php echo $city; ?>" />
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
									AND profile_account_id = '".$_SESSION['profile_account_id']."' 
									ORDER BY country DESC, state"; 
					$result = $dbCustom->getResult($db,$sql);							
							 $block = '';		 
							 while($row = $result->fetch_object()) {
								$sel =  ($state == $row->state_abr) ? "selected" : '';	
								
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
								<input type="text" name="zip" value="<?php echo $zip; ?>"/>
							</div>
						</div>
  						<div class="colcontainer formcols">
							<div class="twocols">

								<label>Location Phone</label>
							</div>
							<div class="twocols">
								<input type="text" name="phone" value="<?php echo $phone; ?>"/>
							</div>
						</div>
  						<div class="colcontainer formcols">
							<div class="twocols">
								<label>Location Email Address</label>
							</div>
							<div class="twocols">
								<input type="text" name="email" value="<?php echo $email; ?>" />
							</div>
						</div>
						<div class="colcontainer formcols">
							<div class="twocols">
								<label>Location Hours</label>
							</div>
							<div class="twocols">
								<input type="text" name="hours" value="<?php echo $hours; ?>" />
							</div>
						</div>

            		</div>
				</fieldset>
			</div>
		<div class="savebar">
            <button class="btn btn-large btn-success" name="edit_location" type="submit" ><i class="icon-ok icon-white"></i> Save Location </button>
		</div>
	</form>
</div>
</body>
</html> 





















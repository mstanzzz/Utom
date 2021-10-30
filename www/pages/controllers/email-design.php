<?php
if(!isset($_SESSION['temp_id'])){
	$_SESSION['temp_id'] = time();	
}

if(isset($_GET['another']) && isset($_SESSION['designrequest']['email'])){
	$email = $_SESSION['designrequest']['email'];
	$name = $_SESSION['designrequest']['first_name'].' '.$_SESSION['designrequest']['last_name']; 
	$first_name = $_SESSION['designrequest']['first_name'];
	$last_name = $_SESSION['designrequest']['last_name'];
	$phone = $_SESSION['designrequest']['phone']; 
	$zip = $_SESSION['designrequest']['zip']; 	
	$proposed_finish_date = $_SESSION['designrequest']['proposed_finish_date']; 
		
	$budget_range = $_SESSION['designrequest']['budget_range']; 	
	$ceiling_height = $_SESSION['designrequest']['ceiling_height']; 
		
	$base_mold_height = $_SESSION['designrequest']['base_mold_height']; 	
	$door_size = $_SESSION['designrequest']['door_size']; 	
	$short_hang = $_SESSION['designrequest']['short_hang']; 	
	$medium_hang = $_SESSION['designrequest']['medium_hang']; 	
	$long_hang = $_SESSION['designrequest']['long_hang']; 	
	$drawers = $_SESSION['designrequest']['drawers']; 	
	$shoes = $_SESSION['designrequest']['shoes'];
	$has_shelves = $_SESSION['designrequest']['has_shelves'];

	$has_laundry_hamper = $_SESSION['designrequest']['has_laundry_hamper'];
	$has_mirror = $_SESSION['designrequest']['has_mirror'];
	$has_ironing_board = $_SESSION['designrequest']['has_ironing_board'];
	$has_basket_tall = $_SESSION['designrequest']['has_basket_tall'];
	$has_basket_medium = $_SESSION['designrequest']['has_basket_medium'];
	$has_basket_short = $_SESSION['designrequest']['has_basket_short'];
	$closet_type = $_SESSION['designrequest']['closet_type'];
	$wall_a = $_SESSION['designrequest']['wall_a'];
	$wall_b = $_SESSION['designrequest']['shoes'];
	$wall_c = $_SESSION['designrequest']['wall_c'];
	$wall_d = $_SESSION['designrequest']['wall_d'];
	$wall_e = $_SESSION['designrequest']['wall_e'];
	$wall_f = $_SESSION['designrequest']['wall_f'];
	$wall_g = $_SESSION['designrequest']['wall_g'];
	$finish = $_SESSION['designrequest']['finish'];
	$obstructions = $_SESSION['designrequest']['obstructions'];
	$comments = $_SESSION['designrequest']['comments'];
	$has_short_hang = $_SESSION['designrequest']['has_short_hang'];
	$has_medium_hang = $_SESSION['designrequest']['has_medium_hang'];
	$has_long_hang = $_SESSION['designrequest']['has_long_hang'];
	$has_tie_rack = $_SESSION['designrequest']['has_tie_rack'];
	$has_belt_rack = $_SESSION['designrequest']['has_belt_rack'];
	$has_valet_rod = $_SESSION['designrequest']['has_valet_rod'];
	$has_jewelry_tray = $_SESSION['designrequest']['has_jewelry_tray'];
	$storage_type = $_SESSION['designrequest']['storage_type'];
	$door_type = $_SESSION['designrequest']['door_type'];
	$child_age = $_SESSION['designrequest']['child_age'];
	$item_id = $_SESSION['designrequest']['item_id'];

}else{
		
	$email = '';
	$name = ''; 
	$first_name = '';
	$last_name = '';
	$phone = ''; 
	$zip = ''; 
	$proposed_finish_date = '';
	$budget_range = ''; 
	$ceiling_height = '';
	$base_mold_height = '';
	$door_size = '';
	$short_hang = ''; 
	$medium_hang = ''; 
	$long_hang = ''; 
	$drawers = ''; 
	$shoes = ''; 
	$has_shelves = '';
	$tie_rack = ''; 
	$belt_rack = ''; 
	$valet_rod = '';
	$has_laundry_hamper = 0;	
	$has_mirror = 0;	
	$has_ironing_board = 0;
	$has_basket_tall = 0;	
	$has_basket_medium = 0;	
	$has_basket_short = 0;	
	$closet_type = 'Reach-in';
	$wall_a = '';
	$wall_b = '';
	$wall_c = '';
	$wall_d = '';
	$wall_e = '';
	$wall_f = '';
	$wall_g = '';
	$finish = ''; 
	$obstructions = '';
	$comments = '';
	$has_short_hang = 0; 
	$has_medium_hang = 0; 
	$has_long_hang = 0; 
	$has_tie_rack = 0; 
	$has_belt_rack = 0; 
	$has_valet_rod = 0;
	$has_jewelry_tray = 0;
	$storage_type = 'Master Shared';
	$door_type = '';
	$child_age = '';
	$item_id = 0;
	
}


$ts = time();

$msg = '';

$deid = 0;


if(isset($_GET['item_id'])){
	
	$item_id = $_GET['item_id'];
	
}


$db = $dbCustom->getDbConnect(SITE_DATABASE);

if(isset($_GET['deid'])){
	
	//echo $_GET['deid'];
	
	$deid = $_GET['deid'];

	$stmt = $db->prepare("SELECT email
								,name 
								,phone
								,zip 
								,proposed_finish_date
								,budget_range 
								,ceiling_height
								,base_mold_height
								,door_size
								,short_hang
								,medium_hang 
								,long_hang 
								,drawers 
								,shoes 
								,tie_rack 
								,belt_rack 
								,valet_rod
								,closet_type
								,wall_a
								,wall_b
								,wall_c
								,wall_d
								,wall_e	
								,wall_f	
								,wall_g	
								,finish 
								,obstructions
								,comments
								,storage_type
								,child_age
								,door_type									
								,has_laundry_hamper	
								,has_mirror	
								,has_ironing_board
								,has_shelves															
								,has_short_hang
								,has_medium_hang 
								,has_long_hang 
								,has_tie_rack 
								,has_belt_rack 
								,has_valet_rod
								,has_basket_tall	
								,has_basket_medium	
								,has_basket_short
								,has_jewelry_tray
								,item_id
						  FROM design_email 
						  WHERE design_email_id = ?");

	if(!$stmt->bind_param("i", $deid)){
		
			//echo 'Error '.$db->error;
		
	}else{
			$stmt->execute();
			
			
			$stmt->bind_result(
						$email
						,$name 
						,$phone 
						,$zip
						,$proposed_finish_date
						,$budget_range 
						,$ceiling_height
						,$base_mold_height
						,$door_size
						,$short_hang 
						,$medium_hang 
						,$long_hang 
						,$drawers 
						,$shoes 
						,$tie_rack 
						,$belt_rack 
						,$valet_rod
						,$closet_type
						,$wall_a
						,$wall_b
						,$wall_c
						,$wall_d
						,$wall_e
						,$wall_f
						,$wall_g	
						,$finish 
						,$obstructions
						,$comments
						,$storage_type
						,$child_age
						,$door_type
							,$has_laundry_hamper	
							,$has_mirror	
							,$has_ironing_board	
							,$has_shelves						
							,$has_short_hang
							,$has_medium_hang 
							,$has_long_hang 
							,$has_tie_rack 
							,$has_belt_rack 
							,$has_valet_rod
							,$has_basket_tall	
							,$has_basket_medium	
							,$has_basket_short
							,$has_jewelry_tray
							,$item_id);
				
				if($stmt->fetch()){
					
					$name = stripslashes($name); 
					$name = str_replace('  ',' ',$name);
					$tmp = explode(' ', $name);
					
					$first_name = $tmp[0];
					$last_name = $tmp[1];					
					
					if(trim($short_hang) != '') $has_short_hang = 1;
					if(trim($medium_hang) != '') $has_medium_hang = 1;
					if(trim($long_hang) != '') $has_long_hang = 1;
					if(trim($tie_rack) != '') $has_tie_rack = 1;
					if(trim($belt_rack) != '') $has_belt_rack = 1;
					if(trim($valet_rod) != '') $has_valet_rod = 1;
					
					
					$wall_a = stripslashes($wall_a);
					$wall_b = stripslashes($wall_b);
					$wall_c = stripslashes($wall_c);
					$wall_d = stripslashes($wall_d);
					$wall_e = stripslashes($wall_e);
					$wall_f = stripslashes($wall_f);
					$wall_g = stripslashes($wall_g);
					
					$ceiling_height = stripslashes($ceiling_height);
					$base_mold_height = stripslashes($base_mold_height);
					$door_size = stripslashes($door_size);	
					
					// Hide Personal Data
					$first_name = '';
					$last_name = '';
					$email = '';
					$phone = '';
					$zip = '';
					
				}
				$stmt->close();
				
	}
}


if(isset($_POST['from_design_options_page'])){
		
	$email = trim($_POST['email']);
	$first_name = trim(stripslashes($_POST['first_name']));
	$last_name = trim(stripslashes($_POST['last_name']));
	$phone = trim($_POST['phone']);
	$zip = trim($_POST['zip']);
	$name = $first_name.' '.$last_name; 
	$name = addslashes($name);	

	$stmt = $db->prepare("INSERT INTO design_email
					   (email
						,name
						,zip 
						,phone
						,date_submitted
						,profile_account_id)
						VALUES
						(?,?,?,?,?,?)"); 
						
			//echo 'Error '.$db->error;
								
	if(!$stmt->bind_param("ssssii",
					    $email 
						,$name 
						,$zip 
						,$phone
						,$ts
						,$_SESSION['profile_account_id'])){
		
			//echo 'Error '.$db->error;
		
	}else{
			$stmt->execute();
			$stmt->close();
	}
	
	$deid = $db->insert_id;
		
	$dd = date('d');
	$yyyy = date('Y');
	$mm = date('m');
	$mm = $mm*1;
	$mm++;
	$days_in_month = date('t',strtotime($yyyy.'-'.$mm));
	if($mm > 12) $mm = 1;
	if($mm < 10) $mm = "0".$mm;
	if($mm > $days_in_month){
		$mm = '01';
	}
	$proposed_finish_date = $mm."/".$dd."/".$yyyy."";
	
}

$origin = (isset($_REQUEST['origin'])) ? $_REQUEST['origin'] : 'General Navigation'; 

?>
<script type="text/javascript" src="<?php echo SITEROOT; ?>js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="<?php echo SITEROOT; ?>plupload-2.1.8/js/plupload.full.min.js"></script>
<script type="text/javascript" src="<?php echo SITEROOT; ?>plupload-2.1.8/js/jquery.plupload.queue/jquery.plupload.queue.js"></script>

<script>


$(function() {
	
	$("#storage_type").change(function() {
		var storage_type = $(this).val();
		if(storage_type == "Girl" || storage_type == "Boy"){
			$("#age_box").show();
		}else{
			$("#age_box").hide();
		}
	});

	
	$("#proposed_finish_date").datepicker();
	
	<?php if(strpos($closet_type, 'quare') !== false){ ?>
		set_wall_meas_content("Square");
	<?php }elseif(strpos($closet_type, 'shape_2') !== false){ ?>
		set_wall_meas_content("L-shape_2");			
	<?php }elseif(strpos($closet_type, 'shape_3') !== false){ ?>
		set_wall_meas_content("L-shape_3");			
	<?php }elseif(strpos($closet_type, 'shape_4') !== false){ ?>
		set_wall_meas_content("L-shape_4");			
	<?php }elseif(strpos($closet_type, 'shape_1') !== false){ ?>
		set_wall_meas_content("L-shape_1");			
	<?php }elseif(strpos($closet_type, 'ngle-1') !== false){ ?>
		set_wall_meas_content("Angle-1");			
	<?php }elseif(strpos($closet_type, 'ngle-2') !== false){ ?>
		set_wall_meas_content("Angle-2");			
	<?php }elseif(strpos($closet_type, 'ngle-3') !== false){ ?>
		set_wall_meas_content("Angle-3");			
	<?php }elseif(strpos($closet_type, 'ngle-4') !== false){ ?>
		set_wall_meas_content("Angle-4");			
	<?php }elseif(strpos($closet_type, 'ngle-5') !== false){ ?>
		set_wall_meas_content("Angle-5");			
	<?php }elseif(strpos($closet_type, 'ngle-6') !== false){ ?>     
		set_wall_meas_content("Angle-6");			
	<?php }else{ ?>
		set_wall_meas_content("Reach-in");
	<?php } ?>
			

	$("#door_type").change(function() {
		var door_type = $(this).val();
		var img_name = door_type.replace(/ /g, "_");
		var content = "<img src='<?php echo SITEROOT; ?>images/designform/"+img_name+".png' />";
		$("#door_type_preview").html(content);
	});
			
	$(".design_form_closet_type_img").click(function() {
		de_select_all_closet_types();
		$(this).addClass("design_form_highlight_border");
		var closet_type = $(this).attr("alt");
		$("#input_closet_type").val(closet_type);
		set_wall_meas_content(closet_type)
		$("#wall_a").focus();
	});
	
	$("#phone").mask("(999) 999-9999");
	
	
	$('#first_name').blur(function(){
		
		
		var first_name = jQuery.trim($("#first_name").val());
		if(first_name == ""){
			
			$('#first_name').css({
						'border-width' : '1px'
						,'border-style' : 'solid'
						,'border-color' : '#cf0623'
						});
			$('#first_name_msg').html("<div style='color:#F00; font-size:18px; position:relative; top:-4px;'>Please enter your first name.</div>");
		}else{
			$('#first_name').css({
						'border-width' : '1px'
						,'border-style' : 'solid'
						,'border-color' : '#c2c2c2'
						});
			$('#first_name_msg').html("");	
		}
		
		
	});
	
	$('#last_name').blur(function(){
		
		
		var last_name = jQuery.trim($("#last_name").val());
		if(last_name == ""){
			
			$('#last_name').css({
						'border-width' : '1px'
						,'border-style' : 'solid'
						,'border-color' : '#cf0623'
						});
			$('#last_name_name_msg').html("<div style='color:#F00; font-size:18px; position:relative; top:-4px;'>Please enter your last name.</div>");
		}else{
			$('#last_name').css({
						'border-width' : '1px'
						,'border-style' : 'solid'
						,'border-color' : '#c2c2c2'
						});
			$('#last_name_msg').html("");	
		}
		
		
	});
		
	$('#email').blur(function(){
		var email = jQuery.trim($("#email").val());
		if(!isValidEmail(email)){
			$('#email').css({
						'border-width' : '1px'
						,'border-style' : 'solid'
						,'border-color' : '#cf0623'
						});
			$('#email_msg').html("<div style='color:#F00; font-size:18px; position:relative; top:-4px;'>Please enter a valid email address.</div>");
		}else{
			$('#email').css({
						'border-width' : '1px'
						,'border-style' : 'solid'
						,'border-color' : '#c2c2c2'
						});
			
			$('#email_msg').html("");	
		}
	});
	

	$('#zip').blur(function(){
		var zip = jQuery.trim($("#zip").val());
		
		if((zip.length < 5) || (!isValidZipChars(zip))){
			$('#zip').css({
						'border-width' : '1px'
						,'border-style' : 'solid'
						,'border-color' : '#cf0623'
						});
			$('#zip_msg').html("<div style='color:#F00; font-size:18px; position:relative; top:-4px;'>Please enter a valid zip code.</div>");
		}else{
			$('#zip').css({
						'border-width' : '1px'
						,'border-style' : 'solid'
						,'border-color' : '#c2c2c2'
						});
			$('#zip_msg').html("");	
		}
	});
	
	
	<?php if($has_medium_hang == 1){ ?>
		$('#medium_hang_text_input_block').show();
	<?php }else{ ?>
		$('#medium_hang_text_input_block').hide();
	<?php } ?>
	
	$('#has_medium_hang').change(function() {
		if(this.checked){
			$('#medium_hang_text_input_block').show();
		}else{
			$('#medium_hang_text_input_block').hide();
		}
	});
		
	<?php if($has_long_hang == 1){ ?>
		$('#long_hang_text_input_block').show();
	<?php }else{ ?>
		$('#long_hang_text_input_block').hide();
	<?php } ?>
	
	$('#has_long_hang').change(function() {
		if(this.checked){
			$('#long_hang_text_input_block').show();
		}else{
			$('#long_hang_text_input_block').hide();
		}
	});
	
	
});



function is_iOS() {

  var iDevices = [
    'iPad Simulator',
    'iPhone Simulator',
    'iPod Simulator',
    'iPad',
    'iPhone',
    'iPod'
  ];

  if (!!navigator.platform) {
    while (iDevices.length) {
      if (navigator.platform === iDevices.pop()){ return true; }
    }
  }

  return false;
}


function getEarlyLeaveData(){
	
	var has_shelves = (document.form.has_shelves.checked)? 1 : 0;
	var has_short_hang = (document.form.has_short_hang.checked)? 1 : 0;
	var has_medium_hang = (document.form.has_medium_hang.checked)? 1 : 0;
	var has_long_hang = (document.form.has_long_hang.checked)? 1 : 0;
	var has_belt_rack = (document.form.has_belt_rack.checked)? 1 : 0;
	var has_tie_rack = (document.form.has_tie_rack.checked)? 1 : 0;
	var has_valet_rod = (document.form.has_valet_rod.checked)? 1 : 0;
	var has_laundry_hamper = (document.form.has_laundry_hamper.checked)? 1 : 0; 
	var has_mirror = (document.form.has_mirror.checked)? 1 : 0; 
	var has_ironing_board = (document.form.has_ironing_board.checked)? 1 : 0; 
	var has_basket_tall = (document.form.has_basket_tall.checked)? 1 : 0;
	var has_basket_medium = (document.form.has_basket_medium.checked)? 1 : 0;
	var has_basket_short = (document.form.has_basket_short.checked)? 1 : 0;
	var has_jewelry_tray = (document.form.has_jewelry_tray.checked)? 1 : 0;
	
	var q_str = "";
	
	q_str += "&origin="+$("#origin").val();
	
	q_str += "&first_name="+jQuery.trim($("#first_name").val());
	q_str += "&last_name="+jQuery.trim($("#last_name").val());
	q_str += "&email="+jQuery.trim($("#email").val());
	q_str += "&phone="+jQuery.trim($("#phone").val());
	q_str += "&zip="+jQuery.trim($("#zip").val());
	q_str += "&proposed_finish_date="+jQuery.trim($("#proposed_finish_date").val());
	q_str += "&storage_type="+$("#storage_type").val();
	q_str += "&drawers="+jQuery.trim($("#drawers").val());
	q_str += "&shoes="+jQuery.trim($("#shoes").val());
	
	q_str += "&has_shelves="+has_shelves;
	q_str += "&has_short_hang="+has_short_hang;
	q_str += "&has_medium_hang="+has_medium_hang;
	q_str += "&has_long_hang="+has_long_hang;
	q_str += "&has_belt_rack="+has_belt_rack;
	q_str += "&has_tie_rack="+has_tie_rack;
	q_str += "&has_valet_rod="+has_valet_rod;
	q_str += "&has_laundry_hamper="+has_laundry_hamper; 
	q_str += "&has_mirror="+has_mirror; 
	q_str += "&has_ironing_board="+has_ironing_board; 
	q_str += "&has_basket_tall="+has_basket_tall;
	q_str += "&has_basket_medium="+has_basket_medium;
	q_str += "&has_basket_short="+has_basket_short;
	q_str += "&has_jewelry_tray="+has_jewelry_tray;
		
	q_str += "&child_age="+jQuery.trim($("#child_age").val());
	
	q_str += "&closet_type="+jQuery.trim($("#input_closet_type").val());
	
	alert($("#input_closet_type").val());
	
	
	q_str += "&wall_a="+jQuery.trim($("#wall_a").val());
	q_str += "&wall_b="+jQuery.trim($("#wall_b").val());
	q_str += "&wall_c="+jQuery.trim($("#wall_c").val());
	q_str += "&wall_d="+jQuery.trim($("#wall_d").val());
	q_str += "&wall_e="+jQuery.trim($("#wall_e").val());
	q_str += "&wall_f="+jQuery.trim($("#wall_f").val());
	q_str += "&wall_g="+jQuery.trim($("#wall_g").val());
	
	q_str += "&ceiling_height="+jQuery.trim($("#ceiling_height").val());
	q_str += "&base_mold_height="+jQuery.trim($("#base_mold_height").val());
	q_str += "&door_size="+jQuery.trim($("#door_size").val());
	q_str += "&door_type="+$("#door_type").val();
	
	q_str += "&obstructions="+jQuery.trim($("#obstructions").val());
	
	q_str += "&comments="+jQuery.trim($("#comments").val());
	
	q_str += "&deid="+$("#deid").val();
	
	q_str += "&item_id="+$("#item_id").val();
	
	
	q_str += "&short_hang="+jQuery.trim($("#short_hang").val());
	q_str += "&medium_hang="+jQuery.trim($("#medium_hang").val());
	q_str += "&long_hang="+jQuery.trim($("#long_hang").val());
	
	
	var budget_range = "";	
	if($('input[name="budget_range"]:checked').length > 0) {
		budget_range =  $('input[name="budget_range"]:checked').val();
	}	
	q_str += "&budget_range="+budget_range;
	
	
	var finish = "";
	if($('input[name="finish"]:checked').length > 0) {
		finish =  $('input[name="finish"]:checked').val();
	}
	q_str += "&finish="+finish;

	return q_str;
		
	
}


function validate(){
	
	var first_name = jQuery.trim($("#first_name").val());
	var last_name = jQuery.trim($("#last_name").val());
	var email = jQuery.trim($("#email").val());
	//var phone = jQuery.trim($("#phone").val());
	var zip = jQuery.trim($("#zip").val());
	var proposed_finish_date = jQuery.trim($("#proposed_finish_date").val());
	var lower_msg = "";	
	
	var ret = 1;
	var wall_name = "";
	var wall_letter = "";

	if(first_name == ""){
		$('#first_name').css({
					'border-width' : '1px'
					,'border-style' : 'solid'
					,'border-color' : '#cf0623'
					});
		$('#first_name_msg').html("<div style='color:#F00; font-size:18px; position:relative; top:-4px;'>Please enter your first name.</div>");
		lower_msg += "Please enter your first name";
		
		ret = 0;
	}else{
		$('#first_name').css({
					'border-width' : '1px'
					,'border-style' : 'solid'
					,'border-color' : '#c2c2c2'
					});
		$('#first_name_msg').html("");	
	}
	
	if(last_name == ""){
		$('#last_name').css({
					'border-width' : '1px'
					,'border-style' : 'solid'
					,'border-color' : '#cf0623'
					});
		$('#last_name_msg').html("<div style='color:#F00; font-size:18px; position:relative; top:-4px;'>Please enter your last name.</div>");
		lower_msg += "<br />Please enter your last name";
		
		ret = 0;
	}else{
		$('#last_name').css({
					'border-width' : '1px'
					,'border-style' : 'solid'
					,'border-color' : '#c2c2c2'
					});
		$('#last_name_msg').html("");	
	}
		
	if(!isValidEmail(email)){
		$('#email').css({
					'border-width' : '1px'
					,'border-style' : 'solid'
					,'border-color' : '#cf0623'
					});
		$('#email_msg').html("<div style='color:#F00; font-size:18px; position:relative; top:-4px;'>Please enter a valid email address.</div>");
		lower_msg += "<br /> Please enter a valid email address";
		ret = 0;
	}else{
		$('#email').css({
					'border-width' : '1px'
					,'border-style' : 'solid'
					,'border-color' : '#c2c2c2'
					});
			
		$('#email_msg').html("");	
	}
	

	if((zip.length < 5) || (!isValidZipChars(zip))){
		$('#zip').css({
					'border-width' : '1px'
					,'border-style' : 'solid'
					,'border-color' : '#cf0623'
					});
		$('#zip_msg').html("<div style='color:#F00; font-size:18px; position:relative; top:-4px;'>Please enter a valid zip code.</div>");
		lower_msg += "<br />Please enter a valid zip code."; 
		ret = 0;
	}else{
		$('#zip').css({
					'border-width' : '1px'
					,'border-style' : 'solid'
					,'border-color' : '#c2c2c2'
					});
		$('#zip_msg').html("");	
	}
	
	

	var not_valid_date = 0;
	var date_array = proposed_finish_date.split("/"); 
	if(date_array.length > 2){						
		var d = new Date();
		if(date_array[2] < d.getFullYear()){
			not_valid_date = 1;	
		}	
	}
	

	if(proposed_finish_date == "" || not_valid_date){
		$('#proposed_finish_date').css({
					'border-width' : '1px'
					,'border-style' : 'solid'
					,'border-color' : '#cf0623'
					});
		$('#proposed_finish_date_msg').html("<div style='color:#F00; font-size:18px; position:relative; top:-4px;'>Please enter a proposed finish date.</div>");
		lower_msg += "<br />Please enter a proposed finish date."; 
		ret = 0;
	}else{
		$('#proposed_finish_date').css({
					'border-width' : '1px'
					,'border-style' : 'solid'
					,'border-color' : '#c2c2c2'
					});
		$('#proposed_finish_date_msg').html("");	
	}
	
	$("#walls_preview :input").each(function(){
				
		wall_name = $(this).attr("name");
		wall_letter = wall_name.charAt(5);
		if(jQuery.trim($(this).val()) == ""){
			$(this).css({
						'border-width' : '1px'
						,'border-style' : 'solid'
						,'border-color' : '#cf0623'
					});
				
				lower_msg += "<br />Please enter a measurement for closet wall "+wall_letter; 
				ret = 0;
		}else{
			
			$(this).css({
						'border-width' : '1px'
						,'border-style' : 'solid'
						,'border-color' : '#c2c2c2'
					});
			
		}
		
	})
	
	
	if(lower_msg != ""){
		$("#lower_msg").html(lower_msg);
	}
	
	
	return ret;

}


function de_select_all_closet_types(){
	$('.design_form_closet_type_img').each(function() {
		$(this).removeClass("design_form_highlight_border");
	});
}


function set_wall_meas_content(closet_type){

		var walls_content = "";
				
		if(closet_type.search("each-in") > -1){
			walls_content += "<img width='272' src='<?php echo SITEROOT; ?>images/designform/large-reach-in-c.png' />";					
walls_content += "<input style='position:relative; top:49px; left:-240px; width:34px;' type='text' id='wall_a' name='wall_a' value='a' >";
			walls_content += "<input style='position:relative; top:-78px; left:1px; width:34px;' type='text' id='wall_b' name='wall_b' value='b'>";
			walls_content += "<input style='position:relative; top:-124px; left:70px; width:34px;' type='text' id='wall_c' name='wall_c' value='c'>";
			walls_content += "<input style='position:relative; top:-74px; left:132px; width:34px;' type='text' id='wall_d' name='wall_d' value='d'>";
			walls_content += "<input style='position:relative; top:-28px; left:58px; width:34px;' type='text' id='wall_e' name='wall_e' value='e'>";
		}
				
		if(closet_type.search("quare") > -1){
			walls_content += "<img width='272' src='<?php echo SITEROOT; ?>images/designform/large-square-c.png' />";
			walls_content += "<input style='position:relative; top:84px; left:-224px; width:34px;' type='text' id='wall_a' name='wall_a' value='a' >";
			walls_content += "<input style='position:relative; top:-108px; left:3px; width:34px;' type='text' id='wall_b' name='wall_b' value='b'>";
			walls_content += "<input style='position:relative; top:-196px; left:68px; width:34px;' type='text' id='wall_c' name='wall_c' value='c'>";
			walls_content += "<input style='position:relative; top:-108px; left:131px; width:34px;' type='text' id='wall_d' name='wall_d' value='d'>";
			walls_content += "<input style='position:relative; top:-28px; left:40px; width:34px;' type='text' id='wall_e' name='wall_e' value='e'>";
		}
				
		if(closet_type.search("shape_2") > -1){
			walls_content = "<img width='272' src='<?php echo SITEROOT; ?>images/designform/large-l-shape_2-c.png' />";
			walls_content += "<input style='position:relative; top:84px; left:-228px; width:34px;' type='text' id='wall_a' name='wall_a' value='a' >";
			walls_content += "<input style='position:relative; top:-78px; left:1px; width:34px;' type='text' id='wall_b' name='wall_b' value='b'>";
			walls_content += "<input style='position:relative; top:-123px; left:10px; width:34px;' type='text' id='wall_c' name='wall_c' value='c'>";
			walls_content += "<input style='position:relative; top:-162px; left:20px; width:34px;' type='text' id='wall_d' name='wall_d' value='d'>";
			walls_content += "<input style='position:relative; top:-196px; left:38px; width:34px;' type='text' id='wall_e' name='wall_e' value='e'>";
			walls_content += "<input style='position:relative; top:-108px; left:42px; width:34px;' type='text' id='wall_f' name='wall_f' value='f'>";
			walls_content += "<input style='position:relative; top:-27px; left:-44px; width:34px;' type='text' id='wall_g' name='wall_g' value='g'>";
		}
				
		if(closet_type.search("shape_3") > -1){
					
			walls_content += "<img width='272' src='<?php echo SITEROOT; ?>images/designform/large-l-shape_3-c.png' />";
			walls_content += "<input style='position:relative; top:84px; left:-144px; width:34px;' type='text' id='wall_a' name='wall_a' value='a' >";
			walls_content += "<input style='position:relative; top:-64px; left:111px; width:34px;' type='text' id='wall_b' name='wall_b' value='b'>";
			walls_content += "<input style='position:relative; top:-100px; left:8px; width:34px;' type='text' id='wall_c' name='wall_c' value='c'>";
			walls_content += "<input style='position:relative; top:-149px; left:-92px; width:34px;' type='text' id='wall_d' name='wall_d' value='d'>";
			walls_content += "<input style='position:relative; top:-196px; left:-24px; width:34px;' type='text' id='wall_e' name='wall_e' value='e'>";
			walls_content += "<input style='position:relative; top:-108px; left:40px; width:34px;' type='text' id='wall_f' name='wall_f' value='f'>";
			walls_content += "<input style='position:relative; top:-27px; left:-11px; width:34px;' type='text' id='wall_g' name='wall_g' value='g'>";
		}
				
		if(closet_type.search("shape_4") > -1){
			walls_content += "<img width='272' src='<?php echo SITEROOT; ?>images/designform/large-l-shape_4-c.png' />";
			walls_content += "<input style='position:relative; top:84px; left:-265px; width:34px;' type='text' id='wall_a' name='wall_a' value='a' >";
			walls_content += "<input style='position:relative; top:-110px; left:1px; width:34px;' type='text' id='wall_b' name='wall_b' value='b'>";
			walls_content += "<input style='position:relative; top:-194px; left:68px; width:34px;' type='text' id='wall_c' name='wall_c' value='c'>";
			walls_content += "<input style='position:relative; top:-149px; left:132px; width:34px;' type='text' id='wall_d' name='wall_d' value='d'>";
			walls_content += "<input style='position:relative; top:-100px; left:40px; width:34px;' type='text' id='wall_e' name='wall_e' value='e'>";
			walls_content += "<input style='position:relative; top:-68px; left:-72px; width:34px;' type='text' id='wall_f' name='wall_f' value='f'>";
			walls_content += "<input style='position:relative; top:-27px; left:-133px; width:34px;' type='text' id='wall_g' name='wall_g' value='g'>";
		}

		if(closet_type.search("shape_1") > -1){
			walls_content += "<img width='272' src='<?php echo SITEROOT; ?>images/designform/large-l-shape_1-c.png' />";
			walls_content += "<input style='position:relative; top:84px; left:-226px; width:34px;' type='text' id='wall_a' name='wall_a' value='a' >";
			walls_content += "<input style='position:relative; top:-110px; left:1px; width:34px;' type='text' id='wall_b' name='wall_b' value='b'>";
			walls_content += "<input style='position:relative; top:-194px; left:8px; width:34px;' type='text' id='wall_c' name='wall_c' value='c'>";
			walls_content += "<input style='position:relative; top:-159px; left:18px; width:34px;' type='text' id='wall_d' name='wall_d' value='d'>";
			walls_content += "<input style='position:relative; top:-124px; left:36px; width:34px;' type='text' id='wall_e' name='wall_e' value='e'>";
			walls_content += "<input style='position:relative; top:-78px; left:42px; width:34px;' type='text' id='wall_f' name='wall_f' value='f'>";
			walls_content += "<input style='position:relative; top:-28px; left:-50px; width:34px;' type='text' id='wall_g' name='wall_g' value='g'>";
		}
			
				
		if(closet_type.search("ngle-1") > -1){
			walls_content += "<img width='272' src='<?php echo SITEROOT; ?>images/designform/large-angle-1-c.png' />";
			walls_content += "<input style='position:relative; top:86px; left:-232px; width:34px;' type='text' id='wall_a' name='wall_a' value='a' >";
			walls_content += "<input style='position:relative; top:-110px; left:-1px; width:34px;' type='text' id='wall_b' name='wall_b' value='b'>";
			walls_content += "<input style='position:relative; top:-198px; left:30px; width:34px;' type='text' id='wall_c' name='wall_c' value='c'>";
			walls_content += "<input style='position:relative; top:-159px; left:100px; width:34px;' type='text' id='wall_d' name='wall_d' value='d'>";
			walls_content += "<input style='position:relative; top:-74px; left:90px; width:34px;' type='text' id='wall_e' name='wall_e' value='e'>";
			walls_content += "<input style='position:relative; top:-28px; left:2px; width:34px;' type='text' id='wall_f' name='wall_f' value='f'>";
		}
				
		if(closet_type.search("ngle-2") > -1){
			walls_content += "<img width='272' src='<?php echo SITEROOT; ?>images/designform/large-angle-2-c.png' />";
			walls_content += "<input style='position:relative; top:85px; left:-230px; width:34px;' type='text' id='wall_a' name='wall_a' value='a' >";
			walls_content += "<input style='position:relative; top:-70px; left:-1px; width:34px;' type='text' id='wall_b' name='wall_b' value='b'>";
			walls_content += "<input style='position:relative; top:-154px; left:-10px; width:34px;' type='text' id='wall_c' name='wall_c' value='c'>";
			walls_content += "<input style='position:relative; top:-196px; left:60px; width:34px;' type='text' id='wall_d' name='wall_d' value='d'>";
			walls_content += "<input style='position:relative; top:-104px; left:87px; width:34px;' type='text' id='wall_e' name='wall_e' value='e'>";
			walls_content += "<input style='position:relative; top:-28px; left:-3px; width:34px;' type='text' id='wall_f' name='wall_f' value='f'>";
		}
				
		if(closet_type.search("ngle-3") > -1){
			walls_content += "<img width='272' src='<?php echo SITEROOT; ?>images/designform/large-angle-3-c.png' />";
			walls_content += "<input style='position:relative; top:85px; left:-250px; width:34px;' type='text' id='wall_a' name='wall_a' value='a' >";
			walls_content += "<input style='position:relative; top:-108px; left:-1px; width:34px;' type='text' id='wall_b' name='wall_b' value='b'>";
			walls_content += "<input style='position:relative; top:-196px; left:56px; width:34px;' type='text' id='wall_c' name='wall_c' value='c'>";
			walls_content += "<input style='position:relative; top:-146px; left:134px; width:34px;' type='text' id='wall_d' name='wall_d' value='d'>";
			walls_content += "<input style='position:relative; top:-68px; left:56px; width:34px;' type='text' id='wall_e' name='wall_e' value='e'>";
			walls_content += "<input style='position:relative; top:-28px; left:-58px; width:34px;' type='text' id='wall_f' name='wall_f' value='f'>";
		}
				
		if(closet_type.search("ngle-4") > -1){
			walls_content += "<img width='272' src='<?php echo SITEROOT; ?>images/designform/large-angle-4-c.png' />";
			walls_content += "<input style='position:relative; top:84px; left:-172px; width:34px;' type='text' id='wall_a' name='wall_a' value='a' >";
			walls_content += "<input style='position:relative; top:-66px; left:41px; width:34px;' type='text' id='wall_b' name='wall_b' value='b'>";
			walls_content += "<input style='position:relative; top:-152px; left:-46px; width:34px;' type='text' id='wall_c' name='wall_c' value='c'>";
			walls_content += "<input style='position:relative; top:-194px; left:22px; width:34px;' type='text' id='wall_d' name='wall_d' value='d'>";
			walls_content += "<input style='position:relative; top:-108px; left:86px; width:34px;' type='text' id='wall_e' name='wall_e' value='e'>";
			walls_content += "<input style='position:relative; top:-28px; left:16px; width:34px;' type='text' id='wall_f' name='wall_f' value='f'>";
		}
				
		if(closet_type.search("ngle-5") > -1){
			walls_content += "<img width='272' src='<?php echo SITEROOT; ?>images/designform/large-angle-5-c.png' />";
			walls_content += "<input style='position:relative; top:72px; left:-100px; width:34px;' type='text' id='wall_a' name='wall_a' value='a' >";
			walls_content += "<input style='position:relative; top:-30px; left:76px; width:34px;' type='text' id='wall_b' name='wall_b' value='b' >";
			walls_content += "<input style='position:relative; top:-112px; left:-46px; width:34px;' type='text' id='wall_c' name='wall_c' value='c'>";
			walls_content += "<input style='position:relative; top:-194px; left:22px; width:34px;' type='text' id='wall_d' name='wall_d' value='d'>";
			walls_content += "<input style='position:relative; top:-148px; left:88px; width:34px;' type='text' id='wall_e' name='wall_e' value='e'>";
			walls_content += "<input style='position:relative; top:-88px; left:42px; width:34px;' type='text' id='wall_f' name='wall_f' value='f'>";
		}
				
		if(closet_type.search("ngle-6") > -1){
			walls_content += "<img width='272' src='<?php echo SITEROOT; ?>images/designform/large-angle-6-c.png' />";
			walls_content += "<input style='position:relative; top:14px; left:-258px; width:34px;' type='text' id='wall_a' name='wall_a' value='a' >";
			walls_content += "<input style='position:relative; top:-150px; left:-1px; width:34px;' type='text' id='wall_b' name='wall_b' value='b' >";
			walls_content += "<input style='position:relative; top:-196px; left:68px; width:34px;' type='text' id='wall_c' name='wall_c' value='c'>";
			walls_content += "<input style='position:relative; top:-114px; left:132px; width:34px;' type='text' id='wall_d' name='wall_d' value='d'>";
			walls_content += "<input style='position:relative; top:-28px; left:14px; width:34px;' type='text' id='wall_e' name='wall_e' value='e'>";
			walls_content += "<input style='position:relative; top:-40px; left:-122px; width:34px;' type='text' id='wall_f' name='wall_f' value='f'>";
		}
				
				
		$("#walls_preview").html(walls_content);
		
}


function isValidZipChars(zip){
	var ret = 1;
	var x = 0;
	var i;		
	for (i = 0; i < zip.length; i++) { 
		x = x + zip.charAt(i);
		if(i == 2 && (x == 0 || x == 000)){
			ret = 0;
			break;	
		}
	}
	return ret;
}
					
</script>

<div class="span12">

   
    <h1 class="title_blue_large">We Design</h1>
    
	<div style="font-size:12px;">
        If possible, please fill out the following details below. If you don't have all the information now, you can finish it later. 
        For your convenience, we will send you an email reminder with a link to this form. 
	</div>
	
	
	<form name="form" action="<?php echo SITEROOT.'/email-design-confirm.html?from=design-request-form'; ?>" method="post" enctype="multipart/form-data">
    
    	 <input type="hidden" name="from_design_form_page" value="1" />
                        
         <input id="deid" type="hidden" name="deid" value="<?php echo $deid; ?>" />
         
         <input id="item_id" type="hidden" name="item_id" value="<?php echo $item_id; ?>" />
         
         
         <input id="origin" type="hidden" name="origin" value="<?php echo $origin; ?>" />
         

		<div class="design_form_spacer">&nbsp;</div>
                    	
        <div class="design_form_large_box_left"  style="padding-right:66px!important;">
                        
            <label class="label_left_small" for="first_name">First Name:</label>
            <input type="text"  id="first_name" name="first_name" value="<?php echo $first_name; ?>" placeholder="First Name" class="form_input_small" />
                                            
            <div style="clear:both;" id="first_name_msg"></div>
                                            
            <label class="label_left_small" for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo $last_name; ?>" placeholder="Last Name" class="form_input_small" />
                                            
            <div style="clear:both;" id="last_name_msg"></div>
                                            
            <label class="label_left_small" for="email">Email Address:</label>
            <input type="text" id="email" name="email" value="<?php echo $email; ?>" placeholder="Email Address" class="form_input_small" />
                                        
            <div style="clear:both;" id="email_msg"></div>
                                            
            <label class="label_left_small" for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>" placeholder="Phone Number" class="form_input_small" />
                                        
            <div style="clear:both;"></div>
            
            <label class="label_left_small" for="phone">Zip Code:</label>
            <input type="text" id="zip" name="zip" value="<?php echo $zip; ?>" placeholder="Zip Code" class="form_input_small" />
                                        
            <div style="clear:both;" id="zip_msg"></div>
		</div>
        <div class="design_form_large_box">
        	<label class="label_left" for="storage_type">Storage Type:</label>
            <select id="storage_type" name="storage_type" style="width:135px; float:left; margin-left:10px; height:34px; border-radius:4px; margin-bottom:14px;">
                <option value="Master His" <?php if($storage_type == 'Master His') echo 'selected'; ?>>Master His</option>
                <option value="Master Hers" <?php if($storage_type == 'Master Hers') echo 'selected'; ?>>Master Hers</option>
                <option value="Master Shared" <?php if($storage_type == 'Master Shared') echo 'selected'; ?>>Master Shared</option>
                <option value="Pantry" <?php if($storage_type == 'Pantry') echo 'selected'; ?>>Pantry</option>
                <option value="Guest" <?php if($storage_type == 'Pantry') echo 'selected'; ?>>Guest</option>
                <option value="Nursery" <?php if($storage_type == 'Nursery') echo 'selected'; ?>>Nursery</option>
                <option value="Boy" <?php if($storage_type == 'Boy') echo 'selected'; ?>>Boy</option>
                <option value="Girl" <?php if($storage_type == 'Girl') echo 'selected'; ?>>Girl</option>
                <option value="Other" <?php if($storage_type == 'Other') echo 'selected'; ?>>Other</option>
            </select>
            
            <div id="age_box" style="display:none;">
            	<label class="label_left" for="age">Age:</label>
                <input type="text" id="child_age" name="child_age" 
                style="width:126px; float:left; margin-left:10px; height:30px; border-radius:4px; margin-bottom:14px;" value="<?php echo $child_age; ?>">
            </div>
            
            <div style="clear:both;"></div> 
            
            <label class="label_left" for="proposed_finish_date">Proposed Finshed Date:</label>
            <input type="text" id="proposed_finish_date" name="proposed_finish_date" value="<?php echo $proposed_finish_date; ?>" 
            placeholder="mm/dd/yy"  style="width:126px; float:left; margin-left:10px; height:34px; border-radius:4px; margin-bottom:14px;">
             
            <div id="proposed_finish_date_msg" style="clear:both;"></div>
           
        </div> 
 
        <div class="design_form_large_box">
        
            <div style="padding-left:100px;">
            
                <div class="design_form_heading" style="margin-left:10px;">Budget</div>
                <br />
                                            
                <div class="design_form_rc">
                <input type="radio" class="input_budget_range" name="budget_range" value="$1,500 to $2,500" <?php if(strpos($budget_range, "1,500") !== false){ echo "checked"; } ?>/> 
                </div>
                <div class="design_form_rc_label">
                 $1,500 to $2,500
                </div>
                <div style="clear:both; margin-bottom:6px;"></div>
                
                <div class="design_form_rc">
                <input type="radio" class="input_budget_range"  name="budget_range" value="$2,500 to $3,500" <?php if(strpos($budget_range, "3,500") !== false){ echo "checked"; } ?>/> 
                </div>
                <div class="design_form_rc_label">
                 $2,500 - $3,500
                </div>
                <div style="clear:both; margin-bottom:6px;"></div>
                
                <div class="design_form_rc">
                <input type="radio" class="input_budget_range" name="budget_range" value="$3,500 and up" <?php if(strpos($budget_range, "up") !== false){ echo "checked"; } ?>/> 
                </div>
                <div class="design_form_rc_label">
                $3,500 +
                </div>
                <div style="clear:both;"></div>
                
			</div>
        </div>
        <input id="input_closet_type" type="hidden" name="closet_type" value="<?php echo $closet_type; ?>"/>
        
        <div style="clear:both"></div>
        <div style="margin-bottom:10px;">
        From the selection below, choose the closet type and shape that most closely matches the appearance of your closet.
        </div>
       	<div style="width:240px; text-align:center; font-size:18px; border-bottom-style:solid; border-bottom-width:thin;">Reach-In</div>
             <div class="design_form_closet_type">
             	<img class="design_form_closet_type_img" src="<?php echo SITEROOT; ?>images/designform/reach-in.png" alt="Reach-in" />
			</div>
        <br />
        <div style="clear:both;"></div>
        
      	<div  style="margin-right:20px; text-align:center; font-size:18px; border-bottom-style:solid; border-bottom-width:thin;">Walk-Ins</div>
        
        <div style="width:100%;">
                
                <div class="design_form_closet_type">
                    <img class="design_form_closet_type_img" src="<?php echo SITEROOT; ?>images/designform/square.jpg" alt="Square"  />
                </div>
                
                <div class="design_form_closet_type">
                    <img class="design_form_closet_type_img" src="<?php echo SITEROOT; ?>images/designform/l-shape_2.jpg" alt="L-shape_2"  />
                </div>
                
                <div class="design_form_closet_type">
                    <img class="design_form_closet_type_img" src="<?php echo SITEROOT; ?>images/designform/l-shape_3.jpg" alt="L-shape_3"  />
                </div>
                
                <div class="design_form_closet_type">
                    <img class="design_form_closet_type_img" src="<?php echo SITEROOT; ?>images/designform/l-shape_4.jpg" alt="L-shape_4"  />
                </div>
                
                <div class="design_form_closet_type">
                    <img class="design_form_closet_type_img" src="<?php echo SITEROOT; ?>images/designform/l-shape_1.jpg" alt="L-shape_1"  />
                </div>
                
                <div class="design_form_closet_type">
                    <img class="design_form_closet_type_img" src="<?php echo SITEROOT; ?>images/designform/angle-1.jpg" alt="Angle-1"  />
                </div>
                
                <div class="design_form_closet_type">
                    <img class="design_form_closet_type_img" src="<?php echo SITEROOT; ?>images/designform/angle-2.jpg" alt="Angle-2"  />
                </div>
                
                <div class="design_form_closet_type">
                    <img class="design_form_closet_type_img" src="<?php echo SITEROOT; ?>images/designform/angle-3.jpg" alt="Angle-3"  />
                </div>
                
                <div class="design_form_closet_type">
                    <img class="design_form_closet_type_img" src="<?php echo SITEROOT; ?>images/designform/angle-4.jpg" alt="Angle-4"  />
                </div>
                
                <div class="design_form_closet_type">
                    <img class="design_form_closet_type_img" src="<?php echo SITEROOT; ?>images/designform/angle-5.jpg" alt="Angle-5"  />
                </div>

                <div class="design_form_closet_type">
                    <img class="design_form_closet_type_img" src="<?php echo SITEROOT; ?>images/designform/angle-6.jpg" alt="Angle-6"  />
                </div>
            	<div style="clear:both;"></div>
        </div>
        <div style="clear:both"></div>
        <div style="margin-bottom:16px; max-width:320px;">
        Refer to the closet diagram below. Measure each wall and enter each measurement (inches only) in the appropriate box.
        </div>
        <div id="walls_preview" style="float:left; width:320px;">

        
        </div>

        <div class="design_form_large_box" style="padding-right:16px;">
            <label class="label_left">Ceiling Height</label>
           	<input class="form_input_xx_small" type="text" id="ceiling_height" name="ceiling_height" value="<?php echo $ceiling_height; ?>"/>
            <div style="clear:both; margin-bottom:8px;"></div>
           
            <label class="label_left">Base Mold Height</label>
           	<input class="form_input_xx_small" type="text" id="base_mold_height" name="base_mold_height" value="<?php echo $base_mold_height; ?>"/>
           	<div style="clear:both; margin-bottom:8px;"></div>
            <div style="position:relative; top:-16px;" class="label_left">None</div>
           	<input style="position:relative; top:-16px; margin-left:10px;" id="input_no_base_mold" type="checkbox" name="no_base_mold" value="1"/>
            
            <div style="clear:both;"></div>
           
            <div style="float:left; margin-left:36px; ">Door Type: 
			<span style="color:#cf0623;">(from the outside)</span></div>
            <div style="clear:both;"></div>
            
            <select id="door_type" name="door_type" style="width:180px; float:left; margin-left:36px; height:34px; border-radius:4px;">
            <option value="Swing Inward Left" <?php if($door_type == 'Swing Inward Left') echo 'selected'; ?>>Swing Inward Left</option>
            <option value="Swing Inward Right" <?php if($door_type == 'Swing Inward Right') echo 'selected'; ?>>Swing Inward Right</option>
            <option value="Swing Outward Left" <?php if($door_type == 'Swing Outward Left') echo 'selected'; ?>>Swing Outward Left</option>
            <option value="Swing Outward Right" <?php if($door_type == 'Swing Outward Right') echo 'selected'; ?>>Swing Outward Right</option>
            <option value="Sliding" <?php if($door_type == 'Sliding') echo 'selected'; ?>>Sliding</option>
            <option value="Folding" <?php if($door_type == 'Folding') echo 'selected'; ?>>Folding</option>
            <option value="Pocket Left" <?php if($door_type == 'Pocket Left') echo 'selected'; ?>>Pocket Left</option>
            <option value="Pocket Right" <?php if($door_type == 'Pocket Right') echo 'selected'; ?>>Pocket Right</option>
              <option value="Double Doors Swing In" <?php if($door_type == 'Double Doors Swing In') echo 'selected'; ?>>Double Doors Swing In</option>
			<option value="Double Doors Swing Out" <?php if($door_type == 'Double Doors Swing Out') echo 'selected'; ?>>Double Doors Swing Out</option>
			<option value="Barn Doors" <?php if($door_type == 'Barn Doors') echo 'selected'; ?>>Barn Doors</option>
            <option value="No Door" <?php if($door_type == 'No Door') echo 'selected'; ?>>No Door</option>
            </select>
            <div style="clear:both;"></div>
            <div id="door_type_preview" style="float:left; margin-left:36px; min-width:60px; height:60px;"></div>
            <div style="clear:both;"></div>
        </div>
		<div class="design_form_large_box">
            <div style="padding-left:1px; padding-top:1px;">
                <div class="design_form_heading">Describe all obstructions on your closet walls</div>
                <div style="font-size:12px;">Such as outlets, windows, ect. <br /> 
                <span style="color:#cf0623; font-weight:bold;">Please include their size and location.</span></div>
                <textarea class="design_form_textarea" id="obstructions" name="obstructions" ><?php echo $obstructions; ?></textarea>
            </div>
        </div>
        
		<div style="clear:both"></div>
        
        <div style="margin-bottom:10px;">
        Below please indicate what items and how many of them your closet needs.
        </div>
		<div class="design_form_quarter_box">
            <div class="design_form_heading" style="margin-left:10px;">Items Needed</div>
            <br />
            <br />                          
            <div class="design_form_rc">
            <input type="checkbox"  id="has_shelves" name="has_shelves" <?php if($has_shelves == 1){ echo "checked"; } ?>/> 
            </div>
            <div class="design_form_rc_label">
            Shelves
            </div>        
            <div style="clear:both; margin-bottom:22px;"></div>
            <input class="form_input_xx_small" type="text" id="drawers" name="drawers" value="<?php echo $drawers; ?>" /> 
            <div class="design_form_rc_label">
            How Many Drawers
            </div>
            <div style="clear:both; margin-bottom:22px;"></div>
                                        
            <input class="form_input_xx_small" type="text" id="shoes" name="shoes" value="<?php echo $shoes; ?> " /> 
            <div class="design_form_rc_label">
            How Many Shoes
            </div>
            <div style="clear:both;"></div>
                                    
        </div>
         <div class="design_form_quarter_box">
                                
            <div class="design_form_heading" style="margin-left:10px;">Hanger Needs</div>
            <br />
			<div class="design_form_rc_label" style="width:140px;">
            Double Hang
            </div>
            <div class="design_form_rc">
            <input type="checkbox" id="has_short_hang" name="has_short_hang" <?php if($has_short_hang == 1){ echo "checked"; } ?>/> 
            </div>
            <div style="clear:both; margin-bottom:12px;"></div>

            <div class="design_form_rc_label" style="width:140px;">
            Medium Hang
            </div>
            <div class="design_form_rc">
            <input type="checkbox" id="has_medium_hang" name="has_medium_hang" <?php if($has_medium_hang == 1){ echo "checked"; } ?>/> 
            </div>
            
        	<div style="clear:both; margin-bottom:12px;"></div>
            
            <div id="medium_hang_text_input_block">    
                <div class="design_form_rc_label" style="width:130px;">
                    Please specify width in inches
                </div>
                <div class="design_form_rc">
                    <input class="form_input_xx_small" type="text" id="medium_hang" name="medium_hang" value="<?php echo $medium_hang; ?>" />                        
                </div>     
            </div>
            <div style="clear:both; margin-bottom:12px;"></div>
            <div class="design_form_rc_label" style="width:140px;">
            Long Hang
            </div>
            <div class="design_form_rc">
            <input type="checkbox" id="has_long_hang" name="has_long_hang" <?php if($has_long_hang == 1){ echo "checked"; } ?>/> 
            </div>
            <div style="clear:both; margin-bottom:12px;"></div>
            <div id="long_hang_text_input_block">    
                <div class="design_form_rc_label" style="width:130px;">
                    Please specify width in inches
                </div>
                <div class="design_form_rc">
                    <input class="form_input_xx_small" type="text" id="long_hang" name="long_hang" value="<?php echo $long_hang; ?>" />                        
                </div>
            </div>
		</div>
        <div class="design_form_quarter_box" style="margin-bottom:40px;">
            <div class="design_form_heading" style="margin-left:10px;">
            Accessories
            </div>
            <br />
            <div class="design_form_rc">
            <input type="checkbox" id="has_belt_rack" name="has_belt_rack" <?php if($has_belt_rack == 1){ echo "checked"; } ?>/>
            </div>
            <div class="design_form_rc_label">
            Belt Racks
            </div>
            <div style="clear:both; margin-bottom:6px;"></div>
            <div class="design_form_rc">
            <input type="checkbox" id="has_tie_rack" name="has_tie_rack" <?php if($has_tie_rack == 1){ echo "checked"; } ?>/> 
            </div>
            <div class="design_form_rc_label">
            Tie Racks
            </div>
            <div style="clear:both; margin-bottom:6px;"></div>
            <div class="design_form_rc">
            <input type="checkbox" id="has_valet_rod" name="has_valet_rod" <?php if($has_valet_rod == 1){ echo "checked"; } ?>/>
            </div>
            <div class="design_form_rc_label">
            Valet Rods
            </div>
            <div style="clear:both; margin-bottom:6px;"></div>
            <div class="design_form_rc">
            <input type="checkbox" id="has_laundry_hamper" name="has_laundry_hamper" <?php if($has_laundry_hamper == 1) echo 'checked'; ?>/> 
            </div>
            <div class="design_form_rc_label">
            Hamper
            </div>
            <div style="clear:both; margin-bottom:6px;"></div>
            <div class="design_form_rc">
            <input type="checkbox" id="has_mirror" name="has_mirror" <?php if($has_mirror == 1) echo 'checked'; ?>/> 
            </div>
            <div class="design_form_rc_label">
            Mirror
            </div>
            <div style="clear:both; margin-bottom:6px;"></div>
            <div class="design_form_rc">
            <input type="checkbox" id="has_ironing_board" name="has_ironing_board" <?php if($has_ironing_board == 1) echo 'checked'; ?> /> 
            </div>
            <div class="design_form_rc_label">
            Ironing Board
            </div>
			<div style="clear:both; margin-bottom:6px;"></div>
            <div class="design_form_rc">
            <input type="checkbox" id="has_jewelry_tray" name="has_jewelry_tray" <?php if($has_jewelry_tray == 1) echo 'checked'; ?> /> 
            </div>
            <div class="design_form_rc_label">
            Jewelry Tray
            </div>
            <div style="clear:both;"></div>
        </div>
        <div class="design_form_quarter_box">
            <div class="design_form_heading" style="margin-left:10px;">
            Baskets
            </div>
            <br />
            <div class="design_form_rc">
            <input type="checkbox" id="has_basket_short" name="has_basket_short" <?php if($has_basket_short == 1) echo 'checked'; ?>/> 
            </div>
            <div class="design_form_rc_label">
            Short 6"
            </div>
            <div style="clear:both; margin-bottom:6px;"></div>                            
            <div class="design_form_rc">
            <input type="checkbox"  id="has_basket_medium" name="has_basket_medium" <?php if($has_basket_medium == 1) echo 'checked'; ?>/> 
            </div>
            <div class="design_form_rc_label">
            Medium 11"
            </div>
            <div style="clear:both; margin-bottom:6px;"></div>
            <div class="design_form_rc">
            <input type="checkbox" id="has_basket_tall" name="has_basket_tall" <?php if($has_basket_tall == 1) echo 'checked'; ?>/> 
            </div>
            <div class="design_form_rc_label">
            Tall 18"
            </div>
            <div style="clear:both;"></div>   
        </div>
        <div style="clear:both"></div>
        <div class="design_form_heading">
        Color Groups
        <div style="font-size:12px!important;">(Select one finish from the color groups below)</div>                
        </div>
        <hr />
        <div style="font-size:16px; margin-left:10px;">White</div>        
		<br />
			<div class="finish_container">
                <div style="float:left;">
                	<img src="<?php echo SITEROOT; ?>images/finishes/finish_white.jpg" alt="Closet Finish"/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                <input type="radio" class="input_finish" name="finish" value="White" <?php if($finish == 'White'){ echo "checked"; } ?> />
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                Oxford White
                </div>
            </div>
			<div style="clear:both;"></div>
			<br />
			<div style="font-size:16px; margin-left:10px;">Level 1</div>        
			<br />
            <div class="finish_container">
                <div style="float:left;">
                <img src="<?php echo SITEROOT; ?>images/finishes/finish_antique_white.jpg" alt="Closet Finish"/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                <input type="radio"  class="input_finish"  name="finish" value="Antique White" <?php if($finish == 'Antique White'){ echo "checked"; } ?> />
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                Antique White
                </div>
            </div>
            <div class="finish_container">
                <div style="float:left;">
                <img src="<?php echo SITEROOT; ?>images/finishes/finish_almond.jpg" alt="Closet Finish"/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                <input type="radio"  class="input_finish"  name="finish" value="Almond" <?php if($finish == 'Almond'){ echo "checked"; } ?>/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                Almond
                </div>
            </div>
			<div style="clear:both;"></div>
			<br />
			<div style="font-size:16px; margin-left:10px;">Level 2</div>        
			<br />
			<div class="finish_container">
                <div style="float:left;">
                <img src="<?php echo SITEROOT; ?>images/finishes/custom-grey.jpg" alt="Closet Finish"/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                <input type="radio"  class="input_finish"  name="finish" value="Custom Grey" <?php if($finish == 'Custom Grey'){ echo "checked"; } ?>/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                Custom Grey
                </div>
            </div>
			<div class="finish_container">
                <div style="float:left;">
                <img src="<?php echo SITEROOT; ?>images/finishes/negotiating-in-geneva.jpg" alt="Closet Finish"/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                <input type="radio"  class="input_finish"  name="finish" value="Negotiating In Geneva" <?php if($finish == 'Negotiating In Geneva'){ echo "checked"; } ?> />
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                Negotiating In Geneva
                </div>
            </div>  
            <div class="finish_container">
                <div style="float:left;">
                <img src="<?php echo SITEROOT; ?>images/finishes/hardrock-maple.jpg" alt="Closet Finish"/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                <input type="radio"  class="input_finish"  name="finish" value="Hardrock Maple" <?php if($finish == 'Hardrock Maple'){ echo "checked"; } ?>/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                Hardrock Maple
                </div>
            </div>
			<div class="finish_container">
                <div style="float:left;">
                <img src="<?php echo SITEROOT; ?>images/finishes/backwoods-sycamore.jpg" alt="Closet Finish"/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                <input type="radio"  class="input_finish"  name="finish" value="Backwoods Sycamore" <?php if($finish == 'Backwoods Sycamore'){ echo "checked"; } ?>/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                Backwoods Sycamore
                </div>
            </div>	
            <div class="finish_container">
                <div style="float:left;">
                <img src="<?php echo SITEROOT; ?>images/finishes/sunset-cherry.jpg" alt="Closet Finish"/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                <input type="radio"  class="input_finish"  name="finish" value="Sunset Cherry" <?php if($finish == 'Sunset Cherry'){ echo "checked"; } ?>/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                Sunset Cherry
                </div>
            </div>
			<div class="finish_container">            
                <div style="float:left;">
                <img src="<?php echo SITEROOT; ?>images/finishes/closets-to-go-rustik-cherry.jpg" alt="Closet Finish"/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                <input type="radio"  class="input_finish"  name="finish" value="Alabama Cherry" <?php if($finish == 'Alabama Cherry'){ echo "checked"; } ?>/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                Alabama Cherry
                </div>
            </div>
			<div class="finish_container">
                <div style="float:left;">
                <img src="<?php echo SITEROOT; ?>images/finishes/rustic-alder.jpg" alt="Closet Finish"/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                <input type="radio"  class="input_finish"  name="finish" value="Rustic Alder" <?php if($finish == 'Rustic Alder'){ echo "checked"; } ?>/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                Rustic Alder
                </div>
            </div>
            <div class="finish_container">
                <div style="float:left;">
                <img src="<?php echo SITEROOT; ?>images/finishes/american-black-walnut.jpg" alt="Closet Finish"/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                <input type="radio"  class="input_finish"  name="finish" value="American Black Walnut" <?php if($finish == 'American Black Walnut'){ echo "checked"; } ?>/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                American Black Walnut
                </div>
            </div>
            <div class="finish_container">
                <div style="float:left;">
                <img src="<?php echo SITEROOT; ?>images/finishes/finish_chocolate_pear.jpg" alt="Closet Finish"/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                <input type="radio"  class="input_finish"  name="finish" value="Chocolate Apple" <?php if($finish == 'Chocolate Apple'){ echo "checked"; } ?>/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                Chocolate Apple
                </div>
            </div>
            <div class="finish_container">
                <div style="float:left;">
                <img src="<?php echo SITEROOT; ?>images/finishes/windsor-mahogany.jpg" alt="Closet Finish"/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                <input type="radio"  class="input_finish"  name="finish" value="Windsor Mahogany" <?php if($finish == 'Windsor Mahogany'){ echo "checked"; } ?> />
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                Windsor Mahogany
                </div>
            </div>
			<div class="finish_container">        
                <div style="float:left;">
                <img src="<?php echo SITEROOT; ?>images/finishes/african-mahogany.jpg" alt="Closet Finish"/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                <input type="radio"  class="input_finish"  name="finish" value="African Mahogany" <?php if($finish == 'African Mahogany'){ echo "checked"; } ?>/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                African Mahogany
                </div>
            </div>
			<div class="finish_container">   
                <div style="float:left;">
                <img src="<?php echo SITEROOT; ?>images/finishes/black.jpg" alt="Closet Finish"/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                <input type="radio"  class="input_finish"  name="finish" value="Black" <?php if($finish == 'Black'){ echo "checked"; } ?>/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                Black
                </div>
            </div>
			<div style="clear:both;"></div>
			<br />

			<div style="font-size:16px; margin-left:10px;">Level 3</div>        
			<br />
			<div class="finish_container">
                <div style="float:left;">
                <img src="<?php echo SITEROOT; ?>images/finishes/n-diva.jpg" alt="Closet Finish"/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                <input type="radio"  class="input_finish"  name="finish" value="Diva" <?php if($finish == 'Diva'){ echo "checked"; } ?> />
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                Diva
                </div>
            </div>
            <div class="finish_container">
                <div style="float:left;">
                <img src="<?php echo SITEROOT; ?>images/finishes/n-vanilla-stix.jpg" alt="Closet Finish"/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                <input type="radio"  class="input_finish"  name="finish" value="Vanilla Stix" <?php if($finish == 'Vanilla Stix'){ echo "checked"; } ?> />
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                Vanilla Stix
                </div>
            </div>
            <div class="finish_container">
                <div style="float:left;">
                <img src="<?php echo SITEROOT; ?>images/finishes/n-aria.jpg" alt="Closet Finish"/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                <input type="radio"  class="input_finish"  name="finish" value="Aria" <?php if($finish == 'Aria'){ echo "checked"; } ?>/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                Aria
                </div>
            </div>
            <div class="finish_container">
                <div style="float:left;">
                <img src="<?php echo SITEROOT; ?>images/finishes/n-sandalwood.jpg" alt="Closet Finish"/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                <input type="radio"  class="input_finish"  name="finish" value="Sandalwood" <?php if($finish == 'Sandalwood'){ echo "checked"; } ?>/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                Sandalwood
                </div>
            </div>   
            <div class="finish_container">
                <div style="float:left;">
                <img src="<?php echo SITEROOT; ?>images/finishes/n-stromboli.jpg" alt="Closet Finish"/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                <input type="radio"  class="input_finish"  name="finish" value="Stromboli" <?php if($finish == 'Stromboli'){ echo "checked"; } ?> />
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                Stromboli
                </div>
            </div>
            <div class="finish_container">
                <div style="float:left;">
                <img src="<?php echo SITEROOT; ?>images/finishes/n-driftwood.jpg" alt="Closet Finish"/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                <input type="radio"  class="input_finish"  name="finish" value="Driftwood" <?php if($finish == 'Driftwood'){ echo "checked"; } ?>/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                Driftwood
                </div>
            </div>      
			<div class="finish_container">
                <div style="float:left;">
                <img src="<?php echo SITEROOT; ?>images/finishes/n-pewter-pine.jpg" alt="Closet Finish"/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                <input type="radio"  class="input_finish"  name="finish" value="Pewter Pine" <?php if($finish == 'Pewter Pine'){ echo "checked"; } ?> />
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                Pewter Pine
                </div>
			</div>
            <div class="finish_container">
                <div style="float:left;">
                <img src="<?php echo SITEROOT; ?>images/finishes/n-zambukka.jpg" alt="Closet Finish"/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                <input type="radio"  class="input_finish"  name="finish" value="Zambukka" <?php if($finish == 'Zambukka'){ echo "checked"; } ?>/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                Zambukka
                </div>
            </div>      
			<div class="finish_container">
                <div style="float:left;">
                <img src="<?php echo SITEROOT; ?>images/finishes/n-libretti.jpg" alt="Closet Finish"/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                <input type="radio"  class="input_finish"  name="finish" value="Libretti" <?php if($finish == 'Libretti'){ echo "checked"; } ?>/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                Libretti
                </div> 
            </div>  
            <div class="finish_container">
                <div style="float:left;">
                <img src="<?php echo SITEROOT; ?>images/finishes/n-mochatini.jpg" alt="Closet Finish"/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                <input type="radio"  class="input_finish"  name="finish" value="Mochatini" <?php if($finish == 'Mochatini'){ echo "checked"; } ?>/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                Mochatini
                </div> 
            </div>  
            <div class="finish_container">
                <div style="float:left;">
                <img src="<?php echo SITEROOT; ?>images/finishes/n-linear-ash.jpg" alt="Closet Finish"/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                <input type="radio"  class="input_finish"  name="finish" value="Linear Ash" <?php if($finish == 'Linear Ash'){ echo "checked"; } ?>/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                Linear Ash
                </div>
            </div>
			<div class="finish_container">			
                <div style="float:left;">
                <img src="<?php echo SITEROOT; ?>images/finishes/n-verismo.jpg" alt="Closet Finish"/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                <input type="radio"  class="input_finish"  name="finish" value="Verismo" <?php if($finish == 'Verismo'){ echo "checked"; } ?>/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                Verismo
                </div>
            </div>
			<div class="finish_container">            
                <div style="float:left;">
                <img src="<?php echo SITEROOT; ?>images/finishes/n-queenston-oak.jpg" alt="Closet Finish"/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                <input type="radio"  class="input_finish"  name="finish" value="Queenston Oak" <?php if($finish == 'Queenston Oak'){ echo "checked"; } ?>/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                Queenston Oak
                </div>
            </div>      
            <div class="finish_container">
                <div style="float:left;">
                <img src="<?php echo SITEROOT; ?>images/finishes/finish_other.jpg" alt="Closet Finish"/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                <input type="radio"  class="input_finish"  name="finish" value="Other" <?php if($finish == 'Other'){ echo "checked"; } ?>/>
                </div>
                <div style="float:left; margin-left:6px; margin-top:6px;">
                Other
                </div>
            </div>
			<div style="clear:both;"></div>
			<br />


		<div class="design_form_heading">Additional Information or Comments</div>
        <textarea class="design_form_textarea_wide" id="comments"  name="comments" ><?php echo $comments; ?></textarea>
	</form>


	<div class="design_form_spacer">&nbsp;</div>
	<div class="design_form_spacer">&nbsp;</div>


	<div id="file_uploads_container">
        <h2>Attach an Image</h2>
        <label>Attach a drawing of your closet layout. Attach up to 3 files. Formats accepted are GIF, JPG, TIF, BMP and PDF for all closet system and closet site pictures. 
         Maximum image size is 10MB each. </label>
        
        <br /><br />
        <div id="uploader">
            <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
        </div>
    </div>
    
	
        
	<br />
        <a class="design_form_submit" onClick="form_submit(); ga('send', 'event', 'Submit Design Request Form', 'click', 'Submit Closet Design Details');">
        <img src="<?php echo SITEROOT; ?>pages/landing/images/design_submit_round.png" /></a>
        <div class="lower_msg_box"><span id="lower_msg"><span></div>
        <div style="clear:both;"></div>
</div>

<?php
$temp_id = "'".$_SESSION['temp_id']."'";
?>
    
<script type="text/javascript">


function form_submit(){
	
	if(validate()){

		window.onbeforeunload = null;
		
		var uploader = $('#uploader').pluploadQueue();
		
		if (uploader.files.length > 0) {
            
			// When all files are uploaded submit form
            uploader.bind('StateChanged', function() {
                if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) {
                    
					document.form.submit();
					
                }
            });
                
            uploader.start();
			
        } else {
            //alert('You must queue at least one file.');
			
			document.form.submit();
			
        }
		
		//document.form.submit();
		
	}else{
	
	}
}
 	


$(function() {
	
	// Setup html5 version
	$("#uploader").pluploadQueue({
		// General settings
		runtimes : 'html5,flash,silverlight,html4',
		url : '<?php echo SITEROOT; ?>plupload-2.1.8/otg/upload.php?temp_id='+<?php echo $temp_id; ?>,
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


		flash_swf_url : '<?php echo SITEROOT; ?>plupload-2.1.8/js/Moxie.swf',
		silverlight_xap_url : '<?php echo SITEROOT; ?>plupload-2.1.8/js/Moxie.xap'
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




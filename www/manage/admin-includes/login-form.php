<script type="text/javascript">
function signIn2(){
	var user = $("#nsi_user_2").val();
	var password = $("#nsi_password_2").val();
	$.ajaxSetup({ cache: false}); 
	$.ajax({
	  url: '<?php echo $ajax_$ste_root; ?>/ajax-sign-in.php?user='+user+'&password='+password,
	  success: function(data) {
		
		if(data.indexOf("y") > -1){
			location.reload(true);			
		}else{
			$("#nav_sign_in_msg_2").removeClass("hidden").html("<p><i class='icon-exclamation icon-orange'></i> The supplied email and password combination was not found. Please register or try again.</p>");
	  	}
	  }
	});
}
function setForgotPswdForm(){
	$("#nav_sign_in_msg_2").html('');
	var forgot_password_form = '';
	forgot_password_form += "<label>Email Address</label><br />";		
	forgot_password_form += "<input id='input_email_addr' type='text' name='email_addr' style='width:206px;' />";
	forgot_password_form += "<br /><span onclick='send_password_reset();' class='orange_button' style='width:40px; height:16px; margin-top:8px;'>Submit</span>";
	forgot_password_form += "<br /><div id='input_email_addr_msg'></div>";
	forgot_password_form += "<br /><div onclick='setSignInForm();' style='color:#3f6e84; text-decoration:underline; cursor:pointer;'>< Sign in</div>";
	$("#signin_replace_2").html(forgot_password_form);		
}
function send_password_reset(){
	var email_addr = $("#input_email_addr").val();
	if(isValidEmail(email_addr)){
		$.ajaxSetup({ cache: false}); 
		$.ajax({
		  url: '<?php echo $ajax_$ste_root; ?>/ajax-send-reset-pasword.php?email_addr='+email_addr,
		  success: function(data) {
			if(data.indexOf("y") > -1){
				$("#input_email_addr_msg").html("<span>An email was sent to "+email_addr+"</span>");
			}else{
				$("#input_email_addr_msg").html("<span style='color:#cf0623'>There is no account for user name "+email_addr+"</span>");
			}
		  }
		});			
		$('#sub2').show();
	}else{
		$("#input_email_addr_msg").html("<span style='color:#cf0623'>"+email_addr+" is not a valid email address</span>");
		$('#sub2').show();
	}
}

</script>
	<section class="row gutter-top">
		<div class="span12">
				<h3 class="center-text"><i class="icon-keys icon-blue"></i>Please Log In to view your account information.</h3>
				<div id="nav_sign_in_msg_2" class="alert hidden"></div>
				<div id="signin_replace_2" class="sign-in-form">
						<label>Email Address</label>
						<input id="nsi_user_2" type="text" name="nsi_user" placeholder="<?php echo $temp_username; ?>" />
						<label>Password  jjjjjjjjjjjjjjjjjjjjjjjjj</label>
						<input id="nsi_password_2" type="password" name="nsi_password" placeholder="<?php echo $temp_pswd; ?>" />
						<hr />
						<button class="btn btn-success" id="signin_button_2" onClick='signIn2();'>Sign In</button>&nbsp;&nbsp;
						<button class="btn btn-primary" id="register_button_2" onClick="window.location.href='<?php echo $ste_root;?>/signup-form.html'">Register</button>
				</div>
				<div class="align-center gutter-bottom"><button class="btn-link align-center" onClick='setForgotPswdForm();'>Forgot Password?</button></div>
		</div>
	</section>
	

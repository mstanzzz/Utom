<?php 
//$temp_username = "mark.stanz@gmail.com";
//$temp_pswd = "toroman";
$temp_username = '';
$temp_pswd = ''; 

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$added_page = 0;
$this_url = $_SERVER['REQUEST_URI'];


?>


<script type="text/javascript">

/*
function testt(){

	alert("uuu:::");
	
}
*/


$(document).ready(function(){

/*
	$('#loading').hide();
	
	$('#loading').ajaxStart(function() {
		$(this).show();
		$('#signin_button').hide();
	
	}).ajaxComplete(function() {
		$(this).hide();
		$('#signin_button').show();
	});
*/

	/*
	$(".has-subnavs").hover(function(){
		var dynamicOffset = $(this).parent().width();
		$(this).children(".subnav").css("left",dynamicOffset+"px");
	},function(){
		$(this).children(".subnav").css("left","-20000px");
	});
	*/
	
});

function signIn(){
	
	//_trackEvent(Click, signin, signin, '', '');
	//ga('_trackEvent', 'Click', 'signin');
	
	var user = jQuery.trim($("#nsi_user").val());
	
	var password = jQuery.trim($("#nsi_password").val());
	
	
	$.ajaxSetup({ cache: false}); 
	$.ajax({
	  url: '<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/ajax-sign-in.php?user='+user+'&password='+password,
	  success: function(data) {
		  
		if(data.indexOf("y") > -1){
			location.reload(true);
		}else{
			$("#nav_sign_in_msg").removeClass("hidden").html("<p><i class='icon-exclamation icon-orange'></i> The supplied email and password combination was not found. Please register or try again.</p>");
	  	}
	  }
	});
	
	
	

}


function setForgotPswdForm(){
	$("#nav_sign_in_msg").html('');
	var forgot_password_form = '';
	forgot_password_form += "<div class='clearfix'><label>Email Address</label><br />";		
	forgot_password_form += "<input id='input_email_addr' type='text' name='email_addr' />";

	forgot_password_form += "<a onclick='send_password_reset();' class='btn btn-success' >Submit</a></div>";
	forgot_password_form += "<br /><div class='alert hide' id='input_email_addr_msg'></div>";
	forgot_password_form += "<hr /><a onclick='setSignInForm();'>< Sign in</a>";
	$("#signin_replace").html(forgot_password_form);		
}



function setSignInForm(){
	var signInHTML = ''; 
	signInHTML += "<label>Email Address</label>";
	signInHTML += "<input id='nsi_user' type='text' name='nsi_user' tabindex='1'>";
	
	signInHTML += "<label>Password</label>";
	signInHTML += "<input id='nsi_password' type='password' name='nsi_password' tabindex='2'><hr>";
	signInHTML += "<button class='btn btn-success' id='signin_button' onclick='signIn();' tabindex='3'>Sign In</button>";
	signInHTML += "&nbsp;&nbsp;<a class='btn btn-primary' id='register_button' href='<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/signup-form.html'>Register</a>";
	
	$("#signin_replace").html(signInHTML);		

}


function set_ln_current(index){
	setTimeout( setCurrent(index) ,9900000000);	
}
function setCurrent(index){
	$('#lnlink'+index).addClass('ln_bg_over');
	$('#lnlink'+index).find('.lnarrow').show();
}



function send_password_reset(){
	
	var email_addr = $("#input_email_addr").val();
	
	if(isValidEmail(email_addr)){
		$.ajaxSetup({ cache: false}); 
		$.ajax({
		  url: 'ajax-send-reset-pasword.php?email_addr='+email_addr,
		  success: function(data) {
			  //alert(data);
			if(data.indexOf("y") > -1){
				$("#input_email_addr_msg").html("<span>An email was sent to "+email_addr+"</span>");
			}else{
				$("#input_email_addr_msg").html("<span>There is no account for user name "+email_addr+"</span>");
			}
		  }
		});			
		$('#input_email_addr_msg').show();
	}else{
		$("#input_email_addr_msg").html("<span>"+email_addr+" is not a valid email address</span>");
		$('#input_email_addr_msg').show();
	}
	
}



</script>
<!--
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
-->
	<nav id="main-nav" class="hide-mobile hide-tablet">
	<ul>
	<?php
	
	
			
	
    $navbar_labels = $nav->getNavbarLabels();
	
	
	
	
	
	$block = ''; 
	
	$all_labels_char_len_limit = 140;
	
	 
	if($module->hasShoppingCartModule($_SESSION['profile_account_id']) || (!$module->hasDesignToolModule($_SESSION['profile_account_id']))){	
		$all_labels_char_len_limit -= 16;
	}

	if($nav->hasSearchBox()){
		$all_labels_char_len_limit -= 24;
	}

	$all_labels_char_len = 1;
    foreach($navbar_labels as $navbar_label_v){
		
		$all_labels_char_len += strlen($navbar_label_v['label']); 
		$multiple_subnavs = false;
		if($all_labels_char_len > $all_labels_char_len_limit) break;
		
		if($navbar_label_v['submenu_content_type'] == 1){
			
			$main_active = '';
			if($navbar_label_v['url'] != '' && $this_url != ''){
				if(strpos($this_url,$navbar_label_v['url']) > -1 || strpos($this_url,'category') > -1){
					$main_active = 'active';
				}
			}
			
			$top_cats = $nav->getTopCats();
			
			//$three_level_cats = $nav->getThreeLevelCats();
			
			$tmp_block = '';
			$total_char_len = 20;
			foreach($top_cats as $top_cat_val){				
				$has_sub_nav = 0;
				$active = (strpos($_SERVER['REQUEST_URI'], getUrlText($top_cat_val['name']))>0) ? "active" : '';
				if($top_cat_val['short_name'] != ''){
					$label = $top_cat_val['short_name'];
				}else{
					$label = $top_cat_val['name'];
				}
				
				//$label .= $navbar_label_v['submenu_content_type'];
							
				$char_length = strlen($label);
				if($char_length > $total_char_len){
					$total_char_len = $char_length;
				}
				if(count($top_cat_val['child_array']) > 0){
					$has_sub_nav = 1;	
					//$tmp_block .= "<li class='has-subnavs'>";
				}else{
					//$tmp_block .= "<li>";	
				}
				$tmp_block .= "<li>";
						
				if($top_cat_val['destination'] == 'showroom'){		
					$top_url_str = $nav->getCatUrl($top_cat_val['name'], $top_cat_val['profile_cat_id'], 'showroom');
				}else{
					$top_url_str = $nav->getCatUrl($top_cat_val['name'], $top_cat_val['profile_cat_id'], 'shop');
				}
				

				//$tmp_block .= "<a href='".$url_str."' class='$active'>".stripAllSlashes($label)."     ".$top_cat_val['destination']."</a>";
				$tmp_block .= "<a href='".$top_url_str."' class='$active'>".stripAllSlashes($label)."</a>";


				if($has_sub_nav){
					$multiple_subnavs = true;
					$sub_tmp_block = '';
					$total_sub_char_len = 20;
					$i = 0;
					foreach($top_cat_val['child_array'] as $child_cat_val){
								
						if($child_cat_val['short_name'] != ''){
							$label = $child_cat_val['short_name'];
						}else{
							$label = $child_cat_val['name'];
						}				
						$sub_char_length = strlen($label);
						if($sub_char_length > $total_sub_char_len){
							$total_sub_char_len = $sub_char_length;
						}
						
						
						//print_r($child_cat_val);
						//exit;
						
						if($child_cat_val['destination'] == 'showroom'){		
							$url_str = $nav->getCatUrl($child_cat_val['name'], $child_cat_val['profile_cat_id'], 'showroom');
						}else{
							$url_str = $nav->getCatUrl($child_cat_val['name'], $child_cat_val['profile_cat_id'], 'shop');
						}
						//$sub_tmp_block .= "<li><a href='".$url_str."' class='$active'>".stripAllSlashes($label)."   ".$child_cat_val['destination']."</a></li>";
						
						if($i < 3){
						
							$sub_tmp_block .= "<li><a href='".$url_str."' class='$active'>".stripAllSlashes($label)."</a></li>";
						
						}else{
							$sub_tmp_block .= "<li><a href='".$top_url_str."' class='$active'>More</a></li>";
							break;
						}
						$i++;
						
												
					}
					
					
					
					$total_sub_char_len = $total_sub_char_len * (8+(6/$total_sub_char_len));		
					
					$tmp_block .= "<ul class='subnav' >";
					$tmp_block .= $sub_tmp_block;
					$tmp_block .= '</ul>';		
					
				}
								
				$tmp_block .= "</li>";
			}

			$total_char_len = $total_char_len * (8+(6/$total_char_len));
			$multiple = $multiple_subnavs ? " multiple-subnavs" : '';	
			$block .= "<li class='".$main_active.$multiple."'>"; 
			$block .= "<a href='".$navbar_label_v['url']."' ".$main_active.">".$navbar_label_v["label"]."</a>";    
			$block .= "<ul class='subnav'>";				
			$block .= $tmp_block;
			$block .= "</ul>";		
			
		}elseif($navbar_label_v['submenu_content_type'] == 2){
			
			$main_active = '';
			if($navbar_label_v['url'] != '' && $this_url != ''){
				if(strpos($this_url,$navbar_label_v['url']) > -1 || strpos($this_url,'brand') > -1){
					$main_active = 'active';
				}
			}
			
			$block .= "<li class='browse-brands' ".$main_active."'>";
			if(strpos($navbar_label_v['url'], 'category') !== false){ 
				$block .= "<a href='".$navbar_label_v['url']."' ".$main_active.">".$navbar_label_v["label"]."</a>";  
			}else{
				$block .= "<a href='".$navbar_label_v['url']."' ".$main_active.">".$navbar_label_v["label"]."</a>";  				
			}
			$block .= getNavBarBrands2();
		
		}elseif($navbar_label_v['submenu_content_type'] == 3){
				
			//$this_url = '';	
				
			$sub_list_data = $nav->recursive_get_sub_menu($navbar_label_v['id'], 1, $this_url);
						
			$tmp_block = $sub_list_data['block'];
			$total_char_len = $sub_list_data['total_char_len'];
			$main_active = $sub_list_data['active'];
			$has_multiple = $sub_list_data['multiple_subnavs'];
			
			$multiple = $has_multiple > 0 ? " multiple-subnavs" : '';
			
			$total_char_len = $total_char_len * (7+(7/$total_char_len));
			
			$block .= "<li class='".$main_active.$multiple."'>"; 
			
			$block .= "<a href='".$navbar_label_v['url']."'>".$navbar_label_v['label'].'</a>';    
			
			//$block .= "<a href='".$navbar_label_v['url']."'>".$navbar_label_v['label'].'</a>';
			
			$block .= "<ul class='subnav' >";
			$block .= $tmp_block;
			$block .= "</ul>";
			
		
		}else{
			
			
			if(sizeof($this_url) > 2){
				$main_active = (strpos($this_url,$navbar_label_v['url']) > -1 || strpos($this_url,'category') > -1)? 'active' : '';
			
			}else{
				$main_active = '';
			}
			$home_cats = $nav->getHomePageCats();
			$tmp_block = '';
			$total_char_len = 20;


			foreach($home_cats as $home_cat_val){				

				$has_sub_nav = 0;

				$active = (strpos($_SERVER['REQUEST_URI'], getUrlText($home_cat_val['name']))>0) ? "active" : '';

				
				if($home_cat_val['short_name'] != ''){
					$label = $home_cat_val['short_name'];
				}else{
					$label = $home_cat_val['name'];
				}				
				$char_length = strlen($label);
				if($char_length > $total_char_len){
					$total_char_len = $char_length;
				}
		
				if(count($home_cat_val['child_array']) > 0){
					$has_sub_nav = 1;	
					//$tmp_block .= "<li class='has-subnavs'>";					
				}else{
					//$tmp_block .= "<li>";	
				}
				
				$tmp_block .= "<li>";


				if(strpos($home_cat_val['destination'], 'showroom') !== false){		
					$url_str = $nav->getCatUrl($home_cat_val['name'], $home_cat_val['profile_cat_id'], 'showroom');
				}else{
					$url_str = $nav->getCatUrl($home_cat_val['name'], $home_cat_val['profile_cat_id'], 'shop');
				}
					
				$tmp_block .= "<a href='".$url_str."' class='$active'>".stripAllSlashes($label)."</a>";


				if($has_sub_nav){
					$multiple_subnavs = true;
					$sub_tmp_block = '';
					$total_sub_char_len = 20;
					foreach($home_cat_val['child_array'] as $child_cat_val){
								
						if($child_cat_val['short_name'] != ''){
							$label = $child_cat_val['short_name'];
						}else{
							$label = $child_cat_val['name'];
						}				
						$sub_char_length = strlen($label);
						if($sub_char_length > $total_sub_char_len){
							$total_sub_char_len = $sub_char_length;
						}


						if(strpos($child_cat_val['destination'], 'showroom') !== false){		
							$url_str = $nav->getCatUrl($child_cat_val['name'], $child_cat_val['profile_cat_id'], 'showroom');
						}else{
							$url_str = $nav->getCatUrl($child_cat_val['name'], $child_cat_val['profile_cat_id'], 'shop');
						}
		
						$sub_tmp_block .= "<li><a href='".$url_str."' class='$active'>".stripAllSlashes($label)."</a></li>'";

					}
					
					$total_sub_char_len = $total_sub_char_len * (8+(6/$total_sub_char_len));		
					
					$tmp_block .= "<ul class='subnav' >";
					$tmp_block .= $sub_tmp_block;
					$tmp_block .= '</ul>';		
					
				}
								
				$tmp_block .= "</li>";
			}

			$total_char_len = $total_char_len * (8+(6/$total_char_len));
			$multiple = $multiple_subnavs ? " multiple-subnavs" : '';	
			$block .= "<li class='".$main_active.$multiple."'>";
			
			if(strpos($val['url'], 'category') !== false){
				$block .= "<a href='".$_SERVER['DOCUMENT_ROOT']."/".$navbar_label_v['url']."' ".$main_active.">".$navbar_label_v["label"]."</a>";    			
			}else{
				$block .= "<a href='".$_SERVER['DOCUMENT_ROOT']."/".$_SESSION['global_url_word'].$navbar_label_v['url']."' ".$main_active.">".$navbar_label_v["label"]."</a>";    
				
			}
			 
			
			$block .= "<ul class='subnav'>";
				
			$block .= $tmp_block;
			$block .= "</ul>";		
			
		
		
		}
		
		$block .="</li>";




	}
	echo $block;


	

//echo "all_labels_char_len: ".$all_labels_char_len;


/*
				I've put some placeholder HTML below to show you how the subnavs should be structured. Just be sure that any menu LI that has a submenu within it has the class "has-subnavs", and the submenu UL itself has the class "subnav". Since we got rid of the gray second-level navigation under the main navigation, I've deleted the old styles for that and re-used the class name for the fly-out menus. There are three levels in the example, but it can extend to four or five levels as necessary; just use the same structure and class names.

				$tmp_block .= "<li class='has-subnavs'><a href='#'>Example Submenu Level 2</a>";
					$tmp_block .= "<ul class='subnav'>";
						$tmp_block .= "<li class='has-subnavs'><a href='#'>Example Submenu Level 3</a>";
							$tmp_block .= "<ul class='subnav'>";
								$tmp_block .= "<li><a href='#'>Normal Link</a></li>";
								$tmp_block .= "<li><a href='#'>Normal Link</a></li>";
								$tmp_block .= "<li><a href='#'>Normal Link</a></li>";
							$tmp_block .= "</ul>";
						$tmp_block .= "</li>";
						$tmp_block .= "<li><a href='#'>Normal Link</a></li>";
						$tmp_block .= "<li><a href='#'>Normal Link</a></li>";
						$tmp_block .= "<li><a href='#'>Normal Link</a></li>";
					$tmp_block .= "</ul>";
				$tmp_block .= "</li>";


********************************************************** 
RESTRICT THIS SECTION TO SITES THAT HAVE shopping cart or design tool MODULES

*/


//if($module->hasShoppingCartModule($_SESSION['profile_account_id']) || $module->hasDesignToolModule($_SESSION['profile_account_id'])){	


//$lgn->logOut();

if(1){



	if($lgn->isLogedIn()){ 
	
	
	
	
	?>


	<li class="account signed-in" id="account-menu">
		<a href="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/account/account.html"><i class="header-icon-account"></i> <span class="account-text">Account</span></a>
		
        <ul class="subnav" id="account-menu">
			<li class="drop-heading">Welcome, <?php echo $lgn->getFullName(); ?></li>
			<li><a href="<?php echo $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['global_url_word']."account.html"; ?>">Account Dashboard</a> </li>
			<?php 
			                       
			$design_name = "design";    
			if($_SESSION["seo"]){    
				foreach($_SESSION["pages"] as $p_val){
					if($p_val['page_name'] == "design"){	
						$design_name = $p_val['seo_name'];
					}
				}
			}
			
			?>
            
            <!-- class="hide-mobile" -->
            
			<li><a href="<?php echo $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['global_url_word']."account-settings.html";?>">Account Settings</a></li>
			<li><a href="<?php echo $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['global_url_word'].getURLFileName('design').".html"; ?>" >Start a New Design</a></li>
            
			<!--<li  class='hide-mobile'><a href="<?php //echo $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['global_url_word']."account-designs.html"; ?>"> My Designs</a></li>-->
            
            <?php  if($module->hasShoppingCartModule($_SESSION['profile_account_id'])){ ?>
            
			<li><a href="<?php echo $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['global_url_word']."shopping-cart.html"; ?>">My Cart</a></li>
			<li><a href="<?php echo $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['global_url_word']."order-history.html"; ?>">My Orders</a></li>
            
            <?php } ?>
            
            <!--
			<li><a href="<?php //echo $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['global_url_word']."idea-folder.html"; ?>">Idea Folders</a></li>
            -->
			<li><a href="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/signout.php">Sign Out</a></li>
		</ul>
        
        
	</li>
    
    
    
	<?php
	
		
	
	}else{
				//$temp_username = "mark.stanz@gmail.com";
				//$temp_pswd = "toroman";
				$temp_username = '';
				$temp_pswd = '';
	?>
	<li class="account signed-out" id="account-menu">
		<a href="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/signin-form.html"><i class="header-icon-account"></i> <span class="account-text">Sign In</span></a>
		<ul class="subnav" id="sign-in-menu">
			<li class="drop-table">
				<div id="nav_sign_in_msg" class="alert hidden"></div>
				<div id="signin_replace" class="sign-in-form">
					<label>Email Address</label>
					<input id="nsi_user" type="email" name="nsi_user"  value="" tabindex="1"/>
					<label>Password</label>
					<input id="nsi_password" type="password" name="nsi_password"  value=""  tabindex="2" />
					<hr />
					<button class="btn btn-success" id="signin_button" onClick='signIn();' tabindex="3">Sign In</button>&nbsp;&nbsp;
					<button class="btn btn-primary" id="register_button" onClick="window.location.href='<?php echo $_SERVER['DOCUMENT_ROOT'];?>/signup-form.html'">Register</button>
					
				</div>
				<hr />
				<div class="align-center gutter-bottom"><button class="btn-link align-center" onClick='setForgotPswdForm();'>Forgot Password?</button></div>
			</li>
		</ul>
	</li>
		<?php 
		}
        
        

        

}


?>

</ul>
</nav>

<?php if($nav->hasSearchBox()){ ?>

	<form name="search_form" action='<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/search-results.html' method='get'  class="header-search" id="header-search">
		<input type="search" class="header-search-input" placeholder="Search Products..." name='search_string' />
		<button type="submit" name="search_form" class="btn btn-mini btn-primary"><i class="search-icon-small"></i></button>
	</form>
<?php } ?>        
<!-- 
	Mike has requested I remove the subnavigation, but I am leaving 
	it in here commented out in case he changes his mind or Jeff 
	doesn't like it.
<nav class="subnav">
	<?php
	/*
		$related_submenu = $nav->getRelatedSubmenu($this_url); 
		if ($related_submenu != ''){
			echo "<ul>";
			foreach ($related_submenu as $submenu_item){ 
			$active = (strpos($this_url,$submenu_item['url']) > -1)? "class='active'" : '';
		?>
			<li><a href="<?php echo $_SERVER['DOCUMENT_ROOT']."/".$submenu_item['url'];?>" <?php echo $active;?>><?php echo $submenu_item["label"]; ?></a></li>
				
	<?php	}
			echo "</ul>";
		//}else if (substr($this_url,"showroom") > 0){
		}else if (strpos($this_url, "showroom") !== false){
	
			$showroom_cats = getAllShowroomCats();
			echo "<ul>";
			if(count($showroom_cats)> 0){
				foreach($showroom_cats as $showroom_cat){
					$active = (strpos($this_url,$showroom_cat['cat_id']) > -1)? "class='active'" : '';
					echo "<li><a href='".$_SERVER['DOCUMENT_ROOT']."/".getUrlFileName('shop')."/catalog/".getUrlText($showroom_cat['name'])."/".$showroom_cat['cat_id']."' ".$active.">".$showroom_cat['name']."</a></li>";
				}
			}
			echo "</ul>";
		}else {
			echo getNavBarCats2();
		}
		*/
	?>
</nav>


<a onclick="signIn()">jjgggggggyyyyyyyyyyyygggggg</a>
-->

</header>

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

 
$msg = '';
$page_title = "SAS Users";
$page_group = "sas";

	

$db = $dbCustom->getDbConnect(USER_DATABASE);


require_once($real_root.'/manage/admin-includes/doc_header.php'); 

?>
<script>

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
  	<div class="top_link">

    </div>

    <div class="manage_main">
<?php 
        echo "<div class='manage_main_page_title'>".$page_title." </div>";

		$db = $dbCustom->getDbConnect(USER_DATABASE); 		
		$sql = "SELECT step, completed 
				FROM setup_steps
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
				ORDER BY id";
$result = $dbCustom->getResult($db,$sql);		
		
		$block = '';
		$block .= "<div style='padding-left:30px; padding-top:30px;'>";
		$desc = '';
		
		
		
		while($row = $result->fetch_object()){
			
			
			if($row->step == "profile"){				
				$desc = "<a href='edit-company-profile.php'>Enter company name, email and details</a>";
			}
			if($row->step == "banner"){				
				$desc = "<a href='cms/add-home-banner.php'>Upload 1 or more banner images for home page</a>";
			}
			if($row->step == "category"){
				$desc = "<a href='cart/top-category.php'>Enter 1 or more shopping cart categories</a>";
			}
			if($row->step == "brand"){
				$desc = "<a href='cart/vend-man.php'>Enter 1 or more shopping cart vendors or brands</a>";
			}
			if($row->step == "payment"){	
				$desc = "<a href='order-management/sas-non-parent/payment-processor.php'>Select a payment processor or request a new one</a>";
			}
			if($row->step == "password"){
				$desc = "<a href='edit-company-profile.php'>Reset the top administrator secret password</a>";
			}
					
			if($row->step == "item"){
				$desc = "<a href='cart/item.php'>Enter 1 or more shopping cart item</a>";
			}

			if($row->step == "logo"){
				$desc = "<a href='cms/logo.php'>Enter your logo</a>";
			}




				
			$block .= "<div style='float:left; width:400px; height:40px'>";
			$block .= $desc;
			$block .= "</div>";			

			$block .= "<div style='float:left; height:40px;'>";
			
			if($row->completed){
				$block .= "<div style='position:relative; top:-8px;'>";
				$block .= "<img src='".SITEROOT."/images/icons/check.jpg' />";
				$block .= "</div>";
			}
			$block .= "</div>";			

			$block .= "<div class='clear'></div>";			
		}
		$block .= "</div>";
		echo $block;



?>    


</div>





		<div class="manage_main clearfix"> 
			<!-- begin main content area -->
			<h1>What am I missing?</h1>
			<?php 
			// Please add new code for Organizer roles to check profile completeness.
			// this is just dummy markup as an example; you'll need to replace this
			// with code that actually evaluates what has been completed for the user.
			?>
			<script type="text/javascript">
			$(document).ready(function() {
				$(".progress_list a").tooltip();
			});
			</script>

			<ul class="progress_list">
				<li class="completed"><a href="<?php echo SITEROOT;?>/organizers/profile-image.php" title="Change your profile image.">Profile Image uploaded and active.</a></li>
				<li class="completed"><a href="<?php echo SITEROOT;?>/organizers/profile-information.php" title="Update your 'About Me' information." >All fields in 'About Me' filled out.</a></li>
				<li class="completed"><a href="<?php echo SITEROOT;?>/organizers/profile-portfolio.php" title="Add photographs and update your porfolio." >At least one portfolio image uploaded with a caption/description.</a></li>
				<li><a href="<?php echo SITEROOT;?>/organizers/blog-new.php" title="Write a new blog entry.">At least one blog entry written.</a></li>
				<li class="completed"><a href="<?php echo SITEROOT;?>/organizers/questions-new.php" title="View all new questions you can answer." >At least one question answered.</a></li>
				<li><a href="<?php echo SITEROOT;?>/organizers/blog-new.php" title="Write a new blog entry.">At least one before/after blog entry written.</a></li>
				<li><a href="<?php echo SITEROOT;?>/organizers/profile-skills.php" title="Add skills to your profile.">At least two skills added.</a></li>
				<li><a href="<?php echo SITEROOT;?>/organizers/profile-specialties.php" title="Add a specialty to your profile.">At least one specialty added.</a></li>
			</ul>


			<!-- end main content area --> 
		</div>

<p class="clear"></p>
<?php 
require_once($real_root.'/manage/admin-includes/manage-footer.php');
?>       

</div>


        
</body>
</html>




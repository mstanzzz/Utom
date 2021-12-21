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



$page_title = "Customer Testimonials List";
$page_group = "testimonial-page";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);


$ts = time();
// add if not exist
$sql = "SELECT testimonial_page_id FROM testimonial_page WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows == 0){
	$sql = "INSERT INTO testimonial_page 
		(content, last_update, profile_account_id) 
		VALUES ('Add Content', '".$ts."', '".$_SESSION['profile_account_id']."')"; 
	$result = $dbCustom->getResult($db,$sql);
	
}





$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';



if(isset($_POST['edit_testimonial'])){

	$name = trim(addslashes($_POST['name'])); 
	$email = trim($_POST['email']); 
	$city_state = trim(addslashes($_POST['city_state'])); 
	$content = trim(addslashes($_POST['content'])); 
	$list_order = trim($_POST['list_order']); 
	$hide = isset($_POST['hide']) ? $_POST['hide'] : 0 ;
	$testimonial_id = $_POST['testimonial_id'];
	$ts = time();

		$sql = sprintf("UPDATE testimonial 
		SET name = '%s', email = '%s', city_state = '%s', content = '%s', list_order = '%u', hide = '%u'  WHERE testimonial_id = '%u'", 
		$name, $email, $city_state, $content, $list_order, $hide, $testimonial_id);
		
		$msg = "Your change is now live.";
		$result = $dbCustom->getResult($db,$sql);
		



	
}



if(isset($_POST["set_active_and_display_order"])){
	
	$display_order = $_POST["display_order"];
	$testimonial_id  = $_POST["testimonial_id"];
	
	$actives = (isset($_POST["active"]))? $_POST["active"] : array();
	
	//print_r($actives);
	//exit;
	
	
	$sql = "UPDATE testimonial 
			SET hide = '1' 
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
			
	$result = $dbCustom->getResult($db,$sql);
	
	
	
	
	if(is_array($actives)){	
		foreach($actives as $key => $value){
			$sql = "UPDATE testimonial 
					SET hide = '0' 
					WHERE testimonial_id = '".$value."'";
			$result = $dbCustom->getResult($db,$sql);
			
			//echo "key: ".$key."   value: ".$value."<br />"; 
		}
	}


	
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



if(isset($_POST['del_testimonial'])){


	$sql = "DELETE FROM testimonial WHERE testimonial_id = '".$_POST['del_testimonial_id']."'";
	$result = $dbCustom->getResult($db,$sql);
	

	 $sql = "SELECT file_name 
			FROM testimonial_image 
			WHERE testimonial_id = '".$_POST['del_testimonial_id']."'";
			
			$res = $dbCustom->getResult($db,$sql);
            
	while($row = $res->fetch_object()){
	
		$filename = $_SERVER['DOCUMENT_ROOT']."/user_uploads/".$_SESSION['profile_account_id']."/".$row->file_name;
	
		if (file_exists($filename)) {
			unlink($filename);
		
		}
	}


	$sql = "DELETE FROM testimonial_image WHERE testimonial_id = '".$_POST['del_testimonial_id']."'";
	$result = $dbCustom->getResult($db,$sql);
	
	
}


require_once($real_root.'/manage/admin-includes/doc_header.php'); 


?>
<script>

function regularSubmit() {
  document.form.submit(); 
}

</script>
</head>
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
		$bread_crumb->add("Pages", SITEROOT."/manage/cms/pages/page.php");
		$bread_crumb->add("Testimonials Page", SITEROOT."/manage/cms/pages/testimonial-page.php");
		$bread_crumb->add("Testimonials", '');

        echo $bread_crumb->output();

        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');

        require_once($real_root."/manage/admin-includes/testimonial-section-tabs.php");
        ?>
		
        <form name="form" action="testimonial-list.php" method="post" enctype="multipart/form-data">
        	<input type="hidden" name="set_active_and_display_order" value="1">
            
            
			<div class="page_actions">
	            
                <a href="<?php echo SITEROOT;?>/manage/cms/pages/page.php" class="btn btn-large"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>
				
                <?php if($admin_access->cms_level > 1){ ?>
                <a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </a>
				<?php } ?>
				
				
            </div>    
 			
            <div class="data_table">

		        <table cellpadding="10" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>City/State</th>
                                <th width="8%">Photos</th>
                                <th width="10%">Order</th>
                                <th width="12%">Active</th>
                                <th width="12%">Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                            <?php 
                                $db = $dbCustom->getDbConnect(SITE_N_DATABASE);	   
                                $sql = "SELECT * FROM testimonial 
                                        WHERE type = 'testimonial' 
                                        AND profile_account_id = '".$_SESSION['profile_account_id']."'
                                        ORDER BY list_order";
                            $result = $dbCustom->getResult($db,$sql);							
                                $block = '';
                                while($row = $result->fetch_object()) {
                                    
                                    $block .= "<tr>";
                                    //customer name
                                    $block .= "<td valign='middle'><strong>$row->name</strong></td>";
                                    //city/state
                                    $block .= "<td valign='middle'>$row->city_state</td>";
                                    //photos
                                    $block .= "<td valign='middle'><a class='btn btn-primary fancybox fancybox.iframe' 
                                    href='photos.php?ret_page=testimonial-list&pid=".$row->testimonial_id."'><i class='icon-picture icon-white'></i></a></td>";
                                    //display order
                                    $block .= "<td align='center' ><input type='text' name='display_order[]' 
                                    value='".$row->list_order."' style='width:40px' /><input type='hidden' name='testimonial_id[]' value='".$row->testimonial_id."' /></td>";
                                    
                                    $disabled = ($admin_access->cms_level < 2)? "disabled" : '';
                                    
                                    //active
                                    if($row->hide){
                                        $show_hide = '';
                                    }else{
                                        $show_hide = "checked='checked'";	
                                    }
                                    $block .= "<td><div class='checkboxtoggle' ".$disabled." > 
                                    <span class='ontext'>ON</span><a class='switch on' href='#'></a>
                                    <span class='offtext'>OFF</span><input type='checkbox' class='checkboxinput' name='active[]' 
                                    value='".$row->testimonial_id."' $show_hide /></div></td>";
                                    
                                    //edit 				
                                    $block .= "<td valign='top'>
                                        <a class='btn btn-primary fancybox fancybox.iframe ".$disabled."' 
                                        href='edit-testimonial.php?testimonial_id=".$row->testimonial_id."&ret_page=testimonial-list'>
                                        <i class='icon-cog icon-white'></i> Edit</a></td>";
                                    
                                    
                                    
											
											
									$block .= "<td valign='middle'>		
									<a class='btn btn-danger confirm ".$disabled." ' href='#'> 
									<i class='icon-remove icon-white'></i>
									<input type='hidden' id='".$row->testimonial_id."' class='itemId' value='".$row->testimonial_id."' /></a></td>";
											
									
                                    
                                    $block .="</tr>";
                                    $block .="<tr>";
                                    $content = stripslashes($row->content);
                                    $contentStr = (string)$content;
                                    $contentSnippet = substr($contentStr,0,200);
                                    $block .= "<td class='testimoniallist' colspan='6' valign='top'>".$contentSnippet."...</td>";
                                    $block .="</tr>";
                                }
                                echo $block;
                            ?>
    
                    </table>
                
			</div>	

		</form>

	</div>   

	<p class="clear"></p>
	<?php 
	require_once($real_root.'/manage/admin-includes/manage-footer.php');
	?>
 
</div>   



<?php
	$url_str = "testimonial-list.php";
	//$url_str .= "?pagenum=".$pagenum;
	//$url_str .= "&sortby=".$sortby;
	//$url_str .= "&a_d=".$a_d;
	//$url_str .= "&truncate=".$truncate;
?>
  
<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this tstimonial?</h3>
    
	<form name="del_testimonial" action="<?php echo $url_str; ?>" method="post" target="_top">
		<input id="del_testimonial_id" class="itemId" type="hidden" name="del_testimonial_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_testimonial" type="submit" >Yes, Delete</button>
	</form>
</div>       
        
  
</body>
</html>




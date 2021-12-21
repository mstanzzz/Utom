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


$page_title = "View Contact Request";
$page_group = '';
$msg = '';

	
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

require_once($real_root.'/manage/admin-includes/doc_header.php'); 

?>
</head>

<body class="printable_page">
<div class="print_container">
	<?php 
        
    $db = $dbCustom->getDbConnect(SITE_N_DATABASE);

    $contact_email_id = (isset($_GET['contact_email_id'])) ? $_GET['contact_email_id'] : 0; 
	
	
	
		$sortby = (isset($_GET['sortby'])) ? trim($_GET['sortby']) : '';
		$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
		
		$pagenum = (isset($_GET['pagenum'])) ? $_GET['pagenum'] : 0;
		$truncate = (isset($_GET['truncate'])) ? $_GET['truncate'] : 1;
		
		$search_str = isset($_GET['search_str']) ? trim(addslashes($_GET['search_str'])) : '';

	
    
    //echo $discount_id;
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = "SELECT * FROM contact_email WHERE contact_email_id = '".$contact_email_id."' ";
$result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		$last_update = $object->last_update; 
		
		$name = $object->name; 
		$city = $object->city; 
		$state = $object->state; 
		$email = $object->email; 
		$phone = $object->phone; 
		$dept = $object->dept; 
		$subject = $object->subject; 
		$support_issue = $object->support_issue;
	}else{
		$name = '';
		$last_update = 0;
		$city = '';
		$state = '';
		$email = '';
		$phone = '';
		$dept = '';
		$subject = '';
		$support_issue	= '';
	}
	
	$url_str = "contact-email.php";
	$url_str .= "?pagenum=".$pagenum;
	$url_str .= "&sortby=".$sortby;
	$url_str .= "&a_d=".$a_d;
	$url_str .= "&truncate=".$truncate;
	$url_str .= "&search_str=".$search_str;
	
	?>
	<div class="fltrt">
    <a href="#" onClick="window.print();return false" class="btn btn-large"><i class="icon-print"></i> Print Page</a><br /><br />
    
    <a href="<?php echo $url_str; ?>" target="_top" class="btn btn-large"><i class="icon-arrow-left"></i> Go Back</a><br /></div>
    
	<h2><?php echo $name;   ?><br /><?php echo date("F j, Y, g:i a", $last_update); ?></h2>
	<table border="0" cellpadding="6" width="100%">
		<tr>
			<td class="section_heading" colspan="4"><strong>Contact Info</strong></td>
		</tr>
		<tr>
			<td width="15%"><label>Name</label></td>
			<td width="30%"><?php echo $name;?></td>
			<td width="15%"><label>Location</label></td>
			<td width="30%"><?php echo $city.", ".$state; ?></td> 
		<tr>
			<td><label>E-Mail</label></td>
			<td><?php echo $email; ?></td>
			<td><label>Phone</label></td>
			<td><?php echo $phone; ?></td>
		</tr>
		<tr>
			<td><label>Dept</label></td>
			<td><?php echo stripslashes($dept); ?></td>
			<td><label>Subject</label></td>
			<td><?php echo stripslashes($subject); ?></td>
		</tr>
		<tr>
			<td class="section_heading" colspan="4"><strong>Project Info</strong></td>
		</tr>
		<tr>
			<td><label>Support Issue</label></td>
			<td colspan="3"><?php echo stripslashes($support_issue); ?></td>
		</tr>
	</table>
	
    <div class="page_break"></div>
	<table width="100%" cellpadding="6" cellspacing="0">
		<tr>
			<td class="section_heading"><strong>Submitted Images</strong></td>
		</tr>
		<?php        
			$sql = "SELECT file_name
							FROM contact_email_image 
							WHERE contact_email_id = '".$contact_email_id."' 
							ORDER BY contact_email_img_id";	
							
			$result = $dbCustom->getResult($db,$sql);
			
			echo $result->num_rows;
				
			$block = '';	
			if($result->num_rows == 0){
				$block .= "<tr><td><label>No Images Submitted.</label></td></tr>";
				
			}else{
					
				$block = ''; 
				$i = 1;
				while($img_row = $result->fetch_object()) {
									
									
					if(file_exists ($_SERVER['DOCUMENT_ROOT']."/user_uploads/".$_SESSION['profile_account_id']."/".$img_row->file_name)){				
										
						$block .= "<tr><td>";
						$block .= "<a href=''".SITEROOT."/user_uploads/".$_SESSION['profile_account_id']."/".$img_row->file_name."' target='_blank'>";
						$block .= "<img src='".SITEROOT."/user_uploads/".$_SESSION['profile_account_id']."/".$img_row->file_name."' />";
						$block .= "</a>";
						$block .= "</td></tr>";
						$block .= "<tr><td><hr /></td></tr>";
					}
				
									
									
					
				}
				echo $block;
				}
			?>
	</table>
  
    
</div>
</body>
</html>

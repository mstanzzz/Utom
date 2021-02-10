<?php



if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'aws/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/aws';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$page_title = "In Home Consultation Request";
$page_group = "design-email";
$msg = '';


	
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$pagenum = (isset($_GET['pagenum'])) ? $_GET['pagenum'] : 0;
if(!isset($_SESSION['paging']['pagenum'])) $_SESSION['paging']['pagenum'] = $pagenum;

$sortby = (isset($_GET['sortby'])) ? $_GET['sortby'] : 0;
if(!isset($_SESSION['paging']['sortby'])) $_SESSION['paging']['sortby'] = $sortby;

$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 0;
if(!isset($_SESSION['paging']['a_d'])) $_SESSION['paging']['a_d'] = $a_d;

$truncate = (isset($_GET['truncate'])) ? $_GET['truncate'] : 0;
if(!isset($_SESSION['paging']['truncate'])) $_SESSION['paging']['truncate'] = $truncate;

$search_str = isset($_GET['search_string']) ? $_GET['search_string'] : '';



require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

    $request_id = $_GET['request_id']; 
    $ret_page =  (isset($_REQUEST['ret_page'])) ? $_REQUEST['ret_page'] : "start";
    //echo $discount_id;
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = "SELECT * FROM in_home_consult_request WHERE request_id = '".$request_id."' ";
$result = $dbCustom->getResult($db,$sql);	
	$object = $result->fetch_object();




	$url_str = 'in-home-consult.php';
	$url_str .= "?pagenum=".$pagenum;
	$url_str .= "&sortby=".$sortby;
	$url_str .= "&a_d=".$a_d;
	$url_str .= "&truncate=".$_SESSION['paging']['truncate'];
	$url_str .= "&search_str=".$search_str;



?>
</head>

<body class="printable_page">
<div class="print_container">
	<div class="fltrt"><a href="#" onClick="window.print();return false" class="btn btn-large"><i class="icon-print"></i> Print Page</a><br />
		<br />
		<a href="<?php echo $url_str; ?>" target="_top" class="btn btn-large"><i class="icon-arrow-left"></i> Go Back</a><br />
	</div>
	<h1>
		<?php if ($object->is_costco){echo "Costco Customer "; }?>
		In-Home Consultation Request <?php echo $request_id; ?></h1>
	<h2><?php echo $object->name;   ?><br />
		<?php echo date("F j, Y, g:i a", $object->date_entered) ?></h2>
	<table border="0" cellpadding="6" width="100%">
		<tr>
			<td class="section_heading" colspan="2"><strong>Contact Info</strong></td>
		</tr>
        
        <?php
		if($object->user_id > 0){
		
			echo "<tr>
				<td width='40%'>Customer ID</td>
			 	<td>".$object->user_id."</td>
				</tr>";	
		}
		if($object->email != ''){
			echo "<tr>
				<td>E-Mail</td>
				<td><a href='mailto:".$object->email."'>".$object->email."</a></td>
				</tr>";	
		}
		if($object->phone != ''){
			echo "<tr>
				<td>Phone</td>
				<td>".$object->phone."</td>
				</tr>";	
		}
		?>
		<tr>
			<td class="section_heading" colspan="4"><strong>Project Info</strong></td>
		</tr>
<?php

		if($object->city != '' || $object->state != '' || $object->zip != ''){
			echo "<tr>
				<td>Location</td>
				<td>".$object->city.", ".$object->state." ".$object->zip."</td>
				</tr>";	
		}

		if($object->proposed_finish_date != ''){
			
			echo "<tr>
				<td>Proposed Finish Date</td>
				<td>".$object->proposed_finish_date."</td>
				</tr>";	
			
		}
		if($object->closet_type != ''){		
			echo "<tr>
				<td>Closet Type</td>
				<td>".$object->closet_type."</td>
				</tr>";	
			
		}

		if($object->closet_type != ''){		
			echo "<tr>
				<td>Comments</td>
				<td>".$object->comments."</td>
				</tr>";	
			
		}
		
		if($object->source != ''){		
			echo "<tr>
				<td>How ... heard about us</td>
				<td>".$object->source."</td>
				</tr>";	
			
		}
?>        
        
	</table>

	<div class="page_break"></div>
	<table width="100%" cellpadding="6" cellspacing="0">
		<tr>
			<td class="section_heading"><strong>Submitted Images</strong></td>
		</tr>
		<?php        
			$sql = "SELECT file_name
							FROM consultation_request_image 
							WHERE in_home_consult_request_id = '".$request_id."'";	
			
			$result = $dbCustom->getResult($db,$sql);
		
			
			$block = ''; 
			if($result->num_rows < 1){
				$block .= "<tr><td><label>No Images Submitted.</label></td></tr>";
			}
			$i = 1;
			while($img_row = $result->fetch_object()) {
				
				
				if(file_exists ($_SERVER['DOCUMENT_ROOT']."/user_uploads/".$_SESSION['profile_account_id']."/".$img_row->file_name)){				
										
						$block .= "<tr><td>";
						$block .= "<img src='".$ste_root."/user_uploads/".$_SESSION['profile_account_id']."/".$img_row->file_name."' />";
						$block .= "<a href='".$ste_root."/user_uploads/".$_SESSION['profile_account_id']."/".$img_row->file_name."' target='_blank'><div style='font-size:18px;'>$img_row->file_name</div></a>";
						$block .= "</td></tr>";
						$block .= "<tr><td><hr /></td></tr>";
					}
				
				
			}
			echo $block;
							
			?>
	</table>


</div>
</body>
</html>

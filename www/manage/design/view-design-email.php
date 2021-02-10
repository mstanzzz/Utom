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

$page_title = "View Design Request";
$page_group = "design-email";
$msg = '';


require_once("../includes/set-page.php");	


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


?>
</head>

<body class="printable_page">
<div class="print_container">
	<?php 
        
    $db = $dbCustom->getDbConnect(SITE_N_DATABASE);

    $design_email_id = $_GET['design_email_id']; 
    
    //echo $discount_id;
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = "SELECT * FROM design_email WHERE design_email_id = '".$design_email_id."' ";
$result = $dbCustom->getResult($db,$sql);	
	$object = $result->fetch_object();


	$url_str = "design-email.php";
	$url_str .= "?pagenum=".$pagenum;
	$url_str .= "&sortby=".$sortby;
	$url_str .= "&a_d=".$a_d;
	$url_str .= "&truncate=".$_SESSION['paging']['truncate'];
	$url_str .= "&search_str=".$search_str;

	?>
	<div class="fltrt"><a href="#" onClick="window.print();return false" class="btn btn-large"><i class="icon-print"></i> Print Page</a><br /><br />
    <a href="<?php echo $url_str; ?>" target="_top" class="btn btn-large"><i class="icon-arrow-left"></i> Go Back</a><br /></div>
	<h1><?php if ($object->is_costco){echo "Costco Customer "; }?>Design Request <?php echo $design_email_id; ?></h1>
	<h2><?php echo stripAllSlashes($object->name);   ?><br /><?php echo date("F j, Y, g:i a", $object->date_submitted); ?></h2>
	<table border="0" cellpadding="6" width="100%">
		<tr>
			<td class="section_heading" colspan="4"><strong>Contact Info</strong></td>
		</tr>

		
		<?php if($object->origin != ''){ ?>
		<tr>
			<td><label>Origin Page</label></td>
			<td><?php echo $object->origin;?></td>
        </tr>
		<?php } ?>
        
		
		<?php if($object->source != ''){ ?>
		<tr>
			<td><label>Found Site Via</label></td>
			<td><?php echo $object->source;?></td>
        </tr>
		<?php } ?>
        
        <?php 
		if($object->name != ''){ 
			echo "<tr>";
			echo "<td ><label>Name</label></td>";
			echo "<td >".stripAllSlashes($object->name)."</td>"; 
			echo "</tr>";
		}
		
		

$zip = 	$object->zip;	
		
if(strlen($zip) < 5){
	$zip = -1;
}elseif(strlen($zip) > 5){
	$zip = 	substr($zip, 0, 5);
}
if(!is_numeric($zip)){
	$zip = -1;	
}

if($zip != -1){
	$acs_obj = getCityStateFromZip($zip);
	$ret_city = $acs_obj['city'];
	$ret_state = $acs_obj['state'];
	$ret_country = $acs_obj['country'];
	$multi_cities = $acs_obj['multi_cities'];

}else{
	$ret_city = '';
	$ret_state = '';
	$ret_country = '';
	$multi_cities = '';
	
}

		
		if($multi_cities != ''){
			
			echo "<tr>";
			echo "<td ><label>Multiple Cities</label></td>";
			echo "<td>".$multi_cities."</td>";
			echo "</tr>";
			
		}else{
			
			if($ret_city != ''){ 
				echo "<tr>";
				echo "<td ><label>City</label></td>";
				echo "<td>".stripAllSlashes($ret_city)."</td>";
				echo "</tr>";
			}
			
		}
		
		
		if($ret_state != ''){
			
			echo "<tr>";
			echo "<td ><label>State</label></td>";
			echo "<td>".stripAllSlashes($ret_state)."</td>";
			echo "</tr>";
			
		}
		

		if($zip != ''){ 
			echo "<tr>";
			echo "<td ><label>Zip</label></td>";
			echo "<td>".$zip."</td>";
			echo "</tr>";
		}
		

		if($ret_country != ''){ 
			echo "<tr>";
			echo "<td ><label>Country</label></td>";
			echo "<td>".$ret_country."</td>";
			echo "</tr>";
		}

		
		/*
		if($object->city != '' || $object->state || $object->zip){ 
			echo "<tr>";
			echo "<td ><label>Location</label></td>";
			echo "<td>".stripAllSlashes($object->city).", ".$object->state." ".$object->zip."</td>";
			echo "</tr>";
		}
		*/
			echo "<tr>";
			echo "<td ><label>Customer ID</label></td>";
			echo "<td>";
		if($object->user_id == 0){ 
			echo "No Account";	
		}else{
			echo $object->user_id;	
		}
		echo "</td>";
		echo "</tr>";



		if($object->email != ''){ 
			echo "<tr>";
			echo "<td ><label>E-Mail</label></td>";
			echo "<td >".$object->email."</td>"; 
			echo "</tr>";
		}
		
		if($object->phone != ''){ 
			echo "<tr>";
			echo "<td ><label>Phone</label></td>";
			echo "<td >".$object->phone."</td>"; 
			echo "</tr>";
		}

		if($object->contact_via != ''){ 
			echo "<tr>";
			echo "<td ><label>Contact Via</label></td>";
			echo "<td >".$object->contact_via."</td>"; 
			echo "</tr>";
		}

		if($object->best_contact_time != ''){ 
			echo "<tr>";
			echo "<td ><label>Best Time to Contact</label></td>";
			echo "<td >".$object->best_contact_time."</td>"; 
			echo "</tr>";
		}
		?>
    	<tr>
			<td class="section_heading" colspan="4"><strong>Project Info</strong></td>
		</tr>
         <?php 
		 if(trim($object->budget_range) != ''){		 
			echo "<tr>";
			echo "<td ><label>Budget Range</label></td>";
			echo "<td >".$object->budget_range."</td>"; 
			echo "</tr>";		 
		 }
		 if(trim($object->proposed_finish_date) != ''){		 
			echo "<tr>";
			echo "<td ><label>Proposed Finish Date</label></td>";
			echo "<td >".$object->proposed_finish_date."</td>"; 
			echo "</tr>";		 
		 }
		 
		 if(trim($object->job_type) != ''){		 
			echo "<tr>";
			echo "<td ><label>Job Type</label></td>";
			echo "<td >".$object->job_type."</td>"; 
			echo "</tr>";		 
		 }
		 if(trim($object->comments) != ''){		 
			echo "<tr>";
			echo "<td ><label>Comments</label></td>";
			echo "<td >".stripAllSlashes($object->comments)."</td>"; 
			echo "</tr>";		 
		 }
		 ?>
		<tr>
			<td class="section_heading" colspan="4"><strong>Measurements &amp; Details</strong></td>
		</tr>
		<?php
		
		 if(trim($object->closet_type) != ''){		 
			echo "<tr>";
			echo "<td ><label>Closet Type</label></td>";
			echo "<td >".$object->closet_type."</td>"; 
			echo "</tr>";		 
		 }
		
		
		 if(trim($object->wall_a) != ''){		 
			echo "<tr>";
			echo "<td ><label>Wall A</label></td>";
			echo "<td >".stripslashes($object->wall_a)."</td>"; 
			echo "</tr>";		 
		 }
		
		 if(trim($object->wall_b) != ''){		 
			echo "<tr>";
			echo "<td ><label>Wall B</label></td>";
			echo "<td >".stripslashes($object->wall_b)."</td>"; 
			echo "</tr>";		 
		 }
		 if(trim($object->wall_c) != ''){		 
			echo "<tr>";
			echo "<td ><label>Wall C</label></td>";
			echo "<td >".stripslashes($object->wall_c)."</td>"; 
			echo "</tr>";		 
		 }
		 if(trim($object->wall_d) != ''){		 
			echo "<tr>";
			echo "<td ><label>Wall D</label></td>";
			echo "<td >".stripslashes($object->wall_d)."</td>"; 
			echo "</tr>";		 
		 }

		 if(trim($object->wall_e) != ''){		 
			echo "<tr>";
			echo "<td ><label>Wall E</label></td>";
			echo "<td >".stripslashes($object->wall_e)."</td>"; 
			echo "</tr>";		 
		 }

		 if(trim($object->wall_f) != ''){		 
			echo "<tr>";
			echo "<td ><label>Wall E</label></td>";
			echo "<td >".stripslashes($object->wall_f)."</td>"; 
			echo "</tr>";		 
		 }
		 if(trim($object->wall_g) != ''){		 
			echo "<tr>";
			echo "<td ><label>Wall E</label></td>";
			echo "<td >".stripslashes($object->wall_g)."</td>"; 
			echo "</tr>";		 
		 }
		 
		 
		 if(trim($object->storage_type) != ''){		 
			echo "<tr>";
			echo "<td ><label>Storage Type</label></td>";
			echo "<td >".$object->storage_type."</td>"; 
			echo "</tr>";		 
		 }

		 if(trim($object->master_type) != ''){		 
			echo "<tr>";
			echo "<td ><label>Master Closet Type</label></td>";
			echo "<td >".$object->master_type."</td>"; 
			echo "</tr>";		 
		 }

		 if(trim($object->other_storage_type) != ''){		 
			echo "<tr>";
			echo "<td ><label>Other Storage Type</label></td>";
			echo "<td >".$object->other_storage_type."</td>"; 
			echo "</tr>";		 
		 }

		 if(trim($object->door_type) != ''){		 
			echo "<tr>";
			echo "<td ><label>Door Type</label></td>";
			echo "<td >".$object->door_type."</td>"; 
			echo "</tr>";		 
		 }

		 if(trim($object->door_size) != ''){		 
			echo "<tr>";
			echo "<td ><label>Door Size</label></td>";
			echo "<td >".stripslashes($object->door_size)."</td>"; 
			echo "</tr>";		 
		 }


		 if(trim($object->ceiling_height) != ''){		 
			echo "<tr>";
			echo "<td ><label>Ceiling Type</label></td>";
			echo "<td >".stripslashes($object->ceiling_height)."</td>"; 
			echo "</tr>";		 
		 }
		 if(trim($object->base_mold_height) != ''){		 
			echo "<tr>";
			echo "<td ><label>Base Mold Type</label></td>";
			echo "<td >".stripslashes($object->base_mold_height)."</td>"; 
			echo "</tr>";		 
		 }
		 if(trim($object->short_hang) != '' || $object->has_short_hang > 0){		 
			echo "<tr>";
			echo "<td ><label>Has Short Hang</label></td>";
			echo "<td >Yes</td>"; 
			echo "</tr>";		 
		 }




		 if(trim($object->medium_hang) != '' || $object->has_short_hang > 0){		 
			echo "<tr>";
			echo "<td ><label>Has Medium Hang</label></td>";
			echo "<td >Yes</td>"; 
			echo "</tr>";		 
		 }


		 if(trim($object->medium_hang) != ''){		 
			echo "<tr>";
			echo "<td ><label>Medium Hang</label></td>";
			echo "<td >".trim(stripslashes($object->medium_hang))."</td>"; 
			echo "</tr>";		 
		 }

		 if(trim($object->long_hang) != '' || $object->has_short_hang > 0){		 
			echo "<tr>";
			echo "<td ><label>Has Long Hang</label></td>";
			echo "<td >Yes</td>"; 
			echo "</tr>";		 
		 }

		 if(trim($object->long_hang) != ''){		 
			echo "<tr>";
			echo "<td ><label>Long Hang</label></td>";
			echo "<td >".trim(stripslashes($object->long_hang))."</td>"; 
			echo "</tr>";		 
		 }
		 
		 

		 if(trim($object->child_age) != ''){		 
			echo "<tr>";
			echo "<td ><label>Child Age</label></td>";
			echo "<td >".$object->child_age."</td>"; 
			echo "</tr>";		 
		 }
		 if(trim($object->obstructions) != ''){		 
			echo "<tr>";
			echo "<td ><label>Obstructions</label></td>";
			echo "<td >".stripslashes($object->obstructions)."</td>"; 
			echo "</tr>";		 
		 }

		 if(trim($object->drawers) != ''){		 
			echo "<tr>";
			echo "<td ><label>Drawers</label></td>";
			echo "<td >".$object->drawers."</td>"; 
			echo "</tr>";		 
		 }

		 if(trim($object->shoes) != ''){		 
			echo "<tr>";
			echo "<td ><label>Shoes</label></td>";
			echo "<td >".$object->shoes."</td>"; 
			echo "</tr>";		 
		 }

		 if(trim($object->has_shelves) > 0){		 
			echo "<tr>";
			echo "<td ><label>Has Shelves</label></td>";
			echo "<td >Yes</td>"; 
			echo "</tr>";		 
		 }

		 if(trim($object->tie_rack) != '' || $object->has_tie_rack > 0){		 
			echo "<tr>";
			echo "<td ><label>Has Tie Rack</label></td>";
			echo "<td >Yes</td>"; 
			echo "</tr>";		 
		 }
		 
		 if(trim($object->belt_rack) != '' || $object->has_belt_rack > 0){		 
			echo "<tr>";
			echo "<td ><label>Has Belt Rack</label></td>";
			echo "<td >Yes</td>"; 
			echo "</tr>";		 
		 }

		 if(trim($object->valet_rod) != '' || $object->has_valet_rod > 0){		 
			echo "<tr>";
			echo "<td ><label>Has Valet Rod</label></td>";
			echo "<td >Yes</td>"; 
			echo "</tr>";		 
		 }

		 if(trim($object->has_basket_tall) > 0){		 
			echo "<tr>";
			echo "<td ><label>Has Tall Basket</label></td>";
			echo "<td >Yes</td>"; 
			echo "</tr>";		 
		 }
		 
		 
		 if(trim($object->has_basket_medium) > 0){		 
			echo "<tr>";
			echo "<td ><label>Has Medium Basket</label></td>";
			echo "<td >Yes</td>"; 
			echo "</tr>";		 
		 }
		 
		 
		 if(trim($object->has_basket_short) > 0){		 
			echo "<tr>";
			echo "<td ><label>Has Short Basket</label></td>";
			echo "<td >Yes</td>"; 
			echo "</tr>";		 
		 }

		 if(trim($object->finish) != ''){		 
			echo "<tr>";
			echo "<td ><label>Finish</label></td>";
			echo "<td >".$object->finish."</td>"; 
			echo "</tr>";		 
		 }



		if($object->item_id > 0){
			
			
			$db = $dbCustom->getDbConnect(CART_DATABASE);
			$sql = "SELECT name
					FROM item 
					WHERE item_id  = '".$object->item_id."'";	
			$res = $dbCustom->getResult($db,$sql);
			if($res->num_rows > 0){
				
				$obj = $res->fetch_object();
					
					 
				echo "<tr>";
				echo "<td ><label>Cart Item ID:</label></td>";
				echo "<td >".$object->item_id."</td>"; 
				echo "</tr>";
				
				echo "<tr>";
				echo "<td ><label>Cart Item:</label></td>";
				echo "<td >".$obj->name."</td>"; 
				echo "</tr>";		 


			}
			
		 }


		 ?>
        
        
	</table>
	<div class="page_break"></div>
	<table width="100%" cellpadding="6" cellspacing="0">
		<tr>
			<td class="section_heading"><strong>Submitted Images</strong></td>
		</tr>
		<?php 
		
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		       
			$sql = "SELECT file_name
					FROM design_email_image 
					WHERE design_email_id = '".$design_email_id."' 
					ORDER BY design_email_img_id";	
			$result = $dbCustom->getResult($db,$sql);	
			
			//echo $result->num_rows;
			
			$block = '';
			
			//echo $result->num_rows;
			
			if($result->num_rows == 0){
			
			 
			
				$block .= "<tr><td><label>No Images Submitted.</label></td></tr>";
			}else{
				$i = 1;
				while($img_row = $result->fetch_object()) {
					
					$block .= "<tr><td>";
					
					if(file_exists ($_SERVER['DOCUMENT_ROOT']."/user_uploads/".$_SESSION['profile_account_id']."/".$img_row->file_name)){				
										
						
						//$block .= "<img src='".$ste_root."/user_uploads/".$_SESSION['profile_account_id']."/".$img_row->file_name."' />";
						$block .= "<a href='".$ste_root."/user_uploads/".$_SESSION['profile_account_id']."/".$img_row->file_name."' target='_blank'>
						<div style='font-size:18px;'>$img_row->file_name</div></a>";
						
					}
					
					$block .= "</td></tr>";
					//$block .= "<tr><td><img src='".$ste_root."/user_uploads/".$_SESSION['profile_account_id']."/".$img_row->file_name."' /><hr /></td></tr>";
					$block .= "<tr><td><hr /></td></tr>";
					
				}
			}
			echo $block;
							
			?>
	</table>
</div>



<br /><br /><br /><br /><br /><br />

</body>
</html>

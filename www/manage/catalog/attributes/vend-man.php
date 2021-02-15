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

$page_title = "All Vendors";
$page_group = "vend-man";

	

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;

$db = $dbCustom->getDbConnect(CART_DATABASE);

$msg = '';

if(isset($_POST['add_vend_man'])){

	$parent_vend_man_id = $_POST["parent_vend_man_id"];
		
	$name = (isset($_POST['name'])) ? addslashes($_POST['name']) : ''; 
	$web_site = (isset($_POST['web_site'])) ? addslashes($_POST['web_site']) : ''; 
	$description = (isset($_POST['description'])) ? addslashes($_POST['description']) : ''; 
	$contact_name = (isset($_POST['contact_name'])) ? addslashes($_POST['contact_name']) : ''; 
	$contact_email = (isset($_POST['contact_email'])) ? addslashes($_POST['contact_email']) : ''; 
	$contact_phone = (isset($_POST['contact_phone'])) ? addslashes($_POST['contact_phone']) : ''; 
	$contact_fax = (isset($_POST['contact_fax'])) ? addslashes($_POST['contact_fax']) : ''; 
	$is_drop_shipper = (isset($_POST['is_drop_shipper'])) ? addslashes($_POST['is_drop_shipper']) : ''; 
	$is_vendor = (isset($_POST['is_vendor'])) ? addslashes($_POST['is_vendor']) : ''; 
	
	
	$is_drop_shipper = isset($_POST['is_drop_shipper']) ? $_POST['is_drop_shipper'] : 0; 
	$is_vendor = isset($_POST['is_vendor']) ? $_POST['is_vendor'] : 0; 
	$is_manufacturer = isset($_POST['is_manufacturer']) ? $_POST['is_manufacturer'] : 0; 
	
	$brand_ids = isset($_POST["brand_ids"]) ? $_POST["brand_ids"] : 0;
	
	$sql = sprintf("SELECT * FROM vend_man WHERE name = '%s'", $name);	
	$result = $dbCustom->getResult($db,$sql);	
	if(!$result->num_rows){
		$sql = sprintf("INSERT INTO vend_man 
					   (name
						,web_site
						,description 
						,contact_name
						,contact_email
						,contact_phone
						,contact_fax
						,is_drop_shipper
						,is_vendor
						,is_manufacturer
						,parent_vend_man_id
						,profile_account_id) 
					   VALUES ('%s','%s','%s','%s','%s','%s','%s','%u','%u','%u','%u','%u')", 
					   $name
					   ,$web_site
					   ,$description
					   ,$contact_name
					   ,$contact_email
					   ,$contact_phone
					   ,$contact_fax
					   ,$is_drop_shipper
					   ,$is_vendor
					   ,$is_manufacturer
					   ,$parent_vend_man_id
					   ,$_SESSION['profile_account_id']);
		$result = $dbCustom->getResult($db,$sql);
		
		
		
		$vend_man_id = $db->insert_id;
		
		if(is_array($brand_ids)){		
			//print_r($brand_ids);
			foreach($brand_ids as $value){
				//echo $value;
				$sql = "INSERT INTO vend_man_brand 
						(vend_man_id, brand_id) 
						VALUES( '".$vend_man_id."', '".$value."')";
		$result = $dbCustom->getResult($db,$sql);				
			}
		}
		
		$msg = "Your change is now live.";

	}else{
		$msg = "The brand name already exists";
	}
}


if(isset($_POST['edit_vend_man'])){
	
	$vend_man_id = $_POST['vend_man_id'];
	$parent_vend_man_id = $_POST["parent_vend_man_id"];
	$name = addslashes($_POST['name']); 
	$web_site = addslashes($_POST["web_site"]); 
	$description = addslashes($_POST['description']); 
	$contact_name = addslashes($_POST["contact_name"]); 
	$contact_email = addslashes($_POST["contact_email"]); 
	$contact_phone = addslashes($_POST["contact_phone"]); 
	$contact_fax = addslashes($_POST["contact_fax"]); 
	$is_drop_shipper = isset($_POST["is_drop_shipper"]) ? $_POST["is_drop_shipper"] : 0; 
	$is_vendor = isset($_POST['is_vendor']) ? $_POST['is_vendor'] : 0; 
	$is_manufacturer = isset($_POST["is_manufacturer"]) ? $_POST["is_manufacturer"] : 0; 

	$brand_ids = isset($_POST["brand_ids"]) ? $_POST['brand_ids'] : array();

	if($stmt = $db->prepare("UPDATE vend_man SET 
					name = ?
					,web_site = ?
					,description = ? 
					,contact_name = ?
					,contact_email = ?
					,contact_phone = ?
					,contact_fax = ?
					,is_drop_shipper = ?
					,is_vendor = ?
					,is_manufacturer = ?
					,parent_vend_man_id = ?
				   WHERE vend_man_id = ?")){

		$stmt->bind_param('sssssssiiiii'
						,$name
						,$$web_site
						,$description
						,$contact_name
						,$contact_email 
						,$contact_phone
						,$contact_fax
						,$is_drop_shipper
						,$is_vendor
						,$is_manufacturer
						,$parent_vend_man_id
						,$vend_man_id);
		
		$stmt->execute();
		$stmt->close();
		

		$sql = "DELETE FROM vend_man_brand 
				WHERE vend_man_id = '".$vend_man_id."'";
		$result = $dbCustom->getResult($db,$sql);	
	
		if(isset($brand_ids)){		
			//print_r($brand_ids);
			foreach($brand_ids as $value){
				//echo $value;
				$sql = "INSERT INTO vend_man_brand 
						(vend_man_id, brand_id) 
						VALUES( '".$vend_man_id."', '".addslashes($value)."')";
				$result = $dbCustom->getResult($db,$sql);			
			}
		}
			

		$msg = 'Your change is now live.';
		
		$progress->completeStep('brand' ,$_SESSION['profile_account_id']);
		
	}
}

if(isset($_POST["del_vend_man"])){

	$vend_man_id = $_POST["del_vend_man_id"];
	//echo "accessory_cat_id".$accessory_cat_id;
	//exit;
	$sql = sprintf("DELETE FROM vend_man WHERE vend_man_id = '%u'", $vend_man_id);
	$result = $dbCustom->getResult($db,$sql);
	

	$msg = "Your change is now live.";

}


unset($_SESSION["temp_fields"]);
unset($_SESSION["temp_brand_ids"]);

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>




<script type="text/javascript" language="javascript">
$(document).ready(function(){
	$("tbody tr").hover(function(){
		$(this).css("background-color", "#F9FBFC");
	}, function(){
		$(this).css("background-color", "transparent");
	});	
});
</script>
</head>
<body>
<div class='manage_page_container'>
<?php

if(!$strip){ 
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');

	echo "<div class='manage_side_nav'>";

	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php');
	
	echo "</div>";
	echo "<div class='manage_main'>";	
    //echo "<div class='manage_main'>";

			require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
			$bread_crumb = new AdminBreadCrumb;
			$bread_crumb->reSet();
			$bread_crumb->add("Product Catalog", $ste_root."manage/catalog/catalog-landing.php");
			$bread_crumb->add("Vendor", $ste_root."manage/catalog/attributes/vend-man.php");
			echo $bread_crumb->output();
}
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
        
if(!$strip){ 

       require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/attribute-section-tabs.php");

}
		$sortby = (isset($_GET['sortby'])) ? trim(mysql_escape_string($_GET['sortby'])) : '';
		$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
		$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;
		$truncate = (isset($_GET['truncate'])) ? addslashes($_GET['truncate']) : 1;

		if($admin_access->product_catalog_level > 1){

		$url_str = "add-vend-man.php";
		$url_str .= "?strip=".$strip;
		$url_str .= "&pagenum=".$pagenum;
		$url_str .= "&sortby=".$sortby;
		$url_str .= "&a_d=".$a_d;
		$url_str .= "&truncate=".$truncate;

		?>
			<div class="page_actions">
				<a class="btn btn-large btn-primary" href="<?php echo $url_str; ?> "><i class="icon-plus icon-white"></i> Add a New Vendor </a>
			</div>
		<?php
		}
        
			// get total number of rows
			$sql = "SELECT * FROM vend_man 
					WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
								
			$db = $dbCustom->getDbConnect(CART_DATABASE);
			$nmx_res = $dbCustom->getResult($db,$sql);

			$total_rows = $nmx_res->num_rows;
			$rows_per_page = 16;
			$last = ceil($total_rows/$rows_per_page); 
			
			if ($pagenum < 1){ 
				$pagenum = 1; 
			}elseif ($pagenum > $last){ 
				$pagenum = $last; 
			} 
			
			$limit = ' limit ' .($pagenum - 1) * $rows_per_page.','.$rows_per_page;
			
			if($sortby != ''){
				if($sortby == 'name'){
					if($a_d == 'd'){
						$sql .= " ORDER BY name DESC".$limit;
					}else{
						$sql .= " ORDER BY name".$limit;	
					}
				}				
			}else{
				$sql .= " ORDER BY vend_man_id".$limit;					
			}
				
			$result = $dbCustom->getResult($db,$sql);			
			
			if($total_rows > $rows_per_page){
                echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "catalog/attributes/vend-man.php", $sortby, $a_d);
			}

        ?>
        	<div class="data_table">
            	<?php require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/tablesort.php"); ?>
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
                        	<th <?php addSortAttr('name',true); ?>>
                            Vendor Name
                            <i <?php addSortAttr('name',false); ?>></i>
                            </th>
							<th>Parent Vendor Name</th>
							<th>Current Brands</th>
							<th>Edit Brands</th>
							<th width="13%">Edit</th>
							<th width="5%">Delete</th>
						</tr>
					</thead>
					<?php 
					if($result->num_rows < 1){
					echo "No vendors";	
					}
					$j =  0;
					$block = '';
					while($row = $result->fetch_object()) {
						$j =  $j +1;
						$block .= "<tr>";
						//vendor name
						$block .= "<td valign='middle' >".stripslashes($row->name)."</td>";
						//vendor parent
						$sql = "SELECT name 
								FROM vend_man
								WHERE vend_man_id = '".$row->parent_vend_man_id."'";
								
						$res = $dbCustom->getResult($db,$sql);		
						$block .= "<td valign='middle' >";
						if($res->num_rows){
							$v_obj = $res->fetch_object();
							$block .= stripslashes($v_obj->name)."<br />";
						}		
						$block .= "</td>";
						//brands
						$sql = "SELECT name 
								FROM brand, vend_man_brand 
								WHERE vend_man_brand.brand_id = brand.brand_id  
								AND vend_man_brand.vend_man_id = '".$row->vend_man_id."'";
								
						$res = $dbCustom->getResult($db,$sql);		
						$block .= "<td valign='middle' >";
						while($v_row = $res->fetch_object()){
							$block .= stripslashes($v_row->name)."<br />";
						}		
						$block .= "</td>";
						


						$url_str = "brand.php";
						$url_str .= "?strip=".$strip;
						$url_str .= "&vend_man_id=".$row->vend_man_id;		
						$url_str .= "&pagenum=".$pagenum;
						$url_str .= "&sortby=".$sortby;
						$url_str .= "&a_d=".$a_d;
						$url_str .= "&truncate=".$truncate;

						
						//edit brands
						$block .= "<td valign='middle'>
						<a class='btn btn-primary'  href='".$url_str."' ><i class='icon-tag icon-white'></i> Edit Brands</a>
						</td>";

						$url_str = "edit-vend-man.php";
						$url_str .= "?strip=".$strip;
						$url_str .= "&vend_man_id=".$row->vend_man_id;		
						$url_str .= "&pagenum=".$pagenum;
						$url_str .= "&sortby=".$sortby;
						$url_str .= "&a_d=".$a_d;
						$url_str .= "&truncate=".$truncate;

						//edit
						$block .= "<td valign='middle'>
						<a class='btn btn-primary' href='".$url_str."'><i class='icon-cog icon-white'></i> Edit</a>
						</td>";
						
						$disabled = ($admin_access->product_catalog_level < 2)? "disabled" : '';
						//delete			
						$block .= "<td valign='middle'>
						<a class='btn btn-danger confirm ".$disabled." '>
						<i class='icon-remove icon-white'></i>
						<input type='hidden' id='".$row->vend_man_id."' class='itemId' value='".$row->vend_man_id."' /></a>
						</td>";
						$block .= "</tr>";
					}
				echo $block;
				?>
    </table>
	</div>
    
   <?php
	if(!$strip){ 	
		echo "</div>
		<p class='clear'></p>";
		 
		require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
	}
	echo "</div>";
	
	$url_str = "vend-man.php";
	$url_str .= "?strip=".$strip;
	$url_str .= "&pagenum=".$pagenum;
	$url_str .= "&sortby=".$sortby;
	$url_str .= "&a_d=".$a_d;
	$url_str .= "&truncate=".$truncate;

    ?>

<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this Vendor?</h3>
	<form name="del_vend_man" action="<?php echo $url_str; ?>" method="post" target="_top">
		<input id="del_vend_man_id" class="itemId" type="hidden" name="del_vend_man_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_vend_man" type="submit" >Yes, Delete</button>
	</form>
</div>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>
</body>
</html>


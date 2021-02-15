<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');
$progress = new SetupProgress;
$module = new Module;

$page_title = "Product Brands";
$page_group = "vend-man";

	

$db = $dbCustom->getDbConnect(CART_DATABASE);

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;

$vend_man_id =  (isset($_GET['vend_man_id'])) ? $_GET['vend_man_id'] : 0;

$msg = '';

if(isset($_POST['add_brand'])){

	$name = addslashes($_POST['name']);
	$short_name = addslashes($_POST['short_name']);
	$web_site = addslashes($_POST['web_site']); 
	$vend_man_ids = isset($_POST['vend_man_ids']) ? $_POST['vend_man_ids'] : array();
	$vend_man_id = isset($_POST['vend_man_id']) ? $_POST['vend_man_id'] : 0;
	$ret_page = (isset($_POST['ret_page']))? $_POST['ret_page'] : '';
	
	$sql = sprintf("SELECT brand_id FROM brand WHERE name = '%s'", $name);	
	$result = $dbCustom->getResult($db,$sql);	
	
	if(!$result->num_rows){
		
		if($stmt = $db->prepare("INSERT INTO brand 
					   (name
					   ,short_name
					   	,web_site
						,profile_account_id) 
					   VALUES (?,?,?,?)")){
			
			
			$stmt->bind_param('sssi', $name, $short_name, $web_site, $_SESSION['profile_account_id']);
			$stmt->execute();
			$stmt->close();
			$brand_id = $db->insert_id;
	
	
			if(count($vend_man_ids) > 0 && $brand_id > 0){					
				foreach($vend_man_ids as $value){
					$sql = "INSERT INTO vend_man_brand 
							(vend_man_id, brand_id) 
							VALUES( '".$value."', '".$brand_id."')";
					$res = $dbCustom->getResult($db,$sql);				
				}
			}
		
		}
		
		$msg = "Your change is now live.";

		$progress->completeStep("brand" ,$_SESSION['profile_account_id']);

	}else{
		$msg = "The brand name already exists";
	}


	if($ret_page != '' && $ret_page != 'brand'){
		header('Location: '.$ret_page.".php?msg=".$msg."&vend_man_id=".$vend_man_id);	
	}	

}


if(isset($_POST["edit_brand"])){

	$brand_id = $_POST["brand_id"];
	$name = addslashes($_POST['name']);
	$short_name = addslashes($_POST['short_name']);
	
	 
	$web_site =addslashes($_POST["web_site"]); 
	$vend_man_ids = isset($_POST["vend_man_ids"]) ? $_POST["vend_man_ids"] : 0;

	$sql = sprintf("UPDATE brand SET 
					name = '%s'
					,short_name = '%s'
					,web_site = '%s'
				   WHERE brand_id = '%u'", 
					$name
					,$short_name
					,$web_site
					,$brand_id);
	
	$result = $dbCustom->getResult($db,$sql);
	

	$sql = "DELETE FROM vend_man_brand 
			WHERE brand_id = '".$brand_id."'";
	$result = $dbCustom->getResult($db,$sql);	
	if(is_array($vend_man_ids)){
		foreach($vend_man_ids as $value){
			$sql = "INSERT INTO vend_man_brand 
					(vend_man_id, brand_id) 
					VALUES( '".$value."', '".$brand_id."')";
			$result = $dbCustom->getResult($db,$sql);			
		}
	}

	$msg = "Your change is now live.";
	
	$progress->completeStep("brand" ,$_SESSION['profile_account_id']);

}

if(isset($_POST["del_brand"])){

	$brand_id = $_POST["del_brand_id"];
	//echo "accessory_cat_id".$accessory_cat_id;
	//exit;

	$sql = "SELECT vend_man_id FROM vend_man_brand WHERE brand_id = '".$brand_id."'";
	$result = $dbCustom->getResult($db,$sql);
	
	while($row = $result->fetch_object()){
		
	}

	$sql = "UPDATE item
			SET brand_id = '0' 
			WHERE brand_id = '".$brand_id."'";
	$result = $dbCustom->getResult($db,$sql);
	


	$sql = "DELETE FROM vend_man_brand WHERE brand_id = '".$brand_id."'";
	$result = $dbCustom->getResult($db,$sql);
	
	
	$sql = "DELETE FROM brand WHERE brand_id = '".$brand_id."'";
	$result = $dbCustom->getResult($db,$sql);
	

	$msg = "Your change is now live.";

}


if(isset($_POST['set_active'])){

	$actives = (isset($_POST["active"]))? $_POST["active"] : array();
	
	$sql = "UPDATE brand SET active = '0' WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);
		
	foreach($actives as $value){
		$sql = "UPDATE brand SET active = '1' WHERE brand_id = '".$value."'";
		$result = $dbCustom->getResult($db,$sql);
		
	}

}

unset($_SESSION['paging']);

unset($_SESSION['nav_bar_brands']);
unset($_SESSION['footer_nav_brands']);




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
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT name 
			FROM vend_man
			WHERE vend_man_id = '".$vend_man_id."'";
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){
		$obj = $result->fetch_object();
		$page_title .= " for vandor: ".$obj->name; 		
	}


if(!$strip){ 
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');


	
	echo "<div class='manage_side_nav'>";

	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php');
	
	echo "</div>";
	echo "<div class='manage_main'>";	
    echo "<div class='manage_main'>";

			require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
			$bread_crumb = new AdminBreadCrumb;
			$bread_crumb->reSet();
			$bread_crumb->add("Product Catalog", $ste_root."manage/catalog/catalog-landing.php");
			$bread_crumb->add("Brand", $ste_root."manage/catalog/attributes/brand.php");
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

$rows_per_page = 16;

$db = $dbCustom->getDbConnect(CART_DATABASE);

if($vend_man_id){
	$sql = "SELECT * FROM brand, vend_man_brand 
		WHERE vend_man_brand.brand_id = brand.brand_id 
		AND vend_man_brand.vend_man_id = '".$vend_man_id."' 
		AND brand.profile_account_id = '".$_SESSION['profile_account_id']."'";
	$nmx_res = $dbCustom->getResult($db,$sql);
	
	
	$total_rows = $nmx_res->num_rows;
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
		$sql .= " ORDER BY name".$limit;					
	}
					
	$result = $dbCustom->getResult($db,$sql);	


}else{
	
	$sql = "SELECT * FROM brand 
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";		
	$nmx_res = $dbCustom->getResult($db,$sql);
	
	
	$total_rows = $nmx_res->num_rows;
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
		$sql .= " ORDER BY name".$limit;					
	}

					
	$result = $dbCustom->getResult($db,$sql);	

	
}


		$url_str= $ste_root.'manage/catalog/attributes/brand.php';
$url_str = preg_replace('/(\/+)/','/',$url_str);

$url_str .= "?strip=".$strip;
$url_str .= "&vend_man_id=".$vend_man_id;
$url_str .= "&pagenum=".$pagenum;
$url_str .= "&sortby=".$sortby;
$url_str .= "&a_d=".$a_d;
$url_str .= "&truncate=".$truncate;

?>
<form name="form" action="<?php echo $url_str; ?>" method="post" enctype="multipart/form-data">
	<input type="hidden" name="set_active" value="1">

	<?php if($admin_access->product_catalog_level > 1){ 
	
		$url_str= $ste_root.'manage/catalog/attributes/add-brand.php';
$url_str = preg_replace('/(\/+)/','/',$url_str);

		$url_str .= "?strip=".$strip;
		$url_str .= "&vend_man_id=".$vend_man_id;
		$url_str .= "&pagenum=".$pagenum;
		$url_str .= "&sortby=".$sortby;
		$url_str .= "&a_d=".$a_d;
		$url_str .= "&truncate=".$truncate;

	?>       
		<div class="page_actions">
			<a class="btn btn-large btn-primary <?php if(!$strip) echo "fancybox fancybox.iframe"; ?>"
                href="<?php echo $url_str; ?>">
        <i class="icon-plus icon-white"></i> Add a New Brand </a>
        <button href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </button>
    </div>
<?php
	}
	
if($total_rows > $rows_per_page){
	echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "catalog/attributes/brand.php", $sortby, $a_d);
	echo "<br /><br /><br />";
}


if($result->num_rows < 1){
	echo "No brands";	
}

?>



<div class="data_table">



<?php require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/tablesort.php"); ?>
	<table cellpadding="10" cellspacing="0">
		<thead>
			<tr>
				<th <?php addSortAttr('name',true); ?>>
                    Brand Name
                   <i <?php addSortAttr('name',false); ?>></i>
                </th>
				<th width="22%">Web Site</th>
				<th width="22%">Vendors</th>
				<th width="12%">Active</th>                
				<th width="12%">Edit</th>
				<th width="5%">Delete</th>
			</tr>
		</thead>
        
        
<?php
	  $j =  0;
    $block = '';
    
	
	//echo "num_rows: ".$result->num_rows;
	
	while($row = $result->fetch_object()) {
    	$j =  $j +1;
        $block .= "<tr>"; 
		$block .= "<td><strong>".stripslashes($row->name)."</strong></td>";
		$block .= "<td>".stripslashes($row->web_site)."</td>";
		
		
		$sql = "SELECT name 
				FROM vend_man, vend_man_brand 
				WHERE vend_man_brand.vend_man_id = vend_man.vend_man_id  
				AND vend_man_brand.brand_id = '".$row->brand_id."'";
				
		$res = $dbCustom->getResult($db,$sql);		
		$block .= "<td valign='middle' >";
    	while($v_row = $res->fetch_object()){
			$block .= stripslashes($v_row->name).", ";
		}
		
		$block .= "</td>";

        
		//Active
		$status = ($row->active)? "checked='checked'" : '';
		$block .= "<td><div class='checkboxtoggle on'> 
		<span class='ontext'>ON</span><a class='switch on' href='#'></a>
		<span class='offtext'>OFF</span><input type='checkbox' class='checkboxinput' name='active[]' value='".$row->brand_id."' $status />
		</div></td>";
	
		$disabled = ($admin_access->product_catalog_level < 2)? "disabled" : '';
		$fb = (!$strip) ? "fancybox fancybox.iframe" : '';

		$url_str = "edit-brand.php";
		$url_str .= "?strip=".$strip;
		$url_str .= "&vend_man_id=".$vend_man_id;		
		$url_str .= "&brand_id=".$row->brand_id;
		$url_str .= "&pagenum=".$pagenum;
		$url_str .= "&sortby=".$sortby;
		$url_str .= "&a_d=".$a_d;
		$url_str .= "&truncate=".$truncate;
								
		//edit
		$block .= "<td><a class='btn btn-primary ".$fb." ' href='".$url_str."&vend_man_id=".$vend_man_id."'>
		<i class='icon-cog icon-white'></i> Edit</a></td>";

		//delete	
		$block .= "<td valign='middle'>
		<a class='btn btn-danger confirm ".$disabled." '>
		<i class='icon-remove icon-white'></i>
		<input type='hidden' id='".$row->brand_id."' class='itemId' value='".$row->brand_id."' /></a></td>";	
		$block .= "</tr>";
    }
	echo $block;
    
    ?>

	</table>
    
    </div>
    
    </form>
	<?php
	if($total_rows > $rows_per_page){
		echo getPagination($total_rows, $rows_per_page, $pagenum, $last, "catalog/attributes/brand.php", $sortby, $a_d);
	}
	?>
    
    
	</div>

  
   <?php
	if(!$strip){ 	
		echo "</div>
		<p class='clear'></p>";
		 
		require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
	
	}	
	echo "</div>";
	
	$url_str = "brand.php";
	$url_str .= "?strip=".$strip;
	$url_str .= "&vend_man_id=".$vend_man_id;
	$url_str .= "&pagenum=".$pagenum;
	$url_str .= "&sortby=".$sortby;
	$url_str .= "&a_d=".$a_d;
	$url_str .= "&truncate=".$truncate;

	$target = ($strip) ? '_self' : '_top';

	?>

<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this brand?</h3>
	<form name="del_brand" action="<?php echo $url_str; ?>" method="post" target="<?php echo $target; ?>">
		<input id="del_brand_id" class="itemId" type="hidden" name="del_brand_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_brand" type="submit" >Yes, Delete</button>
	</form>
</div>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>
</body>
</html>


<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.shipping.php');

$shipping = new Shipping;

$progress = new SetupProgress;
$module = new Module;

$page_title = 'Custom Measurements';
$page_group = 'item';

$parent_cat_id =  (isset($_GET['parent_cat_id'])) ? $_GET['parent_cat_id'] : 0;


$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';
$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;

$sortby = (isset($_GET['sortby'])) ? trim(addslashes($_GET['sortby'])) : '';
$a_d = (isset($_GET['a_d'])) ? addslashes($_GET['a_d']) : 'a';
$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;
$truncate = (isset($_GET['truncate'])) ? addslashes($_GET['truncate']) : 1;

$search_str = (isset($_REQUEST['search_str'])) ?  trim(addslashes($_REQUEST['search_str'])) : ''; 

	

$db = $dbCustom->getDbConnect(CART_DATABASE);

if(isset($_POST['edit_cm'])){
	
}



if(isset($_POST['add_cm'])){
	
}




if(isset($_POST['del_custom_measurements_id'])){
	
	$custom_measurements_id = $_POST['del_custom_measurements_id'];

	$sql = "DELETE FROM custom_measurements 
			WHERE custom_measurements_id = '".$custom_measurements_id."'";
	//$result = $dbCustom->getResult($db,$sql);

	$msg = 'Your change is now live.';


}



require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/class.admin_bread_crumb.php');	
$bread_crumb = new AdminBreadCrumb;
//$bread_crumb->reSet();
//$bread_crumb->add("Product Catalog", $ste_root."manage/catalog/catalog-landing.php");

$bc_parent_cat_id = 0;
$bc_seo_name = '';
$db = $dbCustom->getDbConnect(CART_DATABASE);





require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>
<script>


$(document).ready(function(){
	

});


function regularSubmit() {
  document.form.submit(); 
}	

</script>
</head>

<body>
<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');
	
	
?>
<!--<a onClick="test();">TEST</a>-->
<div class="manage_page_container">
    <div class="manage_side_nav">
        <?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php');
        ?>
    </div>	
    <div class="manage_main">
		<?php 
		
		$bread_crumb->prune($page_title);
		$bread_crumb->add($page_title, $ste_root.$_SERVER['REQUEST_URI']);
		echo $bread_crumb->output();
		
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');

		$db = $dbCustom->getDbConnect(CART_DATABASE);

		$sql = "SELECT custom_measurements_id 
					,name
					,email
					,city	
			FROM  custom_measurements 
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
		
		
		
		if($search_str != ''){
			$sql .= " AND name like '%".$search_str."%'";
		}

		$nmx_res = $dbCustom->getResult($db,$sql);
		

		$total_rows = $nmx_res->num_rows;
		$rows_per_page = 12;
		
		$last = ceil($total_rows/$rows_per_page); 
		
		if($last == 0) $last = 1;
			
		if ($pagenum > $last){ 
			$pagenum = $last; 
		}
		if ($pagenum < 1){ 
			$pagenum = 1; 
		}
		
		
		//echo "last".$last;
			
		$limit = ' limit ' .($pagenum - 1) * $rows_per_page.','.$rows_per_page;
		
		// OR same thing with
		//$limit = ' limit '.$rows_per_page.' OFFSET '.($pagenum - 1) * $rows_per_page;
		
		
		
		if($sortby != ''){
			if($sortby == 'name'){
				if($a_d == 'd'){
					$sql .= " ORDER BY item.name DESC".$limit;
				}else{
					$sql .= " ORDER BY item.name".$limit;		
				}
			}
			
			
			if($sortby == 'email'){
				if($a_d == 'd'){
					$sql .= " ORDER BY email DESC".$limit;
				}else{
					$sql .= " ORDER BY email".$limit;		
				}
			}
			
			
			
			if($sortby == 'city'){
				if($a_d == 'd'){
					$sql .= " ORDER BY city DESC".$limit;
				}else{
					$sql .= " ORDER BY city".$limit;		
				}
			}
			
			
		}else{
			$sql .= " ORDER BY name".$limit;
		}
		
		
		//echo $sql;
		
		$result = $dbCustom->getResult($db,$sql);		
		

		$url_str= "custom-measurements.php";
		$url_str.= "?pagenum=".$pagenum;
		$url_str.= "&sortby=".$sortby;
		$url_str.= "&a_d=".$a_d;
		$url_str.= "&truncate=".$truncate;


		?>
			<div class="page_actions">
				<div class="search_bar">
				
                <form id="search_form" name="search_form" action="<?php echo $url_str; ?>" method="post" enctype="multipart/form-data">
                    <input type="text" name="search_str" class="searchbox" placeholder="Find a Product" />
                    <button type="submit" class="btn btn-primary btn-large" value="search"><i class="icon-search icon-white"></i></button>
                </form>
                </div>
			  	<?php
                if($admin_access->product_catalog_level > 1){ 
					
					$url_str= "custom-measurements.php";
					
					?>
					<a class="btn btn-large btn-primary" href="<?php echo $url_str; ?>">List All Custom Measurements </a>            
					
					<?php
					$url_str= "add-cm.php";
					$url_str.= "?pagenum=".$pagenum;
					$url_str.= "&sortby=".$sortby;
					$url_str.= "&a_d=".$a_d;
					$url_str.= "&truncate=".$truncate;
					$url_str.= "&search_str=".$search_str;
					?>
					<a class="btn btn-large btn-primary" href="<?php echo $url_str; ?>"><i class="icon-plus icon-white"></i> Add Custom Measurements </a>            
					<!--
              		<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </a>
                    -->

            	<?php } ?>
            </div>
	
    
       	<?php

		$url_str= "custom-measurements.php";
		$url_str.= "?pagenum=".$pagenum;
		$url_str.= "&sortby=".$sortby;
		$url_str.= "&a_d=".$a_d;
		$url_str.= "&truncate=".$truncate;
		?>
    	<form name="form" action="<?php echo $url_str; ?>" method="post" enctype="multipart/form-data">
	        <input type="hidden" name="set_active" value="1">

    		<div class="data_table clearfix">
				<div class="pagination">
       				<?php
					if($total_rows > $rows_per_page){
					 echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "catalog/products/custom-measurements.php", $sortby, $a_d,0,0, $search_str,0,0,$strip);
					}
					 ?>
				</div>
				<?php require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/tablesort.php"); ?>		
            	<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
							<th width="2%"></th>
							<th width="7%">Image</th>
           					<th <?php addSortAttr('name',true); ?>>
                            Name
                            <i <?php addSortAttr('name',false); ?>></i>
                            </th>

           					<th <?php addSortAttr('email',true); ?>>
                            email
                            <i <?php addSortAttr('email',false); ?>></i>
                            </th>
							
							<th width="10%" <?php addSortAttr('city',true); ?>>
                            City
                            <i <?php addSortAttr('city',false); ?>></i>
                            </th>
							
							<th width="11%">Edit</th>
							<th width="5%">Delete</th>
						</tr>
					</thead>
					<tbody>
    <?php 
	$items_from_this_page = '';

    $block = '';
	while($row = $result->fetch_object()) {
	
		$block .= "<tr>";
		$block .= "<td>".$row->name."</td>";
		$block .= "<td>".$row->email."</td>";
		$block .= "<td>".$row->city."</td>";




			
			$url_str= "edit-custom-measurements.php";
			$url_str.= "?custom_measurements_id=".$row->custom_measurements_id;
			$url_str.= "?pagenum=".$pagenum;
			$url_str.= "&sortby=".$sortby;
			$url_str.= "&a_d=".$a_d;
			$url_str.= "&truncate=".$truncate;
			$url_str.= "&search_str=".$search_str;
			$block .= "<td><a class='btn btn-primary btn-small' 
			href='".$url_str."'><i class='icon-cog icon-white'></i> Edit</a></td>";
			
			
			//delete				
			$block .= "<td valign='middle'>
			<a class='btn btn-danger confirm ".$disabled." '>
			<i class='icon-remove icon-white'></i>
			<input type='hidden' id='".$row->custom_measurements_id."' class='itemId' value='".$row->custom_measurements_id."' /></a></td>";
			
			$block .= "</tr>";

			
			
			
	
	}
   echo  $block;
    ?>

					</tbody>
				</table>
       				<?php
					if($total_rows > $rows_per_page){
					 echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "catalog/products/custom-measurements.php", $sortby, $a_d,0,0, $search_str,0,0,$strip);
					}
					 ?>

			</div>
           	<input type="hidden" name="items_from_this_page" value="<?php echo $items_from_this_page; ?>">                 
            </form>
		


  </div>
  <p class="clear"></p>
  <?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
	$url_str= "custom-measurements.php";
	$url_str.= "?pagenum=".$pagenum;
	$url_str.= "&sortby=".$sortby;
	$url_str.= "&a_d=".$a_d;
	$url_str.= "&truncate=".$truncate;
	$url_str.= "&search_str=".$search_str;
	?>
</div>
<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete these custom measurements?</h3>
	<form name="del_custom_measurements_form" action="<?php echo $url_str; ?>" method="post" target="_top">
		<input id="del_custom_measurements_id" class="itemId" type="hidden" name="del_custom_measurements_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_page" type="submit" >Yes, Delete</button>
	</form>
</div>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>

</body>
</html>
<?php 

/*
        $block .= "<td valign='top'>";
		$sql = "SELECT star_count
				FROM item_rating 
				WHERE item_id = '".$row->item_id."'";		
		$result = $dbCustom->getResult($db,$sql);
		
		if($res->num_rows){
			$star_obj = $result->fetch_object();
			$block .= $star_obj->star_count;			
		}else{
			$block .= "not rated";
		}
		$block .= "</td>";
*/



 ?>

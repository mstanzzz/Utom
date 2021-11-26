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


$page_title = "Shipping Carriers";
$page_group = "ship";

	

$db = $dbCustom->getDbConnect(CART_DATABASE);

//$sas_cust_id =  (isset($_REQUEST['sas_cust_id'])) ? $_REQUEST['sas_cust_id'] : 0;

$msg = '';

$sql = "SELECT ship_carrier_id 
		FROM ship_carrier
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows == 0){

	$sql = "SELECT * 
			FROM ship_carrier
			WHERE profile_account_id = '1'";
$result = $dbCustom->getResult($db,$sql);	
	while($row = $result->fetch_object()){
		
		
		$sql = "INSERT INTO ship_carrier
				(name
				,code
				,profile_account_id
				)VALUES(
				'".$row->name."'
				,'".$row->code."'
				,'".$_SESSION['profile_account_id']."')";
	
		$res = $dbCustom->getResult($db,$sql);
	}
}



if(isset($_POST['set_active'])){

	$actives = (isset($_POST["active"]))? $_POST["active"] : array();

	$sql = "UPDATE ship_carrier SET active = '0' WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);	

	if(is_array($actives)){	
		foreach($actives as $key => $value){
			$sql = "UPDATE ship_carrier SET active = '1' WHERE ship_carrier_id = '".$value."'";
			$result = $dbCustom->getResult($db,$sql);
			
			//echo "key: ".$key."   value: ".$value."<br />"; 
		}
	}

	
	$msg = "The carriers have been selected";

}

require_once($real_root.'/manage/admin-includes/doc_header.php'); 
?>
<script>
function regularSubmit() {
  document.form.submit(); 
}	
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
    <div class="manage_main">
		<?php
		require_once($real_root."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->prune("Shiping Carriers");
		$bread_crumb->add("Shiping Carriers", SITEROOT."/manage/ecomsettings/ship-carrier.php");
		
		
		echo $bread_crumb->output();
 
        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');
        
		//faq section tabbed sub-navigation
        require_once($real_root."/manage/admin-includes/shipping-section-tabs.php");
		?>
        Note: UPS is the only one that can be used at this time. 
		<form name="form" name="select_carrier_form" action="ship-carrier.php" method="post" enctype="multipart/form-data">
        	<input type="hidden" name="set_active" value="1">
			<div class="page_actions">
				<?php if($admin_access->ecommerce_level > 1){ ?>
                <a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </a> 
				<?php
				}
				$db = $dbCustom->getDbConnect(USER_DATABASE);
				$sql = "SELECT is_shipping_charges  
						FROM profile_account
						WHERE id = '".$_SESSION['profile_account_id']."'";
		$result = $dbCustom->getResult($db,$sql);				
				$s_obj = $result->fetch_object();
				if(!$s_obj->is_shipping_charges){ ?>
					<div class="alert"><span class="fltlft"><i class="icon-warning-sign"></i></span>This company does not charge shipping. To change this, please contact the administrator.</div>
				<?php 
				}else{
				?>

			</div>
			<?php

			$sortby = (isset($_GET['sortby'])) ? trim(mysql_escape_string($_GET['sortby'])) : '';
			$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
			
			$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;
			
			$truncate = (isset($_GET['truncate'])) ? addslashes($_GET['truncate']) : 1;
			
			$db = $dbCustom->getDbConnect(CART_DATABASE);
				
			$sql = "SELECT ship_carrier_id, name, active 
					FROM ship_carrier
					WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
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
				if($sortby == 'active'){
					if($a_d == 'd'){
						$sql .= " ORDER BY active DESC".$limit;
					}else{
						$sql .= " ORDER BY active".$limit;	
					}
				}
				
				
			}else{
				$sql .= " ORDER BY name".$limit;					
			}
							
	$result = $dbCustom->getResult($db,$sql);			
						
			if($total_rows > $rows_per_page){
				echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "ecomsettings/ship-carrier.php", $sortby, $a_d);
				echo "<br /><br /><br />";
			}

			?>
			<div class="data_table">
            	<?php require_once($real_root."/manage/admin-includes/tablesort.php"); ?>
				<table cellpadding="10" cellspacing="0">
            		<thead>
						<tr>
                            <th <?php addSortAttr('name',true); ?>>
                            	Carrier
                            	<i <?php addSortAttr('name',false); ?>></i>
                       		</th>
 
                            <th <?php addSortAttr('active',true); ?>>
                            	Active
                            	<i <?php addSortAttr('active',false); ?>></i>
                       		</th>

						</tr>
					</thead>
					<?php
					$block = '';
					while($row = $result->fetch_object()) {
						$block .= "<tr>";
						$checked = ($row->active)? "checked='checked'" : '';
						$block .= "<td>".$row->name."</td>";
						//active
						$disabled = ($admin_access->ecommerce_level < 2)? "disabled" : '';
						$block .= "<td><div class='checkboxtoggle on ".$disabled."'> 
						<span class='ontext'>ON</span><a class='switch on' href='#'></a>
						<span class='offtext'>OFF</span>
						<input type='checkbox' class='checkboxinput' name='active[]' value='".$row->ship_carrier_id."' $checked /></div></td>";	
						$block .= "</tr>";	
					}
					
					echo $block;
			
					?>
				</table>
			<?php } ?>
		</div>
	</form>


</div><p class="clear"></p>
    <?php 
    require_once($real_root.'/manage/admin-includes/manage-footer.php');
    ?>
</div>

    

</body>
</html>


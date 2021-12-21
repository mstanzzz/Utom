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

//$progress = new SetupProgress;
$module = new Module;

$page_title = "Shipping Methods";
$page_group = "ship";

	

$db = $dbCustom->getDbConnect(CART_DATABASE);

//$sas_cust_id =  (isset($_REQUEST['sas_cust_id'])) ? $_REQUEST['sas_cust_id'] : 0;

$msg = '';


/*
$sql = "SELECT ship_method_id, profile_account_id, name 
		FROM ship_method
		WHERE ship_carrier_id = '1'";
$result = $dbCustom->getResult($db,$sql);

while($row = $result->fetch_object()){
	echo $row->profile_account_id."     ".$row->name."<br />";

}


exit;
*/


if($_SESSION['profile_account_id'] > 1){
	
	$sql = "SELECT ship_method_id 
			FROM ship_method
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows == 0){
	
		$sql = "SELECT * 
				FROM ship_method
				WHERE profile_account_id = '1'";
		$result = $dbCustom->getResult($db,$sql);	
		$object = $result->fetch_object();
		
		
		while($row = $result->fetch_object()){
					
		
		
		
			$sql = "SELECT ship_carrier_id 
					FROM ship_carrier, ship_method
					WHERE ship_carrier.ship_carrier_id = ship_method.ship_carrier_id
					AND ship_carrier.profile_account_id = '".$_SESSION['profile_account_id']."'";
			$res = $dbCustom->getResult($db,$sql);
			
			
			if($res->num_rows > 0){
				$obj = $res->fetch_object();
				$this_ship_carrier_id = $obj->ship_carrier_id;
			}else{
			
				$sql = "SELECT name, code
						FROM ship_method
						WHERE ship_method_id= '".$object->ship_method_id."'";
				$m_res = $dbCustom->getResult($db,$sql);	
				$m_obj = $m_res->fetch_object(); 
				
					
				$sql = "INSERT INTO ship_carrier
						(name
						,code 
						,profile_account_id
						)VALUES(
						'".$m_obj->name."'
						,'".$m_obj->code."'
						,'".$_SESSION['profile_account_id']."')";
				$res = $dbCustom->getResult($db,$sql);	
				
			}
	
					
					
					
			$sql = "INSERT INTO ship_method
					(ship_carrier_id 
					,code 
					,name 
					,profile_account_id
					)VALUES(
					'".$ups_ship_carrier_id."'
					,'".$row->code."'
					,'".$row->name."'
					,'".$_SESSION['profile_account_id']."')";
			$res = $dbCustom->getResult($db,$sql);
		}
	}
}


if(isset($_POST['set_active'])){

	$actives = (isset($_POST["active"]))? $_POST["active"] : array();

	$sql = "UPDATE ship_method SET active = '0' WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);	

	if(is_array($actives)){	
		foreach($actives as $key => $value){
			$sql = "UPDATE ship_method SET active = '1' WHERE ship_method_id = '".$value."'";
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
		$bread_crumb->prune("Shiping Method");
		$bread_crumb->add("Shiping Method", SITEROOT."manage/ecomsettings/ship-method.php");
		
		echo $bread_crumb->output();
		
        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');
        
		//shipping section tabbed sub-navigation
        require_once($real_root."/manage/admin-includes/shipping-section-tabs.php");
		?>
		<form name="form" action="ship-method.php" method="post">
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
				if(!$s_obj->is_shipping_charges){
					
					echo "<br /><br />This company does not charge shipping. To change this, please contact the administrator";	
				}else{
					 
				?>  
			</div>
            <?php
            $sortby = (isset($_GET['sortby'])) ? trim($_GET['sortby']) : '';
			$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
			
			$pagenum = (isset($_GET['pagenum'])) ? $_GET['pagenum'] : 0;
			
			$truncate = (isset($_GET['truncate'])) ? $_GET['truncate'] : 1;
			
			$db = $dbCustom->getDbConnect(CART_DATABASE);
				
			$sql = "SELECT ship_carrier.name 
					AS carrier_name
					,ship_method.ship_method_id
					,ship_method.name AS method_name
					,ship_method.active
					,ship_method.code 
					FROM ship_method, ship_carrier 
					WHERE ship_method.ship_carrier_id = ship_carrier.ship_carrier_id
					AND ship_method.profile_account_id = '".$_SESSION['profile_account_id']."'
					";
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
				if($sortby == 'carrier_name'){
					if($a_d == 'd'){
						$sql .= " ORDER BY carrier_name DESC".$limit;
					}else{
						$sql .= " ORDER BY carrier_name".$limit;	
					}
				}
				if($sortby == 'method_name'){
					if($a_d == 'd'){
						$sql .= " ORDER BY method_name DESC".$limit;
					}else{
						$sql .= " ORDER BY method_name".$limit;	
					}
				}
				if($sortby == 'active'){
					if($a_d == 'd'){
						$sql .= " ORDER BY ship_method.active DESC".$limit;
					}else{
						$sql .= " ORDER BY ship_method.active".$limit;	
					}
				}
				
			}else{
				$sql .= " ORDER BY ship_method.ship_carrier_id, ship_method.ship_method_id".$limit;					
			}
							
	$result = $dbCustom->getResult($db,$sql);			
						
			if($total_rows > $rows_per_page){
				echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "ecomsettings/ship-method.php", $sortby, $a_d);
				echo "<br /><br /><br />";
			}

			
			
			?>
            
			<div class="data_table">
           	 	<?php require_once($real_root."/manage/admin-includes/tablesort.php"); ?>
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
                            <th width="10%" <?php addSortAttr('carrier_name',true); ?>>
                            	Carrier
                            	<i <?php addSortAttr('carrier_name',false); ?>></i>
                       		</th>
                            <th <?php addSortAttr('method_name',true); ?>>
                            	Method
                            	<i <?php addSortAttr('method_name',false); ?>></i>
                       		</th>
                            <th width="15%" <?php addSortAttr('active',true); ?>>
                            	Active
                            	<i <?php addSortAttr('active',false); ?>></i>
                       		</th>
						</tr>
					</thead>
					<?php
						$block = '';
						$j = 0;
						while($row = $result->fetch_object()) {
							$j =  $j +1;
						   	$block .= "<tr>"; 
							$checked = ($row->active)? "checked" : '';
							$block  .= "<td class='".$row->carrier_name."'>".$row->carrier_name."</td>";			 
							$block  .= "<td>".$row->method_name."  =>  ".$row->code."</td>";
							$disabled = ($admin_access->ecommerce_level < 2)? "disabled" : '';
							$block .= "<td><div class='checkboxtoggle on ".$disabled."'> 
							<span class='ontext'>ON</span><a class='switch on' href='#'></a>
							<span class='offtext'>OFF</span>
							<input type='checkbox' class='checkboxinput' name='active[]' value='".$row->ship_method_id."' $checked /></div></td>";	

						}
						echo $block .="</table>";
					?>
				</table>
				<?php 
								
					if($total_rows > $rows_per_page){
						echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "ecomsettings/ship-method.php", $sortby, $a_d);
						echo "<br /><br /><br />";
					}
				} 
				?>    
			</div>
		</form>
    </div>
<p class="clear"></p>
    <?php 
    require_once($real_root.'/manage/admin-includes/manage-footer.php');
    ?>
</div>
    
	<div style="display:none">
        <div id="edit" style="width:760px; height:400px;">
        </div>
    </div>

</body>
</html>


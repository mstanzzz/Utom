<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Shipping Flat Charge Options";
$page_group = "ship";

	

$db = $dbCustom->getDbConnect(CART_DATABASE);

//$sas_cust_id =  (isset($_REQUEST['sas_cust_id'])) ? $_REQUEST['sas_cust_id'] : 0;

$msg = '';

if(isset($_POST["edit_ship_flat_charge"])){
	
	$ship_flat_charge_id = $_POST["ship_flat_charge_id"];
	$low = trim(addslashes($_POST["low"]));
	$high = trim(addslashes($_POST["high"]));
	$charge = trim(addslashes($_POST["charge"]));
	$description = trim(addslashes($_POST['description']));

//echo $ship_flat_charge_id;


	$sql = sprintf("UPDATE ship_flat_charge SET
					low = '%f'
					,high = '%f'
					,charge = '%f'
					,description = '%s'
					WHERE ship_flat_charge_id = '%u'",
					$low, $high, $charge, $description, $ship_flat_charge_id);
$result = $dbCustom->getResult($db,$sql);	
}


if(isset($_POST["add_ship_flat_charge"])){
	
	$low = trim(addslashes($_POST["low"]));
	$high = trim(addslashes($_POST["high"]));
	$charge = trim(addslashes($_POST["charge"]));
	
	$description = trim(addslashes($_POST['description']));

	$sql = sprintf("INSERT INTO ship_flat_charge( 
					low
					,high
					,charge
					,description ,profile_account_id
					)VALUES(
					'%f'
					,'%f'
					,'%f'
					,'%s'
					,'%u'
					)",
					$low, $high, $charge, $description, $_SESSION['profile_account_id']);
$result = $dbCustom->getResult($db,$sql);	

}



if(isset($_POST["del_ship_flat_charge_id"])){
	
	$del_ship_flat_charge_id = $_POST["del_ship_flat_charge_id"];
	$sql = "DELETE FROM ship_flat_charge WHERE ship_flat_charge_id = '".$del_ship_flat_charge_id."'";
$result = $dbCustom->getResult($db,$sql);	

}



if(isset($_POST['set_active'])){

	$actives = (isset($_POST["active"]))? $_POST["active"] : array();

	$sql = "UPDATE ship_flat_charge SET active = '0' WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);	

	if(is_array($actives)){	
		foreach($actives as $key => $value){
			$sql = "UPDATE ship_flat_charge SET active = '1' WHERE ship_flat_charge_id = '".$value."'";
			$result = $dbCustom->getResult($db,$sql);		
			//echo "key: ".$key."   value: ".$value."<br />"; 
		}
	}

	
	$msg = "The carriers have been selected";

}



require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>
<script>
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
<div class="manage_page_container">
    <div class="manage_side_nav">
        <?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php');
        ?>
    </div>	
    <div class="manage_main">
		<?php 
		require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->add("Shiping Flat Charge", $ste_root."manage/ecomsettings/ship-flat-charge.php");
		$bread_crumb->prune("Shiping Flat Charge");
		echo $bread_crumb->output();
		
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
        
		//faq section tabbed sub-navigation
        require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/shipping-section-tabs.php");
		?>
		<form name="form" action="ship-flat-charge.php" method="post" onSubmit="return validate(this)" enctype="multipart/form-data">
        	<input type="hidden" name="set_active" value="1">
			<div class="page_actions">
            	<?php if($admin_access->ecommerce_level > 1){ ?>
				<a href="#" class="btn btn-primary btn-large confirm confirm-add"><i class="icon-plus icon-white"></i> Add New Flat Shipping Charge</a>
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
				<?php }else{ ?>

			</div>

			<?php


			$sortby = (isset($_GET['sortby'])) ? trim(mysql_escape_string($_GET['sortby'])) : '';
			$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
			
			$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;
			
			$truncate = (isset($_GET['truncate'])) ? addslashes($_GET['truncate']) : 1;
			
			$db = $dbCustom->getDbConnect(CART_DATABASE);
				
			$sql = "SELECT ship_flat_charge_id, low, high, charge, active 
					FROM ship_flat_charge
					WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
			$nmx_res = $dbCustom->getResult($db,$sql);
			
			
			$t_array = array();
			
			$i = 0;
			while($r = $nmx_res->fetch_object()){
				$t_array[$i]['low'] = $r->low;
				$t_array[$i]['high'] = $r->high;
				$t_array[$i]['active'] = $r->active;
				$t_array[$i]['ship_flat_charge_id'] = $r->ship_flat_charge_id; 
				$i++;
			}
			
			
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
				if($sortby == 'low'){
					if($a_d == 'd'){
						$sql .= " ORDER BY low DESC".$limit;
					}else{
						$sql .= " ORDER BY low".$limit;	
					}
				}
				if($sortby == 'high'){
					if($a_d == 'd'){
						$sql .= " ORDER BY high DESC".$limit;
					}else{
						$sql .= " ORDER BY high".$limit;	
					}
				}
				if($sortby == 'charge'){
					if($a_d == 'd'){
						$sql .= " ORDER BY charge DESC".$limit;
					}else{
						$sql .= " ORDER BY charge".$limit;	
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
				$sql .= " ORDER BY high".$limit;					
			}
							
			$result = $dbCustom->getResult($db,$sql);			
						
			if($total_rows > $rows_per_page){
				echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "ecomsettings/ship-flat-charge.php", $sortby, $a_d);
				echo "<br /><br /><br />";
			}

			?>


			<div class="data_table">
            	<?php require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/tablesort.php"); ?>
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
                            <th <?php addSortAttr('low',true); ?>>
                            	From Order Total
                            	<i <?php addSortAttr('low',false); ?>></i>
                       		</th>
                            <th <?php addSortAttr('high',true); ?>>
                            	To Order Total
                            	<i <?php addSortAttr('high',false); ?>></i>
                       		</th>
                            <th <?php addSortAttr('charge',true); ?>>
                            	Shipping Charge
                            	<i <?php addSortAttr('charge',false); ?>></i>
                       		</th>
                            <th width="15%" <?php addSortAttr('active',true); ?>>
                            	Active
                            	<i <?php addSortAttr('active',false); ?>></i>
                       		</th>
							<th width="12%">Edit</th>
							<th width="6%">Delete</th>
						</tr>
					</thead>    
					  <?php
						$j = 0;
						$block = '';
						while($row = $result->fetch_object()) {
							
							
							foreach($t_array as $tv){
								if(($row->low >= $tv['low'] && $row->low <= $tv['high']) ||  ($row->high <= $tv['high'] && $row->high >= $tv['low'])){
									
									if( ($row->ship_flat_charge_id != $tv['ship_flat_charge_id']) && ($row->active == 1) && ($tv['active'] == 1)){
										$block .= "<tr><td colspan='6'><span style='color:red'>Overlap detected with interval: ".$tv['low']." -- ".$tv['high']."  </span></td></tr>";
										$block .= "<tr><td colspan='6'><span style='color:red'>This could cause unintended shipping charges</span></td></tr>";
									}
								}
							}
							
							
							
							
							$checked = ($row->active)? "checked='checked'" : '';
				   			$j =  $j +1;
							$block .= "<tr>";
				
							$block .= "<td>$".number_format($row->low,2)."</td>";
							
							$block .= "<td>$".number_format($row->high,2)."</td>";
							
							$block .= "<td>$".number_format($row->charge,2)."</td>";
							
							$disabled = ($admin_access->ecommerce_level < 2)? "disabled" : '';
							
							$block .= "<td><div class='checkboxtoggle on ".$disabled." '> 
							<span class='ontext'>ON</span><a class='switch on'></a>
							<span class='offtext'>OFF</span>
							<input type='checkbox' class='checkboxinput' name='active[]' value='".$row->ship_flat_charge_id."' $checked /></div></td>";	
							//edit 
							$block .="<td><a class='btn btn-primary btn-small fancybox fancybox.iframe' href='edit-ship-flat-charge.php?ship_flat_charge_id=".$row->ship_flat_charge_id."&ret_page=ship-type'><i class='icon-cog icon-white'></i> Edit</a></td>";
							//delete
							$block .= "<td valign='middle'>
							<a class='btn btn-danger confirm ".$disabled."'>
							<i class='icon-remove icon-white'></i>
							<input type='hidden' id='".$row->ship_flat_charge_id."' class='itemId' value='".$row->ship_flat_charge_id."' /></a></td></tr>";
						}
						echo $block;				
					?>
				</table>
				<?php 
					if($total_rows > $rows_per_page){
						echo getPagination($total_rows, $rows_per_page, $pagenum, $last, "ecomsettings/ship-flat-charge.php", $sortby, $a_d);
						echo "<br /><br /><br />";
					}


				} 
				?>
                
                
                
			</div>
    </form>
	</div>
  <p class="clear"></p>
  <?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
    ?>
</div>
<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this shipping charge?</h3>
	<form name="del_flat_charge_form" action="ship-flat-charge.php" method="post" target="_top">
		<input id="del_ship_flat_charge_id" class="itemId" type="hidden" name="del_ship_flat_charge_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_ship_flat_charge" type="submit" >Yes, Delete</button>
	</form>
</div>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>
	<!-- New Add Dialogue -->
	<div id="content-add" class="confirm-content">
		<form name="add_flat_charge_form" action="ship-flat-charge.php" method="post" target="_top">
			<fieldset class="colcontainer">
				<legend>Add New Shipping Flat Charge</legend>
				<label>From Order Total</label>
				<input type="text" name="low" />
				<label>To Order Total</label>
				<input type="text" name="high" />
				<label>Shipping Charge</label>
				<input type="text" name="charge" />
				<label>Description</label>
				<textarea name="description" rows="2" cols="20"></textarea>
			</fieldset>
			<a class="btn btn-large dismiss"> Cancel </a>
			<button name="add_ship_flat_charge" type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Add </button>
		</form>
	</div>
</body>
</html>


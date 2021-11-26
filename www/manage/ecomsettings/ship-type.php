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

$page_title = "Shipping Types";
$page_group = "ship";

	

$db = $dbCustom->getDbConnect(CART_DATABASE);

//$sas_cust_id =  (isset($_REQUEST['sas_cust_id'])) ? $_REQUEST['sas_cust_id'] : 0;

$msg = '';


$sql = "SELECT ship_type_id 
		FROM ship_type
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows == 0 && $_SESSION['profile_account_id'] != 1){
	
	$sql = "SELECT * 
			FROM ship_type
			WHERE profile_account_id = '1'";
	$result = $dbCustom->getResult($db,$sql);	
	while($row = $result->fetch_object()){ 
		
		$sql = "SELECT ship_type_id
				FROM ship_type
				WHERE type_name = '".$row->type_name."'";
		$check_result = mysql_query($sql);
		
		if($check_result->num_rows == 0){
		
			$sql = "INSERT INTO ship_type
					(type_name
					,flat_rate
					,percent_rate
					,profile_account_id
					)VALUES(
					'".$row->type_name."'
					,'".$row->flat_rate."'
					,'".$row->percent_rate."'
					,'".$_SESSION['profile_account_id']."')";
		
			$n_result = mysql_query($sql);
			if(!$n_result)die(mysql_error());
		}
	}
	
}

if(isset($_POST['edit_ship_type'])){
	
	$ship_type_id = isset($_POST["ship_type_id"])? $_POST["ship_type_id"] : 0;
	$flat_rate = isset($_POST["flat_rate"])? $_POST["flat_rate"] : 0;
	$percent_rate = isset($_POST["percent_rate"])? $_POST["percent_rate"] : 0;
		
	$ship_type_id = is_numeric($ship_type_id)? $ship_type_id : 0;
	$flat_rate = is_numeric($flat_rate)? $flat_rate : 0;
	$percent_rate = is_numeric($percent_rate)? $percent_rate : 0;

echo $percent_rate;

	$sql = "UPDATE ship_type 
			SET flat_rate = '".$flat_rate."', percent_rate = '".$percent_rate."' 
			WHERE ship_type_id = '".$ship_type_id."'";
	$result = $dbCustom->getResult($db,$sql);	
}



if(isset($_POST['set_active'])){

	$actives = (isset($_POST["active"]))? $_POST["active"] : array();

	$sql = "UPDATE ship_type SET active = '0'
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);	

	if(is_array($actives)){	
		foreach($actives as $key => $value){
		$sql = "UPDATE ship_type SET active = '1' WHERE ship_type_id = '".$value."'";
		$result = $dbCustom->getResult($db,$sql);		
			//echo "key: ".$key."   value: ".$value."<br />"; 
		}
	}
	
	$msg = "The carriers have been selected";
}

if(isset($_SESSION['ship_type'])){
	unset($_SESSION['ship_type']);
}

if(isset($_SESSION['shipping_cost'])){
	unset($_SESSION['shipping_cost']);
}

require_once($real_root.'/manage/admin-includes/doc_header.php'); 

?>
<script>
function validate(the_form){
	//alert(the_form.name); 	
	 var radios = the_form.elements["ship_type_id"];
	 //alert(radios.length);
	 
	 for (var i=0; i <radios.length; i++) { 
	  if (radios[i].checked) { 
	   return true 
	  } 
	 }
	 
	alert("You didn't select a ship type");	
	  
	 return false; 
}

function checkRadio (the_form, rbGroupName) { 
 var radios = the_form.elements[rbGroupName]; 
 for (var i=0; i <radios.length; i++) { 
  if (radios[i].checked) { 
   return true; 
  } 
 } 
 return false; 
} 

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
		$bread_crumb->prune("Ship Type");
		$bread_crumb->add("Ship Type", SITEROOT."manage/ecomsettings/ship-type.php");
		
		echo $bread_crumb->output();
		
        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');
        
		//faq section tabbed sub-navigation
        require_once($real_root."/manage/admin-includes/shipping-section-tabs.php");
		?>
		<form name="form" action="ship-type.php" method="post" onSubmit="return validate(this)" enctype="multipart/form-data">
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



			$db = $dbCustom->getDbConnect(CART_DATABASE);

			$sql = "UPDATE ship_type
					SET type_name = 'flat_per_order'
					WHERE type_name = 'flat per order'";
			$res = $dbCustom->getResult($db,$sql);
			

			$sql = "UPDATE ship_type
					SET type_name = 'flat_per_item'
					WHERE type_name = 'flat per item'";
			$res = $dbCustom->getResult($db,$sql);
			




			$sortby = (isset($_GET['sortby'])) ? trim(mysql_escape_string($_GET['sortby'])) : '';
			$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
			
			$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;
			
			$truncate = (isset($_GET['truncate'])) ? addslashes($_GET['truncate']) : 1;
			
				
			$sql = "SELECT ship_type_id, type_name, flat_rate, percent_rate, active 
					FROM ship_type
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
				if($sortby == 'type_name'){
					if($a_d == 'd'){
						$sql .= " ORDER BY type_name DESC".$limit;
					}else{
						$sql .= " ORDER BY type_name".$limit;	
					}
				}
				if($sortby == 'flat_rate'){
					if($a_d == 'd'){
						$sql .= " ORDER BY flat_rate DESC".$limit;
					}else{
						$sql .= " ORDER BY flat_rate".$limit;	
					}
				}
				if($sortby == 'percent_rate'){
					if($a_d == 'd'){
						$sql .= " ORDER BY percent_rate DESC".$limit;
					}else{
						$sql .= " ORDER BY percent_rate".$limit;	
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
				$sql .= " ORDER BY type_name".$limit;					
			}
							
	$result = $dbCustom->getResult($db,$sql);			
						
			if($total_rows > $rows_per_page){
				echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "ecomsettings/ship-type.php", $sortby, $a_d);
				echo "<br /><br /><br />";
			}

	
			?>
			<div class="data_table">
            	<?php require_once($real_root."/manage/admin-includes/tablesort.php"); ?>
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
                            <th <?php addSortAttr('type_name',true); ?>>
                            	Type
                            	<i <?php addSortAttr('type_name',false); ?>></i>
                       		</th>
                            <th <?php addSortAttr('flat_rate',true); ?>>
                            	Flat Rate
                            	<i <?php addSortAttr('flat_rate',false); ?>></i>
                       		</th>
                            <th <?php addSortAttr('percent_rate',true); ?>>
                            	Percent Rate
                            	<i <?php addSortAttr('percent_rate',false); ?>></i>
                       		</th>
                            
                            <th width="15%" <?php addSortAttr('active',true); ?>>
                            	Active
                            	<i <?php addSortAttr('active',false); ?>></i>
                       		</th>
							<th width="12%">Edit</th>
						</tr>
					</thead>
					  <?php
						$block = '';
						$j = 0;
						while($row = $result->fetch_object()) {
						
							 $j =  $j +1;
						   $block .= "<tr>"; 
							
							$checked = ($row->active)? "checked='checked'" : '';
							//type
							$block .= "<td>".$row->type_name."</td>";
							//flat rate
							$block .= "<td>$".$row->flat_rate."</td>";
							//percent rate
							$block .= "<td>".$row->percent_rate."%</td>";
							
							//active							
							$disabled = ($admin_access->ecommerce_level < 2)? "disabled" : '';
							
							$block .= "<td><div class='radiotoggle off ".$disabled."'>
							<span class='ontext'>ON</span>
							<a class='switch on' href='#'></a>
							<span class='offtext'>OFF</span>
							<input type='radio' class='radioinput' name='active[]' value='".$row->ship_type_id."' $checked /></div></td>";	
							
							if(stristr($row->type_name, 'unique_') === false && stristr($row->type_name, 'price_range') === false  && stristr($row->type_name, 'carrier') === false && (!$disabled)){
								//edit
								$block .= "<td><a class='btn btn-primary btn-small fancybox fancybox.iframe' 
								href='edit-ship-type.php?ship_type_id=".$row->ship_type_id."&ret_page=ship-type'><i class='icon-cog icon-white'></i> Edit</a></td>";
							}
							$block .= "</tr>";	
						}
					
						echo $block;
				
						?>
					</table>
				<?php 
					if($total_rows > $rows_per_page){
						echo getPagination($total_rows, $rows_per_page, $pagenum, $last, "ecomsettings/ship-type.php", $sortby, $a_d);
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
</body>
</html>


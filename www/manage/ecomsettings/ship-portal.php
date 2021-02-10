<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Ship Portal";
$page_group = "ship-portal";

	

$db = $dbCustom->getDbConnect(CART_DATABASE);

$parent_cat_id =  (isset($_GET['parent_cat_id'])) ? $_GET['parent_cat_id'] : 0;

$msg = '';

if(isset($_POST["add_ship_port"])){

	$name = addslashes(trim($_POST['name'])); 
	$email = addslashes(trim($_POST["email"]));
	$post_web_site = addslashes(trim($_POST["post_web_site"]));	
	$notes = addslashes(trim($_POST["notes"]));
	
	$sql = sprintf("SELECT * FROM ship_port WHERE name = '%s' AND profile_account_id = '%u'", $name, $_SESSION['profile_account_id']);	
$result = $dbCustom->getResult($db,$sql);	
	if(!$result->num_rows){
		$sql = sprintf("INSERT INTO ship_port 
					   (name, email, post_web_site, notes, profile_account_id) 
					   VALUES ('%s','%s','%s','%s','%u')", $name, $email, $post_web_site, $notes, $_SESSION['profile_account_id']);
		
		$result = $dbCustom->getResult($db,$sql);
		
		
		$msg = "Your change is now live.";

	}else{
		$msg = "The shipping portal already exists";
	}

}


if(isset($_POST["edit_ship_port"])){
	
	
	
	$name = addslashes($_POST['name']); 
	$email = addslashes(trim($_POST["email"]));
	$post_web_site = addslashes(trim($_POST["post_web_site"]));	
	$notes = addslashes(trim($_POST["notes"]));
	$ship_port_id = $_POST["ship_port_id"];
	
	//echo $name;
	
	$sql = sprintf("UPDATE ship_port 
				    SET name = '%s', email = '%s', post_web_site = '%s', notes = '%s' 
				    WHERE ship_port_id = '%u'", 
					$name, $email, $post_web_site, $notes, $ship_port_id);
	
	//echo $sql;
	$result = $dbCustom->getResult($db,$sql);
	

	$msg = "Your change is now live.";
	
}

if(isset($_POST["del_ship_port_id"])){

	$ship_port_id = $_POST["del_ship_port_id"];
	//echo "accessory_cat_id".$accessory_cat_id;
	//exit;
	$sql = sprintf("DELETE FROM ship_port WHERE ship_port_id = '%u'", $ship_port_id);
	$result = $dbCustom->getResult($db,$sql);
	

	$msg = "Your change is now live.";

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
		$bread_crumb->prune("Shiping Portal");
		$bread_crumb->add("Shiping Portal", $ste_root."manage/ecomsettings/ship-portal.php");
		
		echo $bread_crumb->output();
		
 
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
        
		//faq section tabbed sub-navigation
        require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/shipping-section-tabs.php");
		?>
		<form name="form" action="ship-type.php" method="post" onSubmit="return validate(this)">
        	<input type="hidden" name="set_active" value="1">
			<div class="page_actions">
            	<?php if($admin_access->ecommerce_level > 1){ ?>
				<a href="#" class="btn btn-primary btn-large confirm confirm-add"><i class="icon-plus icon-white"></i> Add New Shipping Portal</a>
                <!--
				<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </a>
                -->
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
				
			$sql = "SELECT * FROM ship_port 
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
				if($sortby == 'notes'){
					if($a_d == 'd'){
						$sql .= " ORDER BY notes DESC".$limit;
					}else{
						$sql .= " ORDER BY notes".$limit;	
					}
				}
				
			}else{
				$sql .= " ORDER BY ship_port_id".$limit;					
			}
							
	$result = $dbCustom->getResult($db,$sql);			
						
			if($total_rows > $rows_per_page){
				echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "ecomsettings/ship-portal.php", $sortby, $a_d);
				echo "<br /><br /><br />";
			}

			?>
			<div class="data_table">
            	<?php require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/tablesort.php"); ?>
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
                            <th <?php addSortAttr('name',true); ?>>
                            	Name
                            	<i <?php addSortAttr('name',false); ?>></i>
                       		</th>
                            <th <?php addSortAttr('notes',true); ?>>
                            	Notes
                            	<i <?php addSortAttr('notes',false); ?>></i>
                       		</th>
							<th width="15%">Edit</th>
							<th width="12%">Delete</th>
						</tr>
					</thead>
				
					<?php
						$block ='';
						$j = 0;
						while($row = $result->fetch_object()) {
							$j =  $j +1;
							$block .= "<tr>";
							//name
							$block .= "<td>$row->name</td>";
							$block .= "<td>$row->notes</td>";
							$block .= "<td><a class='btn btn-primary fancybox fancybox.iframe' href='edit-ship-port.php?ship_port_id=".$row->ship_port_id."'><i class='icon-cog icon-white'></i> Edit</a></td>";
							$disabled = ($admin_access->ecommerce_level < 2)? "disabled" : '';
							$block .= "<td valign='middle'>
							<a class='btn btn-danger confirm ".$disabled."'>
							<i class='icon-remove icon-white'></i>
							<input type='hidden' id='".$row->ship_port_id."' class='itemId' value='".$row->ship_port_id."' /></a></td>";						
							$block .= "</tr>";
						}
						echo $block;
					?>
				</table>
				<?php 
					if($total_rows > $rows_per_page){
						echo getPagination($total_rows, $rows_per_page, $pagenum, $last, "ecomsettings/ship-portal.php", $sortby, $a_d);
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
<div style="display:none">
	<div id="edit" style="width:100%; height:100%;"> </div>
</div>
<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this shipping portal?</h3>
	<form name="del_ship_port" action="ship-portal.php" method="post" target="_top">
		<input id="del_ship_port_id" class="itemId" type="hidden" name="del_ship_port_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_ship_port" type="submit" >Yes, Delete</button>
	</form>
</div>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>
	<!-- New Add Dialogue -->
	<div id="content-add" class="confirm-content">
		<form name="add_ship_port" action="ship-portal.php" method="post" target="_top">
			<fieldset class="colcontainer">
				<label>Ship portal name</label>
				<input type="text" name="name"/>
				<label>Email</label>
				<input type="text" name="email"/>
				<label>Post Web site</label>
				<input type="text" name="post_web_site"/>
				<label>Notes</label>
				<textarea name="notes" cols="20" rows="3"></textarea>
			</fieldset>
			<a class="btn btn-large dismiss"> Cancel </a>
			<button name="add_ship_port" type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Add </button>
		</form>
	</div>
</body>
</html>

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
$page_title = "Global Discount";
$page_group = "discount";
require_once($real_root."/manage/admin-includes/set-page.php");
$db = $dbCustom->getDbConnect(CART_DATABASE);
$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';
// current unix time stamp
$ts	= time();

$sortby = (isset($_GET['sortby'])) ? $_GET['sortby'] : '';
$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';		
$pagenum = (isset($_GET['pagenum'])) ? $_GET['pagenum'] : 0;
$truncate = (isset($_GET['truncate'])) ? $_GET['truncate'] : 1;

if(isset($_POST['set_active'])){
	
	$actives = (isset($_POST["actives"]))? $_POST["actives"] : array();

	$sql = "UPDATE global_discount 
			SET hide = '1' 
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);
		
	foreach($actives as $key => $value){
		$sql = "UPDATE global_discount 
				SET hide = '0' 
				WHERE global_discount_id = '".$value."'";
		$result = $dbCustom->getResult($db,$sql);
		//echo "key: ".$key."   value: ".$value."<br />"; 
	}

	$msg = "Changes Saved.";
}

if (isset($_POST["edit_global_discount"])) {
	$global_discount_id = $_POST["global_discount_id"];
	$name = trim(addslashes($_POST['name']));
	$type = $_POST["type"];
	$coupon_code = trim(addslashes($_POST["coupon_code"]));
	$percent_off = trim(addslashes($_POST["percent_off"]));
	$amount_off = trim(addslashes($_POST["amount_off"]));
	$if_greater_than = trim(addslashes($_POST["if_greater_than"]));
	$if_less_than = trim(addslashes($_POST["if_less_than"]));
	$description = trim(addslashes($_POST['description']));
	$can_use_with_other_discounts = (isset($_POST["can_use_with_other_discounts"])) ? 1 : 0;
	$hide = (isset($_POST['hide'])) ? $_POST['hide'] : 0;

	$img_id = (isset($_POST['img_id'])) ? $_POST['img_id'] : 0;
	if ($if_less_than == '') $if_less_than = 99999999;
	
	$when_active = $_POST["when_active"];
	
	if (!strlen($when_active) < 10) {
		$wd          = explode("/", $when_active);
		$when_active = mktime(00, 00, 00, $wd[0], $wd[1], $wd[2]);
	} else {
		$when_active = 0;
	}
	$when_expired = $_POST["when_expired"];
	if (!strlen($when_expired) < 10) {
		$wd           = explode("/", $when_expired);
		$when_expired = mktime(23, 59, 59, $wd[0], $wd[1], $wd[2]);
	} else {
		$when_expired = 0;
	}
	
	$chk_nme = '';
	$go= 1;
	if($coupon_code != ''){
		$sql = sprintf("SELECT name
						FROM global_discount 
						WHERE coupon_code = '%s'
						AND global_discount_id != '%u'
						AND profile_account_id = '%u'", $coupon_code, $global_discount_id, $_SESSION['profile_account_id']);
							
							
		$result = $dbCustom->getResult($db,$sql);
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			$chk_nme = $object->name;
			if($chk_nme == '') $chk_nme = 'another coupon';
			$msg = "This coupon code is already used in ".$chk_nme.". The operation did not complete.";
			$go = 0; 	 
		}
	}
	
	
	if($go){
	//if ($user_level > 1) {
		$sql    = sprintf("UPDATE global_discount SET  
					   	name = '%s'
						,type = '%s'
						,coupon_code = '%s'
						,when_active = '%u'
						,when_expired = '%u'
						,percent_off = '%u'
						,amount_off = '%f' 
						,if_greater_than = '%f'
						,if_less_than = '%f'
						,description = '%s'
						,can_use_with_other_discounts = '%u'
						,hide = '%u'
						,last_update = '%u'
						,img_id = '%u'
						WHERE global_discount_id = '%u'", $name, $type, $coupon_code, $when_active, $when_expired, $percent_off, $amount_off, $if_greater_than, $if_less_than, $description, $can_use_with_other_discounts, $hide, $ts, $img_id, $global_discount_id);
		$result = $dbCustom->getResult($db,$sql);
		if (!$result)
			die(mysql_error());
		//echo $sql;
	//} else {
		//$msg = "This user is not allowed to edit discounts";
	//}
	
	}
}


if (isset($_POST["add_global_discount"])) {
	$name                         = trim(addslashes($_POST['name']));
	$type                         = $_POST["type"];
	$coupon_code = (isset($_POST["coupon_code"])) ? trim(addslashes($_POST["coupon_code"])) : '';
	$percent_off                  = trim(addslashes($_POST["percent_off"]));
	$amount_off                   = trim(addslashes($_POST["amount_off"]));
	$if_greater_than              = trim(addslashes($_POST["if_greater_than"]));
	$if_less_than                 = trim(addslashes($_POST["if_less_than"]));
	$description                  = trim(addslashes($_POST['description']));
	$can_use_with_other_discounts = (isset($_POST["can_use_with_other_discounts"])) ? 1 : 0;
	//$hide 						  = (isset($_POST['hide'])) ? 1 : 0;
	
	$hide = 1;
	
	$img_id 					  = (isset($_POST['img_id'])) ? $_POST['img_id'] : 0;

	if ($if_less_than == '')
		$if_less_than = 99999999;
	$when_active = $_POST["when_active"];
	if (!strlen($when_active) < 10) {
		$wd          = explode("/", $when_active);
		$when_active = mktime(00, 00, 00, $wd[0], $wd[1], $wd[2]);
		//echo "<br />".date("m/d/Y",$when_active);
		//echo "<br />".date("F j, Y, g:i a", $when_active);
	} else {
		$when_active = 0;
	}
	$when_expired = $_POST["when_expired"];
	if (!strlen($when_expired) < 10) {
		$wd           = explode("/", $when_expired);
		$when_expired = mktime(23, 59, 59, $wd[0], $wd[1], $wd[2]);
		//echo "<br />".date("m/d/Y",$when_expired);
		//echo "<br />".date("F j, Y, g:i a", $when_expired);
	} else {
		$when_expired = 0;
	}
	
	
	$chk_nme = '';
	$go= 1;
	if($coupon_code != ''){
		$sql = sprintf("SELECT name
						FROM global_discount 
						WHERE coupon_code = '%s'
						AND profile_account_id = '%u'", $coupon_code,$_SESSION['profile_account_id']);
							
							
		$result = $dbCustom->getResult($db,$sql);
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			$chk_nme = $object->name;
			if($chk_nme == '') $chk_nme = 'another coupon';
			$msg = "This coupon code is already used in ".$chk_nme.". The operation did not complete.";
			$go = 0; 	 
		}
	}
	
	
	if($go){
	
	
	//if ($user_level > 1) {
		$sql    = sprintf("INSERT INTO global_discount 
					   (name
						,type
						,coupon_code
						,when_active
						,when_expired
						,percent_off
						,amount_off
						,if_greater_than
						,if_less_than
						,can_use_with_other_discounts
						,description
						,hide
						,last_update
						,profile_account_id
						,img_id)
					   VALUES(
						'%s'
						,'%s'
						,'%s'
						,'%u'
						,'%u'
						,'%u'
						,'%f'
						,'%f'
						,'%f'
						,'%u'
						,'%s'
						,'%u'
						,'%u'
						,'%u'
						,'%u')", $name, $type, $coupon_code, $when_active, $when_expired, $percent_off, $amount_off, $if_greater_than, $if_less_than, $can_use_with_other_discounts, $description, $hide, $ts, $_SESSION['profile_account_id'], $img_id);
		$result = $dbCustom->getResult($db,$sql);
		if (!$result)
			die(mysql_error());
		//echo $sql;
	//} else {
		//$msg = "This user is not allowed to add discounts";
	//}
	
	}
}





if(isset($_POST["del_global_discount_id"])){

	$global_discount_id = $_POST["del_global_discount_id"];

	$sql = "DELETE FROM global_discount 
			WHERE global_discount_id = '".$global_discount_id."'";
	$result = $dbCustom->getResult($db,$sql);

	$msg = "Your change is now live.";

}



// activate timed discounts if needed  
/*
$sql    = "UPDATE global_discount SET hide = '0' 
		WHERE when_active <= '" . $ts . "' 
		AND when_expired > '" . $ts . "' AND hide = '0'
		AND profile_account_id = '" . $_SESSION['profile_account_id'] . "'";
$result = $dbCustom->getResult($db,$sql);
*/

// expire timed  discounts if needed  
/*
$sql    = "UPDATE global_discount SET hide = '1' 
		WHERE (when_expired > '0'
		AND profile_account_id = '" . $_SESSION['profile_account_id'] . "'  
		AND when_expired <= '" . $ts . "') OR (when_active > '" . $ts . "')";
$result = $dbCustom->getResult($db,$sql);
*/

unset($_SESSION['img_id']);
unset($_SESSION['global_discount_id']);
unset($_SESSION['temp_page_fields']);
unset($_SESSION['paging']);

require_once($real_root."/manage/admin-includes/doc_header.php");
?>
<script>
function regularSubmit() {
  document.form.submit(); 
}
</script>
</head>

<body>
<?php
require_once($real_root."/manage/admin-includes/manage-header.php");
require_once($real_root."/manage/admin-includes/manage-top-nav.php");
?>
<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php
		require_once($real_root."/manage/admin-includes/manage-side-nav.php");
		?>
	</div>
	<div class="manage_main">
		<?php
		$url_str = "global-discount.php";
		$url_str .= "?pagenum=".$pagenum;
		$url_str .= "&sortby=".$sortby;
		$url_str .= "&a_d=".$a_d;
		$url_str .= "&truncate=".$truncate;
		?>
<form name="form" action="<?php echo $url_str; ?>" method="post" enctype="multipart/form-data">
	<input type="hidden" name="set_active" value="1">
	<?php 
	if($admin_access->ecommerce_level > 1){ 			
		$url_str = "add-global-discount.php";
		$url_str .= "?global_discount_id=0";						
		$url_str .= "&pagenum=".$pagenum;
		$url_str .= "&sortby=".$sortby;
		$url_str .= "&a_d=".$a_d;
		$url_str .= "&truncate=".$truncate;			
	?>
	<div class="page_actions">
	<a href="<?php echo $url_str; ?>" class="btn btn-primary btn-small fancybox fancybox.iframe" >
	<i class="icon-plus icon-white"></i> Add a New Discount </a>
	<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </a>         
	</div>
	<?php }

		
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		$sql = "SELECT * FROM global_discount 
				WHERE profile_account_id = '" . $_SESSION['profile_account_id'] . "'";
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
			if($sortby == 'type'){
				if($a_d == 'd'){
					$sql .= " ORDER BY type DESC".$limit;
				}else{
					$sql .= " ORDER BY type".$limit;	
				}
			}
			
			
		}else{
			$sql .= " ORDER BY name".$limit;					
		}
								
$result = $dbCustom->getResult($db,$sql);		
					
		if($total_rows > $rows_per_page){
			echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "ecomsettings/global-discount.php", $sortby, $a_d);
			echo "<br /><br /><br />";
		}

?>

			<div class="data_table">
            	<?php require_once($real_root."/manage/admin-includes/tablesort.php"); ?>
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
                        <th width="20%" <?php addSortAttr('name',true); ?>>
                            Name
                           <i <?php addSortAttr('name',false); ?>></i>
                        </th>

                        <th width="10%" <?php addSortAttr('type',true); ?>>
                            Type
                           <i <?php addSortAttr('type',false); ?>></i>
                        </th>

							<th width="17%">Condition</th>
							<th width="10%">Discount</th>
							<th width="20%">Description</th>
							<th width="10%">Active</th>
							<th width="10%">Edit</th>
                            <th>Delete</th>
                        </tr>
					</thead>
					<?php
					while ($row = $result->fetch_object()) {
						$block = "<tr>";
						//name
						$block .= "<td valign='top'>$row->name</td>";
						//type
						$block .= "<td valign='top'>$row->type</td>";
						//condition
						if ($row->if_greater_than > 0 && $row->if_less_than > 0) {
							$block .= "<td valign='top'> $row->if_greater_than < price < $row->if_less_than</td>";
						} elseif ($row->if_greater_than > 0 && $row->if_less_than == 0) {
							$block .= "<td valign='top'>price more than $$row->if_greater_than</td>";
						} elseif ($row->if_greater_than == 0 && $row->if_less_than > 0) {
							$block .= "<td valign='top'>price less than $$row->if_less_than</td>";
						} else {
							$block .= "<td valign='top'>none</td>";
						}
						//discount
						if ($row->percent_off > 0) {
							$block .= "<td valign='top'>%".$row->percent_off." off</td>";
						} elseif ($row->amount_off > 0) {
							$block .= "<td valign='top'>$".$row->amount_off." off</td>";
						} else {
							$block .= "<td valign='top'><br />none</td>";
						}
						//description
						$block .= "<td valign='top'>".$row->description."</td>";
						
						//Active
						$status = ($row->hide == 1)? '' : "checked='checked'";
						
						$disabled = ($admin_access->ecommerce_level < 2)? "disabled" : '';
						
						$block .= "<td valign='top'>
						<div class='checkboxtoggle on ".$disabled."'> 
						<span class='ontext'>ON</span>
						<a class='switch on' href='#'></a>
						<span class='offtext'>OFF</span>
						<input type='checkbox' class='checkboxinput' name='actives[]' value='".$row->global_discount_id."' $status /></div></td>";

						$url_str = "edit-global-discount.php";
						$url_str .= "?global_discount_id=".$row->global_discount_id;						
						$url_str .= "&pagenum=".$pagenum;
						$url_str .= "&sortby=".$sortby;
						$url_str .= "&a_d=".$a_d;
						$url_str .= "&truncate=".$truncate;
							
						//edit
						$block .= "<td valign='top'>
						<a href='".$url_str."' 
						class='btn btn-primary btn-small fancybox fancybox.iframe'><i class='icon-cog icon-white'></i> Edit</a></td>";
						
						//delete
						$block .= "<td valign='top'>
						<a class='btn btn-danger confirm ".$disabled." '>
						<i class='icon-remove icon-white'></i>
						<input type='hidden' id='".$row->global_discount_id."' class='itemId' value='".$row->global_discount_id."' /></a></td>";
						
						
						$block .= "</tr>";

						
						
						echo $block;
					}
					?>
				</table>
				<?php
                if($total_rows > $rows_per_page){
                    echo getPagination($total_rows, $rows_per_page, $pagenum, $last, "ecomsettings/global-discount.php", $sortby, $a_d);
                }
    
                ?>


			</div>
		</form>
		<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </a>
		
	</div>
	<p class="clear"></p>
	<?php
require_once($real_root."/manage/admin-includes/manage-footer.php");

	$url_str = "global-discount.php";
	$url_str .= "?pagenum=".$pagenum;
	$url_str .= "&sortby=".$sortby;
	$url_str .= "&a_d=".$a_d;
	$url_str .= "&truncate=".$truncate;


?>
</div>
<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this Discount?</h3>
	<form name="del_global_discount" action="<?php echo $url_str; ?>" method="post" target="_top">
		<input id="del_global_discount_id" class="itemId" type="hidden" name="del_global_discount_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_global_discount" type="submit" >Yes, Delete</button>
	</form>
</div>

<div style="display:none">
	<div id="edit" style="width:800px; height:660px;"> </div>
</div>
<div style="display:none">
	<div id="upload" style="width:280px; height:200px;"> </div>
</div>
</body>
</html><?php

?>

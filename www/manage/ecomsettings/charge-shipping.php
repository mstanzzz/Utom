<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Charge Shipping Yes or No";
$page_group = "ship";

	



$parent_cat_id =  (isset($_GET['parent_cat_id'])) ? $_GET['parent_cat_id'] : 0;

$msg = '';

if(isset($_POST["change_charge_shipping"])){

	$is_shipping_charges = isset($_POST["is_shipping_charges"]) ? $_POST["is_shipping_charges"] : 0;
	$db = $dbCustom->getDbConnect(USER_DATABASE);
	$sql = sprintf("UPDATE profile_account 
				SET is_shipping_charges = '%u'
				WHERE id = '%u'", 
				$is_shipping_charges
				,$_SESSION['profile_account_id']);

	$result = $dbCustom->getResult($db,$sql);
			
		
	$msg = "Your change is now live.";

}




require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>
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
		$bread_crumb->add("Shiping Portal", $ste_root."manage/ecomsettings/ship-portal.php");
		$bread_crumb->prune("Shiping Portal");
		echo $bread_crumb->output();
		
 
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
        
		//faq section tabbed sub-navigation
        require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/shipping-section-tabs.php");
		
		$db = $dbCustom->getDbConnect(USER_DATABASE);

		$sql = "SELECT is_shipping_charges FROM profile_account WHERE id = '".$_SESSION['profile_account_id']."'"; 
		$result = $dbCustom->getResult($db,$sql);
				
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			$is_shipping_charges = $object->is_shipping_charges;					
		}else{
			$is_shipping_charges = 0;								
		}
		?>
		<form name="select_type_form" action="charge-shipping.php" method="post" onSubmit="return validate(this)">
			<?php if($admin_access->ecommerce_level > 1){ ?>
            <div class="page_actions">
				<button type="submit"  name="change_charge_shipping" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </button>
			</div>
            <?php } ?>
			
			<div class="page_content edit_page">
                <div class="colcontainer">
                    <div class="twocols">
                        <label>Charge for shipping</label>
                    </div>
                    <div class="twocols">
                        <div class="checkboxtoggle on <?php if($admin_access->ecommerce_level < 2) echo "disabled"; ?>"> 
                        <span class="ontext">ON</span><a class="switch on" href="#"></a><span class="offtext">OFF</span>
                            <input type="radio" class="checkboxinput" name="is_shipping_charges" value="1" <?php if($is_shipping_charges == 1) echo "checked='checked'";?> />
                        </div>
                    </div>
                </div>
            </div>

		</form>
	</div>
	<p class="clear"></p>
	<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
    ?>
</div>
</body>
</html>

<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;


$page_title = "Free Shipping if Above Amount";
$page_group = "ship";

	

$db = $dbCustom->getDbConnect(CART_DATABASE);

//$sas_cust_id =  (isset($_REQUEST['sas_cust_id'])) ? $_REQUEST['sas_cust_id'] : 0;

$msg = '';


if(isset($_POST["edit_free_ship"])){
	
	$min_price = $_POST['min_price'];
	
	//echo $min_price;
	
	$active  = (isset($_POST['active'])) ? 1 : 0; 
	

	$sql = "SELECT ship_free_condition_id
			FROM ship_free_condition
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);
	
	if($result->num_rows == 0){

		$sql = "INSERT INTO ship_free_condition
				(min_price, active, profile_account_id)
				VALUES
				('".$min_price."', '".$active."', '".$_SESSION['profile_account_id']."')"; 
		$result = $dbCustom->getResult($db,$sql);
			
	}else{

		$sql = "UPDATE ship_free_condition 
				SET min_price = '".$min_price."'
				,active = '".$active."'					
				WHERE  profile_account_id = '".$_SESSION['profile_account_id']."'";
		$result = $dbCustom->getResult($db,$sql);					
	}
}

$sql = "SELECT min_price, active
		FROM ship_free_condition
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);	
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$min_price = $object->min_price;
	$active = $object->active; 
	 	
}else{
	$min_price = 1000;
	$active = 0; 
	
}

if(isset($_SESSION['shipping_cost'])){
	unset($_SESSION['shipping_cost']);	
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
		$bread_crumb->add("Ship Free if Above", $ste_root."manage/ecomsettings/ship-free-if-above.php");
		$bread_crumb->prune("Shiping Flat Charge");
		echo $bread_crumb->output();
		
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
        
		//faq section tabbed sub-navigation
        require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/shipping-section-tabs.php");
		?>
	<form name="form" action="ship-free-if-above.php" method="post" onSubmit="return validate(this)" enctype="multipart/form-data">
				
	<input type="hidden" name="edit_free_ship" value="1" >
    
    
    
    	<div class="colcontainer formcols">
			<div class="twocols">
				<label>Ship Free when order total price is above this amount</label>
			</div>
			<div class="twocols">
            	<input type="text" name="min_price" value="<?php echo $min_price; ?>">	
        		            
            </div>
    	</div>
    

    	<div class="colcontainer formcols">
    
    		<div class="twocols">
                        <label>Set Active</label>
            	</div>
                <div class="twocols">
                        <div class="checkboxtoggle on <?php if($admin_access->ecommerce_level < 2) echo "disabled"; ?>"> 
                        <span class="ontext">ON</span><a class="switch on" href="#"></a><span class="offtext">OFF</span>
                        <input type="radio" class="checkboxinput" name="active" value="1" <?php if($active == 1) echo "checked='checked'";?> />
                 </div>
        	</div>		
		</div> 
        
        <input type="submit" name="submit" value="Submit">
                   
    </form>
	</div>
  <p class="clear"></p>
  <?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
    ?>
</div>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>
	<!-- New Add Dialogue -->
</body>
</html>


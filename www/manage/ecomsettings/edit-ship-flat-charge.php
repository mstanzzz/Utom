<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;


$page_title = "Edit Shipping Flat Charge";
$page_group = "vend-man";

	

$ship_flat_charge_id = (isset($_GET['ship_flat_charge_id']))? $_GET['ship_flat_charge_id'] : 0; 


$msg = '';

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>
</head>
<div class="lightboxholder">
	<?php if($msg != ''){ ?>
	<div class="alert">
		<p><?php echo $msg ?></p>
	</div>
	<?php 
		} 
    $db = $dbCustom->getDbConnect(SITE_N_DATABASE);        
	?>
	<form name="edit_ship_flat_charge_form" action="ship-flat-charge.php" method="post" target="_top">
		<input type="hidden" name="ship_flat_charge_id" value="<?php echo $ship_flat_charge_id;  ?>" />
		<div class="lightboxcontent">
			<h2>Edit Shipping Flat Charge</h2>
			<fieldset>
			<?php
			
				$db = $dbCustom->getDbConnect(CART_DATABASE);
			
				$sql = sprintf("SELECT * FROM ship_flat_charge WHERE ship_flat_charge_id = '%u'", $ship_flat_charge_id);
		$result = $dbCustom->getResult($db,$sql);				
				
				if($result->num_rows){
					$object = $result->fetch_object();
					$low = $object->low;
					$high = $object->high;
					$charge = $object->charge;
					$description = $object->description;
				}else{
					$low = $object->low;
					$high = $object->high;
					$charge = $object->charge;
					$description = $object->description;
				}
				
			?>
			<div class="colcontainer formcols">
				<div class="twocols">
					<label>Low Order Price</label>
				</div>
				<div class="twocols">
					<input type="text" name="low" value="<?php echo $low; ?>" />
				</div>
			</div>
			<div class="colcontainer formcols">
				<div class="twocols">
					<label>High Order Price</label>
				</div>
				<div class="twocols">
					<input type="text" name="high" value="<?php echo $high; ?>" />
				</div>
			</div>
			<div class="colcontainer formcols">
				<div class="twocols">
					<label>Shipping Charge</label>
				</div>
				<div class="twocols">
					<span class="prepend-input">$</span><input class="prepended" type="text" name="charge" value="<?php echo $charge; ?>" />
				</div>
			</div>
			<div class="colcontainer formcols">
				<div class="twocols">
					<label>Description</label>
				</div>
				<div class="twocols">
					<textarea name="description" rows="4" cols="40"><?php echo $description; ?></textarea>
				</div>
			</div>
			</fieldset>
		</div>
   		<div class="savebar">
		<?php 
        if($admin_access->ecommerce_level > 1){
            echo "<button class='btn btn-success btn-large' name='edit_ship_flat_charge' type='submit' value='Submit'>
			<i class='icon-ok icon-white'></i> Save Changes</button>"; 
        }else{?>
            <div class="alert"><span class="fltlft"><i class="icon-warning-sign"></i></span> Sorry, you don't have the permissions to edit this item.</div>
        <?php } ?>
        <button class="btn btn-large" type="button" value="Cancel" onClick="top.location.href = 'ship-flat-charge.php'" >Cancel</button>
		</div>

        
          
	</form>
</div>
</body>
</html>









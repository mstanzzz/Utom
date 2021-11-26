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


$page_title = "Edit Shipping Type";
$page_group = "ship";

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';





$ship_type_id = (isset($_GET['ship_type_id']))? $_GET['ship_type_id'] : 0;

require_once($real_root.'/manage/admin-includes/doc_header.php'); 


?>
<script>
	
function validate(){	

	//alert("kkkkk");

	var flat_rate = jQuery.trim(document.edit_ship_type_form.flat_rate.value);
	var percent_rate = jQuery.trim(document.edit_ship_type_form.percent_rate.value);
	
	//alert(flat_rate);
	

	if(flat_rate != '' && percent_rate != ''){
		if(flat_rate > 0 && percent_rate > 0){
			alert("You cannot have values for both flat_rate and percent_rate \n Please enter only one value.");
			return false;
		}
	}
	
	return true;
	
	
}

function checkPercent(elem){
	
	elem = jQuery.trim(elem.value);
	
	if(!IsNumeric(elem.value)){
		alert("Please enter valid numbers only");
	}else{	
		if(elem.value != 0 && elem.value <= 1){
			alert("Please enter 0 or an integer greater than 1");
		}
		
		if(elem.value >= 100){
			alert("Please enter a number less than 100");
		}
	}
}

function IsNumeric(sText)
{
   var ValidChars = "0123456789.";
   var IsNumber=true;
   var Char;
   for (i = 0; i < sText.length && IsNumber == true; i++) 
      { 
      Char = sText.charAt(i); 
      if (ValidChars.indexOf(Char) == -1) 
         {
         IsNumber = false;
         }
      }
   return IsNumber;   
}
</script>
</head>

<body>
<div class="lightboxholder">
	<?php if($msg != ''){ ?>
	<div class="alert">
		<p><?php echo $msg ?></p>
	</div>
	<?php 
		} 
    $db = $dbCustom->getDbConnect(SITE_N_DATABASE);        
	?>
	<form name="edit_ship_type_form" action="ship-type.php" method="post" onSubmit="validate()" target="_top">
		<input type="hidden" name="ship_type_id" value="<?php echo $ship_type_id;  ?>" />
		<div class="lightboxcontent">
			<h2>Edit Ship Type</h2>
			<fieldset>
				<?php
						 
						//echo $ship_type_id ;
						
						$db = $dbCustom->getDbConnect(CART_DATABASE);
						$sql = sprintf("SELECT * FROM ship_type WHERE ship_type_id = '%u'", $ship_type_id);
						$result = $dbCustom->getResult($db,$sql);						
						
						if($result->num_rows){
							$object = $result->fetch_object();
							$type_name = trim($object->type_name);
							$flat_rate = $object->flat_rate;
							$percent_rate = $object->percent_rate;
						}else{
							$type_name = '';
							$flat_rate = '';
							$percent_rate = '';
						}
						$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
					?>
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>Ship Type</label>
					</div>
					<div class="twocols"> <?php echo $type_name; ?> </div>
				</div>
                
                
				<div class="colcontainer formcols">
					<?php if(stristr($type_name, 'unique_') === false && stristr($type_name, 'price_range') === false  && stristr($type_name, 'carrier') === false){ 
                        
                        if(stristr($type_name, "percent")  === false){
                        ?>
                            <div class="twocols">
                                <label>Flat Rate</label>
                            </div>
                            <div class="twocols">
                                <input type="text" name="flat_rate" value="<?php echo $flat_rate; ?>" />
                                <input  type="hidden" name="percent_rate" value="0" />
                            </div>
                        <?php 
                        }else{
                        ?>
					
                            <div class="twocols">
                                <label>Percent Rate</label>
                            </div>
                            <div class="twocols">
                                <input type="text" name="percent_rate" value="<?php echo $percent_rate; ?>" />
                                <input  type="hidden" name="flat_rate" value="0" />
                            </div>
              			      
					<?php
						}
					}else{ 
						
						if(stristr($type_name, 'unique_') == true ){
							
							echo "This option takes the sum of each product's flat shipping rate.";
						}
						
						
						if(stristr($type_name, 'price_range') == true ){
							
							echo "This option takes used a set cart price range to find the rate.";
						}
						
						if(stristr($type_name, 'carrier') === true){
							echo "This option used product weight and shipping zip code the get the rate.";
						}
					}
					
					?>
				</div>
			</fieldset>
		<div class="savebar">
		<?php 
        if($admin_access->ecommerce_level > 1){
        	echo "<button class='btn btn-success btn-large' name='edit_ship_type' type='submit' value='Submit'><i class='icon-ok icon-white'></i> Save Changes</button>"; 
        }else{
		?>
            <div class="alert"><span class="fltlft"><i class="icon-warning-sign"></i></span> Sorry, you don't have the permissions to edit this ship type.</div>		
        <?php 
		} 
		?>
		<button type="button" value="Cancel" onClick="top.location.href = 'ship-type.php'" class="btn btn-large">Cancel</button>
		</div>
	</form>
</div>
</body>
</html>
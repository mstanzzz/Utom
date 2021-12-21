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

$page_title = "Edit Shipping Portal";
$page_group = "vend-man";

	


$ship_port_id = (isset($_GET['ship_port_id'])) ? $_GET['ship_port_id'] : 0; 


	
$db = $dbCustom->getDbConnect(CART_DATABASE);
$sql = sprintf("SELECT * FROM ship_port WHERE ship_port_id = '%u'", $ship_port_id);
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$name = $object->name;
	$email = $object->email;
	$post_web_site = $object->post_web_site;
	$notes = $object->notes;
}else{
	$name = '';
	$email = '';
	$post_web_site = '';
	$notes = '';
}


$msg = '';

require_once($real_root.'/manage/admin-includes/doc_header.php'); 


?>
</head>
<body>

<div class="manage_page_container">
  
  <div class="top_link"> <a href='style.php'>Back</a><br>
  </div>
  <div class="manage_main">
    <?php 
        
        echo "<div class='manage_main_page_title'>".$page_title." </div>";

	

?>
    
        <form name="edit_ship_port" action="ship-portal.php" method="post" target="_top" enctype="multipart/form-data">
       	<input id="ship_port_id" type="hidden" name="ship_port_id" value="<?php echo $ship_port_id;  ?>" />
        
        	<div style="float:left; width:560px;">
                <div class="head">Name</div>
                <input type="text" name="name" value="<?php echo stripslashes($name); ?>" style="width:300px" />
            </div> 
                   
        	<div style="float:left; width:560px; padding-top:15px;">
                <div class="head">Email</div>
                <input type="text" name="email" value="<?php echo $email; ?>"  style="width:300px" />
            </div> 
        	<div style="float:left; width:560px; padding-top:15px;">
                <div class="head">Post web site</div>
                <input type="text" name="post_web_site" value="<?php echo $post_web_site; ?>"  style="width:300px" />
            </div> 
        	<div style="float:left; width:560px; padding-top:15px;">
                <div class="head">Notes</div>
				<textarea name="notes" cols="80" rows="3"><?php echo $notes; ?></textarea>                
            </div> 
            <div class="clear"></div>
 
   		<div class="savebar">
		<?php 
        if($admin_access->ecommerce_level > 1){
            echo "<button class='btn btn-success btn-large' name='edit_ship_port' type='submit' value='Submit'><i class='icon-ok icon-white'></i> Save Changes</button>"; 
        }else{?>
            <div class="alert"><span class="fltlft"><i class="icon-warning-sign"></i></span> Sorry, you don't have the permissions to edit this item.</div>
        <?php } ?>
        <button class="btn btn-large" type="button" value="Cancel" onClick="top.location.href = 'ship-portal.php'" >Cancel</button>
		</div>

        
        
            </form>






</div>
    <p class="clear"></p>

</div>
</body>
</html>












